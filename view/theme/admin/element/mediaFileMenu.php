<?php

/**
 * MediaFile Menu
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-05-25
 */

if (empty($MediaFile)) return false; ?>
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