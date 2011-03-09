<?php

namespace app\controller;

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ApcCache
	;

class Controller extends \ephFrame\core\Controller
{
	protected $entityManager;
	
	protected function entityManager()
	{
		if (empty($this->entitiyManager)) {
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
			$logger = new \Doctrine\DBAL\Logging\DebugStack;
			$this->view->data['SQLLogger'] = $logger;
			$config->setSQLLogger($logger);
			// establish connection
			$connectionOptions = array(
				'driver' => 'pdo_mysql',
				'host' => 'localhost',
				'dbname' => 'horrorblog.org',
				'user' => 'root',
				'password' => '',
			);
			$this->entityManager = EntityManager::create($connectionOptions, $config);
			$this->entityManager->getConnection()->setCharset('UTF8');
		}
		return $this->entityManager;
	}
	
	public function beforeRender()
	{
		$this->view->data += array(
			'HTML' => new \ephFrame\view\helper\HTML(),
			'Text' => new \ephFrame\view\helper\Text(),
			'BlogPostFormater' => new \app\helper\BlogPostFormater(),
			'pageTitle' => 'Harrison',
		);
		return parent::beforeRender();
	}
}