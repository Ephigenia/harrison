<?php

/**
 * Permission Check component
 * 
 * This component auto-checks the user’s permissions agains it’s desired 
 * controller actions and blocks him if he has not the permission needed.
 * Cheap!
 * 
 * @package harrison
 * @subpackage harrison.lib.component
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-05-10
 */
class PermissionCheck extends AppComponent
{
	public $Permissions = array();
	
	public $components = array(
		'UserLogin',
		'FlashMessage',
	);

	public function startup()
	{
		if ($this->UserLogin->loggedin()) {
			$this->UserLogin->User->UserGroup = $this->controller->UserGroup->findById($this->UserLogin->User->user_group_id);
			$this->Permissions = $this->UserLogin->User->UserGroup->Permissions;
		}
		return parent::startup();
	}
	
	public function beforeAction()
	{
		$testRoute = get_class($this->controller).$this->controller->action;
		if (!$this->check($testRoute)) {
			Log::write(Log::VERBOSE, sprintf('%s: no match on "%s"', get_class($this), $testRoute));
			$this->FlashMessage->set(__('Sie haben nicht das nötige Zugangsrecht um diese Aktion auszuführen! (:1)', $testRoute), FlashMessageType::ERROR);
		}
		return parent::beforeAction();
	}
	
	public function check($testRoute)
	{
		foreach($this->Permissions as $Permission) {
			Log::write(Log::VERBOSE, sprintf('%s: checking "%s" against "%s"', get_class($this), $testRoute, $Permission->rule));
			if (preg_match('@'.$Permission->rule.'@i', $testRoute)) return true;
		}
		return false;
	}
}