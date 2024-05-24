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

# Actions not logged: Planet-Edit, Alliance-Edit


/**
 *
 */
class ShowAccountsPage extends AbstractAdminPage
{

	function __construct()
	{
		parent::__construct();
	}

	function show(){


		$this->display('page.accounts.default.tpl');

	}

	function resources(){

		$this->display('page.accounts.resources.tpl');

	}

	function resourcesSend(){

		global $LNG;

		$id = HTTP::_GP('id', 0);
		$metal      = max(0, round(HTTP::_GP('metal', 0.0)));
		$crystal    = max(0, round(HTTP::_GP('cristal', 0.0)));
		$deut       = max(0, round(HTTP::_GP('deut', 0.0)));
		$type = HTTP::_GP('type','add');

		$planetSelectType = '';
		$galaxy = HTTP::_GP('galaxy',0);
		$system = HTTP::_GP('system',0);
		$planet = HTTP::_GP('planet',0);
		$planet_type = HTTP::_GP('planet_type', 0);


		if ($metal == 0 && $crystal == 0 && $deut == 0) {
			$this->printMessage('All resources are equal to zero !');
		}

		if (!in_array($type,array('add','delete'))) {
			$this->printMessage('type is wrong !');
		}

		if ($id == 0 && $galaxy == 0 && $system == 0 && $planet == 0) {
			$this->printMessage('Planet id or coordinate is not entered !');
		}


		$db = Database::get();

		($id != 0) ? $planetSelectType = 'id' : $planetSelectType = 'coordinate';

		if ($planetSelectType == 'id'){

			$sql = "SELECT `metal`,`crystal`,`deuterium`,`universe`  FROM %%PLANETS%% WHERE `id` = :id;";

			$before = $db->selectSingle($sql,array(
				':id' => $id
			));

		}else {
			$sql = "SELECT `metal`,`crystal`,`deuterium`,`universe`  FROM %%PLANETS%% WHERE `galaxy` = :galaxy AND `system` = :system AND `planet` = :planet AND planet_type = :planet_type;";

			$before = $db->selectSingle($sql,array(
				':galaxy' => $galaxy,
				':system' => $system,
				':planet' => $planet,
				':planet_type' => $planet_type
			));

		}



		if (!$before) {
			$this->printMessage('planet could not be found !');
		}


		if ($type == "add")
		{

				if ($planetSelectType == 'id'){
					$sql  = "UPDATE %%PLANETS%% SET `metal` = `metal` + :metal,
					 `crystal` = `crystal` + :crystal,
					 `deuterium` = `deuterium` + :deut WHERE `id` = :id AND `universe` = :universe;";

					$db->update($sql,array(
						':metal' => $metal,
						':crystal' => $crystal,
						':deut' => $deut,
						':id' => $id,
						':universe' => Universe::getEmulated(),
					));
				}else {
					$sql  = "UPDATE %%PLANETS%% SET `metal` = `metal` + :metal,
					 `crystal` = `crystal` + :crystal,
					 `deuterium` = `deuterium` + :deut WHERE galaxy = :galaxy AND `system` = :system AND planet = :planet AND planet_type = :planet_type AND `universe` = :universe;";

					$db->update($sql,array(
						':metal' => $metal,
						':crystal' => $crystal,
						':deut' => $deut,
						':galaxy' => $galaxy,
						':system' => $system,
						':planet' => $planet,
						':planet_type' => $planet_type,
						':universe' => Universe::getEmulated(),
					));
				}



			$after 		= array(
				'metal' => ($before['metal'] + $metal),
				'crystal' => ($before['crystal'] + $crystal),
				'deuterium' => ($before['deuterium'] + $deut)
			);

		} elseif ($type == "delete") {

				if ($planetSelectType == 'id') {

					$sql  = "UPDATE %%PLANETS%% SET `metal` = GREATEST(0, `metal` - :metal),
					`crystal` = GREATEST(0, `crystal` - :crystal), `deuterium` = GREATEST(0, `deuterium` - :deut)
					WHERE `id` = :id AND `universe` = :universe;";

					$db->update($sql,array(
						':metal' => $metal,
						':crystal' => $crystal,
						':deut' => $deut,
						':id' => $id,
						':universe' => Universe::getEmulated()
					));

				}else {

					$sql  = "UPDATE %%PLANETS%% SET `metal` = GREATEST(0, `metal` - :metal),
					`crystal` = GREATEST(0, `crystal` - :crystal), `deuterium` = GREATEST(0, `deuterium` - :deut)
					WHERE `galaxy` = :galaxy AND `system` = :system AND planet = :planet AND planet_type = :planet_type AND `universe` = :universe;";

					$db->update($sql,array(
						':metal' => $metal,
						':crystal' => $crystal,
						':deut' => $deut,
						':galaxy' => $galaxy,
						':system' => $system,
						':planet' => $planet,
						':planet_type' => $planet_type,
						':universe' => Universe::getEmulated()
					));

				}



				$after 		= array(
					'metal' => ($before['metal'] - $metal),
					'crystal' => ($before['crystal'] - $crystal),
					'deuterium' => ($before['deuterium'] - $deut)
				);



		}

			$LOG = new Log(2);
			$LOG->target = $id;
			$LOG->universe = $before['universe'];
			$LOG->old = $before;
			$LOG->new = $after;
			$LOG->save();



		if ($type == "add") {
			$this->printMessage($LNG['ad_add_res_sucess'], '?page=accounteditor&edit=resources');
		} else if ($type == "delete") {
			$this->printMessage($LNG['ad_delete_res_sucess'], '?page=accounteditor&edit=resources');
		}


		$this->display('page.accounts.resources.tpl');

	}

