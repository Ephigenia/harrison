<?php

namespace app\controller;

use app\entities\BlogPost;
use app\entities\Status;

use \Doctrine\ORM\Query\Expr;

class BlogPostController extends Controller
{
	protected $perPage = 10;
	
	public function index()
	{
		$q = $this->entityManager()->createQueryBuilder();
		$q->add('select', 'b, u')
			->from('app\entities\BlogPost', 'b')
			->leftJoin('b.user', 'u')
			->where('b.status='.Status::PUBLISHED)
			->orderBy(new Expr\OrderBy('b.published', 'DESC'));
		// if admin skip this
		$q->andWhere(new Expr\Comparison('b.published', '<=', 'CURRENT_TIMESTAMP()'));
		if (isset($this->params['q'])) {
			$q->setParameter('q', $this->params['q']);
			$q->andWhere('b.headline LIKE "%:q%" OR b.text LIKE "%:q%"');
		}
		$q->setMaxResults(10);
		$q->setFirstResult(((@$this->params['page'] ?: 1) - 1) * $this->perPage);
		$this->view->data['BlogPosts'] = $BlogPosts = $q->getQuery()->getResult();
		return $BlogPosts;
	}
	
	public function view($id)
	{
		if (isset($this->params['id'])) {
			$BlogPost = $this->entityManager()->find('app\entities\BlogPost', (int) $id);
		} elseif (isset($this->params['uri'])) {
			$query = $this->entityManager()->createQuery('SELECT b, u, t FROM app\entities\BlogPost b JOIN b.user u JOIN b.tags t WHERE b.uri = :uri');
			$query->setParameter('uri', $this->params['uri']);
			$BlogPost = $query->getSingleResult();
		}
		$this->view->data['BlogPost'] = $BlogPost;
		return $BlogPost;
	}
}