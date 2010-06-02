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
					'headline' => array(
						'mandatory' => false,
						'label' => __('Überschrift'),
					),
					'subline' => array(
						'mandatory' => false,
						'label' => __('Unter-Überschrift'),
					),
					'text' => array(
						'mandatory' => false,
						'label' => __('Text/Beschreibung'),
					),
					'excerpt' => array(
						'mandatory' => false,
						'label' => __('Auszug/Zusammenfassung'),
					),
					'tags' => array(
						'mandatory' => false,
						'type' => 'textarea',
						'rows' => 2,
						'label' => __('Tags (SEO)'),
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