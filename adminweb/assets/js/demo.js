$(document).ready(function(){
	//$('#left-panel').addClass('animated bounceInRight');
	$('#project-progress').css('width', '50%');
	$('#msgs-badge').addClass('animated bounceIn');	
	
	$('#my-task-list').popover({
		html:true
	});

	$('body').on('click','.popup-close',function(e){
		e.preventDefault();

		$('.popup').fadeOut(400,function(){
			$(this).remove();
		});
	});

});

var iterate = 1;
var current_menu = null;

$(document).ready(function(){
	$(menu).addClass('active open').find('.arrow').addClass('open');

	/* #################################################################### */
	/* ######################## Live Events Start ######################### */
	/* #################################################################### */

	$('.top-reload').live('click',function(e){
		e.preventDefault();
		var url = window.location.href;
		load_page(url,false);
	});

	// slider start
	function readImage(input) {
		if ( input.files && input.files[0] ) {
			var FR= new FileReader();
			FR.onload = function(e) {
				$('.sliderwrapper').css({
					'background-image' : "url('" + e.target.result + "')"
				});
			};
			FR.readAsDataURL(input.files[0]);
		}
	}

	$(".sliderimage").live('change',function(){
		readImage(this);
	});
	// slider end

	// page type start
	$('.page-type').live('change',function(){
		var type = $(this).val();

		$('.main-form')[0].reset();

		$('#page-guid').val('');
		$('#guid').html('');

		$('.builder-holder').html('');
		$('#form-builder').val('');

		$(this).val(type);

		$('.secondary-pane').each(function(){
			var $this = $(this);
			var hasPane = false;
			
			$(this).find('.item-pane').each(function(){
				if ($(this).hasClass('all') || $(this).hasClass(type)) {
					$(this).css({'display':'block'});
					hasPane = true;
				} else {
					$(this).css({'display':'none'});
				}
			});

			if (hasPane) {
				$('#main-tab').find('a[href="#' + $(this).attr('id') + '"]').closest('li').css({'display':'block'});
			} else {
				$('#main-tab').find('a[href="#' + $(this).attr('id') + '"]').closest('li').css({'display':'none'});
			}
		});
	});
	// page type end

	// page guid checker start
	$('#page-name').live('keyup change',function(){

		var id = $(this).data('id');
		var guid = $(this).val().toLowerCase().trim();

		guid = guid.replace(/[^\w\s]/gi, '');
		guid = guid.replace(/	+/g,'');
		guid = guid.replace(/ +/g,'-');

		$('#page-guid').val(guid);
		$('#guid').html(guid ? '<a href="' + site_url() + guid + '" target="_blank">' + site_url() + guid + '</a>' : '');

		var url = base_url() + 'pages/pages_process/get-page-guid';
		var data = {'guid' : guid, 'id' : id};

		$.ajax({
			type: "POST",
			url: url,
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

				var message = '';

				if ( ! guid) {
					message = 'Page Name Required';
				} else if (data == 'invalid') {
					message = 'Invalid Page Name. Only Letters and Numbers allowed';
				} else if (data != 'null') {
					message = 'Page Name Already Exists';
				}

				$('#page-name').closest('div').find('label.error').html(message);
			}
		});
	});
	// page guid checker end

	// page guid checker start
	$('#get-page-menu').live('keyup blur change',function(){
		var guid = $(this).val().toLowerCase().replace(/ /g,'-');
		var id = $(this).data('id');

		var url = base_url() + 'pages/pages_process/get-page-guid';
		var data = {'guid' : guid, 'id' : id};

		$('#set-page-guid').val(guid);

		$.ajax({
			type: "POST",
			url: url,
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

				var message_menu = '';
				var message_guid = '';

				if ( ! guid) {
					message_menu = 'Page Name Required';
					message_guid = 'Page Url Required';
				} else if (data == 'invalid') {
					message_menu = 'Invalid Page Name. Only Letters and Numbers allowed';
					message_guid = 'Invalid Page Guid. Only Letters and Numbers allowed';
				} else if (data != 'null') {
					message_menu = 'Page Name Already Exists';
					message_guid = 'Page Guid Already Exists';
				}

				console.log(data);

				$('#get-page-menu').next('.error').find('label.error').html(message_menu);
				//$('#set-page-guid').next('.error').find('label.error').html(message_guid);
			}
		});
	});
	// page guid checker end

	// link and tab start
	$('.direct-link').live('click',function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		load_page(url,true);
	});
	$('#main-tab a').live('click',function(e){
		e.preventDefault();
		var $tabContent = $('#main-tab').next('#tab-main');

		$('#main-tab a').closest('li').removeClass('active');
		$(this).closest('li').addClass('active');

		$tabContent.children('.tab-pane').removeClass('active');
		$tabContent.children('.tab-pane' + $(this).attr('href')).addClass('active');
	});

	$('#content-tab a').live('click',function(e){
		e.preventDefault();
		$(this).tab('show');
	});
	
	$('#product-tab a').live('click',function(e){
		e.preventDefault();
		$(this).tab('show');
	});

	$('#side-tab a').live('click',function(e){
		e.preventDefault();
		$(this).tab('show');
	});
	// link and tab end

	// file upload event start
	$('.add-file').live('click',function(){
		iterate++;
		var item = $('.file-upload-wrapper .row-fluid').length;
		if (item < 5) {
			var string = 	'<div class="row-fluid new-upload-item" style="display:none;">' + 
							'	<div class="span6">' +
							'		<input type="file" name="file_upload[]" id="file-upload-' + iterate + '" class="nicefileinput" />' + 
							'		<span class="error"><label for="file-upload-' + iterate + '" class="error"></label></span>' + 
							'	</div>' + 
							'	<div class="span6 delete-wrapper">' +
							'		<input type="text" name="file_name[]" id="file-name-' + iterate + '" class="span12" placeholder="File Name" />' +
							'		<span class="error"><label for="file-name-' + iterate + '" class="error"></label></span>' + 
							'		<div class="remove-file-button"><a class="remove-file" title="remove"><i class="icon-remove"></i></a></div>' + 
							'	</div>' +
							'</div>';

			$('.file-upload-wrapper').append(string);
			$("input[type=file].nicefileinput").nicefileinput();
			$('.new-upload-item').slideDown(400,function(){
				handleSidebarAndContentHeight();
				$(this).removeClass('new-upload-item');
				if (item + 1 >= 5) {
					$('.add-file').addClass('btn-default').removeClass('btn-primary').css({'cursor':'not-allowed'});
				}
			});
		}
	});
	$('.remove-file').live('click',function(){
		$(this).parent().parent().parent().slideUp(400,function(){
			$(this).remove();
			handleSidebarAndContentHeight();
			var item = $('.file-upload-wrapper .row-fluid').length;
			if (item < 5) {
				$('.add-file').addClass('btn-primary').removeClass('btn-default').css({'cursor':'pointer'});
			}
		});
	});
	$('.remove-files').live('click',function(e){
		e.preventDefault();

		if (confirm('Delete File ?')) {
			var $this = $(this);
			var id = $(this).data('id');
			var dir = $(this).data('dir');
			var file = $(this).data('file');

			var url = base_url() + 'pages/pages_process/delete_file/' + id;
			var data = {'id' : id, 'dir' : dir, 'file' : file};

			
			$.ajax({
				type: "POST",
				url: url,
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
					$this.closest('tr')
					.children('td')
					.animate({ 'padding-top': 0, 'padding-bottom': 0 },400)
					.wrapInner('<div />')
					.children()
					.slideUp(400,function() {
						$this.closest('tr').remove();
					});
				}
			});
		}
	});
	// file upload event end

	// other event start
	$('.add-other').live('click',function(){
		iterate++;
		var item = $('.other-wrapper .row-fluid').length;
		if (item < 5) {
			var string = 	'<div class="row-fluid new-item" style="display:none;">' + 
							'	<div class="span4">' +
							'		<input type="text" name="participant_name[]" class="span12" placeholder="Name" />' +
							'	</div>' +
							'	<div class="span4">' +
							'		<select name="participant_type[]" class="span12">' +
							'			<option value="Trainer">Trainer</option>' +
							'			<option value="Participant">Participant</option>' +
							'		</select>' +
							'	</div>' +
							'</div>';

			$('.other-wrapper').append(string);
			$('.new-item').slideDown(400,function(){
				handleSidebarAndContentHeight();
				$(this).removeClass('new-item');
			});
		}
	});
	$('.remove-other').live('click',function(){
		$(this).parent().parent().parent().slideUp(400,function(){
			$(this).remove();
			handleSidebarAndContentHeight();
			var item = $('.other-upload-wrapper .row-fluid').length;
			if (item < 5) {
				$('.add-other').addClass('btn-primary').removeClass('btn-default').css({'cursor':'pointer'});
			}
		});
	});
	// other event end

	// image upload event start
	$('.add-image').live('click',function(){
		iterate++;
		var item = $('.image-upload-wrapper .row-fluid').length;
		if (item < 5) {
			var string = 	'<div class="row-fluid new-upload-item" style="display:none;">' + 
							'	<div class="span4">' +
							'		<input type="file" name="image_upload[]" id="image-upload-' + iterate + '" class="nicefileinput" />' + 
							'		<span class="error"><label for="image-upload-' + iterate + '" class="error"></label></span>' + 
							'	</div>' + 
							'	<div class="span4">' + 
							'		<input type="text" name="image_name[]" id="image-name-' + iterate + '" class="span12" placeholder="Image Caption" />' + 
							'	</div>' + 
							'	<div class="span4 delete-wrapper">' + 
							'		<input type="text" name="image_description[]" id="image-description-' + iterate + '" class="span12" placeholder="Image Description" />' + 
							'		<div class="remove-button-wrapper"><a class="remove-button remove-image" title="remove"><i class="icon-remove"></i></a></div>' + 
							'	</div>' + 
							'</div>';

			$('.image-upload-wrapper').append(string);
			$('.new-upload-item').find("input[type=file].nicefileinput").nicefileinput();
			$('.new-upload-item').find('.elastic').elastic();
			$('.new-upload-item').slideDown(400,function(){
				handleSidebarAndContentHeight();
				$(this).removeClass('new-upload-item');
				if (item + 1 >= 5) {
					$('.add-image').addClass('btn-default').removeClass('btn-primary').css({'cursor':'not-allowed'});
				}
			});
		}
	});
	$('.remove-image').live('click',function(){
		$(this).parent().parent().parent().slideUp(400,function(){
			$(this).remove();
			handleSidebarAndContentHeight();
			var item = $('.image-upload-wrapper .row-fluid').length;
			if (item < 5) {
				$('.add-image').addClass('btn-primary').removeClass('btn-default').css({'cursor':'pointer'});
			}
		});
	});
	$('.remove-images').live('click',function(e){
		e.preventDefault();

		if (confirm('Delete Image ?')) {
			var $this = $(this);
			var id = $(this).data('id');
			var dir = $(this).data('dir');
			var image = $(this).data('img');

			var url = base_url() + 'pages/pages_process/delete_image/' + id;
			var data = {'id' : id, 'dir' : dir, 'image' : image};

			
			$.ajax({
				type: "POST",
				url: url,
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
					$this.closest('.superbox-list').fadeOut(400,function(){
						$(this).remove();
						handleSidebarAndContentHeight();
					});
				}
			});
		}
	});
	// image upload event end

	// image product event start
	$('.add-image-product').live('click',function(){
		iterate++;
		var item = $('.image-product-wrapper .row-fluid').length;
		if (item < 5) {
			var string = 	'<div class="row-fluid new-product-item" style="display:none;">' + 
							'	<div class="span4">' +
							'		<input type="file" name="image_product[]" id="image-product-' + iterate + '" class="nicefileinput" />' + 
							'		<span class="error"><label for="image-product-' + iterate + '" class="error"></label></span>' + 
							'	</div>' +
							'	<div class="span8 delete-wrapper">' + 
							'		<div class="remove-button-wrapper"><a class="remove-button remove-image-product" title="remove"><i class="icon-remove"></i></a></div>' + 
							'	</div>' + 
							'</div>';

			$('.image-product-wrapper').append(string);
			$('.new-product-item').find("input[type=file].nicefileinput").nicefileinput();
			$('.new-product-item').find('.elastic').elastic();
			$('.new-product-item').slideDown(400,function(){
				handleSidebarAndContentHeight();
				$(this).removeClass('new-product-item');
				if (item + 1 >= 5) {
					$('.add-image').addClass('btn-default').removeClass('btn-primary').css({'cursor':'not-allowed'});
				}
			});
		}
	});
	$('.remove-image-product').live('click',function(){
		$(this).parent().parent().parent().slideUp(400,function(){
			$(this).remove();
			handleSidebarAndContentHeight();
			var item = $('.image-product-wrapper .row-fluid').length;
			if (item < 5) {
				$('.add-image').addClass('btn-primary').removeClass('btn-default').css({'cursor':'pointer'});
			}
		});
	});
	$('.remove-images-product').live('click',function(e){
		e.preventDefault();

		if (confirm('Delete Image ?')) {
			var $this = $(this);
			var id = $(this).data('id');
			var dir = $(this).data('dir');
			var image = $(this).data('img');

			var url = base_url() + 'pages/pages_process/delete_image_product/' + id;
			var data = {'id' : id, 'dir' : dir, 'image' : image};

			
			$.ajax({
				type: "POST",
				url: url,
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
					$this.closest('.superbox-list').fadeOut(400,function(){
						$(this).remove();
						handleSidebarAndContentHeight();
					});
				}
			});
		}
	});
	// image product event end

	// help upload event start
	$('.add-help').live('click',function(){
		iterate++;
		var item = $('.page-help-wrapper .row-fluid').length;
		var string = 	'<div class="row-fluid help-item new-help-item relative" style="display:none;">' + 
						'	<div class="row-fluid">' + 
						'		<div class="span12 delete-wrapper">' + 
						'			<input type="text" name="help_title[]" id="help-title-' + iterate + '" class="span12" placeholder="Help Title" />' + 
						'			<div class="remove-button-wrapper"><a class="remove-button remove-help" title="remove"><i class="icon-remove"></i></a></div>' + 
						'		</div>' + 
						'	</div>' + 
						'	<div class="row-fluid">' + 
						'		<div class="span12">' + 
						'			<textarea name="help_body[]" id="help-body-' + iterate + '" placeholder="Help Content" class="mini-text-editor span12" rows="10"></textarea>' + 
						'		</div>' + 
						'	</div>' + 
						'</div>';

		$('.page-help-wrapper').append(string);
		$('.new-help-item').find('.mini-text-editor').redactor({
			convertDivs: false,
			formattingTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4'],
			imageUpload: base_url() + 'uploads/images/upload',
			imageGetJson: base_url() + 'uploads/images/read',
			iframe: true,
			minHeight: 200
		});
		$('.new-help-item').slideDown(400,function(){
			handleSidebarAndContentHeight();
			$(this).removeClass('new-help-item');
		}); 
	});
	$('.remove-help').live('click',function(){
		$(this).closest('.help-item').slideUp(400,function(){
			$(this).remove();
			handleSidebarAndContentHeight();
		});
	});
	$('.remove-helps').live('click',function(e){
		e.preventDefault();

		if (confirm('Delete Help ?')) {
			var $this = $(this);
			var id = $(this).data('id');

			var url = base_url() + 'pages/pages_process/delete_help/' + id;
			var data = {'id' : id};

			
			$.ajax({
				type: "POST",
				url: url,
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
					$this.closest('.help-item').slideUp(400,function(){
						$(this).remove();
						handleSidebarAndContentHeight();
					});
				}
			});
		}
	});
	// help upload event end

	// slider upload event start
	$('.add-slider').live('click',function(){
		iterate++;
		var item = $('.slider-upload-wrapper').children('.row-fluid').length;
		if (item < 5) {
			$('.slider-upload-wrapper').children('.row-fluid.default').clone().removeClass('default').addClass('new-upload-item').css('display','none').appendTo('.slider-upload-wrapper');

			var newFile = 	'<input type="file" name="slider_upload[]" id="slider-upload-' + iterate + '" class="nicefileinput" />' +
							'<span class="error"><label for="slider-upload-1' + iterate + '" class="error"></label></span>' +
							'<div class="remove-slider-button"><a class="remove-slider" title="remove"><i class="icon-remove"></i></a></div>';

			$('.new-upload-item').find('.file-wrapper').html(newFile);
			$('.new-upload-item').find('.input-flag').val('');
			$('.new-upload-item').find("input[type=file].nicefileinput").attr('id','slider-upload-' + iterate).nicefileinput();
			$('.new-upload-item').find('.elastic').elastic();
			$('.new-upload-item').slideDown(400,function(){
				handleSidebarAndContentHeight();
				$(this).removeClass('new-upload-item');
				if (item + 1 >= 5) {
					$('.add-slider').addClass('btn-default').removeClass('btn-primary').css({'cursor':'not-allowed'});
				}
			});
		}
	});
	$('.remove-slider').live('click',function(){
		$(this).parents('.slider-wrapper').slideUp(400,function(){
			$(this).remove();
			handleSidebarAndContentHeight();
			var item = $('.slider-upload-wrapper').children('.row-fluid').length;
			if (item < 5) {
				$('.add-slider').addClass('btn-primary').removeClass('btn-default').css({'cursor':'pointer'});
			}
		});
	});
	$('.remove-sliders').live('click',function(e){
		e.preventDefault();

		if (confirm('Delete Image ?')) {
			var $this = $(this);
			var id = $(this).data('id');
			var image = $(this).data('img');

			var url = base_url() + 'pages/pages_process/delete_image/' + id;
			var data = {'id' : id, 'image' : image};

			
			$.ajax({
				type: "POST",
				url: url,
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
					$this.closest('.slider-wrapper').slideUp(400,function(){
						$(this).remove();
						handleSidebarAndContentHeight();
					});
				}
			});
		}
	});
	// slider upload event end

	// gallery upload event start
	$('.add-gallery').live('click',function(){
		iterate++;
		var item = $('.gallery-upload-wrapper .row-fluid').length;
		if (item < 10) {
			var string = 	'<div class="row-fluid new-upload-item" style="display:none;">' + 
							'	<div class="relative span6">' +
							'		<input type="file" name="image_upload[]" id="image-upload-' + iterate + '" class="nicefileinput" />' + 
							'		<span class="error"><label for="image-upload-' + iterate + '" class="error"></label></span>' + 
							'		<div class="remove-image-button"><a class="remove-gallery" title="remove"><i class="icon-remove"></i></a></div>' + 
							'	</div>' +
							'	<div class="span3">' +
							'		<input type="text" name="image_name[]" id="image-name-' + iterate + '" placeholder="Image Name" />' +
							'	</div>' +
							'	<div class="span3">' +
							'		<textarea name="image_description[]" id="image-description-' + iterate + '" placeholder="Image Description" class="elastic" row="5"></textarea>' +
							'	</div>' +
							'</div>';

			$('.gallery-upload-wrapper').append(string);
			$("input[type=file].nicefileinput").nicefileinput();
			$('.new-upload-item').slideDown(400,function(){
				handleSidebarAndContentHeight();
				$(this).find('.elastic').elastic();
				$(this).removeClass('new-upload-item');
				if (item + 1 >= 10) {
					$('.add-gallery').addClass('btn-default').removeClass('btn-primary').css({'cursor':'not-allowed'});
				}
			});
		}
	});
	$('.remove-gallery').live('click',function(e){
		e.preventDefault();

		if (confirm('Delete Image ?')) {
			var $this = $(this);
			var id = $(this).data('id');
			var image = $(this).data('img');

			var url = base_url() + 'pages/pages_process/delete_gallery/' + id;
			var data = {'id' : id, 'image' : image};

			
			$.ajax({
				type: "POST",
				url: url,
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
					$this.closest('.superbox-list').fadeOut(400,function(){
						$(this).remove();
						handleSidebarAndContentHeight();
					});
				}
			});
		}
	});
	// gallery upload event end

	// category start
	$('.add-category').live('click',function(){
		iterate++;
		var string = 	'<li class="checkbox check-primary">' + 
						'	<input type="checkbox" name="category_new[' + iterate + ']" id="checkbox-new-' + iterate + '" checked="checked" />' + 
						'	<label for="checkbox-new-' + iterate + '"></label><span><input type="text" name="category_name[' + iterate + ']" class="category-new" /></span>' + 
						'	<div class="remove-category-button"><a class="remove-category" title="remove"><i class="icon-remove"></i></a></div>' + 
						'</li>';

		$('.category-wrapper').append(string).find('.category-new').focus();
		$('.category-new').removeClass('category-new');
	});
	$('.edit-category').live('dblclick',function(){
		if (!$(this).children('.category-edit').length) {
			var $this = $(this);
			var name = $(this).html();
			$this.html('<input type="text" class="category-edit" value="' + name + '" />');
			$this.children('.category-edit').focus();

		}
	});
	$('.edit-category .category-edit').live('keypress change blur',function(e){
		var $this = $(this).parent();
		var id = $this.data('id');

		if ((e.type !== 'keypress' && !$(this).attr('readonly')) || (e.type == 'keypress' && e.which == 13)) {
			e.preventDefault();
			var name = $(this).val().trim();
			if (name) {
				var url = base_url() + 'pages/pages_process/edit_category/' + id;
				var data = {'id' : id, 'name' : name};

				$.ajax({
					type: "POST",
					url: url,
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
						$this.html(name);
					},
					complete: function() {
						hide_loader();
					},
					success: function(data){
						console.log(data);
						hide_loader();
						$this.html(name);
					}
				});
			}
		}
	});
	$('.remove-category').live('click',function(){
		if (confirm('Delete Category?')) {
			var $this = $(this);
			if ($(this).data('id')) {
				var url = base_url() + 'pages/pages_process/delete_category/' + $(this).data('id');
				var data = {'id' : $(this).data('id')};
				
				$.ajax({
					type: "POST",
					url: url,
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
						$this.closest('li').fadeOut(400,function(){
							$(this).remove();
						});
					}
				});
			} else {
				$this.closest('li').fadeOut(400,function(){
					$(this).remove();
				});
			}
		}
	});
	// category end

	// spesification start
	$('.add-spesification').live('click',function(){
		iterate++;
		var string = 	'<div class="relative row-fluid new-spesification-item" style="display:none;">' + 
						'	<div class="span4"><input type="text" name="spesification_new[' + iterate + '][name]" placeholder="Name" class="span12" /></div>' + 
						'	<div class="span8"><textarea name="spesification_new[' + iterate + '][description]" placeholder="Description" class="span12 elastic"></textarea></div>' + 
						'	<div class="remove-spesification-button"><a class="remove-spesification" title="remove"><i class="icon-remove"></i></a></div>' +
						'</div>';

		$('#spesification-wrapper').append(string).find('.new-spesification-item').slideDown(400,function(){
			$('.new-spesification-item').removeClass('new-spesification-item');
			$(this).find('input[type="text"]').focus();
			$(this).find('.elastic').elastic();
		});
		//$('.spesification-new').removeClass('spesification-new');
	});
	$('.remove-spesification').live('click',function(){
		$(this).parent().parent().slideUp(400,function(){
			$(this).remove();
			handleSidebarAndContentHeight();
		});
	});
	$('.remove-spesifications').live('click',function(e){
		e.preventDefault();

		if (confirm('Delete spesification ?')) {
			var $this = $(this);
			var id = $(this).data('id');
			var name = $(this).data('name');

			var url = base_url() + 'pages/pages_process/delete_spesification/' + id;
			var data = {'id' : id};

			
			$.ajax({
				type: "POST",
				url: url,
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
					$this.parent().parent().slideUp(400,function(){
						$(this).remove();
						handleSidebarAndContentHeight();
					});
				}
			});
		}
	});
	// spesification end

	// comment start
	$('.update-comment').live('click',function(e){
		e.preventDefault();

		if (! $(this).hasClass('waiting') && confirm($(this).children('span').text() + ' Comment ?')) {
			var $this = $(this);
			var id = $(this).data('id');
			var publish = $(this).data('publish');

			var url = base_url() + 'pages/pages_process/update_comment/' + id;
			var data = {'id' : id, 'publish' : publish};

			$this.addClass('waiting');
			
			$.ajax({
				type: "POST",
				url: url,
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
					$this.removeClass('waiting');
				},
				success: function(data){
					hide_loader();
					$this.removeClass('waiting');

					if (publish == '1') {
						$this.data('publish','0').attr('data-publish','0');
						$this.children('span').text('Unpublish').removeClass('label-success').addClass('label-important');
						$this.closest('td').prev().text('Publish');
					} else {
						$this.data('publish','1').attr('data-publish','1');
						$this.children('span').text('Publish').removeClass('label-important').addClass('label-success');
						$this.closest('td').prev().text('Unpublish');
					}
				}
			});
		}
	});
	// comment end

	// delete table row start
	$('.delete-table-row').live('click',function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		var message = $(this).data('title');
		var $this = $(this);

		if (!confirm(message)) {
			return false;
		}

		$('.alert').remove();

		
		$.ajax({
			type: "POST",
			url: url,
			data: null,
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
				data = jQuery.parseJSON(data);
				if (typeof data.success !== 'undefined' && data.success) {
					$this.closest('tr')
					.children('td')
					.animate({ 'padding-top': 0, 'padding-bottom': 0 },400)
					.wrapInner('<div />')
					.children()
					.slideUp(400,function() {
						$this.closest('tr').remove();
					});
				} else {
					if (typeof data.message !== 'undefined') {
						var notify =	'<div class="alert alert-error semi-bold">' + 
										'	<button class="close" data-dismiss="alert"></button>Failed: &nbsp;' + data.message + 
										'</div>';
						$('.content').find('.page-title').append(notify);
					}
				}
			}
		});
	});
	// delete table row end

	// delete content start
	$('.delete-page').live('click',function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		var message = $(this).data('title');
		var $this = $(this);

		if (!confirm(message)) { return false; }
		$('.alert').remove();
		
		$.ajax({
			type: "POST",
			url: url,
			data: null,
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
				data = jQuery.parseJSON(data);

				if (typeof data.success !== 'undefined' && data.success) {					
					get_menu(true);

					if (typeof data.message !== 'undefined') {
						notify =	'<div class="alert alert-success semi-bold">' + 
									'	<button class="close" data-dismiss="alert"></button>Success: &nbsp;' + data.message + 
									'</div>';
						$('.content').find('.page-title').append(notify);
					}

					$('.content').children(':not(.page-title)').slideUp(400,function(){
						$(this).remove();
						hide_loader();
					});

					window.history.pushState(null, 'Dashboard', base_url());
				}
			}
		});
	});
	// delete content end

	// get feature start
	$('#image-feature').live('change',function(e){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			var image, url;

			reader.onload = function (e) {
				url = e.target.result;
				if (url.indexOf('image') != -1) {
					//image = '<img id="detail-feature-image" class="relative span12" src="' + url + '" />';
					$('#detail-feature-image').attr('src',url).slideDown(400);
				}
			};

			reader.readAsDataURL(this.files[0]);
		} else {
			// clear image on add
			var url = $('#detail-feature-image').data('src');
			if (url) {
				$('#detail-feature-image').attr('src',url).slideDown(400);
			} else {
				$('#detail-feature-image').slideUp(400);
				$('.popover-helper').each(function(){
					var id = $(this).data('id');
					$('#detail-feature-' + id).remove();
					$(this).remove();
				});
			}
		}
	});
	// get feature end

	// set feature start
	$('#detail-feature-add').live('click',function(e){
		var $this = $('#detail-feature-image');
		var $item = $('#detail-feature-item');
		if (!jQuery().draggable) {
			console.log('notify');
			return;
		}
		if ($this.attr('src')) {
			var width 	= $this.width(),
				height 	= $this.height();

			var field 	= 	'<div class="row-fluid" id="detail-feature-' + iterate + '">' + 
								'<div class="span6"><input type="text" name="feature[' + iterate + '][title]" id="feature-title" placeholder="Title" /></div>' + 
								'<div class="span6"><textarea name="feature[' + iterate + '][description]" id="feature-description" placeholder="Description" rows="3"></textarea></div>' + 
								'<input type="hidden" name="feature[' + iterate + '][x]" id="feature-pos-x" value="50" />' + 
								'<input type="hidden" name="feature[' + iterate + '][y]" id="feature-pos-y" value="50" />' + 
							'</div>';

			var helper 	= 	$("<div>")
								.css({
									'left'			: width / 2,
									'top'			: height / 2
								})
								.addClass('popover-helper')
								.attr('id','detail-helper-' + iterate)
								.data('id',iterate)
								.draggable({
									'containment'	: "#detail-feature-wrapper",
									'drag'			: function() {
										var id = $(this).data('id');
										var pos = $(this).position();
										var xPos = pos.left;
										var yPos = pos.top;
										var xImg = $('#detail-feature-image').width();
										var yImg = $('#detail-feature-image').height();

										$('#detail-feature-' + id).find('#feature-pos-x').val(xPos / xImg * 100);
										$('#detail-feature-' + id).find('#feature-pos-y').val(yPos / yImg * 100);
									}
								});

			$this.after(helper);
			$item.append(field);

			iterate++;
		}
	});
	$('.popover-helper').live('click mouseup',function(e){
		var id = $(this).data('id');
		if ($(this).data('x')) {
			$('#old-detail-feature-' + id).find('#old-feature-title').focus();
		} else {
			$('#detail-feature-' + id).find('#feature-title').focus();
		}
	});
	// set feature end

	$('.popover-helper').each(function(){
		var $image = $('#detail-feature-image');
		var width = $image.width();
		var height = $image.height();
		var xPos = $(this).data('x') * width / 100;
		var yPos = $(this).data('y') * height / 100;

		$(this).css({
			'left'			: xPos,
			'top'			: yPos
		});
	});

	/* #################################################################### */
	/* ########################## Live Events End ######################### */
	/* #################################################################### */

	/* #################################################################### */
	/* ########################### Init Function ########################## */
	/* #################################################################### */

	// form builder start
	$('.builder-holder .field-label').live('dblclick',function(){
		if (!$(this).children('input').length) {
			var current_value = $(this).html();
			var input_holder = '<input type="text" class="input-holder" value="' + current_value + '" />';
			$(this).html(input_holder).children('input').focus();
		}
	});
	$('.builder-holder .input-holder').live('keypress change blur',function(e){
  		if ((e.type !== 'keypress' && !$(this).attr('readonly')) || (e.type == 'keypress' && e.which == 13)) {
			e.preventDefault();
			var value = $(this).val();
			if (value) {
				$(this).parent().html(value).parent().removeClass('active');
			}
			generateForm('.builder-holder');
		}
	});
	$('.builder-holder .input-holder').live('keyup',function(e){
		$(this).closest('.row-fluid').find('.field-builder').attr('placeholder',$(this).val());
	});

	/*
	$('.builder-holder .field-builder:not(.old-field)').live('dblclick',function(){
		if ($(this).attr('readonly')) {
			var current_value = $(this).attr('placeholder');
			$(this).val(current_value).removeAttr('readonly').focus();
		}
	});
	$('.builder-holder .field-builder:not(.old-field)').live('keypress change blur',function(e){
  		if ((e.type !== 'keypress' && !$(this).attr('readonly')) || (e.type == 'keypress' && e.which == 13)) {
			e.preventDefault();
			var value = $(this).val();
			if (value) {
				$(this).attr('placeholder',value).val('').attr('readonly','readonly');
			} else {
				$(this).val('').attr('readonly','readonly');
			}
			generateForm('.builder-holder');
		}
	});
	*/

	$('.builder-holder .remove-field').live('click',function(){
		if (confirm('Delete Field?')) {
			$(this).closest('.row-fluid').slideUp(400,function(){
				$(this).remove();
				generateForm('.builder-holder');
			});
		}
	});

	$('.builder-holder > .row-fluid').live('dblclick',function(){
		if ( ! $(this).hasClass('active')) {
			$('.builder-holder > .row-fluid.active').removeClass('active');
			$('.builder-holder').find('.form-setting').remove();

			var type = $(this).children('.field-builder').data('type');
			switch (type) {
				case "COMBO"	: settingCombo(this); break;
				case "RADIO"	: settingRadio(this); break;
				default 		: break;
			}
			$(this).addClass('active');
		}
	});

	$('.cancel-value').live('click',function(){
		$(this).closest('.form-setting').remove();
		$('.builder-holder > .row-fluid').removeClass('active');
	});

	$('.add-value').live('click',function(){
		$(this).closest('.form-setting').find('.value-wrapper').append('<div class="new-value" style="display:none;"><input type="text" value="" placeholder="Value Name" /><div class="remove-value-button"><a class="remove-value" title="remove"><i class="icon-remove"></i></a></div></div>');
		$(this).closest('.form-setting').find('.value-wrapper').children('.new-value').slideDown(400,function(){
			$(this).removeClass('new-value');
		});
	});

	$('.remove-value').live('click',function(){
		$(this).parent().parent().slideUp(400,function(){
			$(this).remove();
		});
	});

	$('.save-value').live('click',function(){
		var items = $(this).closest('.form-setting').find('.value-wrapper > div');
		var target = $(this).closest('.form-setting').data('target');
		var type = $('#' + target).data('type');
		var string = '';

		if (items) {
			items.each(function(){
				var item = $(this).children('input').val();
				switch (type) {
					case "COMBO"	: string += '<option value="' + item + '">' + item + '</option>'; break;
					case "RADIO"	: string += '<label><input type="radio" name="' + target + '" value="' + item + '" />' + item + '</label>'; break;
					default 		: break;
				}
			});
			$('#' + target).html(string);
			$(this).closest('.form-setting').remove();
			$('.builder-holder > .row-fluid').removeClass('active');
			generateForm('.builder-holder');
		}
	});

	$('.field-mandatory input[type="checkbox"], .field-mail input[type="checkbox"]').live('change',function(){
	});

	function settingCombo(element) {
		if ( ! $(element).prev('.form-setting').length ) {
			var option = $(element).children('.field-builder').find('option');
			var target = $(element).children('.field-builder').attr('id');
			var string = '';

			string 		+= '<div class="form-setting" data-target="' + target + '">';
			string 		+= '<span>Combo Box Item</span>';
			string 		+= '<div class="value-wrapper">';

			$(option).each(function(){
				var item = $(this).text();
				string 	+= '<div><input type="text" value="' + item + '" placeholder="Value Name" /><div class="remove-value-button"><a class="remove-value" title="remove"><i class="icon-remove"></i></a></div></div>';
			});

			string 		+= '</div>';
			string 		+= '<div>';
			string 		+= '<button type="button" class="btn btn-success btn-xs btn-mini add-value">Add</button> ';
			string 		+= '<button type="button" class="btn btn-white btn-xs btn-mini pull-right cancel-value">Cancel</button> ';
			string 		+= '<button type="button" class="btn btn-primary btn-xs btn-mini pull-right save-value" style="margin-right:4px;">Save</button> ';
			string 		+= '</div>';
			string 		+= '</div>';
			$(element).append(string);
		}
	}

	function settingRadio(element) {
		if ( ! $(element).prev('.form-setting').length ) {
			var radio = $(element).children('.field-builder').find('label');
			var target = $(element).children('.field-builder').attr('id');
			var string = '';

			string 		+= '<div class="form-setting" data-target="' + target + '">';
			string 		+= '<span>Radio Button Item</span>';
			string 		+= '<div class="value-wrapper">';

			$(radio).each(function(){
				var item = $(this).children('input').val();
				string 	+= '<div><input type="text" value="' + item + '" placeholder="Value Name" /><div class="remove-value-button"><a class="remove-value" title="remove"><i class="icon-remove"></i></a></div></div>';
			});

			string 		+= '</div>';
			string 		+= '<div>';
			string 		+= '<button type="button" class="btn btn-success btn-xs btn-mini add-value">Add</button> ';
			string 		+= '<button type="button" class="btn btn-white btn-xs btn-mini pull-right cancel-value">Cancel</button> ';
			string 		+= '<button type="button" class="btn btn-primary btn-xs btn-mini pull-right save-value" style="margin-right:4px;">Save</button> ';
			string 		+= '</div>';
			string 		+= '</div>';
			$(element).append(string);
		}
	}

	function generateForm(builder) {
		var i = 0, field = null;
		if($(builder).children('.row-fluid').length) {
			field = new Array();
			$(builder).children('.row-fluid').each(function(){
				var value = null;
				var item = new Array();
				var j = 0;

				switch ($(this).find('.field-builder').data('type')) {
					case "COMBO"	: $(this).find('.field-builder').find('option').each(function(){
										item[j] = $(this).text();
										j++;
									});
									value = item;
									break;
					case "RADIO"	: $(this).find('.field-builder').find('label').each(function(){
										item[j] = $(this).children('input').val();
										j++;
									});
									value = item;
									break;
				}

				var label = null;
				var item = {};
				var k = 0;
				$(this).find('.field-label').each(function(){
					item['_' + $(this).data('lang')] = $(this).html();
				});
				label = item;

				field[i] = {
					'name'		: $(this).find('.field-builder').data('name'),
					'type'		: $(this).find('.field-builder').data('type'),
					'size'		: $(this).find('.field-builder').data('size'),
					'label'		: label,
					'mandatory'	: $(this).find('.field-mandatory').find('input[type="checkbox"]').prop('checked'),
					'mail'		: $(this).find('.field-mail').find('input[type="checkbox"]').prop('checked'),
					'value'		: value
				};
				i++;
			});
		}
		console.log(field);
		$('#form-builder').val(JSON.stringify(field));
	}

	$('.button-holder button').live('click',function(){
		var target = $('.builder-holder');
		var type = $(this).data('type');
		var success = false;
		switch(type) {
			case 'label'	 	: success = labelText(target,true); break;
			case 'break'	 	: success = labelText(target,false); break;
			case 'single' 		: success = singleText(target); break;
			case 'paragraph' 	: success = paragraphText(target); break;
			case 'date' 		: success = dateText(target); break;
			case 'email' 		: success = emailText(target); break;
			case 'combo'	 	: success = comboBox(target); break;
			case 'radio'	 	: success = radioButton(target); break;
			default				: break;
		}
		generateForm('.builder-holder');
	});

	$('.builder-holder .mandatory-check, .builder-holder .mail-check').live('change',function(){
		generateForm('.builder-holder');
	});

	function labelText(target, isLabel) {

		iterate++;

		var label = 1;
		var found;
		do {
			found = false;

			if($('#label_' + label).length) {
				found = true;
				label++;
			}

		} while(found);

		try {
			var langId = $('#form-lang').data('id').split(',');
			var langIcon = $('#form-lang').data('icon').split(',');
		} catch(err) {
			var langId = [$('#form-lang').data('id')];
			var langIcon = [$('#form-lang').data('icon')];
		}

		var wrapper = '';
		wrapper += '<div class="row-fluid">';
		if (isLabel) {
			for (var i = 0; i < langId.length; i++) {
				wrapper += '	<div class="flag form-flag '+ langIcon[i] +'"></div><span class="field-label" data-lang="' + langId[i] + '">Label Text</span>';
			}
			wrapper += '	<input type="hidden" class="span12 field-builder" id="label_' + label + '" data-name="label_' + label + '" data-type="LABEL" />';
		} else {
			wrapper += '	<span class="field-break"></span>';
			wrapper += '	<input type="hidden" class="span12 field-builder" id="label_' + label + '" data-name="label_' + label + '" data-type="BREAK" />';
		}
		wrapper += '	<div class="remove-field-button"><a class="remove-field" title="remove"><i class="icon-remove"></i></a></div>';
		wrapper += '</div>';

		label++;

		$(target).append(wrapper);

		return true;
	}
	function singleText(target) {

		iterate++;

		var single = 1;
		var found;
		do {
			found = false;

			if($('#single_' + single).length) {
				found = true;
				single++;
			}

		} while(found);

		try {
			var langId = $('#form-lang').data('id').split(',');
			var langIcon = $('#form-lang').data('icon').split(',');
		} catch(err) {
			var langId = [$('#form-lang').data('id')];
			var langIcon = [$('#form-lang').data('icon')];
		}

		var wrapper = '';
		wrapper += '<div class="row-fluid">';
		for (var i = 0; i < langId.length; i++) {
			wrapper += '	<div class="flag form-flag '+ langIcon[i] +'"></div><span class="field-label" data-lang="' + langId[i] + '">Single Text</span>';
		}
		wrapper += '	<input type="text" class="span5 field-builder" placeholder="Single Text" id="single_' + single + '" data-name="single_' + single + '" data-type="VARCHAR" data-size="200" readonly="readonly" />';
		wrapper += '	<div class="span6 field-mandatory checkbox check-primary">';
		wrapper += '		<input type="checkbox" id="mandatory-single_' + single + '" class="mandatory-check" value="1" />';
		wrapper += '		<label for="mandatory-single_' + single + '">Mandatory</label>';
		wrapper += '	</div>';
		wrapper += '	<div class="remove-field-button"><a class="remove-field" title="remove"><i class="icon-remove"></i></a></div>';
		wrapper += '</div>';

		single++;

		$(target).append(wrapper);

		return true;
	}
	function paragraphText(target) {

		iterate++;

		var paragraph = 1;
		var found;
		do {
			found = false;

			if($('#paragraph_' + paragraph).length) {
				found = true;
				paragraph++;
			}

		} while(found);

		try {
			var langId = $('#form-lang').data('id').split(',');
			var langIcon = $('#form-lang').data('icon').split(',');
		} catch(err) {
			var langId = [$('#form-lang').data('id')];
			var langIcon = [$('#form-lang').data('icon')];
		}

		var wrapper = '';
		wrapper += '<div class="row-fluid">';
		for (var i = 0; i < langId.length; i++) {
			wrapper += '	<div class="flag form-flag '+ langIcon[i] +'"></div><span class="field-label" data-lang="' + langId[i] + '">Paragraph Text</span>';
		}
		wrapper += '	<textarea class="span5 field-builder" placeholder="Paragraph Text" id="paragraph_' + paragraph + '" data-name="paragraph_' + paragraph + '" data-type="TEXT" rows="3" cols="50" readonly="readonly"></textarea>';
		wrapper += '	<div class="span6 field-mandatory checkbox check-primary">';
		wrapper += '		<input type="checkbox" id="mandatory-paragraph_' + paragraph + '" class="mandatory-check" value="1" />';
		wrapper += '		<label for="mandatory-paragraph_' + paragraph + '">Mandatory</label>';
		wrapper += '	</div>';
		wrapper += '	<div class="remove-field-button"><a class="remove-field" title="remove"><i class="icon-remove"></i></a></div>';
		wrapper += '</div>';

		paragraph++;

		$(target).append(wrapper);

		return true;
	}
	function dateText(target) {

		iterate++;

		var date = 1;
		var found;
		do {
			found = false;

			if($('#date_' + date).length) {
				found = true;
				date++;
			}

		} while(found);

		try {
			var langId = $('#form-lang').data('id').split(',');
			var langIcon = $('#form-lang').data('icon').split(',');
		} catch(err) {
			var langId = [$('#form-lang').data('id')];
			var langIcon = [$('#form-lang').data('icon')];
		}

		var wrapper = '';
		wrapper += '<div class="row-fluid">';
		for (var i = 0; i < langId.length; i++) {
			wrapper += '	<div class="flag form-flag '+ langIcon[i] +'"></div><span class="field-label" data-lang="' + langId[i] + '">Date Text</span>';
		}
		wrapper += '	<input type="text" class="span5 field-builder" placeholder="Date Text" id="date_' + date + '" data-name="date_' + date + '" data-type="DATE" readonly="readonly" />';
		wrapper += '	<div class="span6 field-mandatory checkbox check-primary">';
		wrapper += '		<input type="checkbox" id="mandatory-date_' + date + '" class="mandatory-check" value="1" />';
		wrapper += '		<label for="mandatory-date_' + date + '">Mandatory</label>';
		wrapper += '	</div>';
		wrapper += '	<div class="remove-field-button"><a class="remove-field" title="remove"><i class="icon-remove"></i></a></div>';
		wrapper += '</div>';

		date++;

		$(target).append(wrapper);

		return true;
	}
	function emailText(target) {

		iterate++;

		var email = 1;
		var found;
		do {
			found = false;

			if($('#email_' + email).length) {
				found = true;
				email++;
			}

		} while(found);

		try {
			var langId = $('#form-lang').data('id').split(',');
			var langIcon = $('#form-lang').data('icon').split(',');
		} catch(err) {
			var langId = [$('#form-lang').data('id')];
			var langIcon = [$('#form-lang').data('icon')];
		}

		var wrapper = '';
		wrapper += '<div class="row-fluid">';
		for (var i = 0; i < langId.length; i++) {
			wrapper += '	<div class="flag form-flag '+ langIcon[i] +'"></div><span class="field-label" data-lang="' + langId[i] + '">Email Text</span>';
		}
		wrapper += '	<input type="text" class="span5 field-builder" placeholder="Email Text" id="email_' + email + '" data-name="email_' + email + '" data-type="EMAIL" data-size="200" readonly="readonly" />';
		wrapper += '	<div class="span3 field-mandatory checkbox check-primary">';
		wrapper += '		<input type="checkbox" id="mandatory-email_' + email + '" class="mandatory-check" value="1" />';
		wrapper += '		<label for="mandatory-email_' + email + '">Mandatory</label>';
		wrapper += '	</div>';
		wrapper += '	<div class="span3 field-mail checkbox check-primary">';
		wrapper += '		<input type="checkbox" id="mail-email_' + email + '" class="mail-check" value="1" />';
		wrapper += '		<label for="mail-email_' + email + '">Send Email</label>';
		wrapper += '	</div>';
		wrapper += '	<div class="remove-field-button"><a class="remove-field" title="remove"><i class="icon-remove"></i></a></div>';
		wrapper += '</div>';

		email++;

		$(target).append(wrapper);

		return true;
	}
	function comboBox(target) {

		iterate++;

		var combo = 1;
		var found;
		do {
			found = false;

			if($('#combo_' + combo).length) {
				found = true;
				combo++;
			}

		} while(found);

		try {
			var langId = $('#form-lang').data('id').split(',');
			var langIcon = $('#form-lang').data('icon').split(',');
		} catch(err) {
			var langId = [$('#form-lang').data('id')];
			var langIcon = [$('#form-lang').data('icon')];
		}

		var wrapper = '';
		wrapper += '<div class="row-fluid">';
		for (var i = 0; i < langId.length; i++) {
			wrapper += '	<div class="flag form-flag '+ langIcon[i] +'"></div><span class="field-label" data-lang="' + langId[i] + '">Combo Box</span>';
		}
		wrapper += '	<select class="span5 clear field-builder" id="combo_' + combo + '" data-name="combo_' + combo + '" data-type="COMBO" data-size="200" readonly="readonly"><option value="Combo 1">Combo 1</option><option value="Combo 2">Combo 2</option><option value="Combo 3">Combo 3</option></select>';
		wrapper += '	<div class="span6 field-mandatory checkbox check-primary">';
		wrapper += '		<input type="checkbox" id="mandatory-combo_' + combo + '" class="mandatory-check" value="1" />';
		wrapper += '		<label for="mandatory-combo_' + combo + '">Mandatory</label>';
		wrapper += '	</div>';
		wrapper += '	<div class="remove-field-button"><a class="remove-field" title="remove"><i class="icon-remove"></i></a></div>';
		wrapper += '</div>';

		combo++;

		$(target).append(wrapper);

		return true;
	}
	function radioButton(target) {

		iterate++;

		var radio = 1;
		var found;
		do {
			found = false;

			if($('#radio_' + radio).length) {
				found = true;
				radio++;
			}

		} while(found);

		try {
			var langId = $('#form-lang').data('id').split(',');
			var langIcon = $('#form-lang').data('icon').split(',');
		} catch(err) {
			var langId = [$('#form-lang').data('id')];
			var langIcon = [$('#form-lang').data('icon')];
		}

		var wrapper = '';
		wrapper += '<div class="row-fluid">';
		for (var i = 0; i < langId.length; i++) {
			wrapper += '	<div class="flag form-flag '+ langIcon[i] +'"></div><span class="field-label" data-lang="' + langId[i] + '">Radio Button</span>';
		}
		wrapper += '	<fieldset class="span5 clear field-builder" id="radio_' + radio + '" data-name="radio_' + radio + '" data-type="RADIO" data-size="200"><label><input type="radio" name="radio_' + radio + '" value="Radio 1" />Radio 1</label><label><input type="radio" name="radio_' + radio + '" value="Radio 2" />Radio 2</label><label><input type="radio" name="radio_' + radio + '" value="Radio 3" />Radio 3</label></fieldset>';
		wrapper += '	<div class="span6 field-mandatory checkbox check-primary">';
		wrapper += '		<input type="checkbox" id="mandatory-radio_' + radio + '" class="mandatory-check" value="1" />';
		wrapper += '		<label for="mandatory-radio_' + radio + '">Mandatory</label>';
		wrapper += '	</div>';
		wrapper += '	<div class="remove-field-button"><a class="remove-field" title="remove"><i class="icon-remove"></i></a></div>';
		wrapper += '</div>';

		radio++;

		$(target).append(wrapper);

		return true;
	}
	// form builder end

	// preloader start
	function show_loader(progress) {
		$('.pace .pace-progress').width(progress);
		$('.pace').removeClass('pace-inactive');
	}

	function hide_loader() {
		$('.pace').addClass('pace-inactive');
	}
	// preloader end

	// plugins start
	function init_plugins(wrapper) {
		// page type start		
		var $typeSelector = $(wrapper).find('.page-type');

		if ($typeSelector.length) {
			var type = $typeSelector.val();

			$(wrapper).find('.secondary-pane').each(function(){
				var $this = $(this);
				var hasPane = false;
				
				$(this).find('.item-pane').each(function(){
					if ($(this).hasClass('all') || $(this).hasClass(type)) {
						$(this).css({'display':'block'});
						hasPane = true;
					} else {
						$(this).css({'display':'none'});
					}
				});

				if (hasPane) {
					$(wrapper).find('#main-tab').find('a[href="#' + $(this).attr('id') + '"]').closest('li').css({'display':'block'});
				} else {
					$(wrapper).find('#main-tab').find('a[href="#' + $(this).attr('id') + '"]').closest('li').css({'display':'none'});
				}
			});
		}
		// page type end

		// form builder start
		$(wrapper).find('.builder-holder').sortable({
			axis: 'y',
			cursor: 'pointer',
			update: function(event, ui){
				generateForm('.builder-holder');
			}
		});
		// form builder end

		// slider builder start
		if ($(wrapper).find('.slider-items').length) {
			$(wrapper).find('.slider-items').sortable({
				'axis'	: 'y',
				'stop'	: function(event, ui) {
					if ($(event.target).children('div').length) {
						$(event.target).children('div').each(function(){
							var id = $(this).attr('id');
							$(wrapper).find('.slider-container').children('#' + id).appendTo($(wrapper).find('.slider-container'));
						});
					}
				}
			});
		}
		// slider builder end

		// datepicker start
		$(wrapper).find('.datepicker').datepicker({
			format: "dd/mm/yyyy"
		});
		// datepicker end

		// tags start
		$(wrapper).find('.tagsinput').tagsinput();
		// tags end

		// auto numeric start
		$(wrapper).find('.auto').autoNumeric({
			aSep: '.',
			aDec: ',',
			vMin: '0',
			vMax: '1000000000000',
		});
		// auto numeric end

		// datatable start
		var responsiveHelper = undefined;
		var breakpointDefinition = {
			tablet: 1024,
			phone : 480
		};

		$(wrapper).find('#datatable').each(function(){			
			var columnLength = $(this).find('thead tr th').length;
			var tableElement = $(this).dataTable({
				"sDom"				: "<'row-fluid'<'span3 datatable-button'><'span9'lf>r>t<'row-fluid'<'span12'p i>>",
				"oTableTools"		: {
					"aButtons"		: [
						{
							"sExtends":	"collection",
							"sButtonText": "<i class='icon-cloud-download'></i>",
							"aButtons":	[ "csv", "xls", "pdf", "copy"]
						}
					]
				},
				"aoColumnDefs"		: [
					{
						"bSortable"	: false,
						"aTargets"	: [ columnLength - 1 ] }
				],
				"oLanguage"			: {
					"sLengthMenu"	: "_MENU_ ",
					"sInfo"			: "Showing <b>_START_ to _END_</b> of _TOTAL_ entries",
					"sSearch"		: ""
				},
				fnPreDrawCallback	: function () {
					var url,message, buttonClass, icon, string = '';

					$(wrapper).find('#datatable-button').children('.button-item').each(function(){
						url = $(this).data('url');
						message = $(this).data('message');
						buttonClass = $(this).data('class');
						icon = $(this).data('icon');

						string += '<a href="' + url + '" class="'+ buttonClass +'"><i class="'+ icon +'"></i>&nbsp;&nbsp;' + message + '</a>';
						console.log(url);
					});

					if (string) {					
						$(wrapper).find('#datatable_wrapper').find('.datatable-button').html(string);
					}

			
					$(wrapper).find('#datatable_wrapper .dataTables_filter').addClass("pull-right").find('input').addClass("input-medium").attr('placeholder','Search'); // modify table search input
					$(wrapper).find('#datatable_wrapper .dataTables_length').addClass("pull-right").css({'margin-left' : '8px'}); // modify table per page dropdown	
					
					$(wrapper).find('#datatable input').click( function() {
						$(this).parent().parent().parent().toggleClass('row_selected');
					});
				}
			});
		});
		// datatable end

		// form start
		$(wrapper).find('.main-form').ajaxForm({
			dataType: 'json',
			beforeSerialize: function($form, options) {
				console.log($form);
				if ($('#calendar').length) {
					var events = $('#calendar').fullCalendar('clientEvents');
					var activity = new Array();
					for (var i = 0; i < events.length; i++) {
						activity[i] = {'start' : events[i].start, 'end' : events[i].end, 'title' : events[i].title, 'allDay' : events[i].allDay};
					};
					console.log(JSON.stringify(activity));
					$('#calendar-events').val(JSON.stringify(activity));
				}
			},
			beforeSubmit: function(arr, $form, options) {
				$(wrapper).find('#main-tab').find('a').removeClass('error');
				$(wrapper).find('.error label.error').html('');
				$(wrapper).find('.alert').remove();
				show_loader('0%');
			},
			progress: function(jqXHR, progressEvent) {
				if (progressEvent.lengthComputable) {
					show_loader((Math.round(progressEvent.loaded / progressEvent.total * 100)) + "%");
				}
			},
			success: function (response, status, xhr, $form) {
				console.log(response);
				if (typeof response.success !== 'undefined' && response.success) {
					get_menu(true);
					var url = window.location.href;
					var push = false;
					var notify = false;

					if (typeof response.redirect !== 'undefined' && response.redirect) {
						url = response.redirect;
						push = true;
					}

					if (typeof response.message !== 'undefined') {
						if (typeof response.message.success === 'object') {
							notify = new Array();
							var message_length = response.message.success.length;
							for (var i = 0; i < message_length; i++) {
								notify[i] = '<div class="alert alert-success semi-bold">' + 
											'	<button class="close" data-dismiss="alert"></button>Success: &nbsp;' + response.message.success[i] + 
											'</div>';
							}
						}
					}
					load_page(url,push,notify);
				} else {
					hide_loader();
					if (typeof response.message !== 'undefined') {
						if (typeof response.message.notify === 'object') {
							var message_length = response.message.notify.length;
							for (var i = 0; i < message_length; i++) {
								var notify =	'<div class="alert alert-error semi-bold">' + 
												'	<button class="close" data-dismiss="alert"></button>' + response.message.notify[i] + 
												'</div>';
								$('.content').find('.page-title').append(notify);
							}
						}
					}
					if (typeof response.message !== 'undefined') {
						if (typeof response.message.item === 'object') {
							var message_length = response.message.item.length;
							for (var i = 0; i < message_length; i++) {
								$(wrapper).find('#' + response.message.item[i].id).closest('.input-wrapper').find('label.error').html(response.message.item[i].message);
								var tabTarget = $(wrapper).find('#' + response.message.item[i].id).closest('.main-pane').attr('id');
								if (tabTarget) {
									$(wrapper).find('#main-tab').find('a[href="#' + tabTarget + '"]').addClass('error');
								}
							}
						}
					}
				}
			},
			error: function() {
				hide_loader();
				var notify =	'<div class="alert alert-error semi-bold">' + 
								'	<button class="close" data-dismiss="alert"></button>Failed: &nbsp; request failed to be processed' + 
								'</div>';
				$('.content').find('.page-title').append(notify);
			}
		});
		// form end

		// form styling start
		$(wrapper).find("select:not(.field-builder):not(.slider-builder):not(.hide-search)").select2();
		$(wrapper).find("select.hide-search").select2({
			minimumResultsForSearch: -1
		});

		$(wrapper).find("input[type=file].nicefileinput").nicefileinput();

		var d = new Date();
		var n = d.getTime();

		$(wrapper).find('.text-editor').redactor({
			convertDivs: false,
			formattingTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4'],
			imageUpload: base_url() + 'uploads/images/upload',
			imageGetJson: base_url() + 'uploads/images/read',
			iframe: true,
			css: [
					site_url() + 'assets/fonts/roboto/roboto.css?time=' + n,
					site_url() + 'assets/fonts/font-awesome.css?time=' + n,
					site_url() + 'assets/css/style.css?time=' + n,
					site_url() + 'assets/css/custom.css?time=' + n,
				],
			minHeight: 500
		});

		$(wrapper).find('.mini-text-editor').redactor({
			convertDivs: false,
			formattingTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4'],
			imageUpload: base_url() + 'uploads/images/upload',
			imageGetJson: base_url() + 'uploads/images/read',
			iframe: true,
			minHeight: 200
		});
		// form styling end
	}
	// plugins end

	// load page start
	function load_page(url, push, notify) {
		
		$.ajax({
			type: "POST",
			url: url,
			data: null,
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
				get_menu();
				iterate = 1;

				var title = data.match("<title>(.*?)</title>")[1];
				var target = data.match('<meta name="menu" content="(.*?)" />')[1];
				var target_id = data.match('<meta name="id" content="(.*?)" />')[1];
				var filtered = $(data).find('.content');

				$('meta[name="id"]').attr('content',target_id);

				if (target === 'error404') {
					push = false;
					filtered = $('<div class="content"><div class="page-title"><h2><span class="semi-bold">Forbidden</span> Access</h2></div></div>');
				}

				if (notify) {
					var notify_length = notify.length;
					for (var i = 0; i < notify_length; i++) {
						$(filtered).find('.page-title').append(notify[i]);
					}
				}

				/* ##### Reload Plugins ##### */
				init_plugins(filtered);
				/* ##### End Plugins ##### */

				var newEvent = 1;

				$('.page-content').html(filtered).animate({'opacity' : 1},0,function(){
					handleSidebarAndContentHeight();

					// auto complete start
					$('.autocomplete').each(function(){
						var $this = $(this);
						$this.autocomplete({
							type: 'POST',
							dataType: 'json',
							paramName: 'keyword',
							serviceUrl: $this.attr('data-src'),
							minChars: 2
						});
					});
					// auto complete end

					// slider start
					if ($('.sliderwrapper').length) {
						var startwidth = $('#container-start-width').val();
						var startheight = $('#container-start-height').val();
						var width = $('.sliderwrapper').width();
						var height = startheight / startwidth * width;
						var scale = width / startwidth;

						$('.sliderwrapper').css({
							'width' : width,
							'height' : height
						}).data('scale',scale);

						$('#container-width').val(width);
						$('#container-height').val(height);
						$('#container-scale').val(scale);

						$('.slider-container').trigger('init');
					}
					// slider end

					// calendar start
					$('#activity-add').live('keypress',function(e){
						var code = e.keyCode || e.which;
						var value = $(this).val();
						if(code == 13) {
							e.preventDefault();
							if (value) {
								$(this).val('');
								$('#activity').append('<span class="fc-item-new">' + value + '</span>');
								$this = $('#activity span.fc-item-new:last');

								var eventObject = {
									title: $.trim($this.text())
								};

								$this.data('eventObject', eventObject);

								$this.draggable({
									zIndex: 999,
									revert: true,
									revertDuration: 0
								});
								
							}
						}
					});

					var date = new Date();
					var d = date.getDate();
					var m = date.getMonth();
					var y = date.getFullYear();
					
					$('#calendar').fullCalendar({
						header: {
							left: 'prev,next today',
							center: 'title',
							right: 'month,agendaWeek,agendaDay'
						},
						timeFormat: 'H(:mm)',
						editable: true,
						droppable: true,
						dragRevertDuration: 0,
						drop: function(date, allDay) {
							var originalEventObject = $(this).data('eventObject');
							var copiedEventObject = $.extend({}, originalEventObject);

							copiedEventObject.id = 'event-new-' + newEvent;
							copiedEventObject.start = date;
							copiedEventObject.allDay = allDay;

							console.log(copiedEventObject);

							$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

							$(this).remove();

							newEvent++;
							
						},
						events: function(start, end, callback) {
							var url = $('#calendar').data('events');
							if (url) {
								$.ajax({
									url: url,
									dataType: 'json',
									success: function(data) {
										var events = [];
										for (var i = 0; i < data.length; i++) {
											events.push({
												id: 'event-old-' + i,
												start: data[i].start,
												end: data[i].end,
												title: data[i].title,
												allDay: data[i].allDay
											});
										}
										
										callback(events);
									}
								});
							}
						},
						eventMouseover: function (event, jsEvent) {
							$(this).mousemove(function (e) {
								var trashEl = $('#calendarTrash');
								if (isElemOverDiv()) {
									if (!trashEl.hasClass("fc-state-hover")) {
										trashEl.addClass("fc-state-hover");
									}
								} else {
									if (trashEl.hasClass("fc-state-hover")) {
										trashEl.removeClass("fc-state-hover");
									}
								}
							});
						},
						eventDragStop: function (event, jsEvent, ui, view) {
							console.log(event);
							if (isElemOverDiv()) {
								var deleteEvent = confirm('Delete Event ' + event.title + ' ?');
								if (deleteEvent) {
									$('#calendar').fullCalendar('removeEvents', event.id);
								}

								var trashEl = $('#calendarTrash');
								if (trashEl.hasClass("fc-state-hover")) {
									trashEl.removeClass("fc-state-hover");
								}
							}
						}

					});
					
					$('#calendar').find('.fc-header-left').prepend('<span class="fc-header-space"></span>');
					$('#calendar').find('.fc-header-left').prepend('<div class="fc-button fc-state-default fc-corner-left fc-corner-right" id="calendarTrash"><i class="icon-trash"></i></div>');
					
					//actually cursor position
					var currentMousePos = {
						x: -1,
						y: -1
					};

					$(document).on("mousemove", function (event) {
						currentMousePos.x = event.pageX;
						currentMousePos.y = event.pageY;
					});
					
					//check if cursor is in trash 
					var isElemOverDiv = function() {
						var trashEl = $('#calendarTrash');

						var trashOff = trashEl.offset();

						var x1 = trashOff.left;
						var x2 = trashOff.left + trashEl.outerWidth(true);
						var y1 = trashOff.top;
						var y2 = trashOff.top + trashEl.outerHeight(true);

						if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
							currentMousePos.y >= y1 && currentMousePos.y <= y2) {
							return true;
						}
						return false;
					}

					//listens for drop event
					/*
					$("#calendarTrash").droppable({
						tolerance: 'pointer',
						drop: function(event, ui) {
							console.log(ui);
							if (ui.helper && ui.helper[0]) {
								//var event = ui.helper;
								var answer = confirm('Delete Event ?');
								if (answer) {
									//calendar.fullCalendar('removeEvents', event.id);
								}
							}
						}
					});
					*/
					// calendar end

					// column seperation start
					$('.column-seperation').each(function(){
						var minHeight = 0;
						$(this).children('[class*="span"]').each(function(){
							var height = 0;
							$(this).children('.row-fluid').each(function(){
								height += $(this).height();
							});
							minHeight = minHeight < height ? height : minHeight;
						});
						$(this).children('[class*="span"]').css('min-height',minHeight);
					});
					// column seperation end

					// superbox start
					if ($('.superbox').length) {
						$('.superbox').SuperBox();
					}
					// superbox end

					// elastic start
					$('.elastic').each(function(){
						$(this).elastic();
					});
					// elastic end

					// ios slide start
					var elems = Array.prototype.slice.call(document.querySelectorAll('.ios'));
					elems.forEach(function(checkbox){
						var	Switch = require('ios7-switch'),
							mySwitch = new Switch(checkbox);

						if ($(checkbox).prop('checked')) {
							mySwitch.toggle();
						}

						mySwitch.el.addEventListener('click', function(e){
							e.preventDefault();
							mySwitch.toggle();
						}, false);
					});
					// ios slide end
					
					// draggable start
					$('.popover-helper').each(function(){
						var $image = $('#detail-feature-image');
						var width = $image.width();
						var height = $image.height();
						var xPos = $(this).data('x') * width / 100;
						var yPos = $(this).data('y') * height / 100;

						$(this).css({
							'left'			: xPos,
							'top'			: yPos
						})
						.draggable({
							'containment'	: "#detail-feature-wrapper",
							'drag'			: function() {
								var id = $(this).data('id');
								var pos = $(this).position();
								var xPos = pos.left;
								var yPos = pos.top;
								var xImg = $('#detail-feature-image').width();
								var yImg = $('#detail-feature-image').height();

								$('#old-detail-feature-' + id).find('#old-feature-pos-x').val(xPos / xImg * 100);
								$('#old-detail-feature-' + id).find('#old-feature-pos-y').val(yPos / yImg * 100);
							}
						});
					});
					// draggable end
					$("html, body").animate({ scrollTop: 0 },400,function(){
					});
				});

				if (target) {
					$('.page-sidebar').find('.active').removeClass('active');
					$('.page-sidebar').find('.open').removeClass('open');
					$('.' + target).addClass('active open').find('.arrow').addClass('open');
					$('.page-sidebar').find('li:not(.active) .sub-menu').slideUp(400);
				}

				if (push) {
					window.history.pushState(null, title, url);
				}
			}
		});
	}
	// load page end

	function get_menu(edit) {
		var	i 		= 0,
			url 	= base_url() + 'pages/pages_process/get-page-menu',
			data 	= null;
		
		$.ajax({
			type 		: "POST",
			url 		: url,
			data 		: data,
			dataType 	: 'json',
			beforeSend 	: function() {
				show_loader('0%');
			},
			progress 	: function(jqXHR, progressEvent) {
				if (progressEvent.lengthComputable) {
					show_loader((Math.round(progressEvent.loaded / progressEvent.total * 100)) + "%");
				} else {
					show_loader('100%');
				}
			},
			error 		: function() {
				hide_loader();
			},
			complete 	: function() {
				hide_loader();
			},
			success 	: function(data){
				if (typeof data.menu === 'object') {
					var main_menu = create_menu(data.menu, 'main');
					var top_menu = create_menu(data.menu, 'top');

					$('#nestable-main').data({
						mode 	: 'sidebar',
						type 	: 'main'
					}).html(main_menu).children('ol').addClass('dd-list dark');

					$('#nestable-top').data({
						mode 	: 'sidebar',
						type 	: 'top'
					}).html(top_menu).children('ol').addClass('dd-list dark');

					if ( ! $('#nestable-main').data('nestable')) {
						$('#nestable-main').nestable({
							group 			: 1,
							rootClass 		: 'dd-1',
							listClass 		: 'dd-list dark',
							draggable 		: is_super
						})
						.on('change', updateOutput);
					} else {
						$('#nestable-main').nestable('rebuild');
					}
					$('#nestable-main').nestable('collapseAll');
					set_current_menu($('#nestable-main').children('ol'));

					if ( ! $('#nestable-top').data('nestable')) {
						$('#nestable-top').nestable({
							group 			: 1,
							rootClass 		: 'dd-1',
							listClass 		: 'dd-list',
							draggable 		: is_super
						})
						.on('change', updateOutput);
					} else {
						$('#nestable-top').nestable('rebuild');
					}
					$('#nestable-top').nestable('collapseAll');
					set_current_menu($('#nestable-top').children('ol'));

					if ($('#dashboard-nestable').length) {

						$('#dashboard-nestable-main').data({
							mode 	: 'dashboard',
							type 	: 'main'
						}).html(main_menu).children('ol').addClass('dd-list dark');

						$('#dashboard-nestable-top').data({
							mode 	: 'dashboard',
							type 	: 'top'
						}).html(top_menu).children('ol').addClass('dd-list dark');

						if ( ! $('#dashboard-nestable-main').data('nestable')) {
							$('#dashboard-nestable-main').nestable({
								group 			: 2,
								rootClass 		: 'dd-2',
								listClass 		: 'dd-list dark',
								draggable 		: is_super
							})
							.on('change', updateOutput);
						} else {
							$('#dashboard-nestable-main').nestable('rebuild');
						}
						$('#dashboard-nestable-main').nestable('collapseAll');

						if ( ! $('#dashboard-nestable-top').data('nestable')) {
							$('#dashboard-nestable-top').nestable({
								group 			: 2,
								rootClass 		: 'dd-2',
								listClass 		: 'dd-list dark',
								draggable 		: is_super
							})
							.on('change', updateOutput);
						} else {
							$('#dashboard-nestable-top').nestable('rebuild');
						}
						$('#dashboard-nestable-top').nestable('collapseAll');
					}
				}

				$('a.edit-page').tooltip();
				handleSidebarAndContentHeight();
			}
		});
	}

	function set_current_menu(wrapper) {
		var li = wrapper.find('li.dd-item.expand');
		if (li.length) {
			while (li.length) {
				if (li.children('ol').length) {
					li.removeClass('dd-collapsed');
					li.children('[data-action="expand"]').hide();
					li.children('[data-action="collapse"]').show();
					li.children('ol').show();
				}

				li = li.parent('ol').parent('li.dd-item');
			}

			handleSidebarAndContentHeight();
		}
	}

	function create_menu(data, type) {
		var length = data.length;
		var anchor, handle, bgHandle;

		var id = $('meta[name="id"]').attr('content');
		var menu = '<ol>';

		for (var i = 0; i < length; i++) {

			if (data[i].menu_type == type) {
				if (data[i].active) {
					anchor = '<a href="' + base_url() + 'pages/pages/edit/' + data[i].page_id + '" class="edit-page direct-link" data-placement="right" title="Edit Page"></a>';
				} else {
					anchor = '';
				}

				switch(data[i].type.toLowerCase()) {
					case 'home'			: handle = '<div class="dd-handle dd-home">'				+ data[i].name + '</div>' + anchor; break;
					case 'parent'		: handle = '<div class="dd-handle dd-parent">'				+ data[i].name + '</div>' + anchor; break;
					case 'static'		: handle = '<div class="dd-handle dd-static">'				+ data[i].name + '</div>' + anchor; break;
					case 'division'		: handle = '<div class="dd-handle dd-division">'			+ data[i].name + '</div>' + anchor; break;
					case 'form'			: handle = '<div class="dd-handle dd-form">'				+ data[i].name + '</div>' + anchor; break;
					case 'product'		: handle = '<div class="dd-handle dd-product">'				+ data[i].name + '</div>' + anchor; break;
					case 'product-item'	: handle = '<div class="dd-handle dd-product-item">'		+ data[i].name + '</div>' + anchor; break;
					case 'event'		: handle = '<div class="dd-handle dd-event">'				+ data[i].name + '</div>' + anchor; break;
					case 'article'		: handle = '<div class="dd-handle dd-article">'				+ data[i].name + '</div>' + anchor; break;
					case 'gallery'		: handle = '<div class="dd-handle dd-gallery">'				+ data[i].name + '</div>' + anchor; break;
					case 'nearby'		: handle = '<div class="dd-handle dd-nearby">'				+ data[i].name + '</div>' + anchor; break;
					default				: handle = '<div class="dd-handle">'						+ data[i].name + '</div>'; break;
				}
				
				var publish = data[i].publish != 0 ? '' : ' dd-red';
				var expand = id == data[i].page_id ? ' dd-current expand' : '';

				menu += '<li class="dd-item' + expand + publish + '" data-id="' + data[i].page_id + '">' + handle;

				if (typeof data[i].children === 'object') {

					menu += create_menu(data[i].children, type);
				}

				menu += '</li>';
			}
		}

		menu += '</ol>';

		return $(menu).children().length ? menu : '';
	}

	/* #################################################################### */
	/* ########################### End Function ########################### */
	/* #################################################################### */

	var url = window.location.href;
	load_page(url,false);
	
	init_plugins('body');

	//get_menu();

	$(window).bind('popstate',function(e){
		e.preventDefault();
		var url = window.location.href;
		load_page(url,false);
	});

	$(window).bind('resize', function(e){
		e.preventDefault();
		handleSidebarAndContentHeight();
	});

	var menuItem = {
		'main' 	: null,
		'top' 	: null
	};

	var handleSidebarAndContentHeight = function () {
		var content_height,
			content = $('.page-content'),
			sidebar = $('.page-sidebar'),
			footer = $('.footer-widget');

		content.attr("data-height", content.find('.content').height() + 26);

		if ((sidebar.height() + footer.height() + 22) >= content.find('.content').height() + 26) {
			content_height = sidebar.height() + footer.height() + 22;
		} else {
			content_height = content.find('.content').height() + 26 + 50;
		}
		content_height = content_height < ($(window).height() - 58) ? ($(window).height() - 58) : content_height;
		content.css({'min-height' : content_height });
	}
	
	var updateOutput = function(e)
	{
		var list  	= e.length ? e : $(e.target),
			url 	= base_url() + 'pages/pages_process/set-page-menu',
			type 	= list.data('type'),
			item	= list.nestable('serialize');

		if (is_super && menuItem[type] != JSON.stringify(item)) {

			menuItem[type] = JSON.stringify(item);

			show_loader('0%');

			$.ajax({
				type: "POST",
				url: url,
				data: {type : type, data : item},
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
				}
			});
		}
	};
});