	function darkmatterSend(){
		global $LNG;

		$user_id    = HTTP::_GP('user_id', 0);
		$dark		= HTTP::_GP('dark', 0);
		$type = HTTP::_GP('type','add');


		if ($user_id == 0) {
			$this->printMessage('user id is not entered !');
		}

		if ($dark == 0) {
			$this->printMessage('Amount of dark matter is not set !');
		}

		if (!in_array($type,array('add','delete'))) {
			$this->printMessage('type is wrong !');
		}

		$db = Database::get();

		$sql = "SELECT `darkmatter`,`universe` FROM %%USERS%% WHERE `id` = :user_id;";

		$before_dm = $db->selectSingle($sql,array(
			':user_id' => $user_id
		));

		if (!$before_dm) {
			$this->printMessage('user could not be found !');
		}



		if ($type == "add")
		{

				$sql  = "UPDATE %%USERS%% SET `darkmatter` = `darkmatter` + :dark WHERE `id` = :user_id AND `universe` = :universe;";

				$db->update($sql,array(
					':dark' => $dark,
					':user_id' => $user_id,
					':universe' => Universe::getEmulated(),
				));

				$after_dm 	= array(
					'darkmatter' => ($before_dm['darkmatter'] + $dark)
				);

		}
		elseif ($type == "delete")
		{

			$sql  = "UPDATE %%USERS%% SET `darkmatter` = GREATEST(0, `darkmatter` - :dark) WHERE `id` = :user_id;";

			$db->update($sql,array(
				':dark' => $dark,
				':user_id' => $user_id
			));

			$after_dm 	= array(
				'darkmatter' => ($before_dm['darkmatter'] - $dark)
			);

		}



			$LOG = new Log(1);
			$LOG->target = $user_id;
			$LOG->universe = $before_dm['universe'];
			$LOG->old = $before_dm;
			$LOG->new = $after_dm;
			$LOG->save();

		if ($type == "add") {
			$this->printMessage($LNG['ad_add_res_sucess'], '?page=accounteditor&edit=resources');
		} else if ($type == "delete") {
			$this->printMessage($LNG['ad_delete_res_sucess'], '?page=accounteditor&edit=resources');
		}


		$this->display('page.accounts.resources.tpl');

	}

	function ships(){
		global $reslist, $resource;

		$INPUT = array();

		foreach($reslist['fleet'] as $ID)
		{
			$INPUT[$ID]	= array(
				'type'	=> $resource[$ID],
			);
		}

		$this->assign(array(
			'inputlist'			=> $INPUT,
		));

		$this->display('page.accounts.ships.tpl');

	}

	function shipsSend(){

		global $reslist, $resource, $LNG;

		$type = HTTP::_GP('type','add');

		if (!in_array($type,array('add','delete'))) {
			$this->printMessage('Wrong type !');
		}

		$db = Database::get();

		$sql = "SELECT * FROM %%PLANETS%% WHERE `id` = :planetId;";

		$planetInfo = $db->selectSingle($sql,array(
			':planetId' =>  HTTP::_GP('id', 0)
		));

		if (!$planetInfo) {
			$this->printMessage('Target planet does not exist !');
		}

		$before = $after = array();

		foreach($reslist['fleet'] as $ID)
		{
			$before[$ID] = $planetInfo[$resource[$ID]];
		}
		if ($type == "add")
		{
			$SQL  = "UPDATE %%PLANETS%% SET `eco_hash` = '', ";
			foreach($reslist['fleet'] as $ID)
			{
				$QryUpdate[]	= "`".$resource[$ID]."` = `".$resource[$ID]."` + '".max(0, round(HTTP::_GP($resource[$ID], 0.0)))."'";
				$after[$ID] = $before[$ID] + max(0, round(HTTP::_GP($resource[$ID], 0.0)));
			}
			$SQL .= implode(", ", $QryUpdate);
			$SQL .= "WHERE ";
			$SQL .= "`id` = :planetId AND `universe` = :universe;";

			$db->update($SQL,array(
				':planetId' => HTTP::_GP('id', 0),
				':universe' => Universe::getEmulated(),
			));

		}
		elseif ($type == "delete")
		{
			$SQL  = "UPDATE %%PLANETS%% SET `eco_hash` = '', ";

			foreach($reslist['fleet'] as $ID)
			{
				$QryUpdate[]	= "`".$resource[$ID]."` = GREATEST(0,  `".$resource[$ID]."` - '".max(0, round(HTTP::_GP($resource[$ID], 0.0)))."')";
				$after[$ID] = max($before[$ID] - max(0, round(HTTP::_GP($resource[$ID], 0.0))),0);
			}

			$SQL .= implode(", ", $QryUpdate);
			$SQL .= "WHERE ";
			$SQL .= "`id` = :planetId AND `universe` = :universe;";
			$db->update($SQL,array(
				':planetId' => HTTP::_GP('id', 0),
				':universe' => Universe::getEmulated()
			));
		}

		$LOG = new Log(2);
		$LOG->target = HTTP::_GP('id', 0);
		$LOG->universe = $planetInfo['universe'];
		$LOG->old = $before;
		$LOG->new = $after;
		$LOG->save();

		if ($type == "add") {
			$this->printMessage($LNG['ad_add_ships_sucess']);
		} else if ($type == "delete") {
			$this->printMessage($LNG['ad_delete_ships_sucess']);
		}


	}

