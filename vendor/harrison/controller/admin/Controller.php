<?php

namespace harrison\controller\admin;

class Controller extends \harrison\controller\Controller
{
	public function init()
	{
		$this->callbacks->add('beforeFilter', array($this, 'requireLogin'));
		$this->view = new \app\component\view\ThemeView();
		$this->view->pageTitle = 'Harrison Admin';
		$this->view->HTML = new \ephFrame\view\helper\HTML();
		$this->view->Text = new \ephFrame\view\helper\Text();
		$this->view->theme = 'admin';
	}
	
	public function requireLogin()
	{
		if (!isset($this->loggedin)) {
			
		}
	}
}