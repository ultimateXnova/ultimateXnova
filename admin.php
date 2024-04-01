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

define('MODE', 'ADMIN');
define('DATABASE_VERSION', 'OLD');

define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH.'includes/libs/BBCodeParser2/'.':'.ROOT_PATH.':'.get_include_path());
require_once('includes/libs/BBCodeParser2/HTML/BBCodeParser2.php');

require 'includes/pages/adm/AbstractAdminPage.class.php';
require 'includes/pages/adm/ShowErrorPage.class.php';
require 'includes/common.php';
require 'includes/classes/class.Log.php';

if ($USER['authlevel'] == AUTH_USR)
{
	HTTP::redirectTo('game.php');
}



$uni	= HTTP::_GP('uni', 0);

if($USER['authlevel'] == AUTH_ADM && !empty($uni))
{
	Universe::setEmulated($uni);
}



$page 		= HTTP::_GP('page', 'overview');
$mode 		= HTTP::_GP('mode', 'show');



$page		= str_replace(array('_', '\\', '/', '.', "\0"), '', $page);
$pageClass	= 'Show'.ucwords($page).'Page';


$path		= 'includes/pages/adm/'.$pageClass.'.class.php';


$session	= Session::create();

if($session->adminAccess != 1)
{
	$path		= 'includes/pages/adm/ShowLoginPage.class.php';
	$pageClass = "ShowLoginPage";
}



if(!file_exists($path)) {
	ShowErrorPage::printError($LNG['page_doesnt_exist']);
}

// Added Autoload in feature Versions
require $path;

$pageObj	= new $pageClass;
// PHP 5.2 FIX
// can't use $pageObj::$requireModule
$pageProps	= get_class_vars(get_class($pageObj));

if(isset($pageProps['requireModule']) && $pageProps['requireModule'] !== 0 && !isModuleAvailable($pageProps['requireModule'])) {

	ShowErrorPage::printError($LNG['sys_module_inactive']);
}


if(!is_callable(array($pageObj, $mode))) {
	if(!isset($pageProps['defaultController']) || !is_callable(array($pageObj, $pageProps['defaultController']))) {

		ShowErrorPage::printError($LNG['page_doesnt_exist']);

	}
	$mode	= $pageProps['defaultController'];
}

$pageObj->{$mode}();

/*
$page	= HTTP::_GP('page', '');
switch($page)
{
	case 'logout':
		include_once('includes/pages/adm/ShowLogoutPage.php');
		ShowLogoutPage();
	break;
	case 'infos':
		include_once('includes/pages/adm/ShowInformationPage.php');
		ShowInformationPage();
	break;
	case 'rights':
		include_once('includes/pages/adm/ShowRightsPage.php');
		ShowRightsPage();
	break;
	case 'config':
		include_once('includes/pages/adm/ShowConfigBasicPage.php');
		ShowConfigBasicPage();
	break;
	case 'configuni':
		include_once('includes/pages/adm/ShowConfigUniPage.php');
		ShowConfigUniPage();
	break;
	case 'chat':
		include_once('includes/pages/adm/ShowChatConfigPage.php');
		ShowChatConfigPage();
	break;
	case 'teamspeak':
		include_once('includes/pages/adm/ShowTeamspeakPage.php');
		ShowTeamspeakPage();
	break;
	case 'facebook':
		include_once('includes/pages/adm/ShowFacebookPage.php');
		ShowFacebookPage();
	break;
	case 'module':
		include_once('includes/pages/adm/ShowModulePage.php');
		ShowModulePage();
	break;
	case 'statsconf':
		include_once('includes/pages/adm/ShowStatsPage.php');
		ShowStatsPage();
	break;
	case 'disclamer':
		include_once('includes/pages/adm/ShowDisclamerPage.php');
		ShowDisclamerPage();
	break;
	case 'create':
		include_once('includes/pages/adm/ShowCreatorPage.php');
		ShowCreatorPage();
	break;
	case 'accounteditor':
		include_once('includes/pages/adm/ShowAccountEditorPage.php');
		ShowAccountEditorPage();
	break;
	case 'active':
		include_once('includes/pages/adm/ShowActivePage.php');
		ShowActivePage();
	break;
	case 'bans':
		include_once('includes/pages/adm/ShowBanPage.php');
		ShowBanPage();
	break;
	case 'messagelist':
		include_once('includes/pages/adm/ShowMessageListPage.php');
		ShowMessageListPage();
	break;
	case 'globalmessage':
		include_once('includes/pages/adm/ShowSendMessagesPage.php');
		ShowSendMessagesPage();
	break;
	case 'fleets':
		include_once('includes/pages/adm/ShowFlyingFleetPage.php');
		ShowFlyingFleetPage();
	break;
	case 'accountdata':
		include_once('includes/pages/adm/ShowAccountDataPage.php');
		ShowAccountDataPage();
	break;
	case 'support':
		include_once('includes/pages/adm/ShowSupportPage.php');
		new ShowSupportPage();
	break;
	case 'password':
		include_once('includes/pages/adm/ShowPassEncripterPage.php');
		ShowPassEncripterPage();
	break;
	case 'search':
		include_once('includes/pages/adm/ShowSearchPage.php');
		ShowSearchPage();
	break;
	case 'qeditor':
		include_once('includes/pages/adm/ShowQuickEditorPage.php');
		ShowQuickEditorPage();
	break;
	case 'statsupdate':
		include_once('includes/pages/adm/ShowStatUpdatePage.php');
		ShowStatUpdatePage();
	break;
	case 'reset':
		include_once('includes/pages/adm/ShowResetPage.php');
		ShowResetPage();
	break;
	case 'news':
		include_once('includes/pages/adm/ShowNewsPage.php');
		ShowNewsPage();
	break;
	case 'topnav':
		include_once('includes/pages/adm/ShowTopnavPage.php');
		ShowTopnavPage();
	break;
	case 'overview':
		include_once('includes/pages/adm/ShowOverviewPage.php');
		ShowOverviewPage();
	break;
	case 'menu':
		include_once('includes/pages/adm/ShowMenuPage.php');
		ShowMenuPage();
	break;
	case 'clearcache':
		include_once('includes/pages/adm/ShowClearCachePage.php');
		ShowClearCachePage();
	break;
	case 'universe':
		include_once('includes/pages/adm/ShowUniversePage.php');
		ShowUniversePage();
	break;
	case 'multiips':
		include_once('includes/pages/adm/ShowMultiIPPage.php');
		ShowMultiIPPage();
	break;
	case 'log':
		include_once('includes/pages/adm/ShowLogPage.php');
		ShowLog();
	break;
	case 'vertify':
		include_once('includes/pages/adm/ShowVertify.php');
		ShowVertify();
	break;
	case 'cronjob':
		include_once('includes/pages/adm/ShowCronjobPage.php');
		ShowCronjob();
	break;
	case 'giveaway':
		include_once('includes/pages/adm/ShowGiveawayPage.php');
		ShowGiveaway();
	break;
	case 'autocomplete':
		include_once('includes/pages/adm/ShowAutoCompletePage.php');
		ShowAutoCompletePage();
	break;
	case 'dump':
		include_once('includes/pages/adm/ShowDumpPage.php');
		ShowDumpPage();
	break;
	default:
		include_once('includes/pages/adm/ShowIndexPage.php');
		ShowIndexPage();
	break;
}

*/