	function defenses(){
		global $reslist, $resource;

		foreach($reslist['defense'] as $ID)
		{
			$INPUT[$ID]	= array(
				'type'	=> $resource[$ID],
			);
		}

		$this->assign(array(
			'inputlist'			=> $INPUT,
		));

		$this->display('page.accounts.defenses.tpl');

	}

	function defensesSend(){

		global $reslist, $resource, $LNG;

		$type = HTTP::_GP('type','add');

		$planetId = HTTP::_GP('id',0);

		if (!in_array($type,array('add','delete'))) {
			$this->printMessage('Wrong type !');
		}

		$db = Database::get();

		$sql = "SELECT * FROM %%PLANETS%% WHERE `id` = :planetId;";

		$planetInfo = $db->selectSingle($sql,array(
		 ':planetId' => $planetId,
		));

		if (!$planetInfo) {
			$this->printMessage('Target planet does not exist !');
		}

		$before = $after = array();

		foreach($reslist['defense'] as $ID)
		{
			$before[$ID] = $planetInfo[$resource[$ID]];
		}
		if ($type == 'add')
		{
			$SQL  = "UPDATE %%PLANETS%% SET ";
			foreach($reslist['defense'] as $ID)
			{
				$QryUpdate[]	= "`".$resource[$ID]."` = `".$resource[$ID]."` + '".max(0, round(HTTP::_GP($resource[$ID], 0.0)))."'";
				$after[$ID] = $before[$ID] + max(0, round(HTTP::_GP($resource[$ID], 0.0)));
			}
			$SQL .= implode(", ", $QryUpdate);
			$SQL .= "WHERE ";
			$SQL .= "`id` = :planetId AND `universe` = :universe;";

			$db->update($SQL,array(
				':planetId' => HTTP::_GP('id', 0),
				':universe' => Universe::getEmulated()
			));

		}
		elseif ($type == 'delete')
		{
			$SQL  = "UPDATE %%PLANETS%% SET ";
			foreach($reslist['defense'] as $ID)
			{
				$QryUpdate[]	= "`".$resource[$ID]."` = GREATEST (0, `".$resource[$ID]."` - '".max(0, round(HTTP::_GP($resource[$ID], 0.0)))."')";
				$after[$ID] = max($before[$ID] - max(0, round(HTTP::_GP($resource[$ID], 0.0))),0);
			}
			$SQL .= implode(", ", $QryUpdate);
			$SQL .= "WHERE ";
			$SQL .= "`id` = :planetId AND `universe` = :universe;";
			$db->update($SQL,array(
				':planetId' => HTTP::_GP('id', 0),
				':universe' => Universe::getEmulated()
			));
			$Name	=	$LNG['log_nomoree'];
		}

		$LOG = new Log(2);
		$LOG->target = HTTP::_GP('id', 0);
		$LOG->universe = $planetInfo['universe'];
		$LOG->old = $before;
		$LOG->new = $after;
		$LOG->save();

		if ($type == 'add') {
			$this->printMessage($LNG['ad_add_defenses_success']);
		} else if ($type == 'delete') {
			$this->printMessage($LNG['ad_delete_defenses_success']);
		}

	}

	function buildings(){

		global $reslist,$resource;

		foreach($reslist['build'] as $ID)
		{
			$INPUT[$ID]	= array(
				'type'	=> $resource[$ID],
			);
		}

		$this->assign(array(
			'inputlist'			=> $INPUT,
		));

		$this->display('page.accounts.buildings.tpl');

	}

