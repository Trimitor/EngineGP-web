<h3 align="left">Шаблоны</h3>
<div id="current-theme-holder">
	<h4 class="largetitle">Выбранный шаблон: <span id="theme.name">{$theme_name}</span></h4>
	<div id="current-theme-screenshot">
		{$theme_screenshot}
	</div>
	<div id="current-theme-details">
		<table width="98%" cellspacing="0" cellpadding="3" align="left">
			<tr>
				<td><b>Автор шаблона:</b></td>
			</tr>
			<tr>
				<td><div id="theme.auth">{$theme_author}</div></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><b>Версия:</b></td>
			</tr>
			<tr>
				<td><div id="theme.vers">{$theme_version}</div></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><b>Ссылка:</b></td>
			</tr>
			<tr>
				<td><div id="theme.link"><a href="{$theme_link}" target="_new">{$theme_link}</a></div></td>
			</tr>
			<tr>
				<td align="right"><div id="theme.apply"></div></td>
			</tr>
		</table>
	</div>	
</div>

<br />
<h4 class="largetitle">Доступные шаблоны</h4>
Кликните на шаблоне для просмотра деталей.<br /><br />
<div id="theme-list">
	<ul>
	{foreach from=$theme_list item=theme}
		<li><a href="javascript:void(0);" onclick="javascript:xajax_SelTheme('{$theme.dir}');"><b>{$theme.name}</b></a></li>
	{/foreach}
	</ul>
</div>
