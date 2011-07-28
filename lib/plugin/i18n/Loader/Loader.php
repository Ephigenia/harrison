<?php

namespace i18n\Loader;

interface Loader
{
	public function load($locale, $domain);
}

class Exception extends \Exception {}