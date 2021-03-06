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
	
	// delete confirmation when in admin mode
	$('.confirm').live('click', function(e) {
		var message = $(this).attr('title');
		if (message.length == 0) {
			var message = 'Sind Sie sicher das Sie das löschen möchten?';
		}
		if (window.confirm(message)) {
			document.location.href = $(this).attr('href');
		}
		e.preventDefault();
	});
	
	var flashMessageElm = $('#flashMessage');
	if (flashMessageElm.length > 0) {
		flashMessageElm.addClass('info');
		$('.current .toolbar').after(flashMessageElm);
	}
	
});
