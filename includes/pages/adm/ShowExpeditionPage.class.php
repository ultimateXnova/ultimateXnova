<?php

/**
 *
 */
class ShowExpeditionPage extends AbstractAdminPage
{

  function __construct()
  {
    parent::__construct();
  }

  function show(){
    global $config;

    $this->assign(array(
      'expedition_allow_fleet_loss' => $config->expedition_allow_fleet_loss,
      'expedition_allow_fleet_delay' => $config->expedition_allow_fleet_delay,
      'expedition_allow_fleet_speedup' => $config->expedition_allow_fleet_speedup,
      'expedition_allow_expedition_war' => $config->expedition_allow_expedition_war,
      'expedition_allow_darkmatter_find' => $config->expedition_allow_darkmatter_find,
      'expedition_allow_resources_find' => $config->expedition_allow_resources_find,
      'expedition_allow_ships_find' => $config->expedition_allow_ships_find,
      'expedition_consider_holdtime' => $config->expedition_consider_holdtime,
      'expedition_factor_resources' => $config->expedition_factor_resources,
      'expedition_factor_ships' => $config->expedition_factor_ships,
      'expedition_chances_percent_resources' => $config->expedition_chances_percent_resources,
      'expedition_chances_percent_darkmatter' => $config->expedition_chances_percent_darkmatter,
      'expedition_chances_percent_ships' => $config->expedition_chances_percent_ships,
      'expedition_chances_percent_pirates' => $config->expedition_chances_percent_pirates,
      'expedition_consider_same_coordinate' => $config->expedition_consider_same_coordinate,
      'expedition_min_darkmatter_small_min' => $config->expedition_min_darkmatter_small_min,
      'expedition_min_darkmatter_small_max' => $config->expedition_min_darkmatter_small_max,
      'expedition_min_darkmatter_large_min' => $config->expedition_min_darkmatter_large_min,
      'expedition_min_darkmatter_large_max' => $config->expedition_min_darkmatter_large_max,
      'expedition_min_darkmatter_vlarge_min' => $config->expedition_min_darkmatter_vlarge_min,
      'expedition_min_darkmatter_vlarge_max' => $config->expedition_min_darkmatter_vlarge_max,
    ));

    $this->display('page.expedition_settings.default.tpl');
  }

