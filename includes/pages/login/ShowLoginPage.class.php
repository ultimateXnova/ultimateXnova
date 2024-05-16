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


class ShowLoginPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct()
	{
		parent::__construct();
	}

	function generateRememberMeToken($universe){

    $selector = bin2hex(random_bytes(16));
    $validator = bin2hex(random_bytes(32));

		return array(
			'selector' => $selector,
			'validator' => $validator,
			'full' => $universe . ':' . $selector . ':' . $validator
		);

	}



	function validate(){
		global $config, $LNG;


		$db = Database::get();

		$userEmail = HTTP::_GP('userEmail', '', true);
		$password = HTTP::_GP('password', '', true);

		$csrfToken = HTTP::_GP('csrfToken','',true);
		$remember_me = HTTP::_GP('remember_me', 'false');

		$rememberedTokenValidator = HTTP::_GP('rememberedTokenValidator', '');
		$rememberedTokenSelector = HTTP::_GP('rememberedTokenSelector', '');
		$rememberedEmail = HTTP::_GP('rememberedEmail','');

		$universe = HTTP::_GP('universe', Universe::current());

		$error = array();


		if ($_COOKIE['csrfToken'] != $csrfToken) {
			$error[] = "csrf attack";
		}

		if (empty($userEmail)) {
			$error[] = $LNG['login_error_1'];
		}

		if (empty($password)) {
			$error[] = $LNG['login_error_2'];
		}

		if (!empty($password) && !empty($userEmail)) {
			$sql = "SELECT id, password FROM %%USERS%% WHERE email = :email AND universe = :universe;";
	
			$loginData = $db->selectSingle($sql, array(
				':email'	=> $userEmail,
				':universe'	=> $universe,
			));

			if (!$loginData) {
				// Check with username
				$sql = "SELECT id, password FROM %%USERS%% WHERE username = :email AND universe = :universe;";
	
				$loginData = $db->selectSingle($sql, array(
					':email'	=> $userEmail,
					':universe'	=> $universe,
				));
				if (!$loginData) {
					$error[] = $LNG['login_error_3'];
				}
			}
		}

		if (empty($rememberedTokenValidator) || empty($rememberedTokenSelector) || $rememberedEmail != $userEmail || $password != 'password') { //verify with password
			
			if (isset($loginData['password'])) {
				
				if (!password_verify($password,$loginData['password'])) {
					$error[] = $LNG['login_error_5'];
				}
			}




		} else { //verify with token

			//if user type a random password

		

			$sql = "SELECT * FROM %%REMEMBER_ME%% WHERE selector = :selector;";

			$rememberedTokenInfo = $db->selectSingle($sql,array(
				':selector' => $rememberedTokenSelector,
			));


			if (!$rememberedTokenInfo) {
				$error[] = $LNG['login_error_3'];
			}

			if (isset($rememberedTokenInfo['hashed_validator'])) {
				if (!password_verify($rememberedTokenValidator, $rememberedTokenInfo['hashed_validator'])) {
					$error[] = $LNG['login_error_3'];
				}



				$sql = "SELECT email FROM %%USERS%% WHERE id = :userId;";

				$userEmailCheck = $db->selectSingle($sql,array(
					':userId' => $rememberedTokenInfo['user_id'],
				),'email');



				if (empty($userEmailCheck)) {
					$error[] = $LNG['login_error_1'];
				}

				if ($userEmailCheck != $userEmail) {
					$error[] = $LNG['login_error_3'];
				}

			}


		}




		if ($config->capaktiv === '1' && $config->use_recaptcha_on_login)
		{
      require('includes/libs/reCAPTCHA/src/autoload.php');

      $recaptcha = new \ReCaptcha\ReCaptcha($config->capprivate);
      $resp = $recaptcha->verify(HTTP::_GP('g_recaptcha_response', ''), Session::getClientIp());
      if (!$resp->isSuccess())
      {
          $error[]	= $LNG['login_error_4'];
      }
		}



		if (empty($error))
		{
			$session	= Session::create();
			$session->userId		= (int) $loginData['id'];
			$session->adminAccess	= 0;
			$session->save();


			if ($remember_me == 'true') {
				$rememberMeToken = $this->generateRememberMeToken($universe);

				//set a cookie
				HTTP::sendCookie('remember_me',$rememberMeToken['full'], TIMESTAMP + 60 * 60 * 24 * 30);

				//delete old remember me data

				$sql = "DELETE FROM %%REMEMBER_ME%% WHERE `user_id` = :userId;";

				$db->delete($sql,array(
					':userId' => (int) $loginData['id']
				));


				//insert new remember data,

				$sql = "INSERT INTO %%REMEMBER_ME%% (`selector`,`hashed_validator`, `expiration_date`, `user_id`,`universe`)
				VALUES (:selector,:hashed_validator,:expiration_date,:user_id,:universe);";

				$db->insert($sql,array(
					':selector' => $rememberMeToken['selector'],
					':hashed_validator' => password_hash($rememberMeToken['validator'], PASSWORD_DEFAULT),
					':expiration_date' => TIMESTAMP + 60 * 60 * 24 * 30, //30 days
					':user_id' => (int) $loginData['id'],
					':universe' => $universe
				));


			}

			if ($remember_me == "false") {
				$sql = "DELETE FROM %%REMEMBER_ME%% WHERE user_id = :userId;";
				$db->delete($sql,array(
					':userId' => (int) $loginData['id']
				));
			}

			$data = array();
			$data['status'] = "redirect";
			$this->sendJSON($data);
		}
		else
		{
			$error['status'] = "fail";
			$this->sendJSON($error);
		}

	}


}
