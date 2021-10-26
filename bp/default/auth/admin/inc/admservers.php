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
	
	if ( ! empty( $_POST['del_server'] ) )
	{
		$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_servers` WHERE `id` = '".abs( ( int ) $_POST['d_id'] )."' LIMIT 1" );
		$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_tarifs` WHERE `server_id` = '".abs( ( int ) $_POST['d_id'] )."'" );
		$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_tarif_time` WHERE `server_id` = '".abs( ( int ) $_POST['d_id'] )."'" );
		echo $eng->alert_mess('Сервер успешно удален!');
	}
	
	if ( isset( $_GET['server'] ) )
    {
		$query_server = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers` WHERE `id` = ".abs( ( int ) $_GET['server'] )." LIMIT 1" );
		
		if ( $db->n_rows( $query_server ) > 0 )
		{
			if ( ! empty( $_POST['red_server'] ) )
			{
				$sql_uniq = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers` WHERE `name` = '".$db->m_escape( trim( $_POST['red_name'] ) )."' AND `hostname` = '".$db->m_escape( trim( $_POST['red_hostname'] ) )."' AND `login` = '".$db->m_escape( trim( $_POST['red_login'] ) )."' AND `password` = '".$db->m_escape( trim( $_POST['red_password'] ) )."' AND `id` != '".abs((int)$_GET['server'])."' LIMIT 1" );
				
				if ( $db->n_rows( $sql_uniq ) > 0 ) {
					echo $eng->alert_mess( 'Сервер уже зарегистрирован!' );
				} else if ( trim( $_POST['red_name'] ) == NULL || trim( $_POST['red_hostname'] ) == NULL || trim( $_POST['red_login'] ) == NULL || trim( $_POST['red_password'] ) == NULL || trim( $_POST['red_address'] ) == NULL || trim( $_POST['red_path'] ) == NULL ) {
					echo $eng->alert_mess( 'Все поля обязательны для заполнения!' );
				} else {
					$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_servers` SET `name` = '".$db->m_escape( trim( $_POST['red_name'] ) )."', `hostname` = '".$db->m_escape( trim( $_POST['red_hostname'] ) )."', `login` = '".$db->m_escape( trim( $_POST['red_login'] ) )."', `password` = '".$db->m_escape( trim( $_POST['red_password'] ) )."', `address` = '".$db->m_escape( trim( $_POST['red_address'] ) )."', `path` = '".$db->m_escape( trim( $_POST['red_path'] ) )."' WHERE `id` = '".abs( ( int ) $_GET['server'] )."'" );
					echo $eng->alert_mess( 'Сервер успешно изменен!' );
				}
			}
			
			if ( ! empty( $_POST['delete_tarif'] ) )
			{
				$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_tarifs` WHERE `id` = '".abs( ( int ) $_POST['del_id'] )."'" );
				$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_tarif_time` WHERE `tarif_id` = '".abs( ( int ) $_POST['del_id'] )."'" );
				echo $eng->alert_mess('Услуга успешно удалена!');
			}
		
			$date = $db->f_arr( $query_server );
			echo '
			<div class="col-md-6">
				<div class="box box-danger">
					<!-- box-header -->
					<div class="box-header">
						<i class="fa fa-tasks"></i>
						
						<h3 class="box-title">Сервер # '.$date['id'].'</h3>
						<div class="pull-right box-tools">
							<a style="color:#fff;" class="btn btn-danger btn-sm" href="'.$url.'auth/admin/" data-toggle="tooltip" title="" data-placement="left" data-original-title="Назад"><i class="fa fa-mail-reply"></i></a>
							<button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
							<button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<form role="form" action="" method="POST" autocomplete="off">
							<div class="form-group">
								<label>Название:</label>
								<input type="text" id="red_name" name="red_name" value="'.$date['name'].'" placeholder="Название" class="form-control" required>
							</div>
							<div class="form-group">
								<label>FTP Хост:</label>
								<input type="text" id="red_hostname" name="red_hostname" value="'.$date['hostname'].'" placeholder="FTP Хост" class="form-control" required>
							</div>
							<div class="form-group">
								<label>FTP Логин:</label>
								<input type="text" id="red_login" name="red_login" value="'.$date['login'].'" placeholder="FTP Логин" class="form-control" required>
							</div>
							<div class="form-group">
								<label>FTP Пароль:</label>
								<input type="text" id="red_password" name="red_password" value="'.$date['password'].'" placeholder="FTP Пароль" class="form-control" required>
							</div>
							<div class="form-group">
								<label>IP:PORT:</label>
								<input type="text" id="red_address" name="red_address" value="'.$date['address'].'" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{1,5}" placeholder="IP:PORT" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Путь к файлу:</label>
								<input type="text" id="red_path" name="red_path" value="'.$date['path'].'" placeholder="Путь к файлу users.ini" class="form-control" required>
							</div>
							<div class="clearfix">
								<input class="pull-right btn btn-danger" type="submit" value="Изменить данные" name="red_server">
							</div>
						</form>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>';
			if ( isset( $_GET['tarif'] ) )
			{
				$query_tarif = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs` WHERE `id` = '".abs( ( int ) $_GET['tarif'] )."' AND `server_id` = '".abs( ( int ) $_GET['server'] )."' LIMIT 1" );

				if ( $db->n_rows( $query_tarif ) > 0 )
				{
					if ( ! empty( $_POST['changetarif'] ) )
					{
						$sql_uniq = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs` WHERE `name` = '".$db->m_escape( trim( $_POST['name'] ) )."' AND `server_id` = '".abs( ( int ) $_POST['server'] )."' AND `id` != '".abs( ( int) $_GET['tarif'] )."' LIMIT 1" );
						$sql_serv = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers` WHERE `id` = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );
						
						if ( $db->n_rows( $sql_uniq ) > 0 ) {
							echo $eng->alert_mess( 'Данная услуга уже зарегистрирована, на сервере!' );
						} else if ( trim( $_POST['name'] ) == NULL ) {
							echo $eng->alert_mess( 'Не заполнено поле "Имя"' );
						} else if ( $db->n_rows( $sql_serv ) == 0 ) {
							echo $eng->alert_mess( 'Не выбран сервер!' );
						} else if ( ! preg_match( '/^[a-z]+$/', trim( $_POST['access'] ) ) ) {
							echo $eng->alert_mess( 'Неверно заполнены флаги!' );
						} else {
							$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_tarifs` SET `server_id` = '".abs( ( int ) $_POST['server'] )."', `name` = '".$db->m_escape( trim( $_POST['name'] ) )."', `access` = '".$db->m_escape( trim( $_POST['access'] ) )."' WHERE `id` = '".abs( ( int ) $_GET['tarif'] )."' LIMIT 1" );
							echo $eng->alert_mess( 'Услуга успешно изменена!' );
						}
					}
				
					if ( ! empty( $_POST['add_time'] ) )
					{
						if ( ! preg_match( '/^(?:\d+,)*\d+$/', trim( $_POST['time_add'] ) ) || ! preg_match( '/^(?:\d+,)*\d+$/', trim( $_POST['price_add'] ) ) ) {
							echo $eng->alert_mess( 'Неверно заполнено поле "Время" или "Цена"!' );
						} else {
							$price = trim( $_POST['price_add'] );
							$arr_price = explode(",", $price);
							$time = trim( $_POST['time_add'] );
							$arr_time = explode(",", $time);
							$n = count( $arr_price );
							for( $i = 0; $i < $n; $i++ )
							{
								$db->m_query( "INSERT INTO `".$GLOBALS['db_prefix']."_tarif_time` (`id`, `tarif_id`, `server_id`, `price`, `time`) VALUES (NULL, '".abs( ( int ) $_GET['tarif'] )."', '".abs( ( int ) $_GET['server'] )."', '".abs( ( int ) $arr_price[$i] )."', '".abs( ( int ) $arr_time[$i] )."')" );
							}
							echo $eng->alert_mess( 'Время успешно добавлено!' );
						}
					}
					
					if ( ! empty( $_POST['time_change'] ) )
					{
						if ( ! preg_match( '/^[0-9]+$/', abs( ( int ) $_POST['time'] ) ) || ! preg_match( '/^[0-9]+$/', abs( ( int ) $_POST['price'] ) ) ) {
							echo $eng->alert_mess( 'Неверно заполнено поле "Время" или "Цена"!' );
						} else {
							$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_tarif_time` SET `time` = '".abs( ( int ) $_POST['time'] )."', `price` = '".abs( ( int ) $_POST['price'] )."' WHERE `id` = '".abs( ( int ) $_POST['id'] )."' LIMIT 1" );
							echo $eng->alert_mess( 'Время успешно изменено!' );
						}
					}
					
					if ( ! empty( $_POST['del_time'] ) )
					{
						$db->m_query( "DELETE FROM `".$GLOBALS['db_prefix']."_tarif_time` WHERE `id` = '".abs( ( int ) $_POST['del_t_id'] )."' LIMIT 1" );
						echo $eng->alert_mess( 'Время успешно удалено!' );
					}
					
					$date = $db->f_arr( $query_tarif );
					echo '
					<div class="col-md-6">
						<div class="box box-success">
							<!-- box-header -->
							<div class="box-header">
								<i class="fa fa-shopping-cart"></i>
								<h3 class="box-title">Услуга # '.$date['id'].'</h3>
								<div class="pull-right box-tools">
									<button class="btn btn-success btn-sm" onclick="history.back(); return false;" data-toggle="tooltip" title="" data-placement="left" data-original-title="Назад"><i class="fa fa-mail-reply"></i></button>
									<button class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
									<button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
								</div>
							</div><!-- /.box-header -->
							<div class="box-body">
								<form role="form" action="" method="POST" autocomplete="off">
									<div class="form-group">
										<label>Название:</label>
										<input type="text" id="name" name="name" value="'.$date['name'].'" placeholder="Название" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Сервер:</label>
										'.$eng->serverlist().'
										<script> $("#server").val( '.$date['server_id'].' ).prop(\'selected\', true); </script>
									</div>
									<div class="form-group">
										<label>Флаги:</label>
										<input type="text" id="access" name="access" value="'.$date['access'].'" placeholder="abcdefghijklmnopqrstu" pattern="^[a-z]+$" class="form-control" required>
									</div>
									<div class="clearfix"><input class="pull-right btn btn-success" type="submit" value="Изменить услугу" name="changetarif"></div>
								</form>
								<br />
								<div class="box-header">
									<i class="fa fa-clock-o"></i>
									<h3 class="box-title">Время и Цена</h3>
								</div>
								<div class="box-body table-responsive no-padding">
									<table class="table table-bordered">
										<thead style="color: #eeeeee; background-color: #4A4A4A;">
											<tr>
												<th>ID</th>
												<th><i class="fa fa-clock-o"></i> Время</th>
												<th><i class="fa fa-shopping-cart"></i> Цена</th>
												<th width="20%"><center><i class="fa fa-asterisk"></i> Функции</center></th>
											</tr>
										</thead>
										<tbody>';
										$query_time = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarif_time` WHERE `tarif_id` = ".abs( ( int ) $_GET['tarif'] )." ORDER by `id`" );
										while ( $date = $db->f_arr( $query_time ) ) {
											echo '
											<form role="form" name="time_form" action="" method="POST" autocomplete="off">
												<input type="hidden" name="id" id="id" value="'.$date['id'].'">
												<input type="hidden" name="time_change" id="time_change" value="1">
												<tr>
													<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$date['id'].'</b></center></td>
													<td><input type="text" id="time" name="time" pattern="^[0-9]+$" value="'.$date['time'].'" class="form-control" required></td>
													<td><input type="text" id="price" name="price" pattern="^[0-9]+$" value="'.$date['price'].'" class="form-control" required></td>
													<td>
														<center>
															<button onclick="document.time_form.submit();" class="btn btn-sm btn-success"><i data-toggle="tooltip" data-placement="left" data-original-title="Изменить" class="fa fa-edit"></i></button>
															<a href="#del_time_id'.$date['id'].'" role="button" data-toggle="modal" class="btn btn-sm btn-danger"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="fa fa-trash-o"></i></a>
														</center>
													</td>
												</tr>
											</form>
											<div class="modal fade" id="del_time_id'.$date['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
												<div class="modal-dialog">
												   <form action="" method="POST" style="margin: 0 0 5px;">
														<input type="hidden" id="del_t_id" name="del_t_id" value="'.$date['id'].'">
														<div class="modal-body">
															<div class="alert alert-success" style="margin-bottom: 0;">
																<center><b>Вы подтверждаете удаление времени # '.$date['id'].'?</b></center>
																<a class="btn btn-danger" data-dismiss="modal">Нет</a>
																<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit" value="Да" name="del_time">  
															</div>
														</div>
													</form>
												</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->';
										}
										echo '
											<form role="form" action="" method="POST" autocomplete="off">
												<tr>
													<td style="color: #eeeeee; background-color: #00a65a;"><center><b>#</b></center></td>
													<td><input type="text" id="time_add" name="time_add" pattern="^(?:\d+,)*\d+$" placeholder="Время через запятую" class="form-control" required></td>
													<td><input type="text" id="price_add" name="price_add" pattern="^(?:\d+,)*\d+$" placeholder="Цена через запятую" class="form-control" required></td>
													<td><center><input class="btn btn-success" type="submit" value="Добавить" name="add_time"></center></td>
												</tr>
											</form>
										</tbody>
									</table>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>';
				} else {
					echo '
					<div class="col-md-6">
						<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-check"></i>
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4>Внимание!</h4>
							<b>Услуга не найдена <a href="#" onclick="history.back();return false;">вернуться назад!</a></b>
						</div>
					</div>';
				}
			} else {
				echo '<div class="col-md-6">
					<div class="box box-success">
						<!-- box-header -->
						<div class="box-header">
							<i class="fa fa-shopping-cart"></i>
							<h3 class="box-title">Список услуг</h3>
							<div class="pull-right box-tools">
								<button class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
								<button class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="box-body table-responsive no-padding">
								<table class="table table-bordered table-hover">
										<thead style="color: #eeeeee; background-color: #4A4A4A;">
											<tr>
												<th width="1%"><center>ID</center></th>
												<th><i class="fa fa-shopping-cart"></i> Название</th>
												<th width="20%"><center><i class="fa fa-asterisk"></i> Функции</center></th>
											</tr>
										</thead>
										<tbody>';
										$query = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs` WHERE `server_id` = '".abs( ( int ) $_GET['server'] )."'" );
										if ( $db->n_rows( $query ) > 0 )
										{
											while ( $date = $db->f_arr( $query ) )
											{
												echo '
												<tr>
													<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$date['id'].'</b></center></td>
													<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['name'].'">'.$date['name'].'</b></td>
													<td>
														<center>
															<a href="?server='.abs( ( int ) $_GET['server'] ).'&tarif='.$date['id'].'" role="button" data-toggle="modal" class="btn btn-xs btn-success"><i data-toggle="tooltip" data-placement="left" data-original-title="Редактировать" class="fa fa-edit"></i></a>
															<a href="#del_tarif'.$date['id'].'" role="button" data-toggle="modal" class="btn btn-xs btn-danger"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="fa fa-trash-o"></i></a>
														</center>
													</td>
												</tr>
												<div class="modal fade" id="del_tarif'.$date['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
													<div class="modal-dialog">
													   <form action="" method="POST" style="margin: 0 0 5px;">
															<input type="hidden" name="del_id" value="'.$date['id'].'">
															<div class="modal-body">
																<div class="alert alert-success" style="margin-bottom: 0;">
																	<center><b>Вы подтверждаете удаление услуги # '.$date['id'].'?</b></center>
																	<a class="btn btn-danger" data-dismiss="modal">Нет</a>
																	<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit" value="Да" name="delete_tarif">  
																</div>
															</div>
														</form>
													</div><!-- /.modal-dialog -->
												</div><!-- /.modal -->';
											}
										} else {
											echo '
											<tr>
												<td colspan="3"><b>Список услуг на сервере пуст, <a href="'.$url.'auth/admin/" title="Добавить услугу">добавить услугу!</a></b></td>
											</tr>';
										}
										echo '</tbody>
									</table>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>';
			}
		} else {
			echo '
			<div class="col-md-12">
				<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-check"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4>Внимание!</h4>
					<b>Сервер не найден <a href="#" onclick="history.back();return false;">вернуться назад!</a></b>
				</div>
			</div>';
		}
	} else {
		echo '
		<div class="col-md-12">
			<div class="box box-danger">
				<!-- box-header -->
				<div class="box-header">
					<i class="fa fa-list"></i>
					<h3 class="box-title">Список серверов</h3>
					<div class="pull-right box-tools">
						<button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
						<button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover">
							<thead style="color: #eeeeee; background-color: #4A4A4A;">
								<tr>
									<th width="1%"><center>ID</center></th>
									<th><i class="fa fa-tasks"></i> Название</th>
									<th><i class="fa fa-location-arrow"></i> IP - Адрес</th>
									<th width="20%"><center><i class="fa fa-asterisk"></i> Функции</center></th>
								</tr>
							</thead>
							<tbody>';
							$query = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers` ORDER BY `id`" );
							if ( $db->n_rows( $query ) > 0 )
							{
								while ( $date = $db->f_arr( $query ) )
								{
									echo '
									<tr>
										<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$date['id'].'</b></center></td>
										<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['name'].'">'.$date['name'].'</b></td>
										<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['address'].'">'.$date['address'].'</b></td>
										<td>
											<center>
												<a href="?server='.$date['id'].'" role="button" data-toggle="modal" class="btn btn-xs btn-warning"><i data-toggle="tooltip" data-placement="left" data-original-title="Редактировать" class="fa fa-edit"></i></a>
												<a href="#del'.$date['id'].'" role="button" data-toggle="modal" class="btn btn-xs btn-danger"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Удалить" class="fa fa-trash-o"></i></a>
											</center>
										</td>
									</tr>
									<div class="modal fade" id="del'.$date['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog">
										   <form action="" method="POST" style="margin: 0 0 5px;">
												<input type="hidden" name="d_id" value="'.$date['id'].'">
												<div class="modal-body">
													<div class="alert alert-success" style="margin-bottom: 0;">
														<center><b>Вы подтверждаете удаление сервера # '.$date['id'].'?</b><br />(Все услуги удаляться вместе с ним!)</center>
														<a class="btn btn-danger" data-dismiss="modal">Нет</a>
														<input style="float:right; margin-right: 20px;" class="btn btn-success" type="submit" value="Да" name="del_server">  
													</div>
												</div>
											</form>
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->';
								}
							} else {
								echo '
								<tr>
									<td colspan="4"><b>Список серверов пуст!</b></td>
								</tr>';
							}
							echo '</tbody>
						</table>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>';
		require_once "inc/addserv.php";
		require_once "inc/addtarif.php";
	}
?>