/**
 *	Simple and easy tab integration
 *	@author Marcel Eichner // Ephigenia <love@ephigenia.de>
 */
$(document).ready(function() {

	$('.tabs ul li a').attr('href', 'javascript:void(0)');
	$('.tabs ul li a:eq(0)').addClass('selected');
	$('.tabs .tab:gt(0)').hide();
	
	$('.tabs ul li a').click(function() {
		$(this).parents('.tabs').find('ul li a').removeClass('selected');
		$(this).parents('.tabs').find('.tab').hide();
		if ($(this).hasClass('all')) {
			var tabCount = $(this).parents('.tabs').find('.tab').length;
			var widthPercentage = 96 / tabCount;
			$(this).parents('.tabs').find('ul li a.all').addClass('selected');
			$(this).parents('.tabs').find('.tab').fadeIn().css(
				{ width: widthPercentage + '%', float: 'left', marginRight : '1em' }
			);
		} else {
			var tabName = $(this).attr('class').substr(0,2);
			$(this).parents('.tabs').find('div.' + tabName).css({ width: '99%'}).fadeIn();
			$(this).parents('.tabs').find('ul li a.' + tabName).addClass('selected');
		}
	});
	

});
