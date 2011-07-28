<?php

namespace harrison\controller;

use 
	ephFrame\core\Router,
	harrison\model\BlogPost,
	harrison\model\BlogPostFlag,
	harrison\model\Status,
	harrison\component\Paginator,
	harrison\form
	;

class BlogPostController extends Controller
{
	public function beforeAction()
	{
		$this->view->Paginator = new Paginator($this);
		$this->view->Paginator->page = (int) @$this->params['page'] ?: 1;
		$this->view->Paginator->url = Router::getInstance()->BlogPosts;
		return parent::beforeAction();
	}
	
	public function index()
	{
		$query = $this->repository()->createQueryBuilder('BlogPost');
		// searching for keywords
		if (isset($this->params['q'])) {
			$this->view->Paginator->url = Router::getInstance()->searchPaged;
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
		$this->view->CommentForm = $CommentForm = new form\Comment();;
		$CommentForm->attributes['action'] = Router::getInstance()->CommentPost(array(
			'blogPostId' => $this->view->BlogPost->id,
			'model' => 'BlogPost',
		));
		return $this->view->BlogPost;
	}
}