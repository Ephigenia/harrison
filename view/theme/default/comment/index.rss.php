<?php foreach($Comments as $Comment) { ?>
<item>
	<?php
	$headline = strip_tags($Comment->BlogPost->headline);
	$headline = strtr($headline, array('&' => '&#x26;'));
	?>
	<title><?php echo sprintf(__('Kommentar - %s'), $headline); ?></title>
	<pubDate><?php echo date('r', $Comment->created); ?></pubDate>
	<description><![CDATA[<?php echo $Comment->text ?>]]></description>
	<content:encoded><![CDATA[<?php echo $Comment->text ?>]]></content:encoded>
	<guid isPermaLink="true"><?php echo $Comment->detailPageURL(); ?></guid>
	<link><?php echo $Comment->detailPageURL(); ?></link>
	<comments><?php echo $Comment->detailPageURL(); ?></comments>
	<dc:creator><?php echo $Comment->get('name'); ?></dc:creator>
</item>
<?php } ?>