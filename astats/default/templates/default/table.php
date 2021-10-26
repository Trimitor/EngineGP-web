	<p>
		<h3>Toп лучших игpoкoв</h3>
	</p>
		<table cellspacing="0" class="q">
			<tr>
				<th>#</th>
				<th>Имя</th>
				<th>Убитo</th>
				<th>В голову</th>
				<th>Смертей</th>
				<th>Урон</th>
			</tr>
				<?php if($stats[$offset]): 
				for ($i = $offset; $i <= $stats->countPlayers(); $i++): $style = ($i%2===0) ? ' class="b"' : ''; $name = htmlentities($stats[$i]['nick']); ?>
					<tr<?php echo $style; ?>>
						<td style="padding-left: 7px;"><?php echo $i; ?></td>
						<td style="padding-left: 7px;"><a href="?a=stats&n=<?php echo $i?>&id=<?php echo $server_id; ?>" title="Full stats for this player"><strong><?php echo $name; ?></strong></a></td>
						<td style="padding-left: 7px;"><?php echo $stats[$i]['kills'];?></td>
						<td style="padding-left: 7px;"><?php echo $stats[$i]['headshots'];?></td>
						<td style="padding-left: 7px;"><?php echo $stats[$i]['deaths'];?></td>
						<td style="padding-left: 7px;"><?php echo $stats[$i]['damage'];?></td></tr>
						<?php endfor; else: echo ' <td align="center" colspan="6"><strong>Статистики больше нет</strong></td> '; endif; ?>
				</table>
				<div class="pagin"><?php echo pagination($stats->countPlayers(),15,5,$page,$server_id,'', 'pages', '<strong>Страница:</strong>'); ?></div>