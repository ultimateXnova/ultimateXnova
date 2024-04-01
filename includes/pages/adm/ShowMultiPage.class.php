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
class ShowMultiPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){
		global $LNG;
		
		$db = Database::get();

		$sql = "SELECT id, username, email, register_time, onlinetime, user_lastip, IFNULL(multiID, 0) as isKnown
		FROM %%USERS%% LEFT JOIN %%MULTI%% ON userID = id
		WHERE `universe` = :universe AND user_lastip IN (SELECT user_lastip FROM %%USERS%% WHERE `universe` = :universe GROUP BY user_lastip HAVING COUNT(*)>1) ORDER BY user_lastip, id ASC;";

		$Query	= $db->select($sql,array(
			':universe' => Universe::getEmulated()
		));

		$IPs	= array();
		foreach($Query as $Data) {
			if(!isset($IPs[$Data['user_lastip']]))
				$IPs[$Data['user_lastip']]	= array();

			$Data['register_time']	= _date($LNG['php_tdformat'], $Data['register_time']);
			$Data['onlinetime']		= _date($LNG['php_tdformat'], $Data['onlinetime']);

			$IPs[$Data['user_lastip']][$Data['id']]	= $Data;
		}

		$this->assign(array(
			'multiGroups'	=> $IPs,
		));

		$this->display('page.multi.default.tpl');

	}

	function known(){
		$db = Database::get();

		$sql = "INSERT INTO %%MULTI%% SET userID = :userID;";

		$db->insert($sql,array(
			':userID' => HTTP::_GP('id',0)
		));

		$this->show();
	}

	function unknown(){
		$db = Database::get();

		$sql = "DELETE FROM %%MULTI%% WHERE userID = :userID;";

		$db->delete($sql,array(
			':userID' => HTTP::_GP('id',0)
		));

		$this->show();

	}

}
