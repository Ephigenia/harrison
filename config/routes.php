<?php

use \ephFrame\core\Router;
use \ephFrame\core\Route;

$router = Router::getInstance();
$router->addRoutes(array(
	'root' => new Route('/', array(
		'controller' => 'app\controller\BlogPostController',
		'action' => 'index',
	)),
	'BlogPostScaffold' => new Route('/blog/:id', array(
		'controller' => 'app\controller\BlogPostController',
		'action' => 'view',
		'id' => false,
	))
));