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
	
	if ( ! empty( $_POST['del_user'] ) )
	{
		$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".abs( ( int ) $_POST['user_id'] )."' LIMIT 1" );
		$server = abs( ( int ) $_POST['server_id'] );
		$eng->up_cfg ( $server, $eng->g_cfg( $server ) );
		echo $eng->alert_mess('Игрок успешно удален!');
	}
	
	if ( isset( $_GET['user'] ) )
    {
		$query_user = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".abs( ( int ) $_GET['user'] )."' LIMIT 1" );
		
		if ( $db->n_rows( $query_user ) > 0 )
		{
			if ( ! empty( $_POST['red_user'] ) )
			{
				$sql_uniq = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `auth` = '".$db->m_escape( trim( $_POST['auth'] ) )."' AND `server_id` = '".$db->m_escape( trim( $_POST['server'] ) )."' AND `id` != '".abs( ( int ) $_GET['user'] )."' LIMIT 1" );
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
				} else if ( ! preg_match( '/^[a-z]+$/', trim( $_POST['access'] ) ) ) {
					echo $eng->alert_mess( 'Неверно заполнены флаги!' );
				} else {
					$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `auth` = '".$db->m_escape( trim( $_POST['auth'] ) )."', `password`= '".$db->m_escape( md5( sha1( trim( $_POST['pass'] ) ) ) )."', `access` = '".$db->m_escape( trim( $_POST['access'] ) )."', `flags` = '".$db->m_escape( trim( $_POST['type'] ) )."', `servpass` = '".$db->m_escape( trim( $_POST['pass'] ) )."', `name` = '".$db->m_escape( trim( $_POST['name'] ) )."', `skype` = '".$db->m_escape( trim( $_POST['skype'] ) )."', `server_id` = '".abs( ( int ) $_POST['server'] )."', `service_id` = '".abs( ( int ) $_POST['tarif'] )."', `hash` = '".$at->GenerateKey()."' WHERE `id` = '".abs( ( int ) $_GET['user'] )."' LIMIT 1" );
					$server = abs( ( int ) $_POST['server'] );
					$eng->up_cfg ( $server, $eng->g_cfg( $server ) );
					echo $eng->alert_mess( 'Игрок успешно изменен!' );
				}
			}
			
			if ( ! empty( $_POST['red_time'] ) )
			{
				$sql_uniq = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".abs( ( int ) $_GET['user'] )."' LIMIT 1" );
				$sql = $db->f_arr( $sql_uniq );
				
				if ( $sql['utime'] == 0 ) {
					echo $eng->alert_mess( 'Бессрочный срок не может быть продлен!' );
				} else if ( ! preg_match( '/^[0-9]+$/', abs( ( int ) $_POST['time'] ) ) ) {
					echo $eng->alert_mess( 'Неверно заполнен срок!' );
				} else {
					$time = abs( ( int ) $_POST['time'] );
					
					if ( $time == 0 ) {
						$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = ('0') WHERE `id` = '".$sql['id']."'");
					} else {
						$date_con_a = time()+3600*24*$time;
						$date_con_b = 3600*24*$time;
						
						if ( $sql['utime'] < time() ) {
							$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = ('".$date_con_a."') WHERE `id` = '".$sql['id']."'" );
						} else {
							$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = (`utime`+'".$date_con_b."') WHERE `id` = '".$sql['id']."'" );
						}
					}
					$server = $sql['server_id'];
					$eng->up_cfg ( $server, $eng->g_cfg( $server ) );
					echo $eng->alert_mess( 'Срок игрока успешно продлен!' );
				}
			}
			
			$date = $db->f_arr( $query_user );
			
			if ( $date['utime'] == 0 ) {
				$thisdate = 'Бессрочно';
			} else {
				$date_utime = $eng->dateDiff( time(), $date['utime'] ); 
				if ( $date_utime == 'end' ) {
					$thisdate = 'Срок истек';
				} else if ( $date_utime == 'few' ) {
					$thisdate = 'Пару секунд';
				} else {
					$thisdate = $date_utime;
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
								$("#tarif").val( \''.$date['service_id'].'\' ).prop(\'selected\', true);
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
				<div class="box box-info">
					<!-- box-header -->
					<div class="box-header">
						<i class="glyphicon glyphicon-user"></i>
						<h3 class="box-title">Игрок # '.$date['id'].'</h3>
						<div class="pull-right box-tools">
							<button class="btn btn-info btn-sm" href="#" onclick="history.back();return false;" data-toggle="tooltip" title="" data-placement="left" data-original-title="Назад"><i class="fa fa-mail-reply"></i></button>
							<button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
							<button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
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
								<script>$("#type").val( \''.$date['flags'].'\' ).prop(\'selected\', true);</script>
							</div>
							<div class="form-group">
								<label><span id="login_annotation">Ник</span>:</label>
								<input type="text" id="auth" name="auth" value="'.$date['auth'].'" placeholder="Ник" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Пароль:</label>
								<input type="text" id="pass" name="pass" value="'.$date['servpass'].'" placeholder="Пароль" pattern="^[\w]{6,32}$" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Имя:</label>
								<input type="text" id="name" name="name" value="'.$date['name'].'" placeholder="Имя" class="form-control">
							</div>
							<div class="form-group">
								<label>Skype:</label>
								<input type="text" id="skype" name="skype" value="'.$date['skype'].'" placeholder="Skype" class="form-control">
							</div>
							<div class="form-group">
								<label>Сервер:</label>
								'.$eng->serverlist().'
								<script>$("#server").val( \''.$date['server_id'].'\' ).prop(\'selected\', true);</script>
							</div>
							<div class="form-group">
								<label>Услуга:</label>
								<div id="tarif_list"></div>
							</div>
							<div class="form-group">
								<label>Флаги:</label>
								<input type="text" id="access" name="access" value="'.$date['access'].'" placeholder="abcdefghijklmnopqrstu" pattern="^[a-z]+$" class="form-control" required>
							</div>	
							<div class="clearfix"><input class="pull-right btn btn-info" type="submit" value="Изменить данные" name="red_user"></div>
						</form>					
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
			<div class="col-md-6">
				<div class="box box-danger">
					<!-- box-header -->
					<div class="box-header">
						<i class="fa fa-calendar"></i>
						<h3 class="box-title">Продлить срок</h3>
						<div class="pull-right box-tools">
							<button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
							<button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="callout callout-danger">
							<p>
								<h4>Текущий срок: <b>'.$thisdate.'</b></h4>
								<b>
									Для продления срока введите количество дней цифрой!
								</b>
							</p>
						</div>
						<form role="form" action="" method="POST" autocomplete="off">
							<div class="form-group">
								<label>Срок:</label>
								<input type="text" id="time" name="time" placeholder="0 - Бессрочно" pattern="^[0-9]+$" class="form-control" required>
							</div>			
							<div class="clearfix"><input class="pull-right btn btn-danger" type="submit" value="Продлить срок" name="red_time"></div>
						</form>				
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>';	
		} else {
			echo '
			<div class="col-md-12">
				<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-check"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4>Внимание!</h4>
					<b>Игрок не найден <a href="#" onclick="history.back();return false;">вернуться назад!</a></b>
				</div>
			</div>';
		}
	} else {
		echo '
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-list"></i>
					<h3 class="box-title">Список Админов | V.I.P</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
						<button class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover">
							<thead style="color: #eeeeee; background-color: #4A4A4A;">
								<tr>
									<th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
									<th width="10%"><i class="fa fa-male"></i> Имя</th>
									<th><i class="glyphicon glyphicon-user"></i> Игрок</th>
									<th><center><i class="fa fa-tasks"></i> Сервер</center></th>
									<th width="20%"><center><i class="fa fa-asterisk"></i> Функции</center></th>
								</tr>
							</thead>
							<tbody>';
						
						$pagination = $eng->pagination( array( "query" => "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` ORDER BY `utime` = '0' DESC, `utime` DESC", "page_num" => 15, "url" => $url."auth/admin/users.php" ) );
						$query = $db->m_query( $pagination['query'] );
						
						if ( $db->n_rows( $query ) > 0 )
						{
							$i = $pagination['count'];
							while ( $date = $db->f_arr( $query ) )
							{
								++$i;
								$add_tr = ( $date['utime'] != 0 && $date['utime'] < time() ) ? 'class="danger"' : '';
								$server = ( mb_strlen( $at->serv_info( $date['server_id'] ) ) > 19 ) ? mb_substr( $at->serv_info( $date['server_id'] ), 0, 17, 'UTF-8' ).'...' : $at->serv_info( $date['server_id'] );
								$auth = ( strlen( $date['auth'] ) > 15 ) ? substr( $date['auth'], 0, 13 ).'...' : $date['auth'];
								$name = ( $date['name'] != NULL ) ? $date['name'] : 'Неизвестно';
								
								echo '
								<tr '.$add_tr.'>
									<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$i.'</b></center></td>
									<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$name.'">'.$name.'</b></td>
									<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['auth'].'">'.$auth.'</b></td>
									<td><center><b data-toggle="tooltip" data-placement="right" data-original-title="'.$at->serv_info( $date['server_id'] ).'">'.$server.'</b></center></td>
									<td>
										<center>
											<a href="?user='.$date['id'].'" role="button" data-toggle="modal" class="btn btn-xs btn-primary"><i data-toggle="tooltip" data-placement="top" data-original-title="Редактировать" class="fa fa-edit"></i></a>
											<a href="#del'.$date['id'].'" role="button" data-toggle="modal" class="btn btn-xs btn-danger"><i data-toggle="tooltip" data-placement="right" data-original-title="Удалить" class="fa fa-trash-o"></i></a>
										</center>
									</td>
								</tr>
								<div class="modal fade" id="del'.$date['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog">
									   <form action="" method="POST" style="margin: 0 0 5px;">
											<input type="hidden" name="user_id" value="'.$date['id'].'">
											<input type="hidden" name="server_id" value="'.$date['server_id'].'">
											<div class="modal-body">
												<div class="alert alert-success" style="margin-bottom: 0;">
													<center><b>Вы подтверждаете удаление игрока №'.$i.'?</b></center>
													<a class="btn btn-danger" data-dismiss="modal">Нет</a>
													<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit" value="Да" name="del_user">  
												</div>
											</div>
										</form>
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->';
							}
							echo '</tbody>
							</table><center>'.$pagination['pages'].'</center>';
						} else {
							echo '
							<tr>
								<td colspan="7"><b>Список администрации пуст!</b></td>
							</tr></tbody>
							</table>';
						}
			echo '</div>
				</div>
			</div>
		</div>';
		require_once "inc/add.php";
	}
?>