{if NOT $permission_list}
	Access Denied
{else}
	<h3>Сервера (<span id="srvcount">{$server_count}</span>)</h3>
	
	{if $permission_config}
		Чтобы просмотреть информацию для конфигурационного файла SourceBans кликните <a href="index.php?p=admin&c=servers&o=dbsetup">здесь</a>.<br /><br />
	{/if}
	
	<table width="100%" cellpadding="1">
	<tr>
		<td class="front-module-header" width="3%" height='16'><strong>ID</strong></td>
		<td class="front-module-header" width="54%" height='16'><strong>Имя сервера</strong></td>
		<td class="front-module-header" width="6%" height='16'><strong>Игроки</strong></td>
		<td class="front-module-header" width="5%" height='16'><strong>МОД</strong></td>
		<td class="front-module-header" height='16'><strong>Действия</strong></td>
	</tr>
	{foreach from="$server_list" item="server"}
	
	<script>xajax_ServerHostPlayers({$server.sid});</script>
	<tr id="sid_{$server.sid}" {if $server.enabled==0}style="background-color:#eaeaea" title="Disabled"{/if}>
		<td style="border-bottom: solid 1px #ccc" height='16'>{$server.sid}</td>
		<td style="border-bottom: solid 1px #ccc" height='16' id="host_{$server.sid}"><i>Запрашиваем данные с сервера...</i></td>
		<td style="border-bottom: solid 1px #ccc" height='16' id="players_{$server.sid}">Н/Д</td>
		<td style="border-bottom: solid 1px #ccc" height='16'><img src="images/games/{$server.icon}"></td>
		<td style="border-bottom: solid 1px #ccc" height='16'>
		{if $server.rcon_access}
			<a href="index.php?p=admin&c=servers&o=rcon&id={$server.sid}">РКОН</a> - 
		{/if}
		
		<a href="index.php?p=admin&c=servers&o=admincheck&id={$server.sid}">Админы</a>
	
		{if $permission_editserver}
		 	- <a href="index.php?p=admin&c=servers&o=edit&id={$server.sid}">Редактировать</a>
		{/if}
		
		{if $pemission_delserver}
		 	- <a href="#" onclick="RemoveServer({$server.sid}, '{$server.ip}:{$server.port}');">Удалить</a>
		{/if}
	 	</td>
	</tr>
	
	{/foreach}
</table>
{if $permission_addserver}
<br />
<div class="rowdesc">
	{help_icon title="Загрузить изображение карты" message="Кликните тут для загрузки изображения карты. Имя файла и имя карты должны быть одинаковыми."}Загрузить изображение карты 
	{sb_button text="Загрузить изображение" onclick="childWindow=open('pages/admin.uploadmapimg.php','upload','resizable=yes,width=300,height=130');" class="save" id="upload"}
</div>
<div id="mapimg.msg" style="color:#CC0000;"></div>
{/if}
{/if}
