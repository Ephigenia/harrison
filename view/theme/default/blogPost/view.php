<?php echo $this->renderElement('blogPost', array('blogPost' => $BlogPost)) ?>

<div id="Comments">
	<?php if ($BlogPost->Comments->count() > 0) { ?>
	<h2><?php echo __('Kommentare') ?></h2>
	<ul class="comments">
	<?php foreach($BlogPost->Comments->reversed() as $Comment) {
		echo $this->renderElement('comment', array('Comment' => $Comment));
	} ?>
	</ul>
	<?php } ?>
</div>
<br class="c" />

<?php if ($BlogPost->hasFlag(BlogPostFlag::ALLOW_COMMENTS)) { ?>
<div id="writeComment">
	<h2><?php echo __('Kommentar abgeben') ?></h2>
	<?php echo $CommentForm ?>
</div>
<?php } else {
	echo $HTML->tag('p', echo __('Dieser Blogpost wurde für Kommentare gesperrt. Du kannst ihn nicht kommentieren!'), array('class' => 'hint'));
} ?>
