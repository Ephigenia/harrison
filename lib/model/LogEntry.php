<?php

/**
 * LogEntry class
 *
 * @package app
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-08-31
 */
class LogEntry extends AppModel 
{
	public $belongsTo = array(
		'MediaFile',
	);
}