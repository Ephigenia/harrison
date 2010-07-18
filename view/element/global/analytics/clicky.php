<?php

/**
 * Clicky Element
 * 
 * Element for counting and web visits analytics service Clicky
 * {@link http://getclicky.com/}.
 * 
 * Parameters:
 * ===========
 * $id	string|integer	Id from the tracking code, if empty counter not shown
 * 
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-03-24
 */
if (empty($id)) return false;
?>
<script src="http://static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">clicky.init(<?php echo $id; ?>);</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="http://in.getclicky.com/<?php echo $id ?>ns.gif" /></p></noscript>