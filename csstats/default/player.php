<?php
	include ("include/config.php");
	include ("include/select.php");
	include ("include/function.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<link rel="stylesheet" href="styles.css"/>
<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/jquery.popup.js"></script>
<script type="text/javascript" src="js/tooltip.js"></script>
<script type="text/javascript" src="js/imagesize.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<style>
	.spoiler_body {
		display: none; 
		cursor: pointer;
		color: #FFFFFF;
	}
</style>
<title>Статистика Игрока</title>
</head>
<body onLoad='tableRuler()'>
<?php
	if ($center == 1) echo "<center>";
	include ("include/settings.php"); 
?>

<table>
	<tr>
		<td>
			Статистика
			<table style="margin-bottom: 0px; background: #eefcff" class="table table-bordered table-condensed">
<?php
	$player = (int)$_GET['id'];
	$query = "SELECT * FROM `$csstats_table_players` WHERE `id`='$player'";
	$res = mysql_query($query) or die(mysql_error());
	$result = mysql_num_rows($res);
	if ($result == 0) echo "<tr><td colspan='11'><b><font color=#000000>Нет такого игрока в статистике</font></b></td></tr>";
	else
	{
		$row = mysql_fetch_array($res);
		if ($ArmyEnable == 1)
		{
			$headshots = $row['headshots'];
			if ($cv_XPheadshot == 0) $headshots = 0;	
			$PlayerXP = ($headshots + $row['frags'] + $row['defused']*$cv_XPc4def + $row['explode']*$cv_XPc4def)*$cv_XPvalue + $row['ar_addxp'];
			$MaxLevels = count($LEVELS);
			for ($i = 1; $i <= $MaxLevels; $i++) 
			{
				if ($i < $MaxLevels) 
				{
					if ($PlayerXP >= $LEVELS[$i-1] && $PlayerXP < $LEVELS[$i])
						$PlayerLevel = $i;
				}
				else
				{
					if ($PlayerXP >= $LEVELS[$MaxLevels-1])
						$PlayerLevel = $MaxLevels;
				}
			}
			if ($PlayerXP <= 0)
				$PlayerLevel = 1;
			$more['PlayerXP'] = $PlayerXP;
			$more['PlayerLevel'] = $PlayerLevel;
			$more['cv_XPvalue'] = $cv_XPvalue;
			$more['cv_XPheadshot'] = $cv_XPheadshot;
			$more['cv_XPc4def'] = $cv_XPc4def;				
		}
		$user_skill = 0;
		if ($StatsXEnable == 1 && preg_match("/q/", $show_top)) $user_skill = get_skill($row['skill'], $cv_Skill);
		$more['width'] = $Pogony[0];
		$more['height'] = $Pogony[1];
		$DescAsc = 0;
// Вывод таблицы

	
		$show_all = "abcdefghijklmnopq";
		for ($i = 0; $i < strlen($show_all); $i++)
		{
			echo "<tr>";
			echo table_tr($show_all[$i], $more, $DescAsc);
			echo table_td($show_all[$i], $row, $more, $zvaniya, $LEVELS, $user_skill);
			echo "</tr>";
		}
	}
?>
			</table>
		</td>
		<td>
<?php
	if ($row['wint'] > $row['winct'])	$avatar = "t";
	else								$avatar = "ct";
	echo "<img src='img/$avatar.png'>";
	
// if 0/0
	echo "<center><table style='margin-bottom: 0px; background: #eefcff' class='table table-bordered table-condensed'>";
	if ($row['deaths'] > 0) $procent = number_format($row['frags']/$row['deaths'], 2);
	echo "<tr><td class='TableSettings'>Убийства/Смерти</td><td><span class='label label-pfrags'>$procent</span></td></tr>";
	if (($row['frags']/100) > 0) $procent = number_format($row['headshots']/($row['frags']/100), 2);
	echo "<tr><td class='TableSettings'>Убийства в голову</td><td><span class='label label-pheads'>$procent%</span></td></tr>";
	if (($row['frags']/100) > 0) $procent = number_format($row['teamkills']/($row['frags']/100), 2);
	echo "<tr><td class='TableSettings'>Атака своих</td><td><span class='label label-pteams'>$procent%</span></td></tr>";
	if (($row['shots']/100) > 0) $procent = number_format($row['hits']/($row['shots']/100), 2);
	echo "<tr><td class='TableSettings'>Точность</td><td><span class='label label-pacc'>$procent%</span></td></tr>";
	echo "</table></center>";
?>
		</td>
		<td>
			Дополнительная информация
			<table style="margin-bottom: 0px; background: #eefcff" class="table table-bordered table-condensed">
			
<?php

	$times_values = array('с','м','ч','д','г');
	$times = seconds2times($row['gametime']);
	for ($i = count($times)-1; $i >= 0; $i--) $gametime = "$gametime $times[$i]$times_values[$i]";
	echo "<tr><td class='TableSettings'>Время в игре</td><td><span class='label label-shots'>$gametime</span></td></tr>";
	$lasttime = $row['lasttime'];
	$times_values = array('с','м','ч','д','г');
	$lasttime = time() - $lasttime;
	$times = seconds2times($lasttime);
	$lasttime = "";
	for ($i = count($times)-1; $i >= 0; $i--) $lasttime = "$lasttime $times[$i]$times_values[$i]";
	$lasttime = "$lasttime назад";

	echo "<tr><td class='TableSettings'>Был в сети</td><td><div id='p_online'><span class='label label-off'>$lasttime</span></div></td></tr>";
	echo "<tr><td class='TableSettings'>Заходов</td><td><span class='label label-connects'>$row[connects]</span></td></tr>";
	echo "<tr><td class='TableSettings'>Сыграл раундов</td><td><span class='label label-rounds'>$row[rounds]</span></td></tr>";
	echo "<tr><td class='TableSettings'>Выиграл за Т</td><td><span class='label label-wint'>$row[wint]</span></td></tr>";
	echo "<tr><td class='TableSettings'>Выиграл за CT</td><td><span class='label label-winct'>$row[winct]</span></td></tr>";
	echo "</table>";
	
	if ($ArmyEnable == 1)
	{
		echo "<br>Бонусы Army Ranks";
		echo "<table style='margin-bottom: 0px; background: #eefcff' class='table table-bordered table-condensed'>";

// Взрывная граната
		if ($bonus0[$PlayerLevel-1] == 1) { $bonus = $bonus0[$PlayerLevel-1]; $style = "on"; }
		else { $bonus = "нет"; $style = "off"; }
		echo "<tr><td class='TableSettings'>Взрывная граната</td><td><span class='label label-$style'>$bonus</span></td></tr>";
// Слеповая граната
		if ($bonus1[$PlayerLevel-1] == 0) { $bonus = "нет"; $style = "off"; }
		else { $bonus = $bonus1[$PlayerLevel-1]; $style = "on"; }
		echo "<tr><td class='TableSettings'>Слеповая граната</td><td><span class='label label-$style'>$bonus</span></td></tr>";	
// Дымовая граната
		if ($bonus2[$PlayerLevel-1] == 0) { $bonus = "нет"; $style = "off"; }
		else { $bonus = $bonus2[$PlayerLevel-1]; $style = "on"; }
		echo "<tr><td class='TableSettings'>Дымовая граната</td><td><span class='label label-$style'>$bonus</span></td></tr>";	
// Дефуз
		if ($bonus3[$PlayerLevel-1] == 0) { $bonus = "нет"; $style = "off"; }
		else { $bonus = $bonus3[$PlayerLevel-1]; $style = "on"; }
		echo "<tr><td class='TableSettings'>Дефуз</td><td><span class='label label-$style'>$bonus</span></td></tr>";	
// Ночное видение
		if ($bonus4[$PlayerLevel-1] == 0) { $bonus = "нет"; $style = "off"; }
		else { $bonus = $bonus4[$PlayerLevel-1]; $style = "on"; }
		echo "<tr><td class='TableSettings'>Ночное видение</td><td><span class='label label-$style'>$bonus</span></td></tr>";	
// HP
		if ($bonus5[$PlayerLevel-1] == 0) { $bonus = "нет"; $style = "off"; }
		else { $bonus = $bonus5[$PlayerLevel-1]; $style = "on"; }
		echo "<tr><td class='TableSettings'>Дополнительные HP</td><td><span class='label label-$style'>$bonus</span></td></tr>";
// AP
		if ($bonus6[$PlayerLevel-1] == 0) { $bonus = "нет"; $style = "off"; }
		else { $bonus = $bonus6[$PlayerLevel-1]; $style = "on"; }
		echo "<tr><td class='TableSettings'>Дополнительные AP</td><td><span class='label label-$style'>$bonus</span></td></tr>";
// Флаги
		if ($bonus7[$PlayerLevel-1] == "0") { $bonus = "нет"; $style = "off"; }
		else { $bonus = $bonus7[$PlayerLevel-1]; $style = "on"; }
		echo "<tr><td class='TableSettings'>Флаги</td><td><span class='label label-$style'>$bonus</span></td></tr>";
// Дополнительный урон
		if ($bonus8[$PlayerLevel-1] == 0) { $bonus = "нет"; $style = "off"; }
		else { $bonus = $bonus8[$PlayerLevel-1]; $style = "on"; }
		echo "<tr><td class='TableSettings'>Дополнительный урон</td><td><span class='label label-$style'>$bonus</span></td></tr>";
	}
	
	
	
	
?>




			</table>
		</td>
	</tr>
</table>
<script>is_user_online("<?php echo $row['nick']; ?>")</script>
<br><div><a href='index.php'><span style='float:left;' class='label label-on' title='Вернуться в топ'>Назад к статистике</a></span></div>
<?php
	if ($center == 1) 
		echo "</center>";
?>
</body>
</html>











