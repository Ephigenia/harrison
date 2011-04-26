<?php

namespace app\component\view\renderer;

class Markdown extends \ephFrame\view\Renderer
{
	public $extension = 'md';
	
	public function render($filename, Array $data = array())
	{
		if (!class_exists('Markdown_Parser')) {
			define('MARKDOWN_EMPTY_ELEMENT_SUFFIX', '>');
			require APP_ROOT.'/vendor/php-markdown/markdown.php';
		}
		$parser = new \Markdown_Parser();
		return $parser->transform(parent::render($filename, $data));
	}
}