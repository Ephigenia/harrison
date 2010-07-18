<?php 

/**
 * 	Element for creating simple google maps displays
 * 	@author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * 	@since 2009-05-26
 * 	@param integer $width
 *	@param integer $height
 *	@param string 	$apiKey
 *	@param array 	$marker
 *	@param	string	$id
 */

// define default config
$defaults = array(
	'apiKey' => @Registry::get('GoogleMaps.ApiKey'),
	'width'	 => 500,
	'height' => 300,
	'id'	 => 'map',
	'zoom'	 => 2,
	'class'  => 'map',
	'mode'	 => 'default',
	'controls' => true,
);
$config = $this->data->merge($defaults, true);

$mapTypeMapping = array(
	'default' => 'G_NORMAL_MAP',
	'normal' => 'G_NORMAL_MAP',
	'satellite' => 'G_SATELLITE_MAP',
	'hybrid' => 'G_HYBRID_MAP',
);

// include google maps api
$js = '
	var map = new GMap(document.getElementById("'.$config->get('id').'"));
	document.'.$config->get('id').' = map;
	'.LF;

// include controls in the map
if ($config->get('controls')) {
	if (!is_array($config->get('controls'))) {
		$config->set('controls', array($config->get('controls')));
	}
	foreach($config->get('controls') as $controlName) {
		switch($controlName) {
			case 'smallzoom':
				$js .= 'map.addControl(new GSmallZoomControl());'.LF;
				break;
			case 'small':
				$js .= 'map.addControl(new GSmallMapControl());'.LF;
				break;
			case 'large':
				$js .= 'map.addControl(new GLargeMapControl());'.LF;
				break;
			case 'minimap':
			case 'map':
				$js .= 'map.addControl(new GOverviewMapControl());'.LF;
				break;
			case 'type':
			case 'mode':
				$js .= 'map.addControl(new GMapTypeControl());'.LF;
				break;
			default:
			case 'standard':
			case 'default':
				$js .= 'map.addControl(new GSmallMapControl());'.LF;
				$js .= 'map.addControl(new GMapTypeControl());'.LF;
				break;
		}
	} // foreach
}

// add marker point
if ($marker = $config->get('marker', false)) {
	if (!empty($marker['lat'])) {
		$marker = array($marker);
	}
	$js .= '
	// add markers
	var markers = '.json_encode($marker).';
	// record bounds to zoom
	var bounds = new GLatLngBounds();
	for(i in markers) {
		// add marker to map
		var point = new GPoint(markers[i].lng, markers[i].lat);
		// get marker options
		if (typeof(markers[i].params) !== "undefined") {
			var markerOptions = markers[i].params;
		} else {
			var markerOptions = {};
		}
		// marker icon
		if (typeof(markers[i].icon) != "undefined") {
			var icon = new GIcon(G_DEFAULT_ICON);
			icon.image = markers[i].icon;
			icon.iconSize = new GSize(16,16);
			markerOptions.icon = icon;
		}
		var marker = new GMarker(point, markerOptions);
		// click  url
		if (typeof(markerOptions.url) != "undefined") {
			GEvent.addListener(marker, "click", (function(markerOptions) {
				return function() {
                    document.location.href = markerOptions.url;
				};
			})(markerOptions));
		}
		map.addOverlay(marker);
		// extends map bounds
		bounds.extend(marker.getLatLng());
	}
	if (markers.length == 1) {
		map.setCenter(bounds.getCenter(), '.$config->get('zoom').');
	} else {
		map.setCenter(bounds.getCenter(), map.getBoundsZoomLevel(bounds));
	}
	';
}

$js .= 'map.setMapType('.$mapTypeMapping[$config->get('mode')].');'.LF;

$JavaScript->addFile('http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key='.$config->get('apiKey'));
$JavaScript->jQuery($js);
?>
<div id="<?php echo $config->get('id'); ?>" class="<?php echo $config->get('class'); ?>" style="width: <?php echo $config->get('width'); ?>px; height: <?php echo $config->get('height'); ?>px;" ></div>