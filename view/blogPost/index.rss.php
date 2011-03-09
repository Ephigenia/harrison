<?php
if (!empty($BlogPosts)) foreach($BlogPosts as $BlogPost) {
	// $text = $BlogPostFormater->format($entry->text);
	$url = $Router->BlogPost(array('uri' => $BlogPost->uri));
	$text = $BlogPost->text;
	if ($BlogPost->headline) {
		$headline = ephFrame\util\String::truncate(strip_tags($text), 60, '…');
	} else {
		$headline = strip_tags($BlogPost->headline);
	}
	?>
	<item>
		<title><?php echo strtr($headline, array('&' => '&#x26;')) ?></title>
		<pubDate><?php echo $BlogPost->published->format('r'); ?></pubDate>
		<description><![CDATA[<?php echo $text ?>]]></description>
		<content:encoded><![CDATA[<?php echo $text ?>]]></content:encoded>
		<guid isPermaLink="true"><?php echo $url ?></guid>
		<link><?php echo $url ?></link>
		<comments><?php echo $url.'#Comments' ?></comments>
		<author><?php echo $BlogPost->user->name; ?></author>
	</item>
	<?php
}