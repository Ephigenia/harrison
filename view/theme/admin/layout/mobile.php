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
				'reset.css',
				'jqtouch.min.css',
			));
			echo String::indent($CSS->render(), 2, TAB, 1);	
		}
        ?>
		<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT; ?>static/theme/jqt/theme.min.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT; ?>static/theme/admin/css/mobile.css" media="screen" />
	</head>
	<body class="<?php echo I18n::locale(); ?>">
		<div id="<?php echo $controller.$action; ?>" class="current">
			<?php echo $content; ?>
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