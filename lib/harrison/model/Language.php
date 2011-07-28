<?php

namespace harrison\model;

/**
 * @Entity
 */
class Language extends Model
{
	/**
     * @Column(type="string")
     * @var string
     */
	public $name;
	
	/**
	 * @Column(type="smallint")
	 * @var integer
	 */
	public $status;
	
	/**
	 * @OneToMany(targetEntity="BlogPost", mappedBy="language")
	 * @var BlogPost[]
	 */
	public $blogPosts;
	
	/**
	 * @OneToMany(targetEntity="BlogPost", mappedBy="language")
	 * @var User[]
	 */
	public $users;
	
	public function __toString()
	{
		return $this->name;
	}
}