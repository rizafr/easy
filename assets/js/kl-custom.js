;(function($){
	"use strict";
	
	$(document).ready(function() {
		var l = window.location;
		var SITE_URL = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
		// Your JS & jQuery Code here
		
		$("#reminder").change(function(){
			var reminder = $(this).find('option:selected').attr('value');
			if(reminder > 0)
			{
				if(reminder == 1) {
					$('#reminderformat').html('<p class="form-row form-row-wide" id="remindformat">'+
								'<label for="method">Pilih Hari<span class="required">*</span>'+
								'</label> <select id="reminder" name="time" style="width: 100%">'+
								'<option style="padding: 8px;" value="1">Senin</option>'+
								'<option style="padding: 8px;" value="2">Selasa</option>'+
								'<option style="padding: 8px;" value="3">Rabu</option>'+
								'<option style="padding: 8px;" value="4">Kamis</option>'+
								'<option style="padding: 8px;" value="5">Jumat</option>'+
								'<option style="padding: 8px;" value="6">Sabtu</option>'+
								'<option style="padding: 8px;" value="7">Ahad</option></select></p>');
				}
				if(reminder > 1) {
					$('#reminderformat').html('<p class="form-row form-row-wide" style="height:15px;" id="remindformat">'+
							'<label for="method">Pilih Tanggal<span class="required">*</span>'+
								'</label><div id="datetimepicker4" class="input-append date">'+
								'<input type="text" name="time"	style="width: 90%; height: 32px;"></input>'+ 
								'<span class="add-on" style="height: 32px;float:right;padding-top:6px;"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></p>');
					 $('#datetimepicker4').datetimepicker({
				          pickTime: false
				        });
				}
			}
		});
		
		$('#dowload1').ajaxForm(function(data) {
			var json = JSON.parse(data);
			alert(json.message);
        });
		$('#dowload2').ajaxForm(function(data) {
			var json = JSON.parse(data);
			alert(json.message);
        });
		$('#dowload3').ajaxForm(function(data) {
			var json = JSON.parse(data);
			alert(json.message);
        });
		$('#dowload4').ajaxForm(function(data) {
			var json = JSON.parse(data);
			alert(json.message);
        });
		
		$('#test-form').ajaxForm(function(data) {
//			alert(data);
			var json = JSON.parse(data);
			if(json.success == false){
				var string = '<a id="error" style="color: #ff0000; padding-left:20px;">* '+json.message+'</a>';
				$('#error').remove();
				$('#wrlogin').append(string);
			}
			else {
				window.location.href = json.redirect;
			};
        });
		
		$('#test-form2').ajaxForm(function(data) {
			var json = JSON.parse(data);
			if(json.success == false){ 
				var string = '<a id="error" style="color: #ff0000; padding-left:20px;">* '+json.message+'</a>';
				$('#error').remove();
				$('#wrforgot').append(string);
			}
			else {
				window.location.href = json.redirect;
			};
        });
		
		$('#register-form').ajaxForm(function(data) {
			var json = JSON.parse(data);
			if(json.success == false){
				var string = '<a id="error" style="color: #ff0000;">* '+json.message+'</a>';
				$('#error').remove();
				$('#'+json.position).append(string);
			}
			else {
				window.location.href = json.redirect;
			}
        });
		
		$('#edit-profile').ajaxForm(function(data) {
//			alert(data);
			var json = JSON.parse(data);
			if(json.success == false){
				var string = '<a id="error" style="color: #ff0000;">* '+json.message+'</a>';
				$('#error').remove();
				$('#'+json.position).append(string);
			}
			else {
				window.location.href = json.redirect;
			}
        });
		
		$('#comment-form').ajaxForm(function(data) {

			var json = JSON.parse(data);
			if(json.success == false){					
				$('#other').html('<div class="alert alert-danger">'+json.notify+'</div>');
				
					for (var i = 0; i < json.message.length; i++) {
//						alert(json.message[i].message);
						$('#' + json.message[i].target).html(json.message[i].message);
					}
			}
			else {
//			    $( "#respond" ).remove();
				$('#email').remove();
				$('#name').remove();
				$('#message').remove();
//				$('#loading').html('<span class="glyphicon glyphicon-ok icon-green"></span>');
				$('#other').html('<div class="alert alert-success">'+json.notify+'</div>');
				$("input[name='email']").val('');
				$("input[name='name']").val('');
				$("textarea[name='message']").val('');
//				setTimeout(function(){
//					$('#loading').html('');
//				},1500);
				
			}
        });
		
		$('#confirm-form').ajaxForm(function(data) {

			var json = JSON.parse(data);

			if(json.success == false){
				if(json.other == 'failed')
				{
					$('#other').html('<div class="alert alert-danger">konfirmasi gagal dikirim, silahkan coba lagi</div>');
					$('#loading').html('<span class="glyphicon glyphicon-remove icon-red"></span>');
					setTimeout(function(){
						$('#loading').html('');
					},1500);
					$('html, body').animate({ scrollTop: 0 }, 'slow');
					
				}
				else {
					var string = '<a id="error" style="color: #ff0000;">* '+json.message+'</a>';
					$('#error').remove();
					$('#'+json.position).append(string);
					setTimeout(function(){
						$('#loading').html('');
					},1500);					
				}				
			}
			else {
//			$( "#confirm" ).remove();
				$('#error').remove();
				$('#loading').html('<span class="glyphicon glyphicon-ok icon-green"></span>');
				$('#other').html('<div class="alert alert-success">Terima Kasih <strong>'+json.other+'</strong>, konfirmasi anda berhasil dikirim.</div>');
				$("select[name='pembayaran']").val('1');
				$("input[name='email']").val('');
				$("input[name='name']").val('');
				$("input[name='nokontak']").val('');
				$("input[name='frombank']").val('');
				$("select[name='tobank']").val('0');
				$("input[name='amount']").val('');
				$("input[name='date']").val('');
				$("select[name='cabang']").val('1');
				$("textarea[name='note']").val('');
				$("input[name='captcha']").val('');
				$('.captcha-image').attr('src',(SITE_URL + 'captcha/confirm?' + Math.random()));
				setTimeout(function(){
					$('#loading').html('');
				},1500);
				$('html, body').animate({ scrollTop: 170 }, 'slow');
			}
        });
		
		$('#donate-form').ajaxForm(function(data) {
//			alert(data);
			var json = JSON.parse(data);
			if(json.success == false){
				if(json.other == 'failed')
				{
					$('#other').html('<div class="alert alert-danger">pengiriman data gagal dikirim, silahkan coba lagi</div>');
					$('#loading').html('<span class="glyphicon glyphicon-remove icon-red"></span>');
					setTimeout(function(){
						$('#loading').html('');
					},1500);
					$('html, body').animate({ scrollTop: 170 }, 'slow');
				}
				else {
					var string = '<a id="error" style="color: #ff0000;">* '+json.message+'</a>';
					$('#error').remove();
					$('#'+json.position).append(string);
					setTimeout(function(){
						$('#loading').html('');
					},1000);
				}
			}
			else {
				//if(json.message == 'faspay') {
				//window.location.href = json.position;
				//    	var left = (screen.width/2)-(800/2);
	 	 		//	var top = (screen.height/2)-(600/2);
				//	var windowObjectReference;
				//	var strWindowFeatures = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes,  width=800, height=600, top="+top+", left="+left;
				//	windowObjectReference = window.open(json.position, "IZI Donation via Faspay", strWindowFeatures);
				//}
//				$( "#donate" ).remove();
				$('#error').remove();
				$('#loading').html('<span class="glyphicon glyphicon-ok icon-green"></span>');
				$('#other').html('<div class="alert alert-success">Terima Kasih <strong>'+json.other+'</strong>, data anda berhasil dikirim.</div>');
				$("select[name='pembayaran']").val('0');
				$("input[name='setoran']").val('');
				$("input[name='firstname']").val('');
				$("input[name='lastname']").val('');
				$("input[name='email']").val('');
				$("select[name='metode']").val('0');
				$("input[name='nokontak']").val('');
				$("textarea[name='address']").val('');
				$("select[name='cabang']").val('1');
				setTimeout(function(){
					$('#loading').html('');
				},1500);
				$('html, body').animate({ scrollTop: 170 }, 'slow');
			}
        });
		
		$('#plan-form').ajaxForm(function(data) {
//			alert(data);
			var json = JSON.parse(data);
			if(json.success == false){
				if(json.other == 'failed')
				{
					$('#other').html('<div class="alert alert-danger">data gagal disimpan, silahkan coba lagi</div>');
//					$('#loading').html('<span class="glyphicon glyphicon-remove icon-red"></span>');
//					setTimeout(function(){
//						$('#loading').html('');
//					},1500);
					
				}
				else {
					var string = '<a id="error" style="color: #ff0000;">* '+json.message+'</a>';
					$('#error').remove();
					$('#'+json.position).append(string);
//					setTimeout(function(){
//						$('#loading').html('');
//					},1000);
				}				
			}
			else {
				var string = '<a id="success" style="color: #00ff00;">* '+json.message+'</a>';
				$('#error').remove();
//				$('#loading').html('<span class="glyphicon glyphicon-ok icon-green"></span>');
				$('#other').html('<div class="alert alert-success"><strong>'+json.other+'</strong>, data anda berhasil disimpan.</div>');
				$("select[name='pembayaran']").val('0');
				$("input[name='setoran']").val('');
				$("select[name='metode']").val('0');
				$("select[name='waktu']").val('0');
				$("input[name='time']").val('');
				$("select[name='time']").val('1');
				setTimeout(function(){
					window.location.href = SITE_URL+'myaccount';
				},1500);
			}
        });
		
		$('#calculator-zakat').ajaxForm(function(data) {
			var json = JSON.parse(data);
			if(json.success == false){
				var string = '<a id="error" style="color: #ff0000;">* '+json.message+'</a>';
				$('#error').remove();
				$('#'+json.position).append(string);
			}
			else {
			$( "#submitedzakat" ).remove();
			$('#submitedsuccess').append('<div class="hg_section_size container">'+
                '<div class="row">'+
                    '<div class="col-md-6">'+
                        '<div class="ib2-style3 ib2-text-color-light-theme ib2-custom" style="background-color:#fff;">'+
                            '<div class="ib2-inner">'+
                                '<h4 class="ib2-info-message">INFORMASI</h4>'+
                                '<div class="ib2-content">'+
                                    '<h3 class="ib2-content--title">Data zakat anda sudah disimpan</h3>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>');
			}
        });
		
		function formatNumber(n, currency) {
		    return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
		}
		
//		$('.zakat-input').live('keyup change', function(){
		$(document).on('keyup change', function(e) {

			if (! parseFloat($(this).val())) {
				//$(this).val(0);
			}			
			
			// nisab
			var harga_emas = parseFloat($('#harga_emas').val());
//			console.log(harga_emas);
			if(harga_emas == '') harga_emas = 0;
			var besar_nisab = harga_emas * 85;
			var nisab = besar_nisab;
			
			$("input[name='besar_nisab']").val(besar_nisab);
			besar_nisab = formatNumber(besar_nisab, 'Rp.');//$.formatNumber(besar_nisab, {format:"#,###", locale:"id"});
			$('#besar_nisab').html(besar_nisab);
			
			// nisab pertanian
			var harga_pangan = parseFloat($('#harga_pangan').val());
			
			var	sepuluh = $('#pertaniansepuluh').val(), lima = $('#pertanianlima').val();
			var zakat_pertanian_sepuluh, zakat_pertanian_lima;
			if(sepuluh) zakat_pertanian_sepuluh = Math.round(sepuluh * 0.1);
			else zakat_pertanian_sepuluh = 0;
			if(lima) zakat_pertanian_lima = Math.round(lima * 0.05);
			else zakat_pertanian_lima = 0;

			var total_zakat_pertanian = zakat_pertanian_sepuluh + zakat_pertanian_lima;
			var total_hasil_pertanian = sepuluh + lima;
			var nisab_tani = (total_hasil_pertanian >= harga_pangan);
			
			if(nisab_tani==false) {
				if(total_hasil_pertanian > 0) {
					$('#shodaqoht').html('Agar berkah, silahkan <strong>shodaqoh</strong> 2,5%');
					var shodaqoh = Math.round(total_hasil_pertanian * 0.025);
					$('#paytanip').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=7&get_zakat='+shodaqoh+'" type="submit">BAYAR SHODAQOH</a>');
				}
			}
			else {
				$('#paytanip').html('');
				$('#shodaqoh').html('');
			}
			var pertanian = total_zakat_pertanian;
			var pertanian_pay = total_zakat_pertanian;
			$("input[name='zakat_pertanian']").val(nisab_tani ? total_zakat_pertanian : 0);
			total_zakat_pertanian = formatNumber(total_zakat_pertanian, 'Rp.');
//			$('#zakat_pertanian').html(total_zakat_pertanian);
			$('#zakat_pertanian').html(nisab_tani ? total_zakat_pertanian : 0);
			
			
//			lainnya (hadiah / temuan)
			var	hadiah = $('#total_hadiah').val();
			if(!hadiah) hadiah = 0;
			var zakat_lainnya = Math.round(hadiah * 0.05);
			var nisab_sewa = (hadiah >= harga_pangan);
			
			if(nisab_sewa==false) {
				if(hadiah > 0) {
					$('#shodaqohs').html('Agar berkah, silahkan <strong>shodaqoh</strong> 2,5%');
					var shodaqoh = Math.round(hadiah * 0.025);
					$('#payotherp').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=7&get_zakat='+shodaqoh+'" type="submit">BAYAR SHODAQOH</a>');
				}
			}
			else {
				$('#payotherp').html('');
				$('#shodaqohs').html('');
			}
			
			var lainnya = zakat_lainnya;
			var lain_pay = zakat_lainnya;
			$("input[name='zakat_hadiah']").val(nisab_sewa ? zakat_lainnya : 0);
			zakat_lainnya = formatNumber(zakat_lainnya, 'Rp.');
//			$('#zakat_hadiah').html(zakat_lainnya);
			$('#zakat_hadiah').html(nisab_sewa ? zakat_lainnya : 0);
			
			// harta simpanan
			var	tabungan = $('#tabungan').val(), bunga = $('#bunga').val(), saham = $('#saham').val(), perhiasan = $('#perhiasan').val(), kendaraan = $('#kendaraan').val();			
			if(bunga == '') bunga = 0; if(tabungan == '') tabungan = 0; if(saham == '') saham = 0; if(perhiasan == '') perhiasan = 0; if(kendaraan == '') kendaraan = 0; 
			if(nisab == 0) {
				$('#error_nisab').html('Harap hitung nisab terlebih dahulu!');
			}
			else {
				$('#error_nisab').html('');
			}
			var total_simpanan = Math.round((parseFloat(tabungan) - parseFloat(bunga)) + parseFloat(saham) + parseFloat(perhiasan) + parseFloat(kendaraan));
			var zakat_pribadi = Math.round(total_simpanan * 0.025);
			var pribadi = zakat_pribadi;
			var pribadi_pay = zakat_pribadi;
			var nisab_pribadi = (total_simpanan >= nisab);		
			if(nisab_pribadi==false) {
				if(total_simpanan > 0) {
					$('#shodaqoh').html('Agar berkah, silahkan <strong>shodaqoh</strong> 2,5%');
					var shodaqoh = Math.round(total_simpanan * 0.025);
					$('#payharta').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=7&get_zakat='+shodaqoh+'" type="submit">BAYAR SHODAQOH</a>');
				}
			}
			else $('#shodaqoh').html('');

			$("input[name='total_simpanan']").val(total_simpanan ? total_simpanan : 0);
			$("input[name='zakat_pribadi']").val(nisab_pribadi ? zakat_pribadi : 0);
			
			total_simpanan = formatNumber(total_simpanan, 'Rp.');
			zakat_pribadi = formatNumber(zakat_pribadi, 'Rp.');

			$('#total_simpanan').html(total_simpanan ? total_simpanan : 0);
			if(nisab) $('#zakat_pribadi').html(nisab_pribadi ? zakat_pribadi : 0);
			else $('#zakat_pribadi').html(0);

			// zakat profesi
			var	nisab_profesix = $('#nisab_profesix').val(), pendapatan = $('#pendapatan').val(), bonus = $('#bonus').val(), pengeluaran = $('#pengeluaran').val(), pengeluaran_lain = $('#pengeluaran_lain').val();
			var total_pendapatan = Math.round(parseFloat(pendapatan) + parseFloat(bonus));
//			var total_pengeluaran = Math.round((parseFloat(pengeluaran) * 12) + parseFloat(pengeluaran_lain));
//			var selisih_pendapatan = Math.round(total_pendapatan - total_pengeluaran);
			var zakat_profesi = Math.round(total_pendapatan * 0.025);
			var profesi = zakat_profesi;
			var profesi_pay = zakat_profesi;
			var nisab_profesi = total_pendapatan >= nisab_profesix;
			
			if((nisab_profesi==false) && (total_pendapatan > 0)) {				
//				console.log(total_kekayaan_perusahaan);
				$('#shodaqohpr').html('Agar berkah, silahkan <strong>shodaqoh</strong> 2,5%');
				var shodaqoh = Math.round(total_pendapatan * 0.025);					
				$('#payprofesip').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=7&get_zakat='+shodaqoh+'" type="submit">BAYAR SHODAQOH</a>');
		}
		else {
			$('#shodaqohp').html('');
			$('#payprofesip').html('');
		}
			
			$("input[name='total_pendapatan']").val(total_pendapatan ? total_pendapatan : 0);
//			$("input[name='total_pengeluaran']").val(total_pengeluaran ? total_pengeluaran : 0);
//			$("input[name='selisih_pendapatan']").val(nisab_profesi ? selisih_pendapatan : 0);
			$("input[name='zakat_profesi']").val(nisab_profesi ? zakat_profesi : 0);

			total_pendapatan = formatNumber(total_pendapatan,'Rp.');
//			total_pengeluaran = formatNumber(total_pengeluaran, 'Rp.');
//			selisih_pendapatan = formatNumber(selisih_pendapatan, 'Rp.');
			zakat_profesi = formatNumber(zakat_profesi, 'Rp.');

			$('#total_pendapatan').html(total_pendapatan ? total_pendapatan : 0);
//			$('#total_pengeluaran').html(total_pengeluaran ? total_pengeluaran : 0);
//			$('#selisih_pendapatan').html(nisab_profesi ? selisih_pendapatan : 0);
			$('#zakat_profesi').html(nisab_profesi ? zakat_profesi : 0);
			
			// zakat usaha
			var kekayaan_perusahaan = $('#kekayaan_perusahaan').val(), hutang_perusahaan = $('#hutang_perusahaan').val();
			if(kekayaan_perusahaan == '') kekayaan_perusahaan = 0; if(hutang_perusahaan == '') hutang_perusahaan = 0;
			
			var total_kekayaan_perusahaan = Math.round((parseFloat(kekayaan_perusahaan) - parseFloat(hutang_perusahaan)));
			var selisih_kekayaan_perusahaan = Math.round(total_kekayaan_perusahaan);			
			var zakat_perusahaan = Math.round(total_kekayaan_perusahaan * 0.025);
//			console.log(zakat_perusahaan);
			var perusahaan = zakat_perusahaan;
			var perusahaan_pay = zakat_perusahaan;
			
			if(nisab == 0) {
				$('#error_nisab2').html('Harap hitung nisab terlebih dahulu!');
			}
			else {
				$('#error_nisab2').html('');
			}
			
			var nisab_perusahaan = selisih_kekayaan_perusahaan >= nisab;

			if((nisab_perusahaan==false) && (total_kekayaan_perusahaan > 0)) {				
//					console.log(total_kekayaan_perusahaan);
					$('#shodaqohp').html('Agar berkah, silahkan <strong>shodaqoh</strong> 2,5%');
					var shodaqoh = Math.round(total_kekayaan_perusahaan * 0.025);					
					$('#payperusahaanp').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=7&get_zakat='+shodaqoh+'" type="submit">BAYAR SHODAQOH</a>');
			}
			else {
				$('#shodaqohp').html('');
				$('#payperusahaanp').html('');
			}
			
			$("input[name='total_kekayaan_perusahaan']").val(total_kekayaan_perusahaan ? total_kekayaan_perusahaan : 0);
			$("input[name='selisih_kekayaan_perusahaan']").val(nisab_perusahaan ? selisih_kekayaan_perusahaan : 0);
			$("input[name='zakat_perusahaan']").val(nisab_perusahaan ? zakat_perusahaan : 0);

			total_kekayaan_perusahaan = formatNumber(total_kekayaan_perusahaan, 'Rp.');
			selisih_kekayaan_perusahaan = formatNumber(selisih_kekayaan_perusahaan, 'Rp.');
			zakat_perusahaan = formatNumber(zakat_perusahaan, 'Rp.');

			$('#total_kekayaan_perusahaan').html(total_kekayaan_perusahaan ? total_kekayaan_perusahaan : 0);
			$('#selisih_kekayaan_perusahaan').html(nisab_perusahaan ? selisih_kekayaan_perusahaan : 0);
			if(nisab_perusahaan) $('#zakat_perusahaan').html(nisab_perusahaan ? zakat_perusahaan : 0);
			else $('#zakat_perusahaan').html(0);			
			
			// total
			var total = 0;
			total = nisab_pribadi ? total + pribadi : total;
			total = nisab_profesi ? total + profesi : total;
			total = nisab_perusahaan ? total + perusahaan : total;
			total = total + pertanian;
			total = total + lainnya;
			var total_pay = total;
			
			$("input[name='pertanian']").val(pertanian ? pertanian : 0);
			$("input[name='lainnya']").val(lainnya ? lainnya : 0);
			$("input[name='profesi']").val(nisab_profesi ? profesi : 0);
			$("input[name='perusahaan']").val(perusahaan ? perusahaan : 0);
			$("input[name='pribadi']").val(nisab_pribadi ? pribadi : 0);
			$("input[name='total']").val(total ? total : 0);

			pribadi = formatNumber(pribadi, 'Rp.');
			profesi = formatNumber(profesi, 'Rp.');
			perusahaan = formatNumber(perusahaan, 'Rp.');
			pertanian = formatNumber(pertanian, 'Rp.');
			lainnya = formatNumber(lainnya, 'Rp.');
			total = formatNumber(total, 'Rp.');

			$('#pribadi').html(nisab_pribadi ? pribadi : 0);
			$('#profesi').html(nisab_profesi ? profesi : 0);
			$('#perusahaan').html(perusahaan ? perusahaan : 0);
			$('#pertanian').html(pertanian ? pertanian : 0);
			$('#lainnya').html(lainnya ? lainnya : 0);
			$('#total').html(total ? total : 0);
			
//			console.log(nisab_perusahaan);
			if(nisab_pribadi) {
				$('#payharta').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=1&get_zakat='+pribadi_pay+'" type="submit">BAYAR SEKARANG</a>');
			}
			if(nisab_profesi) {
				$('#payprofesi').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=3&get_zakat='+profesi_pay+'" type="submit">BAYAR SEKARANG</a>');
			}
			else $('#payprofesi').html('');
			if(nisab_perusahaan) {
				$('#payperusahaan').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=3&get_zakat='+perusahaan_pay+'" type="submit">BAYAR SEKARANG</a>');
			}
			else $('#payperusahaan').html('');
			if(nisab_tani) {
				$('#paytani').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=1&get_zakat='+pertanian_pay+'" type="submit">BAYAR SEKARANG</a>');
			}
			else $('#paytani').html('');
			if(nisab_sewa) {
				$('#payother').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=1&get_zakat='+lain_pay+'" type="submit">BAYAR SEKARANG</a>');
			}
			else $('#payother').html('');
			if(total) {
				$('#paytotal').html('<a class="btn-element btn btn-success" href="'+SITE_URL+'/donate-now?type=1&get_zakat='+total_pay+'" type="submit">BAYAR SEKARANG</a>');
			}

		});
	});// end of document ready

})(jQuery);
