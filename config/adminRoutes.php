<?php

/**
 * This file stores all admin routes for harrison
 *
 * this file should be included in routes.php file
 * all routes in here should begin with /admin/
 *	
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-03
 */

/** change this to change all admin routes **/
$aP = '/admin/';

/** general **/
Router::addRoute('admin', 				$aP.'',							array('controller' => 'Admin'));
Router::addRoute('adminLogin', 			$aP.'login',					array('controller' => 'AdminUser', 'action' => 'login'));
Router::addRoute('adminLogout', 		$aP.'logout',					array('controller' => 'AdminUser', 'action' => 'logout'));
Router::addRoute('adminWall',			$aP.'wall',						array('controller' => 'Admin', 'action' => 'wall'));

/** User Administration Routes **/
Router::addRoute('adminUserPaged',		$aP.'user/page-:page',			array('controller' => 'AdminUser', 'action' => 'index'));
Router::addRoute('adminUser', 			$aP.'user',						array('controller' => 'AdminUser', 'action' => 'index'));
Router::addRoute('adminUserSearch', 	$aP.'user/search/:q',			array('controller' => 'AdminUser', 'action' => 'search', 'q' => false, 'fields' => array('name', 'id', 'email')));
Router::addRoute(null,					$aP.'user/:id/',				array('controller' => 'AdminUser', 'action' => 'view'));
Router::addRoute('adminUserId', 		$aP.'user/:id/:action',			array('controller' => 'AdminUser'));
Router::addRoute('adminUserAction',		$aP.'user/:action',				array('controller' => 'AdminUser'));

/** Language Routes **/
Router::addRoute('adminLanguage',		$aP.'language/',				array('controller' => 'AdminLanguage'));
Router::addRoute('adminLanguageId',		$aP.'language/(?P<id>\w+)/:action',		array('controller' => 'AdminLanguage'));
Router::addRoute('adminLanguageCreate',	$aP.'language/:action',			array('controller' => 'AdminLanguage'));

/** Node aka Pages Routes **/
Router::addRoute('adminNode',			$aP.'node',						array('controller' => 'AdminNode', 'action' => 'index'));
Router::addRoute('adminNodeMove',		$aP.'node/:id/move/:direction',	array('controller' => 'AdminNode', 'action' => 'move'));
Router::addRoute('adminNodeUpload',		$aP.'node/:nodeId/upload/',		array('controller' => 'AdminMediaFile', 'action' => 'upload'));
Router::addRoute('adminNodeId',			$aP.'node/:id/:action',			array('controller' => 'AdminNode'));
Router::addRoute('adminNodeCreate',		$aP.'node/create',				array('controller' => 'AdminNode', 'action' => 'create'));

/** Blog & Comment Routes **/
Router::addRoute('adminBlogPost',		$aP.'blog',						array('controller' => 'AdminBlogPost'));
Router::addRoute('adminBlogPostPaged',	$aP.'blog/page-:page',			array('controller' => 'AdminBlogPost'));
Router::addRoute('adminBlogPostId',		$aP.'blog/:id/:action',			array('controller' => 'AdminBlogPost'));
Router::addRoute('adminBlogPostCreate', $aP.'blog/:action',				array('controller' => 'AdminBlogPost'));
Router::addRoute('adminBlogPostSearch', $aP.'blog/search/:q',			array('controller' => 'AdminBlogPost', 'action' => 'search', 'q' => false, 'fields' => array('headline', 'BlogPost.id', 'tags')));

/** Comment Routes **/
Router::addRoute('adminComment',		$aP.'comment',					array('controller' => 'AdminComment'));
Router::addRoute('adminCommentBlogPost',$aP.'comment/blogPost/:blogPostId',		array('controller' => 'AdminComment'));
Router::addRoute('adminCommentPaged',	$aP.'comment/page-:page',		array('controller' => 'AdminComment'));
Router::addRoute('adminCommentId',		$aP.'comment/:id/:action',		array('controller' => 'AdminComment', 'action' => 'edit'));

/** Media Files **/
Router::addRoute('adminMediaFiles',		$aP.'files/',					array('controller' => 'AdminFolder', 'action' => 'view'));
Router::addRoute('adminMediaFilesPaged',$aP.'files/page-:page',			array('controller' => 'AdminFolder', 'action' => 'view'));
Router::addRoute('adminMediaFileSearch',$aP.'files/search/:q',			array('controller' => 'AdminMediaFile', 'action' => 'search', 'q' => false, 'fields' => 'filename'));
Router::addRoute('adminMediaFileId',	$aP.'files/:id/:action',		array('controller' => 'AdminMediaFile', 'action' => 'edit'));
Router::addRoute('adminMediaUpload',	$aP.'files/upload/',			array('controller' => 'AdminMediaFile', 'action' => 'upload'));
Router::addRoute('adminMediaFileMove',	$aP.'files/:id/:action/(?P<direction>up|down|top|bottom)', array('controller' => 'AdminMediaFile'));

/** Folder Routes **/
Router::addRoute('adminFolderCreate',	$aP.'folder/create/',			array('controller' => 'AdminFolder', 'action' => 'create'));
Router::addRoute('adminFolderView',		$aP.'folder/:id/',				array('controller' => 'AdminFolder', 'action' => 'view'));
Router::addRoute('adminFolderViewPaged',$aP.'folder/:id/page-:page',	array('controller' => 'AdminFolder', 'action' => 'view'));
Router::addRoute('adminFolderUpload',	$aP.'folder/:folder_id/upload',		array('controller' => 'AdminMediaFile', 'action' => 'upload'));
Router::addRoute('adminFolderId',		$aP.'folder/:id/:action',		array('controller' => 'AdminFolder'));

/** scaffold **/
Router::addRoute('adminScaffold',		$aP.':controller/:action',		array('action' => 'index', 'controllerPrefix' => 'Admin'));
Router::addRoute('adminScaffoldId',		$aP.':controller/:id/:action',	array('action' => 'index', 'controllerPrefix' => 'Admin'));

/** 404 Route for admin pages too **/
Router::addRoute('admin404',			$aP.'*',						array('controller' => 'Error', 'action' => '404'));
