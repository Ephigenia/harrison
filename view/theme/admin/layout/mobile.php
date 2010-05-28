<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo @$pageTitle ?></title>
		<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=7" /><![endif]-->
		<base href="<?php echo Router::url('admin'); ?>" />
		<?php
		if (isset($MetaTags)) echo String::indent($MetaTags->render(), 2, TAB, 1);
		if (isset($CSS)) {
			$CSS->addFiles(array(
				'jqtouch.min.css',
			));
			echo String::indent($CSS->render(), 2, TAB, 1);	
		}
        ?>
		<style type="text/css" media="screen">@import "<?php echo WEBROOT; ?>static/theme/apple/theme.min.css";</style>
	</head>
	<body class="<?php echo I18n::locale(); ?>">
		<div id="page1">
			<div class="toolbar">
				<h1>Harrison Admin</h1>
				<a class="back" href="<?php echo Router::getRoute('root') ?>"><?php echo __('Frontend'); ?></a>
				<a class="button flip" href="#login"><?php echo __('Logout'); ?></a>
			</div>
			<ul class="edgetoedge">
				<li class="arrow"><?php echo $HTML->link(Router::getRoute('adminNode'), __('Seiten')) ?></li>
				<li class="arrow"><?php echo $HTML->link(Router::getRoute('adminBlogPost'), __('Blog')) ?></li>
				<li class="arrow"><?php echo $HTML->link(Router::getRoute('adminMediaFiles'), __('Dateien &amp; Bilder')) ?></li>
				<li class="arrow"><?php echo $HTML->link(Router::getRoute('adminComment'), __('Kommentare')) ?></li>
				<li class="arrow"><?php echo $HTML->link(Router::getRoute('adminUser'), __('Benutzer')) ?></li>
				<li class="arrow"><?php echo $HTML->link(Router::getRoute('adminScaffold', array('controller' => 'UserGroup')), __('Einstellungen')) ?></li>
            </ul>
			<div class="info">
				<?php echo $this->element('footer'); ?>
			</div>
        </div>
		<div id="login">
			Login galore!
		</div>
		<?php
		if (isset($JavaScript)) {
			$JavaScript->addFiles(array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
				'jqtouch.js',
				'mobile.js',
			));
			echo String::indent($JavaScript->render(), 2, TAB, 1);
		} ?>
	</body>
</html>