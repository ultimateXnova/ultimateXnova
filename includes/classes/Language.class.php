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

class Language implements ArrayAccess {
    private $container = array();
    private $language = array();
    static private $allLanguages = array();

	static function getAllowedLangs($OnlyKey = true)
	{
		if(empty(self::$allLanguages))
		{
			$cache	= Cache::get();
			$cache->add('language', 'LanguageBuildCache');
			self::$allLanguages = $cache->getData('language');
		}

		if($OnlyKey)
		{
			return array_keys(self::$allLanguages);
		}
		else
		{
			return self::$allLanguages;
		}
	}

	public function getUserAgentLanguage()
	{
		// Pfahli: Added check for GET var to set language
		if (isset($_GET['lang']) && in_array($_GET['lang'], self::getAllowedLangs()))
		{
			HTTP::sendCookie('lang', $_GET['lang'], 2147483647);
			$this->setLanguage($_GET['lang']);
			return true;
		}
   		if (isset($_REQUEST['lang']) && in_array($_REQUEST['lang'], self::getAllowedLangs()))
		{
			HTTP::sendCookie('lang', $_REQUEST['lang'], 2147483647);
			$this->setLanguage($_REQUEST['lang']);
			return true;
		}
		

   		if ((MODE === 'LOGIN' || MODE === 'INSTALL') && isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], self::getAllowedLangs()))
		{
			$this->setLanguage($_COOKIE['lang']);
			return true;
		}

	    if (empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
            return false;
        }

        $accepted_languages = preg_split('/,\s*/', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

        $language = $this->getLanguage();

        foreach ($accepted_languages as $accepted_language)
		{
			$isValid = preg_match('!^([a-z]{1,8}(?:-[a-z]{1,8})*)(?:;\s*q=(0(?:\.[0-9]{1,3})?|1(?:\.0{1,3})?))?$!i', $accepted_language, $matches);

			if ($isValid !== 1)
			{
				continue;
			}

            list($code)	= explode('-', strtolower($matches[1]));

			if(in_array($code, self::getAllowedLangs()))
			{
				$language	= $code;
				break;
			}
        }

		HTTP::sendCookie('lang', $language, 2147483647);
		$this->setLanguage($language);

		return $language;
	}

    public function __construct($language = NULL)
	{
		$this->setLanguage($language);
    }

    public function setLanguage($language)
	{
		if(!is_null($language) && in_array($language, self::getAllowedLangs()))
		{
			$this->language = $language;
		}
		elseif(MODE !== 'INSTALL')
		{
			$this->language	= Config::get()->lang;
		}
		else
		{
			$this->language	= DEFAULT_LANG;
		}
    }

    public function addData($data) {
		$this->container = array_replace_recursive($this->container, $data);
    }

	public function getLanguage()
	{
		return $this->language;
	}

	public function getTemplate($templateName)
	{
		if(file_exists('language/'.$this->getLanguage().'/templates/'.$templateName.'.txt'))
		{
			return file_get_contents('language/'.$this->getLanguage().'/templates/'.$templateName.'.txt');
		}
		else
		{
			return '### Template "'.$templateName.'" on language "'.$this->getLanguage().'" not found! ###';
		}
	}


	public function includeData($files)
	{
		// Fixed BOM problems.
		ob_start();
		$LNG	= array();

		//FALLBACK
		$path	= 'language/en/';
        foreach($files as $file) {
			$filePath	= $path.$file.'.php';
			if(file_exists($filePath))
			{
				require $filePath;
			}
		}

		$DEFAULT = $LNG;

		// Get current client language
		$path	= 'language/'.$this->getLanguage().'/';
		foreach ($files as $file) {
			$filePath	= $path . $file . '.php';
			if (file_exists($filePath)) {
				require $filePath;
			}
		}

		// Build missing language data from English to client language
		foreach ($DEFAULT as $TextKey => $TextData) {
			if (is_array($TextData)) {
				foreach ($TextData as $Element => $ElementText) {
					if (array_key_exists($Element, $LNG[$TextKey])) continue;
					$LNG[$TextKey][$Element] = $ElementText;
				}
			}
		}

		ob_end_clean();

		$this->addData($LNG);
	}

	/** ArrayAccess Functions **/

    public function offsetSet(mixed $offset,mixed $value) : void {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists(mixed $offset) : bool {
        return isset($this->container[$offset]);
    }

    public function offsetUnset(mixed $offset) : void {
        unset($this->container[$offset]);
    }

    public function offsetGet(mixed $offset) : mixed {
        return isset($this->container[$offset]) ? $this->container[$offset] : $offset;
    }
}
