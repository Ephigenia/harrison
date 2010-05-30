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
class AdminUserForm extends AdminForm
{
	public function startUp()
	{
		$this->config = array(
			'User' => array(
				'fields' => array(
					'name',
					'user_group_id' => array(
						'type' => 'DropDown',
						'label' => __('Benutzergruppe'),
						'options' => $this->controller->UserGroup->listAll('UserGroup.name'),
					),
					'email',
					'password' => array(
						'mandatory' => false,
						'value' => '',
						'label' => __('Passwort').':',
					),
					'locale' => array(
						'label' => __('Sprache').':',
						'type' => 'DropDown',
						'options' => array(
							'de_DE' => 'Deutsch',
							'en_GB' => 'English',
						),
					),
				),
			),
			array(
				'type' => 'submit',
				'value' => __('Speichern'),
			),
		);
		return parent::startUp();
	}
	
	public function afterConfig()
	{
		if ($this->controller->action == 'create') {
			$this->submit->value(__('Benutzer erstellen'));
			$this->password->insertAfter($this->newField('checkbox', 'sendMail')->label('Passwort zuschicken'));
		}
		return parent::afterConfig();
	}
	
	public function fillModel(Model $model)
	{
		$r = parent::fillModel($model);
		if (substr($this->controller->action, 0, 4) == 'edit' && !$this->submitted()) {
			$this->password->value('');
		}
		return $r;
	}
}