	function buildingsSend(){

		global $reslist, $resource, $LNG;

		$type = HTTP::_GP('type','add');

		$planetId = HTTP::_GP('id',0);

		if (!in_array($type,array('add','delete'))) {
			$this->printMessage('Wrong type !');
		}

		$db = Database::get();

		$sql = "SELECT * FROM %%PLANETS%% WHERE `id` = :planetId;";

		$planetInfo = $db->selectSingle($sql,array(
			':planetId' => $planetId,
		));

		if(!$planetInfo){
			$this->printMessage($LNG['ad_add_not_exist']);
		}

		$before = $after = array();

		foreach($reslist['allow'][$planetInfo['planet_type']] as $ID)
		{
			$before[$ID] = $planetInfo[$resource[$ID]];
		}
		if ($type == 'add')
		{
			$Fields	= 0;
			$SQL  = "UPDATE %%PLANETS%% SET `eco_hash` = '', ";
			foreach($reslist['allow'][$planetInfo['planet_type']] as $ID)
			{
				$Count			= max(0, round(HTTP::_GP($resource[$ID], 0.0)));
				$QryUpdate[]	= "`".$resource[$ID]."` = `".$resource[$ID]."` + '".$Count."'";
				$after[$ID] 	= $before[$ID] + $Count;
				$Fields			+= $Count;
			}
			$SQL .= implode(", ", $QryUpdate);
			$SQL .= ", `field_current` = `field_current` + :Fields WHERE `id` = :planetId AND `universe` = :universe;";

			$db->update($SQL,array(
				':Fields' => $Fields,
				':planetId' => HTTP::_GP('id',0),
				':universe' => Universe::getEmulated()
			));

		}
		elseif ($type == 'delete')
		{
			$Fields	= 0;
			$QryUpdate	= array();

			$SQL  = "UPDATE %%PLANETS%% SET `eco_hash` = '', ";

			foreach($reslist['allow'][$planetInfo['planet_type']] as $ID)
			{
				$Count			= max(0, round(HTTP::_GP($resource[$ID], 0.0)));
				$QryUpdate[]	= "`" . $resource[$ID] . "` = GREATEST(0, `".$resource[$ID]."` - '".$Count."'" . ")";
				$after[$ID]		= max($before[$ID] - $Count,0);
				$Fields			+= $Count;
			}
			$SQL .= implode(", ", $QryUpdate);
			$SQL .= ", `field_current` = GREATEST(0, `field_current` - :Fields) WHERE `id` = :planetId AND `universe` = :universe;";
			$db->update($SQL,array(
				':Fields' => $Fields,
				':planetId' => HTTP::_GP('id',0),
				':universe' => Universe::getEmulated()
			));
		}

		$LOG = new Log(2);
		$LOG->target = HTTP::_GP('id', 0);
		$LOG->universe = Universe::getEmulated();
		$LOG->old = $before;
		$LOG->new = $after;
		$LOG->save();

		if ($type == 'add') {
			$this->printMessage($LNG['ad_add_build_success']);
		} else if ($type == 'delete') {
			$this->printMessage($LNG['ad_delete_build_success']);
		}

	}

	function researchs(){

		global $reslist,$resource;

		foreach($reslist['tech'] as $ID)
		{
			$INPUT[$ID]	= array(
				'type'	=> $resource[$ID],
			);
		}

		$this->assign(array(
			'inputlist'			=> $INPUT,
		));

		$this->display('page.accounts.researchs.tpl');

	}

	function researchsSend(){

		global $reslist, $resource, $LNG;

		$userId = HTTP::_GP('id',0);

		$type = HTTP::_GP('type','add');

		if (!in_array($type,array('add','delete'))) {
			$this->printMessage('Wrong type !');
		}

		$db = Database::get();

		$sql = "SELECT * FROM %%USERS%% WHERE `id` = :userId;";

		$userInfo = $db->selectSingle($sql,array(
			':userId' => $userId
		));

		if (!$userInfo) {
			$this->printMessage('User not found !');
		}

		$before = $after = array();

		foreach($reslist['tech'] as $ID)
		{
			$before[$ID] = $userInfo[$resource[$ID]];
		}
		if ($type == 'add')
		{
			$SQL  = "UPDATE %%USERS%% SET ";

			foreach($reslist['tech'] as $ID)
			{
				$QryUpdate[]	= "`".$resource[$ID]."` = `".$resource[$ID]."` + '".max(0, round(HTTP::_GP($resource[$ID], 0.0)))."'";
				$after[$ID] = $before[$ID] + max(0, round(HTTP::_GP($resource[$ID], 0.0)));
			}

			$SQL .= implode(", ", $QryUpdate);
			$SQL .= "WHERE ";
			$SQL .= "`id` = :userId AND `universe` = :universe;";

			$db->update($SQL,array(
				':userId' => HTTP::_GP('id', 0),
				':universe' => Universe::getEmulated()
			));

		}
		elseif ($type == 'delete')
		{
			$SQL  = "UPDATE %%USERS%% SET ";
			foreach($reslist['tech'] as $ID)
			{
				$QryUpdate[]	= "`".$resource[$ID]."` = GREATEST(0, `".$resource[$ID]."` - '".max(0, round(HTTP::_GP($resource[$ID], 0.0)))."')";
				$after[$ID] = max($before[$ID] - max(0, round(HTTP::_GP($resource[$ID], 0.0))),0);
			}
			$SQL .= implode(", ", $QryUpdate);
			$SQL .= "WHERE ";
			$SQL .= "`id` = :userId AND `universe` = :universe;";

			$db->update($SQL,array(
				':userId' => HTTP::_GP('id', 0),
				':universe' => Universe::getEmulated()
			));

		}

		$LOG = new Log(1);
		$LOG->target = HTTP::_GP('id', 0);
		$LOG->universe = $userInfo['universe'];
		$LOG->old = $before;
		$LOG->new = $after;
		$LOG->save();

		if ($type == 'add') {
			$this->printMessage($LNG['ad_add_tech_success']);
		} else if ($type == 'delete') {
			$this->printMessage($LNG['ad_delete_tech_success']);
		}
		exit;

	}

