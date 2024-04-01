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

class Log
{
	private $data	= array();

	function __construct($mode) {
		$this->data['mode']		= $mode;
		$this->data['admin']	= Session::load()->userId;
		$this->data['uni']		= Universe::getEmulated();
	}
	public function __set($key, $value){
		$this->data[$key] = $value;
	}
	public function __get($key){
        return $this->__isset($key) ? $this->data[$key] : null;
    }
	public function __isset($key){
        return isset($this->data[$key]);
    }

    function saveTr(){

	$db = Database::get();
	$uni = (empty($this->data['universe']) ? $this->data['uni'] : $this->data['universe']);

	$sql = "INSERT INTO %%LOG%% SET
	target		= :id,
	mode		= :mode,
	admin		= :admin,
	time		= :time,
	data		= :data,
	universe 	= :universe;";

	$db->insert($sql, array(
	    ':id'		=> $this->data['target'],
	    ':mode'		=> $this->data['mode'],
	    ':admin'	=> $this->data['admin'],
	    ':time'		=> TIMESTAMP,
	    ':data'		=> serialize($this->data['new']),
	    ':universe'	=> $uni,
	));
    }

	function save() {
		$data = serialize(array($this->data['old'], $this->data['new']));
		$uni = (empty($this->data['universe']) ? $this->data['uni'] : $this->data['universe']);
		$GLOBALS['DATABASE']->query("INSERT INTO ".LOG." (`id`,`mode`,`admin`,`target`,`time`,`data`,`universe`) VALUES
		(NULL , ".$GLOBALS['DATABASE']->sql_escape($this->data['mode']).", ".$GLOBALS['DATABASE']->sql_escape($this->data['admin']).", '".$GLOBALS['DATABASE']->sql_escape($this->data['target'])."', ".TIMESTAMP." , '".$GLOBALS['DATABASE']->sql_escape($data)."', '".$uni."');");
	}
}
