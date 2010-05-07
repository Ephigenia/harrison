<?php $CSS->link('node'); ?>
<h1><?php Sanitizer::html($Node->getText('headline')); ?></h1>
<?php if ($subline = $Node->getText('subline', null, false)) {
	echo $HTML->tag('h2', $subline);
}
?>
<div class="text">
	<?php
	$text = $Node->getText('text');
	$text = $NodeTextFormater->format($text);
	$text = nl2br($text);
	// use markdown?
	$text = $MarkDown->format($text);
	// auto convert urls and email addies to clickable links
	$text = $Text->autoURLs($text);
	$text = $Text->autoEmail($text);
	echo $text;
	?>
</div>

<?php if (!empty($Node->MediaFiles)) foreach($Node->MediaFiles as $Image) { ?>
<div id="Images" class="span-15 last">
	<div class="span-11">
		<a href="<?php echo $Image->src(); ?>"><?php echo $HTML->image($Image->src(510, null, 'resizeTo')); ?></a>
	</div>
	
	<div class="span-4 last">
		<h2><?php echo $Image->getText('name') ?></h2>
		<?php echo $NodeTextFormater->format($Image->getText('text')); ?>
	</div>
</div>
<?php } ?>