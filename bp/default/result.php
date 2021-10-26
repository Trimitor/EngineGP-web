<?php 
	define ( 'BLOCK', true );
	@require_once 'core/cfg.php';
	if ( $wmr_on == 0 ) exit ( "
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
	
	if ( $_POST['LMI_PREREQUEST'] == 1 ) 
	{
		$query_acc = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_temp_adm` WHERE `id` = '".abs( ( int ) $_POST['LMI_PAYMENT_NO'] )."' LIMIT 1" );
		$query_adm = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".abs( ( int ) $_POST['LMI_PAYMENT_NO'] )."' LIMIT 1" );
		
		if ( $db->n_rows( $query_acc ) > 0 )
		{
			$arr_acc = $db->f_arr( $query_acc );
			$query_tarif = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs`, `".$GLOBALS['db_prefix']."_tarif_time` WHERE `".$GLOBALS['db_prefix']."_tarif_time`.tarif_id = '".$arr_acc['service_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.server_id = '".$arr_acc['server_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.id = '".$arr_acc['service_id']."' AND `".$GLOBALS['db_prefix']."_tarif_time`.time = '".$arr_acc['utime']."' LIMIT 1" );
			$tarif_info = $db->f_arr( $query_tarif );
			
			if ( $tarif_info['price'] != abs( ( int ) $_POST['LMI_PAYMENT_AMOUNT'] ) ) 
			{
				echo 'Неверная сумма!';
				exit;
			}
		} else if ( $db->n_rows( $query_adm ) > 0 ) {
			$arr_adm = $db->f_arr( $query_adm );
			$query_tarif = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs`, `".$GLOBALS['db_prefix']."_tarif_time` WHERE `".$GLOBALS['db_prefix']."_tarif_time`.tarif_id = '".$arr_adm['service_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.server_id = '".$arr_adm['server_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.id = '".$arr_adm['service_id']."' AND `".$GLOBALS['db_prefix']."_tarif_time`.time = '".abs( ( int ) $_POST['time'] )."' LIMIT 1" );
			$tarif_info = $db->f_arr( $query_tarif );
			
			if ( $tarif_info['price'] != abs( ( int ) $_POST['LMI_PAYMENT_AMOUNT'] ) ) 
			{
				echo 'Неверная сумма!';
				exit;
			}
		} else {
			echo 'Заказ не найден! Повторите попытку!';
			exit();
		}
		
		if ( trim( $_POST['LMI_PAYEE_PURSE'] ) != $purse )
		{
			echo 'Неверный кошелек получателя!';
			exit;
		}
		
		echo 'YES';
	} else {
		$common_string = $_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].$_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].$_POST['LMI_SYS_TRANS_DATE'].$secret_key.$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM'];
		$hash = strtoupper( hash( "sha256", $common_string ) );
		if( $hash != $_POST['LMI_HASH'] ) exit;
		
		$query_adm = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".abs( ( int ) $_POST['LMI_PAYMENT_NO'] )."' LIMIT 1" );

		if ( $db->n_rows( $query_adm ) > 0 )
		{
			$arr_adm = $db->f_arr( $query_adm );
			$time = abs( ( int ) $_POST['time'] );
		
			if ( $time == 0 ) {
				$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = ('0') WHERE `id` = '".$arr_adm['id']."'" );
			} else {
				$date_con_a = time()+3600*24*$time;
				$date_con_b = 3600*24*$time;
				
				if ( $arr_adm['utime'] < time() ) {
					$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = ('".$date_con_a."') WHERE `id` = '".$arr_adm['id']."'" );
				} else {
					$db->m_query( "UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = (`utime`+'".$date_con_b."') WHERE `id` = '".$arr_adm['id']."'" );
				}
			}
			$eng->up_cfg ( $arr_adm['server_id'], $eng->g_cfg( $arr_adm['server_id'] ) );
		} else {
			$query_acc = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_temp_adm` WHERE `id` = '".abs( ( int ) $_POST['LMI_PAYMENT_NO'] )."' LIMIT 1" );
			$arr_acc = $db->f_arr( $query_acc );
			
			if ( $arr_acc['utime'] == 0 ) {
				$date_end = 0;
			} else {
				$date_end = time()+3600*24*$arr_acc['utime'];
			}
			
			$db->m_query( "INSERT INTO `".$GLOBALS['db_prefix']."_admins` (`id`, `auth`, `password`, `access`, `flags`, `servpass`, `name`, `skype`, `server_id`, `service_id`, `time`, `utime`, `hash`) VALUES (NULL, '".$arr_acc['auth']."', '".md5( sha1( $arr_acc['password'] ) )."', '".$arr_acc['access']."', '".$arr_acc['flags']."', '".$arr_acc['password']."', '', '', '".$arr_acc['server_id']."', '".$arr_acc['service_id']."', '".time()."', '".$date_end."', '".$at->GenerateKey()."')" );
			$eng->up_cfg ( $arr_acc['server_id'], $eng->g_cfg( $arr_acc['server_id'] ) );
		}
	}
?>