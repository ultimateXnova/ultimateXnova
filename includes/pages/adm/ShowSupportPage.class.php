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


class ShowSupportPage extends AbstractAdminPage
{
	private $ticketObj;

	function __construct()
	{
		parent::__construct();

		require('includes/classes/class.SupportTickets.php');
		$this->ticketObj	= new SupportTickets;
		// 2Moons 1.7TO1.6 PageClass Wrapper
		$ACTION = HTTP::_GP('mode', 'show');
		if(is_callable(array($this, $ACTION))) {
			$this->{$ACTION}();
		} else {
			$this->show();
    }
	}

	public function show()
	{
		global $USER, $LNG;

		$db = Database::get();

		$sql = "SELECT t.*, u.username, COUNT(a.ticketID) as answer FROM
		%%TICKETS%% as t INNER JOIN %%TICKETS_ANSWER%% as a USING (ticketID)
		INNER JOIN %%USERS%% as u ON u.id = t.ownerID WHERE t.universe = :universe
		GROUP BY a.ticketID ORDER BY t.ticketID DESC;";

		$ticketResult = $db->select($sql,array(
			':universe' => Universe::getEmulated()
		));

		$ticketList		= array();

		foreach($ticketResult as &$ticketRow) {
			$ticketRow['time']	= _date($LNG['php_tdformat'], $ticketRow['time'], $USER['timezone']);

			$ticketList[$ticketRow['ticketID']]	= $ticketRow;
		}
		unset($ticketRow);


		$this->assign(array(
			'ticketList'	=> $ticketList
		));

		$this->display('page.ticket.default.tpl');
	}

	function send()
	{
		global $USER, $LNG;

		$db = Database::get();

		$ticketID	= HTTP::_GP('id', 0);
		$message	= HTTP::_GP('message', '', true);
		$change		= HTTP::_GP('change_status', 0);

		$sql = "SELECT ownerID, subject, status FROM %%TICKETS%% WHERE ticketID = :ticketID;";

		$ticketDetail = $db->selectSingle($sql,array(
			':ticketID' => $ticketID
		));


		$status = ($change ? ($ticketDetail['status'] <= 1 ? 2 : 1) : 1);


		if(!$change && empty($message))
		{
			HTTP::redirectTo('admin.php?page=support&mode=view&id='.$ticketID);
		}

		$subject		= "RE: ".$ticketDetail['subject'];

		if($change && $status == 1) {
			$this->ticketObj->createAnswer($ticketID, $USER['id'], $USER['username'], $subject, $LNG['ti_admin_open'], $status);
		}

		if(!empty($message))
		{
			$this->ticketObj->createAnswer($ticketID, $USER['id'], $USER['username'], $subject, $message, $status);
		}

		if($change && $status == 2) {
			$this->ticketObj->createAnswer($ticketID, $USER['id'], $USER['username'], $subject, $LNG['ti_admin_close'], $status);
		}


		$subject	= sprintf($LNG['sp_answer_message_title'], $ticketID);
		$text		= sprintf($LNG['sp_answer_message'], $ticketID);

		PlayerUtil::sendMessage($ticketDetail['ownerID'], $USER['id'], $USER['username'], 4,
			$subject, $text, TIMESTAMP, NULL, 1, Universe::getEmulated());

		HTTP::redirectTo('admin.php?page=support');
	}

	function view()
	{
		global $USER, $LNG;

		$db = Database::get();

		$ticketID			= HTTP::_GP('id', 0);

		$sql = "SELECT a.*, t.categoryID, t.status FROM %%TICKETS_ANSWER%% as a
		INNER JOIN %%TICKETS%% as t USING(ticketID) WHERE a.ticketID = :ticketID
		ORDER BY a.answerID;";

		$answerResult = $db->select($sql,array(
			':ticketID' => $ticketID
		));

		$answerList			= array();




		$ticket_status		= 0;
		foreach($answerResult as &$answerRow) {

			if (empty($ticket_status)){
				$ticket_status = $answerRow['status'];
			}

			$answerRow['time']	= _date($LNG['php_tdformat'], $answerRow['time'], $USER['timezone']);
			$answerRow['message']	= BBCode::parse($answerRow['message']);

			$answerList[$answerRow['answerID']]	= $answerRow;
		}
		unset($answerResult);



		$categoryList	= $this->ticketObj->getCategoryList();



		$this->assign(array(
			'ticketID'		=> $ticketID,
			'ticket_status' => $ticket_status,
			'categoryList'	=> $categoryList,
			'answerList'	=> $answerList,
		));



		$this->display('page.ticket.view.tpl');
	}
}
