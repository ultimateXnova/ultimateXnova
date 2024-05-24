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

class BBCode
{
	static public function parse($sText)
	{
		if (!isset($sText)) {
			$sText = '';
		}
		$sText = str_replace("\r\n", "\n", $sText);
		$sText = str_replace("\r", "\n", $sText);
		$sText = str_replace("\n", '<br />', $sText);

			if(function_exists('parse_ini_file')) {
	    		$config = parse_ini_file('BBCodeParser2.ini', true);
			} else {
				// Pfahli: Added default array in case parse_ini_file is not available
			$config = [
				'HTML_BBCodeParser2' => [
					'quotestyle' => 'single',
					'quotewhat' => 'all',
					'open' => '[',
					'close' => ']',
					'xmlclose' => true,
					'filters' => 'Basic,Extended,Images,Links,Lists,Email'
				]
			];
			}

				$options = $config['HTML_BBCodeParser2'];


				$parser = new HTML_BBCodeParser2($options);

	    	$parser->setText($sText);

				$parser->parse();

	    	return $parser->getParsed();
	}
}
