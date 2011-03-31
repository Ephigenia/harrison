<?php
if ($Paginator->pagesTotal <= 1) return false;
?>
<ul class="pagination">
<?php
	if ($Paginator->hasPrevious()) {
		echo $HTML->tag('li', $Paginator->previous('« zurück'));
	}
	echo $Paginator->numbers('li', 3);
	if ($Paginator->hasNext()) {
		echo $HTML->tag('li', $Paginator->next('weiter »'));
	}
?>
</ul>