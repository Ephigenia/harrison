<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo I18n::locale(); ?>">
	<head>
		<title><?php echo @$pageTitle ?></title>
		<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=7" /><![endif]-->
		<base href="<?php echo Router::url('root'); ?>" />
		<meta name="viewport" content="width=440" />
		<?php
		if (isset($MetaTags)) echo String::indent($MetaTags->render(), 2, TAB, 1);
		if (isset($CSS)) {
			$CSS->addFiles('reset', 'app', 'form', 'comment', 'mobile');
			echo String::indent($CSS->render(), 2, TAB, 1);
		}
		// Favicon
		if (file_exists('./favicon.ico')) {
			echo TAB.TAB.'<link rel="shortcut icon" type="image/ico" href="'.WEBROOT.'favicon.ico" />'.LF;
		}
		// iPod-Touch, iPhone Icons
		if (file_exists('./apple-touch-icon.png')) {
			echo TAB.TAB.'<link rel="apple-touch-icon" type="image/x-icon" href="'.WEBROOT.'apple-touch-icon.png" />'.LF;
		}
        ?>
		<link rel="alternate" type="application/rss+xml" title="<?php echo AppController::NAME; ?> - RSS 2.0 Blogposts abonnieren" href="http://feeds2.feedburner.com/HorrorblogOrg/" />
		<link rel="alternate" type="application/rss+xml" title="<?php echo AppController::NAME; ?> - RSS 2.0 Kommentare Abonnieren" href="http://feeds.feedburner.com/horrorblogOrgComments/" />
	</head>
	<body id="mobile" class="<?php echo I18n::locale(); ?>">
		<div id="app">
			<h1 class="logo"><a href="<?php echo WEBROOT; ?>" title="<?php echo AppController::NAME; ?> Startseite" rel="home"><?php echo AppController::NAME; ?></a></h1>
			<?php echo $SearchForm ?>
			<br />
			<div id="content">
				<?php echo @$content ?>
			</div>
		</div>
		<!-- counters and stuff -->
		<?php if (!isset($Me) && @$_SERVER['HTTP_HOST'] != 'localhost') {
			echo $this->renderElement('global/blogoscoop.php', array('id' => 6566));
		}
		if (isset($JavaScript)) {
			$JavaScript->addFiles(array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
				'app',
			));
			echo String::indent($JavaScript->render(), 2, TAB, 1).LF;
		}	
		echo $this->renderElement('global/analytics/googleAnalytics', array('id' => 'UA-9581334-1')).LF;
		echo $this->renderElement('global/analytics/clicky', array('id' => '197569')).LF; ?>
	</body>
</html>