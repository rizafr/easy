
<?php $page_language_id = isset($page_detail->content[$this->language_id]) ? $this->language_id : 'default'; ?>
<?php $parent_language_id = isset($parent_detail->content[$this->language_id]) ? $this->language_id : 'default'; ?>

<div
	class="kl-slideshow static-content__slideshow uh_light_gray maskcontainer--shadow_ud ">
	<div class="bgback"></div>
	<div class="kl-slideshow-inner static-content__wrapper min-200">
		<div class="static-content__source ">
			<div class="kl-bg-source">
                     	<?php //if (isset($page_image) && ! empty($page_image)) { echo json_encode($page_image);?>
							<?php //foreach ($page_image as $key => $value) { ?>
							<?php $image =  base_url().'assets/images/iziheader.jpg';//base_url() . 'uploads/images/' . $page_detail->type . '/' . 'full' . '/' . $value->file_name; ?>
							<?php // } ?>
							<div class="kl-bg-source__bgimage" style="background-image:url(<?php echo $image;?>);background-repeat:no-repeat;background-attachment:scroll;background-position-x:center;background-position-y:center;background-size:cover"></div>
						<?php // }  ?>                     
                        <div class="kl-bg-source__overlay"
					style="background: rgba(30, 115, 190, 0.3); background: -moz-linear-gradient(left, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(30, 115, 190, 0.3)), color-stop(100%, rgba(53, 53, 53, 0.3))); background: -webkit-linear-gradient(left, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%); background: -o-linear-gradient(left, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%); background: -ms-linear-gradient(left, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%); background: linear-gradient(to right, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%);"></div>
			</div>
			<div class="th-sparkles"></div>
		</div>
		<div class="static-content__inner container">
			<div class="kl-slideshow-safepadding sc__container ">
				<div class="row" style="margin-top: 115px;">
					<div class="col-sm-6">
						<ul class="breadcrumbs fixclear"><?php if($breadcrumbs) { ?>
							<?php foreach ($breadcrumbs as $breadcrumb) { ?>
<?php $link = "#";if(($breadcrumb->guid !== 'profile')&&($breadcrumb->guid !== 'program')&&($breadcrumb->guid !== 'layanan')) $link = base_url().$breadcrumb->guid;
?>
							<li><a href="<?php echo $link;?>"><?php echo $breadcrumb->menu;?></a></li>
							<?php }}?>
						</ul>
						<span id="current-date" class="subheader-currentdate"><?php echo date('M d Y');?></span>
						<div class="clearfix"></div>
					</div>
					<div class="col-sm-6">
						<div class="subheader-titles"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kl-bottommask kl-bottommask--shadow_ud"></div>
