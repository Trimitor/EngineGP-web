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
	<div class="box box-warning">
		<!-- box-header -->
		<div class="box-header">
			<i class="fa fa-sort-amount-desc"></i>
			<h3 class="box-title">Последние покупатели</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<div class="box-body table-responsive no-padding">					
				<table class="table table-bordered table-hover">
					<thead style="color: #eeeeee; background-color: #4A4A4A;">
						<tr>
							<th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
							<th><i class="fa fa-user"></i> Игрок</th>
							<th><center><i class="fa fa-tasks"></i> Сервер</center></th>
							<th width="20%"><center><i class="fa fa-calendar"></i> Срок</center></th>
						</tr>
					</thead>
					<tbody>';
					
				$query = $db->m_query( "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` ORDER BY `id` DESC LIMIT 5" );
				if ( $db->n_rows( $query ) > 0 )
				{
					$num = 1;
					while ( $date = $db->f_arr( $query ) )
					{
						if ( $date['utime'] == 0 ) {
							$thisdate = '<span class="label label-success" data-toggle="tooltip" data-placement="left" data-original-title="Навсегда">Навсегда</span>';
						} else {
							$date_utime = $eng->dateDiff( time(), $date['utime'] );
							if ( $date_utime == 'end' ) {
								$thisdate = '<span class="label label-danger" data-toggle="tooltip" data-placement="left" data-original-title="Срок истек">Срок истек</span>';
							} else if ( $date_utime == 'few' ) {
								$thisdate = '<span class="label label-danger" data-toggle="tooltip" data-placement="left" data-original-title="Пару секунд">Пару секунд</span>';
							} else {
								$thisdate = '<span class="label label-danger" data-toggle="tooltip" data-placement="left" data-original-title="'.$date_utime.'">'.$date_utime.'</span>';
							}
						}
						
						$add_tr = ( $date['utime'] != 0 && $date['utime'] < time() ) ? 'class="danger"' : '';
						$auth = ( strlen( $date['auth'] ) > 15 ) ? substr( $date['auth'], 0, 13 ).'...' : $date['auth'];
						$server = ( mb_strlen( $at->serv_info( $date['server_id'] ) ) > 19 ) ? mb_substr( $at->serv_info( $date['server_id'] ), 0, 17, 'UTF-8' ).'...' : $at->serv_info( $date['server_id'] );
						
						echo '
						<tr '.$add_tr.'>
							<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$num.'</b></center></td>
							<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['auth'].'">'.$auth.'</b></td>
							<td><center><b data-toggle="tooltip" data-placement="right" data-original-title="'.$at->serv_info( $date['server_id'] ).'">'.$server.'</b></center></td>
							<td><center>'.$thisdate.'</center></td>
						</tr>';
						$num++;
					}
				} else {
					echo '
					<tr>
						<td colspan="4"><b>Список администрации пуст!</b></td>
					</tr>';
				}
			echo '</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box-body -->
	</div><!-- /.box -->';
?>