<?php

/**
 * Search Form
 * 
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 28.11.2008
 */
class SearchForm extends AppForm
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
		// skips the submit buton
		return true;
	}
	
	public function beforeRender()
	{
		$this->attributes->action = Router::uri('blogSearch', array('q' => ''));
		if (!empty($this->controller->params['q'])) {
			$this->q->value($this->controller->params['q']);
		}
		return parent::beforeRender();
	}
}