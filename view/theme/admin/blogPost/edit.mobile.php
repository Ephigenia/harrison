<div class="toolbar">
	<?php
	echo $HTML->link(Router::uri('admin'), __('zurück'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link(Router::uri('admin'), __('löschen'), array('class' => 'button'));
	?>
</div>
<?php echo $this->element('jqtouch/form', array('Form' => $AdminBlogPostForm)); ?>