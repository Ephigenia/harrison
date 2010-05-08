<?php

/**
 * Group class
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class UserGroup extends AppModel
{	
	public $order = array(
		'name',
	);
	
	public $hasMany = array(
		'User',
	);
	
	public $hasAndBelongsToMany = array(
		'Permission',
	);
	
	public $validate = array(
		'name' => array(
			'valid' => array(
				'regexp' => '@[^\x00-\x1F\7F]{3,}@',
				'message' => 'Please enter a valid email address.',
			)
		),
	);
}