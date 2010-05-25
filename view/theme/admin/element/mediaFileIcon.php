<?php
$CSS->link('mediaFile');
?>
<div class="mediaFile">
	<?php echo $this->element('mediaFileThumb', array('MediaFile' => $MediaFile)); ?>
	<a class="filename" href="<?php echo $MediaFile->adminDetailPageUri(array('action' => 'edit')) ?>" title="<?php echo __('Datei editieren') ?>">
		<?php echo String::wrap(String::truncate($MediaFile->getText('title', $MediaFile->filename), 43, '…'), 20); ?>
	</a><br />
	<span class="meta">
		<?php 
		if ($MediaFile->file()) {
			$fileSize = $MediaFile->file()->size(2, true);
		} else {
			$fileSize = 'NaN';
		}
		echo String::replace(':filesize, (:date)', array(
			'filesize' => @$fileSize,
			'date' => ($MediaFile->created < strtotime('today')) ? strftime('%x', $MediaFile->created) : $Time->niceShort($MediaFile->created)
		));
		?>
	</span>
	<?php
	// Administrative Links
	if (empty($disableMenu)) {
		echo $this->element('mediaFileMenu', array('MediaFile' => $MediaFile));
	} ?>
</div>