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
class ShowActivePage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG, $USER;

		$db = Database::get();

		$sql = "SELECT * FROM %%USERS_VALID%% WHERE `universe` = :universe ORDER BY validationID ASC;";

		$usersValid = $db->select($sql,array(
			':universe' => Universe::getEmulated(),
		));


		$users 	= array();
		foreach ($usersValid as $currentUser) {
			$users[]	= array(
				'id'			=> $currentUser['validationID'],
				'name'			=> $currentUser['userName'],
				'username'		=> $currentUser['userName'],
				'date'			=> _date($LNG['php_tdformat'], $currentUser['date'], $USER['timezone']),
				'email'			=> $currentUser['email'],
				'ip'			=> $currentUser['ip'],
				'password'		=> $currentUser['password'],
				'validationKey'	=> $currentUser['validationKey'],
			);
		}


		$this->assign(array(
			'Users'				=> $users,
			'uni'				=> Universe::getEmulated(),
		));

		$this->display('page.active.default.tpl');

	}

	function delete(){

		$sql = "DELETE FROM %%USERS_VALID% WHERE `validationID` = :validationID AND `universe` = :universe;";

		$db = Database::get();

		$id = HTTP::_GP('id', 0);

		$db->delete($sql,array(
			':validationID' => $id,
			':universe' => Universe::getEmulated()
		));

		$this->printMessage('deleted successfully !');

	}

}
