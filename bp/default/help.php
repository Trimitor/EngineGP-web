<?php 
	define ( 'BLOCK', true );
	@require_once "core/cfg.php";
	$body = $eng->tmp_bar();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
		<title><?php echo $site_name;?> | Помощь</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="description" content="Онлайн приобретение привилегий на серверах">
		<meta name="keywords" content="Онлайн, приобретение, привилегий, на серверах">

		<link href="<?php echo $url;?>style/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
		<link href="<?php echo $url;?>style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $url;?>style/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $url;?>style/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $url;?>style/css/jquery.jgrowl.css" rel="stylesheet" type="text/css" />

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo $url;?>style/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    </head>
    <body class="<?php echo $body; ?>">
        <header class="header">
            <a href="<?php echo $url;?>" class="logo">
				<?php echo $site_name;?>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Убрать меню</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="<?php echo $url;?>auth/login.php">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Вход в Кабинет</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $url;?>style/img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo ( isset( $_COOKIE['id'] ) && isset( $_COOKIE['hash'] ) ) ? '<a href="'.$url.'auth/">'.$at->auth_info( 'auth', $_COOKIE['id'], $_COOKIE['hash'] ).'</a>' : 'Гость'; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo $url;?>list">
                                <i class="fa fa-male"></i> <span>Список Админов | V.I.P</span>
								<?php require_once "inc/log.php"; ?>
                            </a>
						<li>
                            <a href="<?php echo $url;?>help">
                                <i class="fa fa-envelope"></i> <span>Тех. Поддержка</span>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>

            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Помощь
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Главная страница</a></li>
                        <li class="active">Помощь</li>
                    </ol>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <?php require_once "inc/mail.php"; ?>	
                        </div>
						
                        <div class="col-md-6">
                            <div class="box box-info">
								<div class="box-header">
									<i class="fa fa-comment"></i>
									<h3 class="box-title">Контакты для связи</h3>
								</div>
								<div class="box-body">
									<div class="callout callout-info">
                                        <p>
											<b>
												<?php
													if ( ! empty( $to ) ) echo '<i class="fa fa-envelope"></i> <a href="mailto:'.$to.'">'.$to.'</a><br />';
													if ( ! empty( $vk ) ) echo '<i class="fa fa-vk"></i> <a target="_blank" href="'.$vk.'">'.str_replace( "http://vk.com/", "", $vk ).'</a><br />';
													if ( ! empty( $skype ) ) echo '<i class="fa fa-skype"></i> <a href="skype:'.$skype.'?userinfo">'.$skype.'</a><br />';
												?>
											</b>
										</p>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div id="mess" class="jGrowl bottom-right"><div class="jGrowl-notification"></div></div>
                    </div>
                </section>
            </aside>
        </div>

		<script src="<?php echo $url;?>style/js/jquery.jgrowl.js" type="text/javascript"></script>
		<script src="<?php echo $url;?>style/js/AdminLTE/app.js" type="text/javascript"></script>
		<script src="<?php echo $url;?>style/js/AdminLTE/demo.js" type="text/javascript"></script>
    </body>
</html>