</div>
</div>
<section class="hg_section ptop-0 pbottom-0">
	<div class="container">
		<div class="row">
			<div class="col-md-1 col-sm-12"></div>
			<div class="col-md-10 col-sm-12">

				<section class="hg_section ptop-50">
					<div class="container">
						<div class="row">
							<div class="col-md-10 col-sm-10">
								<div class="itemListView clearfix eBlog">
									<div class="itemList">
										<div class="itemContainer">
											<div class="itemHeader">
												<h3 class="itemTitle">
													<a class="itemTitlea"><?php echo $page_detail->content[$this->language_id]->title; ?></a>
												</h3>
											</div>
											<div class="itemBody">
												<?php if($breadcrumb->guid === 'legal'){?>
													<div class="bs-docs-example">
													<table class="table table-hover">
														</thead>
														<tbody>
															<tr>
																<td>1</td>
																<td><a class="popup-with-form" href="#dowload1">Akta Notaris Pendirian Yayasan Inisiatif Zakat Indonesia</a></td>
															</tr>
															<tr>
																<td>2</td>
																<td><a class="popup-with-form" href="#dowload2">Surat Kemenkumham 25 Mei 2015</a></td>
															</tr>
															<tr>
																<td>3</td>
																<td><a class="popup-with-form" href="#dowload3">SK Kemenkumham Yayasan Inisiatif Zakat Indonesia</a></td>
															</tr>
															<tr>
																<td>4</td>
																<td><a class="popup-with-form" href="#dowload4">SK Kemenag</a></td>
															</tr>
														</tbody>
													</table>
												</div>
												<?php }?>
												<?php if($breadcrumb->guid === 'kalkulator'){?>
													<div class="row">
													<div class="col-sm-12">
														<div id="submitedzakat" class="kl-store-page kl-store">
															<form id="calculator-zakat" method="post"
																enctype="multipart/form-data"
																action="<?php echo base_url()?>process/zakat">
																<div class="vertical_tabs kl-style-2 clearfix">
																	<div class="tabbable">
																		<ul style="width: 33%; font-size: 12px;"
																			class="nav fixclear">
																			<li class="active"><a aria-expanded="false"
																				href="#tabs_i2-pane1" data-toggle="tab">Perhitungan
																					Nisab</a></li>
																			<li class=""><a aria-expanded="false"
																				href="#tabs_i2-pane2" data-toggle="tab">Zakat Harta Simpanan</a></li>																			
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane3" data-toggle="tab">Zakat
																					Perniagaan (Harta Dagang)</a></li>
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane4" data-toggle="tab">Zakat
																					Profesi</a></li>																		
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane6" data-toggle="tab">Zakat
																					Pertanian</a></li>
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane7" data-toggle="tab">Zakat
																					Sewa Aset</a></li>
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane5" data-toggle="tab">Total Zakat</a></li>
																		</ul>
																		<div style="width: 75%; font-size: 13px;"
																			class="tab-content">

																			<div class="tab-pane active" id="tabs_i2-pane1">
																				<h4>PERHITUNGAN NISAB</h4>
																				<p>																		
																				<div class="col-md-12">
																					Harga Emas Murni Saat ini per Gram, untuk
																					mengetahui harga emas saat ini, salah satunya Anda
																					dapat mengunjungi <a
																						href="http://www.logammulia.com/gold-id.php"
																						target="_blank"><strong>situs ini</strong></a>
																				</div>
																				<div class="col-md-6">
																					<p class="form-row form-row-wide">
																						<label>Perhitungan Nisab </label> <input
																							class="zakat-input input-text" name="harga_emas"
																							id="harga_emas" value="0" type="text">
																					</p>
																				</div>
																				<div class="col-md-6">
																					<p class="form-row form-row-wide">
																						<label>Besarnya Nisab <i>(85 gram emas)</i>
																						</label> <span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="besar_nisab" id="besar_nisab">0</span> <input
																							name="besar_nisab" id="besar_nisab" type="hidden">
																					</p>
																				</div>
																				</p>


																			</div>
																			<div class="tab-pane" id="tabs_i2-pane2">
																				<h4>ZAKAT HARTA SIMPANAN</h4>
																				<p>
																				
																				<div class="col-md-12" style="padding-bottom:15px;">
																					Pastikan anda telah mengisi perhitungan nisab terlebih dahulu pada tab <a 
																				href="#tabs_i2-pane1" data-toggle="tab"><strong>"perhitungan nisab"</strong></a>, apabila telah terisi silahkan lanjutkan proses perhitungan zakat anda.
																				</div>
																				<div class="col-md-8">																				
																					<p class="form-row form-row-wide">
																						<label>Uang Tunai, Tabungan <a class="calc-tooltip" href="#" data-toggle="tooltip" data-placement="bottom"
															                               title="Uang simpanan dikenakan zakat dari jumlah saldo akhir bila telah mencapai nishab dan berjalan selama 1 tahun. Besarnya nishab senilai 85 gram emas. Kadar zakat yang dikeluarkan adalah 2,5%. Apabila uang simpanannya di bank konvensional, ketika akan membayar zakat, maka sisihkan terlebih dahulu bunga banknya karena bunga bank termasuk riba yang diharamkan. Dan apabila uang simpanannya di bank Syariah, bagi hasil termasuk dalam komponen yang dihitung dalam penghitungan zakatnya karena bagi hasil bukan bunga bank yang diharamkan."><i style="padding-left: 5px;" class="glyphicon glyphicon-info-sign" ></i>
															                            </a></label>																						 
																						<input
																							class="zakat-input input-text" name="tabungan"
																							id="tabungan" value="0">
																							<span style="color:#ff0000;" id="error_nisab"></span>
																					</p>
																					</div>
																					<div class="col-md-4">
																					<p class="form-row form-row-wide">
																						<label>Bunga (konvensional)
																							<a class="bunga-tooltip" href="#" data-toggle="tooltip" data-placement="bottom"
															                               title="Diisi apabila menabung/menyimpan di bank konvensional dan dicatat dalam angka"><i style="padding-left: 5px;" class="glyphicon glyphicon-info-sign" ></i>
															                            </a> 
																						</label> <input
																							class="zakat-input input-text" name="bunga"
																							id="bunga" value="0">
																					</p>
																					</div>
																					<div class="col-md-12">
																					<p class="form-row form-row-wide tooltip-wide">
																						<label>Deposito, Saham atau surat-surat berharga lainnya
																							<a class="calc-tooltip" href="#" data-toggle="tooltip" data-placement="bottom"
															                               title="Ketentuan zakat Deposito :    
a. Penghitungan zakat deposito, pendekatannya adalah dengan zakat peniagaan, karena seseorang yang menyimpan uangnya sebagai deposito atau saham sudah berniat untuk mendapatkan keuntungan. Dan niat mendapatkan keuntungan adalah salah satu syarat dalam zakat perniagaan.  
b. Nisabnya setara dengan 85gram emas 
c. Cukup haul 1 tahun 
d. Dari sumber yang halal (bunga bank tidak dihitung), jadi hanya deposito Syariah saja yang dapat dibayarkan zakatnya. 
Cara penghitungannya adalah nilai pokok deposito atau saham + bagi hasil x 2,5% "><i style="padding-left: 5px;" class="glyphicon glyphicon-info-sign" ></i>
															                            </a> 
																						</label>
																						<input class="zakat-input input-text" name="saham"
																							id="saham" value="0">
																							<span style="color:#ff0000;" id="error_nisab"></span>
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Emas, Perak, Permata atau sejenisnya 
																							<a class="calc-tooltip" href="#" data-toggle="tooltip" data-placement="bottom"
															                               title="a. Zakat Emas 
1. Nishab zakat emas adalah 85 gram emas. 
2. Haul selama 1 tahun. 
3. Kadar yang wajib dikeluarkan zakatnya adalah 2,5%.
4. Perhiasan yang wajib dikeluarkan zakat adalah perhiasan yang disimpan dan tidak  dipakai, selain itu maka tidak wajib dikeluarkan zakat. b. Zakat Perak:
1. Nishab zakat perak adalah 595 gram. 
2. Haul selama 1 tahun. 
3. Kadar yang wajib dikeluarkan zakatnya adalah 2,5%. 
4. Cara penghitungan sama dengan penghitungan zakat emas."><i style="padding-left: 5px;" class="glyphicon glyphicon-info-sign" ></i>
															                            </a> 
																						</label>
																						<input class="zakat-input input-text"
																							name="perhiasan" id="perhiasan" value="0">
																							<span style="color:#ff0000;" id="error_nisab"></span>
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Mobil (lebih dari keperluan pekerjaan
																							anggota keluarga) </label> <input
																							class="zakat-input input-text" name="kendaraan"
																							id="kendaraan" value="0">
																							<span style="color:#ff0000;" id="error_nisab"></span>
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Jumlah Total Harta Simpanan </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="total_simpanan" id="total_simpanan">0</span>
																						<input name="total_simpanan" id="total_simpanan"
																							type="hidden">
																					</p>
																				</div>
																				<div class="col-md-12">
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT ATAS SIMPANAN YANG
																								WAJIB DIBAYARKAN</strong><br />(2,5% x
																							harta simpanan kena zakat) </label> <span
																							style="float: left; margin-top: 2px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_pribadi" id="zakat_pribadi">0</span>
																							<br><br><span id='shodaqoh' style="padding-top: 10px;"></span>
																						<input name="zakat_pribadi" id="zakat_pribadi"
																							type="hidden">																					
																					</p>																																
																				</div>
																				<div class="col-md-12"
																						style="padding-top: 5px; padding-bottom: 5px;">
																						<p class="form-row form-row-wide pull-right"
																							style="padding-top: 5px;">
																							<span id='payharta'></span>
																						</p>
																					</div>
																				</p>


																			</div>
																			<div class="tab-pane" id="tabs_i2-pane3">
																				<h4>ZAKAT PERNIAGAAN (HARTA DAGANG)</h4>
																				<p>
																				<div class="col-md-12" style="padding-bottom:15px;">
																					Pastikan anda telah mengisi perhitungan nisab terlebih dahulu pada tab <a 
																				href="#tabs_i2-pane1" data-toggle="tab"><strong>"perhitungan nisab"</strong></a>, apabila telah terisi silahkan lanjutkan proses perhitungan zakat anda.
																				</div>
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>Nilai Kekayaan Dagang
																							 <a class="calc-tooltip" href="#" data-toggle="tooltip" data-placement="bottom"
															                               title="Ketentuan Zakat Perniagaan: 

1. Nishab zakat niaga adalah senilai dengan 85 gram emas,
2. Usaha tersebut telah berjalan selama 1 tahun Hijriyah,
3. Kadar yang dikeluarkan adalah 2,5%,
4. Dapat dibayarkan dengan uang atau barang,
5. Dikenakan pada perdagangan maupun perseroan,

5. Cara Menghitung Zakat Perniagaan:
(Modal diputar + keuntungan + piutang) – (hutang + kerugian)  x 2,5% = Zakat"><i style="padding-left: 5px;" class="glyphicon glyphicon-info-sign" ></i>
															                            </a>
																						<br />(modal diputar + keuntungan + piutang)
																						</label> <input class="zakat-input input-text"
																							name="kekayaan_perusahaan"
																							id="kekayaan_perusahaan" value="0">
																							<span style="color:#ff0000;" id="error_nisab2"></span>
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Hutang dagang jatuh tempo (hutang + keruagian) </label> <input
																							class="zakat-input input-text"
																							name="hutang_perusahaan" id="hutang_perusahaan"
																							value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Jumlah Bersih Harta Dagang<br />Nilai kekayaan usaha dikurangi
																							utang usaha jatuh tempo
																						</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="total_kekayaan_perusahaan"
																							id="total_kekayaan_perusahaan">0</span> <input
																							name="total_kekayaan_perusahaan"
																							id="total_kekayaan_perusahaan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Harta dagang kena zakat<br />(jumah bersih
																							harta dagang jika mencapai Nisab)
																						</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="selisih_kekayaan_perusahaan"
																							id="selisih_kekayaan_perusahaan">0</span> <input
																							name="selisih_kekayaan_perusahaan"
																							id="selisih_kekayaan_perusahaan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT ATAS HARTA DAGANG YANG
																								WAJIB DIBAYARKAN</strong> </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_perusahaan" id="zakat_perusahaan">0</span>
																							<br><br><span id='shodaqohp' style="padding-top: 10px;"></span>
																						<input name="zakat_perusahaan"
																							id="zakat_perusahaan" type="hidden">
																					</p>																					
																				</div>
																				<div class="col-md-12"
																						style="padding-top: 5px; padding-bottom: 5px;">
																						<p class="form-row form-row-wide pull-right"
																							style="padding-top: 5px;">
																							<span id='payperusahaan'></span>
																							<span id='payperusahaanp'></span>
																						</p>
																					</div>
																				</p>


																			</div>
																			<div class="tab-pane" id="tabs_i2-pane4">
																				<h4>ZAKAT PROFESI</h4>
																				<p>
																				<div class="col-md-12">
																					Nishab zakat profesi : <strong>653 kg</strong> beras,
																					harga beras yang ditentukan dan disepakati oleh IZI adalah senilai <strong><?php echo 'Rp. '.number_format($nisab->nisab_base, 0, ',', '.'); ?></strong> 
																					per kilogram sehingga nisab zakat profesi saat ini adalah senilai <strong><?php echo 'Rp. '.number_format($nisab->nisab_base * 653, 0, ',', '.'); ?></strong>
																					<input name="nisab_profesix" id="nisab_profesix" type="hidden" value="<?php echo $nisab->nisab_base * 653; ?>">
																				</div>
																				
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>Pendapatan / Gaji per Bulan (setelah
																							dipotong pajak) </label> <input
																							class="zakat-input input-text" name="pendapatan"
																							id="pendapatan" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Bonus/THR/pendapatan lain-lain</label>
																						<input class="zakat-input input-text" name="bonus"
																							id="bonus" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Jumlah Pendapatan </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="total_pendapatan" id="total_pendapatan">0</span>
																						<input name="total_pendapatan"
																							id="total_pendapatan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT PROFESI YANG WAJIB
																								DIBAYARKAN</strong><br />(2,5% dikali
																							penghasilan kena zakat) </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_profesi" id="zakat_profesi">0</span>
																						<input name="zakat_profesi" id="zakat_profesi"
																							type="hidden">
																						<br><br><span id='shodaqohpr' style="padding-top: 10px;"></span>
																					</p>																					
																				</div>
																				<div class="col-md-12"
																					style="padding-top: 5px; padding-bottom: 5px;">
																					<p class="form-row form-row-wide pull-right"
																						style="padding-top: 5px;">
																						<span id='payprofesi'></span>
																						<span id='payprofesip'></span>
																					</p>
																				</div>
																				</p>
																			</div>
																			<div class="tab-pane" id="tabs_i2-pane5">
																				<h4>TOTAL ZAKAT</h4>
																				<p>
																				
																				
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>JUMLAH ZAKAT HARTA SIMPANAN</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="pribadi" id="pribadi">0</span> <input
																							name="pribadi" id="pribadi" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>JUMLAH ZAKAT PERNIAGAAN (HARTA DAGANG) </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="perusahaan" id="perusahaan">0</span> <input
																							name="perusahaan" id="perusahaan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>JUMLAH ZAKAT PROFESI </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="profesi" id="profesi">0</span> <input
																							name="profesi" id="profesi" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>JUMLAH ZAKAT PERTANIAN </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="pertanian" id="pertanian">0</span> <input
																							name="pertanian" id="pertanian" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>JUMLAH ZAKAT INVESTASI (AL-MUSTAGHALLAT) </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="lainnya" id="lainnya">0</span> <input
																							name="lainnya" id="lainnya" type="hidden">
																					</p>
																				</div>
																				<div class="col-md-12"
																					style="padding-top: 10px; padding-bottom: 20px;">
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label style="font-weight: 600;">TOTAL ZAKAT YANG
																							HARUS ANDA BAYARKAN </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid rgb(254, 233, 0);; padding: 5px 10px; background-color: rgb(254, 233, 0);; border-radius: 3px;"
																							name="total" id="total"><b>0</b></span> <input
																							name="total" id="total" type="hidden">
																					</p>
																				</div>
																				<div class="col-md-12"
																					style="padding-top: 5px; padding-bottom: 5px;">
																					<p class="form-row form-row-wide pull-right"
																						style="padding-top: 5px;">
																						<span id='paytotal'></span>
																					</p>
																				</div>
																				</p>


																			</div>
																			<div class="tab-pane" id="tabs_i2-pane6">
																				<h4>ZAKAT PERTANIAN</h4>
																				<p>
																				
																				<div class="col-md-12" style="padding-bottom:20px;">
																					Nishab zakat pertanian : <strong>653 kg</strong> beras,
																					harga beras yang ditentukan dan disepakati oleh IZI adalah senilai <strong><?php echo 'Rp. '.number_format($nisab->nisab_base, 0, ',', '.'); ?></strong> 
																					per kilogram sehingga nisab zakat pertanian saat ini adalah senilai <strong><?php echo 'Rp. '.number_format($nisab->nisab_base * 653, 0, ',', '.'); ?></strong>																			
																					<input																							
																							name="harga_pangan" id="harga_pangan" value="<?php echo $nisab->nisab_base * 653; ?>"
																							type="hidden">
																				</div>
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>Total hasil panen (Kg), jika tanaman yang
																							diairi <strong>dengan bantuan</strong> alat
																							pengangkut air dan beban biaya yang besar (5%)
																						</label> <input class="zakat-input input-text"
																							name="pertanianlima" id="pertanianlima" value="0">
																					</p>
																				</div>
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>Total hasil panen (Kg), jika tanaman yang
																							diairi <strong>tanpa</strong> alat pengangkut air
																							dan beban biaya yang besar (10%)
																						</label> <input class="zakat-input input-text"
																							name="pertaniansepuluh" id="pertaniansepuluh"
																							value="0">
																					</p>
																				</div>
																				<div class="col-md-12">
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT PERTANIAN YANG WAJIB
																								DIBAYARKAN PADA SAAT PANEN</strong> </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_pertanian" id="zakat_pertanian">0</span>
																						<input name="zakat_pertanian" id="zakat_pertanian"
																							type="hidden">
																						<br><br><span id='shodaqoht' style="padding-top: 10px;"></span>
																					</p>
																				</div>
																				</p>
																				<div class="col-md-12"
																					style="padding-top: 10px; padding-bottom: 5px;">
																					<p class="form-row form-row-wide pull-right"
																						style="padding-top: 20px;">
																						<span id='paytani'></span>
																						<span id='paytanip'></span>
																					</p>
																				</div>
																			</div>
																			<div class="tab-pane" id="tabs_i2-pane7">
																				<h4>ZAKAT INVESTASI atau AL-MUSTAGHALLAT (SEWA RUMAH, MOBIL, GEDUNG dan LAIN_LAIN)</h4>
																				<p>																		
																				<div class="col-md-12" style="padding-bottom:20px;">
																					Nishab zakat Investasi (Sewa Aset) : <strong>653 kg</strong> beras,
																					harga beras yang ditentukan dan disepakati oleh IZI adalah senilai <strong><?php echo 'Rp. '.number_format($nisab->nisab_base, 0, ',', '.'); ?></strong> 
																					per kilogram sehingga nisab zakat Investasi (Sewa Aset) saat ini adalah senilai <strong><?php echo 'Rp. '.number_format($nisab->nisab_base * 653, 0, ',', '.'); ?></strong>																			
																				</div>
																				<div class="col-md-12" style="padding-top: 10px;">
																					<p class="form-row form-row-wide">
																						<label>Total penghasilan dari Sewa Aset
																						 <a class="calc-tooltip" href="#" data-toggle="tooltip" data-placement="bottom"
															                               title="Zakat investasi memiliki kemiripan dengan yang berlaku dalam penghitungan zakat hasil tani, oleh karenanya penghitungan zakat investasi dilakukan dengan cara menganalogikan kepada zakat hasil tani. 
