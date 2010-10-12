<?php

/**
 * Comment Form Class used in the frontend
 *
 * @package harrison
 * @subpackage harrison.lib.component.form
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 14.04.2009
 */
class CommentForm extends AppForm
{
	public $config = array(
		'Comment' => array(
			'fields' => array(
				'name',
				'email' => array('mandatory' => false),
				'url' => array('mandatory' => false),
				'text',
			)
		),
		array('type' => 'submit', 'value' => 'Kommentar senden', 'name' => 'submit'),
	);
	
	public function configure()
	{
		$this->md5Secret = md5($this->request->host.SALT);
		$this->controller->JavaScript->jQuery("
			$('#".get_class($this)."').append('<input type=\"hidden\" name=\"md5\" value=\"".$this->md5Secret."\" />');
		");
		return parent::configure();
	}
	
	public function afterConfig()
	{
		$this->action .= '#CommentForm';
		return parent::afterConfig();
	}
}