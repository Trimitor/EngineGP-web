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
	
	$wmr = ( $wmr_on == 1 ) ? '<option value="1" selected="selected">Webmoney</option>' : '';
	$uni = ( $uni_on == 1 ) ? '<option value="2">Unitpay ( SMS, VISA, QIWI, ЯД )</option>' : '';
	$rob = ( $robo_on == 1 ) ? '<option value="3">Robokassa ( SMS, VISA, QIWI, ЯД )</option>' : '';
	
	if ( ! empty( $_POST['changename'] ) )
	{
		if ( mb_strlen( $_POST['name'], 'UTF-8' ) > 12 || trim( $_POST['name'] ) == NULL ) 
		{
			echo $eng->alert_mess( 'Не заполнено поле "Имя", или поле превышает 12 символов!' );
		} else {
			$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `name` = '".$db->m_escape( trim( $_POST['name'] ) )."' WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
			echo $eng->alert_mess( 'Имя успешно изменено!' );
			$eng->log( '['.date( 'd.m.Y H:i', time() ).']['.$_SERVER["REMOTE_ADDR"].'] Игрок '.$at->auth_info( 'auth', $id, $hash ).' сменил свое Имя на новое - '.$_POST['name'].'' . PHP_EOL );
		}
	}
	
	if ( ! empty( $_POST['changeskype'] ) )
	{
		if ( strlen( $_POST['skype'] ) > 32 || trim( $_POST['skype'] ) == NULL ) 
		{
			echo $eng->alert_mess( 'Не заполнено поле "Skype", или поле превышает 32 символа!' );
		} else {
			$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `skype` = '".$db->m_escape( trim( $_POST['skype'] ) )."' WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
			echo $eng->alert_mess( 'Skype успешно изменен!' );
			$eng->log( '['.date( 'd.m.Y H:i', time() ).']['.$_SERVER["REMOTE_ADDR"].'] Игрок '.$at->auth_info( 'auth', $id, $hash ).' сменил свой Skype на новый - '.$_POST['skype'].'' . PHP_EOL );
		}
	}
	
	if ( ! empty( $_POST['changeauth'] ) )
	{
		$f = file( "../core/nicks.txt" );
		foreach ( $f as $num => $str ) {
			if ( trim( $_POST['auth'] ) == NULL ) break;
			if ( strpos( $str, trim( $_POST['auth'] ) ) !== false ) {
				echo $eng->alert_mess('Данный ник использовать нельзя!');
				$err = 1;
			}
		}
		
		if ( $err != 1 ){
			$query_admins = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `auth` = '".$db->m_escape( trim( $_POST['auth'] ) )."' AND `server_id` = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );
			if ( $db->n_rows( $query_admins ) > 0 ) {
				echo $eng->alert_mess( 'Игрок уже зарегистрирован на данном сервере!' );
			} else if ( trim( $_POST['type'] ) == 'a' && preg_match('/[а-яё]/i', trim( $_POST['auth'] ) ) || $_POST['auth'] == NULL || strlen( $_POST['auth'] ) > 32 ) {
				echo $eng->alert_mess( 'Ник не указан или указан неверно!' );
			} else if ( trim( $_POST['type'] ) == 'ca' && ! preg_match("/^STEAM_0:[01]:[0-9]{5,10}$/", trim( $_POST['auth'] ) ) ) {
				echo $eng->alert_mess( 'Неверно заполнено поле "Steam ID"' );
			} else if ( trim( $_POST['type'] ) == 'de' && ! preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", trim( $_POST['auth'] ) ) ) {
				echo $eng->alert_mess( 'Неверно заполнено поле "IP - Адрес"' );
			} else {
				$ath = $at->ch_auth( $id );
				if ( $ath == 5 ) {
					echo $eng->alert_mess( 'Ник/SteamID/IP можно менять только 5 раз в 1 календарный месяц !"' );
				} else {
					$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `auth` = '".$db->m_escape( trim( $_POST['auth'] ) )."' WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
					$server = abs( ( int ) $_POST['server'] );
					$eng->up_cfg ( $server, $eng->g_cfg( $server ) );
					echo $eng->alert_mess( 'Ник/SteamID/IP успешно изменен. Изменять Ник/SteamID/IP можна 5 раз в 1 календарный месяц !' );
					$eng->log( '['.date( 'd.m.Y H:i', time() ).']['.$_SERVER["REMOTE_ADDR"].'] Игрок '.$at->auth_info( 'auth', $id, $hash ).' сменил свой Ник/SteamID/IP на новый - '.$_POST['auth'].'' . PHP_EOL );
				}
			}
		}
	}
	
	$query = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
	while( $date = $db->f_arr( $query ) ) 
	{
		if ( $date['utime'] == 0 ) {
			$block_submit = 'disabled';
			$thisdate = 'Навсегда';
		} else {
			$date_utime = $eng->dateDiff( time(), $date['utime'] ); 
			if ( $date_utime == 'end' ){
				$thisdate = 'Срок истек';
			} else if ( $date_utime == 'few' ){
				$thisdate = 'Пару секунд';
			} else {
				$thisdate = $date_utime;
			}
		}
		
		if ( $date['flags'] == 'a' ) {
			$login = 'Ник';
		} else if ( $date['flags'] == 'ca' ) {
			$login = 'SteamID';
		} else if ( $date['flags'] == 'de' ) {
			$login = 'IP - Адрес';
		}
		
		echo '
		<div class="box box-info">
			<!-- box-header -->
			<div class="box-header">
				<i class="fa fa-user"></i>
				<h3 class="box-title">Данные игрока</h3>
				<div class="pull-right box-tools">
					<button class="btn btn-warning btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
					<button class="btn btn-warning btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
				</div>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body" style="padding-bottom: 24px;">				
				<form action="" method="POST" autocomplete="off" style="margin: 0;">	
					<div class="input-group">
						<span class="input-group-addon" data-widget="collapse" data-toggle="tooltip" title="" data-placement="top" data-original-title="Имя"><i class="fa fa-male" style="width: 15px;"></i></span>
						<input type="text" id="name" name="name" placeholder="Имя" required value="'.$date['name'].'" class="form-control">
						<span class="input-group-btn">
							<input class="btn btn-warning" type="submit" name="changename" value="Изменить">
						</span>
					</div>
				</form>
				<form action="" method="POST" autocomplete="off" style="margin: 0;">	
					<div class="input-group">
						<span class="input-group-addon" data-widget="collapse" data-toggle="tooltip" title="" data-placement="top" data-original-title="Skype"><i class="fa fa-skype" style="width: 15px;"></i></span>
						<input type="text" id="skype" name="skype" placeholder="Skype" required value="'.$date['skype'].'" class="form-control">
						<span class="input-group-btn">
							<input class="btn btn-warning" type="submit" name="changeskype" value="Изменить">
						</span>
					</div>
				</form>
				<form action="" method="POST" autocomplete="off" style="margin: 0;">	
					<div class="input-group">
						<span class="input-group-addon" data-widget="collapse" data-toggle="tooltip" title="" data-placement="top" data-original-title="'.$login.'"><i class="fa fa-user" style="width: 15px;"></i></span>
						<input type="text" id="auth" name="auth" placeholder="'.$login.'" required value="'.$date['auth'].'" class="form-control">
						<input type="hidden" name="type" value="'.$date['flags'].'">
						<input type="hidden" name="server" value="'.$date['server_id'].'">
						<span class="input-group-btn">
							<input class="btn btn-warning" type="submit" name="changeauth" value="Изменить">
						</span>
					</div>
				</form>				
				<div class="input-group">
					<span class="input-group-addon" data-widget="collapse" data-toggle="tooltip" title="" data-placement="top" data-original-title="Сервер"><i class="fa fa-tasks" style="width: 15px;"></i></span>
					<input value="'.$at->serv_info( $date['server_id'] ).'" type="text" disabled class="form-control">
				</div>
				<div class="input-group">
					<span class="input-group-addon" data-widget="collapse" data-toggle="tooltip" title="" data-placement="top" data-original-title="Услуга"><i class="fa fa-shopping-cart" style="width: 15px;"></i></span>
					<input value="'.$at->tarif_info( $date['service_id'] ).'" type="text" disabled class="form-control">
				</div>
				<div class="input-group">
					<span class="input-group-addon" data-widget="collapse" data-toggle="tooltip" title="" data-placement="top" data-original-title="Добавлен"><i class="fa fa-plus" style="width: 15px;"></i></span>
					<input value="'.date( 'd.m.Y [H:i]', $date['time'] ).'" type="text" disabled class="form-control">
				</div>
				<div class="input-group">
					<span class="input-group-addon" data-widget="collapse" data-toggle="tooltip" title="" data-placement="top" data-original-title="Срок"><i class="fa fa-calendar" style="width: 15px;"></i></span>
					<input value="'.$thisdate.'" type="text" disabled class="form-control">
					<span class="input-group-btn">
						<button data-toggle="collapse" data-target="#prolong" class="btn btn-warning" '.$block_submit.'>Продлить</button>
					</span>
				</div>
				<div id="prolong" class="collapse">
					<div class="callout callout-info">
						<script type="text/javascript">
							$(function time_list(){
								$.ajax({
									type: "POST",
									url: "'.$url.'service.php",
									data: "id=2&tarif_time="+'.$date['service_id'].',
									success: function(data){
										$("#tarif_list_time").html(data);
									}
								});
							});
						</script>
						<form action="'.$url.'auth/prolong.php" id="prolong" name="prolong" method="POST" style="margin: 0;" autocomplete="off">
							<div class="form-group">
								<label>Срок:</label>
								<div id="tarif_list_time"></div>
							</div>
							<div class="form-group">
								<label>Способ оплаты:</label>
								<select id="how" name="how" class="form-control" required>
									'.$wmr.'
									'.$uni.'
									'.$rob.'
								</select>
							</div>
							<input type="hidden" name="user_id" value="'.$date['id'].'">
							<input class="btn btn-block btn-warning" type="submit" value="Оплатить" name="submit">
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.box -->';
	}
?>