<?php

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ApcCache,
    Entities\User, Entities\Address;

$lib = APP_ROOT.'/vendor/doctrine/lib';
require_once $lib.'/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';

// Set up class loading. You could use different autoloaders, provided by your favorite framework,
// if you want to.
$classLoader = new ClassLoader('Doctrine\ORM', realpath($lib));
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\DBAL', realpath($lib.'/vendor/doctrine-dbal/lib'));
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\Common', realpath($lib.'/vendor/doctrine-common/lib'));
$classLoader->register();
$classLoader = new ClassLoader('Entities', APP_ROOT);
$classLoader->register();
$classLoader = new ClassLoader('Proxies', APP_ROOT);
$classLoader->register();

$config = new Configuration;
// Entities
$config->setMetadataDriverImpl($config->newDefaultAnnotationDriver(array(APP_ROOT.'/entities')));
// Cache
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
$config->setQueryCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
// Proxy
$config->setProxyDir(APP_ROOT.'/tmp/proxies');
$config->setProxyNamespace('proxies');
$config->setAutoGenerateProxyClasses(true);

$connectionOptions = array(
	'driver' => 'pdo_mysql',
	'host' => 'localhost',
	'dbname' => 'horrorblog.org',
	'user' => 'root',
	'password' => '',
);
$em = EntityManager::create($connectionOptions, $config);
$GLOBALS['EntityManager'] = $em;