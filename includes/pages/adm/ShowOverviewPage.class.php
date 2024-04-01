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
class ShowOverviewPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG, $USER;

		$Message	= array();

		if ($USER['authlevel'] >= AUTH_ADM)
		{
			if(file_exists(ROOT_PATH.'update.php'))
				$Message[]	= sprintf($LNG['ow_file_detected'], 'update.php');

			if(file_exists(ROOT_PATH.'webinstall.php'))
				$Message[]	= sprintf($LNG['ow_file_detected'], 'webinstall.php');

			if(file_exists('includes/ENABLE_INSTALL_TOOL'))
				$Message[]	= sprintf($LNG['ow_file_detected'], 'includes/ENABLE_INSTALL_TOOL');

			if(!is_writable(ROOT_PATH.'cache'))
				$Message[]	= sprintf($LNG['ow_dir_not_writable'], 'cache');

			if(!is_writable('includes'))
				$Message[]	= sprintf($LNG['ow_dir_not_writable'], 'includes');
		}



		$this->assign(array(
			'ow_none'			=> $LNG['ow_none'],
			'ow_overview'		=> $LNG['ow_overview'],
			'ow_welcome_text'	=> $LNG['ow_welcome_text'],
			'ow_credits'		=> $LNG['ow_credits'],
			'ow_special_thanks'	=> $LNG['ow_special_thanks'],
			'ow_translator'		=> $LNG['ow_translator'],
			'ow_proyect_leader'	=> $LNG['ow_proyect_leader'],
			'ow_support'		=> $LNG['ow_support'],
			'ow_title'			=> $LNG['ow_title'],
			'ow_forum'			=> $LNG['ow_forum'],
			'ow_donate'			=> $LNG['ow_donate'],
			'Messages'			=> $Message,
			'date'				=> date('m\_Y', TIMESTAMP),
		));

		$this->display('page.overview.default.tpl');

	}

}
