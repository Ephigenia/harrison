<div class="toolbar">
	<?php
	echo $HTML->link(Router::uri('admin'), __('back'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link(Router::getRoute('adminBlogPostCreate', array('action' => 'create')), '+', array('class' => 'button slide')); ?>
	?>
</div>
<?php if (empty($BlogPosts)) { 
	echo $HTML->tag('div', __('Es sind noch keine Blogeinträge vorhanden.'), array('class' => 'info'));
} else {
	?>
	<ul class="edgetoedge">
	<?php foreach($BlogPosts as $BlogPost) {
		if (@$lastDate != date('d.m.Y', $BlogPost->published)) {
			echo $HTML->tag('li', strftime('%x %H:%M', $BlogPost->published), array('class' => 'sep'));
		}
		?>
		<li class="slide">
			<a href="<?php echo $BlogPost->adminDetailPageUri('edit'); ?>">
				<?php echo Sanitizer::html($BlogPost->get('headline')); ?>
			</a>
		</li>
		<?php
		$lastDate = date('d.m.Y', $BlogPost->published);
	} ?>
	</ul>
	<?php
}