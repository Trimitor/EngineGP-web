	<p>
	  <h3>
		<a href="index.php?id=<?=$server_id?> " title="Назад на главную">Toп лучших игpoкoв </a> > Статистика: <?=$name?>
	  </h3>
	</p>
	<div class="row">
	  <div class="col-md-4">
		<table class="q" style="width: 100%">
		  <thead>
			<tr>
			  <th colspan="2">
				<center>
				  Основная статистика
				</center>
			  </th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Убитo
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$kills?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					В голову
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$head?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Смертей
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$deaths?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Урон
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$damage?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Выстрелов
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$shots?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Попаданий
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$hits?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Точность
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=ceil(($hits/$shots)*100)?>
				  %
				</center>
			  </td>
			</tr>
		  </tbody>
		</table>
	  </div>
	  <div class="col-md-4">
		<table class="q" style="width: 100%">
		  <thead>
			<tr>
			  <th>
				<center>
				  Часть тела
				</center>
			  </th>
			  <th>
				<center>
				  Попаданий
				</center>
			  </th>
			  <th>
				<center>
				  Меткость
				</center>
			  </th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Голова
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$head?>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=ceil(($head/$hits)*100)?>%
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Плечи
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$chest?>
				</center>
			  </td>
			  <td>
				<center>
				  <?=ceil(($chest/$hits)*100)?>%
				</center>
			  </td>
			</tr>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Живот
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$stomach?>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=ceil(($stomach/$hits)*100)?>%
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Левая рука
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$leftarm?>
				</center>
			  </td>
			  <td>
				<center>
				  <?=ceil(($leftarm/$hits)*100)?>%
				</center>
			  </td>
			</tr>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Правая рука
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$rightarm?>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=ceil(($rightarm/$hits)*100)?>%
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Левая нога
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$leftleg?>
				</center>
			  </td>
			  <td>
				<center>
				  <?=ceil(($leftleg/$hits)*100)?>%
				</center>
			  </td>
			</tr>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Правая нога
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$rightleg?>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=ceil(($rightleg/$hits)*100)?>%
				</center>
			  </td>
			</tr>
		  </tbody>
		</table>
	  </div>
	  <div class="col-md-4">
		<table class="q" style="width: 100%">
		  <thead>
			<tr>
			  <th colspan="2">
				<center>
				  Статистика взрывов/обезвреживания
				</center>
			  </th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Обезвреживаний
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$defusions?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Обезврежено
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$defused?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td class="b">
				<center>
				  <strong>
					Установок бомб
				  </strong>
				</center>
			  </td>
			  <td class="b">
				<center>
				  <?=$plants?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Взорвано
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$explosions?>
				</center>
			  </td>
			</tr>
		  </tbody>
		</table>
	  </div>
	</div>

	<script type="text/javascript">
		google.load("visualization", "1", {
			packages:["corechart"]
		});
	  google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable([
		  ['Часть тела', 'Попаданий'],
		  ['Голова',     <?=$head?>],
		   ['Плечи',      <?=$chest?>],
			['Живот',  <?=$stomach?>],
			 ['Левая рука', <?=$leftarm?>],
			  ['Правая рука',    <?=$rightarm?>],
			   ['Правая нога',    <?=$leftleg?>],
				['Правая нога',    <?=$rightleg?>]
				]);
				
				var options = {
					title: 'График попаданий',
					backgroundColor: {
						fill:'#4c5844', 
						stroke: '#889180', 
						strokeWidth: 1
					},
					colors: ['#b0a248', '#9c9040', '#897e38', '#756c30', '#625a28', "#4e4820", "#3a3618"],
					titleTextStyle: {
						color: '#c4b550', 
						fontSize: "12"
					},
					legend: {
						position: 'none'
					},
					is3D: true,
			   };
			   
			   var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			   chart.draw(data, options);
	}
	</script>
	<br />
	<div class="row">
	  <div class="col-md-4">
		<div id="piechart" style="width: 100%; height: 340px;">
		</div>
	  </div>
	</div>