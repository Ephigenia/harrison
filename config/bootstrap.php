<?php

namespace app;

define('COMPILE_START', microtime(true));
define('APP_ROOT', realpath(dirname(__DIR__)));

// intitialize ephFrame 0.3 with it's libs and stuff
if (getenv('APPLICATION_ENV') == 'ephigenia') {
	define('EPHFRAME_PATH', '/Users/ephigenia/Sites/ephFrame/trunc_0.3/vendor/ephFrame');
} else {
	define('EPHFRAME_PATH', '/kunden/277171_10245/ephFrame_0.3');
}
if (!include EPHFRAME_PATH.'/core/Library.php') {
	$message =
		'ephFrame core could not be found. Check the value of EPHFRAME_PATH in '.
	 	'config/bootstrap.php. It should point to the directory containing your '.
		'ephFrame directory.';
	trigger_error($message, E_USER_ERROR);
}

\ephFrame\core\Library::add('app', APP_ROOT);
\ephFrame\core\Library::add('harrison', APP_ROOT.'/vendor/harrison');

require __DIR__.'/bootstrap/doctrine.php';
require __DIR__.'/config.php';
