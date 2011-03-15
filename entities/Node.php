<?php

namespace app\entities;

/**
 * @Entity
 */
class Node
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	public $id;
	
	/**
	 * @Column(type="smallint")
	 * @var integer
	 */
	public $status;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	public $uri;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	public $headline;
	
	/**
	 * @Column(type="string")
	 * @var string
	 */
	public $text;
	
	/**
	 * @Column(type="string")
	 * @var template
	 */
	public $template;
	
	/**
	 * @Column(type="datetime")
	 */
	public $created;
	
	/**
	 * @Column(type="datetime")
	 */
	public $updated;
	
	/**
	 * @Column(type="datetime")
	 */
	public $published;
	
	/**
	 * @ManyToOne(targetEntity="User", inversedBy="nodes")
	 * @var User
	 */
	public $user;
	
	public function __toString()
	{
		return $this->headline ?: '[no headline]';
	}
}