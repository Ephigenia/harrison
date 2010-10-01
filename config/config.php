<?php

/**
 * This file is included after all ephFrame configuration vars
 * are set, you can modify configuration variables by overwriting
 * them.
 * @package app
 * @subpackage app.config
 */

/**
 * Set a new debug level when you're in production, you can assign
 * the debug level to different server adresses by using the
 * third argument for Registry::set, see {@link Registry}
 * (The Debug Level Constants are set in ephFrame/config/constants.php)
 */
Registry::set('DEBUG', DEBUG_PRODUCTION);
Registry::set('AdminEmail', 'noreply@nowhere.de');

Registry::set('ContactEmail', Registry::get('AdminEmail'));

// default session name
Registry::set('Session', array(
	'name' => 'harrison',
	'ttl' => WEEK,
));

/**
 * Salt for use in password creation or anything else that need so be salted
 * change this as soon as you can to increase security!
 */
define('SALT', 'iTh3equahzeegheem4eizei5reizaixu');

// default application language
Registry::set('I18n.language', 'de_DE');

/**
 * TimeZone Setting
 * This Setting influences alle location based methods of php
 */ 
date_default_timezone_set('Europe/Berlin');

Registry::set('DB.tablenamePrefix', 'harrison_');


/**
 * Action Cache Configuration
 */
Registry::set('ActionCache', array(
	'Node' => array(
		'view' => WEEK,
		'index' => DAY,
		'press' => WEEK,
		'contact' => WEEK,
		'search' => WEEK,
		'sitemap' => WEEK,
	),
	'BlogPost' => array(
		'index' => WEEK,
		'rss' => WEEK,
		'view' => WEEK,
		'search' => WEEK,
	),
	'Comment' => array(
		'rss' => WEEK,
	),
));