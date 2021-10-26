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
	
	if ( ! empty( $_POST['mail'] ) ) 
	{
		$_POST['title'] = substr( htmlspecialchars( trim( $_POST['title'] ), NULL, '' ), 0, 1000 ); 
		$_POST['email'] = substr( htmlspecialchars( trim( $_POST['email'] ), NULL, '' ), 0, 50 ); 
		$_POST['mess'] = substr( htmlspecialchars( trim( $_POST['mess'] ), NULL, '' ), 0, 1000000 ); 
		
		if ( ! preg_match( "/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $_POST['email'] ) )
		{
			$e_mess = '
			<script type=\'text/javascript\'>
				window.onload = function() {
					$(\'#mess\').jGrowl(\'<center><strong>Неверно введен e-mail!</strong></center>\', { life: 5000 });
				}
			</script>';
		} else if ( empty( $_POST['mess'] ) ) {	
			$e_mess = '
			<script type=\'text/javascript\'>
				window.onload = function() {
					$(\'#mess\').jGrowl(\'<center><strong>Не введено сообщение!</strong></center>\', { life: 5000 });
				}
			</script>'; 
		} else {
			$mess = '
			<b>Информация о посетителе:</b> <br />
			-----------------------------------------<br />
			<b>Email:</b> '.$_POST['email'].'<br />
			<b>IP Адрес:</b> '.$_SERVER['REMOTE_ADDR'].'<br />
			-----------------------------------------
			<br />
			<br />
			<br />
			<br />
			
			<b>Сообщение:</b><br /><br />
			'.$_POST['mess'].'<br />
			'; 
			$from = $_POST['email']; 
			mail($to, $_POST['title'], $mess, "From:".$from. "\r\nContent-type: text/html; charset=utf-8"); 
			$e_mess = "
			<script type='text/javascript'>
				window.onload = function() {
					$('#mess').jGrowl('<center><strong>Ваше письмо успешно отправлено!</strong></center>', { life: 5000 });
				}
			</script>";
		}
	}
	
	if ( isset( $e_mess ) ) { echo $e_mess; }
	echo '
	<!-- general form elements -->
	<div class="box box-success">
		<!-- box-header -->
		<div class="box-header">
			<i class="fa fa-envelope"></i>
			<h3 class="box-title">Обратная связь</h3>
		</div><!-- /.box-header -->
		<!-- form start -->
		<div class="box-body">				
			<form action="" method="POST"> 
				<div class="form-group">
					<label>Тема сообщения:</label>
					<input type="text" name="title" size="40" class="form-control" required placeholder="Тема сообщения"> 
				</div>
				<div class="form-group">
					<label>Адрес электронной почты:</label>
					<input type="text" name="email" size="40" class="form-control" required placeholder="email@site.ru" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"> 
				</div>
				<div class="form-group">
					<label>Сообщение:</label>				
					<textarea rows="10" name="mess" cols="30" class="form-control" style="resize:none;" required placeholder="Текст сообщения"></textarea> 
				</div>
				<div class="clearfix"><input type="submit" class="pull-right btn btn-success" value="Отправить сообщение" name="mail"></div>                     
			</form>
		</div><!-- /.box-body -->
	</div><!-- /.box -->';	
?> 