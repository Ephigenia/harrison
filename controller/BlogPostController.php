<?php

namespace app\controller;

use app\entities\BlogPost;
use app\entities\Status;

class BlogPostController extends Controller
{
	protected $perPage = 10;
	
	public function index()
	{
		$query = $this->entityManager()->createQuery('SELECT b, u FROM app\entities\BlogPost b JOIN b.user u WHERE b.status = '.Status::PUBLISHED.' AND b.published <= CURRENT_TIMESTAMP() ORDER BY b.published DESC');
		$query->setMaxResults(10);
		$query->setFirstResult(((@$this->params['page'] ?: 1) - 1) * $this->perPage);
		$this->view->data['BlogPosts'] = $BlogPosts = $query->getResult();
		return $BlogPosts;
	}
	
	public function view($id)
	{
		if (isset($this->params['id'])) {
			$BlogPost = $this->entityManager()->find('app\entities\BlogPost', (int) $id);
		} elseif (isset($this->params['uri'])) {
			$query = $this->entityManager()->createQuery('SELECT b, u FROM app\entities\BlogPost b JOIN b.user u WHERE b.uri = :uri');
			$query->setParameter('uri', $this->params['uri']);
			$BlogPost = $query->getSingleResult();
		}
		$this->view->data['BlogPost'] = $BlogPost;
		return $BlogPost;
	}
}