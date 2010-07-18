<?php
/**
 * Vimeo-Embed Code Element
 * 
 * Parameters:
 * ===========
 * $id		Vimeo Video id, see the url for a valid url
 * $width	width of the video
 * $height	height of the video
 * 
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-10-27
 */
if (empty($id)) return false;
$width = coalesce(@$width, 440);
$height = coalesce(@$height, 253);

?>
<object width="<?php echo $width; ?>" height="<?php echo $height; ?>"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $id; ?>&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $id ?>&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="<?php echo $width; ?>" height="<?php echo $height ?>"></embed></object>