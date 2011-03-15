<?php

namespace app\entities;

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
     * @Column(type="string")
     * @var string
     */
	public $locale;
	
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
