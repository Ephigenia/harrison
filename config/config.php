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
switch(strtolower(@get_current_user())) {
	// live mode
	default:
		Registry::set('DEBUG', DEBUG_PRODUCTION);
		Registry::set('AdminEmail', 'love@ephigenia.de');
		break;
	// add your own host here
	case 'ephigenia':
		Registry::set('DEBUG', DEBUG_VERBOSE);
		Registry::set('AdminEmail', 'ephigenia@me.com');
		break;
}

Registry::set('ContactEmail', Registry::get('AdminEmail'));

// default session name
Registry::set('Session.name', 'harrison');

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

/**
 * Enable this to render the element names before element itsself,
 * debug.css must be included as well DEBUG > DEBUG_PRODUCTION
 */
// Registry::set('debug.showElementName', true);
