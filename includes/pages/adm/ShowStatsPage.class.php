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
class ShowStatsPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG;

		$config = Config::get(Universe::getEmulated());


		$this->assign(array(
			'stat_level'						=> $config->stat_level,
			'stat'								=> $config->stat,
			'stat_settings'						=> $config->stat_settings,
			'cs_access_lvl'						=> $LNG['cs_access_lvl'],
			'cs_points_to_zero'					=> $LNG['cs_points_to_zero'],
			'cs_point_per_resources_used'		=> $LNG['cs_point_per_resources_used'],
			'cs_title'							=> $LNG['cs_title'],
			'cs_resources'						=> $LNG['cs_resources'],
			'cs_save_changes'					=> $LNG['cs_save_changes'],
			'Selector'							=> array(1 => $LNG['cs_yes'], 2 => $LNG['cs_no_view'], 0 => $LNG['cs_no']),
		));

		$this->display('page.stats.default.tpl');

	}

	function saveSettings(){
		global $LNG;
		$config = Config::get(Universe::getEmulated());

		$config_before = array(
			'stat_settings' 	=> $config->stat_settings,
			'stat' 				=> $config->stat,
			'stat_level' 		=> $config->stat_level
		);

		$stat_settings				= HTTP::_GP('stat_settings', 0);
		$stat 						= HTTP::_GP('stat', 0);
		$stat_level					= HTTP::_GP('stat_level', 0);

		$config_after = array(
			'stat_settings'		=> $stat_settings,
			'stat'				=> $stat,
			'stat_level' 		=> $stat_level
		);

		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();

		$LOG = new Log(3);
		$LOG->target = 2;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();

		$redirectButton = array();
		$redirectButton[] = array(
			'url' => 'admin.php?page=stats&mode=show',
			'label' => $LNG['uvs_back']
		);

		$this->printMessage($LNG['settings_successful'],$redirectButton);

	}

}


function ShowStatsPage()
{
	global $LNG;

	$config = Config::get(Universe::getEmulated());



	$template	= new template();


	$template->assign_vars(array(
		'stat_level'						=> $config->stat_level,
		'stat'								=> $config->stat,
		'stat_settings'						=> $config->stat_settings,
		'cs_access_lvl'						=> $LNG['cs_access_lvl'],
		'cs_points_to_zero'					=> $LNG['cs_points_to_zero'],
		'cs_point_per_resources_used'		=> $LNG['cs_point_per_resources_used'],
		'cs_title'							=> $LNG['cs_title'],
		'cs_resources'						=> $LNG['cs_resources'],
		'cs_save_changes'					=> $LNG['cs_save_changes'],
		'Selector'							=> array(1 => $LNG['cs_yes'], 2 => $LNG['cs_no_view'], 0 => $LNG['cs_no']),
	));

	$template->show('StatsPage.tpl');
}
