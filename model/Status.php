<?php

/**
 * Stores constants for different status
 *
 * @package harrison
 * @subpackage harrison.lib.model
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-08-11
 */
class Status
{	
	public $useTable = false;
	
	const PUBLISHED	= 1;
	const PENDING	= 2;
	const DRAFT		= 4;
	
	public static $list = array(
		self::DRAFT		=> 'Entwurf',
		self::PENDING	=> 'Warten auf Freigabe',
		self::PUBLISHED	=> 'Veröffentlicht'
	);
	
	public static function validStatus($status)
	{
		return array_key_exists((int) $status, Status::$list);
	}
}