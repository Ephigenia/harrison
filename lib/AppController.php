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
	
	const VERSION = '0.4.5';
	
	public $helpers = array(
		'HTML',
		'Sanitizer',
		'Time',
	);

	public $theme = 'default';
	
	public $components = array(
		'Scaffold',
		'CSS',
		'JavaScript',
		'AppMetaTags',
		'OpenGraphMetaTags',
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
	 * @var Set
	 */
	public $Languages = array();
	
	public function beforeAction()
	{
		// set languages for view
		// @todo move this to language controller or component
		if ($this->hasModel('Language') && $this->Languages = $this->Language->findAll()) {
			// make languages available in the view
			$this->data->set('Languages', $this->Languages);
			// set new locale from language_id=[de|en|fr] action
			foreach($this->Languages as $Language) {
				if (!empty($this->params['language_id']) && $Language->id == $this->params['language_id']) {
					I18n::locale($Language->locale);
					break;
				}
			}
			// reset locale to default if locale not found in languages
			foreach($this->Languages as $Language) {
				if ($Language->locale == I18n::locale()) $found = true;
			}
			if (@$found !== true) {
				I18n::locale(Registry::get('I18n.language'));
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
		// response as json if requested
		if ($this->request->isAjax() && preg_match('@application\/json|text\/javascript@i', $this->request->header->get('accept'))) {
			$this->layout = 'json';
		}
		if (array_key_exists($this->layout, $layoutContentTypeMapping)) {
			$this->response->header->set('Content-Type', $layoutContentTypeMapping[$this->layout]);
			$this->action .= '.'.$this->layout;
		}
		return parent::beforeAction();
	}
}

/**
 * @package app
 * @subpackage app.libs.exceptions
 */
class AppControllerException extends ControllerException { }