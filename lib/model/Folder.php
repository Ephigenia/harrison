<?php

/**
 * Folder class
 *
 * nested folder class that can store files in it. virtual folders.
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-11-03
 */
class Folder extends AppModel
{	
	public $hasMany = array(
		'MediaFile',
	);
	
	public $behaviors = array(
		'Timestampable',
		'NestedSet',
		'Flagable',
	);
	
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'notEmpty'	=> 'true',
				'message'	=> 'Please enter a name for the folder',
			),
		),
	);
	
	public function beforeSave()
	{
		$this->uri = String::toURL($this->name);
		return parent::beforeSave();
	}
}