<div class="toolbar">
	<?php
	echo $HTML->link(Router::uri('root'), __('Frontend'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	?>
</div>
<div class="info">
	<?php echo $this->element('jqtouch/form', array('Form' => $LoginForm)); ?>
</div>