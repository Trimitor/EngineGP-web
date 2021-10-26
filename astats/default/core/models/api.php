<?php
	$method = $_REQUEST['md'];
	$method_list = array(false, 'search'); //TODO: Переделать все к чертям
	if (in_array($method,$method_list) || !$method){
		$count = (int)$_REQUEST['c'];
		if($method == 'search') $name = $_REQUEST['name'];
		if(empty($count) || !isset($count)) $count = 0;
		
		$ftpcache = new FtpCache( $server[$server_id], $config[ 'cache_expires' ] );
		$stats = new CSstats( $ftpcache->filename, $count);

		if($method == 'search') $stats = $stats->searchByNick($name);
	}else{
		$stats['error'] = "#1 Unknown API method";
	}
	die(json_encode2($stats));