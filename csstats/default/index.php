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
<script type="text/javascript">
$().ready(function() {
	$("#field").keyup(function() {
		$("#x").fadeIn();
		if ($.trim($("#field").val()) == "") {
			$("#x").fadeOut();
		}
	});

	$("#x").click(function() {
		$("#field").val("");
		$(this).hide();
	});
});
</script>
<style>
	.spoiler_body {
		display: none; 
		cursor: pointer;
		color: #FFFFFF;
	}
</style>
<title>Статистика</title>
</head>
<body onLoad="tableRuler()">

<?php
	if ($center == 1) 
		echo "<center>";
	include ("include/settings.php");

	$query =  "SELECT * from `$csstats_table_players`";
	$res = mysql_query($query) or die(mysql_error());
	$rows_max = mysql_num_rows($res);
	
	$this_page = (int)$_GET['page'];
	$sort = trim($_GET['sort']);
	$DescAsc = trim($_GET['descasc']);
	
	if ($sort!="place"&&$sort!="frags"&&$sort!="deaths"&&$sort!="headshots"&&$sort!="teamkills"&&$sort!="shots"&&$sort!="hits"&&$sort!="damage"&&$sort!="suicide"&&$sort!="defusing"&&$sort!="defused"&&$sort!="planted"&&$sort!="explode"&&$sort!="xp"&&$sort!="skill")
		$sort = $DefaultSort;
	if ($DescAsc != "ASC" && $DescAsc != "DESC")
	{
		if ($sort == "place")	$DescAsc = "ASC";
		else					$DescAsc = "DESC";
	}
	elseif ($DescAsc == "DESC") $DescAsc = "ASC";
	else						$DescAsc = "DESC";
	
	if ($this_page == 0) $this_page = 1;
	if ($this_page) $offset = (($show_pages*$this_page)-$show_pages);
	else { $this_page = 1; $offset = 0; }
?>

	<br>
<?php
// Инфа по IP
	$query = "SELECT * FROM `$csstats_table_players` WHERE `ip`='".mysql_escape_string($_SERVER["REMOTE_ADDR"])."' LIMIT 1";
	$res = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($res))
	{
		$row = mysql_fetch_array($res);
?>
	<div style="display: inline-block;" class="alert alert-success">
		Вы <a id="nick" title="Подробная статистика" href="./player.php?id=<?php echo $row['id']; ?>"><?php echo $row['nick']; ?></a>,
		занимаете <b><?php echo $row['place']; ?></b> место, убив <b><?php echo $row['frags']; ?></b> игроков и набрав <b><?php echo $row['deaths']; ?></b> смертей.
		Ваш IP: <b><?php echo $row['ip']; ?></b>
	</div><br>
<?php
	}
?>



<?php
	$search = trim($_GET['field']);
	if (!empty($search)) { $SQL_Search = mysql_escape_string($search); $SearchForm = "WHERE nick RLIKE '$SQL_Search' OR authid RLIKE '$SQL_Search' OR ip RLIKE '$SQL_Search' "; }
	
	if ($sort == "xp")
	{
		if ($cv_XPheadshot == 1) $SqlHS = "+headshots";
		if ($cv_XPc4def > 0) $Sqlc4def = "+defused*3+explode*3";
		$query = "SELECT * FROM $csstats_table_players $SearchForm ORDER BY frags+ar_addxp$SqlHS$Sqlc4def $DescAsc LIMIT $offset, $show_pages";
	}
	else $query = "SELECT * FROM $csstats_table_players $SearchForm ORDER BY $sort $DescAsc LIMIT $offset, $show_pages";

	$res = mysql_query($query) or die(mysql_error());
	$TopPlayers = mysql_num_rows($res);
	$showstats = $TopPlayers*$this_page;
?>


	<font color="#000000" size='2'>
<?php
	if ($search == "")	echo "Показано $showstats из $rows_max игроков"; 
	else				echo "<div><a href='index.php'><span style='float:left;' class='label label-on' title='Вернуться в топ'>Показать весь топ</a></span></div><br>";
