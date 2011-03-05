<?php

namespace app\entities;

/**
 * @Entity @Table(name="horrorblog_blog_posts")
 */
class BlogPost
{
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 */
	public $id;
	
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
	 * @ManyToOne(targetEntity="User", inversedBy="blogPosts")
	 * @var User[]
	 */
	public $user;
	
	/**
	 * @OneToMany(targetEntity="Comment", mappedBy="blogPost")
	 */
	public $comments;
}