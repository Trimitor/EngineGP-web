<?php 
	define ( 'BLOCK', true );
	@require_once '../core/cfg.php';

	$query_adm = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".abs( ( int ) $_POST['user_id'] )."' LIMIT 1" );
	$arr_adm = $db->f_arr( $query_adm );
	
	$query_tarif = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs`, `".$GLOBALS['db_prefix']."_tarif_time` WHERE `".$GLOBALS['db_prefix']."_tarif_time`.tarif_id = '".$arr_adm['service_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.server_id = '".$arr_adm['server_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.id = '".$arr_adm['service_id']."' AND `".$GLOBALS['db_prefix']."_tarif_time`.time = '".abs( ( int ) $_POST['time'] )."' LIMIT 1" );
	$tarif_info = $db->f_arr( $query_tarif );
	
	if ( $db->n_rows( $query_adm ) > 0 )
	{
		if ( $arr_adm['utime'] == 0 )
		{
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$url."auth/?error=1");
			exit();
		}
	} else {
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$url."auth/?error=2");
		exit();
	}
	
	if ( $db->n_rows( $query_tarif ) == 0 )
	{
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$url."auth/?error=3");
		exit();
	}
	
	if ( ! in_array( trim( $_POST['how'] ), array( "1", "2", "3" ) ) ) {
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$url."auth/?error=4");
		exit();
	}
	
	$time = abs( ( int ) $_POST['time'] );
	$server = $at->serv_info( $arr_adm['server_id'] );
	$tarif = $at->tarif_info( $arr_adm['service_id'] );

	if ( $time == 0 ) $date_tarif = 'сроком Навсегда.';
	else $date_tarif = 'сроком на '.$time.' Дн.';
	
	$desc = 'Продление услуги '.$tarif.' на сервере '.$server.', '.$date_tarif.'';
	
	echo '
	<html> 
	<head>
		<title>Переадресация на сайт платёжной системы...</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="Content-Language" content="ru">
		<meta http-equiv="Pragma" content="no-cache">
		<meta name="robots" content="noindex,nofollow">
	</head>
	<body>';
		if ( trim( $_POST['how'] ) == 1 && $wmr_on == 1 )
		{
			echo '
			<form name="oplata" method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp">
			<input type="hidden" name="LMI_PAYMENT_NO" value="'.abs( ( int ) $_POST['user_id'] ).'" />
			<input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="'.base64_encode( $desc ).'" />
			<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="'.$tarif_info['price'].'" />
			<input type="hidden" name="LMI_PAYEE_PURSE" value="'.$purse.'" />
			<input type="hidden" name="time" value="'.$time.'">';
		} else if ( trim( $_POST['how'] ) == 2 && $uni_on == 1 ){
			echo '
			<form name="oplata" method="GET" action="https://unitpay.ru/pay/'.$uni_purse.'">
			<input type="hidden" name="account" value="'.abs( ( int ) $_POST['user_id'] ).'" />
			<input type="hidden" name="desc" value="'.$desc.'" />
			<input type="hidden" name="sum" value="'.$tarif_info['price'].'" />
			<input type="hidden" name="time" value="'.$time.'">';
		} else if ( trim( $_POST['how'] ) == 3 && $robo_on == 1 ){
			$id_acc = rand(999, 999999);
			$signature = md5("".$robo_login.":".$tarif_info['price'].":".$id_acc.":".$robo_pass1.":shp_id=".abs( ( int ) $_POST['user_id'] ).":shp_t=".$time."");
			
			echo '
			<form name="oplata" method="POST" action="https://auth.robokassa.ru/Merchant/Index.aspx">
			<input type="hidden" name="MrchLogin" value="'.$robo_login.'" />
			<input type="hidden" name="OutSum" value="'.$tarif_info['price'].'" />
			<input type="hidden" name="InvId" value="'.$id_acc.'" />
			<input type="hidden" name="Desc" value="'.$desc.'" />
			<input type="hidden" name="SignatureValue" value="'.$signature.'" />
			<input type="hidden" name="Culture" value="ru" />
			<input type="hidden" name="Encoding" value="utf-8" />
			<input type="hidden" name="shp_id" value="'.abs( ( int ) $_POST['user_id'] ).'" />
			<input type="hidden" name="shp_t" value="'.$time.'" />';
		} else {
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$url."auth/?error=4");
			exit();
		}
		echo '
			<noscript><input type="submit" value="Нажмите, если не хотите ждать!" onclick="document.oplata.submit();"></noscript>
		</form>
		<script language="Javascript" type="text/javascript">
			document.oplata.submit();
		</script>
	</body>
	</html>';
?>