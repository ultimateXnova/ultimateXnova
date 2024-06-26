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

class ShowExternalAuthPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct()
	{
		parent::__construct();
	}

	function show()
	{
		$method			= HTTP::_GP('method', '');
		$method			= strtolower(str_replace(array('_', '\\', '/', '.', "\0"), '', $method));
		$path			= 'includes/classes/extauth/'.$method.'.class.php';

		if(!file_exists($path)) {
			HTTP::redirectTo('index.php');
		}

		$session	= Session::create();

		require 'includes/classes/extauth/externalAuth.interface.php';
		require $path;

		$methodClass	= ucwords($method).'Auth';

		/** @var $authObj externalAuth */
		$authObj		= new $methodClass;

		if(!$authObj->isActiveMode())
		{
			$session->delete();
			$this->redirectTo('index.php?code=5');
		}

		if(!$authObj->isValid())
		{
			$session->delete();
			$this->redirectTo('index.php?code=4');
		}

		$loginData	= $authObj->getLoginData();

		if(empty($loginData))
		{
			$session->delete();
			$this->redirectTo('index.php?page=register&externalAuth[account]='.$authObj->getAccount().'&externalAuth[method]='.$method);
		}

		$session->userId		= (int) $loginData['id'];
		$session->adminAccess	= 0;
		$session->save();
		$this->redirectTo("game.php");
	}
}
