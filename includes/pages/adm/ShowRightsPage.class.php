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

// TODO: REWORK rights and listing

/**
 *
 */
class ShowRightsPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG, $USER;

		$type = HTTP::_GP('type','');

		switch ($type) {
			case 'adm':
			$WHEREUSERS	=	"AND `authlevel` = '".AUTH_ADM."'";
				break;
			case 'ope':
			$WHEREUSERS	=	"AND `authlevel` = '".AUTH_OPS."'";
				break;
			case 'mod':
			$WHEREUSERS	=	"AND `authlevel` = '".AUTH_MOD."'";
				break;
			case 'pla':
			$WHEREUSERS	=	"AND `authlevel` = '".AUTH_USR."'";
				break;
			default:
			$WHEREUSERS = "";
				break;
		}

		$this->tplObj->loadscript('./scripts/game/filterlist.js');

		$sql = "SELECT `id`, `username`, `authlevel` FROM %%USERS%% WHERE `universe` = :universe ".$WHEREUSERS.";";

		$QueryUsers	=	Database::get()->select($sql,array(
			':universe' => Universe::getEmulated()
		));

		$UserList	= "";
		foreach ($QueryUsers as $currentQueryUser) {
			$UserList	.=	'<option value="'.$currentQueryUser['id'].'">'.$currentQueryUser['username'].'&nbsp;&nbsp;('.$LNG['rank_'.$currentQueryUser['authlevel']].')</option>';
		}

		$this->assign(array(
			'Selector'					=> array(0 => $LNG['rank_0'], 1 => $LNG['rank_1'], 2 => $LNG['rank_2'], 3 => $LNG['rank_3']),
			'UserList'					=> $UserList,
			'sid'						=> session_id(),
		));

		$this->display('page.rights.default.tpl');

	}


	function rights(){

		global $USER;

		$db = Database::get();

		$id			= HTTP::_GP('id_1', 0);

		if($USER['id'] != ROOT_USER && $id == ROOT_USER) {
			$this->printMessage($LNG['ad_authlevel_error_3'], '?page=rights&mode=rights&sid='.session_id());
		}

		if(!isset($_POST['rights'])) {
			$_POST['rights']	= array();
		}

		if($_POST['action'] == 'send') {
			$GLOBALS['DATABASE']->query("UPDATE ".USERS." SET `rights` = '".serialize(array_map('intval', $_POST['rights']))."' WHERE `id` = '".$id."';");
		}


		$sql = "SELECT rights FROM %%USERS%% WHERE id = :userId;";

		$Rights = $db->selectSingle($sql,array(
			':userId' => $id
		));

		if(($Rights['rights'] = unserialize($Rights['rights'])) === false) {
			$Rights['rights']	= array();
		}

		$Files	= array_map('prepare', array_diff(scandir('includes/pages/adm/'), array('.', '..', '.svn', 'index.html', '.htaccess', 'ShowIndexPage.php', 'ShowOverviewPage.php', 'ShowMenuPage.php', 'ShowTopnavPage.php')));

		$this->assign(array(
			'Files'						=> $Files,
			'Rights'					=> $Rights['rights'],
			'id'						=> $id,
			'yesorno'					=> array(1 => $LNG['one_is_yes_1'], 0 => $LNG['one_is_yes_0']),
			'ad_authlevel_title'		=> $LNG['ad_authlevel_title'],
			'button_submit'				=> $LNG['button_submit'],
			'sid'						=> session_id(),
		));

		$this->display('ModerrationRightsPostPage.tpl');

	}



	function users(){

		global $LNG;

		$this->tplObj->loadscript('./scripts/game/filterlist.js');

		$type = HTTP::_GP('type','');

		switch ($type) {
			case 'adm':
			$WHEREUSERS	=	"AND `authlevel` = '".AUTH_ADM."'";
				break;
			case 'ope':
			$WHEREUSERS	=	"AND `authlevel` = '".AUTH_OPS."'";
				break;
			case 'mod':
			$WHEREUSERS	=	"AND `authlevel` = '".AUTH_MOD."'";
				break;
			case 'pla':
			$WHEREUSERS	=	"AND `authlevel` = '".AUTH_USR."'";
				break;
			default:
			$WHEREUSERS = "";
				break;
		}







		$QueryUsers	=	$GLOBALS['DATABASE']->query("SELECT `id`, `username`, `authlevel` FROM ".USERS." WHERE `universe` = '".Universe::getEmulated()."'".$WHEREUSERS.";");

		$UserList	= "";
		while ($List = $GLOBALS['DATABASE']->fetch_array($QueryUsers)) {
			$UserList	.=	'<option value="'.$List['id'].'">'.$List['username'].'&nbsp;&nbsp;('.$LNG['rank_'.$List['authlevel']].')</option>';
		}

		$this->assign(array(
			'Selector'					=> array(0 => $LNG['rank_0'], 1 => $LNG['rank_1'], 2 => $LNG['rank_2'], 3 => $LNG['rank_3']),
			'UserList'					=> $UserList,
			'ad_authlevel_title'		=> $LNG['ad_authlevel_title'],
			'bo_select_title'			=> $LNG['bo_select_title'],
			'button_submit'				=> $LNG['button_submit'],
			'button_deselect'			=> $LNG['button_deselect'],
			'button_filter'				=> $LNG['button_filter'],
			'ad_authlevel_insert_id'	=> $LNG['ad_authlevel_insert_id'],
			'ad_authlevel_auth'			=> $LNG['ad_authlevel_auth'],
			'ad_authlevel_aa'			=> $LNG['ad_authlevel_aa'],
			'ad_authlevel_oo'			=> $LNG['ad_authlevel_oo'],
			'ad_authlevel_mm'			=> $LNG['ad_authlevel_mm'],
			'ad_authlevel_jj'			=> $LNG['ad_authlevel_jj'],
			'ad_authlevel_tt'			=> $LNG['ad_authlevel_tt'],
			'sid'						=> session_id(),
		));

		$this->display('page.search.users.tpl');


	}

	function usersSend(){
		global $USER, $LNG;

		$id			= HTTP::_GP('id_1', 0);
		$authlevel	= HTTP::_GP('authlevel', 0);

		if($id == 0)
			$id	= HTTP::_GP('id_2', 0);

		if($USER['id'] != ROOT_USER && $id == ROOT_USER) {
			$this->printMessage($LNG['ad_authlevel_error_3']);
		}

		$db = Database::get();

		$sql = "UPDATE %%USERS%% SET `authlevel` = :authlevel WHERE `id` = :userId;";

		$db->update($sql,array(
			':authlevel' => HTTP::_GP('authlevel', 0),
			':userId' => $id
		));

		$this->printMessage($LNG['ad_authlevel_succes']);

	}


}
