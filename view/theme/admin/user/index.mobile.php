<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link(Router::getRoute('adminUserAction', array('action' => 'create')), '+', array('class' => 'button')); ?>
	?>
</div>
<ul class="rounded">
	<?php foreach($Users as $User) { ?>
	<li class="arrow">
		<a href="<?php echo $User->adminDetailPageUri('edit'); ?>">
			<?php echo $this->renderElement('gravatar', array('User' => $User, 'size' => 16)); ?>
			<?php echo $User->get('name') ?>
		</a>
	</li>
	<?php } ?>
</ul>