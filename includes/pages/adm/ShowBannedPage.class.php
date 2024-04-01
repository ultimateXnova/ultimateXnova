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


// TODO: %%BANNED%% table don't have user_id column so ban system works with username instead of id,
// add user_id for %%BANNED%% table, and rework ban system

/**
 *
 */
class ShowBannedPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){
		global $LNG, $USER;

		$db = Database::get();

		$orderType = HTTP::_GP('order','id');

		if (!in_array($orderType, array('id','username'))) {
			$this->printMessage('Wrong order type !');
		}

		$whereType = HTTP::_GP('view','');

		$whereText = "";
		if ($whereType == "banned") {
			$whereText = " AND `bana` = '1' ";
		}

		$sql = "SELECT `username`, `id`, `bana` FROM %%USERS%%
		WHERE `id` != 1 AND `authlevel` <= :authlevel AND `universe` = :universe " . $whereText . " ORDER BY " . $orderType . " ASC;";

		$userList = $db->select($sql,array(
			':authlevel' => $USER['authlevel'],
			':universe' => Universe::getEmulated(),
		));

		$userSelect	= array('List' => '', 'ListBan' => '');

		foreach ($userList as $currentUser)
		{
			$userSelect['List']	.=	'<option value="'.$currentUser['id'].'">'.$currentUser['username'].'&nbsp;&nbsp;(ID:&nbsp;'.$currentUser['id'].')'.(($currentUser['bana']	==	'1') ? $LNG['bo_characters_suus'] : '').'</option>';
		}


		$ORDER2 = (HTTP::_GP('order2','') == 'id') ? "id" : "username";


		$sql = "SELECT `username`,`id` FROM %%USERS%% WHERE `bana` = '1' AND `universe` = :universe ORDER BY " . $ORDER2 . " ASC;";


		$UserListBan = $db->select($sql,array(
			':universe' => Universe::getEmulated()
		));

		foreach ($UserListBan as $currentBannedUser)
		{
			$userSelect['ListBan']	.=	'<option value="'.$currentBannedUser['username'].'">'.$currentBannedUser['username'].'&nbsp;&nbsp;(ID:&nbsp;'.$currentBannedUser['id'].')</option>';
		}


		$this->tplObj->loadscript('./scripts/game/filterlist.js');


		$Name	= HTTP::_GP('ban_name', '', true);

		$sql = "SELECT b.theme, b.longer, u.id, u.urlaubs_modus, u.banaday FROM %%USERS%% as u
		LEFT JOIN %%BANNED%% as b ON u.`username` = b.`who` WHERE u.`username` = :Name AND u.`universe` = :universe;";


		$BANUSER	= $db->selectSingle($sql,array(
			':Name' => $Name,
			':universe' => Universe::getEmulated()
		));


		$this->assign(array(
			'UserSelect'		=> $userSelect,
			'usercount'			=> count($userList),
			'bancount'			=> count($UserListBan),
		));

