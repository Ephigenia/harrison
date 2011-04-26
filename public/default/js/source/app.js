$(document).ready(function() {
	
	$('body').removeClass('no-js');
	// placeholder attribute
	if (typeof($.fn.placeholder) == 'function') {
		$('input[placeholder], textarea[placeholder]').placeholder();
	}
	// metadata
	if (typeof($.fn.metadata) == 'function') {
		$.metadata.setType('attr', 'data');
	}
	// set all external links to open in new window
	$('a[rel=external]').attr('target', '_blank');
	
});
