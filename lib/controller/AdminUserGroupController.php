<?php

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * Admin Groups Controller
 *
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-02
 */
class AdminUserGroupController extends AdminController
{
	public function index()
	{
		$this->data->set('UserGroups', $this->UserGroup->findAll());
	}
	
	public function create()
	{
		$this->addForm('AdminUserGroupForm');
		if ($this->AdminUserGroupForm->ok()) {
			$this->AdminUserGroupForm->toModel($this->UserGroup);
			if (!$this->UserGroup->save()) {
				$this->AdminUserGroupForm->errors = $this->UserGroup->validationErrors;
			} else {
				$this->FlashMessage->set(__('Die neue Gruppe wurde erfolgreich angelegt'), FlashMessageType::SUCCESS);
				$this->redirect(Router::getRoute('adminScaffold', array('controller' => $this->name)));
			}
		}
	}
	
	public function edit($id = null)
	{
		$this->addForm('AdminUserGroupForm');
		$this->AdminUserGroupForm->fillModel($this->UserGroup);
		if ($this->AdminUserGroupForm->ok()) {
			$this->AdminUserGroupForm->toModel($this->UserGroup);
			if (!$this->UserGroup->save()) {
				$this->FlashMessage->set(__('Änderungen wurden erfolgreich gespeichert.'), FlashMessageType::SUCCESS);
				$this->AdminUserGroupForm->errors = $this->UserGroup->validationErrors;
			} else {
				$this->redirect(Router::getRoute('adminScaffold', array('controller' => $this->name)));
			}
		}
	}
	
	public function delete($id = null)
	{
		die('THIS ACTION IS NOT FINISHED');
	}
}