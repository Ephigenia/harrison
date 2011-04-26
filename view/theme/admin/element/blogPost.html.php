<article class="BlogPost-<?php echo $BlogPost->id; ?>">
	<header>
		<h1>
			<a href="<?php echo $Router->BlogPost(array('uri' => $BlogPost->uri)); ?>" rel="bookmark"><?php echo $BlogPost; ?></a>
		</h1>
	</header>
	<?php
		echo ephFrame\util\String::truncate(strip_tags($BlogPost->text), 100);
	?>
</article>