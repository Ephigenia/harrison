<?php

ephFrame::loadClass('ephFrame.lib.component.MetaTags');

/**
 * Application MetaTags Collection
 * 
 * This is the application metatags wrapper that can be used to add application
 * specific meta tags. It also consumes meta tags values from every attribute
 * value beginning with an @. The example shows how:
 * <code>
 * 
 * </code>
 * 
 * @package harrison
 * @subpackage harrison.lib.component
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-03-02
 */	
class AppMetaTags extends MetaTags
{	
	public $data = array(
		// SEO
		'keywords' => '@keywords.txt',
		'author' => 'Marcel Eichner',
		'copyright' => '© 2010 Marcel Eichner // Ephigenia',
		'description' => '',
	);
		
	public function __construct($data = null)
	{
		$this->data = $this->__mergeParentProperty('data');
		parent::__construct($data);
	}
	
	public function startup()
	{
		$this->data['generator'] = 'harrison '.AppController::VERSION.', ephFrame';
		$this->data['contact'] = Registry::get('ContactEmail');
		// iterate over metatags to find @[files] ?
		foreach($this->data as $key => $value) {
			if (!is_string($value) || !($filename = preg_match_first($value, '/^@(.+)/'))) continue;
			$File = new File($filename);
			if ($File->exists()) {
				$this->data[$key] = $File->toArray();
			}
		}
		return parent::startup();
	}
}