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
class ShowStatsUpdatePage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG;
		require_once('includes/classes/class.statbuilder.php');
		$stat			= new statbuilder();
		$result			= $stat->MakeStats();
		$memory_p		= str_replace(array("%p", "%m"), $result['memory_peak'], $LNG['sb_top_memory']);
		$memory_e		= str_replace(array("%e", "%m"), $result['end_memory'], $LNG['sb_final_memory']);
		$memory_i		= str_replace(array("%i", "%m"), $result['initial_memory'], $LNG['sb_start_memory']);
		$stats_end_time	= sprintf($LNG['sb_stats_update'], $result['totaltime']);
		$stats_sql		= sprintf($LNG['sb_sql_counts'], $result['sql_count']);

		$this->printMessage($LNG['sb_stats_updated'].$stats_end_time.$memory_i.$memory_e.$memory_p.$stats_sql);

	}
}
