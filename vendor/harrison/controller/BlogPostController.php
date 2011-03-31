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
		if (isset($this->params['q'])) {
			$this->Paginator->url = \ephFrame\core\Router::getInstance()->searchPaged;
			$this->view->data['q'] = $q = rawurldecode($this->params['q']);
			$query
				->setParameter('search', $q.'%')
				->innerJoin('BlogPost.tags', 't')
				->andWhere('BlogPost.headline LIKE :search OR BlogPost.text LIKE :search OR t.name LIKE :search');
		}
		$this->view->data['Paginator'] = $this->Paginator;
		return $this->view->data['BlogPosts'] = $this->Paginator->paginate($query);
	}
	
	public function view($id)
	{
		try {
			if (isset($this->params['id'])) {
				$BlogPost = $this->repository()->findOneById((int) $id);
			} elseif (isset($this->params['uri'])) {
				$BlogPost = $this->repository()->findOneByUri($this->params['uri']);
			} else {
				return false;
			}
		} catch (\Doctrine\ORM\NoResultException $e) {
			return false;
		}
		$this->view->data['BlogPost'] = $BlogPost;
		return $BlogPost;
	}
}