	function personal(){

		global $LNG;

		$this->assign(array(
			'Selector'				=> array(''	=> $LNG['select_option'], 'yes' => $LNG['one_is_no_1'], 'no' => $LNG['one_is_no_0']),
		));

		$this->display('page.accounts.personal.tpl');

	}

	function personalSend(){

		global $LNG;

		$id			= HTTP::_GP('id', 0);

		if ($id == 0) {
			$this->printMessage('Wrong user ID');
		}

		$username	= HTTP::_GP('username', '', UTF8_SUPPORT);
		$password	= HTTP::_GP('password', '', true);
		$email		= HTTP::_GP('email', '');
		$email_2	= HTTP::_GP('email_2', '');
		$vacation	= HTTP::_GP('vacation', '');

		if (empty($username) && empty($password) && empty($email) && empty($email_2) && empty($vacation)) {
			$this->printMessage('Form is empty !');
		}


		$db = Database::get();

		$sql = "SELECT `username`,`email`,`email_2`,`password`,`urlaubs_modus`,`urlaubs_until`
		FROM %%USERS%% WHERE `id` = :userId;";

		$userInfo = $db->selectSingle($sql,array(
			':userId' => $id
		));

		if (!$userInfo) {
			$this->printMessage('user could not be found !');
		}

		$after = array();

		$PersonalQuery    =    "UPDATE %%USERS%% SET ";

		if(!empty($username) && $id != ROOT_USER) {
			$PersonalQuery    .= "`username` = :username, ";
			$after['username'] = $username;
		}

		if(!empty($email) && $id != ROOT_USER) {
			$PersonalQuery    .= "`email` = :email, ";
			$after['email'] = $email;
		}

		if(!empty($email_2) && $id != ROOT_USER) {
			$PersonalQuery    .= "`email_2` = :email_2, ";
			$after['email_2'] = $email_2;
		}

		if(!empty($password) && $id != ROOT_USER) {
			$PersonalQuery    .= "`password` = :password, ";
			$after['password'] = (PlayerUtil::cryptPassword($password) != $userInfo['password']) ? 'CHANGED' : '';
		}
		$userInfo['password'] = '';

		$Answer		= 0;
		$TimeAns	= 0;

		if ($vacation == 'yes') {
			$Answer		= 1;
			$after['urlaubs_modus'] = 1;
			$TimeAns    = TIMESTAMP + $_POST['d'] * 86400 + $_POST['h'] * 3600 + $_POST['m'] * 60 + $_POST['s'];
			$after['urlaubs_until'] = $TimeAns;
		}

		$PersonalQuery    .=  "`urlaubs_modus` = :Answer, `urlaubs_until` = :TimeAns ";
		$PersonalQuery    .= "WHERE `id` = :id AND `universe` = :universe";

		$db->update($PersonalQuery,array(
			':username' => $username,
			':email' => $email,
			':email_2' => $email_2,
			':password' => PlayerUtil::cryptPassword($password),
			':Answer' => $Answer,
			':TimeAns' => $TimeAns,
			':id' => $id,
			':universe' => Universe::getEmulated()
		));

		$LOG = new Log(1);
		$LOG->target = $id;
		$LOG->universe = $userInfo['universe'];
		$LOG->old = $userInfo;
		$LOG->new = $after;
		$LOG->save();

		$this->printMessage($LNG['ad_personal_succes']);

	}

	function alliance(){

		$this->display('page.accounts.alliance.tpl');

	}

