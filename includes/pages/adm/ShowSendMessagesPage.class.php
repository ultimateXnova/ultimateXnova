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
class ShowSendMessagesPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $USER, $LNG;

		$db = Database::get();

		$sendModes	= $LNG['ma_modes'];

		if(Config::get()->mail_active == 0)
		{
			unset($sendModes[1]);
			unset($sendModes[2]);
		}


		$this->assign(array(
			'langSelector' => array_merge(array('' => $LNG['ma_all']), $LNG->getAllowedLangs(false)),
			'modes' => $sendModes,
		));

		$this->display('page.sendmessages.default.tpl');

	}

	function send(){

		global $USER, $LNG;

		$db = Database::get();

		switch($USER['authlevel'])
		{
			case AUTH_MOD:
				$class = 'mod';
			break;
			case AUTH_OPS:
				$class = 'ops';
			break;
			case AUTH_ADM:
				$class = 'admin';
			break;
			default:
				$class = '';
			break;
		}


		$Subject	= HTTP::_GP('subject', '', true);
		$Message 	= HTTP::_GP('text', '', true);
		$Mode	 	= HTTP::_GP('type', 0);
		$Lang		= HTTP::_GP('globalmessagelang', '');

		if (!empty($Message) && !empty($Subject))
		{
			if($Mode == 0 || $Mode == 2) {
				$From    	= '<span class="'.$class.'">'.$LNG['user_level_'.$USER['authlevel']].' '.$USER['username'].'</span>';
				$pmSubject 	= '<span class="'.$class.'">'.$Subject.'</span>';
				$pmMessage 	= '<span class="'.$class.'">'.BBCode::parse($Message).'</span>';



				if (!empty($Lang)) {
					$sql = "SELECT `id`, `username` FROM %%USERS%%
					WHERE `universe` = :universe ";
					$sql .= " AND `lang` = :lang;";

					$USERS = $db->select($sql,array(
						':universe' => Universe::getEmulated(),
						':lang' => $Lang
					));

				}else {

					$sql = "SELECT `id`, `username` FROM %%USERS%%
					WHERE `universe` = :universe ";

					$USERS = $db->select($sql,array(
						':universe' => Universe::getEmulated(),
					));

				}

				foreach($USERS as $UserData)
				{
					$sendMessage = str_replace('{USERNAME}', $UserData['username'], $pmMessage);
					PlayerUtil::sendMessage($UserData['id'], $USER['id'], $From, 50, $pmSubject, $sendMessage, TIMESTAMP, NULL, 1, Universe::getEmulated());
				}
			}

			if($Mode == 1 || $Mode == 2) {
				require 'includes/classes/Mail.class.php';
				$userList	= array();

				if (!empty($Lang)) {
					$sql = "SELECT `email`, `username` FROM %%USERS%%
					WHERE `universe` = :universe ";
					$sql .= " AND `lang` = :lang;";

					$USERS = $db->select($sql,array(
						':universe' => Universe::getEmulated(),
						':lang' => $Lang
					));

				}else {

					$sql = "SELECT `email`, `username` FROM %%USERS%%
					WHERE `universe` = :universe ";

					$USERS = $db->select($sql,array(
						':universe' => Universe::getEmulated(),
					));

				}

				foreach($USERS as $UserData)
				{
					$userList[$UserData['email']]	= array(
						'username'	=> $UserData['username'],
						'body'		=> BBCode::parse(str_replace('{USERNAME}', $UserData['username'], $Message))
					);
				}

				Mail::multiSend($userList, strip_tags($Subject));
			}
			$this->printMessage($LNG['ma_message_sended']);
		} else {
			$this->printMessage($LNG['ma_subject_needed']);
		}

	}

}
