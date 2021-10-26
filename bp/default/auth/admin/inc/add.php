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
	
	if ( ! empty( $_POST['add'] ) )
	{
		$sql_uniq = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `auth` = '".$db->m_escape( trim( $_POST['auth'] ) )."' AND `server_id` = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );
		$sql_check = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers`,`".$GLOBALS['db_prefix']."_tarifs` WHERE `".$GLOBALS['db_prefix']."_servers`.id = '".abs( ( int ) $_POST['server'] )."' AND `".$GLOBALS['db_prefix']."_tarifs`.id = '".abs( ( int ) $_POST['tarif'] )."' AND `".$GLOBALS['db_prefix']."_tarifs`.server_id = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );

		if ( $db->n_rows( $sql_uniq ) > 0 ) {
			echo $eng->alert_mess( 'Игрок уже зарегистрирован на данном сервере!' );
		} else if ( $db->n_rows( $sql_check ) == 0 ) {
			echo $eng->alert_mess( 'Не выбран(а) сервер или услуга!' );
		} else if ( trim( $_POST['type'] ) == 'a' && preg_match('/[а-яё]/i', trim( $_POST['auth'] ) ) || $_POST['auth'] == NULL || strlen( $_POST['auth'] ) > 32 ) {
			echo $eng->alert_mess( 'Ник не указан или указан неверно!' );
		} else if ( ( trim( $_POST['type'] ) == 'ca' ) && ( ! preg_match("/^STEAM_0:[01]:[0-9]{5,10}$/", trim( $_POST['auth'] ) ) ) ) {
			echo $eng->alert_mess( 'Неверно заполнено поле "Steam ID"' );
		} else if ( trim( $_POST['type'] ) == 'de' && ! preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", trim( $_POST['auth'] ) ) ) {
			echo $eng->alert_mess( 'Неверно заполнено поле "IP"' );
		} else if ( ! in_array( trim( $_POST['type'] ), array( "a", "ca", "de" ) ) ) {
			echo $eng->alert_mess( 'Не выбран тип авторизации!' );
		} else if ( ! preg_match( '/^[\w]{6,32}+$/', trim( $_POST['pass'] ) ) ) {
			echo $eng->alert_mess( 'В пароле могут быть только английские буквы и цифры, а также его длина должна быть от 6 до 32 символа!' );
		} else if ( mb_strlen( trim( $_POST['name'] ), 'UTF-8' ) > 12 || strlen( trim( $_POST['skype'] ) ) > 32 ) {
			echo $eng->alert_mess( 'Поле "Имя" не должно содержать более 12 символов, а поле "Skype" - 32 символа!' );
		} else if ( ! preg_match( '/^[0-9]+$/', abs( ( int ) $_POST['time'] ) ) ) {
			echo $eng->alert_mess( 'Неверно заполнен срок!' );
		} else if ( ! preg_match( '/^[a-z]+$/', trim( $_POST['access'] ) ) ) {
			echo $eng->alert_mess( 'Неверно заполнены флаги!' );
		} else {
			$time = abs( ( int ) $_POST['time'] );
			
			if ( $time == 0 ){
				$date_end = 0;
			} else {
				$date_end = time()+3600*24*$time;
			}
			
			$db->m_query( "INSERT INTO `".$GLOBALS['db_prefix']."_admins` (`id`, `auth`, `password`, `access`, `flags`, `servpass`, `name`, `skype`, `server_id`, `service_id`, `time`, `utime`, `hash`) VALUES (NULL, '".$db->m_escape( trim( $_POST['auth'] ) )."', '".$db->m_escape( md5( sha1( trim( $_POST['pass'] ) ) ) )."', '".$db->m_escape( trim( $_POST['access'] ) )."', '".$db->m_escape( trim( $_POST['type'] ) )."', '".$db->m_escape( trim( $_POST['pass'] ) )."',  '".$db->m_escape( trim( $_POST['name'] ) )."', '".$db->m_escape( trim( $_POST['skype'] ) )."', '".abs( ( int ) $_POST['server'] )."', '".abs( ( int ) $_POST['tarif'] )."', '".time()."', '".$date_end."', '".$at->GenerateKey()."')" );
			$server = abs( ( int ) $_POST['server'] );
			$eng->up_cfg ( $server, $eng->g_cfg( $server ) );
			echo $eng->alert_mess( 'Игрок успешно добавлен!' );
		}
	}
	
	echo '
	<script type="text/javascript">
		$(function() {
			tarif_list();
		});
		
		function time_list()
		{
			var tarif = $( "#tarif" ).val();
			var server = $( "#server" ).val();
			$.ajax({
				type: "POST",
				url: "'.$url.'auth/admin/flag.php",
				data: "id=1&tarif="+tarif+"&server="+server,
				success: function(data){
					$("#access").val(data);
				}
			});
		}
		
		function tarif_list()
		{
			var server = $( "#server" ).val();
			$.ajax({
				type: "POST",
				url: "'.$url.'service.php",
				data: "id=1&server="+server,
				success: function(data){
					$("#tarif_list").html(data);
				}
			});
		}
		function sel_server(){}
		function changetype(name)
		{
			if (name=="a")
			{
				$("#login_annotation").html("Ник");
				$("#auth").attr("placeholder", "Ник");
			} else if (name=="ca") {
				$("#login_annotation").html("SteamID");
				$("#auth").attr("placeholder", "STEAM_0:0:123456789");
			} else if (name=="de") {
				$("#login_annotation").html("IP - Адрес");
				$("#auth").attr("placeholder", "127.0.0.1");
			}
		}
	</script>
	<div class="col-md-6">
		<div class="box box-success">
			<!-- box-header -->
			<div class="box-header">
				<i class="fa fa-plus"></i>
				<h3 class="box-title">Добавить игрока</h3>
				<div class="pull-right box-tools">
					<button class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
					<button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form role="form" action="" method="POST" autocomplete="off">
					<div class="form-group">
						<label>Тип:</label>
						<select id="type" name="type" onClick="changetype(this.value)" class="form-control" required>
							<option value="a" selected="selected">Ник + Пароль</option>
							<option value="ca">Steam ID + Пароль</option>
							<option value="de">IP - Адрес</option>
						</select>
					</div>
					<div class="form-group">
						<label><span id="login_annotation">Ник</span>:</label>
						<input type="text" id="auth" name="auth" placeholder="Ник" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Пароль:</label>
						<input type="text" id="pass" name="pass" placeholder="Пароль" pattern="^[\w]{6,32}$" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Имя:</label>
						<input type="text" id="name" name="name" placeholder="Имя" class="form-control">
					</div>
					<div class="form-group">
						<label>Skype:</label>
						<input type="text" id="skype" name="skype" placeholder="Skype" class="form-control">
					</div>
					<div class="form-group">
						<label>Сервер:</label>
						'.$eng->serverlist().'
					</div>
					<div class="form-group">
						<label>Услуга:</label>
						<div id="tarif_list"></div>
					</div>
					<div class="form-group">
						<label>Флаги:</label>
						<input type="text" id="access" name="access" placeholder="abcdefghijklmnopqrstu" pattern="^[a-z]+$" class="form-control" required>
					</div>	
					<div class="form-group">
						<label>Срок:</label>
						<input type="text" id="time" name="time" placeholder="0 - Бессрочно" pattern="^[0-9]+$" class="form-control" required>
					</div>	
					<div class="clearfix"><input class="pull-right btn btn-success" type="submit" value="Добавить игрока" name="add"></div>
				</form>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>';
?>