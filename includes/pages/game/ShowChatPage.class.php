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

class ShowChatPage extends AbstractGamePage
{
	public static $requireModule = MODULE_CHAT;

	function __construct()
	{
		parent::__construct();
	}

	function show()
	{
		$action	= HTTP::_GP('action', '');
		if($action == 'alliance') {
			$this->setWindow('popup');
			$this->initTemplate();
		}

		$this->display('page.chat.default.tpl');
	}
}
