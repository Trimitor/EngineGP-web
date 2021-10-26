<form action="" method="post">
	<div id="add-group">
		<h3>Детали МОДа</h3>
		За дополнительной информацией или помощью наведите курсор мыши на знак вопроса.<br /><br />
		<input type="hidden" name="insert_type" value="add">
		<table width="90%" border="0" style="border-collapse:collapse;" id="group.details" cellpadding="3">
			<tr>
		    	<td valign="top" width="35%"><div class="rowdesc">{help_icon title="Название МОДа" message="Введите название МОДа."}Название МОДа</div></td>
		    	<td>
		    		<div align="left"> 
					    <input type="hidden" id="icon_hid" name="icon_hid" value="{$mod_icon}">
					    <input type="text" TABINDEX=1 class="submit-fields" id="name" name="name" value="{$name}" />
					</div>
					<div id="name.msg" class="badentry"></div>
				</td>
		  </tr>
		  
			<tr>
				<td valign="top"><div class="rowdesc">{help_icon title="Имя папки" message="Введите имя папки МОДа. Например, для МОДа Counter-Strike: Source's папка будет 'cstrike'"}Папка МОДа</div></td>
		    	<td>
		    		<div align="left">
		      			<input type="text" TABINDEX=2 class="submit-fields" id="folder" name="folder" value="{$folder}" />
		    		</div>
		    		<div id="folder.msg" class="badentry"></div>
		    	</td>
		  </tr>
      <tr>
				<td valign="top"><div class="rowdesc">{help_icon title="Значение Steam Universe" message="(STEAM_<b>X</b>:Y:Z) Некоторые игры отображают Steamid иначе, чем другие. Введите первый номер SteamID (<b>X</b>) в зависимости от того как она воспринимается этим МОДом. (По умолчанию: 0)."}Значение Steam Universe</div></td>
		    	<td>
		    		<div align="left">
		      			<input type="text" TABINDEX=3 class="submit-fields" id="steam_universe" name="steam_universe" value="{$steam_universe}" />
		    		</div>
		    	</td>
		  </tr>
		  <tr>
			<td valign="top"><div class="rowdesc">{help_icon title="МОД включен" message="Отметьте, если МОД включен и используется серверами."}Включен</div></td>
		    	<td>
		    		<div align="left">
		      			<input type="checkbox" TABINDEX=4 id="enabled" name="enabled" value="1" />
		    		</div>
		    	</td>
		  </tr>
		 	
			<tr>
				<td valign="top" width="35%"><div class="rowdesc">{help_icon title="Загрузить иконку" message="Нажмите здесь, чтобы выбрать и загрузить иконку МОДа."}Загрузить иконку</div></td>
		    	<td>
		    		<div align="left">
		      			{sb_button text="Загрузить иконку" onclick="childWindow=open('pages/admin.uploadicon.php','upload','resizable=yes,width=300,height=130');" class="save" id="upload" submit=false} 
		    		</div>
		    		<div id="icon.msg" class="badentry" style="display:block;">
			    		{if $mod_icon}
			    			Загружено: <b>{$mod_icon}</b>
			    		{/if}
		    		</div>
		    	</td>
		  	</tr>
			<tr>
		    	<td>&nbsp;</td>
		    	<td>      
			    	{sb_button text="Сохранить" class="ok" id="editmod" submit=true}
			     	 &nbsp;
			     	 {sb_button text="Назад" onclick="history.go(-1)" class="cancel" id="back" submit=false} 
		      	</td>
		  	</tr>
		</table>
	</div>
</form>
