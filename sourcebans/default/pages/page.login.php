<?php 
/**
 * =============================================================================
 * Login page
 * 
 * @author SteamFriends Development Team
 * @version 1.0.0
 * @copyright SourceBans (C)2007 SteamFriends.com.  All rights reserved.
 * @package SourceBans
 * @link http://www.sourcebans.net
 * 
 * @version $Id: page.login.php 219 2009-02-24 21:09:11Z peace-maker $
 * =============================================================================
 */

if(!defined("IN_SB")){echo "You should not be here. Only follow links!";die();}
RewritePageTitle("Admin Login");

global $userbank, $theme;
$submenu = array( array( "title" => 'Забыли пароль?', "url" => 'index.php?p=lostpassword' ) );
SubMenu( $submenu );
if(isset($_GET['m']) && $_GET['m'] == "no_access")
	echo "<script>ShowBox('Ошибка доступа', 'У Вас недостаточно прав для просмотра этой страницы.<br />', 'red', '', false);</script>";
	
	
$theme->assign('redir', "DoLogin('".(isset($_SESSION['q'])?$_SESSION['q']:'')."');");
$theme->left_delimiter = "-{";
$theme->right_delimiter = "}-";
$theme->display('page_login.tpl');
$theme->left_delimiter = "{";
$theme->right_delimiter = "}";
?>


