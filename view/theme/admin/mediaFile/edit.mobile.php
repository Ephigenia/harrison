<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<div class="info">
	<?php echo $this->element('mediaFileThumb', array('MediaFile' => $MediaFile, 'width' => 470, 'height' => 470, 'method' => 'resize')); ?>
	<dl>
		<dt><?php echo __('Dateiname'); ?></dt>
		<dd><?php echo $MediaFile->getText('title', $MediaFile->filename); ?></dd>
		<?php if ($MediaFile instanceof MediaImage) { ?>
		<dt><?php echo __('Abmessungen'); ?></dt>
		<dd><?php echo sprintf('%dx%dpx', $MediaFile->width, $MediaFile->height); ?></dd>
		<?php } ?>
		<dt><?php echo __('Dateigröße'); ?></dt>
		<dd><?php
			if ($MediaFile->file()) {
				$fileSize = $MediaFile->file()->size(2, true);
			} else {
				$fileSize = 'NaN';
			}
			echo $fileSize;
		?></dd>
	</dl>
</div>