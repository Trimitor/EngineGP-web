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
	
	echo '
	<div class="box box-info">
		<br />
		<div class="box-body">
			<div class="callout callout-info">
				<p><b>Сортировка происходит по окончанию срока услуги. Продлить срок вы можете в <a href="'.$url.'auth/login.php">Кабинете.</a></b></p>
			</div>
			<div class="alert alert-success alert-dismissable">
			<i class="fa fa-check"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<b>Здесь отображены те пользователи, которые уже приобрели наши услуги !</b>
			</div>
			<div class="box-body table-responsive no-padding">					
				<table class="table table-bordered table-hover">
					<thead style="color: #eeeeee; background-color: #4A4A4A;">
						<tr>
							<th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
							<th width="10%"><i class="fa fa-male"></i> Имя</th>
							<th><i class="glyphicon glyphicon-user"></i> Игрок</th>
							<th><center><i class="fa fa-tasks"></i> Сервер</center></th>
							<th width="12%"><center><i class="fa fa-shopping-cart"></i> Услуга</center></th>
							<th width="12%"><center><i class="fa fa-plus"></i> Добавлен</center></th>
							<th width="20%"><center><i class="fa fa-calendar"></i> Срок</center></th>
						</tr>
					</thead>
					<tbody>';
					
			$pagination = $eng->pagination( array( "query" => "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` ORDER BY `utime` = '0' DESC, `utime` DESC", "page_num" => $num_page, "url" => $url."list" ) );
			$query = $db->m_query( $pagination['query'] );
			if ( $db->n_rows( $query ) > 0 )
			{
				$i = $pagination['count'];
				while ( $date = $db->f_arr( $query ) )
				{
					$i++;
					if ( $date['utime'] == 0 ) {
						$thisdate = '<span class="label label-success" data-toggle="tooltip" data-placement="left" data-original-title="Навсегда">Навсегда</span>';
					} else {
						$date_utime = $eng->dateDiff( time(), $date['utime'] );
						if ( $date_utime == 'end' ) {
							$thisdate = '<span class="label label-primary" data-toggle="tooltip" data-placement="left" data-original-title="Срок истек">Срок истек</span>';
						} else if ( $date_utime == 'few' ) {
							$thisdate = '<span class="label label-danger" data-toggle="tooltip" data-placement="left" data-original-title="Пару секунд">Пару секунд</span>';
						} else {
							$thisdate = '<span class="label label-danger" data-toggle="tooltip" data-placement="left" data-original-title="'.$date_utime.'">'.$date_utime.'</span>';
						}
					}
					
					$add_tr = ( $date['utime'] != 0 && $date['utime'] < time() ) ? 'class="danger"' : '';
					$name = ( $date['name'] != NULL ) ? $date['name'] : 'Неизвестно';
					
					echo '
					<tr '.$add_tr.'>
						<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$i.'</b></center></td>
						<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$name.'">'.$name.'</b></td>
						<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['auth'].'">'.$date['auth'].'</b></td>
						<td><center><b data-toggle="tooltip" data-placement="right" data-original-title="'.$at->serv_info( $date['server_id'] ).'">'.$at->serv_info( $date['server_id'] ).'</b></center></td>
						<td><center><b data-toggle="tooltip" data-placement="right" data-original-title="'.$at->tarif_info( $date['service_id'] ).'">'.$at->tarif_info( $date['service_id'] ).'</b></center></td>
						<td><center><span data-toggle="tooltip" data-placement="right" data-original-title="'.date('d.m.Y [H:i]', $date['time']).'" class="label label-warning">'.date('d.m.Y [H:i]', $date['time']).'</span></center></td>
						<td><center>'.$thisdate.'</center></td>
					</tr>';
				}
				echo '</tbody>
				</table><center>'.$pagination['pages'].'</center>';
			} else {
				echo '
				<tr>
					<td colspan="7"><b>Список администрации пуст!</b></td>
				</tr></tbody>
				</table>';
			}
	echo '</div><!-- /.box-body -->
		</div><!-- /.box-body -->
	</div><!-- /.box -->';
?>