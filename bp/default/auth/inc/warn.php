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
	
	$query = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".$id."' AND `hash` = '".$hash."' LIMIT 1" );
	$date = $db->f_arr( $query );
	
	$date_utime = $eng->dateDiff( time(), $date['utime'] ); 
	if ( $date_utime == 'end' ){
		$thisdate_w = 'Срок действия вашего аккаунта истек';
	} else if ( $date_utime == 'few' ){
		$thisdate_w = 'У вас осталось пару секунд';
	} else {
		$thisdate_w = 'У вас осталось '.$date_utime;
	}
	
	if ( $date['utime'] == 0 ) {
		$mess .= '
		<div class="alert alert-success alert-dismissable">
			<i class="fa fa-check"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4>Уважаемый(ая) '.$date['name'].'!</h4>
			<b>Благодарим вас за добросовестное использование наших услуг и уважение к другим игрокам сервера !</b>
		</div>';
	} else if ( $date['utime'] < time() + 3600*24*3 ) {
		$mess .= '
		<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4>Уважаемый(ая) '.$date['name'].'!</h4>
			<b>'.$thisdate_w.'. Аккаунт автоматически приостановиться после окончания срока. Продлевайте услугу вовремя !</b>
		</div>';
	}

	$mess .= '
	<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4>Внимание !</h4>
		<b>Никому и не при каких условиях не сообщайте свой логин и пароль от кабинета! Администрация никогда не попросит у вас данные от кабинета!</b>
	</div>';
	
	if ( $_COOKIE['ad'] != 'stop' ) {
		echo $mess;
	}
?>