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
	
	
	if ( ! empty( $_GET['error'] ) ) 
	{
		$id = abs( ( int ) $_GET['error'] );
		
		if ( $id > 0 && $id <= 3 ) {
			$error_mess = array(
				1 => '<center><strong>Бессрочный срок не может быть продлен!</strong></center>',
				2 => '<center><strong>Игрок не найден!</strong></center>',
				3 => '<center><strong>Не выбран срок!</strong></center>',
				4 => '<center><strong>Платежная система не найдена!</strong></center>'
			);
			$error = $eng->alert_mess(''.$error_mess[$id].'');
		}
	}
?>