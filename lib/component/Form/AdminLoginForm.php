<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * User edit/create Form
 * 	
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 28.11.2008
 * @package harrison
 * @subpackage harrison.lib.component.form
 */
class AdminLoginForm extends AdminForm
{
	public function startUp()
	{
		$this->config = array(
			array(
				'type' => 'email',
			),
			array(
				'type' => 'password',
				'label' => __('Passwort'),
			),
			array(
				'type' => 'checkbox',
				'name' => 'permanent',
				'checked' => true,
				'label' => __('Eingeloggt bleiben'),
			),
			array(
				'type' => 'submit',
				'value' => __('Einloggen'),
			),
		);
		return parent::startUp();
	}
}