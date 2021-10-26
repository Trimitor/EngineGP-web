{if $comment}
<h3>{$commenttype} Комментарий</h3>
<table width="90%" align="center" border="0" style="border-collapse:collapse;" id="group.details" cellpadding="3">
  <tr>
	<td valign="top"><div class="rowdesc">{help_icon title="Текст комментария" message="Введите текст комментария."}Комментарий</div></td>
  </tr>
  <tr>
	<td><div align="left">
		<textarea rows="10" cols="60" class="submit-fields" style="width:500px;" id="commenttext" name="commenttext">{$commenttext}</textarea>
	  </div>
		<div id="commenttext.msg" class="badentry"></div></td>
  </tr>
  <tr>
	<td>
		<input type="hidden" name="bid" id="bid" value="{$comment}">
		<input type="hidden" name="ctype" id="ctype" value="{$ctype}">
		{if $cid != ""}
			<input type="hidden" name="cid" id="cid" value="{$cid}">
		{else}
			<input type="hidden" name="cid" id="cid" value="-1">
		{/if}
		<input type="hidden" name="page" id="page" value="{$page}">
		{sb_button text="$commenttype комментарий" onclick="ProcessComment();" class="ok" id="acom" submit=false}&nbsp;
		{sb_button text="Назад" onclick="history.go(-1)" class="cancel" id="aback"}
	</td>
  </tr>
  {foreach from="$othercomments" item="com"}
  <tr>
	<td colspan='3'>
		<hr>
	</td>
  </tr>
  <tr>
	<td>
		<b>{$com.comname}</b></td><td align="right"><b>{$com.added}</b>
	</td>
  </tr>
  <tr>
	<td colspan='2'>
		{$com.commenttxt}
	</td>
  </tr>
  {if $com.editname != ''}
  <tr>
	<td colspan='3'>
		<span style='font-size:6pt;color:grey;'>Последнее редактирование: {$com.edittime} админом {$com.editname}</span>
	</td>
  </tr>
  {/if}
  {/foreach}
