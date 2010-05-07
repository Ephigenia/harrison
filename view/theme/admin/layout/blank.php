<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo @$pageTitle ?></title>
		<base href="<?php echo Router::url('root'); ?>" />
		<?php
		if (isset($MetaTags)) echo String::indent($MetaTags->render(), 2);
		if (isset($CSS)) echo String::indent($CSS->render(), 2);
        ?>
		<!--[if IE 8]><meta http-equiv="X-UA-Compatible" content="IE=7" /><![endif]-->
	</head>
	<body>
		<div id="content" style="margin: 0px;">
			<?php echo @$content ?>
		</div>
		<?php if (isset($JavaScript)) echo String::indent($JavaScript->render(), 2); ?>
	</body>
</html>