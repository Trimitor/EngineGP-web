<div class="row mt20">
	<div style="width:auto;" class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-body notopbotpadding">
		<h3 class="mt10"><?php echo $server_info['HostName']?></h3>
		<table class="table mt10">
		  <tr>
			<td rowspan="3" style="width: 70px">
				<img src="<?php echo get_map_image($server_info['Map'])?>" style="height: 95px;" class="img-rounded" />
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
		</div>
	</div>	
	</div>
	<div class="col-md-4 pull-right">
	 <form action="" method="get"><input type="hidden"  name="a" value="search"><input type="hidden" name="id" value="<?php echo $server_id?>"><input class="form-control" placeholder="Поиск" type="text" name="name" id="name" autocomplete="off"/></form>
		<form action="" method="get">
			<select class="form-control" style="margin-top: 5px;" name="id" onchange="this.form.submit()" autocomplete="off">
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
</div>