  function send(){
    global $LNG, $config;

    $config_before = array(
      'expedition_allow_fleet_loss' => $config->expedition_allow_fleet_loss,
      'expedition_allow_fleet_delay' => $config->expedition_allow_fleet_delay,
      'expedition_allow_fleet_speedup' => $config->expedition_allow_fleet_speedup,
      'expedition_allow_expedition_war' => $config->expedition_allow_expedition_war,
      'expedition_allow_darkmatter_find' => $config->expedition_allow_darkmatter_find,
      'expedition_allow_resources_find' => $config->expedition_allow_resources_find,
      'expedition_allow_ships_find' => $config->expedition_allow_ships_find,
      'expedition_consider_holdtime' => $config->expedition_consider_holdtime,
      'expedition_consider_same_coordinate' => $config->expedition_consider_same_coordinate,
      'expedition_chances_percent_resources' => $config->expedition_chances_percent_resources,
      'expedition_chances_percent_darkmatter' => $config->expedition_chances_percent_darkmatter,
      'expedition_chances_percent_ships' => $config->expedition_chances_percent_ships,
      'expedition_chances_percent_pirates' => $config->expedition_chances_percent_pirates,
      'expedition_min_darkmatter_small_min' => $config->expedition_min_darkmatter_small_min,
      'expedition_min_darkmatter_small_max' => $config->expedition_min_darkmatter_small_max,
      'expedition_min_darkmatter_large_min' => $config->expedition_min_darkmatter_large_min,
      'expedition_min_darkmatter_large_max' => $config->expedition_min_darkmatter_large_max,
      'expedition_min_darkmatter_vlarge_min' => $config->expedition_min_darkmatter_vlarge_min,
      'expedition_min_darkmatter_vlarge_max' => $config->expedition_min_darkmatter_vlarge_max,
    );

    $expedition_allow_fleet_loss = (HTTP::_GP('expedition_allow_fleet_loss', 'off') == 'on') ? 1 : 0;
    $expedition_allow_fleet_delay = (HTTP::_GP('expedition_allow_fleet_delay', 'off') == 'on') ? 1 : 0;
    $expedition_allow_fleet_speedup = (HTTP::_GP('expedition_allow_fleet_speedup', 'off') == 'on') ? 1 : 0;
    $expedition_allow_expedition_war = (HTTP::_GP('expedition_allow_expedition_war', 'off') == 'on') ? 1 : 0;
    $expedition_allow_darkmatter_find = (HTTP::_GP('expedition_allow_darkmatter_find', 'off') == 'on') ? 1 : 0;
    $expedition_allow_resources_find = (HTTP::_GP('expedition_allow_resources_find', 'off') == 'on') ? 1 : 0;
    $expedition_allow_ships_find = (HTTP::_GP('expedition_allow_ships_find', 'off') == 'on') ? 1 : 0;
    $expedition_consider_holdtime = (HTTP::_GP('expedition_consider_holdtime', 'off') == 'on') ? 1 : 0;
    $expedition_consider_same_coordinate = (HTTP::_GP('expedition_consider_same_coordinate', 'off') == 'on') ? 1 : 0;

    $expedition_factor_resources = HTTP::_GP('expedition_factor_resources',1);
    $expedition_factor_ships = HTTP::_GP('expedition_factor_ships',1);
    $chances_percent_resources = HTTP::_GP('expedition_chances_percent_resources',32.5);
    $chances_percent_darkmatter = HTTP::_GP('expedition_chances_percent_darkmatter',9);
    $chances_percent_ships = HTTP::_GP('expedition_chances_percent_ships',22);
    $chances_percent_pirates = HTTP::_GP('expedition_chances_percent_pirates',8.4);
    

    $expedition_min_darkmatter_small_min = HTTP::_GP('expedition_min_darkmatter_small_min',100);
    $expedition_min_darkmatter_small_max = HTTP::_GP('expedition_min_darkmatter_small_max',300);
    $expedition_min_darkmatter_large_min = HTTP::_GP('expedition_min_darkmatter_large_min',301);
    $expedition_min_darkmatter_large_max = HTTP::_GP('expedition_min_darkmatter_large_max',600);
    $expedition_min_darkmatter_vlarge_min = HTTP::_GP('expedition_min_darkmatter_vlarge_min',601);
    $expedition_min_darkmatter_vlarge_max = HTTP::_GP('expedition_min_darkmatter_vlarge_max',3000);

    $config_after = array(
      'expedition_allow_fleet_loss' => $expedition_allow_fleet_loss,
      'expedition_allow_fleet_delay' => $expedition_allow_fleet_delay,
      'expedition_allow_fleet_speedup' => $expedition_allow_fleet_speedup,
      'expedition_allow_expedition_war' => $expedition_allow_expedition_war,
      'expedition_allow_darkmatter_find' => $expedition_allow_darkmatter_find,
      'expedition_allow_resources_find' => $expedition_allow_resources_find,
      'expedition_allow_ships_find' => $expedition_allow_ships_find,
      'expedition_consider_holdtime' => $expedition_consider_holdtime,
      'expedition_consider_same_coordinate' => $expedition_consider_same_coordinate,
      'expedition_factor_resources' => $expedition_factor_resources,
      'expedition_factor_ships' => $expedition_factor_ships,
      'expedition_chances_percent_resources' => $chances_percent_resources,
      'expedition_chances_percent_darkmatter' => $chances_percent_darkmatter,
      'expedition_chances_percent_ships' => $chances_percent_ships,
      'expedition_chances_percent_pirates' => $chances_percent_pirates,
      'expedition_min_darkmatter_small_min' => $expedition_min_darkmatter_small_min,
      'expedition_min_darkmatter_small_max' => $expedition_min_darkmatter_small_max,
      'expedition_min_darkmatter_large_min' => $expedition_min_darkmatter_large_min,
      'expedition_min_darkmatter_large_max' => $expedition_min_darkmatter_large_max,
      'expedition_min_darkmatter_vlarge_min' => $expedition_min_darkmatter_vlarge_min,
      'expedition_min_darkmatter_vlarge_max' => $expedition_min_darkmatter_vlarge_max,
    );

    foreach($config_after as $key => $value)
    {
      $config->$key	= $value;
    }
    $config->save();

    $LOG = new Log(3);
    $LOG->target = 1;
    $LOG->old = $config_before;
    $LOG->new = $config_after;
    $LOG->save();


    $redirectButton = array();
    $redirectButton[] = array(
      'url' => 'admin.php?page=expedition&mode=show',
      'label' => $LNG['uvs_back']
    );

    $this->printMessage($LNG['settings_successful'],$redirectButton);

  }

