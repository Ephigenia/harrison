<?php
/**
 * Dailymotion-Embed Code Element
 * 
 * Parameters:
 * ===========
 * $id		Youtube video code
 * $width	width of the video
 * $height	height of the video
 * 
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-10-27
 */

if (empty($id)) return false;
$width = @$width ?: 440;
$height = @$height ?: 352;

?>
<iframe title="YouTube video player" width="<?php echo $width; ?>" height="<?php echo $height; ?>" src="http://www.youtube.com/embed/<?php echo $id; ?>" frameborder="0" allowfullscreen></iframe>