<?php

if (empty($MediaFile)) return false;

?>
<div class="thumb">
	<?php
	if ($MediaFile->file()) {
		if ($MediaFile instanceof MediaImage) {
			$icon = $HTML->image($MediaFile->src(coalesce(@$width, 160), coalesce(@$height, 120), coalesce(@$method, 'resize')));
		} else {
			$extension = $MediaFile->file()->extension();
			$icon = $HTML->tag('span', String::upper($extension), array('class' => array($extension, 'filetype')));
		}
	} else {
		$icon = $HTML->tag('span', __('?'), array('class' => 'filetype'));
	}
	if (!isset($link)) {
		$link = $MediaFile->adminDetailPageUri(array('action' => 'edit'));
	}
	if (!empty($link)) {
		echo $HTML->link($link, $icon);
	} else {
		echo $icon;
	}
	?>
</div>