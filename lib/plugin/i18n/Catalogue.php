<?php

namespace i18n;

class Catalogue extends \ArrayObject
{
	public function __construct(Array $array = array())
	{
		return parent::__construct($array, \ArrayObject::ARRAY_AS_PROPS);
	}
}