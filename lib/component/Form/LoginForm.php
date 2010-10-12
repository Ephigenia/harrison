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
				'placeholder' => __('E-Mail'),
				'label' => false,
			),
			array(
				'type' => 'password',
				'label' => false,
				'placeholder' => __('Passwort'),
			),
			array(
				'type' => 'submit',
				'value' => __('anmelden'),
			),
		);
		return parent::startUp();
	}
}