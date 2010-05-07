<?php

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * Administration Controller for Comments
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 15.04.2009
 */
class AdminCommentController extends AdminController
{	
	public $uses = array(
		'Comment',
	);

	public function beforeAction()
	{
		$this->Comment->findConditions = array();
		if (!empty($this->params['id'])) {
			if (!$this->Comment->fromId((int) $this->params['id'])) return false;
			$this->data->set('Comment', $this->Comment);
		}
		return parent::beforeAction();
	}
	
	public function index()
	{
		// filter comments from specific blog post
		if ($blogPostId = @$this->params['blogPostId']) {
			if (!$BlogPost = $this->BlogPost->findById(@$blogPostId)) {
				$this->FlashMessage->set(__('Blogpost wurde nicht gefunden'), FlashMessageType::ERROR);
				$this->redirect(Router::getRoute('adminComment'));
			}
			$this->Comment->findConditions['Comment.foreign_id'] = $blogPostId;
			$this->data->set('BlogPost', $BlogPost);
		}
		$this->Comment->perPage = 10;
		$page = intval((@$this->params['page'] > 1) ? $this->params['page'] : 1);
		$this->data->set('Comments', $this->Comment->findAll(null, null, ($page - 1) * $this->Comment->perPage, $this->Comment->perPage));
		$pagination = $this->Comment->paginate($page, $this->Comment->perPage);
		$pagination['url'] = Router::getRoute('adminCommentPaged');
		$this->data->set('pagination', $pagination);
		return true;
	}
	
	public function edit($id = null)
	{
		$this->addForm('AdminCommentForm');
		if (!$this->AdminCommentForm->ok()) {
			$this->AdminCommentForm->fillModel($this->Comment);
		} else {
			$this->AdminCommentForm->toModel($this->Comment);
			if ($this->Comment->save()) {
				$this->FlashMessage->set(__('Kommentar erfolgreich gespeichert.'), FlashMessageType::SUCCESS);
				$this->redirect(Router::getRoute('adminComment'));
			}
			$this->CommentForm->errors = $this->Comment->validationErrors;
		}
	}
	
	public function delete($id = null)
	{
		if ($this->Comment->delete()) {
			$this->FlashMessage->set(__('Der Kommentar wurde erfolgreich gelöscht.'), FlashMessageType::SUCCESS);
		} else {
			$this->FlashMessage->set(__('Fehler beim Löschen des Kommentars'), FlashMessageType::ERROR);
		}
		$this->redirect(Router::getRoute('adminComment'));
	}
	
	public function approve($id)
	{
		$this->Comment->status = Status::PUBLISHED;
		$this->Comment->save();
		$this->redirect(Router::getRoute('adminComment'));
	}
}