/**
 * Common Application Controller
 * @author Marcel Eichner // Ephigenia <love@ephigenia.de>
 * @since 2010-10-04
 */
var Controller = new JS.Class({
	
	initialize: function(action)
	{
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
		// immediently call action with arguments passed to constructor
		if (action) {
			this.action.apply(this, arguments);
		}
	},
	
	afterInitialize: function(action)
	{
		return true;
	},
	
	beforeAction: function(action)
	{
		return true;
	},
	
	action: function (action)
	{
		if (this.beforeAction(action)) {
			if (this[action]) {
				this[action].apply(this, Array.prototype.slice.call(arguments, 1));
			}
			this.afterAction(name);
		}
	},
	
	afterAction: function(action)
	{
		return true;
	}
});