<?php 
	define ( 'BLOCK', true );
	if ( is_file( "core/cfg.php" ) ) require_once "core/cfg.php"; else header("Location: install");
	$body = $eng->tmp_bar();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
		<title><?php echo $site_name;?> | ONLINE SHOP</title>
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
                        <li class="dropdown user user-menu">
                            <a href="<?php echo $url;?>auth/admin">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Панель управления</span>
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
                        </li>
						<li>
                            <a href="<?php echo $url;?>help">
                                <i class="fa fa-envelope"></i> <span>Тех. Поддержка</span>
                            </a>
                        </li>
					</ul>
					<?php 
						if ( isset( $purse ) ){
							echo '
							<div style="bottom:0px; position: absolute; left:15px;">
                                <a href="http://www.free-kassa.ru/"><img src="http://www.free-kassa.ru/img/fk_btn/18.png"></a>
								<a href="http://www.megastock.ru/" target="_blank"><img src="http://www.webmoney.ru/img/icons/88x31_wm_blue_on_white_ru.png" alt="www.megastock.ru" border="0"></a>
								<a href="http://passport.webmoney.ru/asp/certview.asp?purse='.$purse.'" target="_blank"><img width="88" height="31" alt="" src="http://www.webmoney.ru/img/icons/88x31_wm_v_blue_on_white_ru.png"></a>
							</div>';
						}
					?>
				 </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1> <center><b><span style="color: #000000; text-shadow: 0px -0px 9px #F0F8FF">Главная страница</span></b></center></h1>
                    <ol class="breadcrumb">
                        <li class="active"><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Главная страница</a></li>
                    </ol>
                </section>
				
                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <?php require_once "inc/add.php";?>
                        </div>
                        <div class="col-md-6">
							
                            <div class="box box-success">
								<div class="box-header">
									<i class="fa fa-bullhorn"></i>
									<h3 class="box-title">Информация</h3>
								</div>
									<div class="box-body">
									<div id="selected_server">
									<div class="callout callout-danger">
									<div class="box-body">
                                       <p>
											<b>
												После того, как вы купите любую из Услуг, сервер сам вам выдаст ту Услугу, которую вы купили.</br>
												Как активировать Услугу? - Заходим в игру, открываем консоль,</br>
												Далее пишет туда: setinfo _pw "ваш пароль от купленной услуги" и нажимаем кнопку ENTER,</br>
												далее заходим на сервер и ждём смены карты.</br>
												После смены карты на сервере, ваша услуга будет активна.</br>
											</b>
										</p>
                                    </div>
									</div>					
								</div>
                                </div>
                            </div>
							<?php require_once "inc/last.php"; ?>	
                        </div>
						<div id="mess" class="jGrowl bottom-right"><div class="jGrowl-notification"></div></div>
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

<center>
Debug by <a href="//vk.com/bestserverpanel" target="_blank">BSPanel.Ru</a>
</center>