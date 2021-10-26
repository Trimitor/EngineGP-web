<form action="" method="post">
	<input type="hidden" name="settingsGroup" value="mainsettings" />
	<table width="99%" border="0" style="border-collapse:collapse;" id="group.details" cellpadding="3">
		<tr>
		    <td valign="top" colspan="2"><h3>Главные настройки</h3>За дополнительной информацией или помощью наведите курсор мыши на знак вопроса.<br /><br /></td>
		 </tr>
		
		<tr>
		    <td valign="top"><div class="rowdesc">{help_icon title="Заголовок" message="Задайте заголовок."}Заголовок </div></td>
		    <td>
		    	<div align="left">
		      		<input type="text" TABINDEX=1 class="submit-fields" id="template_title" name="template_title" value="{$config_title}" />
		    	</div>
		    </td>
		</tr>
		
		<tr>
		    <td valign="top"><div class="rowdesc">{help_icon title="Путь к логотипу" message="Задайте путь до логотипа."}Путь к логотипу </div></td>
		    <td>
		    	<div align="left">
		      		<input type="text" TABINDEX=2 class="submit-fields" id="template_logo" name="template_logo" value="{$config_logo}" />
		    	</div>
		    </td>
		</tr>
		  
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Минимальная длина пароля" message="Задайте минимальную длину пароля."}Минимальная длина пароля </div></td>
			<td>
				<div align="left">
					<input type="text" TABINDEX=3 class="submit-fields" id="config_password_minlength" name="config_password_minlength" value="{$config_min_password}" />
		    	</div>
		    	<div id="minpasslength.msg" class="badentry"></div>
		    </td>
		</tr>
    
		<tr>
		    <td valign="top"><div class="rowdesc">{help_icon title="Формат даты" message="Задайте формат даты, который будет отображаться в банлисте и на других страницах.."}Формат даты </div></td>
		    <td>
		    	<div align="left">
		      		<input type="text" TABINDEX=4 class="submit-fields" id="config_dateformat" name="config_dateformat" value="{$config_dateformat}" />
              <a href="http://www.php.net/date" target="_blank">См. PHP date()</a>
		    	</div>
		    </td>
		</tr>
		
		<tr>
		    <td valign="top"><div class="rowdesc">{help_icon title="Часовой пояс" message="Задайте часовой пояс"}Часовой пояс </div></td>
		    <td>
		    	<div align="left">
		      		<select TABINDEX=4 name="timezoneoffset" id="sel_timezoneoffset">
						<option value="-12" class="">(GMT -12:00) Эниветок, Кваджалейн</option>
						
						<option value="-11" id="-39600" class="" >(GMT -11:00) Мидуэй, Самоа</option>
						<option value="-10" id="-36000" class="">(GMT -10:00) Гавайи</option>
						<option value="-9" class="">(GMT -9:00) Аляска</option>
						<option value="-8" class="">(GMT -8:00) Тихоокеанское время (США &amp; Канада)</option>
						<option value="-7" class="">(GMT -7:00) Горное время (США &amp; Канада)</option>
						<option value="-6" class="">(GMT -6:00) Центральное время (США &amp; Канада), Мехико</option>
						
						<option value="-5" class="">(GMT -5:00) Восточное время (США &amp; Канада), Богота, Лима</option>
						<option value="-4" class="">(GMT -4:00) Атлантическое время (Канада), Каракас, Ла-Пас</option>
						<option value="-3.5" class="">(GMT -3:30) Ньюфаундленд</option>
						<option value="-3" class="">(GMT -3:00) Бразилия, Буэнос-Айрес, Джорджтаун</option>
						<option value="-2" class="">(GMT -2:00) Средне-атлантическое время</option>
						<option value="-1" class="">(GMT -1:00 hour) Азорские острова, Острова Зеленого Мыса</option>
						<option value="0" class="">(GMT) Западноевропейское время, Лондон, Лиссабон, Касабланка</option>
						<option value="1" class="">(GMT +1:00 hour) Брюссель, Копенгаген, Мадрид, Париж</option>
						
						<option value="2" class="">(GMT +2:00) Калининград, Южная африка</option>
						<option value="3" class="">(GMT +3:00) Багдад, Рияд</option>
						<option value="3.5" class="">(GMT +3:30) Тегеран</option>
						<option value="4" class="">(GMT +4:00) Москва, Санкт-Петербург, Мускат, Баку, Тбилиси</option>
						<option value="4.5" class="">(GMT +4:30) Кабул</option>
						<option value="5" class="">(GMT +5:00) Исламабад, Карачи, Ташкент</option>
						<option value="5.5" class="">(GMT +5:30) Бомбей, Калькутта, Мадрас, Нью Дели</option>
						<option value="6" class="">(GMT +6:00) Екатеринбург, Алматы, Дакка, Коломбо</option>
						<option value="7" class="">(GMT +7:00) Бангкок, Ханой, Джакарта</option>
						
						<option value="8" class="">(GMT +8:00) Пекин, Перт, Сингапур, Гонк-Конг</option>
						<option value="9" class="">(GMT +9:00) Токио, Сеул, Осака, Саппоро, Якутск</option>
						<option value="9.5" class="">(GMT +9:30) Аделаида, Дарвин</option>
						<option value="10" class="">(GMT +10:00) Восточная Австралия, Гуам, Владивосток</option>
						<option value="11" class="">(GMT +11:00) Магадан, Соломоновы Острова, Новая Каледония</option>
						<option value="12" class="">(GMT +12:00) Окленд, Веллингтон, Фиджи, Камчатка</option>
					</select>
		    	</div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Летнее время" message="Включить автоматический переход на летнее время."}Летнее время</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" TABINDEX=5 name="config_summertime" id="config_summertime" />
		    	</div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Режим отладки" message="Включить режим отладки."}Режим отладки</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" TABINDEX=6 name="config_debug" id="config_debug" />
		    	</div>
		    </td>
		</tr>
    	
		<tr>
			<td valign="top" colspan="2"><h3>Настройки приветствия</h3></td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Заголовок приветствия" message="Введите заголовок приветствия."}Заголовок приветствия </div></td>
			<td>
				<div align="left">
					<input type="text" TABINDEX=7 class="submit-fields" id="dash_intro_title" name="dash_intro_title" value="{$config_dash_title}" />
		    	</div>
		    <div id="dash.intro.msg" class="badentry"></div></td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Текст приветствия" message="Введите текст приветствия."}Приветствие </div></td>
			<td><div align="left">  </div></td>
		</tr>
		<tr>
			<td valign="top" colspan="2"> <textarea TABINDEX=6 cols="80" rows="20" id="dash_intro_text" name="dash_intro_text">{$config_dash_text}</textarea>
				<div>
				<a href="javascript:void(0);" onclick="toggleMCE('dash_intro_text');">Включить/Выключить редактор WYSIWYG</a><div id="dash.text.msg" class="badentry">
				</div>
			</td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Выключить всплывающие окна" message="Установите этот флажок, чтобы отключить всплывающие подсказки и использовать прямые ссылки."}Выключить всплывающие окна</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" TABINDEX=8 name="dash_nopopup" id="dash_nopopup" />
		    	</div>
		    </td>
		</tr>
		<tr>
			<td valign="top" colspan="2"><h3>Настройки страницы</h3></td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Включить протест банов" message="Поставьте галку чтобы включить страницу протеста банов."}Включить протест банов</div></td>
			<td>
				<div align="left">
					<input type="checkbox" TABINDEX=9 name="enable_protest" id="enable_protest" />
		    	</div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Только отправка e-mail" message="Если включено - при протесте бана будет только отправляться e-mail админу."}Только отправка e-mail</div></td>
			<td>
				<div align="left">
					<input type="checkbox" TABINDEX=9 name="protest_emailonlyinvolved" id="protest_emailonlyinvolved" />
		    	</div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Предложение бана" message="Поставьте галку чтобы включить страницу запроса банов."}Предложения банов</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" TABINDEX=10 name="enable_submit" id="enable_submit" />
		    	</div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Главная страница" message="Выберите главную страницу."}Главная страница</div></td>
		    <td>
		    	<div align="left">
					<select TABINDEX=11 class="inputbox" name="default_page" id="default_page">
				        <option value="0">Главная</option>
				      	<option value="1">Банлист</option>
				      	<option value="2">Серверы</option>
				        <option value="3">Предложить бан</option>
				        <option value="4">Протест бана</option>
					</select>
		    	</div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Очистить кэш" message="Кликните по этой кнопке, чтобы очистить папку themes_c."}Очистить кэш</div></td>
			<td>
				<div align="left">
					{sb_button text="Очистить кэш" onclick="xajax_ClearCache();" class="cancel" id="clearcache" submit=false}
				</div><div id="clearcache.msg"></div>
			</td>
		</tr>
		<tr>
			<td valign="top" colspan="2"><h3>Настройки банлиста</h3></td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Банов на странице" message="Выберите количество банов на страницу."}Банов на страницу </div></td>
		    <td>
		    	<div align="left">
		      		<input type="text" TABINDEX=12 class="submit-fields" id="banlist_bansperpage" name="banlist_bansperpage" value="{$config_bans_per_page}" />
		    	</div>
		    	<div id="bansperpage.msg" class="badentry"></div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Скрыть имя админа" message="Поставьте галку чтобы скрыть имя админа в деталях бана."}Скрыть имя админа</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" TABINDEX=13 name="banlist_hideadmname" id="banlist_hideadmname" />
		    	</div>
		    	<div id="banlist_hideadmname.msg" class="badentry"></div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Не показывать страну" message="Поставьте галку чтобы не показывать страну забаненного игрока."}Не показывать страну</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" TABINDEX=14 name="banlist_nocountryfetch" id="banlist_nocountryfetch" />
		    	</div>
		    	<div id="banlist_nocountryfetch.msg" class="badentry"></div>
		    </td>
		</tr>
        <tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Скрыть IP игрока" message="Поставьте галку чтобы скрыть IP адрес игрока в деталях бана."}Скрыть IP игрока</div></td>
		    <td>
		    	<div align="left">
		      		<input type="checkbox" TABINDEX=15 name="banlist_hideplayerips" id="banlist_hideplayerips" />
		    	</div>
		    	<div id="banlist_hideplayerips.msg" class="badentry"></div>
		    </td>
		</tr>
		<tr>
			<td valign="top"><div class="rowdesc">{help_icon title="Свои причины бана" message="Введите свои причины банов."}Свои причины</div></td>
		    <td>
		    	<div align="left">
					<table width="100%" border="0" style="border-collapse:collapse;" id="custom.reasons" name="custom.reasons">
						{foreach from="$bans_customreason" item="creason"}
						<tr>
							<td><input type="text" class="submit-fields" name="bans_customreason[]" id="bans_customreason[]" value="{$creason}"/></td>
						</tr>
						{/foreach}
						<tr>
							<td><input type="text" class="submit-fields" name="bans_customreason[]" id="bans_customreason[]"/></td>
						</tr>
						<tr>
							<td><input type="text" class="submit-fields" name="bans_customreason[]" id="bans_customreason[]"/></td>
						</tr>
					</table>
					<a href="javascript:void(0)" onclick="MoreFields();" title="Добавть полей">[+]</a>
		    	</div>
		    	<div id="bans_customreason.msg" class="badentry"></div>
		    </td>
		</tr>
		<tr>
			<td valign="top" colspan="2">&nbsp;</td>
		</tr> 
		<tr>
			<td>&nbsp;</td>
		    <td>
		      {sb_button text="Сохранить" class="ok" id="asettings" submit=true}
		      &nbsp;
		      {sb_button text="Назад" class="cancel" id="aback"}
			</td>
		</tr>
	</table>
</form>
<script>$('sel_timezoneoffset').value = "{$config_time}";</script>
