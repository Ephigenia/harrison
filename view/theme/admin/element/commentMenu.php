<?php

/**
 * 	Admin menu for comments
 */

if (empty($Comment)) return false;

?>
<ul class="admin">
	<?php if ($Comment->status == Status::PENDING) { ?>
	<li>
		<?php echo $HTML->link(Router::getRoute('adminCommentId', array('id' => $Comment->id, 'action' => 'approve')), __('Kommentar freischalten')); ?>
	</li>
	<?php } ?>
	<li>
		<?php echo $HTML->link(Router::getRoute('adminCommentId', array('id' => $Comment->id, 'action' => 'edit')), __('editieren')); ?>
	</li>
	<li>
		<?php echo $HTML->link(
			Router::getRoute('adminCommentId', array('id' => $Comment->id, 'action' => 'delete')),
			__('löschen'),
			array(
				'class' => 'deleteConfirm delete',
				'title' => __('Wollen Sie diesen Kommentar wirklich löschen?'),
			)
		); ?>
	</li>
</ul>
