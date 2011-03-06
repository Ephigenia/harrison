<?php

use \ephFrame\core\Router;
use \ephFrame\core\Route;

$router = Router::getInstance();
$router->addRoutes(array(
	'root' => new Route('/', array(
		'controller' => 'app\controller\BlogPostController',
		'action' => 'index',
	)),
	'BlogPosts' => new Route('/blog/page-:page<\d+>', array(
		'controller' => 'app\controller\BlogPostController',
		'action' => 'index',
		'page' => 1,
	)),
	'BlogPostScaffold' => new Route('/blog/:id', array(
		'controller' => 'app\controller\BlogPostController',
		'action' => 'view',
		'id' => false,
	)),
));