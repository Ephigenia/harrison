<?php

Registry::set('DEBUG', DEBUG_DEVELOPMENT);
Registry::set('AdminEmail', 'love@ephigenia.de');

class DBConfig
{	
	/**
	 * 	Default database connection string, see {@link DBDSN} 
	 *	@var string
	 */
	public $default = 'mysql://root:@localhost:3306/horrorblog.org/#utf8';
}