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
 class ShowServerPage extends AbstractAdminPage
 {

 	function __construct()
 	{
 		parent::__construct();
 	}

  function show(){

    global $LNG;

    $config = Config::get(Universe::getEmulated());



    $TimeZones		= get_timezone_selector();

    $this->assign(array(
      'del_oldstuff'					=> $config->del_oldstuff,
      'del_user_manually'				=> $config->del_user_manually,
      'del_user_automatic'			=> $config->del_user_automatic,
      'del_user_sendmail'				=> $config->del_user_sendmail,
      'sendmail_inactive'				=> $config->sendmail_inactive,
      'ttf_file'						=> $config->ttf_file,
      'game_name'						=> $config->game_name,
      'mail_active'					=> $config->mail_active,
      'mail_use'						=> $config->mail_use,
      'smail_path'					=> $config->smail_path,
      'smtp_host' 					=> $config->smtp_host,
      'smtp_port' 					=> $config->smtp_port,
      'smtp_user' 					=> $config->smtp_user,
      'smtp_pass' 					=> $config->smtp_pass,
      'smtp_sendmail' 				=> $config->smtp_sendmail,
      'smtp_ssl'						=> $config->smtp_ssl,
      'capprivate' 					=> $config->capprivate,
      'cappublic' 	   				=> $config->cappublic,
      'capaktiv'      	           	=> $config->capaktiv,
          'ga_active'               		=> $config->ga_active,
      'ga_key'           				=> $config->ga_key,
      'timezone'           			=> $config->timezone,
      'dst'           				=> $config->dst,
      'message_delete_behavior'  		=> $config->message_delete_behavior,
      'message_delete_days'         	=> $config->message_delete_days,
      'use_recaptcha_on_login' => $config->use_recaptcha_on_login,
      'use_recaptcha_on_register' => $config->use_recaptcha_on_register,
      'use_recaptcha_on_admin_login' => $config->use_recaptcha_on_admin_login,
      'server_default_theme' => $config->server_default_theme,
      'let_users_change_theme' => $config->let_users_change_theme,
      'password_recover_type' => $config->password_recover_type,
      'Selector'						=> array(
          'timezone' => $TimeZones,
              'mail' => $LNG['se_mail_sel'],
              'encry' => array('' => $LNG['se_smtp_ssl_1'], 'ssl' => $LNG['se_smtp_ssl_2'], 'tls' => $LNG['se_smtp_ssl_3']),
              'message_delete_behavior' => array(0 => $LNG['se_message_delete_behavior_0'], 1 => $LNG['se_message_delete_behavior_1']),
          ),
    ));

    $this->display('page.server.default.tpl');

  }

  function saveSettings(){

    global $LNG;

    $config = Config::get(Universe::getEmulated());


      $config_before = array(
        'ttf_file'				=> $config->ttf_file,
        'game_name'				=> $config->game_name,
        'mail_active'			=> $config->mail_active,
        'mail_use'				=> $config->mail_use,
        'smail_path'			=> $config->smail_path,
        'smtp_host'				=> $config->smtp_host,
        'smtp_port'				=> $config->smtp_port,
        'smtp_user'				=> $config->smtp_user,
        'smtp_pass'				=> $config->smtp_pass,
        'smtp_ssl'				=> $config->smtp_ssl,
        'smtp_sendmail'			=> $config->smtp_sendmail,
        'ga_active'				=> $config->ga_active,
        'ga_key'				=> $config->ga_key,
        'capaktiv'				=> $config->capaktiv,
        'cappublic'				=> $config->cappublic,
        'capprivate'			=> $config->capprivate,
        'use_recaptcha_on_login' => $config->use_recaptcha_on_login,
        'use_recaptcha_on_register' => $config->use_recaptcha_on_register,
        'use_recaptcha_on_admin_login' => $config->use_recaptcha_on_admin_login,
        'del_oldstuff'			=> $config->del_oldstuff,
        'del_user_manually'		=> $config->del_user_manually,
        'del_user_automatic'	=> $config->del_user_automatic,
        'del_user_sendmail'		=> $config->del_user_sendmail,
        'sendmail_inactive'		=> $config->sendmail_inactive,
        'timezone'				=> $config->timezone,
        'dst'					=> $config->dst,
        'close_reason'			=> $config->close_reason,
        'message_delete_behavior' => $config->message_delete_behavior,
        'message_delete_days'	=> $config->message_delete_days,
        'server_default_theme' => $config->server_default_theme,
        'let_users_change_theme' => $config->let_users_change_theme,
        'password_recover_type' => $config->password_recover_type,
      );

      $capaktiv 				= isset($_POST['capaktiv']) && $_POST['capaktiv'] == 'on' ? 1 : 0;
      $ga_active 				= isset($_POST['ga_active']) && $_POST['ga_active'] == 'on' ? 1 : 0;
      $sendmail_inactive 		= isset($_POST['sendmail_inactive']) && $_POST['sendmail_inactive'] == 'on' ? 1 : 0;
      $mail_active 			= isset($_POST['mail_active']) && $_POST['mail_active'] == 'on' ? 1 : 0;

      $ttf_file				= HTTP::_GP('ttf_file', '');
      $close_reason			= HTTP::_GP('close_reason', '', true);
      $game_name				= HTTP::_GP('game_name', '', true);
      $capprivate				= HTTP::_GP('capprivate', '');
      $cappublic				= HTTP::_GP('cappublic', '');
      $use_recaptcha_on_login = (HTTP::_GP('use_recaptcha_on_login', 'off') == 'on') ? 1 : 0;
      $use_recaptcha_on_register = (HTTP::_GP('use_recaptcha_on_register', 'off') == 'on') ? 1 : 0;
      $use_recaptcha_on_admin_login = (HTTP::_GP('use_recaptcha_on_admin_login', 'off') == 'on') ? 1 : 0;
      $ga_key					= HTTP::_GP('ga_key', '', true);
      $mail_use				= HTTP::_GP('mail_use', 0);
      $smail_path				= HTTP::_GP('smail_path', '');
      $smtp_host				= HTTP::_GP('smtp_host', '', true);
      $smtp_port				= HTTP::_GP('smtp_port', 0);
      $smtp_user				= HTTP::_GP('smtp_user', '', true);
      $smtp_sendmail			= HTTP::_GP('smtp_sendmail', '', true);
      $smtp_pass				= HTTP::_GP('smtp_pass', '', true);
      $smtp_ssl				= HTTP::_GP('smtp_ssl', '');
      $del_oldstuff			= HTTP::_GP('del_oldstuff', 0);
      $del_user_manually		= HTTP::_GP('del_user_manually', 0);
      $del_user_automatic		= HTTP::_GP('del_user_automatic', 0);
      $del_user_sendmail		= HTTP::_GP('del_user_sendmail', 0);
      $timezone				= HTTP::_GP('timezone', '');
      $dst					= HTTP::_GP('dst', 0);
      $message_delete_behavior = HTTP::_GP('message_delete_behavior', 0);
      $message_delete_days	= HTTP::_GP('message_delete_days', 0);
      $server_default_theme = HTTP::_GP('server_default_theme', 'gow');
      $let_users_change_theme = (HTTP::_GP('let_users_change_theme', 'off') == 'on') ? 1 : 0;
      $password_recover_type = HTTP::_GP('password_recover_type','2');

      $config_after = array(
        'ttf_file'				=> $ttf_file,
        'game_name'				=> $game_name,
        'mail_active'			=> $mail_active,
        'mail_use'				=> $mail_use,
        'smail_path'			=> $smail_path,
        'smtp_host'				=> $smtp_host,
        'smtp_port'				=> $smtp_port,
        'smtp_user'				=> $smtp_user,
        'smtp_pass'				=> $smtp_pass,
        'smtp_ssl'				=> $smtp_ssl,
        'smtp_sendmail'			=> $smtp_sendmail,
        'ga_active'				=> $ga_active,
        'ga_key'				=> $ga_key,
        'capaktiv'				=> $capaktiv,
        'cappublic'				=> $cappublic,
        'capprivate'			=> $capprivate,
        'del_oldstuff'			=> $del_oldstuff,
        'del_user_manually'		=> $del_user_manually,
        'del_user_automatic'	=> $del_user_automatic,
        'del_user_sendmail'		=> $del_user_sendmail,
        'sendmail_inactive'		=> $sendmail_inactive,
        'timezone'				=> $timezone,
        'dst'					=> $dst,
        'close_reason'			=> $close_reason,
        'message_delete_behavior' => $message_delete_behavior,
        'message_delete_days'	=> $message_delete_days,
        'use_recaptcha_on_login' => $use_recaptcha_on_login,
        'use_recaptcha_on_register' => $use_recaptcha_on_register,
        'use_recaptcha_on_admin_login' => $use_recaptcha_on_admin_login,
        'server_default_theme' => $server_default_theme,
        'let_users_change_theme' => $let_users_change_theme,
        'password_recover_type' => $password_recover_type
      );

      foreach($config_after as $key => $value)
      {
        $config->$key	= $value;
      }
      $config->save();

      $LOG = new Log(3);
      $LOG->target = 0;
      $LOG->old = $config_before;
      $LOG->new = $config_after;
      $LOG->save();

      $redirectButton = array();
      $redirectButton[] = array(
        'url' => 'admin.php?page=server&mode=show',
        'label' => $LNG['uvs_back']
      );

      $this->printMessage($LNG['settings_successful'],$redirectButton);

    }


 }
