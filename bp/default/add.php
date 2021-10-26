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
	
	if ( ! empty( $_GET['error'] ) )
	{
		$id = abs( ( int ) $_GET['error'] );
		
		if ( $id > 0 && $id <= 9 ) {
			$error_mess = array(
				1 => '<center><strong>Игрок уже зарегистрирован на данном сервере!</strong></center>',
				2 => '<center><strong>Не выбран сервер!</strong></center>',
				3 => '<center><strong>Не выбрана услуга или срок!</strong></center>',
				4 => '<center><strong>"Ник" не указан или указан неверно!</strong></center>', 
				5 => '<center><strong>"Steam ID/IP" не указан или указан неверно!</strong></center>',
				6 => '<center><strong>Не выбран тип авторизации!</strong></center>',
				7 => '<center><strong>Данный ник использовать нельзя!</strong></center>',
				8 => '<center><strong>В пароле могут быть только английские буквы и цифры, а также его длина должна быть от 6 до 32 символа!</strong></center>',
				9 => '<center><strong>Платежная система не найдена!</strong></center>'
			);
			$error = "$('#mess').jGrowl('".$error_mess[$id]."', { life: 5000 });";
		}
	}
	
	$wmr = ( $wmr_on == 1 ) ? '<option value="1" selected="selected">Webmoney</option>' : '';
	$uni = ( $uni_on == 1 ) ? '<option value="2">Unitpay ( SMS, VISA, QIWI, ЯД, WebMoney )</option>' : '';
	$rob = ( $robo_on == 1 ) ? '<option value="3">Free-Kassa (Киви,СМС,Яндекс Деньги,Банк.Карта, И Другие Способы)</option>' : '';
	
	echo '
	<script type="text/javascript">
		$(function() {
			tarif_list();
			time_list();
			'.$error.'
			
			$("#tarif_list").click(function(){
				var tarif = $( "#tarif" ).val();
				$.ajax({
					type: "POST",
					url: "'.$url.'service.php",
					data: "id=4&tarif="+tarif,
					success: function(data){
						$("#tarif_info").html(data);
					}
				});
			});
		});
		
		function tarif_list()
		{
			var server = $( "#server" ).val();
			$.ajax({
				type: "POST",
				url: "'.$url.'service.php",
				data: "id=1&server="+server,
				success: function(data){
					$("#tarif_list").html(data);
				}
			});
		}
		
		function time_list()
		{
			var tarif_time = $( "#tarif" ).val();
			$.ajax({
				type: "POST",
				url: "'.$url.'service.php",
				data: "id=2&tarif_time="+tarif_time,
				success: function(data){
					$("#tarif_list_time").html(data);
				}
			});
		}
		
		function sel_server()
		{
			var server = $( "#server" ).val();
			$.ajax({
				type: "POST",
				url: "'.$url.'service.php",
				data: "id=3&server="+server,
				success: function(data){
					$("#selected_server").html(data);
				}
			});
		}
		
		function changetype(name)
		{
			if (name=="a")
			{
				$("#login_annotation").html("Ник");
				$("#auth").attr("placeholder", "Ник");
			} else if (name=="ca") {
				$("#login_annotation").html("SteamID");
				$("#auth").attr("placeholder", "STEAM_0:0:123456789");
			} else if (name=="de") {
				$("#login_annotation").html("IP - Адрес");
				$("#auth").attr("placeholder", "127.0.0.1");
				$("#auth").attr("value", "'.$_SERVER["REMOTE_ADDR"].'");
			}
		}
	</script>
	<!-- general form elements -->
	<div class="box box-info">
		<!-- box-header -->
		<div class="box-header">
			<i class="fa fa-shopping-cart text-red"></i>
			<h3 class="box-title">Форма покупки привилегии</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		';
	
		$jsonTime = json_decode(file_get_contents(''.$url.'auth/admin/timer.json'), true);
		echo ($jsonTime['on'] == 'true') ? $jsonTime['title'] : '';
		echo ($jsonTime['on'] == 'true') ? $jsonTime['code'] : '';
		echo '
		<div class="box-body">						
			<form role="form" action="pay.php" method="POST" autocomplete="off">
				<div class="form-group">
									<i class="fa fa-smile-o text-red"></i> <label>ТИП ПРОПИСИ:</label>
					<select id="type" name="type" onClick="changetype(this.value)" class="form-control" required>
						<option value="a" selected="selected">Ник + Пароль</option>
						<option value="ca">Steam ID + Пароль</option>
						<option value="de">IP - Адрес</option>
					</select>
				</div>
				<div class="form-group">
					<i class="fa fa-male text-red"></i> <label><span id="login_annotation">ВАШ НИК</span>:</label>
					<input type="text" id="auth" name="auth" placeholder="Ваш ник в игре" class="form-control" maxlength="32" required>
				</div>
				<div class="form-group">
					<i class="fa fa-lock text-red"></i> <label>ПРИДУМАЙТЕ ПАРОЛЬ (МИНИМУМ 6 СИМВОЛОВ):</label> 
					<input type="text" id="pass" name="pass" placeholder="Пароль" pattern="^[\w]{6,32}$" class="form-control" required>
				</div>
				<div class="form-group">
					<i class="fa fa-server text-red"></i> <label>ВЫБЕРИТЕ СЕРВЕР:</label>
					'.$eng->serverlist().'
				</div>
				<div class="form-group">
					<i class="fa fa-flag text-red"></i> <label>ВЫБЕРИТЕ ПРИВИЛЕГИЮ:</label>
					<div id="tarif_list"></div>
					<div id="tarif_info"></div>
				</div>
				<div class="form-group">
					<i class="fa fa-calendar text-red"></i> <label>ВЫБЕРИТЕ СРОК:</label>
					<div id="tarif_list_time"></div>
				</div>	
				<div class="form-group">
					<i class="fa fa-rub text-red"></i> <label>ВЫБЕРИТЕ СПОСОБ ОПЛАТЫ:</label>
					<select id="how" name="how" class="form-control" required>
						'.$wmr.'
						'.$uni.'
						'.$rob.'
					</select>
				</div>
				<input class="btn btn-lg btn-block btn-info" type="submit" id="promoSC" value="Оплатить" name="submit">
			</form>
		</div><!-- /.box-body -->
	</div><!-- /.box -->';
?>