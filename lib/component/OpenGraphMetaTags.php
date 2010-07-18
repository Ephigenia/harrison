<?php

/**
 * Adds Facebook’s Open Graph Meta Tag Headers
 * 
 * {@link http://developers.facebook.com/docs/opengraph}
 * 
 * @package harrison
 * @subpackage harrison.lib.component
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-06-12
 */
class OpenGraphMetaTags extends AppComponent
{
	public $components = array(
		'AppMetaTags',
	);
	
	public function beforeRender()
	{
		$this->AppMetaTags->set('og:site_name', AppController::NAME);
		$this->AppMetaTags->set('og:url', Router::url());
		$this->AppMetaTags->set('og:title', $this->controller->data->get('pageTitle'));
		return parent::beforeRender();
	}
}