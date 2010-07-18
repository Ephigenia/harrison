<?php

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * admin user class
 *
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 15.03.2009
 */
class AdminUserController extends AdminController
{	
	public $publicActions = array(
		'login',
		'logout',
	);
	
	public $forms = array(
		'AdminSearchForm',
	);
	
	public $uses = array(
		'User',
		'Log',
	);
	
	public $components = array(
		'ViewMailer',
	);
	
	public function login()
	{
		$this->data->set('pageTitle', __('Login'));
		$this->addForm('LoginForm');
		if ($this->LoginForm->ok()) {
			try {
				$this->UserLogin->login(
					$this->LoginForm->{$this->UserLogin->usernameField}->value(),
					$this->LoginForm->password->value(),
					(bool) $this->LoginForm->permanent->value()
				);
				$this->redirect(Router::getRoute('admin'));
			} catch (UserLoginBlockedUserException $e) {
				$this->LoginForm->errors = __('Dieser Benutzeraccount ist zur Zeit gesperrt und kann sich nicht einloggen!');
			} catch (UserLoginFailedException $e) {
				$this->LoginForm->errors = __('Fehler beim Einloggen. Bitte überprüfen Sie Ihre Eingaben!');
			}
			return true;
		}
	}
	
	public function logout()
	{
		$this->UserLogin->logout();
		if (!$this->request->isAjax()) {
			$this->redirect(Router::getRoute('root'));
		} else {
			$this->action('login');
		}
	}
	
	public function index() 
	{
		$page = (isset($this->params['page'])) ? (int) $this->params['page'] : 1;
		$perPage = 20;
		$pagination = $this->User->paginate($page, $perPage);
		$pagination['url'] = Router::getRoute('adminUserPaged');
		$this->data->set('pagination', $pagination);
		$this->data->set('Users', $this->User->findAll(null, null, ($page-1) * $perPage, $perPage));
		$this->data->set('pageTitle', __n(':1 Benutzer', ':1 Benutzer', $pagination['total']));
	}
	
	public function edit($id = null)
	{
		$this->data->set('pageTitle', __(':1 editieren', $this->User->get('name')));
		$this->addForm('AdminUserForm');
		$this->AdminUserForm->fillModel($this->User);
		if ($this->AdminUserForm->ok()) {
			$this->AdminUserForm->toModel($this->User, null, array('password'));
			// change user’s password
			$newPass = $this->AdminUserForm->password->value();
			if (!empty($newPass)) {
				$this->User->password = $this->User->maskPassword($newPass);
			}
			if ($this->User->save()) {
				$this->FlashMessage->set(__('Die Änderungen an :1 wurden erfolgreich gespeichert.', $this->User->get('name')), FlashMessageType::SUCCESS);
				$this->redirect($this->User->adminDetailPageUri());
				return true;
			}
			$this->AdminUserForm->errors = $this->User->validationErrors();
		}
	}
	
	public function create()
	{
		$this->addForm('AdminUserForm');
		$this->data->set('pageTitle', __('Neuen Benutzer erstellen'));
		if ($this->AdminUserForm->ok()) {
			$this->data->set('User', $this->User);
			$this->AdminUserForm->toModel($this->User);
			// generate user password if empty
			if ($this->User->isEmpty('password')) {
				$this->User->password = String::generateHumanReadablePassword(10);
			}
			// save user
			if (!$this->User->save()) {
				$this->AdminUserForm->errors = $this->User->validationErrors;
				return true;
			}
			// send optional email
			if ($this->AdminUserForm->sendMail->value()) {
				$this->ViewMailer->subject = __('Neue Zugangsdaten für :1', AppController::NAME);
				if (!$this->ViewMailer->send($this->User->email, 'adminUserCreate')) {
					$this->set('errorEmail', true);
					$User->delete();
					return true;
				}
			}
			$this->FlashMessage->set(__('Benutzer <q>:1</q> erfolgreich angelegt.', $this->User->get('name')), FlashMessageType::SUCCESS);
			$this->redirect(Router::getRoute('adminUser'));
		}
	}
	
	public function nodes()
	{
		$this->Node->unbind('MediaFile');
		$this->data->set('Nodes', $this->Node->findAll(array('Node.user_id' => $this->User->id)));
	}
	
	public function log()
	{
		$page = (isset($this->params['page'])) ? (int) $this->params['page'] : 1;
		$this->LogEntry->findConditions['LogEntry.user_id'] = $this->UserLogin->User->id;
		$perPage = 20;
		$pagination = $this->LogEntry->paginate($page, $perPage);
		$pagination['url'] = Router::getRoute('adminUserPaged');
		$this->data->set('pagination', $pagination);
		$this->data->set('LogEntries', $this->LogEntry->findAll(null, null, ($page-1) * $perPage, $perPage));
	}
	
	public function resendPassword()
	{
		// send new user password
		$this->User->password = String::generateHumanReadablePassword(10);
		$this->ViewMailer->subject = sprintf(__('Neues Passwort für %s'), AppController::NAME);
		if (!$this->ViewMailer->send($this->User->email, 'adminUserResendPassword')) {
			$this->FlashMessage->set(__('Fehler beim Versenden der Email - Bitte versuchen Sie es später erneut.'), FlashMessageType::ERROR);
		} else {
			$this->User->password = $this->User->maskPassword($this->User->password);
			$this->User->save();
			$this->FlashMessage->set(__('Der Benutzer :1 sollte in wenigen Minuten eine Email mit seinem neuem Passwort erhalten.', $this->User->get('name')), FlashMessageType::SUCCESS);
		}
		$this->redirect(Router::getRoute('adminUser'));
	}
	
	public function delete($id = null)
	{
		$this->FlashMessage->set(__('Benutzer <q>:1</q> erfolgreich gelöscht.', $this->User->get('name')), FlashMessageType::SUCCESS);
		$this->User->delete();
		$this->redirect(Router::getRoute('adminUser'));
	}
	
	public function block()
	{
		$this->FlashMessage->set(__('Benutzer <q>:1</q> erfolgreich blockiert.', $this->User->get('name')), FlashMessageType::SUCCESS);
		$this->User->addFlag(UserFlag::BLOCKED);
		$this->User->save();
		$this->redirect($this->User->adminDetailPageUri());
	}
	
	public function unblock()
	{
		$this->FlashMessage->set(__('Benutzer <q>:1</q> erfolgreich freigegeben.', $this->User->get('name')), FlashMessageType::SUCCESS);
		$this->User->removeFlag(UserFlag::BLOCKED);
		$this->User->save();
		$this->redirect($this->User->adminDetailPageUri());
	}
}