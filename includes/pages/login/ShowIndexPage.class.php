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

class ShowIndexPage extends AbstractLoginPage
{
	function __construct()
	{
		parent::__construct();
		$this->setWindow('light');
	}

	function parseRememberMeToken($token) {
    $parts = explode(':', $token);

    if ($parts && count($parts) == 3) {
        return [$parts[0], $parts[1], $parts[2]];
    }
    return false;
	}

	function show()
	{
		global $LNG, $config;

		$referralID		= HTTP::_GP('ref', 0);
		if(!empty($referralID))
		{
			$this->redirectTo('index.php?page=register&referralID='.$referralID);
		}

		$universeSelect	= array();



		$Code	= HTTP::_GP('code', 0);
		$loginCode	= false;
		if(isset($LNG['login_error_'.$Code]))
		{
			$loginCode	= $LNG['login_error_'.$Code];
		}



		$rememberedEmail = $rememberedPassword = $rememberedTokenValidator = $rememberedTokenSelector = "";

		$rememberedUniverseID = Universe::current();

		if (isset($_COOKIE['remember_me'])) {

			$rememberMeInfo = $this->parseRememberMeToken($_COOKIE['remember_me']);

			if ($rememberMeInfo) {

				$sql = "SELECT * FROM %%REMEMBER_ME%% WHERE selector = :selector;";

				$tokenInfo = Database::get()->selectSingle($sql,array(
					':selector' => $rememberMeInfo[1]
				));

				if (
					isset($tokenInfo['hashed_validator']) &&
					isset($tokenInfo['user_id']) &&
					isset($rememberMeInfo[0]) &&
					isset($rememberMeInfo[1]) &&
					isset($rememberMeInfo[2])
					) {


					if (password_verify($rememberMeInfo[2], $tokenInfo['hashed_validator'])) {

						$sql = "SELECT email FROM %%USERS%% WHERE id = :userId;";

						$rememberedEmail = Database::get()->selectSingle($sql,array(
							':userId' => $tokenInfo['user_id']
						),'email');

						$rememberedPassword = true;

						$rememberedUniverseID = $rememberMeInfo[0];
						$rememberedTokenSelector = $rememberMeInfo[1];
						$rememberedTokenValidator = $rememberMeInfo[2];
					}
				}

			}




		}


		$this->assign(array(
			'code'					=> $loginCode,
			'use_recaptcha_on_login' => $config->use_recaptcha_on_login,
			'csrfToken' => $this->generateCSRFToken(),
			'rememberedEmail' => $rememberedEmail,
			'rememberedPassword' => $rememberedPassword,
			'rememberedTokenValidator' => $rememberedTokenValidator,
			'rememberedTokenSelector' => $rememberedTokenSelector,
			'rememberedUniverseID' => $rememberedUniverseID,
		));



		$this->display('page.index.default.tpl');
	}
}
