<?php

/**
 * Simple Google Adsense Text-Ad-Display element for usage in ephFrame
 * framework projects. See the config array for possible options
 * 	
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>	
 * @since 2009-07-26
 */

$defaults = array(
	'clientId' 	=> Registry::get('Adsense.ClientId'),	// change this ins global config.php
	'slot'		=> '',
	'width'		=> 200,
	'height'	=> 200,
);
$config = $this->data->merge($defaults, true);
if ($config->get('size')) {
	list($config['width'], $config['height']) = explode('x', $config['size']);
}

?>
<script type="text/javascript"><!--		
	google_ad_client = '<?php echo $config->get('clientId'); ?>';
	google_ad_slot = '<?php echo $config->get('slot'); ?>';
	google_ad_width = <?php echo $config->get('width'); ?>;
	google_ad_height = <?php echo $config->get('height'); ?>;
	//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>