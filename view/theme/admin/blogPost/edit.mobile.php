<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link($BlogPost->adminDetailPageUri('delete'), __('löschen'), array('class' => 'button'));
	?>
</div>
<?php echo $this->element('jqtouch/form', array('Form' => $AdminBlogPostForm)); ?>