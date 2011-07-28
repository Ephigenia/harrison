<?php

namespace harrison\model;

/**
 * @Entity
 */
class Tag extends Model
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	
	/**
	 * @Column(type="string")
	 */
	public $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function __toString()
	{
		return $this->name;
	}
}