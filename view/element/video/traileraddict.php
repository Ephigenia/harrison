<?php
/**
 * Dailymotion-Embed Code Element
 * 
 * Parameters:
 * ===========
 * $id		Dailymotion video id
 * $width	width of the video
 * $height	height of the video
 * 
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-10-27
 */

if (empty($id)) return false;
$width = coalesce(@$width, 440);
$height = coalesce(@$height, 349);

?>
<object width="<?php echo $width; ?>" height="<?php echo $height; ?>"><param name="movie" value="http://www.traileraddict.com/emd/<?php echo $id ?>"></param><param name="allowscriptaccess" value="always"><param name="wmode" value="transparent"></param><param name="allowFullScreen" value="true"></param><embed src="http://www.traileraddict.com/emd/<?php echo $id; ?>" type="application/x-shockwave-flash" allowscriptaccess="always" wmode="transparent" width="<?php echo $width; ?>" height="<?php echo $height; ?>" allowFullScreen="true"></embed></object>