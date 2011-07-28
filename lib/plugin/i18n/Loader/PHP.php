<?php

namespace i18n\Loader;

class PHP implements Loader
{
	public function load($locale, $domain)
	{
		$filename = APP_ROOT.'/config/locale/'.strtolower(substr($locale, 0, 2)).DIRECTORY_SEPARATOR.$domain.'.php';
		if (!file_exists($filename) || !is_file($filename)) {
			throw new Exception('unable to load catalogue file: "'.$filename.'".');
		}
		if (!is_readable($filename)) {
			throw new Exception('unable to load catalogue file: "'.$filename.'".');
		}
		return require $filename;
	}
}