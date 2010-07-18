<?php

/**
 * Markdown Helper Wrapper
 * 
 * @package harrison
 * @subpackage harrison.lib.helper
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-04-10
 */
class MarkDown extends AppHelper
{
	public function format($text)
	{
		function_exists('Markdown') or require APP_VENDOR_DIR.'markdown/markdown.php';
		$text = Markdown($text);
		return $text;
	}
}