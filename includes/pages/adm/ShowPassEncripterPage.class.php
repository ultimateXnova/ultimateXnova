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
class ShowPassEncripterPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){


		$this->assign(array(

		));

		$this->display('page.passwordencripter.default.tpl');
	}

	function send(){
		$Password	= HTTP::_GP('md5q', '', true);

		$this->assign(array(
			'md5_md5' 			=> $Password,
			'md5_enc' 			=> PlayerUtil::cryptPassword($Password),
		));

		$this->display('page.passwordencripter.default.tpl');

	}

}
