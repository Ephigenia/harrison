<h1><?php
	if (empty($BlogPost)) {
		echo __('Kommentare');
	} else {
		echo __('Kommentare zu :1', $BlogPost->get('headline'));
	}
?></h1>
<ul class="breadcrumb">
	<li><?php echo $HTML->link(Router::getRoute('admin'), __('Home')); ?></li>
	<?php if (!empty($BlogPost)) { ?>
	<li><?php echo $HTML->link(Router::getRoute('adminBlogPost'), __('Blog')); ?></li>
	<li><?php echo $HTML->link($BlogPost->adminDetailPageUri(), String::truncate($BlogPost->get('headline'), 20, '…')); ?></li>
	<?php } ?>
	<li><?php echo __('Kommentare'); ?></li>
</ul>

<?php if (empty($Comments)) { 
	echo $HTML->p(__('Es sind noch keine Kommentare vorhanden.'), array('class' => 'hint'));
} else {
	echo $this->renderElement('pagination');
	echo $this->renderElement('comments', array('comments' => $Comments)); 
	echo $this->renderElement('pagination');
}