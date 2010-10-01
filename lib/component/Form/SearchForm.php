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
	public function startUp()
	{
		$this->config = array(
			array(
				'type' => 'text',
				'name' => 'q',
				'label' => false,
				'placeholder' => __('Suchbegriff'),
			),
			array(
				'type' => 'submit',
				'value' => __('suchen'),
			),
		);
		return parent::startUp();
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