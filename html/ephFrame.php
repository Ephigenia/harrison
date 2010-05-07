<?php

/**
 * This file stores the path to the ephFrame framework and is loaded from
 * from different locations as the /app/html/index and /app/console/console.php
 * files
 *
 * @package ephFrame
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de
 * @since 2009-09-28
 */

/**
 * modify the require instruction to include the startup.php file from the
 * ephFrame root. (in this example it’s depending on the current user name
 * for deploying on multiple servers)
 */
switch(strtolower(@get_current_user())) {
	case 'ephigenia':
		require '/Users/ephigenia/Sites/ephFrame/trunc/ephFrame/startup.php';
		break;
	default:
		require dirname(__FILE__).'/../../../ephFrame/startup.php';
		break;
}
