<div class="toolbar">
	<?php
	echo $HTML->link('#', __('zurück'), array('class' => 'back flip'));
	echo $HTML->tag('h1', $pageTitle);
	echo $HTML->link($BlogPost->adminDetailPageUri('delete'), __('löschen'), array('class' => 'button'));
	?>
</div>
<?php if (count($BlogPost->Comments) > 0) { ?>
<ul class="rounded">
	<li class="arrow">
		<?php
		echo $HTML->link(
			Router::getRoute('adminCommentBlogPost', array('blogPostId' => $BlogPost->id)),
			__n(':1 Kommentar', ':1 Kommentare', $BlogPost->Comments->count())
		);
		?>
	</li>
</ul>
<?php } ?>
<?php echo $this->element('jqtouch/form', array('Form' => $AdminBlogPostForm)); ?>