<?php

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * AdminMediaFileController
 *
 * @package harrison
 * @subpackage harrison.controller
 * @since 2009-07-01
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class AdminMediaFileController extends AdminController
{	
	public $uses = array(
		'MediaFile',
		'Folder',
		'MediaText',
		'Node',
	);
	
	public $forms = array(
		'AdminMediaTextForm',
		'AdminMediaFileForm',
	);

	public function index()
	{
		$this->data->set('pageTitle', __('Dateien'));
		$this->MediaFiles = $this->MediaFile->findAll(null, array('MediaFile.created DESC'), 0, 15);
		$this->data->set('Files', $this->MediaFiles);
		$this->Folders = $this->Folder->findById(1)->children();
		$this->data->set('Folders', $this->Folders);
	}
	
	public function upload()
	{
		// upload to a folder
		if (!empty($this->params['folder_id'])) {
			if (!$this->Folder->fromId((int) $this->params['folder_id'])) {
				return false;
			}
			$this->data->set('Folder', $this->Folder);
			$this->AdminMediaFileForm->delete('folder_id');
			$this->MediaFile->folder_id = $this->Folder->id;
		} elseif (!empty($this->params['nodeId'])) {
			if (!$this->Node->fromId((int) $this->params['nodeId'])) {
				return false;
			}
			$this->data->set('Node', $this->Node);
			$this->MediaFile->node_id = $this->Node->id;
		}
		// get redirect url after successfull upload
		if ($this->Folder->exists()) {
			$redirectUrl = $this->Folder->adminDetailPageUri();
		} elseif($this->Node->exists()) {
			$redirectUrl = $this->Node->adminDetailPageUri(array('action' => 'edit'));
		} else {
			$redirectUrl = Router::getRoute('adminMediaFiles');
		}
		$this->set('redirectUrl', $redirectUrl);
		// process upload
		$uploadedFile = $this->AdminMediaFileForm->file->value();
		if (!empty($uploadedFile)) {
			$this->AdminMediaFileForm->toModel($this->MediaFile);
			$MediaFile = $this->MediaFile->addFile($this->AdminMediaFileForm->file->value(), $this->AdminMediaFileForm->file->originalFilename());
			$MediaFile->User = $this->UserLogin->User;
			$MediaFile->Folder = $this->Folder;
			if (!$MediaFile->save()) {
				return $this->AdminMediaFileForm->errors = $MediaFile->validationErrors;
			}
			$this->FlashMessage->set(__('Datei erfolgreich hochgeladen.'), FlashMessageType::HINT);
			if (@$this->request->data['uploadify'] === '1') {
				echo true;
				exit;
			} else {
				$this->redirect($redirectUrl);
			}
		}
	}
	
	public function move($id, $direction)
	{
		$this->MediaFile->unbind('User');
		$this->MediaFile->move($direction);
		$this->redirect($this->request->referer);
	}
	
	public function delete($id = null)
	{
		if ($this->MediaFile->delete()) {
			$this->FlashMessage->set(__('Die Datei wurde erfolgreich gelöscht.'), FlashMessageType::SUCCESS);
		} else {
			$this->FlashMessage->set(__('Fehler beim Löschen der Datei.'), FlashMessageType::ERROR);
		}
		$this->redirect($this->request->referer);
	}
	
	public function edit($id = null)
	{
		$this->MediaFile = parent::edit($id);
		$this->data->set('pageTitle', $this->MediaFile->getText('title', $this->MediaFile->filename));
		// language and texts
		foreach($this->Languages as $Language) {
			$TextModel = $this->MediaFile->{'Text'.String::ucFirst($Language->id)};
			$TextModel->MediaFile = $this->MediaFile;
			$TextModel->User = $this->UserLogin->User;
			$Form = new AdminMediaTextForm();
			$Form->attributes->set('name', 'AdminMediaTextForm'.ucfirst($Language->id));
			$Form->attributes->set('id', 'AdminMediaTextForm'.ucfirst($Language->id));
			$Form->init($this);
			$Form->startup();
			$Form->configure();
			$Form->fromModel($TextModel);
			$Form->attributes->set('action', WEBROOT.$this->request->data['__url']);
			$Form->language_id->value($Language->id);
			$this->data->set('AdminMediaTextForm'.String::ucFirst($Language->id), $Form);
			if ($Form->ok() && $this->request->data['language_id'] == $Language->id) {
				$Form->toModel($TextModel);
				if (!$TextModel->save()) {
					$Form->errors = $TextModel->validationErrors;
				} else {
					$Form->success = __('Erfolgreich :1 gespeichert', $Language->get('name'), FlashMessageType::SUCCESS);
					$this->redirect(WEBROOT.$this->request->data['__url']);
				}
			}
		}
		// newly uploaded files
		$this->AdminMediaFileForm->file->mandatory(false);
		if ($this->AdminMediaFileForm->ok()) {
			$this->AdminMediaFileForm->toModel($this->MediaFile);
			if ($newFile = $this->AdminMediaFileForm->file->value()) {
				$this->MediaFile->replace($newFile, $this->AdminMediaFileForm->file->originalFilename());
			}
			if (!$this->MediaFile->save()) {
				$this->AdminMediaFileForm->errors = $this->MediaFile->validationErrors;
			} else {
				$this->FlashMessage->set(__('Erfolgreich gespeichert'), FlashMessageType::SUCCESS);
			}
		}
	}
}