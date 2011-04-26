<?php

namespace app\component\Form;

class Search extends Form
{
	public $attributes = array(
		'method' => 'post',
		'accept-charset' => 'utf-8',
		'id' => 'SearchForm',
	);
	
	public function configure()
	{
		$this->fieldsets[0] = new \ephFrame\HTML\Form\Fieldset(array(
			$q = new \ephFrame\HTML\Form\Element\Text('q', null, array(
				'label' => 'Suche',
				'decorators' => false,
				'attributes' => array(
					'placeholder' => 'suche',
				),
			)),
		));
	}
}