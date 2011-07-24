<?php

namespace app\model;

/**
 * Entity(repositoryClass="app\model\BlogPostRepository")
 * @Document
 */
class BlogPost extends Model
{
	/** @Id */
	private $id;
	
	/**
	 * @Field(type="string")
	 */
	private $name;
	
	/**
	 * @ReferenceMany(targetDocument="Tag", cascade={"persist", "remove"})
	 */
	public $tags = array();
	
	public function __construct($name, array $tags = array()) {
		$this->name = $name;
		foreach($tags as $tag) {
			$this->tags[] = new Tag($tag);
		}
	}
}