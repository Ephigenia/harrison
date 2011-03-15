<?php

namespace app\entities;

/**
 * @Entity
 */
class BlogPost
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
     * @Column(type="smallint")
     * @var integer
     */
	public $flags;
	
	/**
	 * @Column(type="boolean")
	 * @var boolean
	 */
	public $sticky;
	
	/**
     * @Column(type="string", length=2, nullable=false)
     * @var string
     */
	public $language_id;
	
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
     * @Column(type="integer")
     * @var integer
     */
	public $views;
	
	/**
	 * @Column(type="string", unique=true, nullable=false)
	 * @var string
	 */
	public $uri;
	
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
	 * @ManyToOne(targetEntity="User", inversedBy="blogPosts")
	 * @var User
	 */
	public $user;
	
	/**
	 * @OneToMany(targetEntity="Comment", mappedBy="blogPost")
	 * @OrderBy({"created" = "ASC"})
	 * @var Comment[]
	 */
	public $comments;
	
	/**
	 * @ManyToMany(targetEntity="Tag", inversedBy="blogposts")
	 * @var Tag[]
	 */
	public $tags;
	
	public function __toString()
	{
		return $this->headline ?: '[no headline]';
	}
}