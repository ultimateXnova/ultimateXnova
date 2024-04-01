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

$token	= getRandomString();
$db		= Database::get();

$fleetResult	= $db->update("UPDATE %%FLEETS_EVENT%% SET `lock` = :token WHERE `lock` IS NULL AND `time` <= :time;", array(
	':time'		=> TIMESTAMP,
	':token'	=> $token
));

if($db->rowCount() !== 0) {
	require 'includes/classes/class.FlyingFleetHandler.php';

	$fleetObj	= new FlyingFleetHandler();
	$fleetObj->setToken($token);
	$fleetObj->run();

	$db->update("UPDATE %%FLEETS_EVENT%% SET `lock` = NULL WHERE `lock` = :token;", array(
		':token' => $token
	));
}
