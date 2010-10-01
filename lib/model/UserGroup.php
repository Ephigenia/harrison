<?php

/**
 * User Group class
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-05-10
 */
class UserGroup extends AppModel
{	
	public $displayField = 'name';
	
	public $order = array(
		'name' => DBQuery::ORDER_ASC,
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
				'message' => 'Please enter a valid user group name.',
			),
		),
	);
}