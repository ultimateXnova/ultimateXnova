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
class ShowCreatePage extends AbstractAdminPage
{


	function __construct()
	{
		parent::__construct();


	}



	function show(){

		$this->assign(array(

		));

		$this->display('page.create.default.tpl');

	}

	function user(){

		global $LNG, $USER;

		$AUTH			= array();
		$AUTH[AUTH_USR]	= $LNG['user_level_'.AUTH_USR];

		if($USER['authlevel'] >= AUTH_OPS)
			$AUTH[AUTH_OPS]	= $LNG['user_level_'.AUTH_OPS];

		if($USER['authlevel'] >= AUTH_MOD)
			$AUTH[AUTH_MOD]	= $LNG['user_level_'.AUTH_MOD];

		if($USER['authlevel'] >= AUTH_ADM)
			$AUTH[AUTH_ADM]	= $LNG['user_level_'.AUTH_ADM];


		$this->assign(array(
			'admin_auth'			=> $USER['authlevel'],
			'Selector'				=> array('auth' => $AUTH, 'lang' => $LNG->getAllowedLangs(false)),
		));

		$this->display('page.create.user.tpl');

	}

	function createUser(){

		global $LNG;
		$LNG->includeData(array('PUBLIC'));

		$db = Database::get();

		$UserName 	= HTTP::_GP('name', '', UTF8_SUPPORT);
		$UserPass 	= HTTP::_GP('password', '');
		$UserPass2 	= HTTP::_GP('password2', '');
		$UserMail 	= HTTP::_GP('email', '');
		$UserMail2	= HTTP::_GP('email2', '');
		$UserAuth 	= HTTP::_GP('authlevel', 0);
		$Galaxy 	= HTTP::_GP('galaxy', 0);
		$System 	= HTTP::_GP('system', 0);
		$Planet 	= HTTP::_GP('planet', 0);
		$Language 	= HTTP::_GP('lang', '');

		$sql = "SELECT (SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND username = :UserName) +
		(SELECT COUNT(*) FROM %%USERS_VALID%% WHERE universe = :universe AND username = :UserName) as count;";

		$ExistsUser 	= $db->selectSingle($sql,array(
			':universe' => Universe::getEmulated(),
			':UserName' => $UserName
		),'count');


		$sql = "SELECT (SELECT COUNT(*) FROM %%USERS%% WHERE universe = :universe AND (email = :UserMail OR email_2 = :UserMail)) +
		(SELECT COUNT(*) FROM %%USERS_VALID%% WHERE universe = :universe AND email = :UserMail) as count;";

		$ExistsMails	= $db->selectSingle($sql,array(
			':universe' => Universe::getEmulated(),
			':UserMail' => $UserMail,
		),'count');

		$errors	= "";

		$config	= Config::get(Universe::getEmulated());

		if (!PlayerUtil::isMailValid($UserMail))
			$errors .= $LNG['invalid_mail_adress'];

		if (empty($UserName))
			$errors .= $LNG['empty_user_field'];

		if (strlen($UserPass) < 6)
			$errors .= $LNG['password_lenght_error'];

		if ($UserPass != $UserPass2)
			$errors .= $LNG['different_passwords'];

		if ($UserMail != $UserMail2)
			$errors .= $LNG['different_mails'];

		if (!PlayerUtil::isNameValid($UserName))
			$errors .= $LNG['user_field_specialchar'];

		if ($ExistsUser != 0)
			$errors .= $LNG['user_already_exists'];

		if ($ExistsMails != 0)
			$errors .= $LNG['mail_already_exists'];

		if (!PlayerUtil::isPositionFree(Universe::getEmulated(), $Galaxy, $System, $Planet)) {
			$errors .= $LNG['planet_already_exists'];
		}

		if ($Galaxy > $config->max_galaxy || $System > $config->max_system || $Planet > $config->max_planets) {
			$errors .= $LNG['po_complete_all2'];
		}

		$redirectButton = array();
		$redirectButton[] = array(
			'url' => 'admin.php?page=create&mode=user',
			'label' => $LNG['uvs_back']
		);

		if (!empty($errors)) {
			$this->printMessage($errors,$redirectButton);
		}

		$Language	= array_key_exists($Language, $LNG->getAllowedLangs(false)) ? $Language : $config->lang;

		PlayerUtil::createPlayer(Universe::getEmulated(), $UserName,
			PlayerUtil::cryptPassword($UserPass), $UserMail, $Language, $Galaxy, $System, $Planet,
			$LNG['fcm_planet'], $UserAuth);




		$this->printMessage($LNG['new_user_success'],$redirectButton);

	}


	function moon(){

		global $USER, $LNG;

		$this->assign(array(
			'admin_auth'			=> $USER['authlevel'],

		));

		$this->display('page.create.moon.tpl');

	}

