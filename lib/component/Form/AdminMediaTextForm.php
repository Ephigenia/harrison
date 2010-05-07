<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * MediaTextForm class
 *
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-05
 */
class AdminMediaTextForm extends AdminForm
{	
	public function startUp() {
		$this->config = array(
			'MediaText' => array(
				'fields' => array(
					'title' => array(
						'label' => __('Titel'),
						'mandatory' => false,
					),
					'text'	=> array(
						'label' => __('Beschreibung').':',
						'mandatory' => false,
					),
					'language_id' => array(
						'type' => 'hidden',
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
}