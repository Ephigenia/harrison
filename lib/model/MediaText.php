<?php 

/**
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-04-09
 * @package harrison
 * @subpackage harrison.lib.model
 */
class MediaText extends AppModel
{	
	public $behaviors = array(
		'Versionable',
		'Timestampable',
	);
	
	public $belongsTo = array(
		'User',
		'MediaFile',
		'Language',
	);
}