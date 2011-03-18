<?php

namespace app\model;

/**
 * @Entity
 * @Table(name="blog_post_comment")
 */
class Comment
{
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 */
	public $id;
	
	/**
	 * @Column(type="datetime")
	 */
	public $created;
	
	/**
	 * @Column(type="datetime")
	 */
	public $updated;
	
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
	public $url;
	
	/**
     * @Column(type="string")
     * @var string
     */
	public $text;
	
	/**
	 * @Column(type="integer")
	 * @var integer
	 */
	public $ip;
	
	/**
	 * @OneToOne(targetEntity="User")
	 * @var User
	 */
	public $user;
	
	/**
	 * @OneToOne(targetEntity="BlogPost")
	 * @JoinColumn(name="blog_post_id", referencedColumnName="id")
	 * @var BlogPost
	 */
	public $blogPost;
}
