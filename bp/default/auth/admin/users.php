<?php 
	define ( 'BLOCK', true );
	@require_once '../../core/cfg.php';
	if ( $adm_ip != NULL && $adm_ip != $_SERVER["REMOTE_ADDR"] ) header('Location: '.$url.'');
	if ( $_COOKIE['adhash'] != hash( "sha256", "".$adm_login.".".$adm_pass."" ) ) header('Location: '.$url.'auth/admin/login.php');
	$body = $eng->tmp_bar();
?>
<!DOCTYPE html>
<html>
    <head>
		<!-- Meta tags -->
		<meta charset="UTF-8">
		<title><?php echo $site_name;?> | Управление игроками</title>
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
                            <p>Administrator</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> В сети</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
						<li>
							<a href="<?php echo $url;?>auth/admin/">
                                <i class="fa fa-tasks"></i> <span>Управление серверами</span>
                            </a>
						</li>
						<li class="active">
                            <a href="<?php echo $url;?>auth/admin/users.php">
                                <i class="fa fa-male"></i> <span>Управление игроками</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Управление игроками
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><a href="<?php echo $url;?>"><i class="fa fa-dashboard"></i> Главная страница</a></li>
						<li><a href="#"><a href="<?php echo $url;?>auth/admin">Панель управления</a></li>
                        <li class="active">Управление игроками</li>
                    </ol>
                </section>
	
                <!-- Main content -->
                <section class="content">
                    <div class="row">
						<?php require_once "inc/admlist.php"; ?>
						<div id="mess" class="jGrowl bottom-right"><div class="jGrowl-notification"></div></div>
                    </div>
                </section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

		<!-- Alert Mess -->
		<script src="<?php echo $url;?>style/js/jquery.jgrowl.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo $url;?>style/js/AdminLTE/app.js" type="text/javascript"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="<?php echo $url;?>style/js/AdminLTE/demo.js" type="text/javascript"></script>
    </body>
</html>