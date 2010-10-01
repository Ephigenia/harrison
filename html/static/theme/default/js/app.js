/**
 * Example Application JS-File
 * @theme default
 * @project Harrison
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
$(document).ready(function() {
	
	$('body').removeClass('no-js');
	
	/** toggle value **/
	$('input[placeholder]').each(function(index, elm) {
		$(elm).bind('focus.placeholder', function() {
			if ($(this).val() == $(this).attr('placeholder')) $(this).val('');
		}).bind('blur.placeholder', function() {
			if ($(this).val() == '') $(this).val($(this).attr('placeholder'));
		});
		$(elm).trigger('blur.placeholder');
	});
	
});