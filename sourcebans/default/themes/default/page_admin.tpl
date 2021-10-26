<h3>Выберите опцию.</h3>
<div id="cpanel">
	<ul>
		{if $access_admins}
			<li>
				<a href="index.php?p=admin&amp;c=admins">
				<img src="themes/default/images/admin/admins.png" alt="Настройки админов" border="0" /><br />
				Настройки админов
		  		</a>
			</li>
		{/if}
		{if $access_servers}
			<li>
				<a href="index.php?p=admin&amp;c=servers">
				<img src="themes/default/images/admin/servers.png" alt="Настройки серверов" border="0" /><br />
				Настройки серверов
		  		</a>
			</li>
		{/if}
		{if $access_bans}
			<li>
				<a href="index.php?p=admin&amp;c=bans">
				<img src="themes/default/images/admin/bans.png" alt="Редактировать баны" border="0" /><br />
				Редактировать баны
		  		</a>
			</li>
		{/if}
		{if $access_groups}
			<li>
				<a href="index.php?p=admin&amp;c=groups">
				<img src="themes/default/images/admin/groups.png" alt="Редактировать группы" border="0" /><br />
				Настройки групп
		  		</a>
			</li>
		{/if}
		{if $access_settings}
			<li>
				<a href="index.php?p=admin&amp;c=settings">
				<img src="themes/default/images/admin/settings.png" alt="Настройки SourceBans" border="0" /><br />
				Настройки ВЕБ панели
		  		</a> 
			</li>
		{/if}
		{if $access_mods}
			<li>
				<a href="index.php?p=admin&amp;c=mods">
				<img src="themes/default/images/admin/mods.png" alt="МОДы" border="0" /><br />
				Управление МОДами
		  		</a>
			</li>
		{/if}
	</ul>
</div>	
<br />

<table width="100%" border="0" cellpadding="3" cellspacing="0">
	<tr>
		<td width="33%" align="center"><h3>Информация о версии</h3></td>
		<td width="33%" align="center"><h3>Информация о админах</h3></td>
		<td width="33%" align="center"><h3>Информация о банах</h3></td>
	</tr>
	<tr>
		<td>Последняя версия: <strong id='relver'>Ждите...</strong></td>
		<td>Всего админов: <strong>{$total_admins}</strong></td>
		<td>Всего банов: <strong>{$total_bans}</strong></td>
	</tr>
	<tr>
		<td>
			{if $sb_svn}
				Последняя SVN версия: <strong id='svnrev'>Ждите...</strong>
			{/if}		
		</td>
		<td>&nbsp;</td>
		<td>Connection blocks: <strong>{$total_blocks}</strong></td>
	</tr>
	<tr>
		<td id='versionmsg'>Ждите...</td>
		<td> <strong> </strong></td>
		<td>Общий размер загруженных демо: <strong>{$demosize}</td>
	</tr>
	<tr>
		<td width="33%" align="center"><h3>Информация о серверах</h3></td>
		<td width="33%" align="center"><h3>Информация о протестах</h3></td>
		<td width="33%" align="center"><h3>Информация о предложенных банах</h3></td>
	</tr>
	<tr>
		<td>Всего серверов: <strong>{$total_servers}</strong></td>
		<td>Всего протестов банов: <strong>{$total_protests}</strong></td>
		<td>Всего заявок на  бан: <strong>{$total_submissions}</strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Протестов в архива: <strong>{$archived_protests}</strong></td>
		<td>Заявок на  бан в архиве: <strong>{$archived_submissions}</strong></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<script type="text/javascript">xajax_CheckVersion();</script>