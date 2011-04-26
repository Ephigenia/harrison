$(document).ready(function() {
	
	var libs = [
		'http://connect.facebook.net/de_DE/all.js#xfbml=1',
		'http://platform.twitter.com/widgets.js'
	];
	for(var i = 0; i < libs.length; i++) {
		(function() {
		    var s = document.createElement('script');
		    s.type = 'text/javascript';
		    s.async = true;
		    s.src = libs[i];
		    var x = document.getElementsByTagName('script')[0];
		    x.parentNode.insertBefore(s, x);
		})();
	}
	
});