<?php

namespace harrison\view;

class ThemeView extends \ephFrame\view\View
{
	public $theme = false;
	
	public function render($part, $path, Array $data = array())
	{
		$data += array(
			'theme' => $this->theme
		);
		$themePrefix = 'theme'.DIRECTORY_SEPARATOR.$this->theme.DIRECTORY_SEPARATOR;
		try {
			if ($part == 'view' || $part == false) {
				$path = $themePrefix.$path;
			}
			return parent::render($part, $path, $data);
		} catch (\Exception $e) {
			return parent::render($part, substr($path, strlen($themePrefix)), $data);
		}
	}
}