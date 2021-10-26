<?php
	define ( 'BLOCK', true );
	@require_once "core/cfg.php";
	
	$id = abs( ( int ) $_POST['id'] );
	
	if ( $id == 1 ) {
		$server = abs( ( int ) $_POST['server'] );
		echo $eng->tarifs( $server );
	} else if ( $id == 2 ) {
		$tarif_time = abs( ( int ) $_POST['tarif_time'] );
		echo $eng->tarifs_time( $tarif_time );
	} else if ( $id == 3 ) {
		$query_server = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_servers` WHERE `id` = '".abs( ( int ) $_POST['server'] )."' LIMIT 1" );
		
		if ( $db->n_rows( $query_server ) > 0 )
		{
			$server_info = $db->f_arr( $query_server );
			$data = $eng->serverInfo( $server_info['address'] );
			
			if ( $data['status'] == 1 ) {
				$file = 'http://image.www.gametracker.com/images/maps/160x120/cs/'.$data['mapname'].'.jpg';
				$file_headers = @get_headers( $file );
				$map = ( $file_headers[0] == 'HTTP/1.0 404 Not Found' ) ? 'http://image.www.gametracker.com/images/maps/160x120/nomap.jpg' : 'http://image.www.gametracker.com/images/maps/160x120/cs/'.$data['mapname'].'.jpg';
				$status = '<i class="fa fa-circle text-success" alt="Включен" title="Включен"></i>';
			} else {
				$status = '<i class="fa fa-circle text-danger" alt="Отключен" title="Отключен"></i>';
				$map = 'http://image.www.gametracker.com/images/maps/160x120/nomap.jpg';
			}

			echo '
			<div class="callout callout-danger">
				<h4>'.$data['hostname'].'</h4>
				<div class="row">
					<div class="col-md-3">
						<a target="_blank" href="https://www.google.com.ua/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q='.$data['mapname'].'"><img src="'.$map.'" style="width: 150px; height: 105px;" alt="Карта сервера" class="img-thumbnail"></a>
					</div>
					<div class="col-md-9">
					<b><i class="fa fa-power-off" style="width: 15px;"></i> Статус:</b> '.$status.' <br />
					<b><i class="fa fa-location-arrow" style="width: 15px;"></i> Адрес:</b> '.$server_info['address'].' <br />
					<b><i class="fa fa-users" style="width: 15px;"></i> Игроки:</b> '.$data['players'].'/'.$data['maxplayers'].' <br />
					<b><i class="fa fa-map-marker" style="width: 15px;"></i> Карта:</b> '.$data['mapname'].' <br />
					<a class="btn btn-danger btn-xs" href="steam://connect/'.$server_info['address'].'"><b>Быстрое подключение</b></a>
					</div>
				</div>
			</div>';
		}
	} else {
		echo ''; 
	}
?>