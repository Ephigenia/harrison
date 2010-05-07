<?php

class_exists('Status') or require dirname(__FILE__).'/Status.php';

/**
 * Comment Model Class	
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 15.04.2009
 */
class Comment extends AppModel
{	
	public $data = array(
		'status' => Status::PUBLISHED
	);
	
	const NOTIFY = 1;
	
	public $findConditions = array(
		'Comment.status & 1'
	);
	
	public $belongsTo = array(
		'BlogPost' => array(
			'conditions' => array(
				'model' => '\'BlogPost\'',
			),
			'associationKey' => 'Comment.foreign_id',
			'foreignKey' => 'BlogPost.id',
		),
		'User',
	);
	
	public $order = array(
		'Comment.created DESC'
	);
	
	public $validate = array(
		'email' => array(
			'valid' => array(
				'allowEmpty' => true,
				'regexp' => Validator::EMAIL,
				'message' => 'Please enter a valid email address.',
			)
		),
		'name' => array(
			'valid' => array(
				'regexp' =>'/[^\x00-\x1F\7F]{3,}/',
				'message' => 'Invalid name passed, please type at least 3 characters',
			)
		),
		'url' => array(
			'valid' => array(
				'allowEmpty' => true,
				'regexp' => '@([^.]{1,}\.){1,}@',
				'message' => 'Invalid URL, please pass a valid url.',
			)
		),
		'text' => array(
			'valid' => array(
				'regexp' => '/[^\x00-\x1F\7F]{3,}/',
				'message' => 'Please enter a text with at least 3 characters.',
			)
		)
	);
	
	public function beforeSave()
	{
		$this->url = preg_replace('@^[^:]+:?\/+@', '', $this->url); // strip xxx://
		return parent::beforeSave();
	}
	
	public function detailPageURL()
	{
		return $this->BlogPost->detailPageURL().'#comment'.$this->uniqueId();
	}
}