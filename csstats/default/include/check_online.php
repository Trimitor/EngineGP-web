<?php
	require_once("rcon_hl_net.inc");
	require_once("config.php");
	
	$_GET['name'] = urldecode($_GET['name']);
	for ($s=0; $s<count($server_address); $s++)
	{
		$split_address = explode(":", $server_address[$s]);
		$ip	= $split_address['0'];
		$port = $split_address['1'];
		
		$server = new Rcon();
		$ip = gethostbyname($ip);
		$server->Connect($ip, $port);
		$infos = $server->Info();
		if ($infos)
		{
			$players = $server->Players();
			$int = $infos['activeplayers'];
			for ($i=0; $i<$int; $i++)
			{
				if (trim($players[$i]['name']) == $_GET['name'])
				{
					$online['server'] = $server_address[$s];
					$online['frags'] = $players[$i]['frag'];
					$i = $int;
				}
			}
		}		
		$server->Disconnect();
	}
	if (!isset($online['server'])) die("none");
	echo $online['server']."|".$online['frags'];
?>