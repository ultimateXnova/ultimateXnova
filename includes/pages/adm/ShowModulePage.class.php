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
class ShowModulePage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG;

		$config	= Config::get(Universe::getEmulated());

		$module	= explode(';', $config->moduls);

		$IDs	= range(0, MODULE_AMOUNT - 1);

		foreach($IDs as $ID => $Name) {
			$Modules[$ID]	= array(
				'name'	=> $LNG['modul_'.$ID],
				'state'	=> isset($module[$ID]) ? $module[$ID] : 1,
			);
		}

		asort($Modules);


		$this->assign(array(
			'Modules'				=> $Modules,
		));

		$this->display('page.modules.default.tpl');

	}

	function change(){
		global $LNG;

		$config	= Config::get(Universe::getEmulated());

		$type = HTTP::_GP('type','');
		$id = HTTP::_GP('id',0);
		$module	= explode(';', $config->moduls);


		if ($type == 'activate') {
			$module[$id] = 1;
		}else {
			$module[$id] = 0;
		}

		$config->moduls = implode(";", $module);
		$config->save();
		ClearCache();

		$redirectButton = array();
		$redirectButton[] = array(
			'url' => 'admin.php?page=module&mode=show',
			'label' => $LNG['uvs_back']
		);

		$this->printMessage($LNG['settings_successful'],$redirectButton);

	}

}


function ShowModulePage()
{
	global $LNG;

	$config	= Config::get(Universe::getEmulated());
	$module	= explode(';', $config->moduls);



	$IDs	= range(0, MODULE_AMOUNT - 1);
	foreach($IDs as $ID => $Name) {
		$Modules[$ID]	= array(
			'name'	=> $LNG['modul_'.$ID],
			'state'	=> isset($module[$ID]) ? $module[$ID] : 1,
		);
	}

	asort($Modules);
	$template	= new template();

	$template->assign_vars(array(
		'Modules'				=> $Modules,
		'mod_module'			=> $LNG['mod_module'],
		'mod_info'				=> $LNG['mod_info'],
		'mod_active'			=> $LNG['mod_active'],
		'mod_deactive'			=> $LNG['mod_deactive'],
		'mod_change_active'		=> $LNG['mod_change_active'],
		'mod_change_deactive'	=> $LNG['mod_change_deactive'],
	));

	$template->show('ModulePage.tpl');
}
