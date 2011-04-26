<?php

namespace harrison\controller;

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ApcCache
	;
	
use ephFrame\HTTP\Header,
	ephFrame\HTTP\Response,
	ephFrame\HTTP\StatusCode as HTTPStatusCode;

class Controller extends \ephFrame\core\Controller
{
	protected $entityManager;
	
	protected function entityManager()
	{
		if (empty($this->entityManager)) {
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
			$this->view->SQLLogger = $logger;
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
	
	protected function repository()
	{
		return $this->entityManager()->getRepository('app\model\\'.$this->name);
	}
	
	protected function attachSearchForm()
	{
		$this->view->SearchForm = new \app\component\Form\Search();
		$this->view->SearchForm->bind($this->request->data);
		// redirect to search if search submitted
		if ($this->view->SearchForm['q']->data) {
			$this->response = new Response(
				HTTPStatusCode::TEMPORARY_REDIRECT, new Header(array(
					'Location' => \ephFrame\core\Router::getInstance()->search(array('q' => $this->view->SearchForm['q']->data))
				))
			);
			return true;
		}
	}
	
	public function init()
	{
		$this->view = new \app\component\view\ThemeView();
		$this->view->theme = 'horrorblog';
		$this->view->HTML = new \ephFrame\view\helper\HTML();
		$this->view->Text = new \ephFrame\view\helper\Text();
		$this->view->BlogPostFormater = new \harrison\helper\BlogPostFormater();
		$this->view->pageTitle = 'Harrison';
		$this->attachSearchForm();
	}
}