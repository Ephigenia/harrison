<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link(Router::getRoute('adminBlogPostCreate', array('action' => 'create')), '+', array('class' => 'button slide'));
	?>
</div>
<?php if (empty($BlogPosts)) { 
	echo $HTML->tag('div', __('Es sind noch keine Blogeinträge vorhanden.'), array('class' => 'info'));
} else {
	?>
	<ul class="edgetoedge">
	<?php foreach($BlogPosts as $BlogPost) {
		if (@$lastDate != date('dmy', $BlogPost->published)) {
			echo $HTML->tag('li', strftime('%x %H:%M', $BlogPost->published), array('class' => 'sep'));
		}
		?>
		<li>
			<a href="<?php echo $BlogPost->adminDetailPageUri('edit'); ?>">
				<?php echo Sanitizer::html($BlogPost->get('headline')); ?>
			</a>
			<?php if (count($BlogPost->Comments) > 0) {
				echo $HTML->tag('small', count($BlogPost->Comments), array('class' => 'counter'));
			} ?>
		</li>
		<?php
		$lastDate = date('dmy', $BlogPost->published);
	} ?>
	</ul>
	<?php
}