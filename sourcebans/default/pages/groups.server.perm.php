<?php 
/**
 * =============================================================================
 * Server permission checkboxes
 * 
 * @author SteamFriends Development Team
 * @version 1.0.0
 * @copyright SourceBans (C)2007 SteamFriends.com.  All rights reserved.
 * @package SourceBans
 * @link http://www.sourcebans.net
 * 
 * @version $Id: groups.server.perm.php 195 2008-12-30 17:26:40Z peace-maker $
 * =============================================================================
 */

if(!defined("IN_SB")){echo "You should not be here. Only follow links!";die();} ?>
 
  <table width="90%" border="0" cellspacing="0" cellpadding="4" align="center">
  <tr>
    <td colspan="5"><h4 id="webtop">{title}</h4></td>
  </tr>
  <tr>
    <td colspan="2" class="tablerow4">Имя</td>
    <td class="tablerow4">Флаг</td>
    <td colspan="2" class="tablerow4">Описание</td>
    </tr>
  <tr id="srootcheckbox" name="srootcheckbox">
    <td colspan="2" class="tablerow2">Главный админ (Полный доступ)</td>
    <td class="tablerow2" align="center">z</td>
    <td class="tablerow2"> Включает все флаги.</td>
    <td align="center" class="tablerow2"><input type="checkbox" name="s14" id="s14" /></td>
  </tr>
  <tr>
    <td colspan="5" class="tablerow4">Стандартные серверные разрешения </td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Резервный слот </td>
    <td class="tablerow1" align="center">a</td>
    <td class="tablerow1"> Возможность занять зарезервированный слот.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s1" id="s1" value="1" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Общий</td>
    <td class="tablerow1" align="center">b</td>
    <td class="tablerow1"> Общий админ; необходимый для админов.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s23" id="s23" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Кик игроков </td>
    <td class="tablerow1" align="center">c</td>
    <td class="tablerow1"> Возможность кикать игроков.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s2" id="s2" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Бан игроков </td>
    <td class="tablerow1" align="center">d</td>
    <td class="tablerow1"> Возможность банить игроков.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s3" id="s3" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Разбан игроков </td>
    <td align="center" class="tablerow1">e</td>
    <td class="tablerow1"> Возможность разбанивать игроков.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s4" id="s4" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Убить</td>
    <td align="center" class="tablerow1">f</td>
    <td class="tablerow1"> Убить/ранить игроков.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s5" id="s5" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Смена карт  </td>
    <td align="center" class="tablerow1">g</td>
    <td class="tablerow1"> Смена карты или основных особенностей игры.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s6" id="s6" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Смена КВАРов </td>
    <td align="center" class="tablerow1">h</td>
    <td class="tablerow1"> Возможность изменять КВАРы.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s7" id="s7" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Исполнение конфигов </td>
    <td class="tablerow1" align="center">i</td>
    <td class="tablerow1"> Исполнение конфигурационных файлов.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s8" id="s8" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Админский чат  </td>
    <td class="tablerow1" align="center">j</td>
    <td class="tablerow1"> Специальный админский чат.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s9" id="s9" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Голосования </td>
    <td class="tablerow1" align="center">k</td>
    <td class="tablerow1"> Возможность начинать голосования (за смену карты и т.д.).</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s10" id="s10" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Пароль сервера </td>
    <td class="tablerow1" align="center">l</td>
    <td class="tablerow1"> Возможность устанавливать/изменять пароль сервера.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s11" id="s11" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">РКОН команды </td>
    <td class="tablerow1" align="center">m</td>
    <td class="tablerow1"> Использование РКОН команд.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s12" id="s12" /></td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Разрешать читы </td>
    <td class="tablerow1" align="center">n</td>
    <td class="tablerow1"> Смена квара sv_cheats или использование чит-команд.</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s13" id="s13" /></td>
  </tr>
  <tr>
    <td colspan="5" class="tablerow4">Иммунитет </td>
  </tr>
  <tr class="tablerow1">
    <td width="15%">&nbsp;</td>
    <td class="tablerow1">Иммунитет </td>
    <td class="tablerow1" align="center"></td>
    <td class="tablerow1">Выберите уровень иммунитета. Чем выше число, тем больше иммунитет.<br /><div align="center"><input type="text" width="5" name="immunity" id="immunity" /></div></td>
    <td align="center" class="tablerow1"></td>
  </tr>
  <tr>
    <td colspan="5" class="tablerow4">Дополнительные серверные разрешения </td>
  </tr>
  <tr class="tablerow1">
    <td>&nbsp;</td>
    <td class="tablerow1">Дополнительный флаг &quot;o&quot;  </td>
    <td class="tablerow1" align="center">o</td>
    <td class="tablerow1">&nbsp;</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s17" id="s17" /></td>
  </tr>
  <tr class="tablerow1">
    <td>&nbsp;</td>
    <td class="tablerow1">Дополнительный флаг &quot;p&quot; </td>
    <td class="tablerow1" align="center">p</td>
    <td class="tablerow1">&nbsp;</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s18" id="s18" /></td>
  </tr>
  <tr class="tablerow1">
    <td>&nbsp;</td>
    <td class="tablerow1">Дополнительный флаг &quot;q&quot; </td>
    <td class="tablerow1" align="center">q</td>
    <td class="tablerow1">&nbsp;</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s19" id="s19" /></td>
  </tr>
  <tr class="tablerow1">
    <td>&nbsp;</td>
    <td class="tablerow1">Дополнительный флаг &quot;r&quot; </td>
    <td class="tablerow1" align="center">r</td>
    <td class="tablerow1">&nbsp;</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s20" id="s20" /></td>
  </tr>
  <tr class="tablerow1">
    <td>&nbsp;</td>
    <td class="tablerow1">Дополнительный флаг &quot;s&quot; </td>
    <td class="tablerow1" align="center">s</td>
    <td class="tablerow1">&nbsp;</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s21" id="s21" /></td>
  </tr>
  <tr class="tablerow1">
    <td>&nbsp;</td>
    <td class="tablerow1">Дополнительный флаг &quot;t&quot; </td>
    <td class="tablerow1" align="center">t</td>
    <td class="tablerow1">&nbsp;</td>
    <td align="center" class="tablerow1"><input type="checkbox" name="s22" id="s22" /></td>
  </tr>
</table>
