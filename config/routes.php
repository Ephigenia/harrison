<?php

/**
 * ephFrame: <http://code.marceleichner.de/project/ephFrame/>
 * Copyright 2007+, Ephigenia M. Eichner, Kopernikusstr. 8, 10245 Berlin
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright Copyright 2007+, Ephigenia M. Eichner
 * @link http://code.marceleichner.de/projects/ephFrame/
 * @filesource
 */

/**
 * This is the file which stores all url routes to the correct controllers and
 * actions including possible parameters.
 * 	
 * @package app
 * @subpackage app.config
 */

/** Admin Routes **/
require dirname(__FILE__).'/adminRoutes.php';

// general error route
Router::addRoute('error',			'error/:action',				array('controller' => 'Error'));

/** Website Routes **/

/** Image Thumbnails **/
Router::addRoute('imageSrc',
	'static/img/public/:unique_id/(?P<width>\d+|auto)x(?P<height>\d+|auto)/(?P<method>(resize|resizeCrop|auto))/:filename',
	array('controller' => 'MediaFile', 'action' => 'thumb')
);

/** Blog Routes **/
Router::addRoute('root', 				'/', 							array('controller' => 'BlogPost'));
Router::addRoute('blog', 				'blog', 						array('controller' => 'BlogPost'));
Router::addRoute('blogRSS',				'blog/rss',						array('controller' => 'BlogPost', 'layout' => 'rss'));
Router::addRoute('blogICal',			'blog/ical',					array('controller' => 'BlogPost', 'layout' => 'vcal'));
Router::addRoute('blogTxt',				'blog/txt',						array('controller' => 'BlogPost', 'layout' => 'txt'));
Router::addRoute('blogCommentsRSS',		'blog/comment/rss',				array('controller' => 'Comment', 'action' => 'rss'));
Router::addRoute('blogSearch',			'blog/search/:q',				array('controller' => 'BlogPost', 'action' => 'search'));
Router::addRoute('blogPostSearchPaged',	'blog/search/:q/page-:page',	array('controller' => 'BlogPost', 'action' => 'search'));
Router::addRoute('blogSearch2',			'blog/search',					array('controller' => 'BlogPost', 'action' => 'search'));
Router::addRoute('BlogPostPaged',		'blog/page-:page',				array('controller' => 'BlogPost'));
Router::addRoute('blogEntryId',			'blog/:id/',					array('controller' => 'BlogPost', 'action' => 'view'));
Router::addRoute('blogEntryUri',		'blog/:uri/',					array('controller' => 'BlogPost', 'action' => 'view'));

/** Node Routes **/
Router::addRoute('contact',			'vorschlagen/',					array('controller' => 'Contact', 'action' => 'index'));
Router::addRoute('imprint',			'impressum/',					array('controller' => 'Node', 'action' => 'view', 'impressum'));
Router::addRoute('nodeView',		'page/:uri',					array('controller' => 'Node', 'action' => 'view'));
