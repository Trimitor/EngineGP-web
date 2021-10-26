<?php
	$status = $_SERVER['REDIRECT_STATUS'];
	$codes = array(
	   400 => array('400', 'Запрос не может быть обработан из-за синтаксической ошибки.'),
	   403 => array('403', 'Сервер отказывает в выполнении вашего запроса.'),
	   404 => array('404', 'Запрашиваемая страница не найдена на сервере.'),
	   405 => array('405', 'Указанный в запросе метод не допускается для заданного ресурса.'),
	   408 => array('408', 'Ваш браузер не отправил информацию на сервер за отведенное время.'),
	   500 => array('500', 'Запрос не может быть обработан из-за внутренней ошибки сервера.'),
	   502 => array('502', 'Сервер получил неправильный ответ при попытке передачи запроса.'),
	   504 => array('504', 'Вышестоящий сервер не ответил за установленное время.')
	);

	$title = $codes[$status][0];
	$message = $codes[$status][1];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $title; ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!--[if gte IE 9]>
	<style type="text/css">
		.gradient {
		   filter: none;
		}
	</style>
	<![endif]-->
	<style>
	*, *:after, *:before {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		-ms-box-sizing: border-box;
		box-sizing: border-box; 
	}
	html {
		background: #ccc;
		font: bold 14px/20px "Trajan Pro", "Times New Roman", Times, serif;
		color: rgba(255, 255, 255, 0.94);
		text-shadow: 0px 0 7px rgba(0, 0, 0, 0.5);
	}
	.error-page-wrap {
		width: 325px;
		height: 325px;
		margin: 155px auto;
	}
	.error-page-wrap:before {
		box-shadow: 0 0 200px 150px #fff;
		width: 325px;
		height: 325px;
		border-radius: 50%;
		position: relative;
		z-index: -1;
		content: '';
		display: block; 
	}
	.error-page {
		width: 325px;
		height: 325px;
		border-radius: 50%;
		top: -325px;
		position: relative;
		text-align: center;
		background: #333333;
		background: -moz-linear-gradient(top, #333333 0%, black 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #333333), color-stop(100%, black));
		background: -webkit-linear-gradient(top, #333333 0%, black 100%);
		background: -o-linear-gradient(top, #333333 0%, black 100%);
		background: -ms-linear-gradient(top, #333333 0%, black 100%);
		background: linear-gradient(to bottom, #333333 0%, black 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$firstColor', endColorstr='$secondColor',GradientType=0 ); 
	}
	.error-page:before {
		width: 63px;
		height: 63px;
		border-radius: 50%;
		box-shadow: 3px 25px 0 5px #333333;
		content: '';
		z-index: -1;
		display: block;
		position: relative;
		top: -19px;
		left: 44px; 
	}
	.error-page:after {
		width: 325px;
		height: 17px;
		margin: 0 auto;
		top: 25px;
		content: '';
		z-index: -1;
		display: block;
		position: relative;
		background: -moz-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
		background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(0, 0, 0, 0.65)), color-stop(59%, rgba(35, 26, 26, 0)), color-stop(100%, rgba(60, 44, 44, 0)));
		background: -webkit-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
		background: -o-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
		background: -ms-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
		background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a6000000', endColorstr='#003c2c2c',GradientType=1 ); 
	}
	.error-page h1 {
		color: rgba(255, 255, 255, 0.94);
		font-size: 100px;
		margin: 65px auto 0 auto;
		text-shadow: 0px 0 7px rgba(0, 0, 0, 0.5); 
	}
    .error-page h1:before {
		width: 260px;
		height: 1px;
		position: relative;
		margin: 0 auto;
		top: 70px;
		content: '';
		display: block;
		background: -moz-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
		background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(255, 255, 255, 1)), color-stop(70%, rgba(75, 38, 38, 0)), color-stop(100%, rgba(60, 44, 44, 0)));
		background: -webkit-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
		background: -o-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
		background: -ms-radial-gradient(center, ellipse cover, rgba(255, 255, 255, 1) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
		background: radial-gradient(ellipse at center, rgba(255, 255, 255, 1) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a66f1919', endColorstr='#003c2c2c',GradientType=1 ); 
	}
    .error-page h1:after {
		width: 260px;
		height: 1px;
		content: '';
		display: block;
		opacity: 0.2;
		margin: 0 auto;
		top: 50px;
		position: relative;
		background: -moz-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(247, 173, 148, 0.65)), color-stop(99%, rgba(255, 255, 255, 0.01)), color-stop(100%, rgba(255, 255, 255, 0)));
		background: -webkit-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		background: -o-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		background: -ms-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		background: radial-gradient(ellipse at center, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a6f7ad94', endColorstr='#00ffffff',GradientType=1 ); 
	}
	.error-page h2 {
		padding: 45px 10px 10px 10px;
		font-size: 15px; 
	}
    
	.error-page h2:after {
		width: 130px;
		height: 1px;
		content: '';
		display: block;
		opacity: 0.2;
		margin: 0 auto;
		top: 11px;
		position: relative;
		background: -moz-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(247, 173, 148, 0.65)), color-stop(99%, rgba(255, 255, 255, 0.01)), color-stop(100%, rgba(255, 255, 255, 0)));
		background: -webkit-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		background: -o-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		background: -ms-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		background: radial-gradient(ellipse at center, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a6f7ad94', endColorstr='#00ffffff',GradientType=1 ); 
	}
	.error-back {
		text-decoration: none;
		color: #fff;
		font-size: 15px; 
	}
	.error-back:hover {
		color: #7C7B7B;
		text-shadow: 0 0 3px black; 
	}
	</style>
</head>
<body>
	<div class="error-page-wrap">
		<article class="error-page gradient">
			<hgroup>
				<h1><?php echo $title; ?></h1>
				<h2><?php echo $message; ?></h2>
			</hgroup>
			<a href="#" onclick="history.back(); return false;" title="Назад" class="error-back">Назад</a>
		</article>
	</div>
</body>
</html>