<div id="submit-introduction">
<h3>Протест бана</h3>
Перед началом убедитесь, что вы проверили банлист и нашли бан. Нажмите <a href="index.php?p=banlist">здесь</a> если Вы нашли бан. 

Если вы нашли себя в списке банов, но причина бана не соответствует действительности то вы можете написать протест бана.
</div>
<div id="submit-main">
<form action="index.php?p=protest" method="post">
<input type="hidden" name="subprotest" value="1">
<table cellspacing='10' width='100%' align='center'>
<tr>
	<td colspan="3">
		Детали:	</td>
</tr>
<tr>
	<td width="20%">Тип бана:</td>
	<td>
		<select id="Type" name="Type" class="submit-fields" onChange="changeType(this[this.selectedIndex].value);">
			<option value="0">Steam ID</option>
			<option value="1">IP адрес</option>
		</select>
	</td>
</tr>
<tr id="steam.row">
	<td width="20%">
		Ваш SteamID<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="SteamID" size="40" maxlength="64" value="{$steam_id}" class="submit-fields" />
	</td>
		<td rowspan="7" align="center" valign="top" width="200px"><img src="images/protest-ban.jpg" alt="Protest Ban" /></td>
</tr>
<tr id="ip.row" style="display: none;">
	<td width="20%">
		Ваш IP<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="IP" size="40" maxlength="64" value="{$ip}" class="submit-fields" />
		<td rowspan="7" align="center" valign="top" width="200px"><img src="images/protest-ban.jpg" alt="Protest Ban" /></td>
	</td>
</tr>
<tr>
	<td width="20%">
        Имя<span class="mandatory">*</span>:</td>
	<td>
        <input type="text" size="40" maxlength="70" name="PlayerName" value="{$player_name}" class="submit-fields" /></td>
    </tr>
<tr>
	<td width="20%" valign="top">
		Причина, по которой Вы должны быть разбанены <span class="mandatory">*</span>: (Будьте максимально информативным) </td>
	<td><textarea name="BanReason" cols="30" rows="5" class="submit-fields">{$reason}</textarea></td>
    </tr>
<tr>
	<td width="20%">
		Ваш Email<span class="mandatory">*</span>:	</td>
	<td>
		<input type="text" size="40" maxlength="70" name="EmailAddr" value="{$player_email}" class="submit-fields" />	</td>
    </tr>
<tr>
	<td width="20%"><span class="mandatory">*</span> = обязательные поля</td>
	<td>
		{sb_button text=Отправить class=ok id=alogin submit=true}
	</td>
    <td>&nbsp;</td>
</tr>
</table>
</form>
<b>Что произойдёт после того, как Вы добавили протест?</b><br />
  Администраторы получат уведомление о Вашем протесте. Они пересмотрят его в течении 24 часов.<br /><br />
  <b>Внимание:</b> Отправка e-mail с угрозами, бранью и криками на администрацию не помогут Вам. Ваш протест будет удалён.
</div>
