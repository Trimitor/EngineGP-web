<?php
/**
 * =============================================================================
 * Admin search box
 * 
 * @author SteamFriends Development Team
 * @version 1.0.0
 * @copyright SourceBans (C)2007 SteamFriends.com.  All rights reserved.
 * @package SourceBans
 * @link http://www.sourcebans.net
 * 
 * @version $Id: admin.admins.search.php 24 2007-11-06 18:17:05Z olly $
 * =============================================================================
 */

global $userbank, $theme;

//serverlist
$server_list = $GLOBALS['db']->Execute("SELECT sid, ip, port FROM `" . DB_PREFIX . "_servers` WHERE enabled = 1");
$servers = array();
$serverscript = "<script type=\"text/javascript\">";
while (!$server_list->EOF)
{
	$info = array();
    $serverscript .= "xajax_ServerHostPlayers('".$server_list->fields[0]."', 'id', 'ss".$server_list->fields[0]."', '', '', false, 200);";
	$info['sid'] = $server_list->fields[0];
	$info['ip'] = $server_list->fields[1];
	$info['port'] = $server_list->fields[2];
	array_push($servers,$info);
	$server_list->MoveNext();
}
$serverscript .= "</script>";

//webgrouplist
$webgroup_list = $GLOBALS['db']->Execute("SELECT gid, name FROM ". DB_PREFIX ."_groups WHERE type = '1'");
$webgroups = array();
while (!$webgroup_list->EOF)
{
	$data = array();
	$data['gid'] = $webgroup_list->fields['gid'];
	$data['name'] = $webgroup_list->fields['name'];

	array_push($webgroups,$data);
	$webgroup_list->MoveNext();
}

//serveradmingrouplist
$srvadmgroup_list = $GLOBALS['db']->Execute("SELECT name FROM ". DB_PREFIX ."_srvgroups ORDER BY name ASC");
$srvadmgroups = array();
while (!$srvadmgroup_list->EOF)
{
	$data = array();
	$data['name'] = $srvadmgroup_list->fields['name'];
	
	array_push($srvadmgroups,$data);
	$srvadmgroup_list->MoveNext();
}

//servergroup
$srvgroup_list = $GLOBALS['db']->Execute("SELECT gid, name FROM " . DB_PREFIX . "_groups WHERE type = '3'");
$srvgroups = array();
while (!$srvgroup_list->EOF)
{
	$data = array();
	$data['gid'] = $srvgroup_list->fields['gid'];
	$data['name'] = $srvgroup_list->fields['name'];
	
	array_push($srvgroups,$data);
	$srvgroup_list->MoveNext();
}

//webpermissions
$webflag[] = array("name" => "Главный админ", "flag"=>"ADMIN_OWNER");
$webflag[] = array("name" => "Просмотр админов", "flag"=>"ADMIN_LIST_ADMINS");
$webflag[] = array("name" => "Добавление админов", "flag"=>"ADMIN_ADD_ADMINS");
$webflag[] = array("name" => "Редактирование админов", "flag"=>"ADMIN_EDIT_ADMINS");
$webflag[] = array("name" => "Удаление админов", "flag"=>"ADMIN_DELETE_ADMINS");
$webflag[] = array("name" => "Просмотр серверов", "flag"=>"ADMIN_LIST_SERVERS");
$webflag[] = array("name" => "Добавление серверов", "flag"=>"ADMIN_ADD_SERVER");
$webflag[] = array("name" => "Редактирование серверов", "flag"=>"ADMIN_EDIT_SERVERS");
$webflag[] = array("name" => "Удаление серверов", "flag"=>"ADMIN_DELETE_SERVERS");
$webflag[] = array("name" => "Добавление банов", "flag"=>"ADMIN_ADD_BAN");
$webflag[] = array("name" => "Редактирование своих банов", "flag"=>"ADMIN_EDIT_OWN_BANS");
$webflag[] = array("name" => "Редактирование банов групп", "flag"=>"ADMIN_EDIT_GROUP_BANS");
$webflag[] = array("name" => "Редактирование всех банов", "flag"=>"ADMIN_EDIT_ALL_BANS");
$webflag[] = array("name" => "Протесты банов", "flag"=>"ADMIN_BAN_PROTESTS");
$webflag[] = array("name" => "Предложения банов", "flag"=>"ADMIN_BAN_SUBMISSIONS");
$webflag[] = array("name" => "Удаление банов", "flag"=>"ADMIN_DELETE_BAN");
$webflag[] = array("name" => "Разбан своих банов", "flag"=>"ADMIN_UNBAN_OWN_BANS");
$webflag[] = array("name" => "Разбан банов групп", "flag"=>"ADMIN_UNBAN_GROUP_BANS");
$webflag[] = array("name" => "Разбан всех банов", "flag"=>"ADMIN_UNBAN");
$webflag[] = array("name" => "Импорт банов", "flag"=>"ADMIN_BAN_IMPORT");
$webflag[] = array("name" => "Уведомление по e-mail о предложении бана", "flag"=>"ADMIN_NOTIFY_SUB");
$webflag[] = array("name" => "Уведомление по e-mail о протесте бана", "flag"=>"ADMIN_NOTIFY_PROTEST");
$webflag[] = array("name" => "Просмотр групп", "flag"=>"ADMIN_LIST_GROUPS");
$webflag[] = array("name" => "Добавление групп", "flag"=>"ADMIN_ADD_GROUP");
$webflag[] = array("name" => "Редактирование групп", "flag"=>"ADMIN_EDIT_GROUPS");
$webflag[] = array("name" => "Удаление групп", "flag"=>"ADMIN_DELETE_GROUPS");
$webflag[] = array("name" => "Настройки ВЕБ", "flag"=>"ADMIN_WEB_SETTINGS");
$webflag[] = array("name" => "Просмотр МОДов", "flag"=>"ADMIN_LIST_MODS");
$webflag[] = array("name" => "Добавление МОДов", "flag"=>"ADMIN_ADD_MODS");
$webflag[] = array("name" => "Редактирование МОДов", "flag"=>"ADMIN_EDIT_MODS");
$webflag[] = array("name" => "Удаление МОДов", "flag"=>"ADMIN_DELETE_MODS");
$webflags = array();
foreach($webflag AS $flag)
{
	$data['name'] = $flag["name"];
	$data['flag'] = $flag["flag"];
	
	array_push($webflags, $data);
}

