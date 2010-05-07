<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Admin Comment Form
 * 
 * @package harrison
 * @subpackage harrison.lib.component.forms
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-03-14
 */
class AdminCommentForm extends AdminForm
{
	public function startUp()
	{
		$this->config = array(
			'Comment' => array(
				'fields' => array(
					'name',
					'email' => array('mandatory' => false),
					'url' => array('mandatory' => false),
					'text',
				)
			),
			array(
				'type' => 'submit',
				'name' => 'submit',
				'value' => __('Speichern'),
			),
		);
		return parent::startUp();
	}
}