Dengan ketentuan sebagai berikut: 
1. Nishab zakat investasi adalah 5 wasaq sama dengan 653 kg beras.
Jika beras per kg nya adalah Rp 10.000,- 
maka 653 kg x Rp 10.000,- = Rp 6.530.000,-   
2. Kadarnya sebanyak 5%,
3. Dibayarkan ketika panen/ menghasilkan."><i style="padding-left: 5px;" class="glyphicon glyphicon-info-sign" ></i>
															                            </a>
																						</label>
																						<input class="zakat-input input-text"
																							name="total_hadiah" id="total_hadiah" value="0"
																							type="text">
																					</p>
																				</div>
																				<div class="col-md-12">
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT PENYEWAAN ASET
																								YANG WAJIB DIBAYARKAN</strong> </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_hadiah" id="zakat_hadiah">0</span> <input
																							name="zakat_hadiah" id="zakat_hadiah"
																							type="hidden">
																							<br><br><span id='shodaqohs' style="padding-top: 10px;"></span>
																					</p>
																				</div>
																				</p>
																				<div class="col-md-12"
																					style="padding-top: 5px; padding-bottom: 5px;">
																					<p class="form-row form-row-wide pull-right"
																						style="padding-top: 5px;">
																						<span id='payother'></span>
																						<span id='payotherp'></span>
																					</p>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
														
														</div>
														</form>
													</div>

												</div>
												<?php }?>
												<?php if($breadcrumb->guid !== 'hubungi'){?>
												<?php echo $page_detail->content[$this->language_id]->body; ?>
												<?php }?>
												<br />
												<?php if($breadcrumb->guid === 'panduan-zakat'){?>
													<object src="<?php echo base_url()?>assets/pdf/panduan.pdf">
													<embed src="<?php echo base_url()?>assets/pdf/panduan.pdf"
														width="100%" height="998px">
													</embed>
												</object>
												<?php }?>
												<?php if($breadcrumb->guid === 'hubungi'){?>
												<?php if($this->language_id=='107') { ?>
												<div class="col-md-12 office">													 
													<ul class="office-menu">												
														<li><a href="<?php echo base_url().'gerai-ramadhan';?>"><span class="glyphicon glyphicon-map-marker icon-green xs-icon"></span><strong>IZI Outlets --></strong><strong style="color: #ff0000;"> Click Here</strong></a></li>
														<li><a><strong>HEADQUARTERS</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl Raya Condet No 54 D-E Batu Ampar, East Jakarta 13520</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Phone 021-87 787 603</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone icon-green xs-icon"></span>
																SMS Center: 085 8887 23456</a></li>
														<li><a><span
																class="glyphicon glyphicon-comment icon-green xs-icon"></span>
																Whatsapp: 0812 1414 789</a></li>
														<li><a><span
																class="glyphicon glyphicon-envelope icon-green xs-icon"></span>
																Email: salam@izi.or.id</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone icon-green xs-icon"></span>
																BBM: 5CA1489E</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of East Java</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Ngagel Jaya Utara 66 Gubeng Surabaya 60283</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 031-5023995</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office in Central Java</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Setiabudi no. 70 Semarang</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 024-7475140</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office  of West Java</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Cikutra No. 138 Bandung</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 022-720-5501</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of the Special Region of Yogyakarta</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Prof. Dr. Sardjito no. 4 Yogyakarta</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0274-561525</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of East Kalimantan</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Soekarno Hatta Km.2 Muara Rapak, Urata Balikpapan, Kota Balikpapan</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0542-7586620</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of North Kalimantan</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Yos Sudarso No.28 Selumit, Tarakan 77113</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone. 0542-7586620</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of Central Sulawesi</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Juanda 1 no. 1A district. East Palu, Palu, 94112</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0451-455-473</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of Southeast Sulawesi</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. MT Haryono no. 104C (Front New Market) district. Kadia, Kendari</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0401-319-5763</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of South Sulawesi</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Tamalate 1 no. 3</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0411-960711</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Maluku Representative Office</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Cloves Gardens BTN. Manusela B block no. 5-6 Air Kuning village of Batu Merah district. Sirimau Ambon City, 97128</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0911-312-658</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of Bengkulu</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Merapi Raya no. 92 Panorama</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0736-26425</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of Lampung</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Z A. Pagaralam no. 4 Rajabasa Bandar Lampung</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0721-8013400</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative Office of West Sumatra</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Raya Bypass no 16B  Pasar Ambacang Kuranji Padang 25152</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0751-779260</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Riau Representative Office</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Pope Edge, Simpang Arifin Ahmad no.1B, Tangerang West kel kec Marpoyan Peace, Pekanbaru</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 0761-8416191</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative office of North Sumatra</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Setia Budi no. 272 B, Tanjung Sari, Medan</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																phone 061-8229273</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Representative office of Banten</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Hanjuang Raya Sektor 1.1 Blok B4-38, Tanggerang  Selatan 15310</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Phone  (021) 538 1741</a></li>
													</ul>
												</div>
														<?php } ?>
														<?php if($this->language_id=='125') { ?>
												<div class="col-md-12 office">													 
													<ul class="office-menu">												
														<li><a href="<?php echo base_url().'gerai-ramadhan';?>"><span class="glyphicon glyphicon-map-marker icon-green xs-icon"></span><strong>IZI Outlets --></strong><strong style="color: #ff0000;"> Click Here</strong></a></li>
														<li><a><strong>KANTOR PUSAT</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl Raya Condet No 54 D-E Batu Ampar Jakarta Timur 13520</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 021-87 787 603</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone icon-green xs-icon"></span>
																SMS Center: 085 8887 23456</a></li>
														<li><a><span
																class="glyphicon glyphicon-comment icon-green xs-icon"></span>
																Whatsapp: 0812 1414 789</a></li>
														<li><a><span
																class="glyphicon glyphicon-envelope icon-green xs-icon"></span>
																Email: salam@izi.or.id</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone icon-green xs-icon"></span>
																BBM: 5CA1489E</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Jawa Timur</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Ngagel Jaya Utara 66 Gubeng Surabaya 60283</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 031-5023995</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Jawa Tengah</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Setiabudi no. 70 Semarang</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 024-7475140</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Jawa Barat</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Cikutra No. 138 Bandung</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 022-720-5501</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Daerah Istimewa Yogyakarta</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Prof. Dr. Sardjito no. 4 Yogyakarta</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0274-561525</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Kalimantan Timur</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Soekarno Hatta Km.2 Muara Rapak, Urata Balikpapan, Kota Balikpapan</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0542-7586620</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Kalimantan Utara</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Yos Sudarso No.28 Selumit, Tarakan 77113</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon. 0542-7586620</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Sulawesi Tengah</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Juanda 1 no. 1A Kec. Palu Timur, Kota Palu, 94112</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0451-455-473</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Sulawesi Tenggara</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. MT Haryono no. 104C (Depan Pasar Baru) Kec. Kadia, Kendari</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0401-319-5763</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Sulawesi Selatan</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Tamalate 1 no. 3</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0411-960711</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Maluku</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Kebun Cengkeh BTN. Manusela blok B no. 5-6 Air Kuning Desa Batu Merah Kec. Sirimau Kota Ambon, 97128</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0911-312-658</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Bengkulu</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Merapi Raya no. 92 Panorama</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0736-26425</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Lampung</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Z A. Pagaralam no. 4 Rajabasa Bandar Lampung</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0721-8013400</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Sumatera Barat</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Raya Bypass no 16B  Pasar Ambacang Kuranji Padang 25152</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0751-779260</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Riau</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Paus Ujung, Simpang Arifin Ahmad no.1B, kel Tangerang Barat kec Marpoyan Damai, Pekanbaru</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 0761-8416191</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan Sumatera Utara</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Setia Budi no. 272 B, Tanjung Sari, Medan</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon 061-8229273</a></li>
													</ul>
												</div>
												<div class="col-md-12 office">
													<ul class="office-menu">
														<li><a><strong>Kantor Perwakilan  Banten</strong></a></li>
														<li><a><span
																class="glyphicon glyphicon-map-marker icon-green xs-icon"></span>
																Jl. Hanjuang Raya Sektor 1.1 Blok B4-38, Tanggerang  Selatan 15310</a></li>
														<li><a><span
																class="glyphicon glyphicon-phone-alt icon-green xs-icon"></span>
																Telepon  (021) 538 1741</a></li>
													</ul>
												</div>
														<?php } ?>							
												<?php }?>
												
												<?php if($breadcrumb->guid === 'confirm'){?>
													<div class="col-md-1"></div>
												<div class="col-md-11">
													<p>Silahkan lengkapi form dibawah untuk konfirmasi setoran
														zakat/infaq anda
													<br /><a class="popup-with-form" href="#test-form"><b>LOGIN</b></a> untuk mempersingkat waktu pada pembayaran berikutnya dan menikmati fasilitas IZI lainnya (Bagi anda yang telah memiliki akun di PKPU dapat langsung melakukan proses login). Belum Terdaftar? Silahkan <a href="<?php echo base_url()?>register"><b>SIGN UP</b></a></p>
												</div>
												<style>
<!--
.required {
	color: #ff0000;
}

label {
	font-weight: 400;
	font-size: 14px;
}

input {
	box-sizing: border-box;
	width: 100%;
	margin-bottom: 8px;
	border: 1px solid #d8d8d8;
	padding: 7px 10px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
	border-radius: 3px;
}

textarea {
	border: 1px solid #d8d8d8;
	height: auto;
	min-height: 30px;
	padding: 7px 10px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
	border-radius: 3px;
}

input[type="submit"] {
	background: #a2ca2b;
	font-family: open sans;
	width: 100%;
	font-size: 15px !important;
	padding: 10px 0px;
	font-weight: 700;
	color: #fff;
	text-transform: uppercase;
	text-shadow: none;
	border-radius: 3px;
	box-shadow: none;
	position: relative;
	border: 0;
	line-height: 1;
}

input[type="submit"]:hover {
	background-color: #769B08;
}

select {
	border: 1px solid #d8d8d8;
	background: #fff;
	padding-left: 4px;
	width: 100%;
	height: 38px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
}

.captcha-image {
	display: block;
	float: left;
	width: 100%;
	border: 1px solid #e1e1e1;
	box-sizing: border-box;
	-moz-box-sizing: border-box;
}

.change-image {
	display: block;
	float: left;
	width: 100%;
	height: 14px;
	color: #252525;
	margin: 0 0 10px 0;
	cursor: pointer;
}
-->
</style>

												<div class="row">
													<div class="col-md-1"></div>
													<div class="right_sidebar col-md-9">
														<div class="kl-store"><!-- id="confirm-form" -->
															<form id="confirm-form" method="post" class="login"
																enctype="multipart/form-data"
																action="<?php echo base_url()?>process/donation/confirm">
																<div class="col-md-12">
																	<p id="other"></p>
																</div>	
						<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input name="member_id" type="hidden"
																	value="<?php echo $user->member_id;?>">
						<?php }?>					
						<div class="col-md-12">
																	<p class="form-row form-row-wide" id="jpayment">
																		<label for="branch">Jenis Pembayaran<span
																			class="required">*</span>
																		</label> <select id="jpayment" name="pembayaran">																	
																			<option style="padding: 8px;" value="3">Zakat Profesi</option>	
																			<option style="padding: 8px;" value="1">Zakat Harta</option>																		
																			<option style="padding: 8px;" value="4">Zakat Fitrah</option>
																			<option style="padding: 8px;" value="5">Zakat Lainnya</option>
																			<option style="padding: 8px;" value="7">Infaq & Shadaqoh</option>
																			<option style="padding: 8px;" value="13">Fidyah/Kafarat</option>
																			<option style="padding: 8px;" value="14">Qurban</option>
																		</select>
																	</p>
																	<p class="form-row form-row-wide" id="email">
																		<label for="email">Email<span class="required">*</span>
																		</label> 
							<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input class="input-text" name="email" id="email" type="text"
																			value="<?php echo $user->email;?>">
							<?php } else {?>
							<input class="input-text" name="email" id="email" type="text">
							<?php }?>
						</p>
																	<p class="form-row form-row-wide" id="name">
																		<label for="firstname">Nama Pemilik Rekening<span
																			class="required">*</span>
																		</label> 
							<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input class="input-text" name="name" id="name" type="text"
																			value="<?php echo $user->first_name.' '.$user->last_name;?>">
							<?php } else {?>
							<input class="input-text" name="name" id="name" type="text">
							<?php }?>
						</p>
																	<p class="form-row form-row-wide" id="nokontak">
																		<label for="nokontak">No Kontak<span class="required">*</span>
																		</label> 
							<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input class="input-text" name="nokontak" id="nokontak"
																			type="text" value="<?php echo $user->contact;?>">
							<?php } else {?>
							<input class="input-text" name="nokontak" id="nokontak"
																			type="text">
							<?php }?>
						</p>
																</div>
																<div class="col-md-5">
																	<p class="form-row form-row-wide" id="frombank">
																		<label for="branch">No Rekening Asal<span
																			class="required">*</span>
																		</label> <input class="input-text" name="frombank"
																			id="frombank" type="text">
																	</p>
																</div>
																<div class="col-md-7">
																	<p class="form-row form-row-wide" id="tobank">
																		<label for="branch">No Rekening Tujuan<span
																			class="required">*</span>
																		</label> <select id="tobank" name="tobank">
																			<option style="padding: 8px; color: #a2ca2b;"
																				value="0">----- Rekening Zakat -----</option>
																			<option style="padding: 8px;" value="1">BCA -
																				5395.500.900</option>
																			<option style="padding: 8px;" value="2">Mandiri -
																				122.002.80000.68</option>
																			<option style="padding: 8px;" value="3">Syariah
																				Mandiri - 789.789.1217</option>
																			<option style="padding: 8px;" value="4">BNI Syariah -
																				121.555.3331</option>
																			<option style="padding: 8px;" value="5">BNI -
																			5000.121.00</option>
																			<option style="padding: 8px;" value="6">Muamalat -
																				301.01.666.14</option>
																			<option style="padding: 8px;" value="7">Permata Syariah -
																				121.873.2727</option>
																			<option style="padding: 8px;" value="8">BJB -
																				523.0102.000.127</option>
																				
																			<option style="padding: 8px; color: #a2ca2b;"
																				value="0">----- Rekening Infaq -----</option>
																				
																			<option style="padding: 8px;" value="9">BCA -
																				5395.100.600</option>
																			<option style="padding: 8px;" value="10">Mandiri -
																				122.002.70000.10</option>
																			<option style="padding: 8px;" value="11">Syariah
																				Mandiri - 777.888.1211</option>
																			<option style="padding: 8px;" value="12">BNI Syariah -
																				121.555.4448</option>
																			<option style="padding: 8px;" value="13">BNI -
																			700.121.009</option>
																			<option style="padding: 8px;" value="14">Muamalat -
																				301.01.666.15</option>
																			<option style="padding: 8px;" value="15">Permata Syariah -
																				121.873.2700</option>
																		</select>
																	</p>
																</div>
																<div class="col-md-12">
																	<p class="form-row form-row-wide" id="amount">
																		<label for="firstname">Jumlah Dana<span
																			class="required">*</span>
																		</label> <input class="input-text" name="amount"
																			id="amount" type="text">
																	</p>
																	<p class="form-row form-row-wide" id="date">
																		<label for="firstname">Tanggal Pembayaran<span
																			class="required">*</span>
																		</label>
																	
																	
																	<div id="datetimepicker4" class="input-append date"
																		style="padding-top: 10px;">
																		<input type="text" id="date" name="date"
																			style="width: 95%; height: 40px;"></input> <span
																			class="add-on" style="height: 30px; float: right;"> <i
																			data-time-icon="icon-time"
																			data-date-icon="icon-calendar"></i>
																		</span>
																	</div>
																	</p>
																	<p class="form-row form-row-wide" id="note">
																		<label for="address">Keterangan </label>
																		<textarea class="input-text" name="note" id="note"
																			type="text"></textarea>
																	</p>
																	<p class="form-row form-row-wide" id="ptcha">
																	
																	
																	<div class="col-md-6">
																		<img src="<?php echo base_url(); ?>captcha/confirm"
																			class="captcha-image" id="captcha-image" /> <a
																			data-src="<?php echo base_url(); ?>captcha/confirm"
																			class="change-image" id="change-image">Change text</a>
																		</span>
																	</div>
																	<div class="col-md-6">
																		<input type="text" name="captcha" class="captcha-form"
																			id="captcha-form" placeholder="Type the Image Here" />
																		</span>
																	</div>
																	</p>
																</div>
																<div class="col-md-1"></div>
																<div class="col-md-10">
																	<p class="form-row form-row-wide"
																		style="padding-top: 20px;">
																		<input name="confirm" value="Konfirmasi" type="submit"
																			id="load">
																	</p>
																</div>
																<div class="col-md-1">
																	<p style="padding-top: 2px;">
																	
																	
																	<div id="loading"></div>
																	</p>
																</div>
																<p class="form-row form-row-wide"></p>
															</form>
														</div>
													</div>
													<div class="col-md-3"></div>
												</div>
													
													
												<?php }?>
											</div>
											<div class="clear"></div>
										</div>
										<div class="clear"></div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
			
			</div>

</section>
</div>
</div>
</div>
</section>
<script type="text/javascript">
$('#load').on('click',function(){
    // Adding loading GIF
    $('#loading').html('<label><img id="loader" src="<?php echo base_url()?>assets/images/484.gif"/></label>');
 
});							
</script>
