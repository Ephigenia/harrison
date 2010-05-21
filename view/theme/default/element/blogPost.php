<?php
$CSS->link($elementBaseName);
?>
<div class="<?php echo $elementBaseName; ?>">
	<h2><?php echo $HTML->link($BlogPost->detailPageUri(), $BlogPost->get('headline'), array('rel' => 'bookmark')); ?></h2>
	<div class="text"><?php
		// format blog posts content text
		if ($controller.$action == 'BlogPostindex') {
			$text = $Text->more($BlogPost->text, $BlogPost->detailPageUri(), __('Artikel weiterlesen …'), __('Den kompletten :1 Blogeintrag lesen', $BlogPost->get('headline')));
		} else {
			$text = $BlogPost->text;
		}
		// format rest of the entry
		$text = $BlogPostFormater->format($text);
		// highlight keywords
		if (!empty($q)) {
			$text = $Text->highlight($text, $q);
		}
		echo $text;
		?>
	</div>
	<div class="meta c">
		<?php echo $this->element('gravatar', array('email' => $BlogPost->User->get('email'), 'size' => 12)); ?>
		<cite><?php echo $BlogPost->User->get('name'); ?></cite> • 
		<a href="<?php echo $BlogPost->detailPageUri(); ?>" title="<?php echo date('c', $BlogPost->published); ?>" rel="bookmark">
			<?php echo strftime('%x %H:%M', $BlogPost->published); ?></a> • <?php
		$commentsLabel = __n(':1 Kommentar', ':1 Kommentare', $BlogPost->Comments->count());
		echo $HTML->link($BlogPost->detailPageUri().'#Comments', $commentsLabel, array('rel' => 'bookmark'));
		?>
	</div>
</div>