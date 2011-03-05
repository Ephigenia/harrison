<?php

/**
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 20.03.2009
 */
class NodeText extends AppModel
{
	public $behaviors = array(
		'Timestampable',
		'Versionable' => array(
			'field' => 'revision',
		),
		'Sluggable' => array(
			'fields' => array('headline'),
			'maxLength' => 60,
			'uniqueFields' => array(
				'language_id',
			),
			'autoUpdate' => false,
		),
	);
	
	public $belongsTo = array(
		'Node',
	);
	
	public $hasOne = array(
		'User',
		'Language',
	);
}