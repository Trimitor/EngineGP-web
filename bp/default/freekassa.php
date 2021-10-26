<?php 
	DEFINE('BLOCK', true);
	@require_once 'core/cfg.php';

	if($robo_on == 0)
		header('Location: /404');

	if(!isset($_POST['SignatureValue']))
		header('Location: /404');

	$sum = $_POST['OutSum'];
	$order = $_POST['InvId'];
	$sign = $_POST['SignatureValue'];
	$term = $_POST['Term'];

	$signature = md5($sum.':'.$order.':'.$robo_pass2);

	if($signature != $sign)
		exit('Неправильная подпись');

	$query_acc = $db->m_query("SELECT * FROM `".$GLOBALS['db_prefix']."_temp_adm` WHERE `id` = '".abs((int) $order)."' LIMIT 1");
	$query_adm = $db->m_query("SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".abs((int) $order)."' LIMIT 1");
	
	if($db->n_rows($query_acc) > 0)
	{
		$arr_acc = $db->f_arr($query_acc);
		$query_tarif = $db->m_query("SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs`, `".$GLOBALS['db_prefix']."_tarif_time` WHERE `".$GLOBALS['db_prefix']."_tarif_time`.tarif_id = '".$arr_acc['service_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.server_id = '".$arr_acc['server_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.id = '".$arr_acc['service_id']."' AND `".$GLOBALS['db_prefix']."_tarif_time`.time = '".$arr_acc['utime']."' LIMIT 1");
		$tarif_info = $db->f_arr($query_tarif);
			
		if($tarif_info['price'] != abs((int) $sum))
			exit('Неверная сумма');

	} else if($db->n_rows($query_adm) > 0) {
		$arr_adm = $db->f_arr($query_adm);
		$query_tarif = $db->m_query("SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs`, `".$GLOBALS['db_prefix']."_tarif_time` WHERE `".$GLOBALS['db_prefix']."_tarif_time`.tarif_id = '".$arr_adm['service_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.server_id = '".$arr_adm['server_id']."' AND `".$GLOBALS['db_prefix']."_tarifs`.id = '".$arr_adm['service_id']."' AND `".$GLOBALS['db_prefix']."_tarif_time`.time = '".abs((int) $order)."' LIMIT 1");
		$tarif_info = $db->f_arr($query_tarif);
		
		if($tarif_info['price'] != abs((int) $sum))
			exit('Неверная сумма');

	} else
		exit('Заказ не найден. Повторите попытку!');

	echo "OK$order\n";
	
	$query_adm = $db->m_query("SELECT * FROM `".$GLOBALS['db_prefix']."_admins` WHERE `id` = '".abs((int) $order)."' LIMIT 1");

	if($db->n_rows($query_adm) > 0)
	{
		$arr_adm = $db->f_arr($query_adm);
		$time = abs((int) $term);
	
		if($time == 0)
			$db->m_query("UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = ('0') WHERE `id` = '".$arr_adm['id']."'");
		else {
			$date_con_a = time()+3600*24*$time;
			$date_con_b = 3600*24*$time;
			
			if($arr_adm['utime'] < time())
				$db->m_query("UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = ('".$date_con_a."') WHERE `id` = '".$arr_adm['id']."'");
			else
				$db->m_query("UPDATE `".$GLOBALS['db_prefix']."_admins` SET `utime` = (`utime`+'".$date_con_b."') WHERE `id` = '".$arr_adm['id']."'");
		}
		$eng->up_cfg($arr_adm['server_id'], $eng->g_cfg($arr_adm['server_id']));
	} else {
		$query_acc = $db->m_query("SELECT * FROM `".$GLOBALS['db_prefix']."_temp_adm` WHERE `id` = '".abs((int) $order)."' LIMIT 1");
		$arr_acc = $db->f_arr($query_acc);
		
		if($arr_acc['utime'] == 0)
			$date_end = 0;
		else
			$date_end = time()+3600*24*$arr_acc['utime'];
		
		$db->m_query("INSERT INTO `".$GLOBALS['db_prefix']."_admins` (`id`, `auth`, `password`, `access`, `flags`, `servpass`, `name`, `skype`, `server_id`, `service_id`, `time`, `utime`, `hash`) VALUES (NULL, '".$arr_acc['auth']."', '".md5(sha1($arr_acc['password']))."', '".$arr_acc['access']."', '".$arr_acc['flags']."', '".$arr_acc['password']."', '', '', '".$arr_acc['server_id']."', '".$arr_acc['service_id']."', '".time()."', '".$date_end."', '".$at->GenerateKey()."')");
		$eng->up_cfg($arr_acc['server_id'], $eng->g_cfg($arr_acc['server_id']));
	}
?>