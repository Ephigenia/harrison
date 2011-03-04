<?php
if (!empty($BlogPosts)) foreach($BlogPosts as $entry) {
	$text = $BlogPostFormater->format($entry->text);
	if ($entry->isEmpty('headline')) {
		$headline = String::truncate(strip_tags($text), 60, '…');
	} else {
		$headline = strip_tags($entry->get('headline'));
	}
	?>
	<item>
		<title><?php echo strtr($headline, array('&' => '&#x26;')) ?></title>
		<pubDate><?php echo date('r', $entry->published); ?></pubDate>
		<description><![CDATA[<?php echo $text ?>]]></description>
		<content:encoded><![CDATA[<?php echo $text ?><!-- p52h7fmk9e -->]]></content:encoded>
		<guid isPermaLink="true"><?php echo $entry->detailPageURL() ?></guid>
		<link><?php echo $entry->detailPageURL() ?></link>
		<comments><?php echo $entry->detailPageURL().'#Comments' ?></comments>
		<author><?php echo $entry->User->get('name'); ?></author>
	</item>
	<?php
}