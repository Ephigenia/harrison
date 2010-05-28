<div id="footer" class="c">
	<a href="http://code.marceleichner.de/project/harrison/?ver=<?php echo AppController::VERSION; ?>" rel="external">Harrison</a> <?php echo AppController::VERSION; ?> •
	<?php
	if (empty($isMobile)) {
		echo $HTML->link(Router::url(), __('Mobile Version'));
	} else {
		echo $HTML->link(Router::url(), __('Standard Version'));
	}
	?> •
	created by <?php echo $HTML->link('http://www.marceleichner.de/?ref=harrison', 'Marcel Eichner // Ephigenia', array('rel' => 'external')) ?>
</div>