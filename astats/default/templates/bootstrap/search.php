	<p>
		<h3><a href="index.php?id=<?=$server_id?> " title="Назад на главную">Toп лучших игpoкoв </a> > Результаты поиска: <?=count($stats)?> совпадений</h3>
	</p>
	<center>
		<table cellspacing="0" class="table table-striped table-hover">
			<thead><tr>
				<th>#</th>
				<th>Имя</th>
				<th>Убитo</th>
				<th>В голову</th>
				<th>Смертей</th>
				<th>Урон</th>
			</tr></thead><tbody>
				<?php if($stats[0]){ 
				for ($i = 0; $i< count($stats); $i++){ $style =""; if($i%2===0) $style=' class="b"'; $name = htmlentities($stats[$i]['nick']); ?>
					<tr<?=$style?>>
						<td style="padding-left: 7px;"><?=$stats[$i]['rank']?></td>
						<td style="padding-left: 7px;"><a href="?a=stats&n=<?=$stats[$i]['rank']?>&id=<?=$server_id?>" title="Full stats for this player"><strong><?=$name?></strong></a></td>
						<td style="padding-left: 7px;"><?=$stats[$i]['kills']?></td>
						<td style="padding-left: 7px;"><?=$stats[$i]['headshots']?></td>
						<td style="padding-left: 7px;"><?=$stats[$i]['deaths']?></td>
						<td style="padding-left: 7px;"><?=$stats[$i]['damage']?></td></tr>
						<?php
						}	}else{
							echo ' <td align="center" colspan="6"><strong>Ничего не найдено</strong></td> ';
						}					?>
				</tbody></table><br />
				