</table>
{else}
<h3 align="left">Обзор банлиста - <i>Всего банов: {$total_bans}</i></h3>
<br />
{php} require (TEMPLATES_PATH . "/admin.bans.search.php");{/php}
<br />
<div id="banlist-nav"> 
{$ban_nav}
</div>
<a href="index.php?p=banlist&hideinactive={if $hidetext == 'Скрыть'}true{else}false{/if}{$searchlink|htmlspecialchars}" title="{$hidetext} неактивные">{$hidetext} неактивные</a>
<div id="banlist">
	<table width="100%" cellspacing="0" cellpadding="0" align="center" class="listtable">
		<tr>
			{if $view_bans}
			<td height="16" class="listtable_1" style="padding:0px;width:3px;" align="center"><div class="ok" style="height:16px;width:16px;cursor:pointer;" title="Выбрать все" name="tickswitch" id="tickswitch" onclick="TickSelectAll()"></div></td>
			{/if}
			<td width="12%" height="16" class="listtable_top" align="center"><b>МОД/Страна</b></td>
			<td width="14%" height="16" class="listtable_top" align="center"><b>Дата</b></td>
			<td height="16" class="listtable_top"><b>Игрок</b></td>
			{if !$hideadminname}
			<td width="10%" height="16" class="listtable_top"><b>Админ</b></td>
			{/if}
			<td width="10%" height="16" class="listtable_top" align="center"><b>Срок</b></td>  
		</tr>
		{foreach from=$ban_list item=ban name=banlist}
			<tr class="opener tbl_out" onmouseout="this.className='tbl_out'" onmouseover="this.className='tbl_hover'" 
			{if $ban.server_id != 0}
				onclick="xajax_ServerHostPlayers({$ban.server_id}, {$ban.ban_id});"
			{/if}
			>
		{if $view_bans}
		<td height="16" align="center" class="listtable_1" style="padding:0px;width:3px;"><input type="checkbox" name="chkb_{$smarty.foreach.banlist.index}" id="chkb_{$smarty.foreach.banlist.index}" value="{$ban.ban_id}"></td>
        {/if}
		<td height="16" align="center" class="listtable_1">{$ban.mod_icon}</td>
        <td height="16" align="center" class="listtable_1">{$ban.ban_date}</td>
        <td height="16" class="listtable_1">
		  <div style="float:left;">
          {if empty($ban.player)}
            <i><font color="#677882">Ник не предоставлен</font></i>
          {else}
            {$ban.player|escape:'html'|stripslashes}
          {/if}
		  </div>
		  {if $ban.demo_available}
		  <div style="float:right;">
		  {$ban.commentdata|@count} <img src="images/details.gif" alt="Комментарии" title="Комментарии" style="height:12px;width:12px;" />
		  </div>
		  {/if}
        </td>
		{if !$hideadminname}
        <td height="16" class="listtable_1">
        {if !empty($ban.admin)}
            {$ban.admin|escape:'html'}
        {else}
            <i><font color="#677882">Админ удалён</font></i>
        {/if}
        </td>
		{/if}
        <td width="20%" height="16" align="center" class="{$ban.class}">{$ban.banlength}</td>
			</tr>
			<!-- ###############[ Start Sliding Panel ]################## -->
			<tr>
        <td colspan="7" align="center">
          <div class="opener"> 
						<table width="80%" cellspacing="0" cellpadding="0" class="listtable">
              <tr>
                <td height="16" align="left" class="listtable_top" colspan="3">
									<b>Детали бана</b>            
								</td>
              </tr>
              <tr align="left">
                <td width="20%" height="16" class="listtable_1">Игрок</td>
                <td height="16" class="listtable_1">
                  {if empty($ban.player)}
                    <i><font color="#677882">Ник не предоставлен</font></i>
                  {else}
                    {$ban.player|escape:'html'|stripslashes}
                  {/if}
                </td>
                <!-- ###############[ Start Admin Controls ]################## -->
                {if $view_bans}
                <td width="30%" rowspan="{if $ban.unbanned}14{else}12{/if}" class="listtable_2 opener">
                  <div class="ban-edit">
                    <ul>
					  {if $ban.unbanned && $ban.reban_link != false}
					  <li>{$ban.reban_link}</li>
					  {/if}
                      <li>{$ban.demo_link}</li>
                      <li>{$ban.addcomment}</li>
					  {if $ban.type == 0}
					  {if $groupban}
					  <li>{$ban.groups_link}</li>
					  {/if}
					  {if $friendsban}
					  <li>{$ban.friend_ban_link}</li>
					  {/if}
					  {/if}
                      {if ($ban.view_edit && !$ban.unbanned)} 
                      <li>{$ban.edit_link}</li>
                      {/if}
                      {if ($ban.unbanned == false && $ban.view_unban)}
                      <li>{$ban.unban_link}</li>
                      {/if}
                      {if $ban.view_delete}
                      <li>{$ban.delete_link}</li>
                      {/if}
                    </ul>
                  </div>
                </td>
                {else}
                <td width="30%" rowspan="{if $ban.unbanned}13{else}11{/if}" class="listtable_2 opener">
                  <div class="ban-edit">
                    <ul>
                      <li>{$ban.demo_link}</li>
                    </ul>
                  </div>
                </td>
                {/if}
                <!-- ###############[ End Admin Controls ]##################### -->
              </tr>
              <tr align="left">
                <td width="20%" height="16" class="listtable_1">Steam ID</td>
                <td height="16" class="listtable_1">
                  {if empty($ban.steamid)}
                    <i><font color="#677882">Steam ID не предоставлен</font></i>
                  {else}
                    {$ban.steamid}
                  {/if}
                </td>
              </tr>
              {if $ban.type == 0}
              <tr align="left">
                <td width="20%" height="16" class="listtable_1">Steam Community</td>
                <td height="16" class="listtable_1"><a href="http://steamcommunity.com/profiles/{$ban.communityid}" target="_blank">{$ban.communityid}</a></td>
              </tr>
              {/if}
              {if !$hideplayerips}
              <tr align="left">
                <td width="20%" height="16" class="listtable_1">IP address</td>
                <td height="16" class="listtable_1">
                  {if $ban.ip == "none"}
                    <i><font color="#677882">IP адрес не предоставлен</font></i>
                  {else}
                    {$ban.ip}
                  {/if}
                </td>
              </tr>
              {/if}
              <tr align="left">
								<td width="20%" height="16" class="listtable_1">Забанен</td>
								<td height="16" class="listtable_1">{$ban.ban_date}</td>
					        </tr>
					        <tr align="left">
					            <td width="20%" height="16" class="listtable_1">Срок</td>
					            <td height="16" class="listtable_1">{$ban.banlength}</td>
					        </tr>
							{if $ban.unbanned}
							<tr align="left">
					            <td width="20%" height="16" class="listtable_1">Причина разбана</td>
					            <td height="16" class="listtable_1">
								{if $ban.ureason == ""}
									<i><font color="#677882">Причина не указана</font></i>
								{else}
									{$ban.ureason}
								{/if}
								</td>
					        </tr>
							 <tr align="left">
					            <td width="20%" height="16" class="listtable_1">Разбанен админом</td>
					            <td height="16" class="listtable_1">
                                    {if !empty($ban.removedby)}
										{$ban.removedby|escape:'html'}
									{else}
										<i><font color="#677882">Админ удален.</font></i>
									{/if}
                                </td>
					        </tr>
							{/if}
					        <tr align="left">
					            <td width="20%" height="16" class="listtable_1">Истекает</td>
					            <td height="16" class="listtable_1">
					            	{if $ban.expires == "never"}
		     							<i><font color="#677882">Никогда.</font></i>
		     						{else}
		     							{$ban.expires}
		     						{/if}
		     					</td>
							</tr>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Причина</td>
								<td height="16" class="listtable_1">{$ban.reason|escape:'html'}</td>
							</tr>
							{if !$hideadminname}
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Забанен админом</td>
								<td height="16" class="listtable_1">
									{if !empty($ban.admin)}
										{$ban.admin|escape:'html'}
									{else}
										<i><font color="#677882">Админ удалён.</font></i>
									{/if}
								</td>
							</tr>
							{/if}
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Забанен на сервере</td>
								<td height="16" class="listtable_1" id="ban_server_{$ban.ban_id}">
									{if $ban.server_id == 0}
										ВЕб бан
									{else}
										Ждите...
									{/if}
								</td>
							</tr>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Всего банов</td>
								<td height="16" class="listtable_1">{$ban.prevoff_link}</td>
							</tr>
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Блокировок ({$ban.blockcount})</td>
								<td height="16" class="listtable_1">
								{if $ban.banlog == ""}
									<i><font color="#677882">0</font></i>
								{else}
									{$ban.banlog}
								{/if}
								</td>
							</tr>
							{if $view_comments}
							<tr align="left">
								<td width="20%" height="16" class="listtable_1">Комментарии</td>
								<td height="60" class="listtable_1" colspan="2">
								{if $ban.commentdata != "Отсутствуют"}
								<table width="100%" border="0">
									{foreach from=$ban.commentdata item=commenta}
									 {if $commenta.morecom}
									  <tr>
										<td colspan='3'>
											<hr>
										</td>
									  </tr>
									 {/if}
									  <tr>
										<td>
											{if !empty($commenta.comname)}
                                                <b>{$commenta.comname|escape:'html'}</b>
                                            {else}
                                                <i><font color="#677882">Админ удалён</font></i>
                                            {/if}
										</td>
										<td align="right">
											<b>{$commenta.added}</b>
										</td>
										{if $commenta.editcomlink != ""}
										<td align="right">
											{$commenta.editcomlink} {$commenta.delcomlink}
										</td>
										{/if}
									  </tr>
									  <tr>
										<td colspan='3'>
											{$commenta.commenttxt}
										</td>
									  </tr>
									  {if !empty($commenta.edittime)}
									  <tr>
										<td colspan='3'>
											<span style="font-size:6pt;color:grey;">Последнее редактирование: {$commenta.edittime} админом {if !empty($commenta.editname)}{$commenta.editname}{else}<i><font color="#677882">Админ удален</font></i>{/if}</span>
										</td>
									  </tr>
									  {/if}
									  {/foreach}
								</table>
								{/if}
								{if $ban.commentdata == "Отсутствуют"}
									{$ban.commentdata}
								{/if}
								</td>
							</tr>
							{/if}
						</table>	
					</div>
          		</td>
          	</tr>
          	<!-- ###############[ End Sliding Panel ]################## -->
		{/foreach}
	</table>
	{if $general_unban || $can_delete}
	&nbsp;&nbsp;L&nbsp;&nbsp;<a href="#" onclick="TickSelectAll();return false;" title="Выбрать все" name="tickswitchlink" id="tickswitchlink">Выбрать все</a>&nbsp;&nbsp;|&nbsp;
	<select name="bulk_action" id="bulk_action" onchange="BulkEdit(this,'{$admin_postkey}');">
		<option value="-1">Действия</option>
		{if $general_unban}
		<option value="U">Разбанить</option>
		{/if}
		{if $can_delete}
		<option value="D">Удалить</option>
		{/if}
	</select>
	<hr>
	{/if}
	{if $can_export }
		<a href="./exportbans.php?type=steam" title="Export Permanent SteamID Bans">Экспрот перманентных банов SteamID</a>&nbsp;&nbsp;|&nbsp;
		<a href="./exportbans.php?type=ip" title="Export Permanent IP Bans">Экспрот перманентных банов IP</a>
	{/if}
</div>
{literal}
<script type="text/javascript">window.addEvent('domready', function(){	
InitAccordion('tr.opener', 'div.opener', 'mainwrapper');
{/literal}
{if $view_bans}
$('tickswitch').value=0;
{/if}
{literal}
}); 
</script>
{/literal}
{/if}
