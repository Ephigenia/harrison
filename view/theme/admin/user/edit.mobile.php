<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link($User->adminDetailPageUri('delete'),
		__('Löschen'),
		array(
			'class' => 'button delete confirm',
			'title' => __('Wollen Sie den Benutzer :1 wirklich löschen?', $User->get('name'))
		)
	);
	?>
</div>
<?php echo $this->element('jqtouch/form', array('Form' => $AdminUserForm)); ?>