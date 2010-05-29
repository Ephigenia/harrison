<div class="toolbar">
	<?php
	echo $HTML->link(Router::uri('admin'), __('zurück'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link(
		Router::getRoute('adminCommentId', array('id' => $Comment->id, 'action' => 'delete')),
		__('löschen'),
		array(
			'class' => 'button confirm',
			'title' => __('Wollen Sie diesen Kommentar wirklich löschen?'),
		)
	); ?>
	?>
</div>
<?php echo $this->element('jqtouch/form', array('Form' => $AdminCommentForm)); ?>