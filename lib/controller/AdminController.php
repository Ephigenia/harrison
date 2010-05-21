<?php

/**
 * Admin Controller
 *
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 09.03.2009
 */
class AdminController extends AppController
{	
	public $helpers = array(
		'Sanitizer',
		'BlogPostFormater',
		'Paginator',
		'Time',
	);
	
	public $components = array(
		'UserLogin',
		// 'PermissionCheck',
		'FlashMessage',
		'AutoLog',
	);
	
	public $uses = array(
		'BlogPost',
		'Comment',
		'MediaFile',
		'Folder',
		'UserGroup',
		'Permission',
	);
	
	public $publicActions = array();
	
	public $theme = 'admin';
	
	public function beforeConstruct()
	{
		$this->name = preg_match_first(get_class($this), '@^Admin(.+)?Controller@');
		if (empty($this->name)) {
			$this->name = 'App';
		}
		return parent::beforeConstruct();
	}
	
	public function afterConstruct()
	{
		$this->Language->findConditions = array();
		$this->I18n->domain(null, 'admin');
		return parent::afterConstruct();
	}
	
	public function beforeAction()
	{
		// auto find model entry when id passed
		if (isset($this->params['id'])) {
			if (!$this->{$this->name}->fromId($this->params['id'])) return false;
			$this->data->set($this->name, $this->{$this->name});
		}
		// send invalid logins (invalid user group) back to loing page
		if (!$this->UserLogin->loggedin() && empty($this->publicActions)) {
			$this->redirect(Router::getRoute('adminLogin'));
		}
		// change language on users locale
		if ($this->hasComponent('I18n') && $this->UserLogin->loggedin() && $this->User->hasField('locale')) {
			$this->I18n->locale($this->UserLogin->User->locale);
		}
		return parent::beforeAction();
	}
	
	public function beforeRender()
	{
		$r = parent::beforeRender();
		$this->set('Session', $this->Session);
		$this->CSS->clear();
		$this->JavaScript->addFiles(array(
			'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
			'js.class.core',
			'php.custom.min',
			'swfobject.js',
			'jquery.plugin.fieldselection',
			'jquery.plugin.dialog',
			'jquery.plugin.simplePreview',
			'jquery.uploadify.v2.1.0.min.js', // uploadify
			'admin',
			'tabs',
		));
		return $r;
	}
		
	public function index()
	{
		if (get_class($this) == 'AdminController') {
			$this->data->set('BlogPosts', $this->BlogPost->findAll(null, null, 0, 5, 0));
			$this->data->set('Comments', $this->Comment->findAll(null, null, 0, 5, 0));
			$this->data->set('Files', $this->MediaFile->findAll(null, array('MediaFile.created DESC'), 0, 4, 0));
		}
	}
}