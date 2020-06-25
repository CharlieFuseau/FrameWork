<?php
define ('ROOT',str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
define ('MODEL',ROOT."kernel/model/");
define ('LIB',ROOT."kernel/lib/");
define('CONTROLLER',ROOT."kernel/controller/");
define('VIEW',ROOT."kernel/view/");

define ('WEBROOT',str_replace('index.php','',$_SERVER['SCRIPT_NAME']));
define('CSS',WEBROOT."css/");
define('IMG',WEBROOT."img/");
define('JS',WEBROOT."js/");
define('LIBB',WEBROOT."libb/");


// Controle du controller et set $param 
try 
{
	//Gestion du controller
	if(empty($_GET)){
		$controller='main';
		$params=array();
	}else{
		$params=explode('/', $_GET['p']);
		$controller=$params[0];
	}

	//Gestion des paramètres
	if(!empty($params[1]))
	{
		$action = $params[1];
	}
	else
	{
		$action = 'index';
	}
	
	$path = CONTROLLER.$controller.'.php';
	if(!file_exists($path)){
		
		$controller = 'error';
		$path = CONTROLLER.$controller.'.php';
		clearstatcache();
	}
	
	require_once($path);
	$controller = 'CTRL'.$controller;
	$controller = new $controller();

	if(!method_exists($controller, $action)){
		$action = 'index';
	}else{
		unset($params[0]);
		unset($params[1]);
	}

	call_user_func_array(array($controller, $action), $params);
}
catch(Exception $e)
{
	echo "Erreur : ".$e->getMessage();
}
?>

