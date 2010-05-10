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
		$this->Node->unbind('MediaFile');
		$this->data->set('Nodes', $this->Node->tree(null, 1));
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
		$this->AdminNodeForm->delete('headline');
		$this->AdminNodeForm->delete('subline');
		$this->AdminNodeForm->delete('text');
		$this->AdminNodeForm->delete('keywords');
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
			$Form->attributes->set('action', WEBROOT.$this->request->data['__url']);
			$Form->language_id->value($Language->id);
			$this->data->set('AdminNodeTextForm'.ucfirst($Language->id), $Form);
			if ($Form->ok() && $this->request->data['language_id'] == $Language->id) {
				$Form->toModel($TextModel);
				if (!$TextModel->save()) {
					$Form->errors = $TextModel->validationErrors;
				} else {
					$this->FlashMessage->set(__('Erfolgreich Seite <q>:1</q> (:2) gespeichert', $TextModel->get('headline'), $Language->get('name')));
					$this->redirect(WEBROOT.$this->request->data['__url']);
				}
			}
		}
		// normale form
		if ($this->AdminNodeForm->ok()) {
			$this->AdminNodeForm->toModel($this->Node);
			if (!$this->Node->save()) {
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
		}
		if ($this->AdminNodeForm->ok()) {
			$Node = new Node();
			$Node->User = $this->UserLogin->User;
			$Node->Parent = new Node((int) $this->AdminNodeForm->parent->value());
			$Node->addFlag(NodeFlag::ALLOW_CHILDREN, NodeFlag::ALLOW_DELETE, NodeFlag::ALLOW_EDIT, NodeFlag::ALLOW_IMAGES);
			$Node->NodeTextDe->User = $this->UserLogin->User;
			$this->AdminNodeForm->toModel($Node);
			$this->AdminNodeForm->toModel($Node->NodeTextDe);
			if ($Node->saveAll()) {
				$this->FlashMessage->set(__('Die Seite wurde erfolgreich angelegt.'), FlashMessageType::SUCCESS);
				$this->redirect(Router::getRoute('adminNode'));
			}
			$this->AdminNodeForm->error = $Node->validationErrors;
		}
	}
	
	public function delete($id = null)
	{
		if ($this->Node->delete()) {
			$this->FlashMessage->set(__('Die Seite <q>:1</q> und Unterseiten wurden erfolgreich gelöscht.', $this->Node->get('name')), FlashMessageType::SUCCESS);
		}
		$this->redirect(Router::getRoute('adminNode'));
	}
	
	public function move($id = null, $direction = null)
	{
		$this->Node->move($direction);
		$this->redirect(Router::getRoute('adminNode'));
	}
}