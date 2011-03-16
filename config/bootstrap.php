<?php

namespace app;

if (getenv('APPLICATION_ENV') == 'ephigenia') {
	require '/Users/ephigenia/Sites/ephFrame/trunc_0.3/ephFrame/core/Library.php';
} else {
	require dirname(__FILE__).'/../../../../ephFrame_0.3/core/Library.php';
}

// add application libs
define('APP_ROOT', realpath(dirname(__DIR__)));
\ephFrame\core\Library::add('app', APP_ROOT);
\ephFrame\core\Library::add('harrison', APP_ROOT.'/vendor/harrison');

require __DIR__.'/config.php';
require __DIR__.'/bootstrap/doctrine.php';
