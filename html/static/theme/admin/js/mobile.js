/**
 * Javascripts for Harrison Admin jQTouch-Style
 * @project Harrison
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
var jQT = new $.jQTouch({
    icon: 'apple-touch-icon.png',
    addGlossToIcon: false,
    startupScreen: 'jqt_startup.png',
    statusBar: 'black',
	fullscreen: true
});

$(document).ready(function() {
	// ajax load every content that is not allready there
	
	$('.confirm').live('click', function(e) {
		var message = $(this).attr('title');
		var result = window.confirm(message);
		if (message.length == 0) {
			var message = 'Sind Sie sicher das Sie das löschen möchten?';
		}
		if (result) {
			document.location.href = $(this).attr('url');
		}
		e.preventDefault();
	});
	
	$('body').bind('turn', function(event, info) {
		$('body').toggleClass(info.orientation);
	});
	
});
