<?php

namespace harrison\controller;

use app\model\BlogPost;
use app\model\BlogPostFlag;
use app\model\Status;

class BlogPostController extends Controller
{
	public function beforeAction()
	{
		$this->view->Paginator = new \app\component\Paginator($this);
		$this->view->Paginator->page = (int) @$this->params['page'] ?: 1;
		$this->view->Paginator->url = \ephFrame\core\Router::getInstance()->BlogPosts;
		return parent::beforeAction();
	}
	
	public function index()
	{
		$query = $this->repository()->createQueryBuilder('BlogPost');
		// searching for keywords
		if (isset($this->params['q'])) {
			$this->view->Paginator->url = \ephFrame\core\Router::getInstance()->searchPaged;
			$this->view->q = $q = rawurldecode($this->params['q']);
			$query
				->setParameter('search', '%'.$q.'%')
				->andWhere('BlogPost.headline LIKE :search OR BlogPost.text LIKE :search');
		}
		return $this->view->BlogPosts = $this->view->Paginator->paginate($query);
	}
	
	public function view()
	{
		try {
			if (isset($this->params['id'])) {
				$this->view->BlogPost = $this->repository()->findOneById((int) $this->params['id']);
			} elseif (isset($this->params['uri'])) {
				$this->view->BlogPost = $this->repository()->findOneByUri($this->params['uri']);
			} else {
				return false;
			}
		} catch (\Doctrine\ORM\NoResultException $e) {
			return false;
		}
		// add comment form
		$Router = \ephFrame\core\Router::getInstance();
		$this->view->CommentForm = $CommentForm = new \app\component\Form\Comment();;
		$CommentForm->attributes['action'] = $Router->CommentPost(array(
			'blogPostId' => $this->view->BlogPost->id,
			'model' => 'BlogPost',
		));
		return $this->view->BlogPost;
	}
}