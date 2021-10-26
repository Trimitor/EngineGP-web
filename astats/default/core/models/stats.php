<?php
	if (!$n = filter_input(INPUT_GET, 'n', FILTER_VALIDATE_INT))
		header("Location: index.php");
		
	$ftpcache = new FtpCache( $server[$server_id], $config[ 'cache_expires' ] );
	$stats = new CSstats( $ftpcache->filename, $n);
	
	$title = 'Top ' . $config['per_page'] . ': Stats for ' . htmlentities($stats[$n]['nick']);
	$name = htmlentities($stats[$n]['nick']);
	foreach($stats[$n] as $key => $value) $$key = $value;