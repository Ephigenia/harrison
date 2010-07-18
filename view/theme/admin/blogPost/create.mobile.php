<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<?php echo $this->element('jqtouch/form', array('Form' => $AdminBlogPostForm)); ?>