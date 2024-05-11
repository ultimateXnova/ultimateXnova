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

class Theme
{
	static public $Themes;
	private $THEMESETTINGS;
	private $skininfo;
	private $skin;
	private $customtpls;

	function __construct($install = false)
	{
		global $USER;
		$this->skininfo = array();


		if (!$install) {
			$config = Config::get();
			if ($config->let_users_change_theme && isset($USER)) {

					$this->skin = $USER['dpath'];

			}else {

					$this->skin = $config->server_default_theme;

			}


		}else {
			$this->skin = "nova";
		}


		$this->setUserTheme($this->skin);
	}

	function isHome() {
		$this->template		= ROOT_PATH.'styles/home/';
		$this->customtpls	= array();
	}

	function setUserTheme($Theme) {
		if(!file_exists(ROOT_PATH.'styles/theme/'.$Theme.'/style.cfg'))
			return false;

		$this->skin		= $Theme;
		$this->parseStyleCFG();
		$this->setStyleSettings();
	}

	function getTheme() {
		return './styles/theme/'.$this->skin.'/';
	}

	function getThemeName() {
		return $this->skin;
	}

	function getTemplatePath($mode = false) {
		$new_path = ROOT_PATH.'styles/theme/'.$this->skin.'/templates';
		$legacy_path = ROOT_PATH.'styles/templates/theme/'.$this->skin.'/';
		
		if(file_exists($new_path) && $mode == false) {
			return $new_path;
		} else {
			return $legacy_path;
		} 
		
		
	}

	function isCustomTPL($tpl) {
		if(!isset($this->customtpls))
			return false;

		return in_array($tpl, $this->customtpls);
	}

	function parseStyleCFG() {
		require(ROOT_PATH.'styles/theme/'.$this->skin.'/style.cfg');
		$this->skininfo		= $Skin;
		$this->customtpls	= (array) $Skin['templates'];
	}

	function setStyleSettings() {
		if(file_exists(ROOT_PATH.'styles/theme/'.$this->skin.'/settings.cfg')) {
			require(ROOT_PATH.'styles/theme/'.$this->skin.'/settings.cfg');
		}

		$this->THEMESETTINGS	= array_merge(array(
			'PLANET_ROWS_ON_OVERVIEW' => 2,
			'SHORTCUT_ROWS_ON_FLEET1' => 2,
			'COLONY_ROWS_ON_FLEET1' => 2,
			'ACS_ROWS_ON_FLEET1' => 1,
			'TOPNAV_SHORTLY_NUMBER' => 0,
		), $THEMESETTINGS);
	}

	function getStyleSettings() {
		return $this->THEMESETTINGS;
	}

	static function getAvalibleSkins() {
		if(!isset(self::$Themes))
		{
			if(file_exists(ROOT_PATH.'cache/cache.themes.php'))
			{
				self::$Themes	= unserialize(file_get_contents(ROOT_PATH.'cache/cache.themes.php'));
			} else {
				$Skins	= array_diff(scandir(ROOT_PATH.'styles/theme/'), array('..', '.', '.svn', '.htaccess', 'index.htm'));
				$Themes	= array();
				foreach($Skins as $Theme) {
					if(!file_exists(ROOT_PATH.'styles/theme/'.$Theme.'/style.cfg'))
						continue;

					require(ROOT_PATH.'styles/theme/'.$Theme.'/style.cfg');
					$Themes[$Theme]	= $Skin['name'];
				}
				file_put_contents(ROOT_PATH.'cache/cache.themes.php', serialize($Themes));
				self::$Themes	= $Themes;
			}
		}


		return self::$Themes;
	}
}
