<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Media File Form
 *
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-01
 **/
class AdminMediaFileForm extends AdminForm
{	
	public function startUp()
	{
		$folderList = array(
			false => __('kein Kategorie')) +
			$this->controller->Folder->listAll('name', array(
			'conditions' => array(
				'id > 1',
			),
		));
		$this->config = array(
			'MediaFile' => array(
				'fields' => array(
					'folder_id' => array(
						'mandatory' => false,
						'type' => 'DropDown',
						'label' => __('Kategorie (optional)'),
						'options' => $folderList,
					),
				),
			),
			array(
				'type' => 'file',
				'name' => 'file',
				'label' => false,
			),
			array(
				'type' => 'submit',
				'value' => __('Hochladen'),
			),
		);
		return parent::startUp();
	}
}