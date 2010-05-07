<?php

class_exists('AdminController') or require dirname(__FILE__).'/AdminController.php';

/**
 * AdminFolderController
 *
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-02
 */
class AdminFolderController extends AdminController
{	
	public $uses = array(
		'MediaFile',
	);
	
	public $forms = array(
		'AdminSearchForm',
	);
	
	public function create()
	{
		$this->addForm('AdminFolderForm');
		if ($this->AdminFolderForm->ok()) {
			$this->AdminFolderForm->toModel($this->Folder);
			$this->Folder->Parent = $this->Folder->findById(1);
			if ($this->Folder->save()) {
				$this->FlashMessage->set(__('Das Verzeichnis <q>:1</q> erfolgreich erstellt.', $this->Folder->get('name')), FlashMessageType::SUCCESS);
				$this->redirect(Router::getRoute('adminMediaFiles'));
			} else {
				$this->AdminFolderForm->errors = $this->Folder->validationErrors;
			}
		}
	}
	
	public function edit($id = null)
	{
		$this->addForm('AdminFolderForm');
		$this->AdminFolderForm->fromModel($this->Folder);
		if ($this->AdminFolderForm->ok()) {
			$this->AdminFolderForm->toModel($this->Folder);
			if ($this->Folder->save()) {
				$this->FlashMessage->set(__('Verzeichnisnamen erfolgreich geändert.'), FlashMessageType::HINT);
				$this->redirect(Router::getRoute('adminMediaFiles'));
			} else {
				$this->AdminFolderForm->errors = $this->Folder->validationErrors;
			}
		}
	}
	
	public function view($folderId = null)
	{
		$this->Folder->unBind('MediaFile');
		if (!empty($this->params['id'])) {
			if (!$this->Folder->fromId($this->params['id'])) return false;
			$this->data->set('Folder', $this->Folder);
			$this->MediaFile->findConditions = array('MediaFile.folder_id' => $this->Folder->id);
		} else {
			$this->set('Folders', $this->Folder->findAll(array('Folder.level' => '>0')));
			$this->MediaFile->findConditions = array('MediaFile.folder_id IS NULL OR MediaFile.folder_id <= 0');
		}
		// get files in current folder
		$perPage = 15;
		$page = @$this->params['page'] or 1;
		$files = $this->MediaFile->findAll(null, array('MediaFile.created DESC'), ($page-1) * $perPage, $perPage);
		$this->set('Files', $files);
		$pagination = $this->MediaFile->paginate($page, $perPage);
		if ($this->Folder->exists()) {
			$pagination['url'] = Router::getRoute('adminFolderViewPaged', array('id' => $this->Folder->id));
		} else {
			$pagination['url'] = Router::getRoute('adminMediaFilesPaged', array('id' => $this->Folder->id));
		}
		if (!empty($this->request->data['layout'])) {
			$this->layout = (string) $this->request->data['layout'];
			$this->data->set('layout', (string) $this->request->data['layout']);
			$pagination['url'] .= '?layout='.$this->request->data['layout'];
		}
		$this->data->set('pagination', $pagination);
	}

	public function delete($id = null)
	{
		if (parent::delete($id)) {
			$this->MediaFile->updateWhere(array('folder_id' => (int) $id), array('folder_id' => 'NULL'));
			$this->FlashMessage->set(__('Die Kategorie wurde erfolgreich gelöscht. Dateien die in dieser Kategorie waren sind nun nicht mehr zugeordnet'));
		} else {
			$this->FlashMessage->set(__('Fehler beim Löschen der Kategorie'));
		}
		$this->redirect(Router::getRoute('adminMediaFiles'));
	}
}