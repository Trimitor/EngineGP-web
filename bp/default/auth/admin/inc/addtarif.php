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
	
	if ( ! empty( $_POST['addtarif'] ) )
	{
		$sql_uniq = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs` WHERE `name` = '".$db->m_escape( trim( $_POST['name'] ) )."' AND `server_id` = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );
		$sql_serv = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers` WHERE `id` = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );

		if ( $db->n_rows( $sql_uniq ) > 0 ) {
			echo $eng->alert_mess( 'Данная услуга уже зарегистрирована, на сервере!' );
		} else if ( $db->n_rows( $sql_serv ) == 0 ) {
			echo $eng->alert_mess( 'Не выбран сервер!' );
		} else if ( trim( $_POST['name'] ) == NULL ) {
			echo $eng->alert_mess( 'Не заполнено поле "Имя"' );
		} else if ( trim( $_POST['access'] ) == NULL  || is_numeric( trim( $_POST['access'] ) ) ) {
			echo $eng->alert_mess( 'Неверно заполнены флаги!' );
		} else if ( ! preg_match( '/^(?:\d+,)*\d+$/', trim( $_POST['time'] ) ) || ! preg_match( '/^(?:\d+,)*\d+$/', trim( $_POST['price'] ) )) {
			echo $eng->alert_mess( 'Неверно заполнено поле "Время" или "Цена"!' );
		} else {
			$price = trim( $_POST['price'] );
			$arr_price = explode(",", $price);
			$time = trim( $_POST['time'] );
			$arr_time = explode(",", $time);
			$n = count( $arr_price );
			
			$insert_tarif = $db->m_query( "INSERT INTO `".$GLOBALS['db_prefix']."_tarifs` (`id`, `server_id`, `name`, `access`) VALUES (NULL, '".abs( ( int ) $_POST['server'] )."', '".$db->m_escape( trim( $_POST['name'] ) )."', '".$db->m_escape( trim( $_POST['access'] ) )."')" );
			$id_tarif = mysqli_insert_id( $database );

			for( $i = 0; $i < $n; $i++ )
			{
				$db->m_query( "INSERT INTO `".$GLOBALS['db_prefix']."_tarif_time` (`id`, `tarif_id`, `server_id`, `price`, `time`) VALUES (NULL, '".$id_tarif."', '".abs( ( int ) $_POST['server'] )."', '".abs( ( int ) $arr_price[$i] )."', '".abs( ( int ) $arr_time[$i] )."')" );
			}
			echo $eng->alert_mess( 'Услуга успешно добавлена!' );
		}
	}
	
	echo '
	<div class="col-md-6">
		<div class="box box-warning">
			<!-- box-header -->
			<div class="box-header">
				<i class="fa fa-shopping-cart"></i>
				<h3 class="box-title">Добавить услугу</h3>
				<div class="pull-right box-tools">
					<button class="btn btn-warning btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
					<button class="btn btn-warning btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form role="form" action="" method="POST" autocomplete="off">
					<div class="form-group">
						<label>Название:</label>
						<input type="text" id="name" name="name" placeholder="Название" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Сервер:</label>
						'.$eng->serverlist().'
					</div>
					<div class="form-group">
						<label>Флаги:</label>
						<input type="text" id="access" name="access" placeholder="abcdefghijklmnopqrstu" pattern="^[a-z]+$" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Время:</label>
						<input type="text" id="time" name="time" pattern="^(?:\d+,)*\d+$" placeholder="Время через запятую" class="form-control" required>		
					</div>
					<div class="form-group">
						<label>Цена:</label>
						<input type="text" id="price" name="price" pattern="^(?:\d+,)*\d+$" placeholder="Цена через запятую" class="form-control" required>
					</div>
					<div class="clearfix"><input class="pull-right btn btn-warning" type="submit" value="Добавить услугу" name="addtarif"></div>
				</form>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>';
?>