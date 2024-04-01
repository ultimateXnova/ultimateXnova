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
class ShowQuickEditorPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();

		$this->setWindow('light');

	}

	function player(){


		global $USER, $LNG, $reslist, $resource;
		$action	= HTTP::_GP('action', '');
		$targetID 	= HTTP::_GP('id', 0);

		$db = Database::get();

		$DataIDs	= array_merge($reslist['tech'], $reslist['officier']);
		$SpecifyItemsPQ	= "";

		foreach($DataIDs as $ID)
		{
			$SpecifyItemsPQ	.= "`".$resource[$ID]."`,";
		}

		$sql = "SELECT ".$SpecifyItemsPQ." `username`, `authlevel`, `galaxy`, `system`, `planet`, `id_planet`, `darkmatter`, `authattack`, `authlevel` FROM %%USERS%% WHERE `id` = :targetID;";

		$UserData	= $db->selectSingle($sql,array(
			':targetID' => $targetID
		));


		$ChangePW	= $USER['id'] == ROOT_USER || ($targetID != ROOT_USER && $USER['authlevel'] > $UserData['authlevel']);

		$sql = "SELECT `name` FROM %%PLANETS%% WHERE `id` = :planetId AND `universe` = :universe;";

		$PlanetInfo = $db->selectSingle($sql,array(
			':planetId' => $UserData['id_planet'],
			':universe' => Universe::getEmulated(),
		));

		$tech	= $officier = array();


		foreach($reslist['tech'] as $ID)
		{
			$tech[]	= array(
				'type'	=> $resource[$ID],
				'name'	=> $LNG['tech'][$ID],
				'count'	=> pretty_number($UserData[$resource[$ID]]),
				'input'	=> $UserData[$resource[$ID]]
			);
		}
		foreach($reslist['officier'] as $ID)
		{
			$officier[]	= array(
				'type'	=> $resource[$ID],
				'name'	=> $LNG['tech'][$ID],
				'count'	=> pretty_number($UserData[$resource[$ID]]),
				'input'	=> $UserData[$resource[$ID]]
			);
		}

		$this->assign(array(
			'tech'			=> $tech,
			'officier'		=> $officier,
			'targetID'			=> $targetID,
			'planetid'		=> $UserData['id_planet'],
			'planetname'	=> $PlanetInfo['name'],
			'name'			=> $UserData['username'],
			'galaxy'		=> $UserData['galaxy'],
			'system'		=> $UserData['system'],
			'planet'		=> $UserData['planet'],
			'authlevel'		=> $UserData['authlevel'],
			'authattack'	=> $UserData['authattack'],
			'multi'			=> $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$targetID.";"),
			'ChangePW'		=> $ChangePW,
			'yesorno'		=> array(1 => $LNG['one_is_yes_1'], 0 => $LNG['one_is_yes_0']),
			'darkmatter'	=> floatToString($UserData['darkmatter']),
			'darkmatter_c'	=> pretty_number($UserData['darkmatter']),
		));

		$this->display('page.quickeditor.user.tpl');

	}

	function playerSend(){

		global $USER, $LNG, $reslist, $resource;
		$targetID 	= HTTP::_GP('id', 0);
		$db = Database::get();

		$DataIDs	= array_merge($reslist['tech'], $reslist['officier']);

		$SpecifyItemsPQ	= "";
		foreach($DataIDs as $ID)
		{
			$SpecifyItemsPQ	.= "`" . $resource[$ID] . "`,";
		}

		$sql = "SELECT " . $SpecifyItemsPQ . " `username`, `authlevel`, `galaxy`, `system`, `planet`, `id_planet`, `darkmatter`, `authattack`, `authlevel` FROM %%USERS%% WHERE `id` = :userId;";

		$UserData = $db->selectSingle($sql,array(
			':userId' => $targetID
		));

		$ChangePW	= $USER['id'] == ROOT_USER || ($targetID != ROOT_USER && $USER['authlevel'] > $UserData['authlevel']);


		$sql	= "UPDATE %%USERS%% SET ";


		foreach($DataIDs as $ID)
		{
			$sql	.= "`".$resource[$ID]."` = ".min(abs(HTTP::_GP($resource[$ID], 0)), 255).", ";
		}

		$sql	.= "`darkmatter` = :darkmatter, ";
		$sql	.= "`username` = :username, ";
		$sql	.= "`authattack` = :authattack ";
		$sql	.= "WHERE `id` = :userId AND `universe` = :universe;";

		$db->update($sql,array(
			':darkmatter' => max(HTTP::_GP('darkmatter', 0), 0),
			':username' => HTTP::_GP('name', '', UTF8_SUPPORT),
			':authattack' => ($UserData['authlevel'] != AUTH_USR && HTTP::_GP('authattack', '') == 'on' ? $UserData['authlevel'] : 0),
			':userId' => $targetID,
			':universe' => Universe::getEmulated(),
		));

		if(!empty($_POST['password']) && $ChangePW){

			$sql = "UPDATE %%USERS%% SET password = :password WHERE id = :userId;";

			$db->update($sql,array(
				':userId' => $targetID,
				':password' => PlayerUtil::cryptPassword(HTTP::_GP('password', '', true))
			));

		}



		$old = array();
		$new = array();
		$multi	=  HTTP::_GP('multi', 0);
		foreach($DataIDs as $IDs)
						{
								$old[$IDs]    = $UserData[$resource[$IDs]];
								$new[$IDs]    = abs(HTTP::_GP($resource[$IDs], 0));
						}
		$old[921]			= $UserData[$resource[921]];
		$new[921]			= abs(HTTP::_GP($resource[921], 0));
		$old['username']	= $UserData['username'];
		$new['username']	= $GLOBALS['DATABASE']->sql_escape(HTTP::_GP('name', '', UTF8_SUPPORT));
		$old['authattack']	= $UserData['authattack'];
		$new['authattack']	= ($UserData['authlevel'] != AUTH_USR && HTTP::_GP('authattack', '') == 'on' ? $UserData['authlevel'] : 0);
		$old['multi']		= $GLOBALS['DATABASE']->getFirstCell("SELECT COUNT(*) FROM ".MULTI." WHERE userID = ".$targetID.";");
		$new['authattack']	= $multi;

		if($old['multi'] != $multi)
		{
			if($multi == 0)
			{
				$GLOBALS['DATABASE']->query("DELETE FROM ".MULTI." WHERE userID = ".((int) $targetID).";");
			}
			elseif($multi == 1)
			{
				$GLOBALS['DATABASE']->query("INSERT INTO ".MULTI." SET userID = ".((int) $targetID).";");
			}
		}

		$LOG = new Log(1);
		$LOG->target = $targetID;
		$LOG->old = $old;
		$LOG->new = $new;
		$LOG->save();

		$this->printMessage(sprintf($LNG['qe_edit_player_sucess'], $UserData['username'], $targetID));

	}

	function planetSend(){
		global $reslist,$resource, $LNG;

		$db = Database::get();

		$id = HTTP::_GP('id', 0);

		$SpecifyItemsPQ	= "";
		$DataIDs	= array_merge($reslist['fleet'], $reslist['build'], $reslist['defense']);

		foreach($DataIDs as $ID)
		{
			$SpecifyItemsPQ	.= "`".$resource[$ID]."`,";
		}

		$sql = "SELECT ".$SpecifyItemsPQ." `name`, `id_owner`, `planet_type`, `galaxy`, `system`, `planet`, `destruyed`, `diameter`, `field_current`, `field_max`, `temp_min`, `temp_max`, `metal`, `crystal`, `deuterium` FROM %%PLANETS%% WHERE `id` = '".$id."';";

		$PlanetData	= $db->selectSingle($sql);

		if (!$PlanetData) {
			return;
		}

		$SQL	= "UPDATE ".PLANETS." SET ";
		$Fields	= $PlanetData['field_current'];
		foreach($DataIDs as $ID)
		{
			$level	= min(max(0, round(HTTP::_GP($resource[$ID], 0.0))), (in_array($ID, $reslist['build']) ? 255: 18446744073709551615));

			if(in_array($ID, $reslist['allow'][$PlanetData['planet_type']]))
			{
				$Fields	+= $level - $PlanetData[$resource[$ID]];
			}

			$SQL	.= "`".$resource[$ID]."` = ".$level.", ";
		}

		$SQL	.= "`metal` = ".max(0, round(HTTP::_GP('metal', 0.0))).", ";
		$SQL	.= "`crystal` = ".max(0, round(HTTP::_GP('crystal', 0.0))).", ";
		$SQL	.= "`deuterium` = ".max(0, round(HTTP::_GP('deuterium', 0.0))).", ";
		$SQL	.= "`field_current` = '".$Fields."', ";
		$SQL	.= "`field_max` = '".HTTP::_GP('field_max', 0)."', ";
		$SQL	.= "`name` = '".$GLOBALS['DATABASE']->sql_escape(HTTP::_GP('name', '', UTF8_SUPPORT))."', ";
		$SQL	.= "`eco_hash` = '' ";
		$SQL	.= "WHERE `id` = '".$id."' AND `universe` = '".Universe::getEmulated()."';";

		$GLOBALS['DATABASE']->query($SQL);

		$old = array();
		$new = array();
						foreach(array_merge($DataIDs,$reslist['resstype'][1]) as $IDs)
						{
								$old[$IDs]    = $PlanetData[$resource[$IDs]];
			$new[$IDs]    = max(0, round(HTTP::_GP($resource[$IDs], 0.0)));
						}
		$old['field_max'] = $PlanetData['field_max'];
		$new['field_max'] = HTTP::_GP('field_max', 0);

		$LOG = new Log(2);
		$LOG->target = $id;
		$LOG->old = $old;
		$LOG->new = $new;
		$LOG->save();

		$this->printMessage(sprintf($LNG['qe_edit_planet_sucess'], $PlanetData['name'], $PlanetData['galaxy'],$PlanetData['system'],$PlanetData['planet']));


	}

	function planet(){

		global $USER, $LNG, $reslist, $resource;
		$action	= HTTP::_GP('action', '');
		$id 	= HTTP::_GP('id', 0);

		$DataIDs	= array_merge($reslist['fleet'], $reslist['build'], $reslist['defense']);
		$SpecifyItemsPQ	= "";

		foreach($DataIDs as $ID)
		{
			$SpecifyItemsPQ	.= "`".$resource[$ID]."`,";
		}
		$PlanetData	= $GLOBALS['DATABASE']->getFirstRow("SELECT ".$SpecifyItemsPQ." `name`, `id_owner`, `planet_type`, `galaxy`, `system`, `planet`, `destruyed`, `diameter`, `field_current`, `field_max`, `temp_min`, `temp_max`, `metal`, `crystal`, `deuterium` FROM ".PLANETS." WHERE `id` = '".$id."';");



		$UserInfo				= $GLOBALS['DATABASE']->getFirstRow("SELECT `username` FROM ".USERS." WHERE `id` = '".$PlanetData['id_owner']."' AND `universe` = '".Universe::getEmulated()."';");

		$build = $defense = $fleet	= array();

		foreach($reslist['allow'][$PlanetData['planet_type']] as $ID)
		{
			$build[]	= array(
				'type'	=> $resource[$ID],
				'name'	=> $LNG['tech'][$ID],
				'count'	=> pretty_number($PlanetData[$resource[$ID]]),
				'input'	=> $PlanetData[$resource[$ID]]
			);
		}

		foreach($reslist['fleet'] as $ID)
		{
			$fleet[]	= array(
				'type'	=> $resource[$ID],
				'name'	=> $LNG['tech'][$ID],
				'count'	=> pretty_number($PlanetData[$resource[$ID]]),
				'input'	=> $PlanetData[$resource[$ID]]
			);
		}

		foreach($reslist['defense'] as $ID)
		{
			$defense[]	= array(
				'type'	=> $resource[$ID],
				'name'	=> $LNG['tech'][$ID],
				'count'	=> pretty_number($PlanetData[$resource[$ID]]),
				'input'	=> $PlanetData[$resource[$ID]]
			);
		}

		$this->assign(array(
			'build'			=> $build,
			'fleet'			=> $fleet,
			'defense'		=> $defense,
			'planetId'			=> $id,
			'ownerid'		=> $PlanetData['id_owner'],
			'ownername'		=> $UserInfo['username'],
			'name'			=> $PlanetData['name'],
			'galaxy'		=> $PlanetData['galaxy'],
			'system'		=> $PlanetData['system'],
			'planet'		=> $PlanetData['planet'],
			'field_min'		=> $PlanetData['field_current'],
			'field_max'		=> $PlanetData['field_max'],
			'temp_min'		=> $PlanetData['temp_min'],
			'temp_max'		=> $PlanetData['temp_max'],
			'metal'			=> floatToString($PlanetData['metal']),
			'crystal'		=> floatToString($PlanetData['crystal']),
			'deuterium'		=> floatToString($PlanetData['deuterium']),
			'metal_c'		=> pretty_number($PlanetData['metal']),
			'crystal_c'		=> pretty_number($PlanetData['crystal']),
			'deuterium_c'	=> pretty_number($PlanetData['deuterium']),
		));
		$this->display('page.quickeditor.planet.tpl');

	}

}



function ShowQuickEditorPage()
{


	switch($edit)
	{
		case 'planet':

		break;
		case 'player':

		break;
	}
}
