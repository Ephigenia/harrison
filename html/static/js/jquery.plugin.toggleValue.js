/**
 * Simple Plugin for toggling input fields
 *
 * Usage:
 *		$('input.searchTerm').toggleValue();
 *
 * Example Usage with custom class:
 *		$('input.searchTerm').toggleValue({toggleClass: 'selected'});
 *	
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2009-06-22
 */
(function($){
	
	$.fn.extend({
		toggleValue: function (options) {
			defaults = {
				value: $(this).val(),
				toggleClass: 'active'
			};
			var options = $.extend({}, defaults, options);
			return this.each(function() {
				$(this).focus(function() {
					if ($(this).val() == options.value) $(this).val('').toggleClass(options.toggleClass);
				}).blur(function () {
					if ($.trim($(this).val()) == '') $(this).val(options.value).toggleClass(options.toggleClass);
				});
			});
		}
	});

})(jQuery);
