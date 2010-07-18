<?php

/**
 * @package harrison
 * @subpackage harrison.lib.helper
 * @since 2009-08-09
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
class BlogPostFormater extends Helper
{	
	public $helpers = array(
		'HTML',
	);
	
	public function format($text)
	{
		$text = $this->codeReplace($text);
		// replace images
		$text = $this->imageReplace($text, 438);
		// absolute image url
		$text = preg_replace('@src="'.WEBROOT.STATIC_DIR.'([^"]+)@', 'src="'.Registry::get('APP_URL').ltrim(STATIC_DIR, '/').'$1', $text);
		// replace video integrations
		$text = $this->videoReplace($text);		
		// replace & and old tags
		$replace = array(
			'@&(?![^&]+;)@i' 				=> '&amp;',
			'@ border="0"@' 				=> '',
			'@ target=[\'"]_blank[\'"]@' 	=> ' rel="external"',
			'@(?<!>)\n@is'					=> '<br />'.LF,			// line brakes
			'@>[\n\r]<br />@is'				=> '>'					// code lines, first line break
		);
		$text = preg_replace(array_keys($replace), array_values($replace), $text);
		return $text;
	}
	
	public function codeReplace($text)
	{
		// check if geshi available
		$geshiPath = dirname(__FILE__).'/../vendor/geshi/geshi.php';
		if (!file_exists($geshiPath)) return $text;
		$regexp = '@<code class="(\w+)">(.+?)<\/code>@s';
		// replace codes
		if (preg_match_all($regexp, $text, $found)) {
			require_once $geshiPath;
			for($index = 0; $index < count($found)-1; $index++) {
				if (!isset($found[1][$index])) continue;
				$language = $found[1][$index];
				$code = trim($found[2][$index]);
				$geshi = new GeSHi($code, $language);
				$geshi->set_header_type(GESHI_HEADER_NONE);
				$geshi->enable_classes();
				$geshi->set_tab_width(2);
				$geshi->enable_keyword_links(false);
				if (in_array($language, array('php', 'css', 'shell', 'ruby', 'python', 'bash', 'sql'))
					&& String::numberOfLines($code) > 5) {
					//$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
				}
				// replace image place holders
				$text = str_replace($code, $geshi->parse_code(), $text);
			}
		}
		return $text;
	}
	
	public function imageReplace($text, $maxImgWidth = 480)
	{
		// replace images pasted with wiki syntax: [[image.jpg|attr=value|flag]]
		if (empty($maxImgWidth)) {
			$maxImgWidth = 440;
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
				$replace = $HTML->link($originalFilename, $replace, $linkAttributes);
				if (!empty($description)) {
					$replace .= '<span class="description">'.$description.'</span>';
				}
				$replace = $HTML->tag('div', $replace, $containerAttributes);
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
				$videoUrl = WEBROOT.STATIC_DIR.'swf/VideoPlayer.swf?url='.$arr[1].'&name='.urlencode(@$arr[3]);
				$videoTag = $this->HTML->tag('embed', null, array(
					'src' => $videoUrl,
					'allowFullScreen' => 'true',
					'type' => 'application/x-shockwave-flash',
					'width' => 440,
					'height' => coalesce(@$arr[2], 440),
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
			foreach($found as $arr) {
				class_exists('Element') or ephFrame::loadClass('ephFrame.lib.Element');
				$videoElement = new Element('video/'.$arr['type'], array('id' => $arr['id']));
				$text = str_replace($arr[0], $videoElement->render(), $text);
			}
		}
		return $text;
	}
}