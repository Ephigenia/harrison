<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Permission Form Class
 *
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-16
 **/
class AdminPermissionForm extends AppForm
{
	public function startUp() {
		$this->config = array(
			'Permission' => array(
				'fields' => array(
					'name',
					'rule',
				),
			),
			array(
				'type' => 'submit',
				'value' => __('Speichern'),
			),
		);
		return parent::startUp();
	}
}