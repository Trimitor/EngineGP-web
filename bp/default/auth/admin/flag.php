<?php
	define ( 'BLOCK', true );
	@require_once '../../core/cfg.php';
	
	$id = abs( ( int ) $_POST['id'] );
	
	if ( $id == 1 ) {
		$query_tarif = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_tarifs` WHERE `id` = '".abs( ( int ) $_POST['tarif'] )."' AND `server_id` = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );
		$tarif = $db->f_arr( $query_tarif );
		echo $tarif['access'];
	} else {
		echo ''; 
	}
?>