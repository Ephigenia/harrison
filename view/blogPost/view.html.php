<?php echo $this->view->render('element', 'blogPost', array('BlogPost' => $BlogPost)) ?>

<?php if ($BlogPost->comments) { ?>
<div id="Comments">
	<h2><?php echo $BlogPost->comments->count(); ?> Kommentare</h2>
	<ol class="comments">
	<?php foreach($BlogPost->comments as $Comment) {
		echo $this->view->render('element', 'comment', array('Comment' => $Comment));
	} ?>
	</ol>
</div>
<?php } ?>