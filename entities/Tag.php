<?php

namespace app\entities;

/**
 * @Entity
 */
class Tag
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	public $id;
	
	/**
	 * @Column(type="string")
	 */
	public $name;
	
	public function __toString()
	{
		return $this->name;
	}
}