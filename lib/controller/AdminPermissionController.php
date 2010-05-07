<?php

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * Permissions Admin Controller
 *
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-16
 */
class AdminPermissionController extends AdminController
{
	public function index()
	{
		$this->data->set('Permissions', $this->Permission->findAll());
	}
	
	public function create()
	{
		$this->addForm('AdminPermissionForm');
		if ($this->AdminPermissionForm->ok()) {
			$this->AdminPermissionForm->toModel($this->Permission);
			if (!$this->Permission->save()) {
				$this->AdminPermissionForm->errors = $this->Permission->validationErrors;
			} else {
				$this->FlashMessage->set(__('Das neue Zugriffsrecht wurde erfolgreich angelegt'), FlashMessageType::SUCCESS);
				$this->redirect(Router::getRoute('adminScaffold', array('controller' => $this->name)));
			}
		}
	}
	
	public function delete($id = null)
	{
		if (parent::delete($id)) {
			$this->FlashMessage->set(__('Zugriffsrecht erfolgreich gelöscht.'), FlashMessageType::SUCCESS);
		} else {
			$this->FlashMessage->set(__('Fehler beim Löschen des Zugriffsrecht.'), FlashMessageType::ERROR);
		}
		$this->redirect(Router::getRoute('adminScaffold', array('controller' => $this->name)));
	}
}