<?php

/**
*  ultimateXnova
*  based on 2moons by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package ultimateXnova
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2022 Koray Karakuş <koraykarakus@yahoo.com>
 * @copyright 2024 Pfahli (https://github.com/Pfahli)
 * @licence MIT
 * @version 1.8.x Koray Karakuş <koraykarakus@yahoo.com>
 * @link https://github.com/ultimateXnova/ultimateXnova
 */

class PlayerUtil
{
	static public function cryptPassword($password)
	{
		return password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);
	}

	static public function isPositionFree($universe, $galaxy, $system, $position, $type = 1)
	{
		$db = Database::get();
		$sql = "SELECT COUNT(*) as record
		FROM %%PLANETS%%
		WHERE `universe` = :universe
		AND `galaxy` = :galaxy
		AND `system` = :system
		AND `planet` = :position
		AND `planet_type` = :type;";

		$count = $db->selectSingle($sql, array(
			':universe' => $universe,
			':galaxy' 	=> $galaxy,
			':system' 	=> $system,
			':position'	=> $position,
			':type'		=> $type,
		), 'record');

		return $count == 0;
	}

	static public function isNameValid($name)
	{
		if(UTF8_SUPPORT) {
			return preg_match('/^[\p{L}\p{N}_\-. ]*$/u', $name);
		} else {
			return preg_match('/^[A-z0-9_\-. ]*$/', $name);
		}
	}

	static public function isMailValid($address) {

		if(function_exists('filter_var')) {
			return filter_var($address, FILTER_VALIDATE_EMAIL) !== FALSE;
		} else {
			return preg_match('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$', $address);
		}
	}

	static public function checkPosition($universe, $galaxy, $system, $position)
	{
		$config	= Config::get($universe);

		return !(1 > $galaxy
			|| 1 > $system
			|| 1 > $position
			|| $config->max_galaxy < $galaxy
			|| $config->max_system < $system
			|| $config->max_planets < $position);
	}

	static public function createPlayer($universe, $userName, $userPassword, $userMail, $userLanguage = NULL, $galaxy = NULL, $system = NULL, $position = NULL, $name = NULL, $authlevel = 0, $userIpAddress = NULL, $user_secret_question_id = 0, $user_secret_question_answer = '', $child_of = false)
	{
		$config	= Config::get($universe);

		if (isset($universe, $galaxy, $system, $position))
		{
			if (self::checkPosition($universe, $galaxy, $system, $position) === false)
			{
				throw new Exception(sprintf("Try to create a planet at position: %s:%s:%s!", $galaxy, $system, $position));
			}

			if (self::isPositionFree($universe, $galaxy, $system, $position) === false)
			{
				throw new Exception(sprintf("Position is not empty: %s:%s:%s!", $galaxy, $system, $position));
			}
		} else {
			$galaxy	= $config->LastSettedGalaxyPos;
			$system = $config->LastSettedSystemPos;
			$planet	= $config->LastSettedPlanetPos;

			if($galaxy > $config->max_galaxy) {
				$galaxy	= 1;
			}

			if($system > $config->max_system) {
				$system	= 1;
			}

			do {
				$position = mt_rand(round($config->max_planets * 0.2), round($config->max_planets * 0.8));
				if ($planet < 3) {
					$planet += 1;
				} else {
					if ($system >= $config->max_system) {
						$system = 1;
						if($galaxy >= $config->max_galaxy) {
							$galaxy	= 1;
						} else {
							$galaxy += 1;
						}
					} else {
						$system += 1;
					}
				}
			} while (self::isPositionFree($universe, $galaxy, $system, $position) === false);

			// Update last coordinates to config table
			$config->LastSettedGalaxyPos = $galaxy;
			$config->LastSettedSystemPos = $system;
			$config->LastSettedPlanetPos = $planet;
		}
		if(!isset($child_of) || $child_of == false) {
			$child_of = 0;
		}

		$params			= array(
			':username'				=> $userName,
			':email'				=> $userMail,
			':email2'				=> $userMail,
			':child_of'				=> $child_of,
			':user_secret_question_id' => $user_secret_question_id,
			':user_secret_question_answer' => $user_secret_question_answer,
			':authlevel'			=> $authlevel,
			':universe'				=> $universe,
			':language'				=> $userLanguage,
			':registerAddress'		=> !empty($userIpAddress) ? $userIpAddress : Session::getClientIp(),
			':onlinetime'			=> TIMESTAMP,
			':registerTimestamp'	=> TIMESTAMP,
			':password'				=> $userPassword,
			':dpath'				=> $config->server_default_theme,
			':timezone'				=> $config->timezone,
			':nameLastChanged'		=> 0,
			':darkmatter_start'		=> $config->darkmatter_start,
		);

		$sql = 'INSERT INTO %%USERS%% SET
		`username`		= :username,
		`email`			= :email,
		`email_2`			= :email2,
		`child_of`		= :child_of,
		`user_secret_question_id` = :user_secret_question_id,
		`user_secret_question_answer` = :user_secret_question_answer,
		`authlevel`		= :authlevel,
		`universe`		= :universe,
		`lang`			= :language,
		`ip_at_reg`		= :registerAddress,
		`onlinetime`		= :onlinetime,
		`register_time`	= :registerTimestamp,
		`password`		= :password,
		`dpath`			= :dpath,
		`timezone`		= :timezone,
		`uctime`			= :nameLastChanged,
		`darkmatter`		= :darkmatter_start;';

		$db = Database::get();

		$db->insert($sql, $params);

		$userId		= $db->lastInsertId();
		$planetId	= self::createPlanet($galaxy, $system, $position, $universe, $userId, $name, true, $authlevel);

		$currentUserAmount		= $config->users_amount + 1;
		$config->users_amount	= $currentUserAmount;

		$sql = "UPDATE %%USERS%% SET
		`galaxy` = :galaxy,
		`system` = :system,
		`planet` = :position,
		`id_planet` = :planetId
		WHERE id = :userId;";

		$db->update($sql, array(
			':galaxy'	=> $galaxy,
			':system'	=> $system,
			':position'	=> $position,
			':planetId'	=> $planetId,
			':userId'	=> $userId,
		));

		$sql 	= "SELECT MAX(`total_rank`) as `rank` FROM %%USER_POINTS%% WHERE universe = :universe;";

		$rank	= $db->selectSingle($sql, array(
			':universe'	=> $universe,
		), 'rank');
		if($rank != NULL) {
			$sql = "INSERT INTO %%USER_POINTS%% SET
					`id_owner`	= :userId,
					`universe`	= :universe,
					`tech_rank`	= :rank,
					`build_rank`	= :rank,
					`defs_rank`	= :rank,
					`fleet_rank`	= :rank,
					`total_rank`	= :rank;";

			$db->insert($sql, array(
			':universe'	=> $universe,
			':userId'	=> $userId,
			':rank'		=> $rank + 1,
			));
		} else {
			$sql = "INSERT INTO %%USER_POINTS%% SET
			`id_owner`	= :userId,
			`universe`	= :universe,
			`tech_rank`	= :rank,
			`build_rank`	= :rank,
			`defs_rank`	= :rank,
			`fleet_rank`	= :rank,
			`total_rank`	= :rank;";

			$db->insert($sql, array(
			':universe'	=> $universe,
			':userId'	=> $userId,
			':rank'		=> 1,
			));
		} 
		$config->save();

		return array($userId, $planetId);
	}

	 public function duplicatePlayer($player_id, $universe) {
		// This function is used to clone a player account to a different universe
		// It will write the original player_id into the child_of column of the new player
		// The password and the e-mail will be empty, as they will be fetched from the original player

		$db = Database::get();

		
		// Check if user already has a child account in this universe
		$sql = "SELECT id FROM %%USERS%% WHERE child_of = :player_id AND universe = :universe;";
		$child = $db->selectSingle($sql, array(':player_id' => $player_id, ':universe' => $universe));

		if($child) {
			// If the user already has a child account in this universe, return the child account id
			return $child['id'];
		} else {
			// Get the parent id of the player
			$parent = $this->getParentPlayer($player_id);
			$sql = "SELECT * FROM %%USERS%% WHERE id = :player_id;";
			$player = $db->selectSingle($sql, array(':player_id' => $parent));

			$this->createPlayer($universe, $player['username'], $player['password'], $player['email'], $player['lang'],NULL,NULL,NULL, NULL, 0, $player['ip_at_reg'], $player['user_secret_question_id'], $player['user_secret_question_answer'], $player_id);
			
		}

	}

	 public function getParentPlayer($player_id) {
		// This function is used to get the parent player of a child account
		// It will return the player_id of the parent account, or 0 if the account is not a child account

		$db = Database::get();

		$sql = "SELECT child_of FROM %%USERS%% WHERE id = :player_id;";
		$child = $db->selectSingle($sql, array(':player_id' => $player_id));
		if($child['child_of'] == 0 && is_numeric($player_id)) {
			$child_of = $player_id;
		} else {
			$child_of = $child['child_of'];
		}

		return $child_of;
	}

	public function getChildPlayers($player_id, $mode = "all", $include_parent = true) {
		// This function is used to get the child players of a parent account
		// It will return an array with the player_id of the child accounts

		$db = Database::get();

		$sql = "SELECT * FROM %%USERS%% WHERE child_of = :player_id;";
		$children = $db->select($sql, array(':player_id' => $player_id));

		$parent_id = $this->getParentPlayer($player_id);
		$sql = "SELECT * FROM %%USERS%% WHERE id = :player_id;";
		$parent = $db->selectSingle($sql, array(':player_id' => $parent_id));
		
		$child_ids = array();
		foreach($children as $child) {
			if($mode == "all") {
				$child_ids[] = $child;
			}
			if($mode == "id") {
				$child_ids[] = $child['player_id'];
			}
			if($mode == "uni") {
				$child_ids[] = $child['universe'];
			}
		
		}
		if($include_parent) {
			if($mode == "all") {
				$child_ids[] = $parent;
			}
			if($mode == "id") {
				$child_ids[] = $parent['player_id'];
			}
			if($mode == "uni") {
				$child_ids[] = $parent['universe'];
			}
		}

		return $child_ids;
	}
	public function getFreeUniverses($player_id) {
		$parent_id = $this->getParentPlayer($player_id);
		$universes_original = Universe::availableUniverses();

		$child_universes = $this->getChildPlayers($parent_id, "uni");
		$universes = array();
		
		// var_dump($universes_original);
		// echo "<br>";
		// var_dump($child_universes);
		// echo "<br>";

		// Get all childs from the player

		// List all universes and then check if the player already has an account or child account in that universe
		// If not, add it to the list of available universes
		foreach($universes_original as $universe) {
			if(!in_array($universe,$child_universes)) {
				$universes[$universe] = Universe::getName($universe);
			} else {
				//$universes[] = $universe;
			}
		}
		return $universes;
	}

	public function getChildPlayerUniverse($playerID, $universeID) {
		// Fetches a connected account of a player in a specific universe
		$childs = $this->getChildPlayers($playerID);
		foreach($childs as $child) {
			if($child['universe'] == $universeID) {
				return $child['id'];
			}
		}
		return false;

		// return new Player ID
	}

	static public function updateColonyWithStartValues($planetID){

		$db = Database::get();

		$sql = "SELECT * FROM %%COLONY_SETTINGS%%;";

		$colony_settings = $db->selectSingle($sql);

		$sql = "UPDATE %%PLANETS%% SET
		`metal` = :metal_start,
		`crystal` = :crystal_start,
		`deuterium` = :deuterium_start,
		`metal_mine` = :metal_mine_start,
		`crystal_mine` = :crystal_mine_start,
		`deuterium_sintetizer` = :deuterium_mine_start,
		`solar_plant` = :solar_plant_start,
		`fusion_plant` = :fusion_plant_start,
		`robot_factory` = :robot_factory_start,
		`nano_factory` = :nano_factory_start,
		`hangar` = :hangar_start,
		`metal_store` = :metal_store_start,
		`crystal_store` = :crystal_store_start,
		`deuterium_store` = :deuterium_store_start,
		`laboratory` = :laboratory_start,
		`terraformer` = :terraformer_start,
		`university` = :university_start,
		`ally_deposit` = :ally_deposit_start,
		`silo` = :silo_start,
		`small_ship_cargo` = :small_ship_cargo_start,
		`big_ship_cargo` = :big_ship_cargo_start,
		`light_hunter` = :light_hunter_start,
		`heavy_hunter` = :heavy_hunter_start,
		`crusher` = :crusher_start,
		`battle_ship` = :battle_ship_start,
		`colonizer` = :colonizer_start,
		`recycler` = :recycler_start,
		`spy_sonde` = :spy_sonde_start,
		`bomber_ship` = :bomber_ship_start,
		`solar_satelit` = :solar_satelit_start,
		`destructor` = :destructor_start,
		`dearth_star` = :dearth_star_start,
		`battleship` = :battleship_start,
		`ev_transporter` = :ev_transporter_start,
		`star_crasher` = :star_crasher_start,
		`giga_recykler` = :giga_recykler_start,
		`dm_ship` = :dm_ship_start,
		`orbital_station` = :orbital_station_start,
		`misil_launcher` = :misil_launcher_start,
		`small_laser` = :small_laser_start,
		`big_laser` = :big_laser_start,
		`gauss_canyon` = :gauss_canyon_start,
		`ionic_canyon` = :ionic_canyon_start,
		`buster_canyon` = :buster_canyon_start,
		`small_protection_shield` = :small_protection_shield_start,
		`planet_protector` = :planet_protector_start,
		`big_protection_shield` = :big_protection_shield_start,
		`graviton_canyon` = :graviton_canyon_start,
		`interceptor_misil` = :interceptor_misil_start,
		`interplanetary_misil` = :interplanetary_misil_start
		WHERE id = :planetID;";

		Database::get()->update($sql,array(
			':metal_start' => $colony_settings['metal_start'],
			':crystal_start' => $colony_settings['crystal_start'],
			':deuterium_start' => $colony_settings['deuterium_start'],
			':metal_mine_start' => $colony_settings['metal_mine_start'],
			':crystal_mine_start' => $colony_settings['crystal_mine_start'],
			':deuterium_mine_start' => $colony_settings['deuterium_mine_start'],
			':solar_plant_start' => $colony_settings['solar_plant_start'],
			':fusion_plant_start' => $colony_settings['fusion_plant_start'],
			':robot_factory_start' => $colony_settings['robot_factory_start'],
			':nano_factory_start' => $colony_settings['nano_factory_start'],
			':hangar_start' => $colony_settings['hangar_start'],
			':metal_store_start' => $colony_settings['metal_store_start'],
			':crystal_store_start' => $colony_settings['crystal_store_start'],
			':deuterium_store_start' => $colony_settings['deuterium_store_start'],
			':laboratory_start' => $colony_settings['laboratory_start'],
			':terraformer_start' => $colony_settings['terraformer_start'],
			':university_start' => $colony_settings['university_start'],
			':ally_deposit_start' => $colony_settings['ally_deposit_start'],
			':silo_start' => $colony_settings['silo_start'],
			':small_ship_cargo_start' => $colony_settings['small_ship_cargo_start'],
			':big_ship_cargo_start' => $colony_settings['big_ship_cargo_start'],
			':light_hunter_start' => $colony_settings['light_hunter_start'],
			':heavy_hunter_start' => $colony_settings['heavy_hunter_start'],
			':crusher_start' => $colony_settings['crusher_start'],
			':battle_ship_start' => $colony_settings['battle_ship_start'],
			':colonizer_start' => $colony_settings['colonizer_start'],
			':recycler_start' => $colony_settings['recycler_start'],
			':spy_sonde_start' => $colony_settings['spy_sonde_start'],
			':bomber_ship_start' => $colony_settings['bomber_ship_start'],
			':solar_satelit_start' => $colony_settings['solar_satelit_start'],
			':destructor_start' => $colony_settings['destructor_start'],
			':dearth_star_start' => $colony_settings['dearth_star_start'],
			':battleship_start' => $colony_settings['battleship_start'],
			':ev_transporter_start' => $colony_settings['ev_transporter_start'],
			':star_crasher_start' => $colony_settings['star_crasher_start'],
			':giga_recykler_start' => $colony_settings['giga_recykler_start'],
			':dm_ship_start' => $colony_settings['dm_ship_start'],
			':orbital_station_start' => $colony_settings['orbital_station_start'],
			':misil_launcher_start' => $colony_settings['misil_launcher_start'],
			':small_laser_start' => $colony_settings['small_laser_start'],
			':big_laser_start' => $colony_settings['big_laser_start'],
			':gauss_canyon_start' => $colony_settings['gauss_canyon_start'],
			':ionic_canyon_start' => $colony_settings['ionic_canyon_start'],
			':buster_canyon_start' => $colony_settings['buster_canyon_start'],
			':small_protection_shield_start' => $colony_settings['small_protection_shield_start'],
			':planet_protector_start' => $colony_settings['planet_protector_start'],
			':big_protection_shield_start' => $colony_settings['big_protection_shield_start'],
			':graviton_canyon_start' => $colony_settings['graviton_canyon_start'],
			':interceptor_misil_start' => $colony_settings['interceptor_misil_start'],
			':interplanetary_misil_start' => $colony_settings['interplanetary_misil_start'],
			':planetID' => $planetID,
		));

	}

	static public function createPlanet($galaxy, $system, $position, $universe, $userId, $name = NULL, $isHome = false, $authlevel = 0)
	{
		global $LNG;

		if (self::checkPosition($universe, $galaxy, $system, $position) === false)
		{
			throw new Exception(sprintf("Try to create a planet at position: %s:%s:%s!", $galaxy, $system, $position));
		}

		if (self::isPositionFree($universe, $galaxy, $system, $position) === false)
		{
			throw new Exception(sprintf("Position is not empty: %s:%s:%s!", $galaxy, $system, $position));
		}

		$planetData	= array();
		require 'includes/PlanetData.php';

		$config		= Config::get($universe);

		$dataIndex		= (int) ceil($position / ($config->max_planets / count($planetData)));
		$maxTemperature	= $planetData[$dataIndex]['temp'];
		$minTemperature	= $maxTemperature - 40;

		if($isHome) {
			$maxFields				= $config->initial_fields;
		} else {
			$maxFields				= (int) floor($planetData[$dataIndex]['fields'] * $config->planet_factor);
		}

		$diameter			= (int) floor(1000 * sqrt($maxFields));

		$imageNames			= array_keys($planetData[$dataIndex]['image']);
		$imageNameType		= $imageNames[array_rand($imageNames)];
		$imageName			= $imageNameType;
		$imageName			.= 'planet';
		$imageName			.= $planetData[$dataIndex]['image'][$imageNameType] < 10 ? '0' : '';
		$imageName			.= $planetData[$dataIndex]['image'][$imageNameType];

		if(empty($name))
		{
			$name	= $isHome ? $LNG['fcm_mainplanet'] : $LNG['fcp_colony'];
		}

		$sql = "SELECT * FROM %%COLONY_SETTINGS%%;";
		$db = Database::get();
		$colony_settings = $db->selectSingle($sql);


		$params	= array(
			':name'				=> $name,
			':universe'			=> $universe,
			':userId'			=> $userId,
			':galaxy'			=> $galaxy,
			':system'			=> $system,
			':position'			=> $position,
			':updateTimestamp'	=> TIMESTAMP,
			':type'				=> 1,
			':imageName'		=> $imageName,
			':diameter'			=> $diameter,
			':maxFields'		=> $maxFields,
			':minTemperature'	=> $minTemperature,
			':maxTemperature'	=> $maxTemperature,
			':metal_start' => $colony_settings['metal_start'],
			':crystal_start' => $colony_settings['crystal_start'],
			':deuterium_start' => $colony_settings['deuterium_start'],
			':metal_mine_start' => $colony_settings['metal_mine_start'],
			':crystal_mine_start' => $colony_settings['crystal_mine_start'],
			':deuterium_mine_start' => $colony_settings['deuterium_mine_start'],
			':solar_plant_start' => $colony_settings['solar_plant_start'],
			':fusion_plant_start' => $colony_settings['fusion_plant_start'],
			':robot_factory_start' => $colony_settings['robot_factory_start'],
			':nano_factory_start' => $colony_settings['nano_factory_start'],
			':hangar_start' => $colony_settings['hangar_start'],
			':metal_store_start' => $colony_settings['metal_store_start'],
			':crystal_store_start' => $colony_settings['crystal_store_start'],
			':deuterium_store_start' => $colony_settings['deuterium_store_start'],
			':laboratory_start' => $colony_settings['laboratory_start'],
			':terraformer_start' => $colony_settings['terraformer_start'],
			':university_start' => $colony_settings['university_start'],
			':ally_deposit_start' => $colony_settings['ally_deposit_start'],
			':silo_start' => $colony_settings['silo_start'],
			':small_ship_cargo_start' => $colony_settings['small_ship_cargo_start'],
			':big_ship_cargo_start' => $colony_settings['big_ship_cargo_start'],
			':light_hunter_start' => $colony_settings['light_hunter_start'],
			':heavy_hunter_start' => $colony_settings['heavy_hunter_start'],
			':crusher_start' => $colony_settings['crusher_start'],
			':battle_ship_start' => $colony_settings['battle_ship_start'],
			':colonizer_start' => $colony_settings['colonizer_start'],
			':recycler_start' => $colony_settings['recycler_start'],
			':spy_sonde_start' => $colony_settings['spy_sonde_start'],
			':bomber_ship_start' => $colony_settings['bomber_ship_start'],
			':solar_satelit_start' => $colony_settings['solar_satelit_start'],
			':destructor_start' => $colony_settings['destructor_start'],
			':dearth_star_start' => $colony_settings['dearth_star_start'],
			':battleship_start' => $colony_settings['battleship_start'],
			':ev_transporter_start' => $colony_settings['ev_transporter_start'],
			':star_crasher_start' => $colony_settings['star_crasher_start'],
			':giga_recykler_start' => $colony_settings['giga_recykler_start'],
			':dm_ship_start' => $colony_settings['dm_ship_start'],
			':orbital_station_start' => $colony_settings['orbital_station_start'],
			':misil_launcher_start' => $colony_settings['misil_launcher_start'],
			':small_laser_start' => $colony_settings['small_laser_start'],
			':big_laser_start' => $colony_settings['big_laser_start'],
			':gauss_canyon_start' => $colony_settings['gauss_canyon_start'],
			':ionic_canyon_start' => $colony_settings['ionic_canyon_start'],
			':buster_canyon_start' => $colony_settings['buster_canyon_start'],
			':small_protection_shield_start' => $colony_settings['small_protection_shield_start'],
			':planet_protector_start' => $colony_settings['planet_protector_start'],
			':big_protection_shield_start' => $colony_settings['big_protection_shield_start'],
			':graviton_canyon_start' => $colony_settings['graviton_canyon_start'],
			':interceptor_misil_start' => $colony_settings['interceptor_misil_start'],
			':interplanetary_misil_start' => $colony_settings['interplanetary_misil_start'],
			
		);

		$sql = 'INSERT INTO %%PLANETS%% SET
		`name`		= :name,
		`universe`	= :universe,
		`id_owner`	= :userId,
		`galaxy`		= :galaxy,
		`system`		= :system,
		`planet`		= :position,
		`last_update`	= :updateTimestamp,
		`planet_type`	= :type,
		`image`		= :imageName,
		`diameter`	= :diameter,
		`field_max`	= :maxFields,
		`temp_min` 	= :minTemperature,
		`temp_max` 	= :maxTemperature,
		`metal` = :metal_start,
		`crystal` = :crystal_start,
		`deuterium` = :deuterium_start,
		`metal_mine` = :metal_mine_start,
		`crystal_mine` = :crystal_mine_start,
		`deuterium_sintetizer` = :deuterium_mine_start,
		`solar_plant` = :solar_plant_start,
		`fusion_plant` = :fusion_plant_start,
		`robot_factory` = :robot_factory_start,
		`nano_factory` = :nano_factory_start,
		`hangar` = :hangar_start,
		`metal_store` = :metal_store_start,
		`crystal_store` = :crystal_store_start,
		`deuterium_store` = :deuterium_store_start,
		`laboratory` = :laboratory_start,
		`terraformer` = :terraformer_start,
		`university` = :university_start,
		`ally_deposit` = :ally_deposit_start,
		`silo` = :silo_start,
		`small_ship_cargo` = :small_ship_cargo_start,
		`big_ship_cargo` = :big_ship_cargo_start,
		`light_hunter` = :light_hunter_start,
		`heavy_hunter` = :heavy_hunter_start,
		`crusher` = :crusher_start,
		`battle_ship` = :battle_ship_start,
		`colonizer` = :colonizer_start,
		`recycler` = :recycler_start,
		`spy_sonde` = :spy_sonde_start,
		`bomber_ship` = :bomber_ship_start,
		`solar_satelit` = :solar_satelit_start,
		`destructor` = :destructor_start,
		`dearth_star` = :dearth_star_start,
		`battleship` = :battleship_start,
		`ev_transporter` = :ev_transporter_start,
		`star_crasher` = :star_crasher_start,
		`giga_recykler` = :giga_recykler_start,
		`dm_ship` = :dm_ship_start,
		`orbital_station` = :orbital_station_start,
		`misil_launcher` = :misil_launcher_start,
		`small_laser` = :small_laser_start,
		`big_laser` = :big_laser_start,
		`gauss_canyon` = :gauss_canyon_start,
		`ionic_canyon` = :ionic_canyon_start,
		`buster_canyon` = :buster_canyon_start,
		`small_protection_shield` = :small_protection_shield_start,
		`planet_protector` = :planet_protector_start,
		`big_protection_shield` = :big_protection_shield_start,
		`graviton_canyon` = :graviton_canyon_start,
		`interceptor_misil` = :interceptor_misil_start,
		`interplanetary_misil` = :interplanetary_misil_start;';
		

		$db = Database::get();
		$db->insert($sql, $params);

		return $db->lastInsertId();
	}

	static public function createMoon($universe, $galaxy, $system, $position, $userId, $chance, $diameter = NULL, $moonName = NULL)
	{
		global $LNG;

		$db	= Database::get();

		$sql = "SELECT `id_luna`, `planet_type`, `id`, `name`, `temp_max`, `temp_min`
				FROM %%PLANETS%%
				WHERE `universe` = :universe
				AND `galaxy` = :galaxy
				AND `system` = :system
				AND `planet` = :position
				AND `planet_type` = :type;";

		$parentPlanet	= $db->selectSingle($sql, array(
	 		':universe'	=> $universe,
	 		':galaxy'	=> $galaxy,
	 		':system'	=> $system,
	 		':position'	=> $position,
	 		':type'		=> 1,
		));

		if ($parentPlanet['id_luna'] != 0)
		{
			return false;
		}

		if(is_null($diameter))
		{
			$diameter	= floor(pow(mt_rand(10, 20) + 3 * $chance, 0.5) * 1000); # New Calculation - 23.04.2011
		}

		$maxTemperature = $parentPlanet['temp_max'] - mt_rand(10, 45);
		$minTemperature = $parentPlanet['temp_min'] - mt_rand(10, 45);

		if(empty($moonName))
		{
			$moonName		= $LNG['type_planet_3'];
		}

		$sql	= "INSERT INTO %%PLANETS%% SET
		`name`				= :name,
		`id_owner`			= :owner,
		`universe`			= :universe,
		`galaxy`				= :galaxy,
		`system`				= :system,
		`planet`				= :planet,
		`last_update`			= :updateTimestamp,
		`planet_type`			= :type,
		`image`				= :image,
		`diameter`			= :diameter,
		`field_max`			= :fields,
		`temp_min`			= :minTemperature,
		`temp_max`			= :maxTemperature,
		`metal`				= :metal,
		`metal_perhour`		= :metPerHour,
		`crystal`				= :crystal,
		`crystal_perhour`		= :cryPerHour,
		`deuterium`			= :deuterium,
		`deuterium_perhour`	= :deuPerHour;";

		$db->insert($sql, array(
			':name'				=> $moonName,
			':owner'			=> $userId,
			':universe'			=> $universe,
			':galaxy'			=> $galaxy,
			':system'			=> $system,
			':planet'			=> $position,
			':updateTimestamp'	=> TIMESTAMP,
			':type'				=> 3,
			':image'			=> 'mond',
			':diameter'			=> $diameter,
			':fields'			=> 1,
			':minTemperature'	=> $minTemperature,
			':maxTemperature'	=> $maxTemperature,
			':metal'			=> 0,
			':metPerHour'		=> 0,
			':crystal'			=> 0,
			':cryPerHour'		=> 0,
			':deuterium'		=> 0,
			':deuPerHour'		=> 0,
		));

		$moonId	= $db->lastInsertId();

		$sql	= "UPDATE %%PLANETS%% SET id_luna = :moonId WHERE id = :planetId;";

		$db->update($sql, array(
			':moonId'	=> $moonId,
			':planetId'	=> $parentPlanet['id'],
		));

		return $moonId;
	}

	static public function deletePlayer($userId)
	{
		if(ROOT_USER == $userId)
		{
			// superuser can not be deleted.
			throw new Exception("Superuser #".ROOT_USER." can't be deleted!");
		}

		$db			= Database::get();
		$sql		= 'SELECT universe, ally_id FROM %%USERS%% WHERE id = :userId;';
		$userData	= $db->selectSingle($sql, array(
			':userId'	=> $userId
		));

		if (empty($userData))
		{
			return false;
		}

		if (!empty($userData['ally_id']))
		{
			$sql			= 'SELECT ally_members FROM %%ALLIANCE%% WHERE id = :allianceId;';
			$memberCount	= $db->selectSingle($sql, array(
				':allianceId'	=> $userData['ally_id']
			), 'ally_members');

			if ($memberCount > 1)
			{
				$sql	= 'UPDATE %%ALLIANCE%% SET ally_members = ally_members - 1 WHERE id = :allianceId;';
				$db->update($sql, array(
					':allianceId'	=> $userData['ally_id']
				));
			}
			else
			{
				$sql	= 'DELETE FROM %%ALLIANCE%% WHERE id = :allianceId;';
				$db->delete($sql, array(
					':allianceId'	=> $userData['ally_id']
				));

				$sql	= 'DELETE FROM %%ALLIANCE_POINTS%% WHERE id_owner = :allianceId;';
				$db->delete($sql, array(
					':allianceId'	=> $userData['ally_id'],
					':type'			=> 2
				));

				$sql	= 'UPDATE %%USER_POINTS%% SET id_ally = :resetId WHERE id_ally = :allianceId;';
				$db->update($sql, array(
				  	':allianceId'	=> $userData['ally_id'],
				  	':resetId'		=> 0
			 	));
			}
		}

		$sql	= 'DELETE FROM %%ALLIANCE_REQUEST%% WHERE userID = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
	 	));

		$sql	= 'DELETE FROM %%BUDDY%% WHERE owner = :userId OR sender = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE %%FLEETS%%, %%FLEETS_EVENT%%
		FROM %%FLEETS%% LEFT JOIN %%FLEETS_EVENT%% on fleet_id = fleetId
		WHERE fleet_owner = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE FROM %%MESSAGES%% WHERE message_owner = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE FROM %%NOTES%% WHERE owner = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE FROM %%PLANETS%% WHERE id_owner = :userId;';
		$db->delete($sql, array(
		   	':userId'	=> $userId
	  	));

		$sql	= 'DELETE FROM %%USERS%% WHERE id = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId
		));

		$sql	= 'DELETE FROM %%USER_POINTS%% WHERE id_owner = :userId;';
		$db->delete($sql, array(
			':userId'	=> $userId,
		));

		$fleetIds	= $db->select('SELECT fleet_id FROM %%FLEETS%% WHERE fleet_target_owner = :userId;', array(
			':userId'	=> $userId
		));

		foreach($fleetIds as $fleetId)
		{
			FleetFunctions::SendFleetBack(array('id' => $userId), $fleetId['fleet_id']);
		}

        /*
		$sql	= 'UPDATE %%UNIVERSE%% SET userAmount = userAmount - 1 WHERE universe = :universe;';
		$db->update($sql, array(
			':universe' => $userData['universe']
		));

		Cache::get()->flush('universe');
        */

		return true;
	}

	static public function deletePlanet($planetId)
	{
		$db			= Database::get();

		$sql		= "SELECT `id_owner`, `planet_type`, `id_luna` FROM %%PLANETS%%
		WHERE `id` = :planetId AND `id` NOT IN (SELECT `id_planet` FROM %%USERS%%);";

		$planetData = $db->selectSingle($sql, array(
			':planetId'	=> $planetId
		));

		if(empty($planetData))
		{
			throw new Exception("Can not found planet #".$planetId."!");
		}

		$sql = "SELECT `fleet_id` FROM %%FLEETS%%
		WHERE `fleet_end_id` = :planetId OR (`fleet_end_type` = 3 AND `fleet_end_id` = :moondId);";

		$fleetIds	= $db->select($sql, array(
			':planetId'	=> $planetId,
			':moondId'	=> $planetData['id_luna']
		));

		foreach($fleetIds as $fleetId)
		{
			FleetFunctions::SendFleetBack(array('id' => $planetData['id_owner']), $fleetId['fleet_id']);
		}

		if ($planetData['planet_type'] == 3) {
			$sql	= "DELETE FROM %%PLANETS%% WHERE `id` = :planetId;";
			$db->delete($sql, array(
				':planetId'	=> $planetId
			));

			$sql	= "UPDATE %%PLANETS%% SET `id_luna` = :resetId WHERE `id_luna` = :planetId;";
			$db->update($sql, array(
				':resetId'	=> 0,
				':planetId'	=> $planetId
			));
		} else {
			$sql	= "DELETE FROM %%PLANETS%% WHERE `id` = :planetId OR `id_luna` = :planetId;";
			$db->delete($sql, array(
			   ':planetId'	=> $planetId
			));
		}

		return true;
	}

	static public function maxPlanetCount($USER)
	{
		global $resource;
		$config	= Config::get($USER['universe']);

		$planetPerTech	= $config->planets_tech;
		$planetPerBonus	= $config->planets_officier;

		if($config->min_player_planets == 0)
		{
			$planetPerTech = 999;
		}

		if($config->min_player_planets == 0)
		{
			$planetPerBonus = 999;
		}

		// http://owiki.de/index.php/Astrophysik#.C3.9Cbersicht
		return (int) ceil($config->min_player_planets + min($planetPerTech, $USER[$resource[124]] * $config->planets_per_tech) + min($planetPerBonus, $USER['factor']['Planets']));
	}

	static public function allowPlanetPosition($position, $USER)
	{
		// http://owiki.de/index.php/Astrophysik#.C3.9Cbersicht

		global $resource;
		$config	= Config::get($USER['universe']);

		switch($position) {
			case 1:
			case ($config->max_planets):
				return $USER[$resource[124]] >= 8;
			break;
			case 2:
			case ($config->max_planets-1):
				return $USER[$resource[124]] >= 6;
			break;
			case 3:
			case ($config->max_planets-2):
				return $USER[$resource[124]] >= 4;
			break;
			default:
				return $USER[$resource[124]] >= 1;
			break;
		}
	}

	static public function sendMessage($userId, $senderId, $senderName, $messageType, $subject, $text, $time, $parentID = NULL, $unread = 1, $universe = NULL)
	{
		if(is_null($universe))
		{
			$universe = Universe::current();
		}

		$db = Database::get();

		$sql = "INSERT INTO %%MESSAGES%% SET
		`message_owner`		= :userId,
		`message_sender`		= :sender,
		`message_time`		= :messageTime,
		`message_type`		= :type,
		`message_from`		= :messageFrom,
		`message_subject` 	= :subject,
		`message_text`		= :messageText,
		`message_unread`		= :unread,
		`message_universe` 	= :universe;";

		$db->insert($sql, array(
			':userId'	=> $userId,
			':sender'	=> $senderId,
			':messageTime' => $time,
			':type'		=> $messageType,
			':messageFrom' => $senderName,
			':subject'	=> $subject,
			':messageText' => $text,
			':unread'	=> $unread,
			':universe'	=> $universe,
		));
	}
}
