<?php

use \ephFrame\core\Router;
use \ephFrame\core\Route;

$router = Router::getInstance();
$router->addRoutes(array(
	'root' => new Route('/', array(
		'controller' => 'harrison\controller\BlogPostController',
		'action' => 'index',
	)),
	
	'sessiontest' => new Route('/test/:action', array(
		'controller' => 'app\controller\TestController',
	)),
	
	// Author Pages
	'User' => new Route('/author/:uri', array(
		'controller' => 'harrison\controller\UserController',
		'action' => 'view',
	)),
	
	// global search
	'search' => new Route('/search/:q', array(
		'controller' => 'harrison\controller\BlogPostController',
		'action' => 'index',
	)),
	'searchPaged' => new Route('/search/:q/page-:page', array(
		'controller' => 'harrison\controller\BlogPostController',
		'action' => 'index',
	)),
	
	// Page
	'Page' => new Route('/page/:name', array(
		'controller' => 'harrison\controller\PageController',
		'action' => 'view',
	)),
	
	// Comment
	'CommentPost' => new Route('/comment/:blogPostId/:action', array(
		'controller' => 'harrison\controller\CommentController',
		'action' => 'add',
	)),
	
	// Blogposts
	'Feed' => new Route('/feed*', array(
		'controller' => 'harrison\controller\BlogPostController',
		'action' => 'index',
		'type' => 'rss',
	)),
	'BlogPosts' => new Route('/blog/page-:page<\d+>', array(
		'controller' => 'harrison\controller\BlogPostController',
		'action' => 'index',
		'page' => 1,
	)),
	'BlogPostScaffold' => new Route('/blog/:id', array(
		'controller' => 'harrison\controller\BlogPostController',
		'action' => 'view',
		'id' => false,
	)),
	'BlogPost' => new Route('/blog/:uri/?', array(
		'controller' => 'harrison\controller\BlogPostController',
		'action' => 'view',
	)),
));