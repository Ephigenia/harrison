<?php

ephFrame::loadClass('ephFrame.lib.component.MetaTags');

/**
 * Application MetaTags Collection
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
		'copyright' => '© 2009 Marcel Eichner // Ephigenia',
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
		// load keywords from file when @ is used in keywords name
		if (!is_array($this->keywords) && preg_match('/^@/', $this->keywords)) {
			$f = new File(substr($this->keywords, 1));
			if ($f->exists()) {
				$this->data['keywords'] = $f->toArray();
			}
		}
		return parent::startup();
	}
}