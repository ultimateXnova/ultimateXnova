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

class DumpCronjob implements CronjobTask
{
	function run()
	{
		$prefixCounts	= strlen(DB_PREFIX);
		$dbTables		= array();
		$tableNames		= Database::get()->nativeQuery('SHOW TABLE STATUS FROM '.DB_NAME.';');

		foreach($tableNames as $table)
		{
			if(DB_PREFIX == substr($table['Name'], 0, $prefixCounts))
			{
				$dbTables[]	= $table['Name'];
			}
		}

		if(empty($dbTables))
		{
			throw new Exception('No tables found for dump.');
		}

		$fileName	= '2MoonsBackup_'.date('d_m_Y_H_i_s', TIMESTAMP).'.sql';
		$filePath	= 'includes/backups/'.$fileName;

		require 'includes/classes/SQLDumper.class.php';

		$dump	= new SQLDumper;
		$dump->dumpTablesToFile($dbTables, $filePath);
	}
}
