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
						'label' => __('Beschreibung'),
					),
				),
			),
			array(
				'name' => 'permission_id[]',
				'label' => __('Zugriffsrechte'),
				'type' => 'DropDown',
				'options' => $this->controller->Permission->listAll('name'),
				'multiple' => true,
				'mandatory' => false,
			),
			array(
				'type' => 'submit',
				'value' => __('Speichern'),
			),
		);
		return parent::startUp();
	}
	
	public function fillModel(Model $model) {
		if (count($model->Permissions) > 0) {
			foreach($model->Permissions as $Permission) {
				$permissionIds[] = $Permission->id;
			}
			$permissionField = $this->fieldset->childWithAttribute('name', 'permission_id[]');
			$permissionField->select($permissionIds);
		}
		parent::fillModel($model);
	}
	
	public function toModel(Model $model, $fields = null, $ignore = null)
	{
		$model->Permissions = array();
		if (!empty($this->controller->request->data['permission_id'])) {
			$permissionIds = $this->controller->request->data['permission_id'];
			foreach($permissionIds as $permissionId) {
				$model->Permissions[] = new Permission($permissionId);
			}
		}
		return parent::toModel($model, $fields, $ignore);
	}
}