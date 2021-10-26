	<p>
	  <h3>
		Сервер: <?php echo $server_info['HostName']?>
	  </h3>
	<div style="display: inline;" class="pull-right dropdown">
 <form action="" method="get"><input type="hidden" name="a" value="search"><input type="hidden" name="id" value="<?php echo $server_id?>"><input class="search" placeholder="Поиск" type="text" name="name" id="name" autocomplete="off"/></form>
	<form action="" method="get">
		<select name="id" onchange="this.form.submit()" autocomplete="off">
			 <?php
				foreach($server as $key => $value) {
				$select = ($key == $server_id) ? "selected" : "";
				echo '<option '.$select.' value="'.$key.'">
				'.get_server_info($value['ip'],$value['port'],$value['engine'], true).'
				</option>
				';}
			?>
		</select>
	  </form>
	
	
	</div>
	</p>
	<table class="q"  style="width: 30%">
	  <tr>
		<td rowspan="3" style="width: 70px">
			<img src="<?php echo get_map_image($server_info['Map'])?>" style="height: 65px" />
		</td>
		<td>
			<?php echo $server_info['Address']?>
		</td>
	  </tr>
	  <tr>
		<td class="b">
		  <?php echo $server_info['Map']?>
		</td>
	  </tr>
	  <tr>
		<td>
		  <?php echo $server_info['Players']?>
		  / 
		  <?php echo $server_info['MaxPlayers']?>
		</td>
	  </tr>
	</table>