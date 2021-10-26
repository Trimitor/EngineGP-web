<?php
	define('BLOCK', true);
	@require_once "core/cfg.php";
	
	if(empty($_GET['cron']) OR ! empty($_GET['cron']) AND $_GET['cron'] != $cron)
		header('Location: /404');
	
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	
	$query_server = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers` ORDER BY `id`" );
	$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_temp_adm`" );
	if($db->n_rows($query_server) > 0)
	{
		while($date = $db->f_arr($query_server)){ echo $eng->up_cfg($date['id'], $eng->g_cfg($date['id'])); }
		echo 'Users.ini успешно обновлен!';
	} else echo 'Сервера отсутствуют!';
?>