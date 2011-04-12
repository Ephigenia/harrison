<?php

namespace app\component\Form;

class Comment extends Form
{
	public $attributes = array(
		'method' => 'post',
		'accept-charset' => 'utf-8',
		'id' => 'LanguageSelectForm',
	);
	
	public function configure()
	{
		$this->fieldsets[0] = new \ephFrame\HTML\Form\Fieldset(array(
			$name = new \ephFrame\HTML\Form\Element\Text('name', null, array(
				'label' => 'Name',
			)),
			$email = new \ephFrame\HTML\Form\Element\Email('email', null, array(
				'label' => 'E-Mail (wird nicht veröffentlicht)',
				'validators' => array(
					new \ephFrame\Validator\MinLength(array('length' => 10, 'message' => 'too short')),
					new \ephFrame\Validator\Email(),
				),
			)),
			$url = new \ephFrame\HTML\Form\Element\URL('url', null, array(
				'label' => 'Homepage',
			)),
			$text = new \ephFrame\HTML\Form\Element\Textarea('text', null, array(
				'label' => 'Kommentar',
			)),
			$submit = new \ephFrame\HTML\Form\Element\Submit('submit', null, array(
				'label' => 'Kommentar abschicken',
			))
		));
	}
}