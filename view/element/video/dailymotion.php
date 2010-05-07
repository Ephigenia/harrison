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
<object width="<?php echo $width ?>" height="<?php echo $height; ?>"><param name="movie" value="http://www.dailymotion.com/swf/<?php echo $id ?>'&amp;colors=background:1C1C1C;glow:525252;foreground:A6A6A6;special:61605D;&amp;related=1"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed src="http://www.dailymotion.com/swf/<?php echo $id ?>&amp;colors=background:1C1C1C;glow:525252;foreground:A6A6A6;special:61605D;&amp;related=1" type="application/x-shockwave-flash" width="<?php echo $width; ?>" height="<?php echo $height ?>" bgcolor="1B1B1B" allowFullScreen="true" allowScriptAccess="always"></embed></object>