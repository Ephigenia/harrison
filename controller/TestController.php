<?php

namespace app\controller;

class TestController extends \ephFrame\core\Controller
{
	public function session()
	{
		$session = new \ephFrame\storage\Session();
		$session->now = date('d.m.y H:i:s');
		$session->count++;
		var_dump($session->now, $session->count);
		exit;
	}
	
	public function sessionRead()
	{
		$session = new \ephFrame\storage\Session();
		var_dump($session->now, $session->now);
	}
	
}