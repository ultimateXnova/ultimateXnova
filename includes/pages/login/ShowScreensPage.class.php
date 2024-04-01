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


class ShowScreensPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct()
	{
		parent::__construct();
	}

	function show()
	{
		$screenshots	= array();
		$directoryIterator = new DirectoryIterator('styles/resource/images/login/screens/');
        foreach ($directoryIterator as $fileInfo)
		{
			/** @var $fileInfo DirectoryIterator */
			if (!$fileInfo->isFile())
			{
				continue;
            }

			$thumbnail = 'styles/resource/images/login/screens/'.$fileInfo->getFilename();
			if(file_exists('styles/resource/images/login/screens/thumbnails/'.$fileInfo->getFilename()))
			{
				$thumbnail = 'styles/resource/images/login/screens/thumbnails/'.$fileInfo->getFilename();
			}

			$screenshots[]	= array(
				'path' 		=> 'styles/resource/images/login/screens/'.$fileInfo->getFilename(),
				'thumbnail' => $thumbnail,
			);
		}

		$this->assign(array(
			'screenshots' => $screenshots
		));

		$this->display('page.screens.default.tpl');
	}
}
