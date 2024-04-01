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

class ShowQuestionsPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct()
	{
		parent::__construct();
	}

	function show()
	{
		global $LNG;

		$LNG->includeData(array('FAQ'));

		$this->display('page.questions.default.tpl');
	}

	function single()
	{
		global $LNG;

		$LNG->includeData(array('FAQ'));

		$categoryID	= HTTP::_GP('categoryID', 0);
		$questionID	= HTTP::_GP('questionID', 0);

		if(!isset($LNG['questions'][$categoryID][$questionID])) {
			HTTP::redirectTo('game.php?page=questions');
		}

		$this->assign(array(
			'questionRow'	=> $LNG['questions'][$categoryID][$questionID],
		));
		$this->display('page.questions.single.tpl');
	}
}
