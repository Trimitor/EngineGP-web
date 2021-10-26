<?php 
	if ( ! defined ( 'BLOCK' ) )
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
	
	if ( ! empty( $_POST['LMI_PAYMENT_NO'] ) ) {
		$auth_ok = abs( ( int ) $_POST['LMI_PAYMENT_NO'] );
		$time_ok = abs( ( int ) $_POST['time'] );
	} else if ( ! empty( $_POST['shp_id'] ) ) {
		$auth_ok = abs( ( int ) $_POST['shp_id'] );
		$time_ok = abs( ( int ) $_POST['shp_t'] );
	} else if ( isset( $_GET['account'] ) ) {
		$auth_ok = abs( ( int ) $_GET['account'] );
		$time_ok = abs( ( int ) $_GET['time'] );
	}
	
	$query_acc = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_temp_adm` WHERE `id` = '".$auth_ok."' LIMIT 1" );
	$query_adm = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".$auth_ok."' LIMIT 1" );
	
	if ( $db->n_rows( $query_acc ) > 0 )
	{
		$arr_acc = $db->f_arr( $query_acc );
		list( $type, $auth, $name, $skype_id, $server_id, $tarif_id, $utime ) = array( $arr_acc['flags'], $arr_acc['auth'], 'Неизвестно', 'Неизвестно', $arr_acc['server_id'], $arr_acc['service_id'], $arr_acc['utime'] );
	} else if ( $db->n_rows( $query_adm ) > 0 ) {
		$arr_adm = $db->f_arr( $query_adm );
		list( $type, $auth, $name, $skype_id, $server_id, $tarif_id, $utime ) = array( $arr_adm['flags'], $arr_adm['auth'], $arr_adm['name'], $arr_adm['skype'], $arr_adm['server_id'], $arr_adm['service_id'], $time_ok );
	}
	
	if ( $utime == 0 ) {
		$date_end = 'Навсегда'; 
	} else  {
		$date_end = $eng->dateDiff( time(), time()+3600*24*$utime );
	}
	
	if ( $type == 'a' ) {
		$type_name = 'Ник + Пароль';
		$login = 'Ник';
	} else if ( $type == 'ca' ) {
		$type_name = 'Steam ID + Пароль';
		$login = 'SteamID';
	} else if ( $type == 'de' ) {
		$type_name = 'IP - Адрес';
		$login = 'IP - Адрес';
	}
	
	$server = $at->serv_info( $server_id );
	$tarif = $at->tarif_info( $tarif_id );
	
	echo '
	<!-- general form elements -->
	<div class="box box-info">
		<!-- box-header -->
		<div class="box-header">
			<i class="fa fa-thumbs-up"></i>
			<h3 class="box-title">Данные</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">	
			<div class="form-group">
				<label>Тип:</label>
				<input value="'.$type_name.'" type="text" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>'.$login.':</label>
				<input value="'.$auth.'" type="text" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>Пароль:</label>
				<input value="••••••••" type="text" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>Имя:</label>
				<input value="'.$name.'" type="text" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>Skype:</label>
				<input value="'.$skype_id.'" type="text" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>Сервер:</label>
				<input value="'.$server.'" type="text" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>Услуга:</label>
				<input value="'.$tarif.'" type="text" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>Добавлен:</label>
				<input value="'.date( 'd.m.Y [H:i]', time() ).'" type="text" class="form-control" disabled>
			</div>
			<div class="form-group">
				<label>Срок:</label>
				<input value="'.$date_end.'" type="text" class="form-control" disabled>
			</div>
		</div><!-- /.box-body -->
	</div><!-- /.box -->';
?>	