	function allianceSend(){

		global $LNG;

		$id				=	HTTP::_GP('id', 0);

		if ($id == 0) {
			$this->printMessage('Alliance id is not entered !');
		}

		$name			=	HTTP::_GP('name', '', UTF8_SUPPORT);
		$changeleader	=	HTTP::_GP('changeleader', 0);
		$tag			=	HTTP::_GP('tag', '', UTF8_SUPPORT);
		$externo		=	HTTP::_GP('externo', '', true);
		$interno		=	HTTP::_GP('interno', '', true);
		$solicitud		=	HTTP::_GP('solicitud', '', true);
		$delete			=	HTTP::_GP('delete', '');
		$delete_u		=	HTTP::_GP('delete_u', '');

		$db = Database::get();

		$sql = "SELECT * FROM %%ALLIANCE%% WHERE `id` = :id AND `ally_universe` = :universe;";

		$QueryF	=	$db->selectSingle($sql,array(
			':id' => $id,
			':universe' => Universe::getEmulated()
		));

		if (!$QueryF) {
			$this->printMessage('Alliance is not found !');
		}

		if (!empty($name)){
			$sql = "UPDATE %%ALLIANCE%% SET `ally_name` = :name WHERE `id` = :id AND `ally_universe` = :universe;";

			$db->update($sql,array(
				':name' => $name,
				':id' => $id,
				':universe' => Universe::getEmulated()
			));


		}

		if (!empty($tag)){
			$sql = "UPDATE %%ALLIANCE%% SET `ally_tag` = :tag WHERE `id` = :id AND `ally_universe` = :universe;";

			$db->update($sql,array(
				':tag' => $tag,
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		$sql = "SELECT ally_id FROM %%USERS%% WHERE `id` = :changeleader;";

		$QueryF2	=	$db->selectSingle($sql,array(
			':changeleader' => $changeleader
		));

		$sql = "UPDATE %%ALLIANCE%% SET `ally_owner` = :changeleader WHERE `id` = :id AND `ally_universe` = :universe;";

		$db->update($sql,array(
			':changeleader' => $changeleader,
			':id' => $id,
			':universe' => Universe::getEmulated()
		));

		$sql = "UPDATE %%USERS%% SET `ally_rank_id` = '0' WHERE `id` = :changeleader;";

		$db->update($sql,array(
			':changeleader' => $changeleader
		));

		if (!empty($externo)){

			$sql = "UPDATE %%ALLIANCE%% SET `ally_description` = :externo WHERE `id` = :id AND `ally_universe` = :universe;";

			$db->update($sql,array(
				':externo' => $externo,
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		if (!empty($interno)){

			$sql = "UPDATE %%ALLIANCE%% SET `ally_text` = :interno WHERE `id` = :id AND `ally_universe` = :universe;";

			$db->update($sql,array(
				':interno' => $interno,
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		if (!empty($solicitud)){

			$sql = "UPDATE %%ALLIANCE%% SET `ally_request` = :solicitud WHERE `id` = :id AND `ally_universe` = :universe;";

			$db->update($sql,array(
				':solicitud' => $solicitud,
				':id' => $id,
				':universe' => Universe::getEmulated()
			));


		}

		if ($delete == 'on')
		{

			$sql = "DELETE FROM %%ALLIANCE%% WHERE `id` = :id AND `ally_universe` = :universe;";

			$db->delete($sql,array(
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

			$sql = "UPDATE %%USERS%% SET `ally_id` = '0', `ally_rank_id` = '0', `ally_register_time` = '0' WHERE `ally_id` = :id;";

			$db->update($sql,array(
				':id' => $id
			));

		}

		if (!empty($delete_u))
		{

			$sql = "UPDATE %%ALLIANCE%% SET `ally_members` = ally_members - 1 WHERE `id` = :id AND `ally_universe` = :universe;";

			$db->update($sql,array(
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

			$sql = "UPDATE %%USERS%% SET `ally_id` = '0', `ally_rank_id` = '0', `ally_register_time` = '0' WHERE `id` = :delete_u AND `ally_id` = :id;";

			$db->update($sql,array(
				':delete_u' => $delete_u,
				':id' => $id
			));

		}


		$this->printMessage($LNG['ad_ally_succes']);

	}

	function officers(){

		global $reslist, $resource;

		foreach($reslist['officier'] as $ID)
		{
			$INPUT[$ID]	= array(
				'type'	=> $resource[$ID],
			);
		}

		$this->assign(array(
			'inputlist'			=> $INPUT,
		));

		$this->display('page.accounts.officers.tpl');

	}

function officersSend(){

			global $reslist, $resource, $LNG;

			$id = HTTP::_GP('id',0);
			$type = HTTP::_GP('type','add');

			if (!in_array($type,array('add','delete'))) {
				$this->printMessage('Wrong type !');
			}

			$db = Database::get();

			$sql = "SELECT * FROM %%USERS%% WHERE `id` = :id;";

			$userInfo = $db->selectSingle($sql,array(
				':id' => $id
			));

			if (!$userInfo) {
				$this->printMessage('User is not found !');
			}

			$before = $after = array();

			foreach($reslist['officier'] as $ID)
			{
				$before[$ID] = $userInfo[$resource[$ID]];
			}
			if ($type == 'add')
			{
				$SQL  = "UPDATE %%USERS%% SET ";
				foreach($reslist['officier'] as $ID)
				{
					$QryUpdate[]	= "`".$resource[$ID]."` = `".$resource[$ID]."` + '".max(0, round(HTTP::_GP($resource[$ID], 0.0)))."'";
					$after[$ID] = $before[$ID] + max(0, round(HTTP::_GP($resource[$ID], 0.0)));
				}
				$SQL .= implode(", ", $QryUpdate);
				$SQL .= "WHERE ";
				$SQL .= "`id` = :id AND `universe` = :universe;";

				$db->update($SQL,array(
					':id' => HTTP::_GP('id', 0),
					':universe' => Universe::getEmulated()
				));

			} elseif ($type == 'delete') {

				$SQL  = "UPDATE %%USERS%% SET ";
				foreach($reslist['officier'] as $ID)
				{
					$QryUpdate[]	= "`".$resource[$ID]."` = `".$resource[$ID]."` - '".max(0, round(HTTP::_GP($resource[$ID], 0.0)))."'";
					$after[$ID] = max($before[$ID] - max(0, round(HTTP::_GP($resource[$ID], 0.0))),0);
				}
				$SQL .= implode(", ", $QryUpdate);
				$SQL .= "WHERE ";
				$SQL .= "`id` = :id AND `universe` = :universe;";
				$db->update($SQL,array(
					':id' => HTTP::_GP('id', 0),
					':universe' => Universe::getEmulated(),
				));
			}

			$LOG = new Log(1);
			$LOG->target = HTTP::_GP('id', 0);
			$LOG->universe = $userInfo['universe'];
			$LOG->old = $before;
			$LOG->new = $after;
			$LOG->save();

			$message = ($type == 'add') ? $LNG['ad_add_offi_success'] : $LNG['ad_delete_offi_success'];

			$this->printMessage($message);

	}

	function planets(){

		$this->display('page.accounts.planets.tpl');

	}

	function planetsSend(){

		global $reslist,$resource,$LNG;

		$id				= HTTP::_GP('id', 0);
		$name			= HTTP::_GP('name', '', UTF8_SUPPORT);
		$diameter		= HTTP::_GP('diameter', 0);
		$fields			= HTTP::_GP('fields', 0);
		$buildings		= HTTP::_GP('0_buildings', '');
		$ships			= HTTP::_GP('0_ships', '');
		$defenses		= HTTP::_GP('0_defenses', '');
		$c_hangar		= HTTP::_GP('0_c_hangar', '');
		$c_buildings	= HTTP::_GP('0_c_buildings', '');
		$change_pos		= HTTP::_GP('change_position', '');
		$galaxy			= HTTP::_GP('g', 0);
		$system			= HTTP::_GP('s', 0);
		$planet			= HTTP::_GP('p', 0);

		if ($id == 0) {
			$this->printMessage('Wrong planet ID');
		}

		$db = Database::get();

		if (!empty($name)){
			$sql = "UPDATE %%PLANETS%% SET `name` = :name WHERE `id` = :id AND `universe` = :universe;";

			$db->update($sql,array(
				':name' => $name,
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		if ($buildings == 'on')
		{
			foreach($reslist['build'] as $ID) {
				$BUILD[]	= "`".$resource[$ID]."` = '0'";
			}

			$sql = "UPDATE %%PLANETS%% SET " . implode(', ',$BUILD) . " WHERE `id` = :id AND `universe` = :universe;";

			$db->update($sql,array(
				':id' => $id,
				':universe' => Universe::getEmulated()
			));
		}

		if ($ships == 'on')
		{
			foreach($reslist['fleet'] as $ID) {
				$SHIPS[]	= "`".$resource[$ID]."` = '0'";
			}

			$sql = "UPDATE %%PLANETS%% SET ".implode(', ',$SHIPS)." WHERE `id` = :id AND `universe` = :universe;";

			$db->update($sql,array(
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		if ($defenses == 'on')
		{
			foreach($reslist['defense'] as $ID) {
				$DEFS[]	= "`".$resource[$ID]."` = '0'";
			}

			$sql = "UPDATE %%PLANETS%% SET ".implode(', ',$DEFS)." WHERE `id` = :id AND `universe` = :universe;";


			$db->update($sql, array(
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		if ($c_hangar == 'on'){

			$sql = "UPDATE %%PLANETS%% SET `b_hangar` = '0', `b_hangar_plus` = '0', `b_hangar_id` = '' WHERE `id` = :id AND `universe` = :universe;";

			$db->update($sql,array(
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		if ($c_buildings == 'on'){

			$sql = "UPDATE %%PLANETS%% SET `b_building` = '0', `b_building_id` = '' WHERE `id` = :id AND `universe` = :universe;";

			$db->update($sql,array(
				':id' => $id,
				':universe' => Universe::getEmulated()
			));
		}

		if (!empty($diameter)){

			$sql = "UPDATE %%PLANETS%% SET `diameter` = :diameter WHERE `id` = :id AND `universe` = :universe;";

			$db->update($sql,array(
				':diameter' => $diameter,
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		if (!empty($fields)){

			$sql = "UPDATE %%PLANETS%% SET `field_max` = :fields WHERE `id` = :id AND `universe` = :universe;";

			$db->update($sql,array(
				':fields' => $fields,
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

		}

		if ($change_pos == 'on' && $galaxy > 0 && $system > 0 && $planet > 0 && $galaxy <= Config::get(Universe::getEmulated())->max_galaxy && $system <= Config::get(Universe::getEmulated())->max_system && $planet <= Config::get(Universe::getEmulated())->max_planets)
		{
			$sql = "SELECT galaxy,system,planet,planet_type FROM %%PLANETS%% WHERE `id` = :id AND `universe` = :universe;";

			$P =	$db->selectSingle($sql,array(
				':id' => $id,
				':universe' => Universe::getEmulated()
			));

			if ($P['planet_type'] == '1')
			{
				if (PlayerUtil::checkPosition(Universe::getEmulated(), $galaxy, $system, $planet,$P['planet_type']))
				{
					$template->message($LNG['ad_pla_error_planets3'], '?page=accounteditor&edit=planets');
					exit;
				}

				$sql = "UPDATE %%PLANETS%% SET `galaxy` = :galaxy, `system` = :system, `planet` = :planet WHERE `id` = :id AND `universe` = :universe;";

				$db->update($sql,array(
					':galaxy' => $galaxy,
					':system' => $system,
					':planet' => $planet,
					':id' => $id,
					':universe' => Universe::getEmulated()
				));

			} else {
				if(PlayerUtil::checkPosition(Universe::getEmulated(), $galaxy, $system, $planet, $P['planet_type']))
				{
					$template->message($LNG['ad_pla_error_planets5'], '?page=accounteditor&edit=planets');
					exit;
				}

				$sql = "SELECT id_luna FROM %%PLANETS%% WHERE `galaxy` = :galaxy AND `system` = :system AND `planet` = :planet AND `planet_type` = '1';";

				$Target	= $db->selectSingle($sql, array(
					':galaxy' => $galaxy,
					':system' => $system,
					':planet' => $planet,
				));

				if ($Target['id_luna'] != '0')
				{
					$template->message($LNG['ad_pla_error_planets4'], '?page=accounteditor&edit=planets');
					exit;
				}

				$sql = "UPDATE %%PLANETS%% SET `id_luna` = '0' WHERE `galaxy` = :galaxy AND `system` = :system AND `planet` = :planet AND `planet_type` = '1';";

				$db->update($sql,array(
					':galaxy' => $P['galaxy'],
					':system' => $P['system'],
					':planet' => $P['planet'],
				));

				$sql = "UPDATE %%PLANETS%% SET `id_luna` = :id  WHERE `galaxy` = :galaxy AND `system` = :system AND `planet` = :planet AND planet_type = '1';";

				$db->update($sql,array(
					':id' => $id,
					':galaxy' => $galaxy,
					':system' => $system,
					':planet' => $planet
				));

				$sql = "UPDATE %%PLANETS%% SET `galaxy` = :galaxy, `system` = :system, `planet` = :planet WHERE `id` = :id AND `universe` = :universe;";

				$db->update($sql,array(
					':galaxy' => $galaxy,
					':system' => $system,
					':planet' => $planet,
					':id' => $id,
					':universe' => Universe::getEmulated()
				));


				$sql = "SELECT id_owner FROM %%PLANETS%% WHERE `galaxy` = :galaxy AND `system` = :system AND `planet` = :planet;";

				$QMOON2	=	$db->selectSingle($sql,array(
					':galaxy' => $galaxy,
					':system' => $system,
					':planet' => $planet,
				));

				$sql = "UPDATE %%PLANETS%% SET `galaxy` = :galaxy, `system` = :system, `planet` = :planet, `id_owner` = :id_owner WHERE `id` = :id AND `universe` = :universe AND `planet_type` = '3';";

				$db->update($sql,array(
					':galaxy' => $galaxy,
					':system' => $system,
					':planet' => $planet,
					':id_owner' => $QMOON2['id_owner'],
					':id' => $id,
					':universe' => Universe::getEmulated()
				));
			}
		}

		$this->printMessage($LNG['ad_pla_succes']);


	}

}


function ShowAccountEditorPage()
{
	global $LNG, $reslist, $resource;
	$template 	= new template();
	$db = Database::get();

	$editType = HTTP::_GP('edit','');

	switch($editType)
	{



		case 'planets':
			if ($_POST)
			{

			}

		break;



		default:
			$template->show('AccountEditorPageMenu.tpl');
		break;
	}
}