//server permissions
$serverflag[] = array("name" => "Главный админ", "flag" => "SM_ROOT");
$serverflag[] = array("name" => "Резервный слот", "flag" => "SM_RESERVED_SLOT");
$serverflag[] = array("name" => "Общий админ", "flag" => "SM_GENERIC");
$serverflag[] = array("name" => "Кик", "flag" => "SM_KICK");
$serverflag[] = array("name" => "Бан", "flag" => "SM_BAN");
$serverflag[] = array("name" => "Разбан", "flag" => "SM_UNBAN");
$serverflag[] = array("name" => "Слэй", "flag" => "SM_SLAY");
$serverflag[] = array("name" => "Смена карты", "flag" => "SM_MAP");
$serverflag[] = array("name" => "Изменение КВАРов", "flag" => "SM_CVAR");
$serverflag[] = array("name" => "Исполнение конфигов", "flag" => "SM_CONFIG");
$serverflag[] = array("name" => "Админский чат", "flag" => "SM_CHAT");
$serverflag[] = array("name" => "Голосования", "flag" => "SM_VOTE");
$serverflag[] = array("name" => "Пароль сервера", "flag" => "SM_PASSWORD");
$serverflag[] = array("name" => "РКОН", "flag" => "SM_RCON");
$serverflag[] = array("name" => "Разрешение читов", "flag" => "SM_CHEATS");
$serverflag[] = array("name" => "Дополнительный флаг 1", "flag" => "SM_CUSTOM1");
$serverflag[] = array("name" => "Дополнительный флаг 2", "flag" => "SM_CUSTOM2");
$serverflag[] = array("name" => "Дополнительный флаг 3", "flag" => "SM_CUSTOM3");
$serverflag[] = array("name" => "Дополнительный флаг 4", "flag" => "SM_CUSTOM4");
$serverflag[] = array("name" => "Дополнительный флаг 5", "flag" => "SM_CUSTOM5");
$serverflag[] = array("name" => "Дополнительный флаг 6", "flag" => "SM_CUSTOM6");
$serverflags = array();
foreach($serverflag AS $flag)
{
	$data['name'] = $flag["name"];
	$data['flag'] = $flag["flag"];
	
	array_push($serverflags, $data);
}


$theme->assign('server_list', $servers);
$theme->assign('server_script', $serverscript);
$theme->assign('webgroup_list', $webgroups);
$theme->assign('srvadmgroup_list', $srvadmgroups);
$theme->assign('srvgroup_list', $srvgroups);
$theme->assign('admwebflag_list', $webflags);
$theme->assign('admsrvflag_list', $serverflags);
$theme->assign('can_editadmin', $userbank->HasAccess(ADMIN_EDIT_ADMINS|ADMIN_OWNER));

$theme->display('box_admin_admins_search.tpl');
?>