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

class SupportTickets
{
	public function createTicket($ownerID, $categoryID, $subject)
	{
		$sql 	= 'INSERT INTO %%TICKETS%% SET
		ownerID		= :ownerId,
		universe	= :universe,
		categoryID	= :categoryId,
		subject		= :subject,
		time		= :time;';

		Database::get()->insert($sql, array(
			':ownerId'		=> $ownerID,
			':universe'		=> Universe::current(),
			':categoryId'	=> $categoryID,
			':subject'		=> $subject,
			':time'			=> TIMESTAMP
		));

		return Database::get()->lastInsertId();
	}

	public function createAnswer($ticketID, $ownerID, $ownerName, $subject, $message, $status)
	{
		$sql = 'INSERT INTO %%TICKETS_ANSWER%% SET
		ticketID	= :ticketId,
		ownerID		= :ownerId,
		ownerName	= :ownerName,
		subject		= :subject,
		message		= :message,
		time		= :time;';

		Database::get()->insert($sql, array(
			':ticketId'		=> $ticketID,
			':ownerId'		=> $ownerID,
			':ownerName'	=> $ownerName,
			':subject'		=> $subject,
			':message'		=> $message,
			':time'			=> TIMESTAMP
		));

		$answerId = Database::get()->lastInsertId();

		$sql	= 'UPDATE %%TICKETS%% SET status = :status WHERE ticketID = :ticketId;';

		Database::get()->update($sql, array(
			':status'	=> $status,
			':ticketId'	=> $ticketID
		));

		return $answerId;
	}

	public function getCategoryList()
	{
		$sql	= 'SELECT * FROM %%TICKETS_CATEGORY%%;';

		$categoryResult		= Database::get()->select($sql);
		$categoryList		= array();

		foreach($categoryResult as $categoryRow)
		{
			$categoryList[$categoryRow['categoryID']]	= $categoryRow['name'];
		}

		return $categoryList;
	}
}
