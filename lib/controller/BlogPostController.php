<?php

/**
 * Blog Post Controller Class
 *		
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 14.04.2009
 */
class BlogPostController extends AppController
{	
	public $helpers = array(
		'BlogPostFormater',
		'Text',
		'Paginator',
	);
	
	public $uses = array(
		'Comment',
		'MediaFile',
	);
	
	public $components = array(
		'SEOKeywords',
		'ViewMailer',
	);
	
	public $forms = array(
		'CommentForm',
	);
	
	public $publicActions = array(
		'all',
	);
	
	public function beforeAction()
	{
		if ($this->UserLogin->loggedin()) {
			$this->BlogPost->findConditions = array();
		}
		return parent::beforeAction();
	}
	
	public function index()
	{
		if (isset($this->params['page'])) {
			$this->data->appendTo('pageTitle', ' '.__('Seite :1', (int) $this->params['page']));
		}
		if (in_array($this->layout, array('rss', 'ical', 'txt'))) {
			$this->BlogPost->unbind('Comment');
		}
		parent::index();
	}
	
	public function beforeView()
	{
		if (empty($this->params['uri'])) {
			return false;
		}
		if (!($this->BlogPost = $this->BlogPost->findByUri($this->params['uri']))) {
			return false;
		}
		$this->data->set('BlogPost', $this->BlogPost);
		// increase views count
		if ($this->BlogPost->hasField('views')) {
			$this->BlogPost->depth = 0;
			$this->BlogPost->hit('views');
		}
		return true;
	}
	
	public function view($id = null)
	{
		if (is_int($id)) {
			parent::view($id);
		}
		$this->data->set('pageTitle', strip_tags($this->BlogPost->headline));
		$this->AppMetaTags->keywords->fromArray($this->SEOKeywords->extract($this->BlogPost->get('text')));
		// save comments
		if ($this->CommentForm->ok() && $this->request->get('md5') == $this->CommentForm->md5Secret) {
			$this->CommentForm->toModel($this->Comment);
			if ($this->Comment->hasField('ip')) {
				$this->Comment->set('ip', ip2long($this->request->host));
			}
			$this->Comment->foreign_id = $this->BlogPost->id;
			$this->Comment->set('model', 'BlogPost');
			if ($this->UserLogin->loggedin()) {
				$this->Comment->User = $this->UserLogin->User;
			}
			if (!$this->Comment->save()) {
				$this->CommentForm->errors = $this->Comment->validationErrors;
			} else {
				// send comment notification to all admins
				$this->ViewMailer->send(Registry::get('AdminEmail'), 'commentAdminNotification', __('Neuer Kommentar'), array('Comment' => $this->Comment));
				if ($this->hasComponent('ActionCache')) {
					$this->ActionCache->clear($this->name, $this->action);
					$this->ActionCache->clear($this->name, 'index');
				}
				$this->redirect($this->BlogPost->detailPageUri().'#Comments');
			}
		}
		return true;
	}
	
	public function search($q = null, $fields = array())
	{
		if ($this->request->get('q')) {
			$this->redirect(Router::uri('blogSearch', array(
				'q' => $this->request->get('q'))
			));
		}
		parent::search($q, array('text', 'headline', 'tags'));
		$this->action = 'index';
		$this->data->set('q', $q);
		return true;
	}
}