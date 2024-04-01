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
class ShowNewsPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){

		global $LNG, $USER;

		$db = Database::get();

		$sql = "SELECT * FROM %%NEWS%% ORDER BY id ASC;";

		$news = $db->select($sql);

		$NewsList = array();

		foreach ($news as $u) {
			$NewsList[]	= array(
				'id'		=> $u['id'],
				'title'		=> $u['title'],
				'date'		=> _date($LNG['php_tdformat'], $u['date'], $USER['timezone']),
				'user'		=> $u['user'],
				'confirm'	=> sprintf($LNG['nws_confirm'], $u['title']),
			);
		}


		$this->assign(array(
			'NewsList'		=> $NewsList,
			'nws_total'		=> sprintf($LNG['nws_total'], $NewsList && count($NewsList)),

		));

		$this->display('page.news.default.tpl');

	}

	function create(){
		global $LNG;

		$this->assign(array(
			'nws_head'		=> $LNG['nws_head_create'],
		));

		$this->display('page.news.create.tpl');

	}

	function createSend(){

		global $USER;

		$title 		= HTTP::_GP('title', '', true);
		$text 		= HTTP::_GP('text', '', true);

		$db = Database::get();

		$sql = "INSERT INTO %%NEWS%% (`id`, `user`, `date`, `title`, `text`) VALUES
		(NULL, :userName, :actionTime, :title, :newsText);";

		$db->insert($sql,array(
			':userName' => $USER['username'],
			':actionTime' => TIMESTAMP,
			':title' => $title,
			':newsText' => $text
		));

		$this->show();

	}


	function delete(){

		$db = Database::get();

		$sql = "DELETE FROM %%NEWS%% WHERE `id` = :news_id;";

		$db->delete($sql,array(
			':news_id' => HTTP::_GP('id', 0)
		));

		$this->show();

	}

	function edit(){

		global $LNG;

		$db = Database::get();

		$sql = "SELECT id, title, text FROM %%NEWS%% WHERE id = :id;";

		$News = $db->selectSingle($sql,array(
			':id' => HTTP::_GP('id',0)
		));

		$this->assign(array(
			'mode'			=> 1,
			'nws_head'		=> sprintf($LNG['nws_head_edit'], $News['title']),
			'news_id'		=> $News['id'],
			'news_title'	=> $News['title'],
			'news_text'		=> $News['text'],
		));

		$this->display('page.news.edit.tpl');


	}

	function editSend(){

		$db = Database::get();

		$title 		= HTTP::_GP('title', '', true);
		$text 		= HTTP::_GP('text', '', true);
		$edit_id 	= HTTP::_GP('id', 0);

		$sql = "UPDATE %%NEWS%% SET `title` = :title, `text` = :newsText, `date` = :actionTime WHERE `id` = :edit_id LIMIT 1;";

		$db->update($sql,array(
			':title' => $title,
			':newsText' => $text,
			':actionTime' => TIMESTAMP,
			':edit_id' => $edit_id
		));

		$this->show();

	}

}
