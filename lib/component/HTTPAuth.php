<?php

/**
 * Basic HTTP Authentification Component
 * 
 * @author Marcel Eichner // Ephigenia <marcel.eichner@elementar.net>
 * @since 2010-01-13
 * @package ditt.atlas
 * @subpackage ditt.atlas.lib.components
 */
class HTTPAuth extends AppComponent
{
	public $realm = 'DITT Technologieatlas';
	
	public $logins = array(
		array(
			'regexp' => 'admin/.*',
			'logins' => '../../../.htpasswd',
		),
	);
	
	public function beforeAction()
	{
		$username = strtolower(get_current_user());
		switch($username) {
			case 'ephigenia':
				$this->logins = array();
				break;
		}
		// authenticate
		if (!empty($_GET['PHP_AUTH'])) {
			$authData = explode(':', base64_decode(substr($_GET['PHP_AUTH'],6)));
			$_SERVER['PHP_AUTH_USER'] = $authData[0];
			$_SERVER['PHP_AUTH_PW'] = $authData[1];
		}
		if (!$this->authenticate(@$_SERVER['PHP_AUTH_USER'], @$_SERVER['PHP_AUTH_PW'])) {
			$this->unauthorized();
		}
		return parent::beforeAction();
	}
	
	protected function needsAuthentification($path)
	{
		foreach($this->logins as $data) {
			if (preg_match('@'.$data['regexp'].'@i', $path)) return $data;
		}
		return false;
	}
	
	protected function authenticate($username, $password)
	{
		if (!($config = $this->needsAuthentification(Router::uri()))) {
			return true;
		}
		if (empty($username) || empty($password)) {
			return false;
		}
		// from file .htpasswd
		if (is_string($config['logins'])) {
			$filename = $config['logins'];
			if (!file_exists($filename)) {
				die($filename.' not found');
			}
			foreach(file($filename) as $line) {
				list($user, $pass) = explode(':', $line);
				if ($user == $username && $pass == crypt($password, substr($password, 0, 2))) return true;
			}
		// from plain config
		} else {
			foreach($config['logins'] as $u => $p) {
				if ($username == $u && $p == $password) return true;
			}
		}
		return false;
	}
	
	protected function unauthorized()
	{
		header('WWW-Authenticate: Basic realm="'.$this->realm.'"', true);
		header('HTTP/1.1 401 Unauthorized', true);
		die('401 Unauthorized');
	}
}