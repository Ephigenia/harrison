<?php

/**
 * General login form
 * 	
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 28.11.2008
 */
class LoginForm extends AppForm
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