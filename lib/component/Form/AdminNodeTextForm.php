<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Form for node texts
 *
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-05
 **/
class AdminNodeTextForm extends AdminForm
{	
	public function startUp()
	{
		$this->config = array(
			'NodeText' => array(
				'fields' => array(
					'headline' => array(
						'label' => __('Überschrift').':',
						'mandatory' => false,
					),
					'subline' => array(
						'label' => __('Unter-Überschrift (optional)').':',
						'mandatory' => false,
					),
					'text' => array(
						'mandatory' => false,
						'label' => __('Text/Beschreibung').':',
					),
					'excerpt' => array(
						'label' => __('Auszug/Zusammenfassung (optional)').':',
						'mandatory' => false,
					),
					'url' => array(
						'label' => __('URL (optional)').':',
						'mandatory' => false,
					),
					'keywords' => array(
						'mandatory' => false,
						'label' => __('Stichwörter (SEO)').':',
						'type' => 'text',
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