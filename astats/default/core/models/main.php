<?php
	$server_info = get_server_info($server[$server_id]['ip'], (int)$server[$server_id]['port'], $server[$server_id]['engine']);
	if (!$page = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT))
		$page = 1;
	$title = 'Top ' . $config['per_page'] . ': Main | Page: ' . $page;
	
	$ftpcache = new FtpCache( $server[$server_id], $config[ 'cache_expires' ] );
	$stats = new CSstats( $ftpcache->filename, $page*$config['per_page']);
	
	$offset = ($page == 1) ? 1 : $stats->countPlayers() - $config['per_page'];