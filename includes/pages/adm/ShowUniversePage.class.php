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
class ShowUniversePage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG;

		$config = Config::get(Universe::getEmulated());

		$this->assign(array(
			'game_name'						=> $config->game_name,
			'uni_name'						=> $config->uni_name,
			'game_speed'					=> ($config->game_speed / 2500),
			'fleet_speed'					=> ($config->fleet_speed / 2500),
			'resource_multiplier'			=> $config->resource_multiplier,
			'storage_multiplier'			=> $config->storage_multiplier,
			'halt_speed'					=> $config->halt_speed,
			'energySpeed'					=> $config->energySpeed,
			'forum_url'						=> $config->forum_url,
			'initial_fields'				=> $config->initial_fields,
			'metal_basic_income'			=> $config->metal_basic_income,
			'crystal_basic_income'			=> $config->crystal_basic_income,
			'deuterium_basic_income'		=> $config->deuterium_basic_income,
			'game_disable'					=> $config->game_disable,
			'close_reason'					=> $config->close_reason,
			'debug'							=> $config->debug,
			'adm_attack'					=> $config->adm_attack,
			'defenses'						=> $config->Defs_Cdr,
			'shiips'						=> $config->Fleet_Cdr,
			'noobprot'						=> $config->noobprotection,
			'noobprot2'						=> $config->noobprotectiontime,
			'noobprot3'						=> $config->noobprotectionmulti,
			'mail_active'					=> $config->mail_active,
			'mail_use'						=> $config->mail_use,
			'smail_path'					=> $config->smail_path,
			'smtp_host' 					=> $config->smtp_host,
			'smtp_port' 					=> $config->smtp_port,
			'smtp_user' 					=> $config->smtp_user,
			'smtp_pass' 					=> $config->smtp_pass,
			'smtp_sendmail' 				=> $config->smtp_sendmail,
			'smtp_ssl'						=> $config->smtp_ssl,
			'user_valid'           	 		=> $config->user_valid,
				'newsframe'                 	=> $config->OverviewNewsFrame,
					'reg_closed'                	=> $config->reg_closed,
					'NewsTextVal'               	=> $config->OverviewNewsText,
			'capprivate' 					=> $config->capprivate,
			'cappublic' 	   				=> $config->cappublic,
			'capaktiv'      	           	=> $config->capaktiv,
			'min_build_time'    	        => $config->min_build_time,
			'trade_allowed_ships'        	=> $config->trade_allowed_ships,
			'trade_charge'		        	=> $config->trade_charge,
			'Selector'						=> array(
				'langs' => $LNG->getAllowedLangs(false),
				'mail'  => array(0 => $LNG['se_mail_sel_0'], 1 => $LNG['se_mail_sel_1'], 2 => $LNG['se_mail_sel_2']),
				'encry' => array('' => $LNG['se_smtp_ssl_1'], 'ssl' => $LNG['se_smtp_ssl_2'], 'tls' => $LNG['se_smtp_ssl_3'])
			),
			'lang'							=> $config->lang,
			'max_galaxy'					=> $config->max_galaxy,
			'max_system'					=> $config->max_system,
			'max_planets'					=> $config->max_planets,
			'min_player_planets'			=> $config->min_player_planets,
			'planets_tech'					=> $config->planets_tech,
			'planets_officier'				=> $config->planets_officier,
			'planets_per_tech'				=> $config->planets_per_tech,
			'planet_factor'					=> $config->planet_factor,
			'max_elements_build'			=> $config->max_elements_build,
			'max_elements_tech'				=> $config->max_elements_tech,
			'max_elements_ships'			=> $config->max_elements_ships,
			'max_fleet_per_build'			=> $config->max_fleet_per_build,
			'max_overflow'					=> $config->max_overflow,
			'moon_factor'					=> $config->moon_factor,
			'moon_chance'					=> $config->moon_chance,
			'darkmatter_cost_trader'		=> $config->darkmatter_cost_trader,
			'factor_university'				=> $config->factor_university,
			'max_fleets_per_acs'			=> $config->max_fleets_per_acs,
			'vmode_min_time'				=> $config->vmode_min_time,
			'gate_wait_time'				=> $config->gate_wait_time,
			'darkmatter_start'				=> $config->darkmatter_start,
			'debris_moon'					=> $config->debris_moon,
			'deuterium_cost_galaxy'			=> $config->deuterium_cost_galaxy,
			'ref_active'					=> $config->ref_active,
			'ref_bonus'						=> $config->ref_bonus,
			'ref_minpoints'					=> $config->ref_minpoints,
			'ref_max_referals'				=> $config->ref_max_referals,
			'silo_factor'					=> $config->silo_factor,
			'max_dm_missions'				=> $config->max_dm_missions,
			'alliance_create_min_points' 	=> $config->alliance_create_min_points,
			'show_unlearned_ships' => $config->show_unlearned_ships,
			'show_unlearned_buildings' => $config->show_unlearned_buildings,
			'show_unlearned_technology' => $config->show_unlearned_technology,
			'user_max_notes' => $config->user_max_notes,
			'show_ships_no_shipyard' => $config->show_ships_no_shipyard,
			'show_tech_no_research' => $config->show_tech_no_research,
		));

		$this->display('page.universe.default.tpl');

	}

	function saveSettings(){
		global $LNG;

		$config = Config::get(Universe::getEmulated());

			$config_before = array(
				'noobprotectiontime'	=> $config->noobprotectiontime,
				'noobprotectionmulti'	=> $config->noobprotectionmulti,
				'noobprotection'		=> $config->noobprotection,
				'Defs_Cdr'				=> $config->Defs_Cdr,
				'Fleet_Cdr'				=> $config->Fleet_Cdr,
				'game_disable'			=> $config->game_disable,
				'close_reason'			=> $config->close_reason,
				'OverviewNewsFrame'		=> $config->OverviewNewsFrame,
				'reg_closed'			=> $config->reg_closed,
				'OverviewNewsText'		=> $config->OverviewNewsText,
				'uni_name'				=> $config->uni_name,
				'forum_url'				=> $config->forum_url,
				'game_speed'			=> $config->game_speed,
				'fleet_speed'			=> $config->fleet_speed,
				'resource_multiplier'	=> $config->resource_multiplier,
				'storage_multiplier'	=> $config->storage_multiplier,
				'halt_speed'			=> $config->halt_speed,
				'energySpeed'			=> $config->energySpeed,
				'initial_fields'		=> $config->initial_fields,
				'metal_basic_income'	=> $config->metal_basic_income,
				'crystal_basic_income'	=> $config->crystal_basic_income,
				'deuterium_basic_income'=> $config->deuterium_basic_income,
				'debug'					=> $config->debug,
				'adm_attack'			=> $config->adm_attack,
				'lang'					=> $config->lang,
				'min_build_time'		=> $config->min_build_time,
				'user_valid'			=> $config->user_valid,
				'trade_charge'			=> $config->trade_charge,
				'trade_allowed_ships'	=> $config->trade_allowed_ships,
				'game_name'				=> $config->game_name,
				'capaktiv'				=> $config->capaktiv,
				'capprivate'			=> $config->capprivate,
				'cappublic'				=> $config->cappublic,
				'max_galaxy'			=> $config->max_galaxy,
				'max_system'			=> $config->max_system,
				'max_planets'			=> $config->max_planets,
				'min_player_planets'	=> $config->min_player_planets,
				'planets_tech'			=> $config->planets_tech,
				'planets_officier'		=> $config->planets_officier,
				'planets_per_tech'		=> $config->planets_per_tech,
				'planet_factor'			=> $config->planet_factor,
				'max_elements_build'	=> $config->max_elements_build,
				'max_elements_tech'		=> $config->max_elements_tech,
				'max_elements_ships'	=> $config->max_elements_ships,
				'max_overflow'			=> $config->max_overflow,
				'moon_factor'			=> $config->moon_factor,
				'moon_chance'			=> $config->moon_chance,
				'darkmatter_cost_trader'=> $config->darkmatter_cost_trader,
				'factor_university'		=> $config->factor_university,
				'max_fleets_per_acs'	=> $config->max_fleets_per_acs,
				'vmode_min_time'		=> $config->vmode_min_time,
				'gate_wait_time'		=> $config->gate_wait_time,
				'darkmatter_start'		=> $config->darkmatter_start,
				'debris_moon'			=> $config->debris_moon,
				'deuterium_cost_galaxy'	=> $config->deuterium_cost_galaxy,
				'ref_active'			=> $config->ref_active,
				'ref_bonus'				=> $config->ref_bonus,
				'ref_minpoints'			=> $config->ref_minpoints,
				'ref_max_referals'		=> $config->ref_max_referals,
				'silo_factor'			=> $config->silo_factor,
				'max_dm_missions'		=> $config->max_dm_missions,
				'alliance_create_min_points' => $config->alliance_create_min_points,
				'max_fleet_per_build'   => $config->max_fleet_per_build,
				'show_unlearned_ships' => $config->show_unlearned_ships,
				'show_unlearned_buildings' => $config->show_unlearned_buildings,
				'show_unlearned_technology' => $config->show_unlearned_technology,
				'user_max_notes' => $config->user_max_notes,
				'show_ships_no_shipyard' => $config->show_ships_no_shipyard,
				'show_tech_no_research' => $config->show_tech_no_research,
			);

			$game_disable			= isset($_POST['closed']) && $_POST['closed'] == 'on' ? 1 : 0;
			$noobprotection 		= isset($_POST['noobprotection']) && $_POST['noobprotection'] == 'on' ? 1 : 0;
			$debug 					= isset($_POST['debug']) && $_POST['debug'] == 'on' ? 1 : 0;
			$adm_attack 			= isset($_POST['adm_attack']) && $_POST['adm_attack'] == 'on' ? 1 : 0;
			$OverviewNewsFrame  	= isset($_POST['newsframe']) && $_POST['newsframe'] == 'on' ? 1 : 0;
			$reg_closed 			= isset($_POST['reg_closed']) && $_POST['reg_closed'] == 'on' ? 1 : 0;
			$user_valid				= isset($_POST['user_valid']) && $_POST['user_valid'] == 'on' ? 1 : 0;
			$debris_moon			= isset($_POST['debris_moon']) && $_POST['debris_moon'] == 'on' ? 1 : 0;
			$ref_active				= isset($_POST['ref_active']) && $_POST['ref_active'] == 'on' ? 1 : 0;

			$OverviewNewsText		= $_POST['NewsText'];
			$close_reason			= HTTP::_GP('close_reason', '', true);
			$uni_name				= HTTP::_GP('uni_name', '', true);
			$forum_url 				= HTTP::_GP('forum_url', '', true);
			$game_speed 			= (2500 * HTTP::_GP('game_speed', 0.0));
			$fleet_speed 			= (2500 * HTTP::_GP('fleet_speed', 0.0));
			$resource_multiplier	= HTTP::_GP('resource_multiplier', 0.0);
					$storage_multiplier   	= HTTP::_GP('storage_multiplier', 0.0);
			$halt_speed				= HTTP::_GP('halt_speed', 0.0);
			$energySpeed			= HTTP::_GP('energySpeed', 0.0);
			$initial_fields			= HTTP::_GP('initial_fields', 0);
			$metal_basic_income		= HTTP::_GP('metal_basic_income', 0);
			$crystal_basic_income	= HTTP::_GP('crystal_basic_income', 0);
			$deuterium_basic_income	= HTTP::_GP('deuterium_basic_income', 0);
			$lang					= HTTP::_GP('lang', '');
			$Defs_Cdr				= HTTP::_GP('Defs_Cdr', 0);
			$Fleet_Cdr				= HTTP::_GP('Fleet_Cdr', 0);
			$noobprotectiontime		= HTTP::_GP('noobprotectiontime', 0);
			$noobprotectionmulti	= HTTP::_GP('noobprotectionmulti', 0);
			$min_build_time			= HTTP::_GP('min_build_time', 0);
			$trade_allowed_ships	= HTTP::_GP('trade_allowed_ships', '');
			$trade_charge			= HTTP::_GP('trade_charge', 0.0);
			$max_galaxy				= HTTP::_GP('max_galaxy', 0);
			$max_system				= HTTP::_GP('max_system', 0);
			$max_planets			= HTTP::_GP('max_planets', 0);
			$min_player_planets		= HTTP::_GP('min_player_planets', 0);
			$planets_tech			= HTTP::_GP('planets_tech', 0);
			$planets_officier		= HTTP::_GP('planets_officier', 0);
			$planets_per_tech		= HTTP::_GP('planets_per_tech', 0.0);
			$planet_factor			= HTTP::_GP('planet_factor', 0.0);
			$max_elements_build		= HTTP::_GP('max_elements_build', 0);
			$max_elements_tech		= HTTP::_GP('max_elements_tech', 0);
			$max_elements_ships		= HTTP::_GP('max_elements_ships', 0);
			$max_overflow			= HTTP::_GP('max_overflow', 0);
			$moon_factor			= HTTP::_GP('moon_factor', 0.0);
			$moon_chance			= HTTP::_GP('moon_chance', 0);
			$darkmatter_cost_trader	= HTTP::_GP('darkmatter_cost_trader', 0);
			$factor_university		= HTTP::_GP('factor_university', 0);
			$max_fleets_per_acs		= HTTP::_GP('max_fleets_per_acs', 0);
			$vmode_min_time			= HTTP::_GP('vmode_min_time', 0);
			$gate_wait_time			= HTTP::_GP('gate_wait_time', 0);
			$darkmatter_start		= HTTP::_GP('darkmatter_start', 0);
			$deuterium_cost_galaxy	= HTTP::_GP('deuterium_cost_galaxy', 0);
			$max_fleet_per_build	= max(0, round(HTTP::_GP('max_fleet_per_build', 0.0)));
			$ref_bonus				= HTTP::_GP('ref_bonus', 0);
			$ref_minpoints			= HTTP::_GP('ref_minpoints', 0);
			$silo_factor			= HTTP::_GP('silo_factor', 0);
			$ref_max_referals		= HTTP::_GP('ref_max_referals', 0);
			$max_dm_missions		= HTTP::_GP('max_dm_missions', 1);
			$alliance_create_min_points = HTTP::_GP('alliance_create_min_points', 0);
			$show_unlearned_ships = (HTTP::_GP('show_unlearned_ships', 'off') == 'on') ? 1 : 0;
			$show_unlearned_buildings = (HTTP::_GP('show_unlearned_buildings', 'off') == 'on') ? 1 : 0;
			$show_unlearned_technology = (HTTP::_GP('show_unlearned_technology', 'off') == 'on') ? 1 : 0;
			$user_max_notes = HTTP::_GP('user_max_notes',20);
			$show_ships_no_shipyard =  (HTTP::_GP('show_ships_no_shipyard', 'off') == 'on') ? 1 : 0;
			$show_tech_no_research =  (HTTP::_GP('show_tech_no_research', 'off') == 'on') ? 1 : 0;


			$config_after = array(
				'noobprotectiontime'	=> $noobprotectiontime,
				'noobprotectionmulti'	=> $noobprotectionmulti,
				'noobprotection'		=> $noobprotection,
				'Defs_Cdr'				=> $Defs_Cdr,
				'Fleet_Cdr'				=> $Fleet_Cdr,
				'game_disable'			=> $game_disable,
				'close_reason'			=> $close_reason,
				'OverviewNewsFrame'		=> $OverviewNewsFrame,
				'reg_closed'			=> $reg_closed,
				'OverviewNewsText'		=> $OverviewNewsText,
				'uni_name'				=> $uni_name,
				'forum_url'				=> $forum_url,
				'game_speed'			=> $game_speed,
				'fleet_speed'			=> $fleet_speed,
				'resource_multiplier'	=> $resource_multiplier,
				'storage_multiplier'	=> $storage_multiplier,
				'halt_speed'			=> $halt_speed,
				'energySpeed'			=> $energySpeed,
				'initial_fields'		=> $initial_fields,
				'metal_basic_income'	=> $metal_basic_income,
				'crystal_basic_income'	=> $crystal_basic_income,
				'deuterium_basic_income'=> $deuterium_basic_income,
				'debug'					=> $debug,
				'adm_attack'			=> $adm_attack,
				'lang'					=> $lang,
				'min_build_time'		=> $min_build_time,
				'user_valid'			=> $user_valid,
				'trade_charge'			=> $trade_charge,
				'trade_allowed_ships'	=> $trade_allowed_ships,
				'max_galaxy'			=> $max_galaxy,
				'max_system'			=> $max_system,
				'max_planets'			=> $max_planets,
				'min_player_planets'	=> $min_player_planets,
				'planets_tech'			=> $planets_tech,
				'planets_officier'		=> $planets_officier,
				'planets_per_tech'		=> $planets_per_tech,
				'planet_factor'			=> $planet_factor,
				'max_elements_build'	=> $max_elements_build,
				'max_elements_tech'		=> $max_elements_tech,
				'max_elements_ships'	=> $max_elements_ships,
				'max_overflow'			=> $max_overflow,
				'moon_factor'			=> $moon_factor,
				'moon_chance'			=> $moon_chance,
				'darkmatter_cost_trader'=> $darkmatter_cost_trader,
				'factor_university'		=> $factor_university,
				'max_fleets_per_acs'	=> $max_fleets_per_acs,
				'vmode_min_time'		=> $vmode_min_time,
				'gate_wait_time'		=> $gate_wait_time,
				'darkmatter_start'		=> $darkmatter_start,
				'debris_moon'			=> $debris_moon,
				'deuterium_cost_galaxy'	=> $deuterium_cost_galaxy,
				'ref_active'			=> $ref_active,
				'ref_bonus'				=> $ref_bonus,
				'ref_minpoints'			=> $ref_minpoints,
				'ref_max_referals'		=> $ref_max_referals,
				'silo_factor'			=> $silo_factor,
				'max_dm_missions'		=> $max_dm_missions,
				'alliance_create_min_points' => $alliance_create_min_points,
				'max_fleet_per_build'	=> $max_fleet_per_build,
				'show_unlearned_ships' => $show_unlearned_ships,
				'show_unlearned_buildings' => $show_unlearned_buildings,
				'show_unlearned_technology' => $show_unlearned_technology,
				'user_max_notes' => $user_max_notes,
				'show_ships_no_shipyard' => $show_ships_no_shipyard,
				'show_tech_no_research' => $show_tech_no_research,
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

			if($config->adm_attack == 0){

				$sql = "UPDATE %%USERS%% SET `authattack` = '0' WHERE `universe` = :universe ;";

				Database::get()->update($sql,array(
					':universe' => Universe::getEmulated()
				));

			}


			$redirectButton = array();
      $redirectButton[] = array(
        'url' => 'admin.php?page=universe&mode=show',
				'label' => $LNG['uvs_back']
      );

      $this->printMessage($LNG['settings_successful'],$redirectButton);

	}

}
