<?php
/**
 * =============================================================================
 * Update an icon
 * 
 * @author SteamFriends Development Team
 * @version 1.0.0
 * @copyright SourceBans (C)2007 SteamFriends.com.  All rights reserved.
 * @package SourceBans
 * @link http://www.sourcebans.net
 * 
 * @version $Id: admin.uploadicon.php 179 2008-12-11 20:37:10Z peace-maker $
 * =============================================================================
 */

include_once("../init.php");
include_once("../includes/system-functions.php");
global $theme, $userbank;

if (!$userbank->HasAccess(ADMIN_OWNER|ADMIN_EDIT_MODS|ADMIN_ADD_MODS))
{
    $log = new CSystemLog("w", "Ошибка доступа", $userbank->GetProperty('user') . " пытался загрузить иконку МОДа, не имея на это прав.");
	echo 'У Вас недостаточно прав!';
	die();
}

$message = "";
if(isset($_POST['upload']))
{
	if(CheckExt($_FILES['icon_file']['name'], "gif") || CheckExt($_FILES['icon_file']['name'], "jpg") || CheckExt($_FILES['icon_file']['name'], "png"))
	{
		move_uploaded_file($_FILES['icon_file']['tmp_name'],SB_ICONS."/".$_FILES['icon_file']['name']);
		$message =  "<script>window.opener.icon('" . $_FILES['icon_file']['name'] . "');self.close()</script>";
        $log = new CSystemLog("m", "Иконка МОДа загружена", "Иконка МОДа: ".htmlspecialchars($_FILES['icon_file']['name'])." была успешно загружена");
	}
	else 
	{
		$message =  "<b> Можно загружать только JPG, GIF или PNG файлы.</b><br><br>";
	}
}

$theme->assign("title", "Загрузить иконку");
$theme->assign("message", $message);
$theme->assign("input_name", "icon_file");
$theme->assign("form_name", "iconup");
$theme->assign("formats", "GIF, PNG или JPG");

$theme->display('page_uploadfile.tpl');
?>
