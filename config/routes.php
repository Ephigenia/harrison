<?php

use \ephFrame\core\Router;
use \ephFrame\core\Route;

$router = Router::getInstance();
$router->addRoutes(array(
	'root' => new Route('/', array(
		'controller' => 'app\controller\BlogPostController',
		'action' => 'index',
	)),
	// Author Pages
	'User' => new Route('/author/:uri', array(
		'controller' => 'app\controller\UserController',
		'action' => 'view',
	)),
	// Blogposts
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
	'BlogPost' => new Route('/blog/:uri', array(
		'controller' => 'app\controller\BlogPostController',
		'action' => 'view',
	)),
));