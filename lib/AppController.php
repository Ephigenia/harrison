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
		if (isset($this->Language) && $this->Languages = $this->Language->findAll()) {
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
	
	/**
	 * Standard search action, searches for a $key $keyword match and lists
	 * all matches
	 * @deprecated move this to component
	 * @param string $keyword
	 */
	public function search($q = null, $fields = array())
	{
		$results = new IndexedArray();
		$this->data->set('q', $q);
		if (strlen($q) <= 0 || !isset($this->{$this->name}) || empty($fields)) {
			return $results;
		}
		foreach($fields as $fieldname) {
			if (strstr($fieldname, '.') == false) {
				$conditions[] = $this->{$this->name}->name.'.'.$fieldname.' LIKE '.DBQuery::quote('%'.$q.'%').' OR';
			} else {
				$conditions[] = $fieldname.' LIKE '.DBQuery::quote('%'.$q.'%').' OR';
			}
		}
		$page = (isset($this->params['page'])) ? $this->params['page'] : 1;
		$pagination = $this->{$this->name}->paginate($page, null, $conditions);
		$pagination['url'] = Router::getRoute(lcfirst($this->name).'SearchPaged', array('q' => $q));
		$this->data->set('pagination', $pagination);
		$params = array(
			'conditions' => $conditions,
			'offset' => ($page - 1) * $this->{$this->name}->perPage,
			'limit' => $this->{$this->name}->perPage,
		);
		$results = $this->{$this->name}->findAll($params);
		$this->data->set(Inflector::pluralize($this->name), $results);
		return $results;
	}
}

/**
 * @package app
 * @subpackage app.libs.exceptions
 */
class AppControllerException extends ControllerException { }