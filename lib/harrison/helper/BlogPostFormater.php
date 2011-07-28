<?php

namespace harrison\helper;

/**
 * @package harrison
 * @subpackage harrison.lib.helper
 * @since 2009-08-09
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class BlogPostFormater
{
	public function format($text)
	{
		// replace images
		$text = $this->imageReplace($text, 438);
		// absolute image url
		// $text = preg_replace('@src="'.\ephFrame\core\Router::base().'([^"]+)@', 'src="'.Registry::get('APP_URL').ltrim(STATIC_DIR, '/').'$1', $text);
		// replace video integrations
		$text = $this->videoReplace($text);		
		// replace & and old tags
		$replace = array(
			'@&(?![^&]+;)@i' 				=> '&amp;',
			'@ border="0"@' 				=> '',
			'@ target=[\'"]_blank[\'"]@' 	=> ' rel="external"',
			'@(?<!>)\n@is'					=> '<br />'.PHP_EOL,
			'@>[\n\r]<br />@is'				=> '>'
		);
		$text = preg_replace(array_keys($replace), array_values($replace), $text);
		return $text;
	}
	
	public function imageReplace($text, $maxImgWidth = 480)
	{
		// replace images pasted with wiki syntax: [[image.jpg|attr=value|flag]]
		if (empty($maxImgWidth)) {
			$maxImgWidth = 440;
		};
		$HTML = new \ephFrame\view\helper\HTML($this->controller);
		if (preg_match_all('@\[{2}  (?P<filename>[^\|\]]+\.(jpg|jpeg|gif|png))  \|?  (?P<attributes>[^\]]{2,})?  \]{2}@xi', $text, $found, PREG_SET_ORDER)) {
			foreach($found as $match) {
				$filename = $match['filename'];
				$originalFilename = \ephFrame\core\Router::base().STATIC_DIR.'/img/upload/'.$filename;
				$newFilename = \ephFrame\core\Router::base().STATIC_DIR.'/img/upload/';
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
				$replace->escaped = false;
				$replace = $HTML->link($originalFilename, $replace, $linkAttributes);
				$replace->escaped = false;
				if (!empty($description)) {
					$replace .= '<span class="description">'.$description.'</span>';
				}
				$replace = $HTML->tag('div', $replace, $containerAttributes);
				$replace->escaped = false;
				$text = str_replace($match[0], $replace, $text);
			}
		}
		return $text;
	}
	
	public function videoReplace($text)
	{
		// get normal videos
		if (preg_match_all('@\[{2}
			video=([^|]+)
			\|?(\d+)?
			\|?([^\]]+)?
			\]{2}@ix', $text, $found, PREG_SET_ORDER)) {
			foreach($found as $arr) {
				$videoUrl = \ephFrame\core\Router::base().STATIC_DIR.'/swf/VideoPlayer.swf?url='.$arr[1].'&name='.urlencode(@$arr[3]);
				$HTML = new \ephFrame\view\helper\HTML($this->controller);
				$videoTag = $HTML->tag('embed', null, array(
					'src' => $videoUrl,
					'allowFullScreen' => 'true',
					'type' => 'application/x-shockwave-flash',
					'width' => 440,
					'height' => @$arr[2] ?: 440,
				));
				$text = str_replace($arr[0], $videoTag, $text);
			}
		}
		// get dailymotion / youtube videos
		if (preg_match_all('@\[{2}
			(?:http:\/{1,}(?:www\.)?)?
			(?P<type>youtube|dailymotion|vimeo|traileraddict)=?
				 (
					(\.com\/(video\/|watch\?v=)|:)?
					(?P<id>[a-z0-9_-]+)
				)
				([^\]]+)?
			\]{2}@ix', $text, $found, PREG_SET_ORDER)) {
			$view = new \ephFrame\view\View();
			foreach($found as $arr) {
				$rendered = $view->render('element', 'video/'.$arr['type'], array('id' => $arr['id']));
				$text = str_replace($arr[0], $rendered, $text);
			}
		}
		return $text;
	}
}