  function default(){

    global $config, $LNG;

    $expedition_allow_fleet_loss = 1;
    $expedition_allow_fleet_delay = 1;
    $expedition_allow_fleet_speedup = 1;
    $expedition_allow_expedition_war = 1;
    $expedition_allow_darkmatter_find = 1;
    $expedition_allow_resources_find = 1;
    $expedition_allow_ships_find = 1;
    $expedition_consider_holdtime = 1;
    $expedition_consider_same_coordinate = 1;

    $expedition_factor_resources = 1;
    $expedition_factor_ships = 1;
    $chances_percent_resources = 32.5;
		$chances_percent_darkmatter = 9;
		$chances_percent_ships = 22;
		$chances_percent_pirates = 8.4;

    $expedition_min_darkmatter_small_min = 100;
    $expedition_min_darkmatter_small_max = 300;
    $expedition_min_darkmatter_large_min = 301;
    $expedition_min_darkmatter_large_max = 600;
    $expedition_min_darkmatter_vlarge_min = 601;
    $expedition_min_darkmatter_vlarge_max = 3000;

    $config_after = array(
      'expedition_allow_fleet_loss' => $expedition_allow_fleet_loss,
      'expedition_allow_fleet_delay' => $expedition_allow_fleet_delay,
      'expedition_allow_fleet_speedup' => $expedition_allow_fleet_speedup,
      'expedition_allow_expedition_war' => $expedition_allow_expedition_war,
      'expedition_allow_darkmatter_find' => $expedition_allow_darkmatter_find,
      'expedition_allow_resources_find' => $expedition_allow_resources_find,
      'expedition_allow_ships_find' => $expedition_allow_ships_find,
      'expedition_consider_holdtime' => $expedition_consider_holdtime,
      'expedition_consider_same_coordinate' => $expedition_consider_same_coordinate,
      'expedition_factor_resources' => $expedition_factor_resources,
      'expedition_factor_ships' => $expedition_factor_ships,
      'expedition_chances_percent_resources' => $chances_percent_resources,
      'expedition_chances_percent_darkmatter' => $chances_percent_darkmatter,
      'expedition_chances_percent_ships' => $chances_percent_ships,
      'expedition_chances_percent_pirates' => $chances_percent_pirates,
      'expedition_min_darkmatter_small_min' => $expedition_min_darkmatter_small_min,
      'expedition_min_darkmatter_small_max' => $expedition_min_darkmatter_small_max,
      'expedition_min_darkmatter_large_min' => $expedition_min_darkmatter_large_min,
      'expedition_min_darkmatter_large_max' => $expedition_min_darkmatter_large_max,
      'expedition_min_darkmatter_vlarge_min' => $expedition_min_darkmatter_vlarge_min,
      'expedition_min_darkmatter_vlarge_max' => $expedition_min_darkmatter_vlarge_max,
    );

    foreach($config_after as $key => $value)
    {
      $config->$key	= $value;
    }
    $config->save();

    $redirectButton = array();
    $redirectButton[] = array(
      'url' => 'admin.php?page=expedition&mode=show',
      'label' => $LNG['uvs_back']
    );

    $this->printMessage($LNG['settings_successful'],$redirectButton);


  }


}










 ?>
