<?php
	if (!$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_SPECIAL_CHARS))
		header("Location: index.php?id=$server_id");
	$title = 'Top ' . $config['per_page'] . ': Search result for ' . htmlentities($name);
	
	$ftpcache = new FtpCache( $server[$server_id], $config[ 'cache_expires' ] );
	$stats = new CSstats( $ftpcache->filename);

	$stats = $stats->searchByNick($name);