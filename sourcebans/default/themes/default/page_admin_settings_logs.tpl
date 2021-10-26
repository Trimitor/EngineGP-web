<h3 align="left">Системный лог {$clear_logs}</h3>
Нажмите на строку, чтобы увидеть более подробную информацию о событии.
<br /><br />
{php} require (TEMPLATES_PATH . "/admin.log.search.php");{/php}

<div id="banlist-nav">{$page_numbers}</div>
<br /><br />

<table width="100%" cellspacing="0" cellpadding="0" align="center" class="listtable">
	<tr>
		<td width="5%" height="16" class="listtable_top" align="center"><b>Тип</b></td>
		<td width="28%" height="16" class="listtable_top" align="center"><b>Событие</b></td>
		<td width="28%" height="16" class="listtable_top" align="center"><b>Пользователь</b></td>
		<td width="" height="16" class="listtable_top"><b>Дата/Время</b></td>
	</tr>

	{foreach from="$log_items" item="log"}
	<tr class="opener tbl_out" onmouseout="this.className='tbl_out'" onmouseover="this.className='tbl_hover'">
	    <td height="16" align="center" class="listtable_1">{$log.type_img}</td>
	    <td height="16" class="listtable_1">{$log.title}</td>
	    <td height="16" class="listtable_1">{$log.user}</td>
	    <td height="16" class="listtable_1">{$log.date_str}</td>
	</tr>
	<tr> 
        <td colspan="7" align="center">
          <div class="opener"> 
			<table width="80%" cellspacing="0" cellpadding="0" class="listtable">
          		<tr>
            		<td height="16" align="left" class="listtable_top" colspan="3">
						<b>Детали события</b>           
					</td>
          		</tr>
          		<tr align="left">
            		<td width="20%" height="16" class="listtable_1">Детали</td>
            		<td height="16" class="listtable_1">{$log.message}</td>
            	</tr>
            	<tr align="left">
            		<td width="20%" height="16" class="listtable_1">Родитель функции</td>
            		<td height="16" class="listtable_1">{$log.function}</td>
            	</tr>
            	<tr align="left">
            		<td width="20%" height="16" class="listtable_1">Строка запроса</td>
            		<td height="16" class="listtable_1">{textformat wrap=62 wrap_cut=true}{$log.query}{/textformat}</td>
            	</tr>
            	<tr align="left">
            		<td width="20%" height="16" class="listtable_1">IP</td>
            		<td height="16" class="listtable_1">{$log.host}</td>
            	</tr>
            </table>
          </div>
        </td>
     </tr>
    {/foreach}
</table>
<script type="text/javascript">
	InitAccordion('tr.opener', 'div.opener', 'mainwrapper');
</script>
