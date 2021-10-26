<?php
/**
 * =============================================================================
 * Upload a map image
 * 
 * @author SteamFriends Development Team
 * @version 1.0.0
 * @copyright SourceBans (C)2007 SteamFriends.com.  All rights reserved.
 * @package SourceBans
 * @link http://www.sourcebans.net
 * 
 * @version $Id: admin.uploadmapimg.php 189 2008-12-27 20:37:10Z peace-maker $
 * =============================================================================
 */

include_once("../init.php");
include_once("../includes/system-functions.php");
global $theme, $userbank;

if (!$userbank->HasAccess(ADMIN_OWNER|ADMIN_ADD_SERVER))
{
    $log = new CSystemLog("w", "Ошибка доступа", $userbank->GetProperty('user') . " пытался загрузить изображение карты, не имея на это прав.");
	echo 'У Вас недостаточно прав!';
	die();
}

$message = "";
if(isset($_POST['upload']))
{
	if(CheckExt($_FILES['mapimg_file']['name'], "jpg"))
	{
		move_uploaded_file($_FILES['mapimg_file']['tmp_name'],SB_MAP_LOCATION."/".$_FILES['mapimg_file']['name']);
		$message =  "<script>window.opener.mapimg('" . $_FILES['mapimg_file']['name'] . "');self.close()</script>";
		$log = new CSystemLog("m", "Загружено изображение карты", "Изображение карты ".htmlspecialchars($_FILES['mapimg_file']['name'])." было успешно загружено");
	}
	else 
	{
		$message =  "<b> Можно загружать только JPG файлы.</b><br><br>";
	}
}

$theme->assign("title", "Загрузить изображение карты");
$theme->assign("message", $message);
$theme->assign("input_name", "mapimg_file");
$theme->assign("form_name", "mapimgup");
$theme->assign("formats", "JPG");

$theme->display('page_uploadfile.tpl');
?>
