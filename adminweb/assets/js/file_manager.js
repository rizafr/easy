$(window).resize(function(){
	if ($('.file-manager-wrapper').length) {
		var height = $('.left-side').height() - 52;
		$('.file-manager-wrapper').css({
			'height' : height
		});
	}
});

$(document).ready(function(){
	if ($('.file-manager-wrapper').length) {
		var height = $('.left-side').height() - 52;
		$('.file-manager-wrapper').css({
			'height' : height
		});
	}

	if ($('.root-wrapper').length) {
		var urldir = $('.root-wrapper').data('urldir');
		var urlfile = $('.root-wrapper').data('urlfile');
		var dir = $('.root-wrapper').data('dir');
		var type = $('.root-wrapper').data('type');

		if (urldir) {
			get_upload_dir($('.root-wrapper'),urldir,dir);
		}
		if (urlfile) {
			get_upload_file($('.file-wrapper'),urlfile,dir,type);
		}
	}

	$('.root-wrapper').on('click','.root-folder:not(.opened) > .root-holder',function(e){
		e.preventDefault();

		var $this = $(this).closest('.root-folder');

		if (e.handled !== true) {
			urldir = $(this).data('urldir');
			dir = $(this).data('dir');
			if (urldir) {
				e.handled = true;
				get_upload_dir($this,urldir,dir);
			}
		}
	});

	$('.root-wrapper').on('click','.root-folder > .root-holder:not(.active)',function(e){
		e.preventDefault();

		$('.root-holder.active').removeClass('active');
		$(this).addClass('active');
		$('.need-folder').removeAttr('disabled');
		$('.need-file').attr('disabled','disabled');

		var urlfile = $(this).data('urlfile');
		var dir = $(this).data('dir');
		var type = $(this).data('type');

		if (urlfile) {
			get_upload_file($('.file-wrapper'),urlfile,dir,type);
		}
	});

	$('.root-wrapper').on('click','.root-folder.opened > .root-holder',function(e){
		e.preventDefault();

		var $this = $(this).closest('.root-folder');

		if ( ! $(e.target).hasClass('fa-folder')) {
			if ($this.hasClass('collapsed')) {
				$this.removeClass('collapsed');
				$this.children('.root-holder').children('i').addClass('fa-folder-open');
			}
		} else {
			if ($this.hasClass('collapsed')) {
				$this.removeClass('collapsed');
				$this.children('.root-holder').children('i').addClass('fa-folder-open');
			} else {
				$this.addClass('collapsed');
				$this.children('.root-holder').children('i').removeClass('fa-folder-open');
			}
		}
	});

	$('.file-wrapper').on('click',function(e){
		e.preventDefault();

		if (!e.ctrlKey && ($(e.target).hasClass('file-wrapper') || $(e.target).hasClass('file-box'))) {
			$('.file-item.active').removeClass('active');
			$('.need-file').attr('disabled','disabled');
		}
	});

	$('.file-wrapper').on('click','.file-item',function(e){
		e.preventDefault();

		if (!e.ctrlKey) {
			$('.file-item.active').not(this).removeClass('active');
			$(this).addClass('active');
		} else {
			$(this).toggleClass('active');
		}

		if ($('.file-item.active').length) {
			$('.need-file').removeAttr('disabled');
		} else {
			$('.need-file').attr('disabled','disabled');
		}

	});

	$('body').on('click','.popup-close',function(e){
		e.preventDefault();

		$('.popup').fadeOut(400,function(){
			$(this).remove();
		});
	});

	$('.menu-wrapper').on('click','.create-folder',function(e){
		e.preventDefault();

		var root = $('.root-holder.active');

		if (root.length) {
			var url = $(this).data('url');
			var dir = root.data('dir');

			set_folder_name(url,dir);

		} else {
			alert('Tidak bisa menambah folder pada root!');
		}
	});

	$('body').on('click','.submit-create-folder',function(e){
		e.preventDefault();

		var root = $('.root-holder.active');

		if (root.length) {
			if ($('.folder-name').val()) {
				create_folder(root,$('.submit-create-folder').data('url'),$('.folder-name').data('dir'),$('.folder-name').val());
			} else {
				alert('Folder name required!');
			}
		}
	});

	$('.menu-wrapper').on('click','.delete-folder',function(e){
		e.preventDefault();

		var root = $('.root-holder.active');

		if (root.closest('.root-content').parent().hasClass('root-wrapper')) {
			alert('Root utama tidak dapat dihapus!');
		} else if (root.length) {
			var url = $(this).data('url');
			var dir = root.data('dir');

			if (confirm('Hapus Folder ' + dir + ' ?')) {
				delete_folder(root,url,dir);
			}

		} else {
			alert('Pilih folder yang akan dihapus!');
		}
	});

	$('.menu-wrapper').on('click','.delete-file',function(e){
		e.preventDefault();

		var items = $('.file-item.active');
		var data = new Array();
		var object = new Array();
		var url = $(this).data('url');

		$.each(items,function(i,item){
			data.push($(item).data('path'));
			object.push(item);
		});

		if (data.length) {
			if (confirm('Hapus file ?')) {
				delete_file(url,data,object);
			}
		} else {
			alert('Pilih file yang akan dihapus!');
		}
	});

	$('.upload-file').on('click',function(e){
		$('.uploader-manager').addClass('show');
	});

	$('.close-uploader').on('click',function(e){
		var urlfile = $('.root-holder.active').data('urlfile');
		var dir = $('.root-holder.active').data('dir');
		var type = $('.root-holder.active').data('type');

		if (urlfile) {
			get_upload_file($('.file-wrapper'),urlfile,dir,type);
		}
		$('.uploader-manager').find('.dz-preview').remove();
		$('.uploader-manager').find('.dz-started').removeClass('dz-started');
		$('.uploader-manager').removeClass('show');
	});

	function get_upload_dir(root, url, dir) {
		$.ajax({
			'url'		: url,
			'type'		: 'POST',
			'dataType'	: 'json',
			'data'		: {'dir' : dir},
			'success'	: function(data){
				if (typeof data.success !== 'undefined' && data.success) {
					if (typeof data.data === 'object' && data.data.length) {
						var type = $('.root-wrapper').data('type');
						var ul = $('<ul class="root"></ul>');
						$.each(data.data,function(key,value){
							var span = $('<span class="root-holder"><i class="text-blue fa fa-folder"></i> ' + basename(value.dir) + '</span>').
										data('type',type).
										data('dir',value.dir).
										data('urldir',value.urldir).
										data('urlfile',value.urlfile);
							var li = $('<li class="root-folder"></li>').append(span);
							ul.append(li);
						});
						if ( ! root.children('.root-content').length) {
							root.append('<div class="root-content"></div>')
						}
						root.addClass('opened').children('.root-content').html(ul);
						root.children('.root-holder').children('i').addClass('fa-folder-open');
					}
				}
			}
		});
	}

	function get_upload_file(wrapper, url, dir, type) {
		$.ajax({
			'url'		: url,
			'type'		: 'POST',
			'dataType'	: 'json',
			'data'		: {'dir' : dir, 'type' : type},
			'success'	: function(data){
				if (typeof data.success !== 'undefined' && data.success) {
					if (typeof data.data === 'object') {
						var div = $('<div class="file-box"></div>');
						$.each(data.data,function(key,value){
							var filename = $('<div class="file-info file-name">' + value.filename + '</div>');
							var size = $('<small class="file-info file-size">' + value.size + '</small>');
							var date = $('<small class="file-info file-date">' + value.date + '</small>');
							var dimension = $('<input type="hidden" class="file-info file-dimension" data-width="' + value.width + '" data-height="' + value.height + '" />');
							var filecontent = $('<div class="file-content"></div>');

							filecontent.append(filename).append(size).append(date).append(dimension);

							var thumb = null;
							switch(value.type) {
								case	'image'		: thumb = $('<div class="thumb thumb-image" style="background-image:url(\'' + value.filedir + '\');">' + (!value.filedir ? '<i class="fa fa-picture-o"></i>' : '') + '</div>'); break;
								case	'video'		: thumb = $('<div class="thumb thumb-video"><i class="fa fa-video-camera"></i></div>'); break;
								case	'audio'		: thumb = $('<div class="thumb thumb-audio"><i class="fa fa-music"></i></div>'); break;
								default				: thumb = $('<div class="thumb thumb-default"><i class="fa fa-file-o"></i></div>'); break;
							}

							if (thumb) {
								filecontent.prepend(thumb);
							}

							var fileitem = $('<div class="file-item col-lg-2 col-md-3 col-sm-4 col-xs-4"></div>').data('location',value.filelocation).data('path',value.filepath).data('dir',value.filedir).data('mime',value.mime);

							fileitem.append(filecontent);
							div.append(fileitem);
						});
						wrapper.html(div);
						$('.current-dir').val(dir);
						$('#upload_dir').val(dir);
					}
				}
			}
		});
	}

	function set_folder_name(url, dir) {
		var popup_holder = $('<div class="popup popup-holder popup-close"></div>');
		var popup_container = $('<div class="popup popup-container col-lg-6"></div>');
		var popup_content = '';

		popup_content += '<div class="popup-content">';
		popup_content += '	<div class="box box-solid bg-light-blue no-margin">';
		popup_content += '		<div class="box-header">';
		popup_content += '			<h4 class="popup-title">Create New Folder</h4>';
		popup_content += '			<div class="box-tools pull-right">';
		popup_content += '				<button class="btn btn-primary btn-sm popup-close"><i class="fa fa-times"></i></button>';
		popup_content += '			</div>';
		popup_content += '		</div>';
		popup_content += '		<div class="box-body">';
		popup_content += '			<span>Location : ' + dir + '/</span>';
		popup_content += '			<input type="text" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-sm input-large folder-name" placeholder="Folder Name" data-dir="' + dir + '" />';
		popup_content += '			<input type="button" class="btn btn-warning btn-small m-t-10 pull-right submit-create-folder" value="Create" data-url="' + url + '" />';
		popup_content += '			<div class="clearfix"></div>';
		popup_content += '		</div>';
		popup_content += '	</div>';
		popup_content += '</div>';

		popup_container.html(popup_content);
		
		$('body').append(popup_holder);
		$('body').append(popup_container);

		popup_holder.animate({'opacity' : 1},400);
		popup_container.css({
			'top'	: (popup_holder.height() / 2) - (popup_container.height() / 2),
			'left'	: (popup_holder.width() / 2) - (popup_container.width() / 2)
		}).animate({'opacity' : 1},400).draggable({
			'containment'	: 'body'
		});
	}

	function create_folder(root, url, dir, name) {
		$.ajax({
			'url'		: url,
			'type'		: 'POST',
			'dataType'	: 'json',
			'data'		: {'dir' : dir, 'name' : name},
			'success'	: function(data){
				if (typeof data.success !== 'undefined' && data.success) {
					get_upload_dir(root.closest('.root-folder'),root.data('urldir'),dir);
					root.closest('.root-folder').removeClass('collapsed');

					$('.popup').fadeOut(400,function(){
						$(this).remove();
					});
				} else if (typeof data.message !== 'undefined' && data.message) {
					alert(data.message);
				}
			}
		});
	}

	function delete_folder(root, url, dir) {
		$.ajax({
			'url'		: url,
			'type'		: 'POST',
			'dataType'	: 'json',
			'data'		: {'dir' : dir},
			'success'	: function(data){
				if (typeof data.success !== 'undefined' && data.success) {
					root.closest('.root-folder').remove();
					$('.file-wrapper').html('');
					$('.current-dir').val('');
					$('.need-folder').attr('disabled','disabled');
				} else if (typeof data.message !== 'undefined' && data.message) {
					alert(data.message);
				}
			}
		});
	}

	function delete_file(url, data, object) {
		$.ajax({
			'url'		: url,
			'type'		: 'POST',
			'dataType'	: 'json',
			'data'		: {'data' : data},
			'success'	: function(data){
				if (typeof data.success !== 'undefined' && data.success) {
					$(object).each(function(){
						$(this).remove();
					});
					$('.need-file').attr('disabled','disabled');
				} else if (typeof data.message !== 'undefined' && data.message) {
					alert(data.message);
				}
			}
		});
	}

	function basename(str) {
		var base = new String(str).substring(str.lastIndexOf('/') + 1); 
		if(base.lastIndexOf(".") != -1) {
			base = base.substring(0, base.lastIndexOf("."));
		}
		return base;
	}
});