<form action="" method="post">
    <input type="hidden" name="settingsGroup" value="features" />
    <table width="99%" border="0" style="border-collapse:collapse;" id="group.features" cellpadding="3">
        <tr>
            <td valign="top" colspan="2"><h3>Опции банов</h3>За дополнительной информацией или помощью наведите курсор мыши на знак вопроса.<br /><br /></td>
        </tr>
        <tr>
            <td valign="top" width="35%"><div class="rowdesc">{help_icon title="Возможность скачать банлист" message="Включите это, чтобы пользователи могли скачать список банов."}Публикация банов</div></td>
            <td>
                <div align="left">
                   <input type="checkbox" name="export_public" id="export_public" />
                </div>
            </td>
        </tr>
        <tr>
            <td valign="top"><div class="rowdesc">{help_icon title="Кикать игрока" message="Включено - забаненный игрок будет кикаться с сервера при следующих попытках захода на сервер."}Кикать игрока</div></td>
            <td>
                <div align="left">
                   <input type="checkbox" name="enable_kickit" id="enable_kickit" />
                </div>
            </td>
        </tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Включить бан групп" message="Включите, для возможности бана групп сообщества Steam."}Бан групп</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" name="enable_groupbanning" id="enable_groupbanning" />
		    	</div>
		    	<div id="enable_groupbanning.msg" class="badentry"></div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Бан друзей" message="Возможность банить друзей игрока из профиля сообщества Steam."}Бан друзей</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" name="enable_friendsbanning" id="enable_friendsbanning" />
		    	</div>
		    	<div id="enable_friendsbanning.msg" class="badentry"></div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Обновление админов" message="Включено - при добавлении админа на сервер отправляется команда "sm_rehash", что позволяет обновлять админов на сервере моментально."}Автообновление админов</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" name="enable_adminrehashing" id="enable_adminrehashing" />
		    	</div>
		    	<div id="enable_adminrehashing.msg" class="badentry"></div>
		    </td>
		</tr>
        <tr>
            <td colspan="2" align="center">
                {sb_button text="Сохранить" class="ok" id="fsettings" submit=true}
                &nbsp;
                {sb_button text="Назад" class="cancel" id="fback"}
            </td>
        </tr>
    </table>
</form>
