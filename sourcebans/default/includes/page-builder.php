<?php
/**
 * =============================================================================
 * Return the page that we want
 * 
 * @author SteamFriends Development Team
 * @version 1.0.0
 * @copyright SourceBans (C)2007 SteamFriends.com.  All rights reserved.
 * @package SourceBans
 * @link http://www.sourcebans.net
 * 
 * @version $Id: page-builder.php 146 2008-09-08 19:55:00Z peace-maker $
 * =============================================================================
 */

$_GET['p'] = isset($_GET['p']) ? $_GET['p'] : 'default';
$_GET['p'] = trim($_GET['p']);
switch ($_GET['p'])
{
	case "login":
		$page = TEMPLATES_PATH . "/page.login.php";
		break;
	case "logout":
		logout();
		Header("Location: index.php");
		break;
	case "admin":
		$page = INCLUDES_PATH . "/admin.php";
		break;
	case "submit":
		RewritePageTitle("Добавить бан");
		$page = TEMPLATES_PATH . "/page.submit.php";
		break;
	case "banlist":
		RewritePageTitle("Список банов");
		$page = TEMPLATES_PATH ."/page.banlist.php";
		break;
	case "servers":
		RewritePageTitle("Список серверов");
		$page = TEMPLATES_PATH . "/page.servers.php";
		break;
	case "serverinfo":
		RewritePageTitle("Информация о сервере");
		$page = TEMPLATES_PATH . "/page.serverinfo.php";
		break;
	case "protest":
		RewritePageTitle("Протест бана");
		$page = TEMPLATES_PATH . "/page.protest.php";
		break;
	case "account":
		RewritePageTitle("Ваш аккаунт");
		$page = TEMPLATES_PATH . "/page.youraccount.php";
		break;
	case "lostpassword":
		RewritePageTitle("Забыли пароль");
		$page = TEMPLATES_PATH . "/page.lostpassword.php";
		break;
	case "home":
		RewritePageTitle("Главная");
		$page = TEMPLATES_PATH . "/page.home.php";
		break;
	default:
		switch($GLOBALS['config']['config.defaultpage'])
		{
			case 1:
				RewritePageTitle("Список банов");
				$page = TEMPLATES_PATH . "/page.banlist.php";
				$_GET['p'] = "banlist";
				break;
			case 2:
				RewritePageTitle("Информация о сервере");
				$page = TEMPLATES_PATH . "/page.servers.php";
				$_GET['p'] = "servers";
				break;
			case 3:
				RewritePageTitle("Добавить бан");
				$page = TEMPLATES_PATH . "/page.submit.php";
				$_GET['p'] = "submit";
				break;
			case 4:
				RewritePageTitle("Протест бана");
				$page = TEMPLATES_PATH . "/page.protest.php";
				$_GET['p'] = "protest";
				break;
			default: //case 0:
				RewritePageTitle("Главная");
				$page = TEMPLATES_PATH . "/page.home.php";
				$_GET['p'] = "home";
				break;
		}
}

global $ui;
$ui = new CUI();
BuildPageHeader();
BuildPageTabs();
BuildSubMenu();
BuildContHeader();
BuildBreadcrumbs();
if(!empty($page))
	include $page;
include_once(TEMPLATES_PATH . '/footer.php');
?>
