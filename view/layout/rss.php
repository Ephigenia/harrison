<?php echo '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>'.LF; ?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title><?php echo @$pageTitle ?></title>
		<atom:link href="<?php echo Router::url('root') ?>" rel="self" type="<?php echo $this->contentType ?>" />
		<link><?php echo Router::url('root') ?></link>
		<description>RSS Feed from <?php echo AppController::NAME; ?></description>
		<language><?php echo I18n::locale(); ?></language>
		<copyright><?php echo $MetaTags->copyright ?></copyright>
		<generator><?php echo $MetaTags->generator ?></generator>
		<pubDate><?php echo date('r') ?></pubDate>
		<?php echo @$content ?>
	</channel>
</rss>