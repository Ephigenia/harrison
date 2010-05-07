<?php
// admin links
if (isset($Me)) {
	$detailPageUri = WEBROOT.'image/'.$Image->id.'/';
	?>
	<ul class="admin">
	 	<?php foreach($Languages as $Language) { ?>
	 	<li><?php echo $HTML->link($detailPageUri.'edit/'.$Language->code.'/', '&nbsp;', array('class' => 'buttonEdit', 'title' => 'editieren ('.$Language->code.')')); ?></li>
	 	<?php } ?>
		<li><?php echo $HTML->link($detailPageUri.'delete/', '&nbsp;', array('class' => 'deleteConfirm delete buttonDelete', 'title' => __('löschen'))); ?></li>
		<?php if (!empty($displayMoveLinks)) { ?>
		<li><?php echo $HTML->link($detailPageUri.'move/'.PositionableBehavior::MOVE_DIRECTION_TOP.'/', '&nbsp;', array('class' => 'buttonTopLeft')); ?></li>
		<li><?php echo $HTML->link($detailPageUri.'move/'.PositionableBehavior::MOVE_DIRECTION_UP.'/', '&nbsp;', array('class' => 'buttonLeft')); ?></li>
		<li><?php echo $HTML->link($detailPageUri.'move/'.PositionableBehavior::MOVE_DIRECTION_DOWN.'/', '&nbsp;', array('class' => 'buttonRight')); ?></li>
		<li><?php echo $HTML->link($detailPageUri.'move/'.PositionableBehavior::MOVE_DIRECTION_BOTTOM.'/', '&nbsp;', array('class' => 'buttonTopRight')); ?></li>
		<?php } ?>
	</ul>
	<?php
} ?>