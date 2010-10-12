<?php

/**
 * Contact Form class
 * 
 * @subpackage harrison.lib.form
 * @package harrison
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 28.01.2009
 */
class ContactForm extends AppForm 
{
	public $config = array(
		array(
			'type' => 'text',
			'name' => 'name',
		),
		array(
			'type' => 'email',
		),
		array(
			'type' => 'textarea',
			'name' => 'text',
		),
		array(
			'type' => 'submit',
			'value' => 'Abschicken',
		),
	);
	
	public function configure()
	{
		$this->md5Secret = md5($this->request->host.SALT);
		$this->controller->JavaScript->jQuery("
			$('#".get_class($this)."').append('<input type=\"hidden\" name=\"md5\" value=\"".$this->md5Secret."\" />');
		");
		return parent::configure();
	}
}