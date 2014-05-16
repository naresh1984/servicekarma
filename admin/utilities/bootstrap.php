<?php
$controller = "establishments";
$action = "index";
$query = null;
session_start();
if (isset($_GET['load']))
{
	$params = array();
	$params = explode("/", $_GET['load']);

	$controller = ucwords($params[0]);
	
	if (isset($params[1]) && !empty($params[1]))
	{
		$action = $params[1];
	}
	
	if (isset($params[2]) && !empty($params[2]))
	{
		$query = $params[2];
	}
}
$modelName = $controller;
$controller .= 'Controller';
if (class_exists($controller)) {
  $load = new $controller($modelName, $action);
  if (method_exists($load, $action))
  {
	$load->{$action}($query);
  }
  else 
  {
	$controller = "notfound";
	$action = "index";	
	$modelName = $controller;
	$controller .= 'Controller';  
	
	$load = new $controller($modelName, $action);
	if (method_exists($load, $action))
	{
	  $load->{$action}($query);
	}	  
	//die('Invalid method. Please check the URL.');
  }
}else{
  $controller = "notfound";
  $action = "index";	
  $modelName = $controller;
  $controller .= 'Controller';  
  
  $load = new $controller($modelName, $action);
  if (method_exists($load, $action))
  {
	$load->{$action}($query);
  }
  //die('Invalid Class. Please check the URL.');
}