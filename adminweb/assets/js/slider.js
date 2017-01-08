$(document).ready(function(){

	var xPos = 0;
	var yPos = 0;
	var layerClick = false;
	var layerTarget = null;
	
	$("#chvidbutt").live('change',function(){
		ch = $(this).val();
		if(ch == 1) {
			var item = '<div id="butname" class="span4">' +
			   '<h5 class="semi-bold">Button Name</h5>' +
			   '<div class="row-fluid">' +
			   '<div class="span12 input-wrapper">' +
			   '<input type="text" name="button_name" placeholder="Button Label" class="span12" />' +
			   '<span class="error"><label for="button" class="error"></label></span>' +
			   '</div></div></div>'; 
			$("#getbutt").append(item);
		}	
		else { $('#butname').remove();}
	});

	$('.slider-container > .slider-layer').live('mousedown',function(e){
		layerClick = true;
		layerTarget = $(this);

		$('.slider-container > .slider-layer.active').removeClass('active');
		layerTarget.addClass('active');

		$('.slider-items > div.active').removeClass('active');
		$('.slider-items').children('#' + layerTarget.attr('id')).addClass('active');
	});

	$('.slider-container > .slider-layer').live('mouseup',function(e){
		layerClick = false;
		layerTarget = null;
	});

	$('body').live('mousemove',function(e){
		if (layerClick && layerTarget.length) {
			e.preventDefault();
			var pos = layerTarget.position();
			var itemTarget = $('.slider-items').children('#' + layerTarget.attr('id'));

			itemTarget.find('.x-axis').val(pos.left);
			itemTarget.find('.y-axis').val(pos.top);
		}
	});

	$('.slider-items > div').live('mousedown',function(e){
		$('.slider-container > .slider-layer.active').removeClass('active');
		$('.slider-container > .slider-layer#' + $(this).attr('id')).addClass('active');

		$('.slider-items > div.active').removeClass('active');
		$(this).addClass('active');
	});

	$('.slider-text:not(.editing)').live('dblclick',function(e){
		var width = $(this).width();
		var height = $(this).height();

		$(this).addClass('editing').css({
				'width'	: width,
				'height': 'auto'
			}).children('span').html('<textarea>' + $(this).text() + '</textarea>').children('textarea').css({
				'width'	: width,
				'height': 'auto'
			}).autosize().focus();
	});

	$('.slider-text.editing span textarea').live('keyup',function(e){
		var layer = $(this).closest('.slider-text');
		var id = layer.attr('id');

		$('.slider-items').children('#' + id).find('.slider-title').text($(this).val());
		$('.slider-items').children('#' + id).find('.slider-item').val($(this).val());
	});

	$('.slider-text.editing span textarea').live('keypress',function(e){
		var layer = $(this).closest('.slider-text');

		if(e.which == 13) {
			e.preventDefault();
			var id = layer.attr('id');

			var width = $(this).width();
			var height = $(this).height();

			layer.removeClass('editing').css({
				'width'	: width,
				'height': 'auto'
			}).children('span').html($(this).val());

			$('.slider-items').children('#' + id).find('.slider-width').val(layer.width());
			$('.slider-items').children('#' + id).find('.slider-height').val(layer.height());
		}
	});

	$('.slider-text.editing span textarea').live('blur',function(e){
		var layer = $(this).closest('.slider-text');
		var id = layer.attr('id');

		var width = $(this).width();
		var height = $(this).height();

		layer.removeClass('editing').css({
			'width'	: width,
			'height': 'auto'
		}).children('span').html($(this).val());

		$('.slider-items').children('#' + id).find('.slider-width').val(layer.width());
		$('.slider-items').children('#' + id).find('.slider-height').val(layer.height());
	});

	//	
	$('.slider-video:not(.editing)').live('dblclick',function(e){

		$(this).addClass('editing').children('span').html('<textarea>' + $(this).text() + '</textarea>').children('textarea').focus();
	});

	$('.slider-video.editing span textarea').live('keyup',function(e){
		var layer = $(this).closest('.slider-video');
		var id = layer.attr('id');

		$('.slider-items').children('#' + id).find('.slider-title').text($(this).val());
		$('.slider-items').children('#' + id).find('.slider-item').val($(this).val());
	});

	$('.slider-video.editing span textarea').live('keypress',function(e){
		var layer = $(this).closest('.slider-video');

		if(e.which == 13) {
			e.preventDefault();
			var id = layer.attr('id');

			layer.removeClass('editing').children('span').html($(this).val());

			$('.slider-items').children('#' + id).find('.slider-width').val(layer.width());
			$('.slider-items').children('#' + id).find('.slider-height').val(layer.height());
		}
	});

	$('.slider-video.editing span textarea').live('blur',function(e){
		var layer = $(this).closest('.slider-video');
		var id = layer.attr('id');

		layer.removeClass('editing').children('span').html($(this).val());

		$('.slider-items').children('#' + id).find('.slider-width').val(layer.width());
		$('.slider-items').children('#' + id).find('.slider-height').val(layer.height());
	});


	$('.text-style').live('change blur',function(e){
		e.preventDefault();

		var item = $(this).closest('.slider-item-wrapper');
		var id = item.attr('id');
		var container = $('.slider-container');
		var layer = container.children('#' + id);

		console.log(item.find('.text-size').val());

		layer.removeClass(function(index,css){
			return (css.match (/(^|\s)rs-text-\S+/g) || []).join(' ');
		}).addClass(item.find('.text-size').val()).addClass(item.find('.text-color').val());

		$('.slider-items').children('#' + id).find('.slider-width').val(layer.width());
		$('.slider-items').children('#' + id).find('.slider-height').val(layer.height());
	});

	$('.slider-container').live('resizeslider',function(e){
		var $this = $(this);
		var img_layer = $this.find('.slider-layer.new-layer');
		var items = $('.slider-items');

		img_layer.bind("load", function() {
			// do stuff
		}).each(function(event,ui){
			var id = $(ui).attr('id');
			var img = $(ui).find('img');
			var img_width = img.width();
			var img_height = img.height();

			$(this).removeClass('new-layer').draggable({
				'containment'	: 'parent'
			}).resizable({
				handles		: 'e, w',
				maxWidth	: img_width * $this.data('scale'),
				stop 		: function(event){
					items.find('#' + id).find('.slider-width').val($(event.target).width());
					items.find('#' + id).find('.slider-height').val($(event.target).height());
				}
			}).find('img').css({
				'max-width'	: img_width * $this.data('scale'),
				'max-height': img_height * $this.data('scale')
			});
		});
	});

	$('.layer-position').live('keypress',function(e){
		if(e.which == 13) {
			e.preventDefault();
		}
	});

	$('.layer-position').live('keyup',function(e){
		var container = $('.slider-container');
		var slider_item_wrapper = $(this).closest('.slider-item-wrapper');
		var id = slider_item_wrapper.attr('id');
		var slider_layer = $('.slider-layer#' + id);

		var container_width = container.width();
		var container_height = container.height();
		var layer_width = slider_layer.width();
		var layer_height = slider_layer.height();

		var layer_position = slider_layer.position();
		var layer_x = layer_position.left;
		var layer_y = layer_position.top;

		var x_max = container_width - layer_width;
		var y_max = container_height - layer_height;

		if ($(this).hasClass('x-axis')) {
			layer_x = $(this).val() > x_max ? x_max : $(this).val();
			$(this).val(layer_x);
		} else if ($(this).hasClass('y-axis')) {
			layer_y = $(this).val() > y_max ? y_max : $(this).val();
			$(this).val(layer_y);
		}

		slider_layer.css({
			'left'	: layer_x + 'px',
			'top'	: layer_y + 'px'
		});
	});

	$('.remove-slider').live('click',function(e){
		e.preventDefault();

		var id = $(this).parent().attr('id');

		if (confirm('Hapus Layer ?')) {
			$(this).parent().remove();
			$('.slider-container').find('#' + id).remove();
		}
	});

	// ADD LAYER TEXT
	$('.add-layer.add-text').live('click',function(e){
		e.preventDefault();

		var container = $('.slider-container');
		var items = $('.slider-items');

		container.children('.active').removeClass('active');
		items.children('.active').removeClass('active');

		var date = new Date();
		var time = date.getTime();

		var width = container.width();
		var height = container.height();

		var text_layer = '<div class="slider-layer slider-text active rs-text-size-normal rs-text-color-black" id="' + time + '"><span>Layer Text</span></div>';

		container.append(text_layer);

		var text = container.find('.slider-layer#' + time);
		var text_width = text.width();
		var text_height = text.height();

		var item = '';
		item += '<div class="row-fluid slider-item-wrapper active m-b-10" id="' + time + '">';
		item += '	<div class="row-fluid">';
		item += '		<h4 class="slider-title">Text Layer</h4>';
		item += '	</div>';
		item += '	<div class="row-fluid">';
		item += '		<span class="span4"><input type="text" class="slider-link span12" name="slider_link[' + time + ']" placeholder="Slider URL" /></span>';
		item += '	</div>';
		item += '	<div class="row-fluid m-t-25">';
		item += '		<div class="span4">';
		item += '			<div class="row-fluid" style="margin-top:-20px;">';
		item += '				<div class="span4">';
		item += '					<div class="span12">';
		item += '						<div class="t-align-center bold">X Axis</div>';
		item += '						<input type="text" name="x_axis[' + time + ']" class="span12 layer-position x-axis" value="0">';
		item += '					</div>';
		item += '					<div class="span12">';
		item += '						<div class="t-align-center bold">Size</div>';
		item += '						<select name="slider_class[' + time + '][size]" class="span12 text-style text-size">';
		item += '							<option value="rs-text-size-tiny">Tiny</option>';
		item += '							<option value="rs-text-size-small">Small</option>';
		item += '							<option value="rs-text-size-normal" selected="selected">Normal</option>';
		item += '							<option value="rs-text-size-large">Large</option>';
		item += '							<option value="rs-text-size-huge">Huge</option>';
		item += '						</select>';
		item += '					</div>';
		item += '				</div>';
		item += '				<div class="span4">';
		item += '					<div class="span12">';
		item += '						<div class="t-align-center bold">Y Axis</div>';
		item += '						<input type="text" name="y_axis[' + time + ']" class="span12 layer-position y-axis" value="0">';
		item += '					</div>';
		item += '					<div class="span12">';
		item += '						<div class="t-align-center bold">Color</div>';
		item += '						<select name="slider_class[' + time + '][color]" class="span12 text-style text-color">';
		item += '							<option value="rs-text-color-black">Black</option>';
		item += '							<option value="rs-text-color-white">White</option>';
		item += '							<option value="rs-text-color-gray">Gray</option>';
		item += '							<option value="rs-text-color-blue">Blue</option>';
		item += '							<option value="rs-text-color-green">Green</option>';
		item += '						</select>';
		item += '					</div>';
		item += '				</div>';
		item += '				<div class="span4">';
		item += '					<div class="t-align-center bold">Effect</div>';
		item += '					<select name="slider_effect[' + time + ']" class="span12">';
		item += '						<option value="sft">From Top</option>';
		item += '						<option value="sfr">From Right</option>';
		item += '						<option value="sfb">From Bottom</option>';
		item += '						<option value="sfl">From Left</option>';
		item += '					</select>';
		item += '				</div>';
		item += '				<div class="clearfix"></div>';
		item += '			</div>';
		item += '		</div>';
		item += '		<div class="span4">';
		item += '			<div class="row-fluid">';
		item += '				<div class="span2 m-t-5">Start</div>';
		item += '				<div class="span10 slider primary">';
		item += '					<input type="hidden" name="slider_start[' + time + ']" class="slider-element slider-start" value="1000" tooltip="show" data-slider-min="1000" data-slider-max="8000" data-slider-step="100" data-slider-value="1000" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show">';
		item += '				</div>';
		item += '				<div class="clearfix"></div>';
		item += '			</div>';
		item += '		</div>';
		item += '		<div class="span4">';
		item += '			<div class="row-fluid">';
		item += '				<div class="span2 m-t-5">Speed</div>';
		item += '				<div class="span10 slider primary">';
		item += '					<input type="hidden" name="slider_speed[' + time + ']" class="slider-element slider-speed" value="800" tooltip="show" data-slider-min="0" data-slider-max="2000" data-slider-step="10" data-slider-value="800" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show">';
		item += '				</div>';
		item += '				<div class="clearfix"></div>';
		item += '			</div>';
		item += '		</div>';
		item += '	</div>';
		item += '	<input type="hidden" name="slider_width[' + time + ']" class="slider-width" value="' + Math.round(text_width * container.data('scale')) + '" />';
		item += '	<input type="hidden" name="slider_height[' + time + ']" class="slider-height" value="' + Math.round(text_height * container.data('scale')) + '" />';
		item += '	<input type="hidden" name="slider_item[' + time + ']" class="slider-item" value="Layer Text" />';
		item += '	<input type="hidden" name="slider_type[' + time + ']" value="text" />';
		item += '	<i class="icon-trash remove-slider"></i>';
		item += '</div>';

		items.append(item).find('.slider-element').slider();

		text.draggable({
			'containment'	: 'parent'
		}).resizable({
			handles		: 'e, w',
			maxWidth	: width,
			stop 		: function(event){
				items.find('#' + time).find('.slider-width').val($(event.target).width());
				items.find('#' + time).find('.slider-height').val($(event.target).height());
			}
		}).children('span').css({
			'font-size'	: container.data('scale') + 'em'
		});

	});

	// ADD LAYER IMAGE
	$('.add-layer.add-image').live('click',function(e){
		e.preventDefault();

		var url = $(this).data('url');
		var type = $(this).data('type');

		var date = new Date();
		var time = date.getTime();

		if (url && type) {
			var url = $(this).data('url');
			var type = $(this).data('type');

			var popup_holder = $('<div class="popup popup-holder popup-close"></div>');
			var popup_container = $('<div class="popup popup-container col-lg-6 col-md-6 col-sm-8 col-xs-10"></div>');
			var popup_content = '';

			popup_content += '<div class="popup-content">';
			popup_content += '	<div class="box box-solid box-info no-margin">';
			popup_content += '		<div class="box-header">';
			popup_content += '			<h4 class="popup-title">File Manager</h4>';
			popup_content += '			<div class="box-tools pull-right">';
			popup_content += '				<button class="btn btn-warning btn-sm popup-close"><i class="fa fa-times"></i></button>';
			popup_content += '			</div>';
			popup_content += '		</div>';
			popup_content += '		<div class="">';
			popup_content += '			<iframe id="file-manager" src="' + url + type + '?time=' + time + '"></iframe>';
			popup_content += '		</div>';
			popup_content += '	</div>';
			popup_content += '</div>';

			popup_container.html(popup_content);
			
			$('body').append(popup_holder);
			$('body').append(popup_container);

			$('#file-manager').load(function(){
				popup_holder.animate({'opacity' : 1},400);
				popup_container.css({
					'top'	: (popup_holder.height() / 2) - (popup_container.height() / 2),
					'left'	: (popup_holder.width() / 2) - (popup_container.width() / 2)
				}).animate({'opacity' : 1},400).draggable({
					'containment'	: 'body'
				});
			});
		}
	});

	$('.file-manager').on('click','.select-file',function(e){
		e.preventDefault();

		var container = window.parent.$('.slider-container');
		var items = window.parent.$('.slider-items');
		var type = 'image';

		var files = $('.file-item.active');

		if (files.length) {
			if (type == 'image') {
				container.children('.active').removeClass('active');
				items.children('.active').removeClass('active');

				var date = new Date();
				var time = date.getTime();

				var width = container.width();
				var height = container.height();

				var image_layer = '<div class="slider-layer slider-image new-layer active" id="' + time + '"><img src="' + $(files[0]).data('dir') + '" /></div>';

				container.append(image_layer);

				var img_layer = container.find('.slider-layer#' + time);
				var img = img_layer.find('img');

				var dimension = $(files[0]).find('.file-dimension');
				var img_width = dimension.data('width');
				var img_height = dimension.data('height');

				var item = '';
				item += '<div class="row-fluid slider-item-wrapper active m-b-10" id="' + time + '">';
				item += '	<div class="row-fluid">';
				item += '		<h4 class="slider-title">' + $(files[0]).find('.file-name').text() + '</h4>';
				item += '	</div>';
				item += '	<div class="row-fluid">';
				item += '		<span class="span4"><input type="text" class="slider-link span12" name="slider_link[' + time + ']" placeholder="Slider URL" /></span>';
				item += '	</div>';
				item += '	<div class="row-fluid m-t-25">';
				item += '		<div class="span4">';
				item += '			<div class="row-fluid" style="margin-top:-20px;">';
				item += '				<div class="span4">';
				item += '					<div class="t-align-center bold">X Axis</div>';
				item += '					<input type="text" name="x_axis[' + time + ']" class="span12 layer-position x-axis" value="0">';
				item += '				</div>';
				item += '				<div class="span4">';
				item += '					<div class="t-align-center bold">Y Axis</div>';
				item += '					<input type="text" name="y_axis[' + time + ']" class="span12 layer-position y-axis" value="0">';
				item += '				</div>';
				item += '				<div class="span4">';
				item += '					<div class="t-align-center bold">Effect</div>';
				item += '					<select name="slider_effect[' + time + ']" class="span12">';
				item += '						<option value="sft">From Top</option>';
				item += '						<option value="sfr">From Right</option>';
				item += '						<option value="sfb">From Bottom</option>';
				item += '						<option value="sfl">From Left</option>';
				item += '					</select>';
				item += '				</div>';
				item += '				<div class="clearfix"></div>';
				item += '			</div>';
				item += '		</div>';
				item += '		<div class="span4">';
				item += '			<div class="row-fluid">';
				item += '				<div class="span2 m-t-5">Start</div>';
				item += '				<div class="span10 slider primary">';
				item += '					<input type="hidden" name="slider_start[' + time + ']" class="slider-element slider-start" value="1000" tooltip="show" data-slider-min="1000" data-slider-max="8000" data-slider-step="100" data-slider-value="1000" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show">';
				item += '				</div>';
				item += '				<div class="clearfix"></div>';
				item += '			</div>';
				item += '		</div>';
				item += '		<div class="span4">';
				item += '			<div class="row-fluid">';
				item += '				<div class="span2 m-t-5">Speed</div>';
				item += '				<div class="span10 slider primary">';
				item += '					<input type="hidden" name="slider_speed[' + time + ']" class="slider-element slider-speed" value="800" tooltip="show" data-slider-min="0" data-slider-max="2000" data-slider-step="10" data-slider-value="800" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show">';
				item += '				</div>';
				item += '				<div class="clearfix"></div>';
				item += '			</div>';
				item += '		</div>';
				item += '	</div>';
				item += '	<input type="hidden" name="slider_width[' + time + ']" class="slider-width" value="' + Math.round(img_width * container.data('scale')) + '" />';
				item += '	<input type="hidden" name="slider_height[' + time + ']" class="slider-height" value="' + Math.round(img_height * container.data('scale')) + '" />';
				item += '	<input type="hidden" name="slider_item[' + time + ']" class="slider-item" value="' + $(files[0]).data('location') + '" />';
				item += '	<input type="hidden" name="slider_type[' + time + ']" value="image" />';
				item += '	<input type="hidden" name="slider_class[' + time + ']" value="" />';
				item += '	<input type="hidden" name="slider_link[' + time + ']" value="" />';
				item += '	<i class="icon-trash remove-slider"></i>';
				item += '</div>';

				items.append(item).find('.slider-element').slider();
			}
		}

		window.parent.$('.popup').fadeOut(400,function(){
			$(this).remove();
		});

		window.parent.$('.slider-container').trigger('resizeslider');
	});
	
	// ADD LAYER VIDEO
	$('.add-layer.add-video').live('click',function(e){
		e.preventDefault();

		var container = $('.slider-container');
		var items = $('.slider-items');

		container.children('.active').removeClass('active');
		items.children('.active').removeClass('active');

		var date = new Date();
		var time = date.getTime();

		var width = container.width();
		var height = container.height();

		var video_layer = '<div class="slider-layer slider-video active" id="' + time + '"><span>Video URL</span></div>';

		container.append(video_layer);

		var video = container.find('.slider-layer#' + time);
		var video_width = 640;
		var video_height = 360;

		var item = '';
		item += '<div class="row-fluid slider-item-wrapper active m-b-10" id="' + time + '">';
		item += '	<div class="row-fluid">';
		item += '		<h4 class="slider-title">Video URL</h4>';
		item += '	</div>';
		item += '	<div class="row-fluid m-t-25">';
		item += '		<div class="span4">';
		item += '			<div class="row-fluid" style="margin-top:-20px;">';
		item += '				<div class="span4">';
		item += '					<div class="span12">';
		item += '						<div class="t-align-center bold">X Axis</div>';
		item += '						<input type="text" name="x_axis[' + time + ']" class="span12 layer-position x-axis" value="0">';
		item += '					</div>';
		item += '				</div>';
		item += '				<div class="span4">';
		item += '					<div class="span12">';
		item += '						<div class="t-align-center bold">Y Axis</div>';
		item += '						<input type="text" name="y_axis[' + time + ']" class="span12 layer-position y-axis" value="0">';
		item += '					</div>';
		item += '				</div>';
		item += '				<div class="span4">';
		item += '					<div class="t-align-center bold">Effect</div>';
		item += '					<select name="slider_effect[' + time + ']" class="span12">';
		item += '						<option value="sft">From Top</option>';
		item += '						<option value="sfr">From Right</option>';
		item += '						<option value="sfb">From Bottom</option>';
		item += '						<option value="sfl">From Left</option>';
		item += '					</select>';
		item += '				</div>';
		item += '				<div class="clearfix"></div>';
		item += '			</div>';
		item += '		</div>';
		item += '		<div class="span4">';
		item += '			<div class="row-fluid">';
		item += '				<div class="span2 m-t-5">Start</div>';
		item += '				<div class="span10 slider primary">';
		item += '					<input type="hidden" name="slider_start[' + time + ']" class="slider-element slider-start" value="1000" tooltip="show" data-slider-min="1000" data-slider-max="8000" data-slider-step="100" data-slider-value="1000" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show">';
		item += '				</div>';
		item += '				<div class="clearfix"></div>';
		item += '			</div>';
		item += '		</div>';
		item += '		<div class="span4">';
		item += '			<div class="row-fluid">';
		item += '				<div class="span2 m-t-5">Speed</div>';
		item += '				<div class="span10 slider primary">';
		item += '					<input type="hidden" name="slider_speed[' + time + ']" class="slider-element slider-speed" value="800" tooltip="show" data-slider-min="0" data-slider-max="2000" data-slider-step="10" data-slider-value="800" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="show">';
		item += '				</div>';
		item += '				<div class="clearfix"></div>';
		item += '			</div>';
		item += '		</div>';
		item += '	</div>';
		item += '	<input type="hidden" name="slider_width[' + time + ']" class="slider-width" value="' + Math.round(video_width * container.data('scale')) + '" />';
		item += '	<input type="hidden" name="slider_height[' + time + ']" class="slider-height" value="' + Math.round(video_height * container.data('scale')) + '" />';
		item += '	<input type="hidden" name="slider_item[' + time + ']" class="slider-item" value="Video URL" />';
		item += '	<input type="hidden" name="slider_type[' + time + ']" value="video" />';
		item += '	<input type="hidden" name="slider_class[' + time + ']" value="" />';
		item += '	<i class="icon-trash remove-slider"></i>';
		item += '</div>';

		items.append(item).find('.slider-element').slider();

		video.draggable({
			'containment'	: 'parent'
		}).css({
			'width'		: Math.round(video_width * container.data('scale')),
			'height'	: Math.round(video_height * container.data('scale'))
		}).children('span').css({
			'font-size'	: container.data('scale') + 'em'
		});

	});

	$('.slider-container').live('init',function(e){
		$('.slider-items').find('.slider-element').slider();
		var $this = $(this);
		var $old = $this.find('.slider-layer.old-layer');
		$old.each(function(){
			var id = $(this).attr('id');
			var type = $(this).hasClass('slider-text') ? 'text' : 'image';

			if (type == 'text') {
				$(this).removeClass('old-layer').draggable({
					'containment'	: 'parent'
				}).resizable({
					handles		: 'e, w',
					maxWidth	: $this.width(),
					stop 		: function(event){
						$('.slider-items').find('#' + id).find('.slider-width').val($(event.target).width());
						$('.slider-items').find('#' + id).find('.slider-height').val($(event.target).height());
					}
				}).css({
					'max-width'	: $this.width(),
					'max-height': $this.height()
				});
			} else {
				var img = $(this).find('img');
				var img_width = img.width();
				var img_height = img.height();

				console.log($(this));
				console.log(img_width);

				$(this).removeClass('old-layer').draggable({
					'containment'	: 'parent'
				}).resizable({
					handles		: 'e, w',
					maxWidth	: img_width,
					stop 		: function(event){
						$('.slider-items').find('#' + id).find('.slider-width').val($(event.target).width());
						$('.slider-items').find('#' + id).find('.slider-height').val($(event.target).height());
					}
				}).find('img').css({
					'max-width'	: img_width,
					'max-height': img_height
				});
			}
		});
	});

});