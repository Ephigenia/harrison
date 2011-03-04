<?php 

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * Admin Node Controller
 *
 * @since 2009-08-11
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @package harrison
 * @subpackage harrison.lib.controller
 */
class AdminNodeController extends AdminController
{
	public $uses = array(
		'Node',
		'NodeText',
		'MediaFile',
		'MediaText',
	);
	
	public $publicActions = array();
	
	public function index()
	{
		$this->data->set('Nodes', $this->Node->tree(null, 0));
		$this->data->set('pageTitle', __('Seiten'));
	}
	
	public function beforeAction()
	{
		$this->Node->findConditions = array();
		if (in_array($this->action, array('edit', 'create'))) {
			$this->addForm('AdminNodeForm');
			$this->addForm('AdminNodeTextForm');
		}
		return parent::beforeAction();
	}
	
	public function edit($id = null)
	{
		$this->data->set('pageTitle', __('Seite editieren'));
		$this->AdminNodeForm->delete('headline');
		$this->AdminNodeForm->delete('subline');
		$this->AdminNodeForm->delete('text');
		$this->AdminNodeForm->delete('tags');
		$this->AdminNodeForm->delete('url');
		$this->AdminNodeForm->delete('excerpt');
		foreach($this->Languages as $Language) {
			$TextModel = $this->Node->{'NodeText'.ucfirst($Language->id)};
			$TextModel->Node = $this->Node;
			$TextModel->User = $this->UserLogin->User;
			$Form = new AdminNodeTextForm();
			$Form->startUp();
			$Form->attributes->set('name', 'AdminNodeTextForm'.ucfirst($Language->id));
			$Form->attributes->set('id', 'AdminNodeTextForm'.ucfirst($Language->id));
			$Form->init($this);
			$Form->configure();
			$Form->fromModel($TextModel);
			// $Form->attributes->set('action', WEBROOT.$this->request->data['__url']);
			$Form->language_id->value($Language->id);
			$this->data->set('AdminNodeTextForm'.ucfirst($Language->id), $Form);
			if ($Form->ok() && $this->request->data['language_id'] == $Language->id) {
				$Form->toModel($TextModel);
				if (!$TextModel->save()) {
					$Form->errors = $TextModel->validationErrors;
				} else {
					$this->FlashMessage->set(__('Erfolgreich Seite <q>:1</q> (:2) gespeichert', $TextModel->get('headline'), $Language->get('name')));
					$this->redirect(Router::url());
				}
			}
		}
		// normale form
		if ($this->AdminNodeForm->ok()) {
			$this->AdminNodeForm->toModel($this->Node);
			if (!$this->Node->saveAll()) {
				$this->AdminNodeForm->errors = $this->Node->validationErrors;
			} else {
				$this->FlashMessage->set(__('Änderungen erfolgreich gespeichert.'), FlashMessageType::SUCCESS);
				$this->redirect($this->Node->adminDetailPageUri(array('action' => 'edit')));
			}
		} else {
			$this->AdminNodeForm->fromModel($this->Node);
		}
	}
	
	public function create()
	{
		if ($this->Node->exists()) {
			$this->AdminNodeForm->parent->value($this->Node->id);
			$this->data->set('pageTitle', __('Unterseite erstellen'));
		} else {
			$this->data->set('pageTitle', __('Seite erstellen'));
		}
		if ($this->AdminNodeForm->ok()) {
			$defaultLanguageId = ucfirst(substr(Registry::get('I18n.language'), 0, 2));
			$Node = new Node();
			$Node->set('name', $this->AdminNodeForm->headline->value());
			$Node->User = $this->UserLogin->User;
			$Node->Parent = new Node((int) $this->AdminNodeForm->parent->value());
			$Node->addFlag(NodeFlag::ALLOW_CHILDREN, NodeFlag::ALLOW_DELETE, NodeFlag::ALLOW_EDIT, NodeFlag::ALLOW_IMAGES);
			$this->AdminNodeForm->toModel($Node);
			$this->AdminNodeForm->toModel($Node->{'NodeText'.$defaultLanguageId});
			foreach($this->Languages as $Language) {
				$Node->{'NodeText'.ucFirst($Language->id)}->User = $this->UserLogin->User;
			}
			if ($Node->saveAll()) {
				$this->FlashMessage->set(__('Die Seite wurde erfolgreich angelegt.'), FlashMessageType::SUCCESS);
				$this->redirect(Router::getRoute('adminNode'));
			}
			$this->AdminNodeForm->error = $Node->validationErrors;
		}
	}
	
	public function delete($id = null)
	{
		$name = $this->Node->getText('headline', null, $this->Node->get('name'));
		if ($this->Node->delete()) {
			$this->FlashMessage->set(__('Die Seite <q>:1</q> und Unterseiten wurden erfolgreich gelöscht.', $name), FlashMessageType::SUCCESS);
		}
		$this->redirect(Router::getRoute('adminNode'));
	}
	
	public function move($id = null, $direction = null)
	{
		if ($this->Node->move($direction)) {
			$name = $this->Node->getText('headline', null, $this->Node->get('text'));
			$this->FlashMessage->set(__('Die Seite <q>:1</q> wurde erfolgreich verschoben.', $name), FlashMessageType::SUCCESS);
		}
		$this->redirect(Router::getRoute('adminNode'));
	}
}