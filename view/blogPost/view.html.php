<?php echo $this->view->render('element', 'blogPost', array('BlogPost' => $BlogPost)) ?>

<?php if ($BlogPost->comments) { ?>
<section id="Comments">
	<header>
		<h2><?php echo $BlogPost->comments->count(); ?> Kommentare</h2>
	</header>
	<?php foreach($BlogPost->comments as $Comment) {
		echo $this->view->render('element', 'comment', array('Comment' => $Comment));
	} ?>
</section>
<?php } ?>