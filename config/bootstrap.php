<?php

namespace app;

define('COMPILE_START', microtime(true));
define('APP_ROOT', realpath(dirname(__DIR__)));
define('LIB_ROOT', APP_ROOT.'/lib');

defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// intitialize ephFrame 0.3 with it's libs and stuff
define('EPHFRAME_PATH', LIB_ROOT.'/ephFrame/lib/ephFrame');
if (!include EPHFRAME_PATH.'/core/Library.php') {
	$message = 
		'ephFrame core could not be found. Check the value of EPHFRAME_PATH in '.
	 	'config/bootstrap.php. It should point to the directory containing your '.
		'ephFrame directory.';
	die(trigger_error($message, E_USER_ERROR));
}

\ephFrame\core\Library::add('ephFrame', EPHFRAME_PATH);
\ephFrame\core\Library::add('harrison', LIB_ROOT.'/harrison');
\ephFrame\core\Library::add('app',		LIB_ROOT.'/app');

require __DIR__.'/bootstrap/doctrine.php';
require __DIR__.'/config.php';
