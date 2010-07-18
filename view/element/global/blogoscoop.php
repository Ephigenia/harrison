<?php

/**
 * Hit-Counter element for blogoscoop.net
 * 
 * This will only add the blogoscoop code if you’re not logged in and on your
 * local host so no local usage will be counted or your admin clicks.
 * 
 * Parameters:
 * ===========
 * $id	integer		Your blogoscoop id
 * 
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-10-10
 */

if (isset($Me) || @$_SERVER['HTTP_HOST'] == 'localhost' || empty($id)) return false;
?><p style="display:none"><img src="http://stats.blogoscoop.net/<?php echo $id ?>/4.gif" alt="blogoscoop" /></p>