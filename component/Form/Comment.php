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
		$this->fieldsets[0][] =
			$name = new \ephFrame\HTML\Form\Element\Text('name', null, array(
				'label' => 'Name',
			));
		$this->fieldsets[0][] =
			$email = new \ephFrame\HTML\Form\Element\Email('email', null, array(
				'label' => 'E-Mail (wird nicht veröffentlicht)',
			));
		$this->fieldsets[0][] =
			$url = new \ephFrame\HTML\Form\Element\URL('url', null, array(
				'label' => 'Homepage',
			));
		$this->fieldsets[0][] =
			$text = new \ephFrame\HTML\Form\Element\Textarea('text', null, array(
				'label' => 'Kommentar',
			));
		$this->fieldsets[0][] =
			$submit = new \ephFrame\HTML\Form\Element\Submit('submit', null, array(
				'label' => 'Kommentar abschicken',
			));
	}
}