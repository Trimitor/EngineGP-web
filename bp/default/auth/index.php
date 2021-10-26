<?php 
	define ( 'BLOCK', true );
	@require_once '../core/cfg.php';
	$body = $eng->tmp_bar();
	$id = abs( ( int ) $_COOKIE['id'] );
	$hash = $db->m_escape( $_COOKIE['hash'] );
	$check_auth = $at->check_auth();
	if ( $check_auth['request'] == 'error' ) header("Location: ".$url."auth/login.php?exit");
?>
<!DOCTYPE html>
<html>
    <head>
		<!-- Meta tags -->
		<meta charset="UTF-8">
		<title><?php echo $site_name;?> | Кабинет</title>
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
    <body class="<?php echo $body; ?>">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo $url;?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo $site_name;?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Убрать меню</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Кабинет <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <?php echo ( $_COOKIE['ad'] == 'stop' ? '<a onclick="openwarn()" style="color: rgba(255, 255, 255, 0.8);" class="btn btn-primary btn-sm"><b>Включить уведомления</b></a>' : '<a onclick="closewarn()" style="color: rgba(255, 255, 255, 0.8);" class="btn btn-primary btn-sm"><b>Отключить уведомления</b></a>' ); ?>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo $url;?>auth/login.php?exit" style="color: rgba(255, 255, 255, 0.8);" class="btn btn-danger btn-sm"><b>Выход</b></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $url;?>style/img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo '<a href="'.$url.'auth/">'.$at->auth_info( 'auth', $id, $hash ).'</a>'; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> В сети</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo $url;?>list">
                                <i class="fa fa-male"></i> <span>Список Админов | V.I.P</span>
								<?php require_once "../inc/log.php"; ?>
                            </a>
                        </li>
						<?php require_once "inc/menu.php"; ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Кабинет
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Главная страница</a></li>
                        <li class="active">Кабинет</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<div class="col-md-12">
							<?php require_once "inc/warn.php"; ?>
						</div>
                        <!-- left column -->
                        <div class="col-md-6">
                            <?php require_once "inc/panel.php"; ?>
							<?php require_once "inc/list.php"; ?>
                        </div><!--/.col (left) -->
						
                        <!-- right column -->
                        <div class="col-md-6">
							<?php require_once "inc/pass.php"; ?>
							<?php require_once "inc/chat.php"; ?>
                        </div><!--/.col (right) -->
						<?php require_once "inc/error.php"; if ( isset( $error ) ) { echo $error; } ?>
						<div id="mess" class="jGrowl bottom-right"><div class="jGrowl-notification"></div></div>
                    </div>
                </section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

		<!-- Alert Mess -->
		<script src="<?php echo $url;?>style/js/jquery.jgrowl.js" type="text/javascript"></script>
		<script type="text/javascript">
			function closewarn () 
			{
				if (confirm("Вы действительно хотите отключить уведомления, на день?")) {
					var date = new Date( new Date().getTime() + 86400*1000 );
					document.cookie="ad=stop; path=/; expires="+date.toUTCString();
					location.reload(true);
				}
			}
			function openwarn () 
			{
				document.cookie="ad=; path=/";
				location.reload(true);
			}
			$(function(){
				$('#chat-box').slimScroll({
					height: '280px'
				});
				$('#allsmiles').popover({'placement': 'top', 'title': 'Список смайлов', 'content': $('#contentsmiles').html(), 'container': 'body', 'html': true});
			});
		</script>
		<!-- AdminLTE App -->
		<script src="<?php echo $url;?>style/js/AdminLTE/app.js" type="text/javascript"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo $url;?>style/js/AdminLTE/demo.js" type="text/javascript"></script>
    </body>
</html>