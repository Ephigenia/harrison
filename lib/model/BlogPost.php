<?php

/**
 * Flags for {@link BlogPost}
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-03-14
 * @package harrison
 * @subpackage harrison.lib.model
 */
class BlogPostFlag
{
	const ALLOW_COMMENTS = 512;	// allow comments on blog posts
	const FLAG_STICKY = 2048;	// sticky blog posts (always on top)
}

/**
 * Simple Blog Post Model
 * 	
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 28.11.2008
 */
class BlogPost extends AppModel
{
	public $behaviors = array(
		'Timestampable',
		'Flagable',
		'HitCount',
		'Sluggable' => array(
			'fields' => array('headline'),
			'autoUpdate' => true,
			'maxLength' => 60,
		),
	);
	
	public $perPage = 10;

	public $order = array(
		'BlogPost.flags & 2048' => 'DESC',
		'BlogPost.published' => 'DESC',
	);
	
	public $findConditions = array(
		'BlogPost.status & 1',
		'BlogPost.published < UNIX_TIMESTAMP()',
	);
	
	public $belongsTo = array(
		'User',
	);
	
	public $hasAndBelongsToMany = array(
		'Tag' => array(
			'joinTable' => 'tags_model',
			'foreignKey' => 'foreign_id',
			'conditions' => array(
				'model' => '\'BlogPost\'',
			),
		),
	);
	
	public $hasMany = array(
		'Comment' => array(
			'conditions' => array(
				'model' => '\'BlogPost\'',
			),
			'foreignKey' => 'Comment.foreign_id',
			'associationKey' => 'Comment.foreign_id',
		),
	);
	
	/**
	 * Returns a string of $length characters or less of the blog entry’s text
	 * that can be used as excerpt. HTML-Tags and UBB-Code is stripped
	 *	
	 * @param $length
	 * @return string
	 */
	public function excerpt($length = 50)
	{
		if ($this->hasField('excerpt') && !$this->isEmpty('excerpt')) {
			return $this->excerpt;
		}
		$firstWords = preg_replace('@\[\[([^\]]+)\]\]@', '', $this->text);
		$firstWords = String::truncate(strip_tags($firstWords), $length);
		return $firstWords;
	}
	
	/**
	 * Return uri-string to a single blog entry
	 */
	public function detailPageUri(Array $params = array())
	{
		if (!$this->exists()) {
			return false;
		}
		if ($this->isEmpty('uri')) {
			return Router::getRoute('blogEntryId', array('id' => $this->id));
		} else {
			return Router::getRoute('blogEntryUri', array('uri' => $this->uri));
		}
	}
	
	public function bestBlogPostsOverall()
	{
		$queryFile = dirname(__FILE__).'/../../console/sql/best_blog_posts.sql';
		if (file_exists($queryFile) && $bestBlogPosts = $this->query(file_get_contents($queryFile))) {
			return $bestBlogPosts;
		}
		return false;
	}
	
	public function similarEntries()
	{
		if (!$this->exists() || $this->Tags->count() == 0) return false;
		$queryFile = dirname(__FILE__).'/../../console/sql/similarBlogPosts.sql';
		if (!file_exists($queryFile)) {
			return false;
		}
		$tmp = new IndexedArray();
		foreach($this->Tags as $Tag) {
			$tmp[] = 'Tag.name = '.DBQuery::quote($Tag->get('name'));
		}
		$tagConditions = $tmp->implode(' OR ');
		$query = sprintf(file_get_contents($queryFile), $tagConditions, $this->id);
		return $this->query($query);
	}
}