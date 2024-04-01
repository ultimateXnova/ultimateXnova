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

$config = Config::get();


$planetData	= array(
	1	=> array('temp' => mt_rand(220, 260),	'fields' => mt_rand($config->planet_1_field_min, $config->planet_1_field_max),	'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4))),
	2	=> array('temp' => mt_rand(170, 210),	'fields' => mt_rand($config->planet_2_field_min, $config->planet_2_field_max),	'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4))),
	3	=> array('temp' => mt_rand(120, 160),	'fields' => mt_rand($config->planet_3_field_min, $config->planet_3_field_max),	'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4))),
	4	=> array('temp' => mt_rand(70, 110),	'fields' => mt_rand($config->planet_4_field_min, $config->planet_4_field_max),	'image' => array('dschjungel' => mt_rand(1, 10))),
	5	=> array('temp' => mt_rand(60, 100),	'fields' => mt_rand($config->planet_5_field_min, $config->planet_5_field_max),	'image' => array('dschjungel' => mt_rand(1, 10))),
	6	=> array('temp' => mt_rand(50, 90),		'fields' => mt_rand($config->planet_6_field_min, $config->planet_6_field_max),	'image' => array('dschjungel' => mt_rand(1, 10))),
	7	=> array('temp' => mt_rand(40, 80),		'fields' => mt_rand($config->planet_7_field_min, $config->planet_7_field_max),	'image' => array('normaltemp' => mt_rand(1, 7))),
	8	=> array('temp' => mt_rand(30, 70),		'fields' => mt_rand($config->planet_8_field_min, $config->planet_8_field_max),	'image' => array('normaltemp' => mt_rand(1, 7))),
	9	=> array('temp' => mt_rand(20, 60),		'fields' => mt_rand($config->planet_9_field_min, $config->planet_9_field_max),	'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9))),
	10	=> array('temp' => mt_rand(10, 50),		'fields' => mt_rand($config->planet_10_field_min, $config->planet_10_field_max),	'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9))),
	11	=> array('temp' => mt_rand(0, 40),		'fields' => mt_rand($config->planet_11_field_min, $config->planet_11_field_max),	'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9))),
	12	=> array('temp' => mt_rand(-10, 30),	'fields' => mt_rand($config->planet_12_field_min, $config->planet_12_field_max),	'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9))),
	13	=> array('temp' => mt_rand(-50, -10),	'fields' => mt_rand($config->planet_13_field_min, $config->planet_13_field_max),	'image' => array('eis' => mt_rand(1, 10))),
	14	=> array('temp' => mt_rand(-90, -50),	'fields' => mt_rand($config->planet_14_field_min, $config->planet_14_field_max),	'image' => array('eis' => mt_rand(1, 10))),
	15	=> array('temp' => mt_rand(-130, -90),	'fields' => mt_rand($config->planet_15_field_min, $config->planet_15_field_max),	'image' => array('eis' => mt_rand(1, 10)))
);
