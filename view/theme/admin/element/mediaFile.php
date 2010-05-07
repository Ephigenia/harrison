<?php

$CSS->link($elementBaseName);
$detailPageUri = $MediaFile->adminDetailPageUri(array('action' => 'edit'));

?>
<div class="<?php echo $elementBaseName; ?>">
	<div class="thumb">
		<?php
		if ($MediaFile->file()) {
			if ($MediaFile instanceof MediaImage) {
				$icon = $HTML->image($MediaFile->src(160, 120));
			} else {
				$extension = $MediaFile->file()->extension();
				$icon = $HTML->tag('span', String::upper($extension), array('class' => array($extension, 'filetype')));
			}
		} else {
			$icon = $HTML->tag('span', __('?'), array('class' => 'filetype'));
		}
		echo $HTML->link($detailPageUri, $icon);
		?>
	</div>
	<a href="<?php echo $detailPageUri ?>" title="<?php echo __('Datei editieren') ?>">
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
	if (isset($Me) && empty($disableMenu)) {
		?>
		<ul class="admin">
		<?php if (empty($layout)) { ?>
		 	<li><?php echo $HTML->link($MediaFile->adminDetailPageUri('edit'), '&nbsp;', array('class' => 'edit', 'title' => __('Datei neu hochladen oder Angaben zur Datei ändern'))); ?></li>
			<li><?php echo $HTML->link(
				$MediaFile->adminDetailPageUri('delete'),
				'&nbsp;',
				array(
					'class' => 'deleteConfirm delete',
					'title' => __('Wollen Sie Datei <q>:1</q> wirklich löschen?', $MediaFile->filename),
				)
			); ?></li>
			<?php if (!empty($displayMoveLinks)) {
				$m = $MediaFile->adminDetailPageUri('move').'/'; ?>
				<li><?php echo $HTML->link($m.PositionableBehavior::MOVE_DIRECTION_TOP.'/', '&nbsp;', array('class' => 'topLeft', 'title' => __('Ganz nach vorne bewegen'))); ?></li>
				<li><?php echo $HTML->link($m.PositionableBehavior::MOVE_DIRECTION_UP.'/', '&nbsp;', array('class' => 'left', 'title' => __('Nach vorne bewegen'))); ?></li>
				<li><?php echo $HTML->link($m.PositionableBehavior::MOVE_DIRECTION_DOWN.'/', '&nbsp;', array('class' => 'right', 'title' => __('Nach hinten bewegen'))); ?></li>
				<li><?php echo $HTML->link($m.PositionableBehavior::MOVE_DIRECTION_BOTTOM.'/', '&nbsp;', array('class' => 'topRight', 'title' => __('Ganz nach hinten bewegen'))); ?></li>
			<?php } ?>
		<?php } // if ?>
		</ul>
		<?php
	} ?>
</div>