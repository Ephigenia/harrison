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
<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?portrait=0" width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0"></iframe>