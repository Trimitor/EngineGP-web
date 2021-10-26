<?php
	$title = (!$_REQUEST['error'] or empty($_REQUEST['error'])) ? 'Top ' . $config['per_page'].': Error. Action ' . htmlentities($action) . ' not found' : 'Top '.$config['per_page'] . ': Error. ' . $_REQUEST['error'];
	$text = (!$_REQUEST['error'] or empty($_REQUEST['error'])) ? "Action: '" . htmlentities($action) . "' not found;" : $_REQUEST['error'];
	$info = array(
		"type" => "danger",
		"number" => 2, 
		"text" =>  $text
	);