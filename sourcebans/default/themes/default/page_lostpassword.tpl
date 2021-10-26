<div id="lostpassword"> 
	<div id="login-content">

		<div id="msg-red" style="display:none;">
			<i><img src="./images/warning.png" alt="Внимание" /></i>
			<b>Ошибка</b>
			<br />
			Введенный e-mail не найден в базе.</i>
		</div>
		<div id="msg-blue" style="display:none;">
			<i><img src="./images/info.png" alt="Внимание" /></i>
			<b>Информация</b>
			<br />
			На ваш электронный ящик выслана информация для сброса пароля. Проверьте свою почту (и папку "Спам").</i>
		</div>

	  	<h4>
	  		Введите адрес электронной почты в поле ниже, чтобы сбросить пароль. 
	  	</h4><br />
	  	
  		<div id="loginPasswordDiv">
	    	<label for="email">Ваш E-mail адрес:</label><br />
	   		<input id="email" class="loginmedium" type="text" name="password" value="" />
		</div>
		
		<div id="loginSubmit">
			{sb_button text=Ok onclick="xajax_LostPassword($('email').value);" class=ok id=alogin submit=false}
		</div>
		
	</div>
</div>