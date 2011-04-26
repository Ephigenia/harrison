<?php

namespace app\model;

/**
 * @Entity
 */
class User
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	public $id;
	
	/**
     * @Column(type="string")
     * @var string
     */
	public $name;
	
	/**
     * @Column(type="string")
     * @var string
     */
	public $email;
	
	/**
	 * @ManyToOne(targetEntity="User", inversedBy="users")
	 * @var Language
	 */
	public $language;
	
	/**
	 * @OneToMany(targetEntity="BlogPost", mappedBy="user")
	 * @var BlogPost[]
	 */
	public $blogPosts;
	
	/**
	 * @OneToMany(targetEntity="Node", mappedBy="user")
	 * @var Node[]
	 */
	public $nodes;
}
