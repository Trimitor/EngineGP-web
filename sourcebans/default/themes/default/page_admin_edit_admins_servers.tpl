<form action="" method="post">
	<div id="admin-page-content">
		<div id="add-group">
			<h3>Доступ к серверу</h3>
			Выберите сервер или группу серверов.<br /><br />
			<table width="90%" border="0" cellspacing="0" cellpadding="4" align="center">
				{if $row_count < 1}
					<tr>
						<td colspan="3" class=""><b><i>Вам нужно добавить сервер или группу серверов, прежде, чем вы сможете настроить разрешения админов сервера</i></b></td>
					</tr>
				{else}
					<tr>
						<td colspan="3" class="tablerow4"><b><i>Группы серверов</i></b></td>
					</tr>
					{foreach from="$group_list" item="group"}			  
						<tr>
							<td colspan="2" class="tablerow1">{$group.name}</td>
							<td align="center" class="tablerow1"><input type="checkbox" id="group_{$group.gid}" name="group[]" value="g{$group.gid}" onclick="" /></td>
						</tr>
					{/foreach}
					<tr>
						<td colspan="3" class="tablerow4"><b><i>Серверы</i></b></td>
					</tr>
					{foreach from="$server_list" item="server"}
						<tr class="tablerow1">
				    		<td colspan="2" class="tablerow1" id="server_host_{$server.sid}">Ждите...</td>
				   			<td align="center" class="tablerow1">
								<input type="checkbox" name="servers[]" id="server_{$server.sid}" value="s{$server.sid}" onclick=""/>
				  			</td> 
				  		</tr>
				  	{/foreach}
				{/if}
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td align="center">
						{if $row_count > 0}
							{sb_button text="Сохранить" class="ok" id="editadminserver" submit=true}
							&nbsp;
						{/if}
		      			{sb_button text="Назад" onclick="history.go(-1)" class="cancel" id="aback"}
					</td>
				</tr>
			</table>
			<script>
			{foreach from="$assigned_servers" item="asrv"}
				if($('server_{$asrv.0}'))$('server_{$asrv.0}').checked = true;
				if($('group_{$asrv[1]}'))$('group_{$asrv[1]}').checked = true;
			{/foreach}
			{foreach from="$server_list" item="server"}
				xajax_ServerHostPlayers({$server.sid}, "id", "server_host_{$server.sid}");
			{/foreach}
			</script>
		</div>
	</div>
</form>
