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

class MissionCaseStay extends MissionFunctions implements Mission
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}

	function TargetEvent()
	{
		$sql				= 'SELECT * FROM %%USERS%% WHERE id = :userId;';
		$senderUser			= Database::get()->selectSingle($sql, array(
			':userId'	=> $this->_fleet['fleet_owner']
		));

		$senderUser['factor']	= getFactors($senderUser, 'basic', $this->_fleet['fleet_start_time']);

		$fleetArray			= FleetFunctions::unserialize($this->_fleet['fleet_array']);
		$duration			= $this->_fleet['fleet_start_time'] - $this->_fleet['start_time'];

		$SpeedFactor    	= FleetFunctions::GetGameSpeedFactor();
		$distance			= FleetFunctions::GetTargetDistance(
			array($this->_fleet['fleet_start_galaxy'], $this->_fleet['fleet_start_system'], $this->_fleet['fleet_start_planet']),
			array($this->_fleet['fleet_end_galaxy'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet'])
		);

		$consumption   		= FleetFunctions::GetFleetConsumption($fleetArray, $duration, $distance, $senderUser, $SpeedFactor);

		$this->UpdateFleet('fleet_resource_deuterium', $this->_fleet['fleet_resource_deuterium'] + $consumption / 2);

		$LNG				= $this->getLanguage($senderUser['lang']);
		$TargetUserID       = $this->_fleet['fleet_target_owner'];
		$TargetMessage      = sprintf($LNG['sys_stat_mess'], GetTargetAddressLink($this->_fleet, ''), pretty_number($this->_fleet['fleet_resource_metal']), $LNG['tech'][901], pretty_number($this->_fleet['fleet_resource_crystal']), $LNG['tech'][902], pretty_number($this->_fleet['fleet_resource_deuterium']), $LNG['tech'][903]);

		PlayerUtil::sendMessage($TargetUserID, 0, $LNG['sys_mess_tower'], 5,
			$LNG['sys_stat_mess_stay'], $TargetMessage, $this->_fleet['fleet_start_time'], NULL, 1, $this->_fleet['fleet_universe']);

		$this->RestoreFleet(false);
	}

	function EndStayEvent()
	{
		return;
	}

	function ReturnEvent()
	{
		$LNG				= $this->getLanguage(NULL, $this->_fleet['fleet_owner']);

		$Message     		= sprintf($LNG['sys_stat_mess'],
			GetStartAddressLink($this->_fleet, ''),
			pretty_number($this->_fleet['fleet_resource_metal']), $LNG['tech'][901],
			pretty_number($this->_fleet['fleet_resource_crystal']), $LNG['tech'][902],
			pretty_number($this->_fleet['fleet_resource_deuterium']), $LNG['tech'][903]
		);

		PlayerUtil::sendMessage($this->_fleet['fleet_owner'], 0, $LNG['sys_mess_tower'], 4, $LNG['sys_mess_fleetback'],
			$Message, $this->_fleet['fleet_end_time'], NULL, 1, $this->_fleet['fleet_universe']);

		$this->RestoreFleet();
	}
}
