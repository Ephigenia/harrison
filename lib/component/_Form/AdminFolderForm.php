<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * FolderForm class
 *
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-02
 **/
class AdminFolderForm extends AdminForm
{
	public function startUp()
	{
		$this->config = array(
			'Folder' => array(
				'fields' => array(
					 'name',
				),
			),
			array(
				'type' => 'submit',
				'value' => __('Speichern')
			),
		);
		return parent::startUp();
	}
}