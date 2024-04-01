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


/**
 *
 */
class ShowFleetsPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG, $USER;
		$db = Database::get();

		$sql = "SELECT
		fleet.*,
		event.`lock`,
		COUNT(event.fleetID) as error,
		pstart.name as startPlanetName,
		ptarget.name as targetPlanetName,
		ustart.username as startUserName,
		utarget.username as targetUserName,
		acs.name as acsName
		FROM %%FLEETS%% fleet
		LEFT JOIN %%FLEETS_EVENT%% event ON fleetID = fleet_id
		LEFT JOIN %%PLANETS%% pstart ON pstart.id = fleet_start_id
		LEFT JOIN %%PLANETS%% ptarget ON ptarget.id = fleet_end_id
		LEFT JOIN %%USERS%% ustart ON ustart.id = fleet_owner
		LEFT JOIN %%USERS%% utarget ON utarget.id = fleet_target_owner
		LEFT JOIN %%AKS%% acs ON acs.id = fleet_group
		WHERE fleet_universe = :universe
		GROUP BY event.fleetID
		ORDER BY fleet_id;";

		$fleetResult	= $db->select($sql,array(
			':universe' => Universe::getEmulated(),
		));


		$FleetList	= array();

		foreach($fleetResult as $fleetRow) {
			$shipList		= array();
			$shipArray		= array_filter(explode(';', $fleetRow['fleet_array']));
			foreach($shipArray as $ship) {
				$shipDetail		= explode(',', $ship);
				$shipList[$shipDetail[0]]	= $shipDetail[1];
			}

			$FleetList[]	= array(
				'fleetID'				=> $fleetRow['fleet_id'],
				'lock'					=> !empty($fleetRow['lock']),
				'count'					=> $fleetRow['fleet_amount'],
				'error'					=> !$fleetRow['error'],
				'ships'					=> $shipList,
				'state'					=> $fleetRow['fleet_mess'],
				'starttime'				=> _date($LNG['php_tdformat'], $fleetRow['start_time'], $USER['timezone']),
				'arrivaltime'			=> _date($LNG['php_tdformat'], $fleetRow['fleet_start_time'], $USER['timezone']),
				'stayhour'				=> round(($fleetRow['fleet_end_stay'] - $fleetRow['fleet_start_time']) / 3600),
				'staytime'				=> $fleetRow['fleet_start_time'] !== $fleetRow['fleet_end_stay'] ? _date($LNG['php_tdformat'], $fleetRow['fleet_end_stay'], $USER['timezone']) : 0,
				'endtime'				=> _date($LNG['php_tdformat'], $fleetRow['fleet_end_time'], $USER['timezone']),
				'missionID'				=> $fleetRow['fleet_mission'],
				'acsID'					=> $fleetRow['fleet_group'],
				'acsName'				=> $fleetRow['acsName'],
				'startUserID'			=> $fleetRow['fleet_owner'],
				'startUserName'			=> $fleetRow['startUserName'],
				'startPlanetID'			=> $fleetRow['fleet_start_id'],
				'startPlanetName'		=> $fleetRow['startPlanetName'],
				'startPlanetGalaxy'		=> $fleetRow['fleet_start_galaxy'],
				'startPlanetSystem'		=> $fleetRow['fleet_start_system'],
				'startPlanetPlanet'		=> $fleetRow['fleet_start_planet'],
				'startPlanetType'		=> $fleetRow['fleet_start_type'],
				'targetUserID'			=> $fleetRow['fleet_target_owner'],
				'targetUserName'		=> $fleetRow['targetUserName'],
				'targetPlanetID'		=> $fleetRow['fleet_end_id'],
				'targetPlanetName'		=> $fleetRow['targetPlanetName'],
				'targetPlanetGalaxy'	=> $fleetRow['fleet_end_galaxy'],
				'targetPlanetSystem'	=> $fleetRow['fleet_end_system'],
				'targetPlanetPlanet'	=> $fleetRow['fleet_end_planet'],
				'targetPlanetType'		=> $fleetRow['fleet_end_type'],
				'resource'				=> array(
					901	=> $fleetRow['fleet_resource_metal'],
					902	=> $fleetRow['fleet_resource_crystal'],
					903	=> $fleetRow['fleet_resource_deuterium'],
					921	=> $fleetRow['fleet_resource_darkmatter'],
				),
			);
		}



		$this->assign(array(
			'FleetList'			=> $FleetList,
		));

		$this->display('page.fleets.default.tpl');

	}


	function lock(){
		$id	= HTTP::_GP('id', 0);

		$lock	= HTTP::_GP('lock', 0);

		$db = Database::get();

		$sql = "UPDATE %%FLEETS%% SET `fleet_busy` = :lock WHERE `fleet_id` = :id AND `fleet_universe` = :universe;";

		$db->update($sql,array(
			':lock' => $lock,
			':id' => $id,
			':universe' => Universe::getEmulated()
		));

		$SQL	= ($lock == 0) ? "NULL" : "'ADM_LOCK'";

		if ($lock == 0) {
			$sql = "UPDATE %%FLEETS_EVENT%% SET `lock` = NULL WHERE `fleetID` = :id;";
		}else {
			$sql = "UPDATE %%FLEETS_EVENT%% SET `lock` = 'ADM_LOCK' WHERE `fleetID` = :id;";
		}



		$db->update($sql,array(
			':id' => $id
		));

		$this->show();

	}

}


require 'includes/classes/class.FlyingFleetsTable.php';

function ShowFlyingFleetPage()
{

}
