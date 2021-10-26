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
	<div class="box box-primary">
		<div class="box-header">
			<i class="fa fa-list"></i>
			<h3 class="box-title">Список Админов | V.I.P</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-placement="left" data-original-title="Скрыть"><i class="fa fa-minus"></i></button>
				<button class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Убрать"><i class="fa fa-times"></i></button>
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
			<div class="box-body table-responsive no-padding">
				<div style="height: 325px;">
				<table class="table table-bordered table-hover">
					<thead style="color: #eeeeee; background-color: #4A4A4A;">
						<tr>
							<th width="1%"><center><i class="fa fa-arrow-down"></i></center></th>
							<th width="15%"><i class="fa fa-male"></i> Имя</th>
							<th><i class="fa fa-user"></i> Игрок</th>
							<th><i class="fa fa-skype"></i> Skype</th>
						</tr>
					</thead>
					<tbody>';
				$pagination = $eng->pagination( array( "query" => "SELECT * FROM `".$GLOBALS['db_prefix']."_admins` ORDER BY `utime` = '0' DESC, `utime` DESC", "page_num" => 5, "url" => $url."auth" ) );
				$query = $db->m_query( $pagination['query'] );

				if ( $db->n_rows( $query ) > 0 )
				{
					$i = $pagination['count'];
					while ( $date = $db->f_arr( $query ) )
					{
						++$i;
						$auth = ( strlen( $date['auth'] ) > 24 ) ? substr( $date['auth'], 0, 21 ).'...' : $date['auth'];
						$skype_user = ( strlen( $date['skype'] ) > 24 ) ? substr( $date['skype'], 0, 21 ).'...' : ( ( $date['skype'] != NULL ) ? $date['skype'] : 'Неизвестно' );
						$name = ( $date['name'] != NULL ) ? $date['name'] : 'Неизвестно';

						echo '
						<tr>
							<td style="color: #eeeeee; background-color: #4A4A4A;"><center><b>'.$i.'</b></center></td>
							<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$name.'">'.$name.'</b></td>
							<td><b data-toggle="tooltip" data-placement="right" data-original-title="'.$date['auth'].'">'.$auth.'</b></td>
							<td><b data-toggle="tooltip" data-placement="left" data-original-title="'.$date['skype'].'"><a href="skype:'.$date['skype'].'?userinfo">'.$skype_user.'</a></b></td>
						</tr>';
					}
					echo '
					</tbody>
				</table><center>'.$pagination['pages'].'</center>';
					
				} else {
					echo '
						<tr>
							<td colspan="4"><b>Список администрации пуст!</b></td>
						</tr>
						</tbody>
					</table>';
				}
				echo '
			</div>
		</div>
	</div>
	</div>';
?>