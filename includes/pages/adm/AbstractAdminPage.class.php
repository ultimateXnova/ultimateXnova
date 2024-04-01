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

abstract class AbstractAdminPage
{
	/**
	 * reference of the template object
	 * @var template
	 */
	protected $tplObj;

	/**
	 * reference of the template object
	 * @var ResourceUpdate
	 */
	protected $window;

	protected function __construct() {

		if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))){
			throw new Exception("Permission error!");
		}

		if(!AJAX_REQUEST)
		{
			$this->setWindow('full');
			$this->initTemplate();
		} else {
			$this->setWindow('ajax');
		}
	}



	protected function initTemplate() {
		global $config, $USER;

		if(isset($this->tplObj))
			return true;

		$this->tplObj	= new template;
		list($tplDir)	= $this->tplObj->getTemplateDir();


		$this->tplObj->setTemplateDir($tplDir. '/adm');
		return true;
	}

	protected function setWindow($window) {
		$this->window	= $window;
	}

	protected function getWindow() {
		return $this->window;
	}

	protected function getQueryString() {
		$queryString	= array();
		$page			= HTTP::_GP('page', '');

		if(!empty($page)) {
			$queryString['page']	= $page;
		}

		$mode			= HTTP::_GP('mode', '');
		if(!empty($mode)) {
			$queryString['mode']	= $mode;
		}

		return http_build_query($queryString);
	}




	protected function getPageData()
	{
		global $USER, $THEME, $config, $PLANET, $LNG;

		$universeSelect	= array();
		foreach(Universe::availableUniverses() as $uniId)
		{
			$config = Config::get($uniId);
			$universeSelect[$uniId]	= sprintf('%s (ID: %d)', $config->uni_name, $uniId);
		}

		$sql = "SELECT COUNT(*) as count FROM %%TICKETS%% WHERE universe = :universe AND status = 0;";

		$numberTickets = Database::get()->selectSingle($sql,array(
			':universe' => Universe::getEmulated()
		),'count');


		$this->assign(array(
			'title' => 'pageTitle',
			'authlevel'				=> $USER['authlevel'],
			'AvailableUnis'			=> $universeSelect,
			'UNI'					=> Universe::getEmulated(),
			'sid'					=> session_id(),
			'id'					=> $USER['id'],
			'supportticks'	=> $numberTickets,
			'currentPage' => HTTP::_GP('page',''),
			'search' => HTTP::_GP('search',''),
		));
	}

	protected function printMessage($message, $redirectButtons = NULL, $redirect = NULL, $fullSide = true)
	{

		$this->assign(array(
			'message'			=> $message,
			'redirectButtons'	=> $redirectButtons,
		));

		if(isset($redirect)) {
			$this->tplObj->gotoside($redirect[0], $redirect[1]);
		}

		if(!$fullSide) {
			$this->setWindow('popup');
		}

		$this->display('error.default.tpl');
	}



	protected function assign($array, $nocache = true) {
		$this->tplObj->assign_vars($array, $nocache);
	}

	protected function display($file) {
		global $THEME, $LNG;

		if($this->getWindow() !== 'ajax') {
			$this->getPageData();
		}

		$this->assign(array(
			'lang'    		=> $LNG->getLanguage(),
			'scripts'		=> $this->tplObj->jsscript,
			'execscript'	=> implode("\n", $this->tplObj->script),
			'basepath'		=> PROTOCOL.HTTP_HOST.HTTP_BASE,
			'bodyclass'			=> $this->getWindow(),
		));

		$this->assign(array(
			'LNG'			=> $LNG,
		), false);


		$this->tplObj->display('extends:layout.'.$this->getWindow().'.tpl|'.$file);
		exit;
	}

	protected function sendJSON($data) {
		echo json_encode($data);
		exit;
	}

	protected function redirectTo($url) {
		HTTP::redirectTo($url);
		exit;
	}
}
