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
 class ShowInfosPage extends AbstractAdminPage
 {

 	function __construct()
 	{
 		parent::__construct();
 	}

	function show(){

		global $LNG, $USER, $config;

		// @ for open_basedir
		if(@file_exists(ini_get('error_log')))
			$Lines	= count(file(ini_get('error_log')));
		else
			$Lines	= 0;


		try {
			$dateTimeZoneServer = new DateTimeZone($config->timezone);
		} catch (Exception $e) {
			$dateTimeZoneServer	= new DateTimeZone(date_default_timezone_get());
		}

		try {
			$dateTimeZoneUser	= new DateTimeZone($USER['timezone']);
		} catch (Exception $e) {
			$dateTimeZoneUser	= new DateTimeZone(date_default_timezone_get());
		}

		try {
			$dateTimeZonePHP	= new DateTimeZone(ini_get('date.timezone'));
		} catch (Exception $e) {
			$dateTimeZonePHP	= new DateTimeZone(date_default_timezone_get());
		}

		$dateTimeServer		= new DateTime("now", $dateTimeZoneServer);
		$dateTimeUser		= new DateTime("now", $dateTimeZoneUser);
		$dateTimePHP		= new DateTime("now", $dateTimeZonePHP);

	  $sql	= "SELECT dbVersion FROM %%SYSTEM%%;";

	  $dbVersion	= Database::get()->selectSingle($sql, array(), 'dbVersion');

		$this->assign(array(
			'info_information'	=> sprintf($LNG['info_information'], 'https://github.com/koraykarakus/steemnova-1.8-x/issues'),
			'info'				=> $_SERVER['SERVER_SOFTWARE'],
			'vPHP'				=> PHP_VERSION,
			'vAPI'				=> PHP_SAPI,
			'vGame'				=> $config->VERSION.(file_exists(ROOT_PATH.'/.git/ORIG_HEAD') ? ' ('.trim(file_get_contents(ROOT_PATH.'/.git/ORIG_HEAD')).')': ''),
			'vMySQLc'			=> $GLOBALS['DATABASE']->getVersion(),
			'vMySQLs'			=> $GLOBALS['DATABASE']->getServerVersion(),
			'root'				=> $_SERVER['SERVER_NAME'],
			'gameroot'			=> $_SERVER['SERVER_NAME'].str_replace('/admin.php', '', $_SERVER['PHP_SELF']),
			'json'				=> function_exists('json_encode') ? $LNG['ad_infos_yes'] : $LNG['ad_infos_no'],
			'bcmath'			=> extension_loaded('bcmath') ? $LNG['ad_infos_yes'] : $LNG['ad_infos_no'],
			'curl'				=> extension_loaded('curl') ? $LNG['ad_infos_yes'] : $LNG['ad_infos_no'],
			'browser'			=> $_SERVER['HTTP_USER_AGENT'],
			'safemode'			=> ini_get('safe_mode') ? $LNG['ad_infos_yes'] : $LNG['ad_infos_no'],
			'memory'			=> ini_get('memory_limit'),
			'suhosin'			=> ini_get('suhosin.request.max_value_length') ? $LNG['ad_infos_yes'] : $LNG['ad_infos_no'],
			'log_errors'		=> ini_get('log_errors') ? $LNG['ad_infos_active'] : $LNG['ad_infos_inactive'],
			'errorlog'			=> ini_get('error_log'),
			'errorloglines'		=> $Lines,
	    'dbVersion'         => $dbVersion,
			'php_tz'			=> $dateTimePHP->getOffset() / 3600,
			'conf_tz'			=> $dateTimeServer->getOffset() / 3600,
			'user_tz'			=> $dateTimeUser->getOffset() / 3600,
		));

		$this->display('page.information.default.tpl');

	}

 }
