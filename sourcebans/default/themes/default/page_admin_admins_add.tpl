{if NOT $permission_addadmin}
	Access Denied!
{else}
	<div id="msg-green" style="display:none;">
		<i><img src="./images/yay.png" alt="Внимание" /></i>
		<b>Админ добавлен</b>
		<br />
		Админ был успешно добавлен.<br /><br />
		<i>Переадрессация...</i>
	</div>
	
	
	<div id="add-group">
		<h3>Детали админа</h3>
		За дополнительной информацией или помощью, наведите курсор мыши на знак вопроса.<br /><br />
		<table width="90%" border="0" style="border-collapse:collapse;" id="group.details" cellpadding="3">
			<tr>
		    	<td valign="top" width="35%">
		    		<div class="rowdesc">
		    			{help_icon title="Логин" message="Это имя пользователя будет использоваться администратором, для входа в панель управления."}Логин 
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left">
		        		<input type="text" TABINDEX=1 class="submit-fields" id="adminname" name="adminname" />
		      		</div>
		        	<div id="name.msg" class="badentry"></div>
		        </td>
			</tr>
		  	<tr>
		    	<td valign="top">
		    		<div class="rowdesc">
		    			{help_icon title="Steam ID" message="STEAM ID админа. Для использования админских прав на сервере."}Steam ID или Community ID админа
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left">
		     			<input type="text" TABINDEX=2 value="STEAM_0:" class="submit-fields" id="steam" name="steam" />
		    		</div>
		    		<div id="steam.msg" class="badentry"></div>
		    	</td>
		  	</tr>
		  	<tr>
		    	<td valign="top">
		    		<div class="rowdesc">
		    			{help_icon title="Email админа" message="E-mail админа. Необходимо для отправки сообщений от автоматизированной системы или изменения паролей. Нужен только для получения ВЕБ разрешений."}E-mail админа
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left">
		        		<input type="text" TABINDEX=3 class="submit-fields" id="email" name="email" />
		     		</div>
		        	<div id="email.msg" class="badentry"></div>
		        </td>
		  	</tr>
		  	<tr>
		    	<td valign="top">
		    		<div class="rowdesc">
		    			{help_icon title="Пароль" message="Пароль админа для доступа к веб-панели. Нужен только для получения ВЕБ разрешений."}Пароль админа
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left">
		       			<input type="password" TABINDEX=4 class="submit-fields" id="password" name="password" />
		      		</div>
		        	<div id="password.msg" class="badentry"></div>
		        </td>
		  	</tr>
		  	<tr>
		    	<td valign="top">
		    		<div class="rowdesc">
		    			{help_icon title="Пароль" message="Повторите пароль."}Подтверждение пароля 
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left">
		        		<input type="password" TABINDEX=5 class="submit-fields" id="password2" name="password2" />
		      		</div>
		        	<div id="password2.msg" class="badentry"></div>
		        </td>
		  	</tr>
		    <tr>
		    	<td valign="top" width="35%">
		    		<div class="rowdesc">
		    			{help_icon title="Серверный пароль" message="Если этот флажок установлен, то вам нужно указать пароль в игровом сервере, для использования серверных прав админа."}Пароль сервера <small>(<a href="http://wiki.alliedmods.net/Adding_Admins_%28SourceMod%29#Passwords" title="Информация о паролах в SourceMod" target="_blank">Подробнее</a>)</small>
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left">
		        		<input type="checkbox" id="a_useserverpass" name="a_useserverpass" TABINDEX=6 onclick="$('a_serverpass').disabled = !$(this).checked;" /> <input type="password" TABINDEX=7 class="submit-fields" name="a_serverpass" id="a_serverpass" disabled="disabled" />
		    		</div>
					<div id="a_serverpass.msg" class="badentry"></div>
		    	</td>
		  	</tr>
		</table>
	
		
		<br />
	
		
		<h3>Выберите сервер</h3>
			<table width="90%" border="0" style="border-collapse:collapse;" id="group.details" cellpadding="3">
		  	<tr>
		    	<td valign="top" width="35%">
		    		<div class="rowdesc">
		    			{help_icon title="Сервер" message="<b>Сервер: </b><br>Выберите сервер или группу серверов, которы он будет администрировать."}Сервер 
		    		</div>
		    	</td>
		    	<td>&nbsp;</td>
		  	</tr>
		  	<tr>
			  	<td colspan="2">
			  		<table width="90%" border="0" cellspacing="0" cellpadding="4" align="center">
						{foreach from="$group_list" item="group"}
							<tr>
								<td colspan="2" class="tablerow4">{$group.name}<b><i>(Группа)</i></b></td>
								<td align="center" class="tablerow4"><input type="checkbox" id="group[]" name="group[]" value="g{$group.gid}" /></td>
							</tr>
						{/foreach}
					
						{foreach from="$server_list" item="server"}
							<tr class="tablerow1">
								<td colspan="2" class="tablerow1" id="sa{$server.sid}"><i>Получение имени сервера... {$server.ip}:{$server.port}</i></td>
								<td align="center" class="tablerow1">
									<input type="checkbox" name="servers[]" id="servers[]" value="s{$server.sid}" />
						  		</td> 
							</tr>
						{/foreach}
			  		</table>
		  		</td>
			</tr>
		</table>
	
		
		
		<br />
		
		
		
		<h3>Разрешения админа</h3>
		<table width="90%" border="0" style="border-collapse:collapse;" id="group.details" cellpadding="3">
			<tr>
			    <td valign="top" width="35%">
			    	<div class="rowdesc">
			    		{help_icon title="Группа админов" message="<b>Выборочные права: </b><br>Выберите эту опцию, чтобы выдать админу определённые права.<br><br><b>Новая группа: </b><br>Выберите эту опцию для выбора определенных прав и сохранения их в новую группу.<br><br><b>Группы: </b><br>Выберите готовые группы."}Группа админов 
			    	</div>
			    </td>
			    <td>
			    	<div align="left" id="admingroup">
				      	<select TABINDEX=8 onchange="update_server()" name="serverg" id="serverg" class="submit-fields">
					        <option value="-2">Выберите...</option>
					        <option value="-3">Нет разрешений</option>
					        <option value="c">Выборочные разрешения</option>
					        <option value="n">Новая группа админов</option>
					        <optgroup label="Группы" style="font-weight:bold;">
						        {foreach from="$server_admin_group_list" item="server_wg"}
									<option value='{$server_wg.id}'>{$server_wg.name}</option>
								{/foreach}
							</optgroup>
				        </select>
			        </div>
			        <div id="server.msg" class="badentry"></div>
				</td>
		  	</tr>
		   	<tr>
		 		<td colspan="2" id="serverperm" valign="top" style="height:5px;overflow:hidden;"></td>
		 	</tr>
		   	<tr>
		    	<td valign="top">
		    		<div class="rowdesc">
		    			{help_icon title="Группа админов" message="<b>Выборочные права: </b><br>Выберите эту опцию, для выдачи админу определенных разрешений.<br><br><b>Новая группа: </b><br>Выберите эту опцию для выбора определенных прав и сохранения их в новую группу.<br><br><b>Группы: </b><br>Выберите готовые группы."}Группа ВЕБ админов
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left" id="webgroup">
						<select TABINDEX=9 onchange="update_web()" name="webg" id="webg" class="submit-fields">
							<option value="-2">Выберите...</option>
							<option value="-3">Нет разрешений</option>
							<option value="c">Выборочные разрешения</option>
							<option value="n">Новая группа админов</option>
							<optgroup label="Группы" style="font-weight:bold;">
								{foreach from="$server_group_list" item="server_g"}
									<option value='{$server_g.gid}'>{$server_g.name}</option>
								{/foreach}
							</optgroup>
						</select>
		        	</div>
		        	<div id="web.msg" class="badentry"></div>
		       	</td>
		  	</tr>
		  	<tr>
		 		<td colspan="2" id="webperm" valign="top" style="height:5px;overflow:hidden;"></td>
		 	</tr>
		  	<tr>
		    	<td>&nbsp;</td>
		    	<td>
			    	{sb_button text="Добавить админа" onclick="ProcessAddAdmin();" class="ok" id="aadmin" submit=false}
				      &nbsp;
				    {sb_button text="Назад" onclick="history.go(-1)" class="cancel" id="aback"}
		      	</td>
		  	</tr>
		</table>
        {$server_script}
	</div>
{/if}
