/**
 * 	Javascripts for admin-mode only
 * 	@author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
$(document).ready(function() {
	
	$.getScript($('base').attr('href') + '../static/js/jquery.plugin.toggleValue.js', function() {
		$('input.q').toggleValue();
	});
	
	/**
	 * Main menu
	 */
	// mainmenu toggle
	$('#mainMenu a.toggle').click(function() {
		var subMenu = $(this).parent().find('ul');
		if (!subMenu.length) return;
		if (subMenu.is(':hidden')) {
			subMenu.slideDown();
			$(this).html('-');
		} else {
			subMenu.slideUp();
			$(this).html('+');
		}
	}).html('-');
	
	// Flashmessage auto-hide
	if ($('#flashMessage').length > 0) {
		$('#flashMessage').click(function() {
			$(this).fadeOut('fast');
		});
		window.setTimeout("$('#flashMessage').trigger('click');", 10000);
	}
	
	// minimize button
	$('.minimize a').click(function() {
		var MenuMinimized = $('#leftColumn.minimized').length;
		// turn minimized or not
		if (!MenuMinimized) {
			$('#mainMenu li:gt(0)').hide();
			$(this).html('»');
			$('#content').css('margin-left', '2.5em');
		} else {
			$('#mainMenu li:gt(0)').show();
			$(this).html('« minimize');
			$('#content').css('margin-left', '175px');
		}
		$('#leftColumn').toggleClass('minimized');
	});
	
	
	// search form
	$('#AdminSearchForm input').bind('keyup', function() {
		var value = $(this).val();
		if (value.length < 3) return false;
		var url = $('#AdminSearchForm').attr('action') + '/search/' + value;
		$.getJSON(url, function(data) {
			var html = '';
			if (data.length == 0) {
				html += '<li>No results</li>';
			} else {
				for (i = 0; i < data.length; i++) {
					html += '<li><a href="' + data[i].uri + '">';
					if ('undefined' != typeof(data[i].img)) {
						html += data[i].img;
					}
					html += data[i].title;
					html += '</a></li>';
				}
			}
			$('#AdminSearchForm #results').remove();
			$('#AdminSearchForm').append('<ul id="results">' + html + '</ul>');
		});
		return true;
	}).bind('focus', function() {
		$('#AdminSearchForm #results').slideDown();
	}).bind('blur', function() {
		$('#AdminSearchForm #results').slideUp().hide();
	});
	
	// delete confirmation when in admin mode
	$('.deleteConfirm').each(function() {
		var url = $(this).attr('href');
		$(this).attr('href', 'javascript:void(0);');
		$(this).click(function() {
			var message = $(this).attr('title');
			if (message.length == 0 || message === '&nbsp;') {
				var message = 'Sind Sie sicher das Sie das löschen möchten?';
			}
			var diag = window.DialogManager.create('Confirm', {
				'title': 'Bitte bestätigen',
				'content': message,
				'class' : 'error',
				callback: function(dialog, result) {
					if (result == true) {
						document.location.href = url;
					}
				}
			});
		});
	}); // deleteConfirm
	
	// submit button ’...sending’
	$('form').submit(function() {
		$('form input[type=submit]').attr('value', 'sending…').attr('disabled','disabled').addClass('loading');
	});
	
	// automatic form field resizing on typing
	$.getScript($('base').attr('href') + '../static/theme/admin/js/jquery.autogrow.js', function() {
		if($.browser.msie) { // autogrow has problems with padding in textareas in IE and Opera!
			$('textarea').css('padding', '0');
		}
		$('textarea').autogrow();
	});
	
	/** headline replacement as you type **/
	$('form input.headline').keypress(function(e) {
		if (e.which <= 0) return false;
		var val = $(this).val().replace(/<[^> ]+>?/g, '');
		var max = 50;
		if (val.length == 0) {
			val = '&nbsp;';
		}
		$('h1').html(val.substr(0, max) + ((val.length > max) ? '…' : ''));
	});
	
	// textarea 
	$('textarea.text').each(function(elm) {
		$(this).simplePreview({
			buttons: {
				bold: 'bold', italic: 'italic', quote: 'quote', bold: 'bold', url: 'url',
				image: { label: 'image',
					callback: function() {
						window.DialogManager.create('IFrame', {
							title: 'Bild hinzufügen',
							url: $('base').attr('href') + 'files/?layout=blank',
							width: 640,
							height: 500
						});
					}
				}	
			}
		});
	});
	
});
