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
class ShowGiveawayPage extends AbstractAdminPage
{

  function __construct()
  {
    parent::__construct();
  }

  function show(){
    global $LNG, $resource, $reslist;

    $this->assign(array(
      'reslist'		=> $reslist
    ));

    $this->display("page.giveaway.default.tpl");
  }


function send(){
  global $LNG, $resource, $reslist;

  $planet			= HTTP::_GP('planet', 0);
  $moon			= HTTP::_GP('moon', 0);
  $mainplanet		= HTTP::_GP('mainplanet', 0);
  $no_inactive	= HTTP::_GP('no_inactive', 0);

  if (!$planet && !$moon) {
    $this->printMessage($LNG['ga_selectplanettype']);
  }

  $planetIN	= array();

  if ($planet) {
    $planetIN[]	= "'1'";
  }

  if ($moon) {
    $planetIN[]	= "'3'";
  }

  $data		= array();

  $DataIDs	= array_merge($reslist['resstype'][1], $reslist['resstype'][3], $reslist['build'], $reslist['tech'], $reslist['fleet'], $reslist['defense'], $reslist['officier']);

  $logOld		= array();
  $logNew		= array();

  foreach($DataIDs as $ID)
  {
    $amount	= max(0, round(HTTP::_GP('element_'.$ID, 0.0)));
    $data[]	= $resource[$ID]." = ".$resource[$ID]." + ".$amount;

    $logOld[$ID]	= 0;
    $logNew[$ID]	= $amount;
  }

  $SQL		= "UPDATE %%PLANETS%% p INNER JOIN %%USERS%% u ON p.id_owner = u.id";

  if ($mainplanet == true) {
    $SQL	.= " AND p.id = u.id_planet";
  }

  if ($no_inactive == true) {
    $SQL	.= " AND u.onlinetime > ".(TIMESTAMP - INACTIVE);
  }

  $SQL	.= " SET ".implode(', ', $data)." WHERE p.universe = :universe AND p.planet_type IN (".implode(',', $planetIN).")";

  Database::get()->update($SQL,array(
    ':universe' => Universe::getEmulated()
  ));

  $LOG = new Log(4);
  $LOG->target = 0;
  $LOG->old = $logOld;
  $LOG->new = $logNew;
  $LOG->save();

  $this->printMessage($LNG['ga_success']);

}

}
