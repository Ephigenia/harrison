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
		$query = $this->entityManager()->createQueryBuilder()
			->add('select', 'b, u')
			->from('app\model\BlogPost', 'b')
			->join('b.user', 'u')
			->where('b.status = '.Status::PUBLISHED)
			->add('orderBy', 'b.sticky DESC, b.published DESC')
			->setMaxResults($this->perPage)
			->setFirstResult(
				$offset = ((@$this->params['page'] ?: 1) - 1) * $this->perPage
			);
		// if admin skip this
		$query->andWhere('b.published <= CURRENT_TIMESTAMP()');
		if (isset($this->params['q'])) {
			$q = rawurldecode($this->params['q']);
			$this->view->data['q'] = $q;			
			$query
				->setParameter('search', $q.'%')
				->innerJoin('b.tags', 't')
				->andWhere(
					'b.headline LIKE :search OR b.text LIKE :search OR t.name LIKE :search'
				);
		}
		$this->view->data['BlogPosts'] = $BlogPosts = $query->getQuery()->getResult();
		return $BlogPosts;
	}
	
	public function view($id)
	{
		if (isset($this->params['id'])) {
			$BlogPost = $this->entityManager()->find('app\model\BlogPost', (int) $id);
		} elseif (isset($this->params['uri'])) {
			$query = $this->entityManager()->createQuery('SELECT b, u, t FROM app\model\BlogPost b JOIN b.user u JOIN b.tags t WHERE b.uri = :uri');
			$query->setParameter('uri', $this->params['uri']);
			$BlogPost = $query->getSingleResult();
		}
		$this->view->data['BlogPost'] = $BlogPost;
		return $BlogPost;
	}
}