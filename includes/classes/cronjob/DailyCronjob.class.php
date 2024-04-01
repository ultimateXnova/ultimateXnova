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

require_once 'includes/classes/cronjob/CronjobTask.interface.php';

class DailyCronJob implements CronjobTask
{
	function run()
	{
		$this->optimizeTables();
		$this->clearCache();
		$this->reCalculateCronjobs();
		$this->clearEcoCache();
	}

	function optimizeTables()
	{
		$sql			= "SHOW TABLE STATUS FROM `".DB_NAME."`;";
		$sqlTableRaw	= Database::get()->nativeQuery($sql);

		$prefixCounts	= strlen(DB_PREFIX);
		$dbTables		= array();

		foreach($sqlTableRaw as $table)
		{
			if (DB_PREFIX == substr($table['Name'], 0, $prefixCounts)) {
				$dbTables[] = $table['Name'];
			}
		}

		if(!empty($dbTables))
		{
			Database::get()->nativeQuery("OPTIMIZE TABLE ".implode(', ', $dbTables).";");
		}
	}

	function clearCache()
	{
		ClearCache();
	}

	function reCalculateCronjobs()
	{
		Cronjob::reCalculateCronjobs();
	}

	function clearEcoCache()
	{
		$sql	= "UPDATE %%PLANETS%% SET eco_hash = '';";
		Database::get()->update($sql);
	}
}
