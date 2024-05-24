<?php



class ShowRelocatePage extends AbstractGamePage
{

  public static $requireModule = MODULE_RELOCATE;

	function __construct()
	{
		parent::__construct();
	}

	function send()
	{
		global $USER, $PLANET, $LNG, $reslist, $resource, $config;

		$db = Database::get();

		$galaxy = HTTP::_GP('galaxy', 0);
		$system = HTTP::_GP('system', 0);
		$planet = HTTP::_GP('planet', 0);

		//cannot relocate if user in vacation mode
		if (isVacationMode($USER)){
      $this->printMessage($LNG['cannot_use_in_vac']);
    }

		//you cannot move planet if there is building in construction
		if ($PLANET['b_building'] != 0){
      $this->printMessage($LNG['rl_error_type_5']);
    }

		//you cannot move planet if there is a research which is started from this planet
		if ($USER['b_tech'] != 0 && $USER['b_tech_planet'] == $PLANET['id']){
      $this->printMessage($LNG['rl_error_type_6']);
    }

		//you cannot move planet if there is a hangar production
		if(!empty(unserialize($PLANET['b_hangar_id']))){
      $this->printMessage($LNG['rl_error_type_9']);
    }

		//you cannot move planet if there is a fleet which is started from this planet at the time of relocation
		if ($PLANET['id_luna'] != 0) {
			$sql = "SELECT COUNT(*) as count FROM %%FLEETS%% WHERE fleet_owner = :userId AND (fleet_start_id = :planetId OR fleet_start_id =:moonId) AND fleet_end_time > :thisTime ;";
			$activeFleets = $db->selectSingle($sql,array(
				':userId' => $USER['id'],
				':planetId' => $PLANET['id'],
				':thisTime' => TIMESTAMP,
				':moonId' => $PLANET['id_luna']
			),'count');
		}else {
			$sql = "SELECT COUNT(*) as count FROM %%FLEETS%% WHERE fleet_owner = :userId AND fleet_start_id = :planetId AND fleet_end_time > :thisTime ;";
			$activeFleets = $db->selectSingle($sql,array(
				':userId' => $USER['id'],
				':planetId' => $PLANET['id'],
				':thisTime' => TIMESTAMP
			),'count');
		}

		if ($activeFleets > 0){
      $this->printMessage($LNG['rl_error_type_7']);
    }



		if (empty($galaxy) || empty($system) || empty($planet)){
      $this->printMessage($LNG['rl_error_type_1']);
    }

    //user cannot start this from moon !
		if ($PLANET['planet_type'] == 3) {
      $this->printMessage($LNG['rl_error_type_2']);
    }

			//you cannot relocate if someone is attacking to the planet or moon

			$sql = "SELECT COUNT(*) as count FROM %%FLEETS%% WHERE
			fleet_owner != :userId AND fleet_mess = 0 AND
			fleet_target_owner = :userId AND fleet_mission IN (1,9) AND hasCanceled = 0 AND fleet_end_id IN (:planetId, :moonId);";

			$attackfleets = $db->selectSingle($sql,array(
					':userId' => $USER['id'],
					':planetId' => $PLANET['id'],
					':moonId' => $PLANET['id_luna'],
			),'count');

		if ($attackfleets > 0) {
			$this->printMessage($LNG['rl_error_type_10']);
		}


		if (!PlayerUtil::isPositionFree(Universe::current(),$galaxy, $system, $planet)){
			$this->printMessage($LNG['rl_error_type_3']);
		}

		if (!PlayerUtil::checkPosition(Universe::current(),$galaxy, $system, $planet)){
			$this->printMessage($LNG['rl_error_type_4']);
		}

		if ($USER['darkmatter'] < $config->relocate_price){
      $this->printMessage($LNG['rl_error_type_11']);
    }

	  // NOTE: you can only attempt to move a planet once per 24h (even if it fails)
		if (TIMESTAMP - $PLANET['last_relocate'] < $config->relocate_next_time * 60 * 60){
      $this->printMessage(sprintf($LNG['rl_error_type_8'],$config->relocate_next_time));
    }



		// NOTE: Add countdown 24 (? divided to universe fleet speed) hours then move the planet
		// NOTE: fleet comes to new planet after planet relocation is succeed

		$PlanetRess	= new ResourceUpdate();
		$PlanetRess->CalcResource($USER, $PLANET, true);

		$fleet = $fleet_moon = array();

		foreach ($reslist['fleet'] as $key => $fleetID) {
			if ($fleetID == 212 || $fleetID == 221 || $PLANET[$resource[$fleetID]] == 0) {
				continue;
			}
				$fleet = $fleet + array(
					$fleetID => $PLANET[$resource[$fleetID]]
				);
		}

		if ($PLANET['id_luna'] != 0) {
			$sql = "SELECT * FROM %%PLANETS%% WHERE id = :idLuna;";
			$MOON = $db->selectSingle($sql,array(
				':idLuna' => $PLANET['id_luna']
			));

			foreach ($reslist['fleet'] as $key => $fleetID) {
				if ($fleetID == 212 || $fleetID == 221 || $MOON[$resource[$fleetID]] == 0) {
					continue;
				}
					$fleet_moon = $fleet_moon + array(
						$fleetID => $MOON[$resource[$fleetID]]
					);
			}

		}

		if (!empty($fleet) or !empty($fleet_moon) && !$config->relocate_move_fleet_directly) {
			$fleetSpeed = 10;

			$targetPlanetData	= array(
						'id' => $PLANET['id'],
						'id_owner' => $PLANET['id_owner'],
						'planettype' => $PLANET['planet_type']
			);

			$GameSpeedFactor = FleetFunctions::GetGameSpeedFactor();

			$distance = FleetFunctions::GetTargetDistance(array($PLANET['galaxy'], $PLANET['system'], $PLANET['planet']), array($galaxy, $system, $planet));

			$consumption = $Staytime = $StayDuration = 0;

			$fleetResource	= array(
				901	=> 0,
				902	=> 0,
				903	=> 0,
			);
			}


			if (!empty($fleet) && !$config->relocate_move_fleet_directly) {

				$MaxFleetSpeed 				= FleetFunctions::GetFleetMaxSpeed($fleet, $USER);
				$duration      				= FleetFunctions::GetMissionDuration($fleetSpeed, $MaxFleetSpeed, $distance, $GameSpeedFactor, $USER);
				$fleetStartTime		= $duration + TIMESTAMP ;
				$fleetStayTime		= $fleetStartTime + $StayDuration;
				$fleetEndTime		= $fleetStayTime + $duration;


				$fleetId = FleetFunctions::sendFleet($fleet, 4, $USER['id'], $PLANET['id'], $PLANET['galaxy'],
				 $PLANET['system'], $PLANET['planet'], $PLANET['planet_type'], $PLANET['id_owner'],
				 $PLANET['id'], $galaxy, $system, $planet, 1, $fleetResource,
				 $fleetStartTime, $fleetStayTime, $fleetEndTime, 0, 0, 0, 0, $USER['lang'], "en", $PLANET['name'],$PLANET['name']);



				$sql ="UPDATE %%FLEETS%% SET fleet_no_m_return = 1 WHERE fleet_id = :fleetId;";
				$db->update($sql,array(
					':fleetId' =>$fleetId
				));

			}


			if (!empty($fleet_moon) && !$config->relocate_move_fleet_directly) {

				$MaxFleetSpeed 				= FleetFunctions::GetFleetMaxSpeed($fleet_moon, $USER);
				$duration      				= FleetFunctions::GetMissionDuration($fleetSpeed, $MaxFleetSpeed, $distance, $GameSpeedFactor, $USER);
				$fleetStartTime		= $duration + TIMESTAMP ;
				$fleetStayTime		= $fleetStartTime + $StayDuration;
				$fleetEndTime		= $fleetStayTime + $duration;

				$fleetId = FleetFunctions::sendFleet($fleet_moon, 4, $USER['id'], $MOON['id'], $MOON['galaxy'],
				 $MOON['system'], $MOON['planet'], $MOON['planet_type'], $MOON['id_owner'],
				 $PLANET['id'], $galaxy, $system, $planet, 1, $fleetResource,
				 $fleetStartTime, $fleetStayTime, $fleetEndTime, 0, 0);

				 $sql ="UPDATE %%FLEETS%% SET fleet_no_m_return = 1 WHERE fleet_id = :fleetId;";
				 $db->update($sql,array(
					 ':fleetId' =>$fleetId
				 ));
			}



		// NOTE: relocation will be canceled after countdown if construction / research / or fleet movement
		// NOTE: timer green if relocation will succeed, red if not succeed
		// NOTE: incoming attacking/supporting fleet won´t block the movement, fleets will return after reaching empty position


		// NOTE: temperature and picture of planet should be changed
		$planetData	= array();
		require 'includes/PlanetData.php';

		$dataIndex		= (int) ceil($planet / ($config->max_planets / count($planetData)));
		$maxTemperature	= $planetData[$dataIndex]['temp'];
		$minTemperature	= $maxTemperature - 40;

		$imageNames			= array_keys($planetData[$dataIndex]['image']);
		$imageNameType		= $imageNames[array_rand($imageNames)];
		$imageName			= $imageNameType;
		$imageName			.= 'planet';
		$imageName			.= $planetData[$dataIndex]['image'][$imageNameType] < 10 ? '0' : '';
		$imageName			.= $planetData[$dataIndex]['image'][$imageNameType];


		$sql = "UPDATE %%PLANETS%% SET galaxy = :galaxy, `system` = :system, planet = :planet,
		temp_min = :temp_min, temp_max = :temp_max, `image` = :imageName, last_relocate = :relocateTime
		WHERE id = :planetId;";


		$db->update($sql, array(
			':galaxy' => $galaxy,
			':system' => $system,
			':planet' => $planet,
			':temp_min' => $minTemperature,
			':temp_max' => $maxTemperature,
			':imageName' => $imageName,
			':planetId' => $PLANET['id'],
			':relocateTime' => TIMESTAMP,
		));

		if ($PLANET['id_luna'] != 0) {
			// NOTE: jumpgate is deactivated for 24 hours to the new location
			// NOTE: divided to fleet speed ? no info ?
			$next_jump_time = TIMESTAMP + ($config->relocate_jump_gate_active * 60 * 60) / ($config->fleet_speed / 2500);

			$sql = "UPDATE %%PLANETS%% SET galaxy = :galaxy, `system` = :system, planet = :planet,last_jump_time =:relocateTime WHERE id = :moonId;";
			$db->update($sql,array(
				':galaxy' => $galaxy,
				':system' => $system,
				':planet' => $planet,
				':moonId' => $PLANET['id_luna'],
				':relocateTime' => $next_jump_time,
			));
		}

		$USER['darkmatter'] -= $config->relocate_price;

		if ($PLANET['id'] == $USER['id_planet']) {
			$sql = "UPDATE %%USERS%% SET galaxy = :galaxy, `system` = :system, planet = :planet WHERE id = :userId;";
			$db->update($sql,array(
				':galaxy' => $galaxy,
				':system' => $system,
				':planet' => $planet,
				':userId' => $USER['id']
			));
		}

		// NOTE: recalculate planet production
		//part 1 : update $PLANET array
		$sql = "SELECT * FROM %%PLANETS%% WHERE id = :planetId;";
		$PLANET_NEW = $db->selectSingle($sql,array(
			':planetId' => $PLANET['id']
		));
		//part 2: update hash
		$this->ecoObj->setData($USER, $PLANET_NEW);
		$this->ecoObj->ReBuildCache();
		list($USER, $PLANET)	= $this->ecoObj->getData();
		$PLANET['eco_hash'] = $this->ecoObj->CreateHash();
		$this->printMessage($LNG['rl_success'] . " [$galaxy:$system:$planet]");
	}

	function show()
	{
		global $USER, $LNG, $PLANET,$config;



		$this->assign(array(
			'info' => sprintf($LNG['rl_info'],pretty_number($config->relocate_price)),
			'page' => HTTP::_GP('page',''),
			'planetId' => $PLANET['id'],
			'galaxy' => $PLANET['galaxy'],
			'system' => $PLANET['system'],
			'planet' => $PLANET['planet'],
		));

		$this->display('page.relocate.default.tpl');
	}
}
