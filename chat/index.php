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
 * @version 1.8.0
 * @link https://github.com/ultimateXnova/ultimateXnova
 */


// Suppress errors:
error_reporting(E_ALL);

// Path to the chat directory:
define('AJAX_CHAT_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');

// Include custom libraries and initialization code:
require(AJAX_CHAT_PATH.'lib/custom.php');

// Include Class libraries:
require(AJAX_CHAT_PATH.'lib/classes.php');

// Initialize the chat:
$ajaxChat = new CustomAJAXChat();
