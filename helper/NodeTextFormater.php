<?php

namespace app\helper;

/**
 * Helper for formating node texts
 *
 * @since 2009-08-11
 * @package harrison
 * @subpackage harrison.lib.helper
 */
class NodeTextFormater
{
	public function format($text)
	{
		// image replace
		$text = $this->imageReplace($text, 0);
		return $text;
	}
	
	public function imageReplace($text, $maxImgWidth = 480)
	{
		// replace images pasted with wiki syntax: [[image.jpg|attr=value|flag]]
		if (empty($maxImgWidth)) {
			$maxImgWidth = 0;
		};
		$HTML = new HTML($this->controller);
		if (preg_match_all('@\[{2}  (?P<filename>[^\|\]]+\.(jpg|jpeg|gif|png))  \|?  (?P<attributes>[^\]]{2,})?  \]{2}@xi', $text, $found, PREG_SET_ORDER)) {
			foreach($found as $match) {
				$filename = $match['filename'];
				$originalFilename = WEBROOT.STATIC_DIR.'img/upload/'.$filename;
				$newFilename = WEBROOT.STATIC_DIR.'img/upload/';
				$imgAttributes = array('alt' => '');
				$linkAttributes = array('rel' => 'external');
				$containerAttributes = array('class' => array('img'));
				// parse attributes
				$width = $description = $method = false;
				foreach(explode('|', @$match['attributes']) as $value) {
					if (preg_match('@^\d+$@', $value)) {
						$width = $value;
					} else {
						if (substr($value, 0, 3) == 'alt') {
							$imgAttributes['alt'] = substr($value, 4);
							$linkAttributes['link'] = substr($value, 4);
						} elseif (substr($value, 0, 5) == 'class') {
							$containerAttributes['class'][] = substr($value, 6);
						} elseif (in_array($value, array('left', 'right'))) {
							$containerAttributes['class'][] = $value;
						} elseif (in_array($value, array('stretchResizeTo', 'resizeTo'))) {
							$method = $value;
						} else {
							$description = $value;
						}
					}
				}
				// image is a url
				if (substr($filename, 0, 7) == 'http://') {
					$newFilename = $filename;
					$imgAttributes['width'] = $maxImgWidth;
				// image seemes to be a filename
				} else {
					if (empty($width) || $width > $maxImgWidth) $width = $maxImgWidth;
					if (empty($method)) $method = 'resize';
					if (!empty($width)) {
						$containerAttributes['style'] = 'width: '.($width).'px';
					}
					$uniqueId = substr(md5($filename.SALT), 0, 8);
					$newFilename = 'public/'.$uniqueId.'/'.(empty($width) ? 'auto' : $width).'x'.(empty($height) ? 'auto' : $height).'/'.$method.'/'.$filename;
				}
				// replace code with real image tag
				$replace = $HTML->image($newFilename, $imgAttributes);
				// $replace = $HTML->link($originalFilename, $replace, $linkAttributes);
				if (!empty($description)) {
					$replace .= '<span class="description">'.$description.'</span>';
				}
				$replace = $HTML->tag('div', $replace, $containerAttributes);
				$text = str_replace($match[0], $replace, $text);
			}
		}
		return $text;
	}
}