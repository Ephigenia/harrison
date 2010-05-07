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
$width = coalesce(@$width, 440);
$height = coalesce(@$height, 352);

?>
<object width="<?php echo $width ?>" height="<?php echo $height ?>"><param name="movie" value="http://www.youtube-nocookie.com/v/<?php echo $id ?>&amp;fs=1&amp;hd=1&amp;rel=0&amp;border=0&amp;showinfo=0&amp;color1=0x181818&amp;color2=0x636363"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube-nocookie.com/v/<?php echo $id ?>&amp;fs=1&amp;hd=1&amp;rel=0&amp;border=0&amp;showinfo=0&amp;color1=0x181818&amp;color2=0x636363" type="application/x-shockwave-flash" bgcolor="#1B1B1B" allowscriptaccess="always" allowfullscreen="true" width="<?php echo $width ?>" height="<?php echo $height ?>"></embed></object>