{if NOT $permission_listmods}
	Access Denied!
{else}
	<h3>Список МОДов ({$mod_count})</h3>
	<table width="100%" cellpadding="1">
		<tr>
			<td width="50%" height='16' class="front-module-header"><strong>Имя</strong></td>
			<td width="25%" height='16' class="front-module-header"><strong>Папка</strong></td>
			<td width="10%" height='16' class="front-module-header"><strong>Иконка</strong></td>
			<td width="2%" height='16' class="front-module-header"><strong><span title="SteamID Universe (X of STEAM_X:Y:Z)">SU</span></strong></td>
			{if $permission_editmods || $permission_deletemods}
			<td height='16' class="front-module-header"><strong>Действия</strong></td>
			{/if}
		</tr>
		{foreach from="$mod_list" item="mod" name="gaben"}
			<tr id="mid_{$mod.mid}">
				<td style="border-bottom: solid 1px #ccc" height='16'>{$mod.name|htmlspecialchars}</td>
				<td style="border-bottom: solid 1px #ccc" height='16'>{$mod.modfolder|htmlspecialchars}</td>
				<td style="border-bottom: solid 1px #ccc" height='16'><img src="images/games/{$mod.icon}" width="16"></td>
				<td style="border-bottom: solid 1px #ccc" height='16'>{$mod.steam_universe|htmlspecialchars}</td>
				{if $permission_editmods || $permission_deletemods}
				<td style="border-bottom: solid 1px #ccc" height='16'>
					{if $permission_editmods}
					<a href="index.php?p=admin&c=mods&o=edit&id={$mod.mid}">Редактировать</a> - 
					{/if}
					{if $permission_deletemods}
					<a href="#" onclick="RemoveMod('{$mod.name|escape:'quotes'|htmlspecialchars}', '{$mod.mid}');">Удалить</a>
					{/if}
				</td>
				{/if}
			</tr>
		{/foreach}
	</table>
{/if}
