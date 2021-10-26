{if not $permission_addserver}
	Access Denied
{else}

<div id="add-group">
	<h3>Детали сервера</h3>
	За дополнительной информацией или помощью наведите курсор мыши на знак вопроса.<br /><br />
	<input type="hidden" name="insert_type" value="add">
	<table width="90%" border="0" style="border-collapse:collapse;" id="group.details" cellpadding="3">
		<tr>
		    <td valign="top" width="35%">
		    	<div class="rowdesc">{help_icon title="Адрес сервера" message="IP адрес сервера. Так же может использовоться домен."}IP/Домен сервера</div>
		    </td>
		    <td>
		    	<div align="left">
		        	<input type="text" TABINDEX=1 class="submit-fields" id="address" name="address" value="{$ip}" />
		      	</div>
		        <div id="address.msg" class="badentry"></div>
			</td>
		</tr>
		
		<tr>
			<td valign="middle">
				<div class="rowdesc">{help_icon title="Порт сервера" message="Порт, на котором запускается сервер. <br /><br /><i>По умолчанию: 27015</i>"}Порт сервера</div>
			</td>
		    <td>
		    	<div align="left">
		      		<input type="text" TABINDEX=2 class="submit-fields" id="port" name="port" value="{if $port}{$port}{else}{27015}{/if}" />
		    	</div>
		    	<div id="port.msg" class="badentry"></div>
		    </td>
		</tr>

		<tr>
			<td valign="middle">
				<div class="rowdesc">{help_icon title="РКОН пароль" message="РКОН пароль вашего сервера. Находиться в конфиг файле server.cfg в кваре <i>rcon_password</i>.<br /><br />Используется Админами для администрирования серверов через ВЕБ интерфейс."}РКОН пароль</div>
			</td>
		    <td>
		    	<div align="left">
		        	<input type="password" TABINDEX=3 class="submit-fields" id="rcon" name="rcon" value="{$rcon}" />
		      	</div>
		        <div id="rcon.msg" class="badentry"></div>
			</td>
		</tr>
		  
		<tr>
		    <td valign="middle">
		    	<div class="rowdesc">{help_icon title="РКОН пароль" message="Подтвердите РКОН пароль"}Подтверждение</div>
		    </td>
		    <td>
		    <div align="left">
		    	<input type="password" TABINDEX=4 class="submit-fields" id="rcon2" name="rcon2" value="{$rcon}" />
		    </div>
		        <div id="rcon2.msg" class="badentry"></div>
			</td>
		</tr>
		 
		<tr>
			<td valign="middle">
				<div class="rowdesc">{help_icon title="МОД сервера" message="Выберите МОД сервера."}МОД сервера </div>
			</td>
		    <td>
		    	<div align="left" id="admingroup">
		      		<select name="mod" TABINDEX=5 onchange="" id="mod" class="submit-fields">
						{if !$edit_server}
		        		<option value="-2">Выберите...</option>
						{/if}
							{foreach from="$modlist" item="mod"}
								<option value='{$mod.mid}'>{$mod.name}</option>
							{/foreach}
		        	</select>
		        </div>
		        <div id="mod.msg" class="badentry"></div>
			</td>
		</tr>
		  
		<tr>
		    <td valign="middle">
		    	<div class="rowdesc">{help_icon title="Видимость" message="Включение отображения сервера в списке серверов."}Видимость</div>
		    </td>
		    <td>
		    <div align="left">
		    	<input type="checkbox" id="enabled" name="enabled" checked="checked" /> 
		    </div>
		        <div id="enabled.msg" class="badentry"></div>
			</td>
		</tr>
		
		<tr>
			<td valign="middle">
				<div class="rowdesc">{help_icon title="Группы сервера" message="Выберите группы серверов. Используется для добавления администраторов на группу игровых серверов"}Группы серверов </div>
			</td>
		    <td>&nbsp;</td>
		</tr>
			{foreach from="$grouplist" item="group"}
				<tr>
			   		<td valign="middle">
			   			<div align="right">{$group.name} </div>
			   		</td>
			    	<td>
			    		<div align="left">
			    			<input type="checkbox" value="{$group.gid}" id="g_{$group.gid}" name="groups[]" /> 
			    		</div>
			    	</td>
				</tr> 
			{/foreach}
		<tr id="nsgroup" valign="top" class="badentry"> 		
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			{if $edit_server}
				{sb_button text=$submit_text onclick="process_edit_server();" class="ok" id="aserver" submit=false}
			{else}
				{sb_button text=$submit_text onclick="process_add_server();" class="ok" id="aserver" submit=false}
			{/if}
			      &nbsp;
				{sb_button text="Назад" onclick="history.go(-1)" class="cancel" id="back" submit=false}
			</td>
		</tr>
	</table>
</div>

{/if}
