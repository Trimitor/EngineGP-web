	<p>
		<h3><a href="index.php?id=<?=$server_id?> " title="Назад на главную">Toп лучших игpoкoв </a> > Создание виджета</h3>
	</p>
	<div class="row">
		<div class="col-md-6"><p>
			<h4>Настройки</h4>
		</p>
		<form role="form" method="POST" action="?a=widget&id=<?=$server_id?>">
		  <div class="form-group">
			<label for="count">Количество <span style="font-size: 0.7em;color: #ACAC9D;">( <em>игроков</em> )</span></label>
			<input type="text" class="form-control" id="count" name="count" placeholder="Цифрой" value="<?=$count?>">
		  </div>
		  <div class="form-group">
			<label for="width">Ширина <span style="font-size: 0.7em;color: #ACAC9D;">( <em>px</em> )</span></label>
			<input type="text" class="form-control" id="width" name="width" placeholder="В пикселях" value="<?=$width?>">
		  </div>
		  <div class="form-group">
			<label for="height">Высота <span style="font-size: 0.7em;color: #ACAC9D;">( <em>px or 'auto'</em> )</span></label>
			<input type="text" class="form-control" id="height" name="height" placeholder="В пикселях" value="<?=$height?>">
		  </div>
		  <div class="form-group">
			<label for="color">Цветовая схема</label>
			<select name="color" id="color" class="form-control">
				<option value="default" selected>Стандартная</option>
			</select>
		  </div>
		  <button type="submit" class="btn btn-default">Сгенерировать</button>
		</form> <br />
		<p>
			<h4>Код для вставки <span style="font-size: 0.7em;color: #ACAC9D;">(Вставлять в нужное место)</span></h4>
	</p>
	<p>
		<textarea class="form-control" rows="3" readonly><?=htmlspecialchars($code)?></textarea>
	</p>
		</div>
		<div class="col-md-6"><p><h4>Результат</h4></p> 
		<!--AStats Widget--><script src="http://<?=$urlc?>js/widget.top.js"></script>
		<script>get_stats(<?=$count?>,<?=$width?>,'<?=$height?>',<?=$server_id?>,'<?=$urlc?>');</script>
		<div id="monitor"></div><!--/AStats Widget-->	
		</div>	
	</div>