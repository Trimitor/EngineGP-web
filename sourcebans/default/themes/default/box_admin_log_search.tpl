<div align="center">
	<table width="80%" cellpadding="0" class="listtable" cellspacing="0">
		<tr class="sea_open">
			<td width="2%" height="16" class="listtable_top" colspan="3"><b>Расширенный поиск<b></td>
	  	</tr>
	  	<tr>
	  		<td>
	  		<div class="panel">
	  			<table width="100%" cellpadding="0" class="listtable" cellspacing="0">
			    <tr>
					<td class="listtable_1" width="8%" align="center"><input id="admin_" name="search_type" type="radio" value="radiobutton"></td>
			        <td class="listtable_1" width="26%">Админ</td>
			        <td class="listtable_1" width="66%">
						<select id="admin" onmouseup="$('admin_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;">
							{foreach from="$admin_list" item="admin}
								<option label="{$admin.user}" value="{$admin.aid}">{$admin.user}</option>
							{/foreach}
						</select>    
					</td>
				</tr>
				 <tr>
					<td class="listtable_1" align="center"><input id="message_" name="search_type" type="radio" value="radiobutton"></td>
			        <td class="listtable_1">Сообщение</td>
			        <td class="listtable_1"><input type="text" id="message" value="" onmouseup="$('message_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;"></td>
				</tr>
			    <tr>
			        <td align="center" class="listtable_1" ><input id="date_" type="radio" name="search_type" value="radiobutton"></td>
			        <td class="listtable_1" >Дата</td>
				    <td class="listtable_1" >
			        	<input type="text" id="day" value="ДД" onmouseup="$('date_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 25px;">.<input type="text" id="month" value="ММ" onmouseup="$('date_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 25px;">.<input type="text" id="year" value="ГГГГ" onmouseup="$('date_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 40px;">
						&nbsp;<input type="text" id="fhour" value="00" onmouseup="$('date_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 25px;">:<input type="text" id="fminute" value="00" onmouseup="$('date_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 25px;">
						-&nbsp;<input type="text" id="thour" value="23" onmouseup="$('date_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 25px;">:<input type="text" id="tminute" value="59" onmouseup="$('date_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 25px;">
			        </td>
			    </tr>
			    <tr>
			        <td align="center" class="listtable_1" ><input id="type_" type="radio" name="search_type" value="radiobutton"></td>
			        <td class="listtable_1" >Тип</td>
			        <td class="listtable_1" >
						<select id="type" onmouseup="$('type_').checked = true" style="border: 1px solid #000000; font-size: 12px; background-color: rgb(215, 215, 215);width: 250px;">
							<option label="Message" value="m">Сообщение</option>
							<option label="Warning" value="w">Предупреждение</option>
							<option label="Error" value="e">Ошибка</option>
						</select>
					</td>
			    </tr>
			    <tr>
				    <td> </td>
				    <td> </td>
			        <td>{sb_button text="Поиск" onclick="search_log();" class="ok" id="searchbtn" submit=false}</td>
			    </tr>
			   </table>
			   </div>
		  </td>
		</tr>
	</table>
</div>
<script>InitAccordion('tr.sea_open', 'div.panel', 'mainwrapper');</script>