<?php

/**
 * Language Model
 *
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 21.01.2009
 * @package harrison
 * @subpackage harrison.lib.model
 */
class Language extends AppModel
{
	protected $cacheQueries = true;
	
	public $validate = array(
		'locale' => array(
			'valid' => array(
				'regexp' => '@^[a-z]{2}_[A-Z]{2}$@',
				'message' => 'Please enter a valid locale string.',
			),
		),
		'name' => array(
			'valid' => array(
				'regexp' => '@[^\x00-\x1F\7F]{3,}@',
				'message' => 'Invalid name passed, please type at least 3 characters',
			),
		),
	);
}