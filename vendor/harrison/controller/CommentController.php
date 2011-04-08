<?php

namespace harrison\controller;

class CommentController extends Controller
{
	public function add()
	{
		$Comment = new \app\model\Comment($this->request->data);
		var_dump($Comment);
		var_dump($this->request->data);
		die(var_dump($this->params));
	}
}