<?php

namespace app\controller;

class Controller extends \ephFrame\core\Controller
{	
	public function beforeRender()
	{
		$this->view->data += array(
			'HTML' => new \ephFrame\view\helper\HTML(),
			'pageTitle' => 'Harrison',
		);
		return parent::beforeRender();
	}
}