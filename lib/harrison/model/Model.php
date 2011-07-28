<?php

namespace harrison\model;

class Model
{
	public function __construct($idOrArray = null)
	{
		if (is_array($idOrArray)) {
			$this->fromArray($idOrArray);
		} elseif (is_int($idOrArray)) {
			$this->fromArray((array) $em->getRepository(__CLASS__)->findOneById($id));
		}
	}
	
	public function fromArray(Array $array)
	{
		foreach($array as $k => $v) {
			$this->{$k} = $v;
		}
		return $this;
	}
}