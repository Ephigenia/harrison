<?php

namespace app\model;

class BlogPostRepository extends Repository
{
	public function getAllAdminUsers()
	{
		return $this->_em
			->createQuery('SELECT b FROM app\model\BlogPost b WHERE u.status = '.Status::Published)
			->getResult();
	}
}