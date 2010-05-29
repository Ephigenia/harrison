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
		'Wall',
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
		if ($this->layout == 'mobile') {
			$this->{$this->name}->perPage = 50;
			$this->{$this->name}->depth = 0;
		}
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
		$this->JavaScript->pack = $this->JavaScript->compress = false;
		$this->CSS->clear();
		return $r;
	}
		
	public function index()
	{
		// get data for the admin wall
		if (get_class($this) == 'AdminController') {
			$WallItems = $this->Wall->read($WallModels = array(
				$this->BlogPost,
				$this->Comment,
				$this->User,
				$this->MediaFile,
			));
			$this->set('WallItems', $WallItems);
			$BlogPosts = $this->BlogPost->findAll(null, null, 0, 5, 0);
		}
	}
}