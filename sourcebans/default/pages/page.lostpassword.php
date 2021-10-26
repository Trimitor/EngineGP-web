<?php 
/**
 * =============================================================================
 * Lost password page
 * 
 * @author SteamFriends Development Team
 * @version 1.0.0
 * @copyright SourceBans (C)2007 SteamFriends.com.  All rights reserved.
 * @package SourceBans
 * @link http://www.sourcebans.net
 * 
 * @version $Id: page.lostpassword.php 24 2007-11-06 18:17:05Z olly $
 * =============================================================================
 */

global $theme, $userbank;

if(isset($_GET['validation'],$_GET['email']) && !empty($_GET['email']) && !empty($_GET['validation']))
{  
	$email = $_GET['email'];
	$validation = $_GET['validation'];
	
	if(strlen($validation) < 60)
	{
		echo '<div id="msg-red" style="">
			<i><img src="./images/warning.png" alt="Внимание!" /></i>
			<b>Ошибка</b>
			<br />
			Проверочный код слишком короткий.
			</div>';
		exit();
	}
	
	$q = $GLOBALS['db']->GetRow("SELECT aid, user FROM `" . DB_PREFIX . "_admins` WHERE `email` = ? && `validate` IS NOT NULL && `validate` = ?", array($email, $validation));
	if($q)
	{
		$newpass = generate_salt(MIN_PASS_LENGTH+8);
		$query = $GLOBALS['db']->Execute("UPDATE `" . DB_PREFIX . "_admins` SET `password` = '" . $userbank->encrypt_password($newpass) . "', validate = NULL WHERE `aid` = ?", array($q['aid']));
		$message = "Здравствуйте " . $q['user'] . ",\n\n";
		$message .= "Выш пароль был успешно сброшен.\n";
		$message .= "Ваш новый пароль: ".$newpass."\n\n";
		$message .= "Зайдите на вашу страницу статистики SourceBan для смены пароля.\n";

		$headers = 'From: lostpwd@' . $_SERVER['HTTP_HOST'] . "\n" .
		'X-Mailer: PHP/' . phpversion();
		$m = mail($email, "Сброс пароля от статистики SourceBans", $message, $headers);
		
		echo '<div id="msg-blue" style="">
			<i><img src="./images/info.png" alt="Информация" /></i>
			<b>Сброс пароля</b>
			<br />
			Ваш пароль был сброшен и отправлен на Ваш e-mail..<br />Проверьте также папку "Спам".<br />Войдите с высланным Вам паролем, <br />И смените его.
			</div>';
	}
	else 
	{
		echo '<div id="msg-red" style="">
			<i><img src="./images/warning.png" alt="Внимание" /></i>
			<b>Ошибка</b>
			<br />
			Неверный проверочный код.
			</div>';
	}
}else 
{
	$theme->display('page_lostpassword.tpl');
}
?>
