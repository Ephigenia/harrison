<?php

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ApcCache;

// $lib = APP_ROOT.'/vendor/doctrine/lib';
// require_once $lib.'/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';

// Set up class loading. You could use different autoloaders, provided by your favorite framework,
// if you want to.
// $classLoader = new ClassLoader('Doctrine\ORM', realpath($lib));
// $classLoader->register();
// $classLoader = new ClassLoader('Doctrine\DBAL', realpath($lib.'/vendor/doctrine-dbal/lib'));
// $classLoader->register();
// $classLoader = new ClassLoader('Doctrine\Common', realpath($lib.'/vendor/doctrine-common/lib'));
// $classLoader->register();
// $classLoader = new ClassLoader('Entities', APP_ROOT.'/entities');
// $classLoader->register();
// $classLoader = new ClassLoader('Proxies', APP_ROOT);
// $classLoader->register();
// 
// // Extensions
// $classLoader = new \Doctrine\Common\ClassLoader('DoctrineExtensions', APP_ROOT.'/vendor/DoctrineExtensions/lib');
// $classLoader->register();

$lib = APP_ROOT.'/vendor/couchdb_odm/lib';
require_once $lib.'/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';

// CouchDB
$loader = new \Doctrine\Common\ClassLoader("Doctrine\Common", $lib . "/vendor/doctrine-common/lib");
$loader->register();
$loader = new \Doctrine\Common\ClassLoader("Doctrine\ODM\CouchDB", $lib);
$loader->register();
$loader = new \Doctrine\Common\ClassLoader("Doctrine\CouchDB", $lib);
$loader->register();
$loader = new \Doctrine\Common\ClassLoader("Symfony", $lib."/vendor");
$loader->register();

$databaseName = "harrison";
$documentPaths = array(APP_ROOT.'/model');
$httpClient = new Doctrine\CouchDB\HTTP\SocketClient();
$dbClient = new Doctrine\CouchDB\CouchDBClient($httpClient, $databaseName);

$config = new Doctrine\ODM\CouchDB\Configuration();
$metadataDriver = $config->newDefaultAnnotationDriver($documentPaths);

$config->setProxyDir(__DIR__ . "/proxies");
$config->setMetadataDriverImpl($metadataDriver);
$config->setLuceneHandlerName('_fti');
$dm = new \Doctrine\ODM\CouchDB\DocumentManager($dbClient, $config);


$BlogPost = new app\model\BlogPost('my headline', array('huhu', 'haha', 'hehe'));
$dm->persist($BlogPost);
$dm->flush();
var_dump($BlogPost);
exit;

$u = $dm->find('app\model\BlogPost', 'b0a3f80d6e23e506a1c6ffe202017845');
var_dump($u);

// var_dump($dm);
die();