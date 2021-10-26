<div>
<h3>Список серверов</h3>
{if $IN_SERVERS_PAGE && $access_bans}<div style="text-align:right; width:100%;"><small>Подсказка: Нажмите правой кнопкой мыши на имени игрока для вызова контекстного меню.</small></div>{/if}
			<table width="98%" cellspacing="0" cellpadding="0" align="center" class="sortable listtable" style="margin-top:3px;">
			<thead>
			  <tr>
				<td width="2%" height="16" class="listtable_top">МОД</td>
				<td width="2%" height="16" class="listtable_top">ОС</td>
				<td width="2%" height="16" class="listtable_top">VAC</td>
				<td height="16" class="listtable_top" align="center"><b>Имя сервера</b></td>
				<td width="10%" height="16" class="listtable_top"><b>Игроки</b></td>
				<td width="10%" height="16" class="listtable_top"><b>Карта</b></td>
			  </tr>
			 </thead>
			 <tbody>
			{foreach from=$server_list item=server}
				  <tr id="opener_{$server.sid}" class="opener tbl_out" style="cursor:pointer;" onmouseout="this.className='tbl_out'" onmouseover="this.className='tbl_hover'"{if !$IN_SERVERS_PAGE} onclick="{$server.evOnClick}"{/if}>
		            <td height="16" align="center" class="listtable_1"><img src="images/games/{$server.icon}" border="0" /></td>
		            <td height="16" align="center" class="listtable_1" id="os_{$server.sid}"></td>
		            <td height="16" align="center" class="listtable_1" id="vac_{$server.sid}"></td>
		            <td height="16" class="listtable_1" id="host_{$server.sid}"><i>Запрос данных с сервера...</i></td>
		            <td height="16" class="listtable_1" id="players_{$server.sid}">Н/Д</td>
		            <td height="16" class="listtable_1" id="map_{$server.sid}">Н/Д</td>
		          </tr>
				  <tr>
		          	<td colspan="7" align="center">
		          	
		       			{if $IN_SERVERS_PAGE}
			       			<div class="opener">
								<div id="serverwindow_{$server.sid}">
				       				<div id="sinfo_{$server.sid}">
				       				 <table width="90%" border="0" class="listtable">
										  <tr>
										    <td class="listtable_2" valign="top">
											    <table width="100%" border="0" class="listtable" id="playerlist_{$server.sid}" name="playerlist_{$server.sid}">
											    </table>
										    </td>
										    <td width="355px" class="listtable_2 opener" valign="top">
										    	<img id="mapimg_{$server.sid}" height='255' width='340' src='images/maps/nomap.jpg'>
										    	<br />
										    	<br />
										    	<div align='center'>
										    		<b>IP:Port - {$server.ip}:{$server.port}</b> <br \>
										    		<input type='submit' onclick="document.location = 'steam://connect/{$server.ip}:{$server.port}'" name='button' class='btn game' style='margin:0px;' id='button' value='Подключиться' />
													<input type='button' onclick="ShowBox('Загрузка..','<b>Обновление данных с сервера...</b><br><i>Пожалуйста ждите!</i>', 'blue', '', true);document.getElementById('dialog-control').setStyle('display', 'none');xajax_RefreshServer({$server.sid});" name='button' class='btn refresh' style='margin:0;' id='button' value='Обновить' />
										    	</div>
										    	<br />
										    </td>
										</tr>
									</table>
								  </div>
								  <div id="noplayer_{$server.sid}" name="noplayer_{$server.sid}" style="display:none;">
									<h3>No players in the server</h3>
									<div align='center'>
										<b>IP:Port - {$server.ip}:{$server.port}</b> <input type='submit' onclick="document.location = 'steam://connect/{$server.ip}:{$server.port}'" name='button' class='btn game' style='margin:0;' id='button' value='Подключиться' />
										<input type='button' onclick="ShowBox('Загрузка..','<b>Обновление данных с сервера...</b><br><i>Пожалуйста ждите!</i>', 'blue', '', true);document.getElementById('dialog-control').setStyle('display', 'none');xajax_RefreshServer({$server.sid});" name='button' class='btn refresh' style='margin:0;' id='button' value='Обновить' />
									</div>
								  </div>
							  </div>
							</div>
						{/if}
						
						</td>
					</tr>
				{/foreach}
				</tbody>
				</table>
	</div>


{if $IN_SERVERS_PAGE}
	<script type="text/javascript">
		InitAccordion('tr.opener', 'div.opener', 'mainwrapper');
	</script>
{/if}
