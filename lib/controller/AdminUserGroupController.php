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
	/**
	 * List all {@link UserGroup}
	 * 
	 * @return array(UserGroup)
	 */
	public function index()
	{
		$UserGroups = $this->UserGroup->findAll();
		$this->data->set('UserGroups', $UserGroups);
		$this->data->set('pageTitle', __('Benutzergruppen'));
		return $UserGroups;
	}
	
	/**
	 * Create new {@link UserGroup}
	 * 
	 * @return boolean
	 */
	public function create()
	{
		$this->data->set('pageTitle', __('Gruppe erstellen'));
		$this->addForm('AdminUserGroupForm');
		if ($this->AdminUserGroupForm->ok()) {
			$this->AdminUserGroupForm->toModel($this->UserGroup);
			if (!$this->UserGroup->save()) {
				$this->AdminUserGroupForm->errors = $this->UserGroup->validationErrors;
			} else {
				$this->FlashMessage->set(__('Die neue Gruppe wurde erfolgreich angelegt'), FlashMessageType::SUCCESS);
				return $this->redirect(Router::getRoute('adminScaffold', array('controller' => $this->name)));
			}
		}
		return true;
	}
	
	/**
	 * Edit single {@link UserGroup}
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	public function edit($id = null)
	{
		$this->data->set('pageTitle', __('Benutzergruppe editieren'));
		$this->addForm('AdminUserGroupForm');
		$this->AdminUserGroupForm->fillModel($this->UserGroup);
		if ($this->AdminUserGroupForm->ok()) {
			$this->AdminUserGroupForm->toModel($this->UserGroup);
			if (!$this->UserGroup->saveAll()) {
				$this->FlashMessage->set(__('Änderungen wurden erfolgreich gespeichert.'), FlashMessageType::SUCCESS);
				$this->AdminUserGroupForm->errors = $this->UserGroup->validationErrors;
			} else {
				return $this->redirect(Router::getRoute('adminScaffold', array('controller' => $this->name)));
			}
		}
		return true;
	}
	
	/**
	 * Delete single {@link UserGroup}
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	public function delete($id = null)
	{
		if ($this->UserGroup->delete()) {
			$this->FlashMessage->set(__('Die Benutzergruppe <q>:1</q> wurder erfolgreich gelöscht.', $this->UserGroup->get('name')), FlashMessageType::SUCCESS);
		} else {
			$this->FlashMessage->set(__('Es ist ein Fehler beim Löschen der Benutzergruppe aufgetreten.'), FlashMessageType::ERROR);
		}
		return $this->redirect(Router::getRoute('adminScaffold', array('controller' => $this->name)));
	}
}