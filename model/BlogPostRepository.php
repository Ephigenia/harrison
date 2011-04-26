<?php

namespace app\model;

class BlogPostRepository extends Repository
{
	public $conditions = array(
		'BlogPost.status' => Status::PUBLISHED,
		'BlogPost.published <= CURRENT_TIMESTAMP()',
	);
	
	public $order = array(
		'BlogPost.sticky' => 'DESC',
		'BlogPost.published' => 'DESC',
	);
	
	public function createQueryBuilder($alias)
	{
		$query = parent::createQueryBuilder($alias);
		$query
			->join($alias.'.user', 'user')
			->select(array($alias, 'user'));
		return $query;
	}
	
	public function findOneByUri($uri)
	{
		$query = $this
			->createQueryBuilder('BlogPost')
			->andWhere('BlogPost.uri = :uri')
			->setParameter('uri', $uri);
		return $query->getQuery()->getSingleResult();
	}
}