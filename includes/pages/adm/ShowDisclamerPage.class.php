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
class ShowDisclamerPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){
		global $LNG;

		$config = Config::get(Universe::getEmulated());


		$this->assign(array(
			'disclaimerAddress'		=> $config->disclamerAddress,
			'disclaimerPhone'		=> $config->disclamerPhone,
			'disclaimerMail'		=> $config->disclamerMail,
			'disclaimerNotice'		=> $config->disclamerNotice,
		));

		$this->display('page.disclamer.default.tpl');

	}

	function saveSettings(){

		global $LNG;

		$config = Config::get(Universe::getEmulated());

		$config_before = array(
			'disclamerAddress'	=> $config->disclamerAddress,
			'disclamerPhone'	=> $config->disclamerPhone,
			'disclamerMail'	=> $config->disclamerMail,
			'disclamerNotice'	=> $config->disclamerNotice,
		);

		$disclaimerAddress	= HTTP::_GP('disclaimerAddress', '', true);
		$disclaimerPhone	= HTTP::_GP('disclaimerPhone', '', true);
		$disclaimerMail		= HTTP::_GP('disclaimerMail', '', true);
		$disclaimerNotice	= HTTP::_GP('disclaimerNotice', '', true);

		$config_after = array(
			'disclamerAddress'	=> $disclaimerAddress,
			'disclamerPhone'	=> $disclaimerPhone,
			'disclamerMail'		=> $disclaimerMail,
			'disclamerNotice'	=> $disclaimerNotice,
		);

		foreach($config_after as $key => $value)
		{
			$config->$key	= $value;
		}
		$config->save();

		$LOG = new Log(3);
		$LOG->target = 5;
		$LOG->old = $config_before;
		$LOG->new = $config_after;
		$LOG->save();

		$redirectButton = array();
		$redirectButton[] = array(
			'url' => 'admin.php?page=disclamer&mode=show',
			'label' => $LNG['uvs_back']
		);

		$this->printMessage($LNG['settings_successful'],$redirectButton);

	}


}
