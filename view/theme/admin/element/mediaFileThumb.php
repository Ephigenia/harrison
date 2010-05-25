<?php

if (empty($MediaFile)) return false;

?>
<div class="thumb">
	<?php
	if ($MediaFile->file()) {
		if ($MediaFile instanceof MediaImage) {
			$icon = $HTML->image($MediaFile->src(coalesce(@$width, 160), coalesce(@$height, 120)));
		} else {
			$extension = $MediaFile->file()->extension();
			$icon = $HTML->tag('span', String::upper($extension), array('class' => array($extension, 'filetype')));
		}
	} else {
		$icon = $HTML->tag('span', __('?'), array('class' => 'filetype'));
	}
	echo $HTML->link($MediaFile->adminDetailPageUri(array('action' => 'edit')), $icon);
	?>
</div>