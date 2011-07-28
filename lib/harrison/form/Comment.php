<?php

namespace harrison\form;

use
	ephFrame\HTML\Form\Fieldset,
	ephFrame\HTML\Form\Element,
	ephFrame\Validator
	;

class Comment extends Form
{
	public $attributes = array(
		'method' => 'post',
		'accept-charset' => 'utf-8',
		'id' => 'LanguageSelectForm',
	);
	
	public function configure()
	{
		$this->fieldsets[0] = new Fieldset(array(
			$name = new Element\Text('name', null, array(
				'label' => 'Name',
			)),
			$email = new Element\Email('email', null, array(
				'label' => 'E-Mail (wird nicht veröffentlicht)',
				'validators' => array(
					new Validator\MinLength(array('limit' => 10, 'message' => 'too short')),
					new Validator\Email(),
				),
			)),
			$url = new Element\URL('url', null, array(
				'label' => 'Homepage',
			)),
			$text = new Element\Textarea('text', null, array(
				'label' => 'Kommentar',
			)),
			$submit = new Element\Submit('submit', null, array(
				'label' => 'Kommentar abschicken',
			))
		));
	}
}