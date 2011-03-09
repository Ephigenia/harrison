<?php echo '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>'.PHP_EOL; ?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title><?php echo @$pageTitle ?></title>
		<atom:link href="<?php echo $Router->root->url() ?>" rel="self" type="application/atom+xml" />
		<link><?php echo $Router->root->url() ?></link>
		<description></description>
		<language>de_DE</language>
		<copyright></copyright>
		<generator></generator>
		<pubDate><?php echo date('r') ?></pubDate>
		<?php echo @$content ?>
	</channel>
</rss>