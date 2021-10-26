<?php
	function seconds2times($seconds)
	{
		$times = array();
		$count_zero = false;
		$periods = array(60, 3600, 86400, 31536000);
		for ($i = 3; $i >= 0; $i--)
		{
			$period = floor($seconds/$periods[$i]);
			if (($period > 0) || ($period == 0 && $count_zero))
			{
				$times[$i+1] = $period;
				$seconds -= $period * $periods[$i];
				$count_zero = true;
			}
		}
		$times[0] = $seconds;
		return $times;
	}
	function get_skill($skill, $cv_Skill)
	{
		if ($skill >= $cv_Skill[0] && $skill < $cv_Skill[1])		$user_skill = "Lm";
		else if ($skill >= $cv_Skill[1] && $skill < $cv_Skill[2])	$user_skill = "L";
		else if ($skill >= $cv_Skill[2] && $skill < $cv_Skill[3])	$user_skill = "Lp";
		else if ($skill >= $cv_Skill[3] && $skill < $cv_Skill[4])	$user_skill = "Mm";
		else if ($skill >= $cv_Skill[4] && $skill < $cv_Skill[5])	$user_skill = "M";
		else if ($skill >= $cv_Skill[5] && $skill < $cv_Skill[6])	$user_skill = "Mp";
		else if ($skill >= $cv_Skill[6] && $skill < $cv_Skill[7])	$user_skill = "Hm";
		else if ($skill >= $cv_Skill[7] && $skill < $cv_Skill[8])	$user_skill = "H";
		else if ($skill >= $cv_Skill[8] && $skill < $cv_Skill[9])	$user_skill = "Hp";
		else if ($skill >= $cv_Skill[9] && $skill < $cv_Skill[10])	$user_skill = "Pm";
		else if ($skill >= $cv_Skill[10] && $skill < $cv_Skill[11])	$user_skill = "P";
		else if ($skill >= $cv_Skill[11] && $skill < $cv_Skill[12])	$user_skill = "Pp";
		else if ($skill >= $cv_Skill[12])							$user_skill = "G";
		else														$user_skill = "Lm";	
		return $user_skill;
	}
	function table_tr($flag, $more, $DescAsc)
	{
		$html = array();

		if ($flag == "a")		$html = "<td class='TableSettings' title='Место в статистике'><a id='sort' title='Место в статистике' href='index.php?page=1&sort=place&descasc=$DescAsc'>#</a></td>";
		elseif ($flag == "b")	$html = "<td class='TableSettings' title='Нажмите для сортировки'><a id='sort' title='Нажмите для сортировки' href='index.php?page=1&sort=nick&descasc=$DescAsc'>Ник</a></td>";
		elseif ($flag == "c")	$html = "<td class='TableSettings' title='Фраги'><a href='index.php?page=1&sort=frags&descasc=$DescAsc'><center><img title='Фраги' src='img/frags.png'></center></a></td>";
		elseif ($flag == "d")	$html = "<td class='TableSettings' title='Смерти'><a href='index.php?page=1&sort=deaths&descasc=$DescAsc'><center><img title='Смерти' src='img/deaths.png'></center></a></td>";
		elseif ($flag == "e")	$html = "<td class='TableSettings' title='В голову'><a href='index.php?page=1&sort=headshots&descasc=$DescAsc'><center><img title='В голову' src='img/headshots.png'></center></a></td>";
		elseif ($flag == "f")	$html = "<td class='TableSettings' title='Убил своих'><a href='index.php?page=1&sort=teamkills&descasc=$DescAsc'><center><img title='Убил своих' src='img/teamkills.png'></center></a></td>";
		elseif ($flag == "g")	$html = "<td class='TableSettings' title='Выстрелы'><a href='index.php?page=1&sort=shots&descasc=$DescAsc'><center><img title='Выстрелы' src='img/shots.png'></center></a></td>";
		elseif ($flag == "h")	$html = "<td class='TableSettings' title='Попадания'><a href='index.php?page=1&sort=hits&descasc=$DescAsc'><center><img title='Попадания' src='img/hits.png'></center></a></td>";
		elseif ($flag == "i")	$html = "<td class='TableSettings' title='Урон'><a href='index.php?page=1&sort=damage&descasc=$DescAsc'><center><img title='Урон' src='img/damage.png'></center></a></td>";
		elseif ($flag == "j")	$html = "<td class='TableSettings' title='Суицид'><a href='index.php?page=1&sort=suicide&descasc=$DescAsc'><center><img title='Суицид' src='img/suicide.png'></center></a></td>";
		elseif ($flag == "k")	$html = "<td class='TableSettings' title='Пытался разминировать'><a href='index.php?page=1&sort=defusing&descasc=$DescAsc'><center><img title='Пытался разминировать' src='img/defusing.png'></center></a></td>";
		elseif ($flag == "l")	$html = "<td class='TableSettings' title='Разминировал'><a href='index.php?page=1&sort=defused&descasc=$DescAsc'><center><img title='Разминировал' src='img/defused.png'></center></a></td>";
		elseif ($flag == "m")	$html = "<td class='TableSettings' title='Поставил бомб'><a href='index.php?page=1&sort=planted&descasc=$DescAsc'><center><img title='Поставил бомб' src='img/planted.png'></center></a></td>";
		elseif ($flag == "n")	$html = "<td class='TableSettings' title='Взорвал бомб'><a href='index.php?page=1&sort=explode&descasc=$DescAsc'><center><img title='Взорвал бомб' src='img/explode.png'></center></a></td>";
		elseif ($flag == "o")	$html = "<td class='TableSettings' title='Нажмите для сортировки'><a id='sort' title='Нажмите для сортировки' href='index.php?page=1&sort=xp&descasc=$DescAsc'>Звание</a></td>";
		elseif ($flag == "p")	$html = "<td class='TableSettings' title='Наведите для увеличения' id=pogony><img title='Наведите для увеличения' width='$more[width]' height='$more[height]' src='img/pogony.png'></td>";
		elseif ($flag == "q")	$html = "<td class='TableSettings' title='Опыт'><a href='index.php?page=1&sort=xp&descasc=$DescAsc'><center><img title='Опыт' src='img/xp.png'></a></center></td>";
		elseif ($flag == "r")	$html = "<td class='TableSettings' title='Скилл'><a href='index.php?page=1&sort=skill&descasc=$DescAsc'><center><img title='Скилл' src='img/skill.png'></center></a></td>";
		return $html;
	}
	function table_td($flag, $row, $more, $zvaniya, $LEVELS, $user_skill)
	{
		$html = array();
		if ($flag == "a")
		{
			$lasttime = $row['lasttime'];
			if ($lasttime == 1)	$lasttime = "Играет";
			else
			{
				$times_values = array('с','м','ч','д','г');
				$lasttime = time() - $lasttime;
				$times = seconds2times($lasttime);
				$lasttime = "Был в сети:";
				for ($i = count($times)-1; $i >= 0; $i--) $lasttime = "$lasttime $times[$i]$times_values[$i]";
				$lasttime = "$lasttime назад";
			}
			$html = "<td title='$lasttime'><span title='$lasttime' class='label label-place'>$row[place]</span></td>"; 

		}
		elseif ($flag == "b")	$html = "<td><a title='Подробная статистика' id='nick' href='player.php?id=$row[id]'>$row[nick]</a></td>";
		elseif ($flag == "c")	$html = "<td><span class='label label-frags'>$row[frags]</span></td>";
		elseif ($flag == "d")	$html = "<td><span class='label label-death'>$row[deaths]</span></td>";
		elseif ($flag == "e")	$html = "<td><span class='label label-headshots'>$row[headshots]</span></td>";
		elseif ($flag == "f")	$html = "<td><span class='label label-teamkills'>$row[teamkills]</span></td>";
		elseif ($flag == "g")	$html = "<td><span class='label label-shots'>$row[shots]</span></td>";
		elseif ($flag == "h")	$html = "<td><span class='label label-hits'>$row[hits]</span></td>";
		elseif ($flag == "i")	$html = "<td><span class='label label-damage'>$row[damage]</span></td>";
		elseif ($flag == "j")	$html = "<td><span class='label label-suicide'>$row[suicide]</span></td>";
		elseif ($flag == "k")	$html = "<td><span class='label label-defusing'>$row[defusing]</span></td>";
		elseif ($flag == "l")	$html = "<td><span class='label label-defused'>$row[defused]</span></td>";
		elseif ($flag == "m")	$html = "<td><span class='label label-planted'>$row[planted]</span></td>";
		elseif ($flag == "n")	$html = "<td><span class='label label-explode'>$row[explode]</span></td>";
		elseif ($flag == "o")
		{
			$PlayerLevel = $more['PlayerLevel'];
			if ($PlayerLevel == count($LEVELS))	$LeftXP = "Максимальный уровень";
			else
			{
				$LeftXP = ($LEVELS[$PlayerLevel] - $more['PlayerXP']);
				$LeftXP = "Следующее звание: ".$zvaniya[$PlayerLevel+1]." (осталось $LeftXP опыта)";
			}
			$html = "<td title='$LeftXP'><span title='$LeftXP' class='label label-zvanie'>$zvaniya[$PlayerLevel]</span></td>";
		}
		elseif ($flag == "p")	$html = "<td><img class='expando' width='$more[width]' height='$more[height]' src='img/pogony/$more[PlayerLevel].png'></td>";
		elseif ($flag == "q")
		{
			if ($row['ar_addxp'] > 0)	$DopXP = "Дополнительный опыт: $row[ar_addxp]";
			else						$DopXP = "";
			$html = "<td title='$DopXP'><span title='$DopXP' class='label label-xp'>$more[PlayerXP]</span></td>";
		}
		elseif ($flag == "r")	$html = "<td><img title='$row[skill]' src='img/skill/$user_skill.png'></td>";

		return $html;
	}
?>