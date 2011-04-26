<?php

namespace harrison\controller\admin;

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
}