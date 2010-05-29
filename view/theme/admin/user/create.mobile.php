<div class="toolbar">
	<?php
	echo $HTML->link('#', __('back'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<?php echo $this->element('jqtouch/form', array('Form' => $AdminUserForm)); ?>