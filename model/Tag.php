<?php

namespace app\model;

/**
 * @Document
 */
class Tag
{
	/**
	 * @Id
	 */
	private $id;
	
	/**
	 * @Column(type="string")
	 */
	private $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
}