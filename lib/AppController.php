<?php

/**
 * ephFrame: <http://code.marceleichner.de/project/ephFrame/>
 * Copyright 2007+, Ephigenia M. Eichner, Kopernikusstr. 8, 10245 Berlin
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright Copyright 2007+, Ephigenia M. Eichner
 * @link http://code.marceleichner.de/projects/ephFrame/
 * @filesource
 */

// load parent class
ephFrame::loadClass('ephFrame.lib.Controller');

/**
 * Applications Main Controller
 * 	
 * The AppController is your main controller in the application. Every
 * controller in this application should be extended by this one. By this
 * you can add main methods, variables, components and helpers that should
 * be available by every controller in the application.
 * 	
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 10.08.2007
 * @package app
 * @subpackage app.lib
 */
class AppController extends Controller
{	
	const NAME = 'Harrison';
	
	const VERSION = '0.4.1';
	
	public $helpers = array(
		'HTML',
		'Sanitizer',
		'Time',
	);

	public $theme = 'default';
	
	public $components = array(
		'CSS',
		'JavaScript',
		'AppMetaTags',
		'UserLogin',
		'FlashMessage',
		'I18n',
		'Browser',
		'ActionCache',
	);
	
	public $data = array(
		'pageTitle' => AppController::NAME,
	);
	
	public $publicActions = array();
	
	public $forms = array(
		'SearchForm'
	);
	
	public $uses = array(
		'BlogPost',
		'User',
		'Node',
		'Language',
	);
	
	/**
	 *	@var Set
	 */
	public $Languages = array();
	
	public function afterConstruct()
	{
		// mobile content
		if (!empty($this->request->data['mobile']) || $this->request->header->get('host') == 'm.'.$this->request->host
			|| $this->Browser->isType(BrowserTypes::MOBILE) || 1 == 1) {
			$this->layout = 'mobile';
			$this->data->set('isMobile', true);
			$this->params['mobile'] = true;
		}
		return parent::afterConstruct();
	}
	
	public function beforeAction()
	{
		// set nodes to find all nodes
		if (isset($this->Node) && $this->UserLogin->loggedin()) {
			$this->Node->findConditions = array();
		}
		// set languages for view
		if ($this->hasModel('Language') && $this->Languages = $this->Language->findAll()) {
			// make languages available in the view
			$this->data->set('Languages', $this->Languages);
			// reset locale to default if browser language not default language
			if (!empty($this->params['language_id'])) foreach($this->Languages as $Language) {
				if ($Language->id != $this->params['language_id']) continue;
				I18n::locale($Language->locale);
			}
		}
		// detect desired content type and return headers and change
		// action to use different template
		$layoutContentTypeMapping = array(
			'json' => 'application/json',
			'rss' => 'application/rss+xml',
			'vcal' => 'text/calendar',
			'txt' => 'text/plain',
		);
		if ($this->layout !== 'mobile' && $this->request->isAjax()) {
			$this->layout = 'json';
			Registry::set('DEBUG', DEBUG_PRODUCTION);
		}
		if (array_key_exists($this->layout, $layoutContentTypeMapping)) {
			$this->response->header->set('Content-Type', $layoutContentTypeMapping[$this->layout]);
			$this->action .= '.'.$this->layout;
		}
		return parent::beforeAction();
	}
	
	public function beforeRender()
	{
		// add debug style that adds some style to the debug output
		if (Registry::read('DEBUG') >= DEBUG_VERBOSE) {
			$this->CSS->addFile('debug');
		}
		$this->CSS->compress = $this->CSS->pack = false;
		$this->JavaScript->compress = $this->JavaScript->pack = false;
		$this->data->set('theme', $this->theme);
		// mobile additions
		if ($this->layout == 'mobile' && $this instanceof AdminController) {
			$this->action .= '.mobile';
		}
		return parent::beforeRender();
	}
	
	public function afterRender($rendered)
	{
		if (!$this->UserLogin->loggedin()) {
			Log::write('access', $this->name.'/'.$this->action.', '.$this->request->hostname().', referer: '.coalesce($this->request->referer, '[empty]'));
		}
		if ($this->viewClassName == 'HTMLView') {
			$rendered = preg_replace('@</body>@', '<!-- '.ephFrame::compileTime(4).' --></body>', $rendered);
		}
		return parent::afterRender($rendered);
	}
}

/**
 * @package app
 * @subpackage app.libs.exceptions
 */
class AppControllerException extends ControllerException { }