	function createMoon(){
		global $LNG;
		$PlanetID  	= HTTP::_GP('add_moon', 0);
		$MoonName  	= HTTP::_GP('name', '', UTF8_SUPPORT);
		$Diameter	= HTTP::_GP('diameter', 0);

		$sql = "SELECT temp_max, temp_min, id_luna, galaxy, `system`, planet, planet_type, destruyed, id_owner FROM %%PLANETS%% WHERE id = :PlanetID AND universe = :universe AND planet_type = '1' AND destruyed = '0';";

		$MoonPlanet = Database::get()->selectSingle($sql,array(
			':PlanetID' => $PlanetID,
			':universe' => Universe::getEmulated()
		));

		$redirectButton = array();
		$redirectButton[] = array(
			'url' => 'admin.php?page=create&mode=moon',
			'label' => $LNG['uvs_back']
		);

		if (!$MoonPlanet) {
			$this->printMessage($LNG['mo_planet_doesnt_exist'], $redirectButton);
		}

		$moonId	= PlayerUtil::createMoon(Universe::getEmulated(), $MoonPlanet['galaxy'], $MoonPlanet['system'],
			$MoonPlanet['planet'], $MoonPlanet['id_owner'], 20,
			(($_POST['diameter_check'] == 'on') ? NULL : $Diameter), $MoonName);



		if($moonId !== false)
		{
			$this->printMessage($LNG['mo_moon_added'], $redirectButton);
		}
		else
		{
			$this->printMessage($LNG['mo_moon_unavaible'], $redirectButton);
		}

	}

	function planet(){

		global $USER, $LNG;

		$this->assign(array(
			'admin_auth'			=> $USER['authlevel'],
		));

		$this->display('page.create.planet.tpl');

	}

	function createPlanet(){
		global $LNG;

		$id          = HTTP::_GP('id', 0);
		$Galaxy      = HTTP::_GP('galaxy', 0);
		$System      = HTTP::_GP('system', 0);
		$Planet      = HTTP::_GP('planet', 0);
		$name        = HTTP::_GP('name', '', UTF8_SUPPORT);
		$field_max   = HTTP::_GP('field_max', 0);

		$config			= Config::get(Universe::getEmulated());

		if ($Galaxy > $config->max_galaxy || $System > $config->max_system || $Planet > $config->max_planets) {
			$this->printMessage($LNG['po_complete_all2']);
		}

		$sql = "SELECT id, authlevel FROM %%USERS%% WHERE id = :id AND universe = :universe;";

		$ISUser = Database::get()->selectSingle($sql,array(
			':id' => $id,
			':universe' => Universe::getEmulated()
		));

		if(!PlayerUtil::checkPosition(Universe::getEmulated(), $Galaxy, $System, $Planet) || !isset($ISUser)) {
			$this->printMessage($LNG['po_complete_all']);
		}


		$redirectButton = array();
		$redirectButton[] = array(
			'url' => 'admin.php?page=create&mode=planet',
			'label' => $LNG['uvs_back']
		);

		try {
			$planetId	= PlayerUtil::createPlanet($Galaxy, $System, $Planet, Universe::getEmulated(), $id, NULL, false, $ISUser['authlevel']);
		} catch (\Exception $e) {
			$errorMessage = $e->getMessage();
			$this->printMessage($errorMessage,$redirectButton);
		}



		if ($field_max > 0){
			$sql = "UPDATE %%PLANETS%% SET field_max = :field_max WHERE id = :planetId;";

			Database::get()->update($sql,array(
				':field_max' => $field_max,
				':planetId' => $planetId
			));

		}

		if (!empty($name)){
			$sql = "UPDATE %%PLANETS%% SET name = :name WHERE id = :planetId;";

			Database::get()->update($sql,array(
				':name' => $name,
				':planetId' => $planetId
			));

		}


		$this->printMessage($LNG['po_complete_succes']);

	}


}


function ShowCreatorPage()
{
	global $LNG, $USER;

	$template	= new template();
	$db = Database::get();

	if(empty($_GET['mode'])) { $_GET['mode'] = $_GET['page']; }
	switch ($_GET['mode'])
	{

		case 'moon':
			if ($_POST)
			{

			}

			$template->assign_vars(array(
				'admin_auth'			=> $USER['authlevel'],
				'universum'				=> $LNG['mu_universe'],
				'po_add_moon'			=> $LNG['po_add_moon'],
				'input_id_planet'		=> $LNG['input_id_planet'],
				'mo_moon_name'			=> $LNG['mo_moon_name'],
				'mo_diameter'			=> $LNG['mo_diameter'],
				'mo_temperature'		=> $LNG['mo_temperature'],
				'mo_fields_avaibles'	=> $LNG['mo_fields_avaibles'],
				'button_add'			=> $LNG['button_add'],
				'new_creator_refresh'	=> $LNG['new_creator_refresh'],
				'mo_moon'				=> $LNG['fcm_moon'],
				'new_creator_go_back'	=> $LNG['new_creator_go_back'],
			));

			$template->show('CreatePageMoon.tpl');
		break;
		case 'planet':
			if ($_POST)
			{

			}


		break;
		default:

		break;
	}
}
