<?php

namespace app\controller;

class BlogPostController extends Controller
{
	public function index()
	{
		$em = $GLOBALS['EntityManager'];
		$BlogPost = new \app\entities\BlogPost();
		$BlogPost->headline = 'New Test Headline';
		$em->persist($BlogPost);
		$em->flush();
		die('OK');
		$blogPosts = $em->createQuery('SELECT BlogPost FROM BlogPost')->setMaxResults(20)->getResult();
		var_dump($blogPosts);
		exit;
		return true;
	}
	
	public function view($id)
	{
		$em = $GLOBALS['EntityManager'];
		$BlogPost = $em->find('\app\entities\BlogPost', $id);
		$this->view->data['BlogPost'] = $BlogPost;
		return $BlogPost;
	}
}