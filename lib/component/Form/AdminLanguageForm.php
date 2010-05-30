<?php 

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Language Form
 * 
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-06-19
 */
class AdminLanguageForm extends AdminForm
{
	public function startUp() {
		$this->config = array(
			'Language' => array(
				'fields' => array(
					'id',
					'status' => array(
						'type' => 'DropDown',
						'options' => Status::$list,
					),
					'name',
					'locale',
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