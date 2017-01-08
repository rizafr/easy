/*
	SuperBox v1.0.0
	by Todd Motto: http://www.toddmotto.com
	Latest version: https://github.com/toddmotto/superbox
	
	Copyright 2013 Todd Motto
	Licensed under the MIT license
	http://www.opensource.org/licenses/mit-license.php

	SuperBox, the lightbox reimagined. Fully responsive HTML5 image galleries.
*/
;(function($) {
		
	$.fn.SuperBox = function(options) {
		
		function update_image (element, superboxid, superboxurl) {
			if (superboxid && superboxurl) {
				var img_caption = element.find('.superbox-input#img-caption').val();
				var img_desc = element.find('.superbox-input#img-desc').val();
				var data = {'id' : superboxid, 'caption' : img_caption, 'desc' : img_desc};

				$.ajax({
					type: "POST",
					url: superboxurl,
					data: data,
					beforeSend: function() {
						show_loader('0%');
					},
					progress: function(jqXHR, progressEvent) {
						if (progressEvent.lengthComputable) {
							show_loader((Math.round(progressEvent.loaded / progressEvent.total * 100)) + "%");
						} else {
							show_loader('100%');
						}
					},
					error: function() {
						hide_loader();
					},
					complete: function() {
						hide_loader();
					},
					success: function(data){
						hide_loader();
						console.log(data);
						element.find('.superbox-list .superbox-img.active').data('caption', img_caption);
						element.find('.superbox-list .superbox-img.active').data('desc', img_desc);
					}
				});
			}
		}

		function show_loader(progress) {
			$('.pace .pace-progress').width(progress);
			$('.pace').removeClass('pace-inactive');
		}

		function hide_loader() {
			$('.pace').addClass('pace-inactive');
		}

		return this.each(function() {

			var _this = $(this);

			var superbox 		= $('<div class="superbox-show"></div>');
			var superboximg 	= $('<img src="" class="superbox-current-img">');
			var superboxcap		= $('<input type="text" class="superbox-input" name="img_caption" id="img-caption" placeholder="Image Caption">');
			var superboxdesc	= $('<textarea class="superbox-input" name="img_desc" id="img-desc" placeholder="Image Description" rows="3"></textarea>');
			var superboxrow		= $('<div class="row-fluid"></div>');
			var superboxclose 	= $('<div class="superbox-close"></div>');

			if (_this.hasClass('superbox-default')) {
				superbox.append(superboximg).append(superboxclose);
			} else {
				superbox.append(superboximg).append(superboxcap).append(superboxdesc).append(superboxclose);
			}
			superbox.find('.superbox-input').wrap(superboxrow);

			var superboxid = null;
			var superboxurl = null;

			superboxcap.on('change',function(e){
				e.preventDefault();
				update_image(_this, superboxid, superboxurl);
			});
			
			superboxdesc.on('change',function(e){
				e.preventDefault();
				update_image(_this, superboxid, superboxurl);
			});

			_this.find('.superbox-list img').click(function() {

				console.log(superbox);
		
				var currentimg = $(this).parent().find('.superbox-img');
				var imgData = currentimg.data('img');
				var imgCaption = currentimg.data('caption');
				var imgDesc = currentimg.data('desc');

				superboxid = currentimg.data('id');
				superboxurl = currentimg.data('url');

				_this.find('.superbox-list .superbox-img.active').removeClass('active');
				currentimg.addClass('active');

				superboximg.attr('src', imgData).css('max-height', $(window).height() - currentimg.width() - 135);
				superboxcap.val(imgCaption);
				superboxdesc.val(imgDesc);
				
				if ($(this).parent().next().hasClass('superbox-show')) {
					superbox.toggle();
				} else {
					superbox.insertAfter($(this).parent()).css('display', 'block');
				}

				_this.find('.superbox-current-img').css({opacity: 0}).animate({opacity: 1},400,function(){
					var width = superboximg.width() < 250 ? 250 : superboximg.width();
					superbox.find('.superbox-input').animate({'width': width},400);
				});
				
				$('html, body').animate({
					scrollTop:superbox.position().top - currentimg.width()
				}, 'medium');
			
			});
						
			_this.on('click', '.superbox-close', function() {
				_this.find('.superbox-current-img').animate({opacity: 0}, 200, function() {
					_this.find('.superbox-show').slideUp();
				});
			});
			
		});
	};
})(jQuery);