		$this->display('page.banned.default.tpl');

	}

	function unbanUser(){

		global $LNG;

		$Name	= HTTP::_GP('unban_name', '', true);

		$sql = "UPDATE %%USERS%% SET bana = '0', banaday = '0'
						WHERE username = :Name AND `universe` = :universe;";

		$db = Database::get();

		$db->update($sql,array(
			':Name' => $Name,
			':universe' => Universe::getEmulated()
		));

		$sql = "DELETE FROM %%BANNED%% WHERE who = :Name AND `universe` = :universe";

		$db->delete($sql,array(
			':Name' => $Name,
			':universe' => Universe::getEmulated()
		));

		#;
		$this->printMessage($LNG['bo_the_player2'].$Name.$LNG['bo_unbanned']);

	}

	function banUser(){

		global $USER, $LNG;

		$Name              = HTTP::_GP('ban_name', '' ,true);
		$reas              = HTTP::_GP('ban_reason', '' ,true);
		$days              = HTTP::_GP('days', 0);
		$hour              = HTTP::_GP('hour', 0);
		$mins              = HTTP::_GP('mins', 0);
		$secs              = HTTP::_GP('secs', 0);
		$admin             = $USER['username'];
		$mail              = $USER['email'];
		$BanTime           = $days * 86400 + $hour * 3600 + $mins * 60 + $secs;
		$banPermanently = (HTTP::_GP('ban_permanently','') == "on" ) ? 1 : 0;
		$targetUserID = HTTP::_GP('target_id',0);

		$db = Database::get();

		$sql = "SELECT u.username,u.urlaubs_modus,u.banaday,u.id as user_id,b.* FROM %%USERS%% as u
		LEFT JOIN %%BANNED%% as b ON b.id = u.id
		WHERE u.id = :targetUserID AND u.universe = :universe;";

		$targetUserInfo = $db->selectSingle($sql,array(
			':targetUserID' => $targetUserID,
			':universe' => Universe::getEmulated(),
		));

		if ($targetUserInfo['longer'] > TIMESTAMP)
			$BanTime          += ($targetUserInfo['longer'] - TIMESTAMP);

		if ($banPermanently) {
			$BannedUntil = 2147483647;
		} else {
			$BannedUntil = ($BanTime + TIMESTAMP) < TIMESTAMP ? TIMESTAMP : TIMESTAMP + $BanTime;
		}

		if ($targetUserInfo['banaday'] > TIMESTAMP)
		{
			$SQL      = "UPDATE %%BANNED%% SET ";
			$SQL     .= "`who` = :Name, ";
			$SQL     .= "`theme` = :reas, ";
			$SQL     .= "`time` = :actionTime, ";
			$SQL     .= "`longer` = :BannedUntil, ";
			$SQL     .= "`author` = :admin, ";
			$SQL     .= "`email` = :mail ";
			$SQL     .= "WHERE `who` = :Name AND `universe` = :universe;";

			$db->update($SQL,array(
				':Name' => $targetUserInfo['username'],
				':reas' => $reas,
				':actionTime' => TIMESTAMP,
				':BannedUntil' => $BannedUntil,
				':admin' => $admin,
				':mail' => $mail,
				':universe' => Universe::getEmulated()
			));

		} else {
			$SQL      = "INSERT INTO %%BANNED%% SET ";
			$SQL     .= "`who` = :Name, ";
			$SQL     .= "`theme` = :reas, ";
			$SQL     .= "`time` = :actionTime, ";
			$SQL     .= "`longer` = :BannedUntil, ";
			$SQL     .= "`author` = :admin, ";
			$SQL     .= "`universe` = :universe, ";
			$SQL     .= "`email` = :mail;";

			$db->insert($SQL,array(
				':Name' => $targetUserInfo['username'],
				':reas' => $reas,
				':actionTime' => TIMESTAMP,
				':BannedUntil' => $BannedUntil,
				':admin' => $admin,
				':universe' => Universe::getEmulated(),
				':mail' => $mail
			));

		}

		$SQL = "UPDATE %%USERS%% SET `bana` = '1',`banaday` = :BannedUntil, urlaubs_modus = :urlaubs_modus
						WHERE `username` = :Name AND `universe` = :universe;";

		$db->update($SQL,array(
			':BannedUntil' => $BannedUntil,
			':urlaubs_modus' => isset($_POST['vacat']) ? '1': '0',
			':Name' => $targetUserInfo['username'],
			':universe' => Universe::getEmulated()
		));

		$this->printMessage($LNG['bo_the_player'].$targetUserInfo['username'].$LNG['bo_banned']);

	}

	function userDetail(){

		global $LNG;

		$targetUserID = HTTP::_GP('target_id',0);


		$db = Database::get();

		$sql = "SELECT u.username,u.urlaubs_modus,u.banaday,u.id as user_id,b.* FROM %%USERS%% as u
		LEFT JOIN %%BANNED%% as b ON b.id = u.id
		WHERE u.id = :targetUserID AND u.universe = :universe;";

		$targetUserInfo = $db->selectSingle($sql,array(
			':targetUserID' => $targetUserID,
			':universe' => Universe::getEmulated(),
		));



		if (!$targetUserInfo) {
			$this->printMessage('user could not be found !');
		}


		if ($targetUserInfo['banaday'] <= TIMESTAMP)
		{
			$title			= $LNG['bo_bbb_title_1'];
			$changedate		= $LNG['bo_bbb_title_2'];
			$changedate_advert		= '';
			$reas					= '';
			$timesus				= '';
		}
		else
		{
			$title			= $LNG['bo_bbb_title_3'];
			$changedate		= $LNG['bo_bbb_title_6'];
			$changedate_advert	=	'<td class="c" width="18px"><img src="./styles/resource/images/admin/i.gif" class="tooltip" data-tooltip-content="'.$LNG['bo_bbb_title_4'].'"></td>';

			$reas			= $targetUserInfo['theme'];
			$timesus		=
				"<tr>
					<th>".$LNG['bo_bbb_title_5']."</th>
					<th height=25 colspan=2>".date($LNG['php_tdformat'], $targetUserInfo['longer'])."</th>
				</tr>";
		}


		$vacation	= ($targetUserInfo['urlaubs_modus'] == 1) ? true : false;

		$this->assign(array(
			'target_id' => $targetUserInfo['user_id'],
			'name'				=> $targetUserInfo['username'],
			'bantitle'			=> $title,
			'changedate'		=> $changedate,
			'reas'				=> $reas,
			'changedate_advert'	=> $changedate_advert,
			'timesus'			=> $timesus,
			'vacation'			=> $vacation,
		));

		$this->display('page.banned.detail.tpl');

	}

}


function ShowBanPage()
{



	if(isset($_POST['panel']))
	{

	} elseif (isset($_POST['bannow']) && $BANUSER['id'] != 1) {

	} elseif(isset($_POST['unban_name'])) {

	}


}
