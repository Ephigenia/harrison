<?php

/**
 * Element for rendering paginations
 *
 * Parameters
 * ==========
 * $class 	optional string for class name to use in li-list of page links
 * 
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-09-28
 */

if ($Paginator->pagesTotal <= 1) return false;
?>
<ul class="pagination c<?php echo @$class; ?>">
<?php
	if ($Paginator->hasPrevious()) {
		echo $HTML->tag('li', $Paginator->previous(__('« zurück'))).LF;
	}
	echo $Paginator->numbers().LF;
	if ($Paginator->hasNext()) {
		echo $HTML->tag('li', $Paginator->next(__('weiter »')));
	}
?>
</ul>