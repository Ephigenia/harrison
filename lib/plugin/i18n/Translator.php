<?php

namespace i18n;

use 
	i18n\Catalogue;

class Translator
{
	public $locale = 'de_DE';
	
	public $domain = 'default';
	
	public $catalogues = array();
	
	public function __construct($locale = null, $domain = null)
	{
		$this->locale = $locale ?: $this->locale;
		$this->domain = $domain ?: $this->domain;
		$this->load('PHP', $this->locale, $this->domain);
	}
	
	public function load($format, $locale = null, $domain = null)
	{
		$loaderClassName = __NAMESPACE__.'\\Loader\\'.$format;
		$loader = new $loaderClassName();
		$this->catalogues[$locale ?: $this->locale][$domain ?: $this->domain] = $loader->load($locale, $domain);
		return true;
	}
	
	public function translate($string, Array $data = array(), $domain = null, $locale = null)
	{
		$domain = $domain ?: $this->domain;
		$locale = $locale ?: $this->locale;
		if (isset($this->catalogues[$locale][$domain][$string])) {
			if (empty($data)) {
				return $this->catalogues[$locale][$domain][$string];
			}
			array_unshift($data, $this->catalogues[$locale][$domain][$string]);
			return call_user_func_array('sprintf', $data);
		}
		return $string;
	}
	
	public function dateTime(\DateTime $datetime, $format, $locale = null)
	{
		setlocale(LC_TIME, $locale ?: $this->locale);
		$dateformat = $this->translate('datetime.'.$format, array(), null, $locale);
		if ($dateformat == 'datetime.'.$format) {
			$dateformat = '%x %X';
		}
		return strftime($dateformat, $datetime->getTimestamp());
	}
	
	public function __invoke($string, Array $data = array(), $domain = null, $locale = null)
	{
		return call_user_func_array(array($this, 'translate'), $arguments = func_get_args());
	}
}