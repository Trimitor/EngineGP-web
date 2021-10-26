<?php 
	if (! defined ( 'BLOCK' ))
	{
		exit ( "
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> 
		<html>
			<head>
				<title>404 Not Found</title>
			</head>
			<body>
				<h1>Not Found</h1>
				<p>The requested URL was not found on this server.</p>
			</body>
		</html>" ); 
	}

	if ( ! empty( $_POST['update'] ) )
	{
		$query_server = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers` ORDER BY `id`" );
		if ( $db->n_rows( $query_server ) > 0 )
		{
			while ( $date = $db->f_arr( $query_server ) ) { $eng->up_cfg ( $date['id'], $eng->g_cfg( $date['id'] ) ); }
			$query_admins = $db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_admins` WHERE `utime` < ".time()." AND `utime` != 0" );
			echo $eng->alert_mess( 'Список игроков успешно обновлен. Удалено '.$db->n_rows( $query_admins ).' истекших аккаунтов!' );
		} else echo $eng->alert_mess( 'Сервера отсутствуют!' );
	} else if ( ! empty( $_POST['opt'] ) ) {
		$db->m_query( "OPTIMIZE TABLE `".$GLOBALS['db_prefix']."_admins`" );
		echo $eng->alert_mess( 'База данных успешно оптимизирована!' );
	} else if ( ! empty( $_POST['del_chat'] ) ) {
		$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_chat_mess`" );
		echo $eng->alert_mess( 'Сообщения чата успешно удалены!' );
	}
	
	echo '
	<button type="button" class="btn btn-small btn-block btn-danger" data-toggle="modal" data-target="#m_up">Удалить истекшие аккаунты</button>
	<button type="button" class="btn btn-small btn-block btn-primary" data-toggle="modal" data-target="#m_opt">Оптимизировать базу</button>
	<button type="button" class="btn btn-small btn-block btn-success" data-toggle="modal" data-target="#m_chat">Очистить чат</button>';

?>		