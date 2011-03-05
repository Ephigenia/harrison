<?php

/**
 * Permission class
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @since 2009-08-11
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class Permission extends AppModel
{
	public $displayField = 'name';
	
	public $validate = array(
		'name' => array(
			'name' => 'notEmpty',
			'rule' => 'notEmpty',
		),
	);
}