<div align="center">
	<table width="80%" cellpadding="0" class="listtable" cellspacing="0">
		<tr class="sea_open">
			<td width="2%" height="16" class="listtable_top" colspan="3"><b>Расширенный поиск...</b></td>
	  	</tr>
	  	<tr>
	  		<td>
	  		<div class="panel">
	  			<table width="100%" cellpadding="0" class="listtable" cellspacing="0">
			    <tr>
					<td class="listtable_1" width="8%" align="center"><input id="name" name="search_type" type="radio" value="name"></td>
			        <td class="listtable_1" width="26%">Ник</td>
			        <td class="listtable_1" width="66%"><input type="text" id="nick" value="" onmouseup="$('name').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;"></td>
				</tr>       
			    <tr>
			        <td align="center" class="listtable_1" ><input id="steam_" type="radio" name="search_type" value="radiobutton"></td>
			        <td class="listtable_1" >Steam ID</td>
			        <td class="listtable_1" >
			            <input type="text" id="steamid" value="" onmouseup="$('steam_').checked = true"style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 150px;"><select id="steam_match" onmouseup="$('steam_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 100px;">
				        <option label="exact" value="0" selected>Точное совпадение</option>
				        <option label="partial" value="1">Частичное совпадение</option>
				    </select>
				</td>
			    </tr>
				{if !$hideplayerips}
				<tr>
					<td align="center" class="listtable_1" ><input id="ip_" type="radio" name="search_type" value="radiobutton"></td>
					<td class="listtable_1" >IP</td>
					<td class="listtable_1" ><input type="text" id="ip" value="" onmouseup="$('ip_').checked = true"style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;"></td>
				</tr>
				{/if}
			    <tr>
			        <td align="center" class="listtable_1" ><input id="reason_" type="radio" name="search_type" value="radiobutton"></td>
			        <td class="listtable_1" >Причина</td>
			        <td class="listtable_1" ><input type="text" id="ban_reason" value="" onmouseup="$('reason_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;"></td>
			    </tr>
				<tr>
					<td align="center" class="listtable_1" ><input id="date" type="radio" name="search_type" value="radiobutton"></td>
			        <td class="listtable_1" >Дата</td>
			        <td class="listtable_1" >
			        	<input type="text" id="day" value="ДД" onmouseup="$('date').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 75px;">
			            <input type="text" id="month" value="ММ" onmouseup="$('date').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 75px;">
			            <input type="text" id="year" value="ГГ" onmouseup="$('date').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 75px;"> 
			        </td>
			  	</tr>
				<tr>
			        <td align="center" class="listtable_1" ><input id="length_" type="radio" name="search_type" value="radiobutton"></td>
			        <td class="listtable_1" >Срок</td>
			        <td class="listtable_1" >
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
						            <select id="length_type" onmouseup="$('length_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 40px;">
										<option value="e" title="equal to">=</option>
										<option value="h" title="greater">&gt;</option>
										<option value="l" title="smaller">&lt;</option>
										<option value="eh" title="equal to or greater">&gt;=</option>
										<option value="el" title="equal to or smaller">&lt;=</option>
									</select>
								</td>
								<td>
									<input type="text" id="other_length" name="other_length" onmouseup="$('length_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 190px;display:none;">
								</td>
								<td>
									<select id="length" onmouseup="$('length_').checked = true" onchange="switch_length(this);" onmouseover="if(this.options[this.selectedIndex].value=='other')$('length').setStyle('width', '210px');if(this.options[this.selectedIndex].value=='other')this.focus();" onblur="if(this.options[this.selectedIndex].value=='other')$('length').setStyle('width', '20px');" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 210px;">
								        <option value="0">Навсегда</option>
										<optgroup label="минуты">
											<option value="1">1 минута</option>
											<option value="5">5 минут</option>
											<option value="10">10 минут</option>
											<option value="15">15 минут</option>
											<option value="30">30 минут</option>
											<option value="45">45 минут</option>
										</optgroup>
										<optgroup label="часы">
											<option value="60">1 час</option>
											<option value="120">2 часа</option>
											<option value="180">3 часа</option>
											<option value="240">4 часа</option>
											<option value="480">8 часов</option>
											<option value="720">12 часов</option>
										</optgroup>
										<optgroup label="дни">
											<option value="1440">1 день</option>
											<option value="2880">2 дня</option>
											<option value="4320">3 дня</option>
											<option value="5760">4 дня</option>
											<option value="7200">5 дней</option>
											<option value="8640">6 дней</option>
										</optgroup>
										<optgroup label="недели">
											<option value="10080">1 неделя</option>
											<option value="20160">2 недели</option>
											<option value="30240">3 недели</option>
										</optgroup>
										<optgroup label="месяцы">
											<option value="40320">1 месяц</option>
											<option value="80640">2 месяца</option>
											<option value="120960">3 месяца</option>
											<option value="241920">6 месяцев</option>
											<option value="483840">12 месяцев</option>
										</optgroup>
										<option value="other">Другой срок в минутах</option>
									</select>
								</td>
							</tr>
						</table>
					</td>
			    </tr>
				<tr>
			        <td align="center" class="listtable_1" ><input id="ban_type_" type="radio" name="search_type" value="radiobutton"></td>
			        <td class="listtable_1" >Тип</td>
			        <td class="listtable_1" >
			            <select id="ban_type" onmouseup="$('ban_type_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;">
					        <option value="0" selected>Steam ID</option>
					        <option value="1">IP адрес</option>
						</select>
					</td>
			    </tr>
                {if !$hideadminname}
			    <tr>
			    	<td class="listtable_1"  align="center"><input id="admin" name="search_type" type="radio" value="radiobutton"></td>
			        <td class="listtable_1" >Админ</td>
			        <td class="listtable_1" >
						<select id="ban_admin" onmouseup="$('admin').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;">
							{foreach from="$admin_list" item="admin}
								<option label="{$admin.user}" value="{$admin.aid}">{$admin.user}</option>
							{/foreach}
						</select>           
					</td> 
				</tr>
                {/if}
			    <tr>
			    	<td class="listtable_1"  align="center"><input id="where_banned" name="search_type" type="radio" value="radiobutton"></td>
					<td class="listtable_1" >Сервер</td>
			        <td class="listtable_1" >
						<select id="server" onmouseup="$('where_banned').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;">
						<option label="Web Ban" value="0">ВЕб бан</option>
							{foreach from="$server_list" item="server}
								<option value="{$server.sid}" id="ss{$server.sid}">Получение имени хоста... ({$server.ip}:{$server.port})</option>
							{/foreach}
						</select>            
					</td>
			    </tr>
				{if $is_admin}
				<tr>
			        <td align="center" class="listtable_1" ><input id="comment_" type="radio" name="search_type" value="radiobutton"></td>
			        <td class="listtable_1" >Комментарий</td>
			        <td class="listtable_1" ><input type="text" id="ban_comment" value="" onmouseup="$('comment_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;"></td>
			    </tr>
				{/if}
			    <tr>
				    <td> </td>
				    <td> </td>
			        <td>{sb_button text="Поиск" onclick="search_bans();" class="ok" id="searchbtn" submit=false}</td>
			    </tr>
			   </table>
			   </div>
		  </td>
		</tr>
	</table>
</div>
{$server_script}
<script>InitAccordion('tr.sea_open', 'div.panel', 'mainwrapper');</script>
