<?php

namespace app\component\view;

class ThemeView extends \ephFrame\view\View
{
	public $theme = false;
	
	public function render($part, $path, Array $data = array()) {
		if (isset($data['theme'])) {
			$this->theme = $data['theme'];
		}
		try {
			if ($part == 'view') {
				$path = 'theme'.DIRECTORY_SEPARATOR.$this->theme.DIRECTORY_SEPARATOR.$path;
			}
			return parent::render($part, $path, $data);
		} catch (TemplateNotFoundException $e) {
			return parent::render($part, $path, $data);
		}
	}
}