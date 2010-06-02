<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo @$pageTitle ?></title>
		<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=7" /><![endif]-->
		<base href="<?php echo Router::url('root'); ?>" />
		<?php
		if (isset($MetaTags)) echo String::indent($MetaTags->render(), 2);
		if (isset($CSS)) {
			$CSS->addFiles(array(
				'reset',
				'simplePreview',
				'mainMenu',
				'debug',
				'admin',
				'form',
				'login',
				'dialog',
				'table',
				'debug',
				'mediaFile',
			));
			echo String::indent($CSS->render(), 2, TAB, 1);	
		}
        ?>
		
	</head>
	<body>
		<div id="content" style="margin: 0px;">
			<?php echo @$content ?>
		</div>
		<?php
		if (isset($JavaScript)) {
			$JavaScript->addFiles(array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
				'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js',
				'js.class.core',
				'php.custom.min',
				'swfobject.js',
				'jquery.plugin.fieldselection',
				'jquery.plugin.dialog',
				'jquery.plugin.simplePreview',
				'jquery.uploadify.v2.1.0.min.js', // uploadify
				'admin',
				'tabs',
			));
			echo String::indent($JavaScript->render(), 2, TAB, 1);
		}
		echo $this->element('debug/dump');
		?>
	</body>
</html>