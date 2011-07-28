<?php

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ApcCache;

$lib = APP_ROOT.'/lib/doctrine/lib';
require_once $lib.'/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';

// Set up class loading. You could use different autoloaders, provided by your favorite framework,
// if you want to.
$classLoader = new ClassLoader('Doctrine\ORM', realpath($lib));
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\DBAL', realpath($lib.'/vendor/doctrine-dbal/lib'));
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\Common', realpath($lib.'/vendor/doctrine-common/lib'));
$classLoader->register();
$classLoader = new ClassLoader('Entities', APP_ROOT.'/lib/harrison/model');
$classLoader->register();
$classLoader = new ClassLoader('Proxies', APP_ROOT);
$classLoader->register();

// Extensions
$classLoader = new \Doctrine\Common\ClassLoader('DoctrineExtensions', APP_ROOT.'/lib/DoctrineExtensions/lib');
$classLoader->register();