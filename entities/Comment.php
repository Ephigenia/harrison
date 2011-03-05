<?php

namespace app\entities;

/**
 * @Entity @Table(name="horrorblog_comments")
 */
class Comment
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
	public $email;
	
	/**
     * @Column(type="string")
     * @var string
     */
	public $text;
	
	/**
	 * @OneToMany(targetEntity="BlogPost", mappedBy="comments")
	 * @var BlogPost[]
	 */
	public $blogPost;
}