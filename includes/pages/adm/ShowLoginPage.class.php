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


/**
 *
 */
class ShowLoginPage extends AbstractAdminPage
{

	function __construct()
	{
		global $USER;

		if ($USER['authlevel'] == AUTH_USR)
		{
		  throw new PagePermissionException("Permission error!");
		}

		parent::__construct();
		$this->setWindow('login');
	}

	function show(){
		global $USER,$config;

		$session	= Session::create();
		if($session->adminAccess == 1)
		{
			$this->redirectTo('admin.php?page=overview');
		}


		$this->assign(array(
			'bodyclass'	=> 'standalone',
			'username'	=> $USER['username'],
			'recaptchaEnable' => $config->capaktiv,
			'use_recaptcha_on_admin_login' => $config->use_recaptcha_on_admin_login,
			'recaptchaPublicKey' => $config->cappublic,
		));

		$this->display('page.login.default.tpl');

	}


	function validate(){
		global $USER, $LNG, $config;

		$error = array();

		$enteredPassword = HTTP::_GP('password', '', true);

		if (!password_verify($enteredPassword, $USER['password'])) {
			$error[] = $LNG['adm_bad_password'];
		}



		if ($config->capaktiv && $config->use_recaptcha_on_admin_login)
		{
      require('includes/libs/reCAPTCHA/src/autoload.php');

      $recaptcha = new \ReCaptcha\ReCaptcha($config->capprivate);
      $resp = $recaptcha->verify(HTTP::_GP('g_recaptcha_response', ''), Session::getClientIp());
      if (!$resp->isSuccess())
      {
          $error[]	= $LNG['adm_login_recaptcha_false'];
      }
		}

		if (empty($error)) {

			$session	= Session::create();
			$session->adminAccess	= 1;

			$data = array();
			$data['status'] = "redirect";
			$this->sendJSON($data);
		}else {
			$error['status'] = "fail";
			$this->sendJSON($error);
		}


	}

}
