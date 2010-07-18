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
		'Scaffold',
		'UserLogin',
		// 'PermissionCheck',
		'FlashMessage',
		'AutoLog',
		'Wall',
		'Browser',
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
		// setting I18N domain to use admin.po files
		$this->I18n->domain(null, 'admin');
		// Serve Mobile Content as soon m.[hostname] called or mobile browser requested
		if (substr($this->request->header->get('host'), 0, 2) == 'm.'
			|| $this->Browser->isType(BrowserTypes::MOBILE)) {
			$this->layout = 'mobile';
			$this->data->set('isMobile', true);
		}
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
		// if mobile layout selected, use other action view files
		if ($this->layout == 'mobile') {
			// and increase number of returned model entries
			if (!empty($this->{$this->name})) {
				$this->{$this->name}->perPage = 50;
				if (!in_array($this->action, array('edit', 'view'))) {
					$this->{$this->name}->depth = 0;
				}
			}
			$this->action .= '.mobile';
		}
		return parent::beforeAction();
	}
		
	public function index()
	{
		// get data for the admin wall
		if (get_class($this) == 'AdminController' && $this->layout !== 'mobile') {
			$this->wall();
		}
		// get total counts for all
		foreach(array('BlogPost', 'Node', 'MediaFile', 'Node', 'User', 'Comment') as $modelName) {
			$count = $this->{$modelName}->countAll();
			$this->data->set($modelName.'TotalCount', $count);
		}
		return true;
	}
	
	public function wall()
	{
		$WallItems = $this->Wall->read($this->WallModels = array(
			$this->Node,
			$this->BlogPost,
			$this->Comment,
			$this->User,
			$this->MediaFile,
		));
		$this->set('pageTitle', __('Aktuelles/Wall'));
		$this->set('WallItems', $WallItems);
		return $WallItems;
	}
}