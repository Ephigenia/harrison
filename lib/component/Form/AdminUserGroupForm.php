<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Group Form
 * 	
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 28.11.2008
 * @package nms.folio
 * @subpackage nms.folio.lib.form
 */
class AdminUserGroupForm extends AdminForm
{
	public function startUp()
	{
		$this->config = array(
			'UserGroup' => array(
				'fields' => array(
					'name' => array(
						'type' => 'text',
					),
					'description' => array(
						'type' => 'textarea',
						'mandatory' => false,
						'label' => __('Beschreibung').':',
					),
				),
			),
			array(
				'name' => 'permission_id[]',
				'label' => __('Zugriffsrechte'),
				'type' => 'DropDown',
				'options' => $this->controller->Permission->listAll('name'),
				'multiple' => true,
			),
			array(
				'type' => 'submit',
				'value' => __('Speichern'),
			),
		);
		return parent::startUp();
	}
	
	public function toModel(Model $model, $fields = null, $ignore = null)
	{
		$PermissionField = $this->childWithAttribute('permission_id[]');
		var_dump($PermissionField);
		die(var_dump($PermissionField->value()));
		return parent::toModel($model, $fields, $ignore);
	}
}