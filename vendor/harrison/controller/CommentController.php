<?php

namespace harrison\controller;

class CommentController extends Controller
{
	public function add($model, $id)
	{
		$Form = new \app\component\Form\Comment();
		if ($this->request->method != \ephFrame\HTTP\RequestMethod::POST) {
			die('FORM NOT POSTED');
		}
		$Form->bind($this->request->data);
		if (!$Form->isValid()) {
			$c = new \harrison\controller\BlogPostController($this->request, array('id' => $id));
			$c->action('view', array($id));
			return $c;
		}
		echo $Form;
		exit;
		
		$Comment = new \app\model\Comment($this->request->data);
		$Comment->ip = @$_SERVER['REMOTE_ADDR'];
		$Comment->$model = $this->entityManager()->find('app\model\\'.ucfirst($model), (int) $id);
		try {
			$this->entityManager()->persist($Comment);
			$this->entityManager()->flush();
		} catch(\Exception $e) {
			$err = new \ephFrame\core\ErrorController($this->request);
			return $err->handleException($e);
		}
	}
}