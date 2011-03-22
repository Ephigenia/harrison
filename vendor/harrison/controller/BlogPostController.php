<?php

namespace harrison\controller;

use app\model\BlogPost;
use app\model\BlogPostFlag;
use app\model\Status;

class BlogPostController extends Controller
{
	protected $perPage = 10;
	
	public function index()
	{
		$query = $this->repository()
			->createQueryBuilder('BlogPost')
			->setMaxResults($this->perPage)
			->setFirstResult($offset = ((@$this->params['page'] ?: 1) - 1) * $this->perPage);
		if (isset($this->params['q'])) {
			$this->view->data['q'] = $q = rawurldecode($this->params['q']);
			$query
				->setParameter('search', $q.'%')
				->innerJoin('BlogPost.tags', 't')
				->andWhere(
					'BlogPost.headline LIKE :search OR BlogPost.text LIKE :search OR t.name LIKE :search'
				);
		}
		$this->view->data['BlogPosts'] = $BlogPosts = $query->getQuery()->getResult();
		return $BlogPosts;
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