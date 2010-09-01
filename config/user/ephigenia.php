<?php

Registry::set('DEBUG', DEBUG_VERBOSE);
Registry::set('AdminEmail', 'love@ephigenia.de');

Registry::set('DB.tablenamePrefix', 'horrorblog_');

class DBConfig
{	
	public $default = 'mysql://root:@localhost:3306/horrorblog.org/#utf8';
}