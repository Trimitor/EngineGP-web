<?php
	mysql_connect($csstats_host, $csstats_user, $csstats_pass) OR DIE("Не могу создать соединение"); 
	mysql_select_db($csstats_db) or die(mysql_error());
	mysql_query("SET NAMES utf8");

	$query = "SELECT * FROM `$csstats_table_settings`";
	$res = mysql_query($query) or die(mysql_error());

	$ArmyEnable = 0;
	$StatsXEnable = 0;
	
	if (mysql_num_rows($res) != 0)
	{
		while ($row = mysql_fetch_array($res))
		{
// Standart
			if ($row['command'] == "mp_timelimit") $mp_timelimit = $row['value'];
			elseif ($row['command'] == "mp_roundtime") $mp_roundtime = $row['value'];
			elseif ($row['command'] == "mp_friendlyfire") $mp_friendlyfire = $row['value'];
			elseif ($row['command'] == "mp_freezetime") $mp_freezetime = $row['value'];
// Others Plugins
			elseif ($row['command'] == "army_enable")
			{
				$ArmyEnable = $row['value'];
				if ($ArmyEnable != 1)
				{
					$show_top = str_replace("o", "", $show_top);
					$show_top = str_replace("p", "", $show_top);
					$show_top = str_replace("q", "", $show_top);
				}
			}
			elseif ($row['command'] == "statsx_enable")
			{
				$StatsXEnable = $row['value'];
				if ($StatsXEnable != 1)
					$show_top = str_replace("r", "", $show_top);
			}
// Levels
			elseif ($row['command'] == "ar_levels") $LEVELS = preg_split("/[\s,]+/", $row['value']);
// Bonus
			elseif ($row['command'] == "ar_bonus_he")		$bonus0 = preg_split("/[\s,]+/", $row['value']);
			elseif ($row['command'] == "ar_bonus_flash")	$bonus1 = preg_split("/[\s,]+/", $row['value']);
			elseif ($row['command'] == "ar_bonus_smoke")	$bonus2 = preg_split("/[\s,]+/", $row['value']);
			elseif ($row['command'] == "ar_bonus_defuse")	$bonus3 = preg_split("/[\s,]+/", $row['value']);
			elseif ($row['command'] == "ar_bonus_nv")		$bonus4 = preg_split("/[\s,]+/", $row['value']);
			elseif ($row['command'] == "ar_bonus_hp")		$bonus5 = preg_split("/[\s,]+/", $row['value']);
			elseif ($row['command'] == "ar_bonus_armor")	$bonus6 = preg_split("/[\s,]+/", $row['value']);
			elseif ($row['command'] == "ar_bonus_flags")	$bonus7 = preg_split("/[\s,]+/", $row['value']);
			elseif ($row['command'] == "ar_bonus_damage")	$bonus8 = preg_split("/[\s,]+/", $row['value']);
			
			elseif ($row['command'] == "ar_bonus_firstround") $cv_FirstRound = $row['value'];
			elseif ($row['command'] == "ar_bonus_enable") $cv_Bonus = $row['value'];
			elseif ($row['command'] == "ar_anew_enable") $cv_aNew = $row['value'];
// XP
			elseif ($row['command'] == "ar_xp_value") $cv_XPvalue = $row['value'];
			elseif ($row['command'] == "ar_xp_c4def") $cv_XPc4def = $row['value'];
			elseif ($row['command'] == "ar_xp_hs") $cv_XPheadshot = $row['value'];
// DED
			elseif ($row['command'] == "ar_ded_type") $dedovshina[1] = $row['value'];
			elseif ($row['command'] == "ar_ded_firstround") $dedovshina[2] = $row['value'];
			elseif ($row['command'] == "ar_ded_lockround") $dedovshina[3] = $row['value'];
			elseif ($row['command'] == "ar_ded_slap") $dedovshina[4] = $row['value'];
// Others
			elseif ($row['command'] == "ar_lockmaps") $lockmaps = preg_split("/[\s,]+/", $row['value']);
// Звания
			elseif (preg_match("/level_name_/", $row['command']))
			{
				$NumLVL = str_replace("level_name_", "", $row['command']);
				$zvaniya[$NumLVL] = $row['value'];
			}
			elseif ($row['command'] == "statsx_skill") $cv_Skill = preg_split("/[\s,]+/", $row['value']);
		}
	}
?>