/*
jQuery.NiceFileInput.js
--------------------------------------
Nice File Input - jQuery plugin which makes file inputs CSS styling an easy task.
By Jorge Moreno - @alterebro 

Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
Based on previous work of:
	- Shaun Inman (concept) http://www.shauninman.com/archive/2007/09/10/styling_file_inputs_with_css_and_the_dom
	- Mika Tuupola (jQuery plugin implementation) http://www.appelsiini.net/projects/filestyle
*/
(function($) {
	$.fn.nicefileinput = function(options) {
		var settings = { 
			label : 'Browse', // Default button text
			fullPath: false
		};
		if(options) { $.extend(settings, options); };
		
		return this.each(function() {
			var self = this;
			
			if ($(self).attr('data-styled') === undefined) {

				var r = Math.round(Math.random()*10000);
				var d = new Date();
				var guid = d.getTime()+r.toString();
				
				var filename = $('<input type="text" disabled="disabled">')
					.css({})
					.addClass('filename-wrapper');
				var wrapper = $("<div>")
					.css({})
					.addClass('fileinput-wrapper')
					.html(settings.label);
				
				
				$(self).after(filename);
				$(self).wrap(wrapper);
				
				$(self)
					.css({})
					.addClass('fileinput-item');
				$(self).on("change", function() {
					var fullPath = $(self).val();
					if (settings.fullPath) {
						filename.val(fullPath); 
					} else {
						var pathArray = fullPath.split(/[/\\]/);
						filename.val(pathArray[pathArray.length - 1]);
					}
				});
				$(self).attr('data-styled', true);

			}
		});
	
	};
})(jQuery);
