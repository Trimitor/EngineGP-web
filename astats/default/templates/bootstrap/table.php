<h3>Игроки сервера</h3>
<div class="panel panel-default">
	<div class="panel-body notopbotpadding">
		<div class="row">
				<table class="table table-striped table-hover">
					<thead><tr>
						<th>#</th>
						<th>Имя</th>
						<th class="text-center">Убийства</th>
						<th class="text-center">Хэдшоты</th>
						<th class="text-center">Смерти</th>
						<th class="text-center">Точность</th>
					</tr></thead>
						<?php if($stats[$offset]): 
						for ($i = $offset; $i <= $stats->countPlayers(); $i++): $style = ($i%2===0) ? ' class="b"' : ''; $name = htmlentities($stats[$i]['nick']); ?>
							<tr<?php echo $style; ?>>
								<td style="padding-left: 7px;"><?php echo $i; ?></td>
								<td style="padding-left: 7px;"><a href="?a=stats&n=<?php echo $i?>&id=<?php echo $server_id; ?>" title="Full stats for this player"><strong><?php echo $name; ?></strong></a></td>
								<td style="padding-left: 7px;" class="text-center"><?php echo $stats[$i]['kills'];?></td>
								<td style="padding-left: 7px;" class="text-center"><?php echo $stats[$i]['headshots'];?></td>
								<td style="padding-left: 7px;" class="text-center"><?php echo $stats[$i]['deaths'];?></td>
								<td style="padding-left: 7px;" class="text-center"><?php echo ceil( 100 * $stats[$i]['hits'] / $stats[$i]['shots'] ) . '%';?></td></tr>
								<?php endfor; else: echo ' <td align="center" colspan="6"><strong>Статистики больше нет</strong></td> '; endif; ?>
						</table>
						
		</div>
	</div>
</div>
<div class="center-block"><?php echo pagination($stats->countPlayers(),15,10,$page,$server_id,'');?></div>