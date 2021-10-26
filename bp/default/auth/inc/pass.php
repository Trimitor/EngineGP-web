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
	
	if ( ! empty( $_POST['changepass'] ) )
	{
		if ( trim( $_POST['newpass'] ) != trim( $_POST['twonewpass'] ) ) {
			echo $eng->alert_mess( 'Пароли не совпадают!' );
		} else if ( trim( $_POST['newpass'] ) == NULL || trim( $_POST['twonewpass'] ) == NULL || trim( $_POST['lastpass'] ) == NULL ) {
			echo $eng->alert_mess( 'Заполнены не все поля!' );
		} else if ( ! preg_match( '/^[\w]{6,32}+$/', trim( $_POST['newpass'] ) ) ) { 
			echo $eng->alert_mess( 'В пароле могут быть только английские буквы и цифры, а также его длина должна быть от 6 до 32 символа!' );
		} else {
			$query = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `password` = '".$db->m_escape( md5( sha1( trim( $_POST['lastpass'] ) ) ) )."' AND `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
			if ( $db->n_rows( $query ) > 0 )
			{
				$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `password` = '".$db->m_escape( md5( sha1( trim( $_POST['newpass'] ) ) ) )."', `servpass` = '".$db->m_escape( trim( $_POST['newpass'] ) )."' WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
				echo $eng->alert_mess('Пароль успешно изменен!');
				$server = $at->auth_info( 'server_id', $id, $hash );
				$eng->up_cfg ( $server, $eng->g_cfg( $server ) );
			} else {
				echo $eng->alert_mess( 'Старый пароль указан неверно!' );
			}
		}
	}
	
	echo '
	<div class="box box-danger">
		<!-- box-header -->
		<div class="box-header">
			<i class="fa fa-lock"></i>
			<h3 class="box-title">Смена пароля</h3>
			<div class="pull-right box-tools">
				<button class="btn btn-danger btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
				<button class="btn btn-danger btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
			<form action="" method="POST" autocomplete="off">
				<div class="form-group">
					<label>Старый пароль:</label>
					<input type="password" id="lastpass" name="lastpass" placeholder="Старый пароль" required class="form-control">
				</div>
				<div class="form-group">
					<label>Новый пароль:</label>
					<input type="password" id="newpass" name="newpass" placeholder="Новый пароль" pattern="^[\w]{6,32}$" required class="form-control">
				</div>
				<div class="form-group">
					<label>Новый пароль:</label>
					<input type="password" id="twonewpass" name="twonewpass" placeholder="Новый пароль" pattern="^[\w]{6,32}$" required class="form-control">
				</div>
				<div class="clearfix"><input class="pull-right btn btn-danger" type="submit" value="Изменить пароль" name="changepass"></div>	
			</form>
		</div><!-- /.box-body -->
	</div><!-- /.box -->';
?>