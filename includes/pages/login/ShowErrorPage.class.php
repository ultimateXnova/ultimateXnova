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


class ShowErrorPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	protected $disableEcoSystem = true;

	function __construct()
	{
		parent::__construct();
		$this->initTemplate();
	}

	static function printError($Message, $fullSide = true, $redirect = NULL)
	{
		$pageObj	= new self;
		$pageObj->printMessage($Message, $fullSide, $redirect);
	}

	function show()
	{

	}
}
