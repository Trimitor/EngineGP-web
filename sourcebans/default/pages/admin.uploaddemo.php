<?php
/**
 * =============================================================================
 * Upload a demo
 * 
 * @author SteamFriends Development Team
 * @version 1.0.0
 * @copyright SourceBans (C)2007 SteamFriends.com.  All rights reserved.
 * @package SourceBans
 * @link http://www.sourcebans.net
 * 
 * @version $Id: admin.uploaddemo.php 179 2008-12-11 20:37:10Z peace-maker $
 * =============================================================================
 */


include_once("../init.php");
include_once("../includes/system-functions.php");
global $theme, $userbank;

if (!$userbank->HasAccess(ADMIN_OWNER|ADMIN_ADD_BAN|ADMIN_EDIT_OWN_BANS|ADMIN_EDIT_GROUP_BANS|ADMIN_EDIT_ALL_BANS))
{
    $log = new CSystemLog("w", "Ошибка доступа", $userbank->GetProperty('user') . " пытался загрузить демо, не имея на это прав.");
	echo 'У Вас недостаточно прав!';
	die();
}

$message = "";

if(isset($_POST['upload']))
{
	if(CheckExt($_FILES['demo_file']['name'], "zip") || CheckExt($_FILES['demo_file']['name'], "rar") || CheckExt($_FILES['demo_file']['name'], "dem"))
	{
		$filename = md5(time().rand(0, 1000));
		move_uploaded_file($_FILES['demo_file']['tmp_name'],SB_DEMOS."/".$filename);
		$message =  "<script>window.opener.demo('" . $filename . "','" . $_FILES['demo_file']['name'] . "');self.close()</script>";
        $log = new CSystemLog("m", "Демо загружено", "Демо: ".htmlspecialchars($_FILES['demo_file']['name'])." было успешно загружено");
	}
	else 
	{
		$message =  "<b> Можно загружать только .zip, .rar или .dem файлы.</b><br><br>";
	}
}

$theme->assign("title", "Загрузить демо");
$theme->assign("message", $message);
$theme->assign("input_name", "demo_file");
$theme->assign("form_name", "demup");
$theme->assign("formats", "ZIP, RAR, или DEM");

$theme->display('page_uploadfile.tpl');
?>

