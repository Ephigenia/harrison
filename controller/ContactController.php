<?php

/**
 * Contact Controller
 *
 * @package harrison
 * @subpackage harrison.lib.controller
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-07-26
 */
class ContactController extends AppController 
{
	public $publicActions = array(
		'all',
	);
	
	public $components = array(
		'ViewMailer',
	);
	
	public $forms = array(
		'ContactForm',
	);
	
	public function index()
	{
		if ($this->ContactForm->ok() && $this->request->get('md5') == $this->ContactForm->md5Secret) {
			$this->data->set('data', $this->request->data);
			if (!$this->ViewMailer->send(Registry::get('ContactEmail'), 'contact', 'Kontaktformular', $this->request->data)) {
				$this->data->set('error', __('Es ist ein Fehler beim Versenden der E-Mail aufgetreten. Bitte versuche es später noch ein mal.'));
			} else {
				$this->data->set('success', true);
			}
		}
	}
}