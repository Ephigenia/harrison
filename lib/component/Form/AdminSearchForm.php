<?php

class_exists('AdminForm') or require dirname(__FILE__).'/AdminForm.php';

/**
 * Search used in the admin for searches
 * 
 * @package harrison
 * @subpackage harrison.lib.component.forms
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-03-02
 */
class AdminSearchForm extends AdminForm
{
	public $config = array(
		array(
			'type' => 'text',
			'name' => 'q',
			'label' => false,
			'value' => 'search',
		),
	);
	
	public function afterConfig()
	{
		$this->q->value(@$this->controller->params['q']);
		return true;
	}
}