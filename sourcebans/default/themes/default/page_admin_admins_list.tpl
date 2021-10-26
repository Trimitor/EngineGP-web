{if not $permission_listadmin}
	Access Denied
{else}

<h3>Администраторы (<span id="admincount">{$admin_count}</span>)</h3>
Нажмите на администратора, чтобы увидеть более подробную информацию.<br /><br />

{php} require (TEMPLATES_PATH . "/admin.admins.search.php");{/php}

<div id="banlist-nav"> 
{$admin_nav}
</div>
<div id="banlist">
<table width="99%" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td width="34%" class="listtable_top"><b>Имя</b></td>
		<td width="33%" class="listtable_top"><b>Группа доступа к серверу </b></td>
		<td width="33%" class="listtable_top"><b>Группа доступа к ВЕб-панели</b></td>
	</tr>
	{foreach from="$admins" item="admin"}
		<tr onmouseout="this.className='tbl_out'" onmouseover="this.className='tbl_hover'" class="tbl_out opener">
			<td class="admin-row" style="padding:3px;">{$admin.user} (<a href="./index.php?p=banlist&advSearch={$admin.aid}&advType=admin" title="Показать баны">{$admin.bancount} банов</a> | <a href="./index.php?p=banlist&advSearch={$admin.aid}&advType=nodemo" title="Показать баны без демо">{$admin.nodemocount} банов б.д.</a>)</td>
			<td class="admin-row" style="padding:3px;">{$admin.server_group}</td>
			<td class="admin-row" style="padding:3px;">{$admin.web_group}</td>
 		</tr>
		<tr>
			<td colspan="3">
				<div class="opener" align="center" border="1">
					<table width="100%" cellspacing="0" cellpadding="3" bgcolor="#eaebeb">
						<tr>
			            	<td align="left" colspan="3" class="front-module-header">
								<b>Информация об администраторе {$admin.user}</b>
							</td>
			          	</tr>
			          	<tr align="left">
				            <td width="35%" class="front-module-line"><b>Права доступа к серверу</b></td>
				            <td width="35%" class="front-module-line"><b>Права доступа к ВЕБ панели</b></td>
				            <td width="30%" valign="top" class="front-module-line"><b>Действие</b></td>
			          	</tr>
			          	<tr align="left">
				            <td valign="top">{$admin.server_flag_string}</td>
				            <td valign="top">{$admin.web_flag_string}</td>
				            <td width="30%" valign="top">
								<div class="ban-edit">
						        	<ul>
						        	{if $permission_editadmin}
							        	<li>
							        		<a href="index.php?p=admin&c=admins&o=editdetails&id={$admin.aid}"><img src="images/details.png" border="0" alt="" style="vertical-align:middle"/> Детали</a>
							        	</li>
							        	<li>
							        		<a href="index.php?p=admin&c=admins&o=editpermissions&id={$admin.aid}"><img src="images/permissions.png" border="0" alt="" style="vertical-align:middle" /> Права</a>
							        	</li>
							        	<li>
							        		<a href="index.php?p=admin&c=admins&o=editservers&id={$admin.aid}"><img src="images/server_small.png" border="0" alt="" style="vertical-align:middle" /> Доступ к серверу</a>
							        	</li>
							        	<li>
							        		<a href="index.php?p=admin&c=admins&o=editgroup&id={$admin.aid}"><img src="images/groups.png" border="0" alt="" style="vertical-align:middle" /> Группы</a>
							        	</li>
						        	{/if}
						        	{if $permission_deleteadmin}
						            	<li>
							        		<a href="#" onclick="RemoveAdmin({$admin.aid}, '{$admin.user}');"><img src="images/delete.png" border="0" alt="" style="vertical-align:middle" /> Удалить админа</a>
							        	</li>
						            {/if}
						          	</ul>
								</div>
							   	<div class="front-module-line" style="padding:3px;">Иммунитет: <b>{$admin.immunity}</b></div>
							   	<div class="front-module-line" style="padding:3px;">Последний визит: <b><small>{$admin.lastvisit}</small></b></div>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	{/foreach}
</table>
</div>
<script type="text/javascript">InitAccordion('tr.opener', 'div.opener', 'mainwrapper');</script>
{/if}
