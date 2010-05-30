<?php

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * AdminLanguageController
 *
 * @package harrison
 * @subpackage harrison.controller
 * @since 2009-07-01
 * @author Marcel Eichner
 */
class AdminLanguageController extends AdminController
{
	public $uses = array(
		'Language',
	);
	
	public $forms = array(
		'AdminLanguageForm',
	);
	
	public function index()
	{
		$this->data->set('Languages', $this->Language->findAll());
	}
	
	public function edit($id = null)
	{
		$this->data->set('pageTitle', __(':1 editieren', $this->Language->get('name')));
		$this->AdminLanguageForm->fillModel($this->Language);
		if ($this->AdminLanguageForm->ok()) {
			$this->AdminLanguageForm->toModel($this->Language);
			if (!$this->Language->save()) {
				$this->AdminLanguageForm->errors = $this->Language->validationErrors;
			} else {
				$this->redirect(Router::getRoute('adminLanguage'));
			}
		}
	}
	
	public function create()
	{
		$this->data->set('pageTitle', __('Sprache erstellen'));
		if ($this->AdminLanguageForm->ok()) {
			$this->AdminLanguageForm->toModel($this->Language);
			if (!$this->Language->save()) {
				$this->AdminLanguageForm->errors = $this->Language->validationErrors;
			} else {
				$this->FlashMessage->set(__('Die neue Sprache wurde erfolgreich angelegt.'), FlashMessageType::HINT);
				$this->redirect(Router::getRoute('adminLanguage'));
			}
		}
	}
	
	public function delete($id = null)
	{
		die('DELETE ACTION NOT INCLUDED');
	}
}