<?php

namespace app;

// bootstrapping external libraries
// require __DIR__.'/bootstrap/doctrine.php';

if (getenv('APPLICATION_ENV') == 'ephigenia') {
	require '/Users/ephigenia/Sites/ephFrame/trunc_0.3/ephFrame/core/Library.php';
} else {
	require dirname(__FILE__).'/../../../../ephFrame_0.3/core/Library.php';
}

define('APP_ROOT', realpath(dirname(__DIR__)));
\ephFrame\core\Library::add('app', APP_ROOT);

require __DIR__.'/config.php';