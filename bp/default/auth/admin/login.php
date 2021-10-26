<?php
	define ( 'BLOCK', true );
	@require_once '../../core/cfg.php';
	if ( $adm_ip != NULL && $adm_ip != $_SERVER["REMOTE_ADDR"] ) header('Location: '.$url.'');
	if ( $_COOKIE['adhash'] == hash( "sha256", "".$adm_login.".".$adm_pass."" ) ) { header('Location: '.$url.'auth/admin/'); } else { unset( $_COOKIE['adhash'] ); setcookie("adhash", null, time()-3600, "/"); }
	if ( ! empty( $_POST['login'] ) && ! empty( $_POST['password'] ) )
	{
		$login = trim( $_POST['login'] );
		$password = trim( $_POST['password'] );
		$hash = hash( "sha256", "".$login.".".$password."" );
		
		if ( $login == $adm_login && $password == $adm_pass ) {
			setcookie( "adhash", $hash, ( time() + ( 60 * 60 * 24 * 7 ) ), "/" );
			header('Location: '.$url.'auth/admin/');
		} else $message = $eng->alert_mess('Неправильно введён логин или пароль!');
	}
?>

<!DOCTYPE html>
<html>
    <head>
		<!-- Meta tags -->
		<meta charset="UTF-8">
		<title><?php echo $site_name;?> | Страница авторизации</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="description" content="Онлайн приобретение привилегий на серверах">
		<meta name="keywords" content="Онлайн, приобретение, привилегий, на серверах">

		<meta name="revisit-after" content="3 day">
		<meta name="rating" content="General">

		<meta name="generator" content="BP 2.0">
		<meta name="author" content="Oleksandr Kornienko">

		<!-- Icon -->
		<link href="<?php echo $url;?>style/img/favicon.ico" rel="shortcut icon" type="image/x-icon">

		<!-- Style -->
		<link href="<?php echo $url;?>style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $url;?>style/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

		<!-- Theme style -->
		<link href="<?php echo $url;?>style/css/AdminLTE.css" rel="stylesheet" type="text/css" />

		<!-- Alert Mess -->
		<link href="<?php echo $url;?>style/css/jquery.jgrowl.css" rel="stylesheet" type="text/css" />

		<!-- JS -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo $url;?>style/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
    </head>
	<body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">Авторизация</div>
            <form action="" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
						<input type="text" name="login" validate="required" required placeholder="Логин" class="form-control"/>
                    </div>
                    <div class="form-group">
						<input type="password" name="password" validate="required" required placeholder="Пароль" class="form-control"/>
                    </div>          
                </div>
                <div class="footer">                                                               
					<button class="btn bg-olive btn-block" type="submit">Авторизоваться</button>
                </div>
            </form>
			<?php if ( isset( $message ) ) { echo $message; } ?>
			<div id="mess" class="jGrowl bottom-right"><div class="jGrowl-notification"></div></div>
        </div>

		<!-- Alert Mess -->
		<script src="<?php echo $url;?>style/js/jquery.jgrowl.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo $url;?>style/js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>