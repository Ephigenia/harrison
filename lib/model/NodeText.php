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
		'Versionable',
		'Sluggable' => array(
			'fields' => array('headline'),
			'maxLength' => 60,
			'uniqueFields' => array(
				'language_id',
			),
			'autoUpdate' => true,
		),
	);
	
	public $belongsTo = array(
		'User',
		'Node',
		'Language',
	);
}