	<h3>
		<a href="index.php?id=<?=$server_id?> " title="Назад на главную">Игроки сервера </a> > Статистика: <?=$name?>
	</h3>
	<div style="width:50px;height:50px;">
      <p style="margin:0 0 0 20px;"></p>
    </div>
	<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
			<div class="col-md-6">
		<table class="table table-striped">
		  <tbody>
			<tr>
			  <td>
				<center>
				  <strong>
					Убитo
				  </strong>
				</center>
			  </td>
			  <td>
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
			  <td>
				<center>
				  <strong>
					Смертей
				  </strong>
				</center>
			  </td>
			  <td>
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
			  <td>
				<center>
				  <strong>
					Выстрелов
				  </strong>
				</center>
			  </td>
			  <td>
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
			  <td>
				<center>
				  <strong>
					Точность
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=ceil(($hits/$shots)*100)?>%
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Установлено бомб
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$plants?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Взорвано бомб
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$explosions?>
				</center>
			  </td>
			</tr>
			<tr>
			  <td>
				<center>
				  <strong>
					Разминировано бомб
				  </strong>
				</center>
			  </td>
			  <td>
				<center>
				  <?=$defused?>
				</center>
			  </td>
			</tr>
		  </tbody>
		</table>
	  </div>
	  <div class="col-md-6 text-center">
		<div class="popover top" style="display: block; margin: 0 auto; position: relative; margin-bottom: 10px; width: 150px">
            <div class="arrow" style="left: 60px"></div>
            <h3 class="popover-title text-center">Голова: <?=$head?></h3>
        </div>
        <div class="popover top" style="display: block; top: 80px; left: 225px">
            <div class="arrow"></div>
            <h3 class="popover-title text-center">Грудь: <?=$chest?></h3>
        </div>
        <div class="popover bottom" style="display: block; top: 140px; left: 225px">
            <div class="arrow"></div>
            <h3 class="popover-title text-center">Живот: <?=$stomach?></h3>
        </div>
        <img src="/image/soldier.png">
        <div class="popover left" style="display: block; top: 120px; left: 75px">
            <div class="arrow"></div>
            <h3 class="popover-title">Левая рука: <?=$leftarm?></h3>
        </div>
        <div class="popover left" style="display: block; top: 270px; left: 100px">
            <div class="arrow"></div>
            <h3 class="popover-title">Левая нога: <?=$leftleg?></h3>
        </div>
        <div class="popover right" style="display: block; top: 120px; left: 330px">
            <div class="arrow"></div>
            <h3 class="popover-title">Правая рука: <?=$rightarm?></h3>
        </div>
        <div class="popover right" style="display: block; top: 270px; left: 320px">
            <div class="arrow"></div>
            <h3 class="popover-title">Правая нога: <?=$rightleg?></h3>
        </div>
	  </div>


		</div>
    </div>

</div>
	  