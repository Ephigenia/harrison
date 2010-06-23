/**
 * Javascripts for Harrison Admin
 * @project Harrison
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
$(document).ready(function() {
	
	/** toggle value **/
	$.getScript($('base').attr('href') + '../static/js/jquery.plugin.toggleValue.js', function() {
		if (jQuery().toggleValue) $('input.q').toggleValue();
	});
	
	/** jQuery UI **/
	if (jQuery().autocomplete) $('#AdminSearchForm input.q').autocomplete({
		minLength: 3,
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: $('#AdminSearchForm').attr('action') + '/search/' + request.term,
				dataType: 'json',
				success: function(data) {
					response(data);
				}
			});
		},
		select: function(event, ui) {
			document.location.href = ui.item.value;
		}
	});
	
	/* auto-grow **/
	$.getScript($('base').attr('href') + '../static/theme/admin/js/jquery.autogrow.js', function() {
		if ($.browser.msie) { // autogrow has problems with padding in textareas in IE and Opera!
			$('textarea').css('padding', '0');
		}
		if (jQuery().autogrow) $('textarea').autogrow();
	});
	
	/**
	 * Main menu
	 */
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
	
	// submit button ’...sending’
	$('form').submit(function() {
		$('form input[type=submit]').attr('value', 'sending…').attr('disabled','disabled').addClass('loading');
	});
	
	// uri replace non-ascii chars
	$('input.uri').keyup(function() {
		$(this).val($(this).val().replace(/[^a-zA-Z0-9_,.-]+/g, ''));
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
