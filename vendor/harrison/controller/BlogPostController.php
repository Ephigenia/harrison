<?php

namespace harrison\controller;

use app\model\BlogPost;
use app\model\BlogPostFlag;
use app\model\Status;

class BlogPostController extends Controller
{
	public function beforeAction()
	{
		$this->Paginator = new \app\component\Paginator($this);
		$this->Paginator->page = (int) @$this->params['page'] ?: 1;
		$this->Paginator->url = \ephFrame\core\Router::getInstance()->BlogPosts;
		return parent::beforeAction();
	}
	
	public function index()
	{
		$query = $this->repository()->createQueryBuilder('BlogPost');
		// searching for keywords
		if (isset($this->params['q'])) {
			$this->Paginator->url = \ephFrame\core\Router::getInstance()->searchPaged;
			$this->view->data['q'] = $q = rawurldecode($this->params['q']);
			$query
				->setParameter('search', '%'.$q.'%')
				->andWhere('BlogPost.headline LIKE :search OR BlogPost.text LIKE :search');
		}
		$this->view->data['Paginator'] = $this->Paginator;
		return $this->view->data['BlogPosts'] = $this->Paginator->paginate($query);
	}
	
	public function view()
	{
		try {
			if (isset($this->params['id'])) {
				$BlogPost = $this->repository()->findOneById((int) $this->params['id']);
			} elseif (isset($this->params['uri'])) {
				$BlogPost = $this->repository()->findOneByUri($this->params['uri']);
			} else {
				return false;
			}
		} catch (\Doctrine\ORM\NoResultException $e) {
			return false;
		}
		$this->view->data['BlogPost'] = $BlogPost;
		// add comment form
		$Router = \ephFrame\core\Router::getInstance();
		$this->view->data['CommentForm'] = $CommentForm = new \app\component\Form\Comment();;
		$CommentForm->attributes['action'] = $Router->CommentPost(array(
			'blogPostId' => $BlogPost->id,
			'model' => 'BlogPost',
		));
		$CommentForm->isValid();
		return $BlogPost;
	}
}