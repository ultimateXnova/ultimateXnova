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

function ShowMenuPage()
{
	global $USER;
	$template	= new template();

	$sql = "SELECT COUNT(*) as count FROM %%TICKETS%% WHERE universe = :universe AND status = 0;";

	$numberTickets = Database::get()->selectSingle($sql,array(
		':universe' => Universe::getEmulated()
	),'count');

	$template->assign_vars(array(
		'supportticks'	=> $numberTickets,
	));

	$template->show('ShowMenuPage.tpl');
}
