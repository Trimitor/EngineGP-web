<?php
print <<<HERE

	<a href='' class='spoiler_links'><img src='img/title.png' alt='Настройки сервера'></a>
	<div class='spoiler_body'>
		<font color=#000000>Настройки сервера</font>

<table style='margin-bottom: 0px; font-size:14px; text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); background: #eefcff; color:#000000;' class='table table-bordered table-condensed'>
	<thead>
		<tr class='TableSettings'>
			<td>Функция</td>
			<td>Статус</td>
		</tr>
	</thead>
HERE;

// mp_timelimit
	echo "<tr><td id=function>Время на карту</td>";
	if ($mp_timelimit == 0) echo "<td><span class='label label-off'>Бесконечно</span></td></tr>";
	else echo "<td id=status_on><span class='label label-on'>$mp_timelimit</span></td></tr>";
// mp_roundtime
	echo "<tr><td id=function>Время раунда</td><td id=status_on><span class='label label-on'>$mp_roundtime</span></td></tr>";
// mp_friendlyfire
	echo "<tr><td id=function>Огонь в своих</td>";
	if ($mp_friendlyfire == 0) echo "<td><span class='label label-off'>OFF</span></td></tr>";
	else echo "<td id=status_on><span class='label label-on'>ON</span></td></tr>";
// mp_freezetime
	echo "<tr><td id=function>Время на закупку</td>";
	if ($mp_freezetime == 0) echo "<td><span class='label label-off'>OFF</span></td></tr>";
	else echo "<td id=status_on><span class='label label-on'>$mp_freezetime</span></td></tr>";

	if ($ArmyEnable)
	{
// cv_XPvalue
		echo "<tr><td id=function>Количество опыта за одно убийство</td><td id=status_on><span class='label label-on'>$cv_XPvalue</span></td></tr>";
// cv_XPc4def
		echo "<tr><td id=function>Количество опыта за взрыв или разминирование бомбы</td><td id=status_on><span class='label label-on'>$cv_XPc4def</span></td></tr>";
// cv_XPheadshot
		echo "<tr><td id=function>В два раза больше опыта за убийство в голову</td>";
		if ($cv_XPheadshot == 0) echo "<td><span class='label label-off'>OFF</span></td></tr>";
		else echo "<td id=status_on><span class='label label-on'>ON</span></td></tr>";
// cv_Bonus
		echo "<tr><td id=function>Бонусы за звания</td>";
		if ($cv_Bonus == 0) { echo "<td><span class='label label-off'>OFF</span></td></tr>"; }
		else { echo "<td id=status_on><span class='label label-on'>ON</span></td></tr>"; }
// cv_aNew
		echo "<tr><td id=function>Бонусы за новый уровень</td>";
		if ($cv_aNew == 0) { echo "<td><span class='label label-off'>OFF</span></td></tr>"; }
		else { echo "<td id=status_on><span class='label label-on'>ON</span></td></tr>"; }
// cv_FirstRound
		echo "<tr><td id=function>До какого раунда не будут выдаваться бонусы</td><td id=status_off><span class='label label-off'>До $cv_FirstRound</span></td></tr>";
		
// DED
		if ($dedovshina[1] == 1) $DedType = "Отнимает все деньги";
		elseif ($dedovshina[1] == 2) $DedType = "Отнимает оружие в руках";
		elseif ($dedovshina[1] == 3) $DedType = "Пинает на $dedovshina[4]HP";
		elseif ($dedovshina[1] == 4) $DedType = "Рандомно(отнимает оружие или деньги или пинает на $dedovshina[4]HP)";
		echo "<tr><td id=function>Дедовщина. Зажать кнопку \"Е\" и навести на сокомандника</td>";
		if ($dedovshina[1] == 0) echo "<td><span class='label label-off'>OFF</span></td></tr>";
		else echo "<td title='$DedType' id=status_on><span class='label label-on'>ON</span></td></tr>";
		echo "<tr><td id=function>Количество раундов, после которых можно еще раз использовать дедовщину</td><td id=status_on><span class='label label-on'>$dedovshina[3]</span></td></tr>";
// Maps
		echo "<tr><td id=function>Запрещает выдачу бонусов на определенных картах</td>";
		if ($lockmaps[0] == "") { echo "<td><span class='label label-off'>OFF</span></td></tr>"; }
		else
		{
			echo "<div class='p_body'></div><div class='popup'><div><b>Список карт</b><br>";
			for ($a = 1,$b = sizeof($lockmaps);$a < $b;$a++) echo "$lockmaps[$a]<br>";

			echo "<a href=# class='p_close' title='Закрыть'></a></div></div><td id=status_on><div class='p_anch'><a title='Просмотреть' href=#>Список карт</a></td></tr>"; 
		}
	}
	echo "</table></div></div>";
?>