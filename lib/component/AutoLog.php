<?php

/**
 * AutoLogging Component
 *
 * @package harrison
 * @subpackage harrison.lib.component
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-10-10
 */
class AutoLog extends AppComponent
{
	public $components = array(
		'UserLogin',
	);
	
	/**
	 * Array of controller => action pairs that are enabled for logging
	 * @var array(string)
	 */
	protected $allowed = array(
		'User' => array('login', 'logout', 'lostpass', 'add', 'confirm', 'view'),
		'Node' => array('edit', 'create'),
		'BlogPost' => array('edit', 'create'),
		'MediaFile' => array('upload', 'edit', 'download'),
	);
	
	public function startup()
	{
		$this->controller->addModel('LogEntry');
		return parent::startup();
	}
	
	/**
	 * Tests if the $controller / $action pair is enabled for logging and
	 * returns a boolean value
	 * @param string|Controller $controller
	 * @param string $action
	 * @return boolean
	 */
	protected function allowed($controller, $action)
	{
		if ($controller instanceof Controller) $controller = $controller->name;
		if (!$this->UserLogin->loggedin()) {
			return false;
		}
		if (isset($this->allowed[$controller]) && in_array($action, $this->allowed[$controller])) {
			return true;
		}
		return false;
	}
	
	/**
	 * Creates a default array that can be saved in the {@link LogEntry} model
	 * you can extend this method and the array in your own Logging Component
	 * by extending this component.
	 * @return array(string)
	 */
	protected function createLogEntry()
	{
		// default log entry
		$LogEntry = new LogEntry(array(
			'controller' => $this->controller->name,
			'action' => $this->controller->action,
			'params' => json_encode($this->controller->params),
		));
		// add user id from authentification
		if ($this->UserLogin->loggedin()) {
			$LogEntry->user_id = $this->UserLogin->User->id;
		}
		return $LogEntry;
	}
	
	/**
	 * Creates a default array that can be saved in the {@link LogEntry} model
	 * you can extend this method and the array in your own Logging Component
	 * by extending this component.
	 * @return array(string)
	 */
	public function beforeRedirect($url, $status = 'p', $exit = true)
	{
		if ($this->allowed($this->controller, $this->controller->action)) {
			$LogEntry = $this->createLogEntry();
			$LogEntry->save();
		}
		parent::afterAction();
	}
}