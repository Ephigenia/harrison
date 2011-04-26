<?php

use \ephFrame\core\Router;
use \ephFrame\core\Route;

$router = Router::getInstance();
// admin routes
$defaults = array(
	'namespace' => 'harrison\controller\admin',
	'controller' => '',
	'action' => 'index',
);
$router->addRoutes(array(
	'admin' => new Route('/admin/?', $defaults + array()),
	'adminScaffold' => new Route('/admin/:controller/:action/?', $defaults),
));