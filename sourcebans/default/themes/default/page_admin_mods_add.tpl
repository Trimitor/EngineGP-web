{if NOT $permission_add}
	Access Denied!
{else}
	<div id="add-group1">
		<h3>Добавить МОД</h3>
		За дополнительной информацией или помощью наведите курсор мыши на знак вопроса.<br /><br />
		<table width="90%" style="border-collapse:collapse;" id="group.details" cellpadding="3">
			<tr>
		    	<td valign="top" width="35%">
		    		<div class="rowdesc">
		    			{help_icon title="Название МОДа" message="Введите название МОДа."}Название МОДа 
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left">
		    			<input type="hidden" id="fromsub" value="" />
		      			<input type="text" TABINDEX=1 class="submit-fields" id="name" name="name" />
		    		</div>
		    		<div id="name.msg" class="badentry"></div>
		    	</td>
			</tr>
		  	<tr>
		    	<td valign="top">
		    		<div class="rowdesc">
		    			{help_icon title="Имя папки" message="Введите имя папки МОДа. Например для Counter-Strike: Source папка будет 'cstrike'"}Папка МОДа 
		    		</div>
		    	</td>
		    	<td>
			    	<div align="left">
			      		<input type="text" TABINDEX=2 class="submit-fields" id="folder" name="folder" />
			    	</div>
			    	<div id="folder.msg" class="badentry"></div>
				</td>
			</tr>
      <tr>
				<td valign="top"><div class="rowdesc">{help_icon title="Значение Steam Universe" message="(STEAM_<b>X</b>:Y:Z) Некоторые игры отображают Steamid иначе, чем другие. Введите первый номер SteamID (<b>X</b>) в зависимости от того как она воспринимается этим МОДом. (По умолчанию: 0)."}Значение Steam Universe</div></td>
		    	<td>
		    		<div align="left">
		      			<input type="text" TABINDEX=3 class="submit-fields" id="steam_universe" name="steam_universe" value="0" />
		    		</div>
		    	</td>
		  </tr>
      <tr>
			<td valign="top"><div class="rowdesc">{help_icon title="МОД включен" message="Отметьте, если МОД включен и используется серверами."}Включен</div></td>
		    	<td>
		    		<div align="left">
		      			<input type="checkbox" TABINDEX=4 id="enabled" name="enabled" value="1" checked="checked" />
		    		</div>
		    	</td>
		  </tr>
		  	<tr>
		    	<td valign="top" width="35%">
		    		<div class="rowdesc">
		    			{help_icon title="Загрузить иконку" message="Кликните тут, чтобы загрузить иконку МОДа."}Загрузить иконку
		    		</div>
		    	</td>
		    	<td>
		    		<div align="left">
		      			{sb_button text="Загрузить" onclick="childWindow=open('pages/admin.uploadicon.php','upload','resizable=yes,width=300,height=130');" class="save" id="upload"}
		    		</div>
		    		<div id="icon.msg" style="color:#CC0000;"></div>
		    	</td>
		  	</tr>
		 	<tr>
		    	<td>&nbsp;</td>
		    	<td>		
			     	{sb_button text="Добавить МОД" onclick="ProcessMod();" class="ok" id="amod"}&nbsp;
			     	{sb_button text="Назад" onclick="history.go(-1)" class="cancel" id="aback"}      
		      	</td>
		  	</tr>
		</table>
	</div>
{/if}
