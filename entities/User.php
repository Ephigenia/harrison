<?php

namespace app\entities;

/**
 * @Entity @Table(name="horrorblog_users")
 */
class User
{
	/**
	 * @Id @Column(type="integer") @GeneratedValue
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
	public $locale;
	
	/**
	 * @OneToMany(targetEntity="BlogPost", mappedBy="user")
	 * @var BlogPost[]
	 */
	public $blogPosts;
}