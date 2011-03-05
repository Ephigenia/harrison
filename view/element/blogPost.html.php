<article class="BlogPost<?php echo $BlogPost->id; ?>">
	<header>
		<h1>
			<a href="#"><?php echo $BlogPost->headline; ?></a>
		</h1>
	</header>
	<section>
		<?php echo $BlogPost->text; ?>
	</section>
	<footer>
	</footer>
</article>