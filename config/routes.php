<?php

use \ephFrame\core\Router;
use \ephFrame\core\Route;

$router = Router::getInstance();
$router->addRoutes(array(
	'root' => new Route('/', array(
			'controller' => 'app\controller\BlogPostController',
		'action' => 'index',
	))
));