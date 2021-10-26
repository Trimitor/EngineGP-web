<div id="login"> 
	<div id="login-content">
	  	<div id="loginUsernameDiv">
	    	<label for="loginUsername">Логин:</label><br />
	    	<input id="loginUsername" class="loginmedium" type="text" name="username"value="" />
		</div>
		<div id="loginUsername.msg" class="badentry"></div>
  		
		<div id="loginPasswordDiv">
	    	<label for="loginPassword">Пароль:</label><br />
	   		<input id="loginPassword" class="loginmedium" type="password" name="password" value="" />
		</div>
		<div id="loginPassword.msg" class="badentry"></div>
	  	
		<div id="loginRememberMeDiv">
	    	<input id="loginRememberMe" type="checkbox" class="checkbox" name="remember" value="checked" vspace="5px" />    <span class="checkbox" style="cursor:pointer;" onclick="($('loginRememberMe').checked?$('loginRememberMe').checked=false:$('loginRememberMe').checked=true)">Запомнить</span>
  		</div>
		
  		<div id="loginSubmit">	
			-{sb_button text="Войти" onclick=$redir class="ok" id="alogin" submit=false}-
		</div>
		
		<div id="loginOtherlinks">
			<a href="?">На главную</a> - <a href="index.php?p=lostpassword">Забыли пароль?</a>
		</div>
	</div>
</div>
	
<script>
	$E('html').onkeydown = function(event){
	    var event = new Event(event);
	    if (event.key == 'enter' ) -{$redir}-
	};$('loginRememberMeDiv').onkeydown = function(event){
	    var event = new Event(event);
	    if (event.key == 'space' ) $('loginRememberMeDiv').checked = true;
	};$('button').onkeydown = function(event){
	    var event = new Event(event);
	    if (event.key == 'space' ) -{$redir}-
	};
</script>