<?php

@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );

    /**
     * @author Assada
     * @version 1.2.4
     * @copyright (C)2014 assada.com.ua
     */
	//header('Access-Control-Allow-Origin: *'); uncomment for cross-domain requests 
	header('Content-Type: text/html; charset=utf-8');
	mb_internal_encoding("UTF-8");
	
	defined('__DIR__') or define('__DIR__', dirname(__FILE__));
	define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);
	define('BASEURL',"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); //TODO: hm... Only http? fu***n* IE
	
	require __DIR__ ."/core/lib/csstats.class.php";
	require __DIR__ ."/core/lib/ftpcache.class.php";
	require __DIR__ . '/core/lib/SourceQuery/SourceQuery.class.php';
	require __DIR__ . "/core/general.functions.php";
	
	$config = require __DIR__ . "/config/general.config.php";
	$server = require __DIR__ . "/config/servers.config.php";
	
	if (!$server_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT))
		$server_id = $config['def_server_id'];
	
	if (!$action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_STRING))
		$action = "default";
	
	$actions = array(
					"stats" => array(
						"app" => "stats",
						"view" => "player",
						"topbox" => false
					),
					"search" => array(
						"app" => "search",
						"view" => "search",
						"topbox" => false
					),
					"widget" => array(
						"app" => "widget",
						"view" => "widget",
						"topbox" => false
					),
					"api" => array(
						"app" => "api",
						"view" => "api",
						"topbox" => false
					),
					"error" => array(
						"app" => "error",
						"view" => "info",
						"topbox" => false
					),
					"default" => array(
						"app" => "main",
						"view" => "table",
						"topbox" => true
					)
	);
	
	if(!empty($action) or !isset($action)) $route = (array_key_exists($action,$actions)) ? $actions[$action] : $actions['error'];

	require __DIR__ . "/core/models/{$route['app']}.php";
	require __DIR__ . "/templates/{$config['template']}/header.php";
	if($route["topbox"]) require __DIR__ . "/templates/{$config['template']}/topbox.php";
	require __DIR__ . "/templates/{$config['template']}/{$route['view']}.php";
	require __DIR__ . "/templates/{$config['template']}/footer.php";
