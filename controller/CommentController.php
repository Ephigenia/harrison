<?php

/**
 * Comment Controller
 *
 * @package harrison
 * @subpackage harrison.controller
 * @since 2009-07-16
 * @author Marcel Eichner
 */
class CommentController extends Controller
{
	public function add($model, $id)
	{
		// comments
		if ($this->CommentForm->ok() && $this->request->get('md5') == $this->CommentForm->md5Secret) {
			$this->CommentForm->toModel($this->Comment);
			$this->Comment->foreign_id = $this->BlogPost;
			$this->Comment->model = 'BlogPost';
			if ($this->UserLogin->loggedin()) {
				$this->Comment->User = $this->UserLogin->User;
			}
			if (!$this->Comment->save()) {
				$this->CommentForm->errors = $this->Comment->validationErrors;
			} else {
				// send comment notification to all admins
				$this->ViewMailer->send(Registry::get('AdminEmail'), 'commentAdminNotification', __('Neuer Kommentar'), array('Comment' => $this->Comment));
				if (isset($this->ActionCache)) {
					$this->ActionCache->clear($this->name, $this->action);
				}
				$this->redirect($this->BlogPost->detailPageUri());
			}
		}
	}
}