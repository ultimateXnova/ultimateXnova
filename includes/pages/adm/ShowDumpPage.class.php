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
class ShowDumpPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){
		$db = Database::get();

		$dumpData['perRequest']		= 100;

		$dumpData		= array();

		$prefixCounts	= strlen(DB_PREFIX);

		$dumpData['sqlTables']	= array();

		$sql = "SHOW TABLE STATUS FROM `" . DB_NAME ."`;";

		$sqlTableRaw			= $db->nativequery($sql);

		foreach($sqlTableRaw as $table)
		{
			if(DB_PREFIX == substr($table['Name'], 0, $prefixCounts))
			{
				$dumpData['sqlTables'][]	= $table['Name'];
			}
		}

		$this->assign(array(
			'dumpData'	=> $dumpData,
		));

		$this->display('page.dump.default.tpl');

	}

	function dump(){

		global $LNG;

		$db = Database::get();

		$dbTables	= HTTP::_GP('dbtables', array());

		if(empty($dbTables)) {
			$this->printMessage($LNG['du_not_tables_selected']);
		}

		$fileName	= '2MoonsBackup_'.date('d_m_Y_H_i_s', TIMESTAMP).'.sql';
		$filePath	= 'includes/backups/'.$fileName;

		require 'includes/classes/SQLDumper.class.php';

		$dump	= new SQLDumper;
		$dump->dumpTablesToFile($dbTables, $filePath);

		$this->printMessage(sprintf($LNG['du_success'], 'includes/backups/'.$fileName));

	}

}
