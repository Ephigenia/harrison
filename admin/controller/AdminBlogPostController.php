<?php

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * Admin Blog Post Controller
 * 
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 14.04.2009
 */
class AdminBlogPostController extends AdminController
{	
	public $uses = array(
		'BlogPost',
	);
	
	public $forms = array(
		'AdminSearchForm',
	);
	
	public function beforeAction()
	{
		$this->BlogPost->findConditions = array();
		return parent::beforeAction();
	}

	public function index()
	{
		$this->BlogPost->unbind('Tag');
		$page = @$this->params['page'] or 1;
		$BlogPosts = $this->BlogPost->findAll(array(
			'offset' => ($page-1) * $this->BlogPost->perPage,
			'limit' => $this->BlogPost->perPage,
			'depth' => 1,
		));
		$this->data->set('BlogPosts', $BlogPosts);
		$pagination = $this->BlogPost->paginate($page, $this->BlogPost->perPage);
		$pagination['url'] = Router::getRoute('adminBlogPostPaged');
		$this->data->set('pagination', $pagination);
		// page title
		$this->data->set('pageTitle', __n(':1 Blogeintrag', ':1 Blogeinträge', $pagination['total']));
	}
	
	public function create()
	{
		$this->data->set('pageTitle', __('Blogeintrag erstellen'));
		$this->addForm('AdminBlogPostForm');
		$this->AdminBlogPostForm->delete('uri');
		if ($this->AdminBlogPostForm->ok()) {
			$BlogPost = new BlogPost(array(
				'User' => $this->UserLogin->User,
				'Language' => new Language($this->AdminBlogPostForm->language_id),
			));
			$this->AdminBlogPostForm->toModel($BlogPost);
			if ($BlogPost->saveAll()) {
				$this->FlashMessage->set(__('Blogeintrag erfolgreich erstellt!'), FlashMessageType::SUCCESS);
				$this->redirect(Router::getRoute('adminBlogPost'));
			}
			$this->AdminBlogPostForm->error = $BlogPost->validationErrors;
		}
	}
	
	public function edit($id = null)
	{
		$this->data->set('pageTitle', $this->BlogPost->get('headline', __('Blogeintrag editieren')));
		$this->addForm('AdminBlogPostForm');
		if (!$this->AdminBlogPostForm->ok()) {
			$this->AdminBlogPostForm->fillModel($this->BlogPost);
		} else {
			$this->AdminBlogPostForm->toModel($this->BlogPost);
			if ($this->BlogPost->saveAll()) {
				$this->FlashMessage->set(__('Blogeintrag erfolgreich editiert.'), FlashMessageType::SUCCESS);
				$this->redirect(Router::getRoute('adminBlogPost'));
			}
			$this->AdminBlogPostForm->errors = $this->BlogPost->validationErrors;
		}
	}
	
	public function delete($id = null)
	{
		if (parent::delete($id)) {
			$this->FlashMessage->set(__('Blogeintrag erfolgreich gelöscht.'), FlashMessageType::SUCCESS);
		} else {
			$this->FlashMessage->set(__('Fehler beim Löschen des Blogeintrags.'), FlashMessageType::ERROR);
		}
		$this->redirect(Router::getRoute('adminBlogPost'));
	}
}