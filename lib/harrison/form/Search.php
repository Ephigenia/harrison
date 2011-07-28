<?php

namespace harrison\form;

use
	ephFrame\HTML\Form\Fieldset,
	ephFrame\HTML\Form\Element,
	ephFrame\Validator
	;

class Search extends Form
{
	public $attributes = array(
		'method' => 'post',
		'accept-charset' => 'utf-8',
		'id' => 'SearchForm',
	);
	
	public function configure()
	{
		$this->fieldsets[0] = new Fieldset(array(
			$q = new Element\Text('q', null, array(
				'label' => 'Suche',
				'decorators' => false,
				'attributes' => array(
					'placeholder' => 'suche',
				),
			)),
		));
	}
}