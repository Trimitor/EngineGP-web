<div id="submit-introduction">
<h3>SПредложить бан</h3>
Здесь Вы сможете предложить бан игрока, который нарушает правила на игровом сервере. При предложении бана, мы просим Вас заполнить все поля, чтобы быть максимально информативным в своем комментарии. Это гарантирует, что ваше предложение бана обработается гораздо быстрее.<br /><br />
Чтобы узнать о том, как создавать демо нажмите <a href="javascript:void(0)" onclick="ShowBox('Как записать Демо', 'Перейдите в режим наблюдателя. Переключитесь на нарушающего игрока. Нажмите клавишу `на вашей клавиатуре. Потом в консоли введите record [demoname] и нажмите ввод. Также введите sb_status для получения дополнительной информации на серверах SteamBans.Файл будет находиться в папке с модом.', 'blue', '', true);">здесь</a>
</div>
<div id="submit-main">
<form action="index.php?p=submit" method="post" enctype="multipart/form-data">
<input type="hidden" name="subban" value="1">
<table cellspacing='10' width='100%' align='center'>
<tr>
	<td colspan="3">
		Детали бана:	</td>
</tr>
<tr>
	<td width="20%">
		SteamID игрока:</td>
	<td>
		<input type="text" name="SteamID" size="40" maxlength="64" value="{$STEAMID}" class="submit-fields" />
	</td>
    <td rowspan="7" align="center" valign="top" width="200px"><img src="images/nocheat.jpg" alt="No Cheaters!" width="200" height="200" /></td>
</tr>
<tr>
	<td width="20%">
		IP игрока:</td>
	<td>
		<input type="text" name="BanIP" size="40" maxlength="64" value="{$ban_ip}" class="submit-fields" />
	</td>
</tr>
<tr>
	<td width="20%">
        Ник игрока<span class="mandatory">*</span>:</td>
	<td>
        <input type="text" size="40" maxlength="70" name="PlayerName" value="{$player_name}" class="submit-fields" /></td>
</tr>
<tr>
	<td width="20%" valign="top">
		Причина бана<span class="mandatory">*</span>:<br />
		(Введите расширенный комментарий к бану. Никаких комментариев типа: "Читак")	</td>
	<td><textarea name="BanReason" cols="30" rows="5" class="submit-fields">{$ban_reason}</textarea></td>
    </tr>
<tr>
	<td width="20%">
		Ваше имя:	</td>
	<td>
		<input type="text" size="40" maxlength="70" name="SubmitName" value="{$subplayer_name}" class="submit-fields" />	</td>
    </tr>

<tr>
	<td width="20%">
		Ваш E-mail<span class="mandatory">*</span>:	</td>
	<td>
		<input type="text" size="40" maxlength="70" name="EmailAddr" value="{$player_email}" class="submit-fields" />	</td>
    </tr>
<tr>
	<td width="20%">
		Сервер<span class="mandatory">*</span>:	</td>
	<td colspan="2">
        <select id="server" name="server">
			<option value="-1">-- Выберите сервер --</option>
			{foreach from="$server_list" item="server}
				<option value="{$server.sid}" {if $server_selected == $server.sid}selected{/if}>{$server.hostname}</option>
			{/foreach}
			<option value="0">Другой сервер / Нет в списке</option>
		</select> 
    </td>
    </tr>
<tr>
	<td width="20%">
		Загрузить демо:	</td>
	<td>
		<input name="demo_file" type="file" size="25" class="submit-fields" /><br />
		Предупреждение: Разрешено загружать файлы только в формате <a href="http://www.winzip.com" target="_blank">.zip</a> или <a href="http://www.rarlab.com" target="_blank">.rar</a>.	</td>
    </tr>
<tr>
	<td width="20%"><span class="mandatory">*</span> = Обязательные поля</td>
	<td>
		{sb_button text=Ok onclick="" class=ok id=save submit=true}
	</td>
    <td>&nbsp;</td>
</tr>
</table>
</form>
<b>Что случиться если кого-то забанят ?</b><br />
Если кого-то забанят, то его STEAMID или IP адрес будут включены в эту базу данных SourceBans, и каждый раз этот игрок пытается подключиться к одному из наших серверов он / она будет заблокирован и получит сообщение о том, что заблокирован в SourceBans.</div>