?>		
	</font>

	<div id="search">
		<form name="search" action="" type="GET">
			<input style="width:140px;" type="text" name="field" id="field" placeholder="Ник/SteamID/IP" value="<?php echo $search; ?>">
			<div id="delete"><span id="x">x</span></div>
			<input type="submit" name="submit" id="submit" value="Search">
		</form>
	</div>




<table style="margin-bottom: 0px; width:800px; background: #eefcff" class="table table-hover table-bordered table-condensed sortable">
	<thead>
		<tr class="TableSettings">
<?php

	
	$more['width'] = $Pogony[0];
	$more['height'] = $Pogony[1];
	for ($i = 0; $i < strlen($show_top); $i++) echo table_tr($show_top[$i], $more, $DescAsc);
?>
		</tr>
	</thead>
	

	
<?php
	if ($TopPlayers == 0) echo "<tr><td colspan='".strlen($show_top)."'><b><font color=#000000>Статистика пуста</font></b></td></tr>";
	else
	{
		$mesto = $offset;
		while ($row = mysql_fetch_array($res))
		{
			$mesto = $mesto+1;
			if ($mesto > $rows_max) break;
				
			if ($ArmyEnable == 1 && (preg_match("/o/", $show_top) || preg_match("/p/", $show_top) || preg_match("/q/", $show_top)))
			{
				$headshots = $row['headshots'];
				if ($cv_XPheadshot == 0) $headshots = 0;	
				$PlayerXP = ($headshots + $row['frags'] + $row['defused']*$cv_XPc4def + $row['explode']*$cv_XPc4def)*$cv_XPvalue + $row['ar_addxp'];
				$MaxLevels = count($LEVELS);
				for ($i = 1; $i <= $MaxLevels; $i++) 
				{
					if ($i < $MaxLevels) { if ($PlayerXP >= $LEVELS[$i-1] && $PlayerXP < $LEVELS[$i]) { $PlayerLevel = $i; } }
					else { if ($PlayerXP >= $LEVELS[$MaxLevels-1]) { $PlayerLevel = $MaxLevels; } }
				}
				if ($PlayerXP <= 0) $PlayerLevel = 1;
				$more["PlayerXP"]		= $PlayerXP;
				$more["PlayerLevel"]	= $PlayerLevel;
				$more['cv_XPvalue']		= $cv_XPvalue;
				$more['cv_XPheadshot']	= $cv_XPheadshot;
				$more['cv_XPc4def']		= $cv_XPc4def;				
			}
			$user_skill = 0;
			if ($StatsXEnable == 1 && preg_match("/r/", $show_top)) $user_skill = get_skill($row['skill'], $cv_Skill);
				
			echo "<tr>";
			for ($i = 0; $i < strlen($show_top); $i++) echo table_td($show_top[$i], $row, $more, $zvaniya, $LEVELS, $user_skill);
			echo "</tr>";
		}
	}
?>


</table>
<br>
<div>


<?php
	if ($center == 1) $style = 'float: left;margin-left: 350px;';
	else $style = 'float: left;';
	if ($center == 1) $style2 = 'float: right;margin-right: 348px;';
	else $style2 = 'float: right;margin-right: 692px;';
	if ($rows_max > $show_pages)
	{
		$r = 1;
		while ($r <= ceil(5/$show_pages))
		{
			$n = $this_page-1;
			{
				echo "<div style='$style'><a href='?page=$n&sort=$sort'><span style='float:left;' class='label label-on' title='Вернуться назад'>Назад</a></span></div>";
			}
			$r++;
		}
	}
	if ($rows_max > $show_pages)
	{
		$r = 1;
		while ($r <= ceil(5/$show_pages))
		{
			$p = $this_page+1;
			{
				echo "<div style='$style2'><a href='?page=$p&sort=$sort'><span class='label label-on' title='Следующая страница'>Следующая</a></span></div>";
			}
			$r++;
		}
	}
?>


</div>
<br>
<?php
	if ($center == 1) echo "</center>";
?>
</body>
</html>