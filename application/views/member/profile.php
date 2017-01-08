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
					<div class="row">
						<div class="col-sm-6">
							<ul class="breadcrumbs fixclear">
								<li>MY ACCOUNT</li>
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
	</div>
	<div class="kl-bottommask kl-bottommask--shadow_ud"></div>
</div>
</div>
<style>
<!--
.required {
	color: #ff0000;
}

label {
	font-weight: 400;
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
input {
	box-sizing: border-box;
	/* 	width: 100%; */
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

select {
	background-color: #fff;
	border: 1px solid #d8d8d8;
	height: auto;
	/* min-height: 30px;
	padding: 7px 10px; */
	padding-left:10px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
	border-radius: 3px;
}
-->
</style>
<section class="hg_section ptop-80 pbottom-80">
	<div class="hg_section_size container">
		<div class="row">
			<?php if($user->active==2){?>
			<div class="col-md-12 col-sm-12">
				<div class="alert alert-success">
	                 Selamat datang <strong><?php echo $user->first_name.' '.$user->last_name;?></strong>, terima kasih sudah mempercayai Inisiatif Zakat Indonesia sebagai Lembaga Amil Zakat Anda. 
	             </div>
            </div>
            <?php }?>
			<div class="col-md-12 col-sm-12">
				<div class="vertical_tabs kl-style-2 clearfix">
					<div class="tabbable">
						<ul class="nav fixclear">
							<li class="active"><a aria-expanded="true" href="#tabs_1"
								data-toggle="tab">PROFILE</a></li>
							<li class=""><a aria-expanded="false" href="#tabs_2"
								data-toggle="tab">LAPORANKU</a></li>
							<li class=""><a aria-expanded="false" href="#tabs_3"
								data-toggle="tab">RENCANAKU</a></li>
							<li class=""><a aria-expanded="false" href="#tabs_5"
								data-toggle="tab">HITUNG ZAKATKU</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tabs_1">
								<div
									class="kl-title-block clearfix tbk--left text-left tbk-symbol--line_border tbk--colored tbk-icon-pos--after-title">
									<div class="col-md-11">
										<h4 class="tbk__title ">PROFILE</h4>
									</div>
									<div class="col-md-1">
										<a aria-expanded="false" href="#tabs_6" data-toggle="tab"><span
											class="glyphicon glyphicon-cog" style="font-size: 2em;"></span></a>
									</div>
									<div class="tbk__symbol ">
										<span></span>
									</div>
									<div class="bs-docs-example">
										<table class="table">
											<tbody>
												<tr>
													<td>Nama Lengkap</td>
													<td><strong><?php echo $user->first_name.' '.$user->last_name;?></strong></td>
												</tr>
												<tr>
													<td>Email</td>
													<td><strong><?php echo $user->email;?></strong></td>
												</tr>
												<tr>
													<td>No Kontak</td>
													<td><strong><?php echo $user->contact;?></strong></td>
												</tr>
												<tr>
													<td>Alamat</td>
													<td><strong><?php echo $user->address;?></strong></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tabs_2">
								<div
									class="kl-title-block clearfix tbk--left text-left tbk-symbol--line_border tbk--colored tbk-icon-pos--after-title">
									<div class="col-md-12">
										<h4 class="tbk__title ">LAPORANKU</h4>
									</div>
									<div class="tbk__symbol ">
										<span></span>
									</div>
									<div class="row">
										<div class="right_sidebar col-md-12">
											<div class="kl-store">
												<div class="bs-docs-example">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Tanggal</th>
													<th>Laporan zakat/donasi</th>										
												</tr>
											</thead>
											<tbody>
				                                    <?php
													if ($report) {
														$i = 1;
														foreach ( $report as $key => $value ) {
															?>
				                                        <tr>
													<td><?php echo $i;?></td>
													<td><?php echo $value->date_string;?></td>
													<td><a href="<?php echo base_url()?>uploads/files/<?php echo $value->url;?>"><?php echo $value->title;?></a></td>
													<?php 
													$i++;
													}
												} else {
													?>
															
												<tr>
													<td>-</td>
													<td>-</td>
													<td>-</td>
												</tr>
														<?php
														}
														?>
				                                    </tbody>
										</table>
									</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tabs_3">
								<div
									class="kl-title-block clearfix tbk--left text-left tbk-symbol--line_border tbk--colored tbk-icon-pos--after-title">
									<div class="col-md-11">

										<h4 class="tbk__title ">RENCANAKU</h4>

									</div>

									<div class="col-md-1"></div>
									<div class="tbk__symbol ">

										<span></span>

									</div>
									<!-- 									--------------------------------- -->
									<div class="row">
										<div class="right_sidebar col-md-12">
											<div class="kl-store">
												<form id="plan-form" method="POST" class="login"
													enctype="multipart/form-data"
													action="<?php echo base_url()?>process/donation/send">
													<div id="donate"></div>
													<div id="ontop"">
														<div class="col-md-12">
															<div class="col-md-12" id="other"></div>
															<div class="col-md-4">
																<input type="hidden"
																	value="<?php echo $user->member_id;?>" name="member_id">
																<p class="form-row form-row-wide" id="jpayment">
																	<label for="jpayment">Jenis Pembayaran<span
																		class="required">*</span>
																	</label> <select name="pembayaran" style="width: 100%">
																		<option style="padding: 8px;" value="0">Pilih Jenis Pembayaran</option>
																		<option style="padding: 8px;" value="3">Zakat Profesi</option>
																			<option style="padding: 8px;" value="1">Zakat Harta</option>
																			<option style="padding: 8px;" value="4">Zakat Fitrah</option>
																			<option style="padding: 8px;" value="5">Zakat Lainnya</option>
																			<option style="padding: 8px;" value="7">Infaq & Shadaqoh</option>
																			<option style="padding: 8px;" value="13">Fidyah/Kafarat</option>
																			<option style="padding: 8px;" value="14">Qurban</option>
																	</select>

																</p>
															</div>
															<div class="col-md-8">
																<p class="form-row form-row-wide" id="jsetoran">
																	<label for="jsetoran">Jumlah Setoran<span
																		class="required">*</span>
																	</label> <input class="input-text" name="setoran"
																		id="jsetoran" type="text">
																</p>
															</div>
														</div>
														<div class="col-md-12">
															<div class="col-md-4">
																<p class="form-row form-row-wide" id="mpayment">
																	<label for="method">Metode Pembayaran <span
																		class="required">*</span>
																	</label> <select name="metode" style="width: 100%">
																		<option style="padding: 8px;" value="0">Pilih Metode Pembayaran</option>
																		<?php if($inquery){?>
																		<?php $list = new SimpleXMLElement($inquery);?>
																		<?php 
																			foreach ($list->payment_channel as $channel) {
																			?>
																			<option style="padding: 8px;" value="<?php echo $channel->pg_code;?>"><?php echo $channel->pg_name;?></option>
																			<?php 
																			}
																		?>									
																		<?php }?>
																		<option style="padding: 8px;" value="2">Metode pembayaran lainnya</option>
																		<option style="padding: 8px;" value="3">Jemput Zakat / Donasi</option>
																	</select>
																</p>
															</div>
															<div class="col-md-4">
																<p class="form-row form-row-wide" id="mreminder">
																	<label for="method">Reminder Pembayaran <span
																		class="required">*</span>
																	</label> <select id="reminder" name="waktu" style="width: 100%">
																		<option style="padding: 8px;" value="0">Pilih Waktu</option>	
																		<option style="padding: 8px;" value="1">Setiap Minggu</option>
																		<option style="padding: 8px;" value="2">Setiap Bulan</option>																	
																	</select>
																</p>
															</div>
															<div class="col-md-4">														
																<div id="reminderformat">																	
																</div>
															</div>
														</div>
														<p class="form-row form-row-wide"
															style="padding-top: 20px;">
															<input class="button pull-right" value="SIMPAN & INGATKAN"
																name="plan" type="submit">
														</p>
													</div>
												</form>
											</div>
										</div>
										<div class="col-md-3"></div>
									</div>
									<!-------------------------------------------- -->

									<div class="bs-docs-example">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Waktu Reminder</th>
													<th>Zakat / Donasi</th>
													<th>Metode Pembayaran</th>
													<th>Jumlah Zakat / Donasi</th>
													<th style='text-align:center;'>Action</th>
												</tr>
											</thead>
											<tbody>
				                                    <?php
													if ($zakat) {
														$i = 1;
														foreach ( $zakat as $key => $value ) {
															?>
				                                        <tr>
													<td><?php echo $i;?></td>
													<td><?php if($value->day){
														if($value->day==1) echo "Senin <a style='color:#a2ca2b'>[setiap minggu]</a>";
														if($value->day==2) echo "Selasa <a style='color:#a2ca2b'>[setiap minggu]</a>";
														if($value->day==3) echo "Rabu <a style='color:#a2ca2b'>[setiap minggu]</a>";
														if($value->day==4) echo "Kamis <a style='color:#a2ca2b'>[setiap minggu]</a>";
														if($value->day==5) echo "Jumat <a style='color:#a2ca2b'>[setiap minggu]</a>";
														if($value->day==6) echo "Sabtu <a style='color:#a2ca2b'>[setiap minggu]</a>";
														if($value->day==7) echo "Minggu <a style='color:#a2ca2b'>[setiap minggu]</a>";
													} else echo $value->date_created_shorts." <a style='color:#1E90FF'>[setiap bulan]</a>";?></td>
													<td><?php if($value->payment_pupose==1) echo "Zakat Harta"; 
													if($value->payment_pupose==3) echo "Zakat Profesi";
													if($value->payment_pupose==4) echo "Zakat Fitrah";
													if($value->payment_pupose==7) echo "Infaq &	Shadaqoh";
													if($value->payment_pupose==13) echo "Fidyah/Kafarat";
													if($value->payment_pupose==14) echo "Qurban";
													?></td>
													<td><?php  if($value->transfer_method==405) echo "Klikpay BCA";
													if($value->transfer_method==402) echo "Permata";
													if($value->transfer_method==401) echo "BRI epay";
													if($value->transfer_method==406) echo "Klikpay Mandiri";
													if($value->transfer_method==700) echo "CIMB Clicks";
													if($value->transfer_method==706) echo "Indomaret";
													if($value->transfer_method==2) echo "Transfer";
													if($value->transfer_method==3) echo "Jemput";?></td>
													<td><?php echo $value->transfer_amount  === '0' ? '-' : 'Rp. '.number_format($value->transfer_amount, 0, ',', '.');?></td>                                          
				                                        <?php
														echo "<td style='text-align:center;width:10%;'><a class='btn-element btn btn-success btn-xs' href='".base_url()."donate-now?type=".$value->payment_pupose."&get_zakat=".$value->transfer_amount."&method=".$value->transfer_method."&idm=".$value->donate_id."'>BAYAR SEKARANG</a>";
														echo "</td></tr>";
														$i ++;
													}
												} else {
													?>
															
												<tr>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
													<td>-</td>
												</tr>
														<?php
														}
														?>
				                                    </tbody>
										</table>
									</div>


								</div>
							</div>
							<div class="tab-pane fade" id="tabs_5">
								<div
									class="kl-title-block clearfix tbk--left text-left tbk-symbol--line_border tbk--colored tbk-icon-pos--after-title">
									<div class="col-md-11">

										<h4 class="tbk__title ">KALKULATOR ZAKAT</h4>

									</div>


									<div class="col-md-1"></div>
									<div class="tbk__symbol ">

										<span></span>

									</div>

								</div>
								<div class="reset-this"></div>
								<div class="row">
									<div class="col-sm-12">
									
									
									<div id="submitedzakat" class="kl-store-page kl-store">
															<form id="calculator-zakat" method="post"
																enctype="multipart/form-data"
																action="<?php echo base_url()?>process/zakat">
																<div class="vertical_tabs kl-style-2 clearfix">
																	<div class="tabbable">
																		<ul style="width: 25%; font-size: 12px;"
																			class="nav fixclear">
																			<li class="active"><a aria-expanded="false"
																				href="#tabs_i2-pane1" data-toggle="tab">Perhitungan
																					Nisab</a></li>
																			<li class=""><a aria-expanded="false"
																				href="#tabs_i2-pane2" data-toggle="tab">Zakat Harta</a></li>
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane3" data-toggle="tab">Zakat
																					Perniagaan</a></li>
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane4" data-toggle="tab">Zakat
																					Profesi</a></li>
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane6" data-toggle="tab">Zakat
																					Pertanian</a></li>
																			<li class=""><a aria-expanded="true"
																				href="#tabs_i2-pane7" data-toggle="tab">Zakat
																					Lainnya</a></li>
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
																					dapat mengunjungi situs <a
																						href="http://www.logammulia.com/gold-id.php"
																						target="_blank">ini</a>
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
																				<h4>ZAKAT HARTA YANG TELAH TERSIMPAN SATU TAHUN</h4>
																				<p>
																				
																				
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>Uang Tunai, Tabungan, Deposito atau
																							sejenisnya </label> <input
																							class="zakat-input input-text" name="tabungan"
																							id="tabungan" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Saham atau surat-surat berharga lainnya </label>
																						<input class="zakat-input input-text" name="saham"
																							id="saham" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Real Estate (tidak termasuk rumah tinggal
																							yang dipakai sekarang) </label> <input
																							class="zakat-input input-text" name="real_estate"
																							id="real_estate" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Emas, Perak, Permata atau sejenisnya </label>
																						<input class="zakat-input input-text"
																							name="perhiasan" id="perhiasan" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Mobil (lebih dari keperluan pekerjaan
																							anggota keluarga) </label> <input
																							class="zakat-input input-text" name="kendaraan"
																							id="kendaraan" value="0">
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
																					<p class="form-row form-row-wide">
																						<label>Hutang Pribadi yg jatuh tempo dalam tahun
																							ini </label> <input
																							class="zakat-input input-text"
																							name="hutang_pribadi" id="hutang_pribadi"
																							value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Harta simpanan kena zakat<br />(jumlah
																							total harta simpanan-hutang pribadi jika mencapai
																							Nisab)
																						</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="selisih_simpanan" id="selisih_simpanan">0</span>
																						<input name="selisih_simpanan"
																							id="selisih_simpanan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT ATAS SIMPANAN YANG
																								WAJIB DIBAYARKAN PER TAHUN</strong><br />(2,5% x
																							harta simpanan kena zakat) </label> <span
																							style="float: left; margin-top: 2px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_pribadi" id="zakat_pribadi">0</span>
																						<input name="zakat_pribadi" id="zakat_pribadi"
																							type="hidden">
																					</p>
																					<div class="col-md-12"
																						style="padding-top: 10px; padding-bottom: 5px;">
																						<p class="form-row form-row-wide pull-right"
																							style="padding-top: 20px;">
																							<span id='payharta'></span>
																						</p>
																					</div>
																				</div>
																				</p>


																			</div>
																			<div class="tab-pane" id="tabs_i2-pane3">
																				<h4>ZAKAT PERNIAGAAN</h4>
																				<p>
																				
																				
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>Nilai Kekayaan Perusahaan<br />(termasuk
																							uang tunai, simpanan di bank, real estate, alat
																							produksi, inventori, barang jadi, dll)
																						</label> <input class="zakat-input input-text"
																							name="kekayaan_perusahaan"
																							id="kekayaan_perusahaan" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Utang perusahaan jatuh tempo </label> <input
																							class="zakat-input input-text"
																							name="hutang_perusahaan" id="hutang_perusahaan"
																							value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Komposisi Kepemilikan (dalam persen) </label>
																						<input class="zakat-input input-text"
																							name="komposisi_kepemilikan"
																							id="komposisi_kepemilikan" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Jumlah Bersih Harta Usaha<br />Prosesntase
																							kepemilikian saham x (Nilai kekayaan perusahaan –
																							utang perusahaan jatuh tempo)
																						</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="total_kekayaan_perusahaan"
																							id="total_kekayaan_perusahaan">0</span> <input
																							name="total_kekayaan_perusahaan"
																							id="total_kekayaan_perusahaan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Harta usaha kena zakat<br />(jumah bersih
																							harta usaha jika mencapai Nisab)
																						</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="selisih_kekayaan_perusahaan"
																							id="selisih_kekayaan_perusahaan">0</span> <input
																							name="selisih_kekayaan_perusahaan"
																							id="selisih_kekayaan_perusahaan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT ATAS HARTA USAHA YANG
																								WAJIB DIBAYARKAN PER TAHUN</strong> </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_perusahaan" id="zakat_perusahaan">0</span>
																						<input name="zakat_perusahaan"
																							id="zakat_perusahaan" type="hidden">
																					</p>
																					<div class="col-md-12"
																						style="padding-top: 10px; padding-bottom: 5px;">
																						<p class="form-row form-row-wide pull-right"
																							style="padding-top: 20px;">
																							<span id='payperusahaan'></span>
																						</p>
																					</div>
																				</div>
																				</p>


																			</div>
																			<div class="tab-pane" id="tabs_i2-pane4">
																				<h4>ZAKAT PROFESI</h4>
																				<p>
																				
																				
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>Pendapatan / Gaji per Bulan (setelah
																							dipotong pajak) </label> <input
																							class="zakat-input input-text" name="pendapatan"
																							id="pendapatan" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Bonus/pendapatan lain-lain selama setahun </label>
																						<input class="zakat-input input-text" name="bonus"
																							id="bonus" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Jumlah Pendapatan per Tahun </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="total_pendapatan" id="total_pendapatan">0</span>
																						<input name="total_pendapatan"
																							id="total_pendapatan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Rata-rata pengeluaran rutin per bulan<br />(kebutuhan
																							fisik, air, listrik, pendidikan, kesehatan,
																							transportasi, dll)
																						</label> <input class="zakat-input input-text"
																							name="pengeluaran" id="pengeluaran" value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Pengeluaran lainnya dalam satu tahun<br />(pendidikan,
																							kesehatan, dll)
																						</label> <input class="zakat-input input-text"
																							name="pengeluaran_lain" id="pengeluaran_lain"
																							value="0">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Jumlah Pengeluaran per Tahun<br />(12 kali
																							rata rata pengeluaran rutin + pengeluaran
																							lainnya)
																						</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="total_pengeluaran" id="total_pengeluaran">0</span>
																						<input name="total_pengeluaran"
																							id="total_pengeluaran" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>Penghasilan kena zakat<br />(jumah
																							pendapatan per tahun dikurangi jumlah pengeluaran
																							per tahun jika mencapai nisab)
																						</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="selisih_pendapatan" id="selisih_pendapatan">0</span>
																						<input name="selisih_pendapatan"
																							id="selisih_pendapatan" type="hidden">
																					</p>
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT PROFESI YANG WAJIB
																								DIBAYARKAN PER TAHUN</strong><br />(2,5% dikali
																							penghasilan kena zakat) </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_profesi" id="zakat_profesi">0</span>
																						<input name="zakat_profesi" id="zakat_profesi"
																							type="hidden">
																					</p>
																					<div class="col-md-12"
																						style="padding-top: 10px; padding-bottom: 5px;">
																						<p class="form-row form-row-wide pull-right"
																							style="padding-top: 20px;">
																							<span id='payprofesi'></span>
																						</p>
																					</div>
																				</div>
																				</p>
																			</div>
																			<div class="tab-pane" id="tabs_i2-pane5">
																				<h4>TOTAL ZAKAT</h4>
																				<p>
																				
																				
																				<div class="col-md-12">
																					<p class="form-row form-row-wide">
																						<label>JUMLAH ZAKAT HARTA</label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid #d8d8d8; padding: 5px 10px; background-color: #d8d8d8; border-radius: 3px;"
																							name="pribadi" id="pribadi">0</span> <input
																							name="pribadi" id="pribadi" type="hidden">
																					</p>
																					<p class="form-row form-row-wide">
																						<label>JUMLAH ZAKAT PERNIAGAAN </label><span
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
																						<label>JUMLAH ZAKAT LAINNYA (HADIAH / TEMUAN) </label><span
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
																					style="padding-top: 10px; padding-bottom: 5px;">
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
																				
																				
																				<div class="col-md-12">
																					Nishab zakat pertanian : <strong>653 kg</strong>,
																					untuk mengetahui harga beras saat ini, salah
																					satunya Anda dapat mengunjungi situs <a
																						href="http://infopangan.jakarta.go.id/"
																						target="_blank"
																						style="color: #a2ca2b; font-weight: 700;">ini</a>
																				</div>
																				<div class="col-md-10">
																					<p class="form-row form-row-wide">
																						<label>Harga Beras per- Kilo saat ini </label> <input
																							class="zakat-input input-text"
																							name="harga_pangan" id="harga_pangan" value="0"
																							type="text">
																					</p>
																				</div>
																				<div class="col-md-10">
																					<p class="form-row form-row-wide">
																						<label>Total hasil panen (Kg), jika tanaman yang
																							diairi <strong>dengan bantuan</strong> alat
																							pengangkut air dan beban biaya yang besar (5%)
																						</label> <input class="zakat-input input-text"
																							name="pertanianlima" id="pertanianlima" value="0">
																					</p>
																				</div>
																				<div class="col-md-10">
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
																					</p>
																				</div>
																				</p>
																				<div class="col-md-12"
																					style="padding-top: 10px; padding-bottom: 5px;">
																					<p class="form-row form-row-wide pull-right"
																						style="padding-top: 20px;">
																						<span id='paytani'></span>
																					</p>
																				</div>
																			</div>
																			<div class="tab-pane" id="tabs_i2-pane7">
																				<h4>ZAKAT LAINNYA</h4>
																				<p>
																				
																				
																				<div class="col-md-12">Zakat lainnya meliputi zakat
																					hadiah dan barang temuan dikenankan zakat 20%
																					setelah dipotong pajak(bila ada)</div>
																				<div class="col-md-10">
																					<p class="form-row form-row-wide">
																						<label>Total hadiah setelah dipotong pajak </label>
																						<input class="zakat-input input-text"
																							name="total_hadiah" id="total_hadiah" value="0"
																							type="text">
																					</p>
																				</div>
																				<div class="col-md-12">
																					<p class="form-row form-row-wide"
																						style="margin-top: 10px; background-color: rgb(114, 202, 43); padding: 10px;">
																						<label><strong>JUMLAH ZAKAT HADIAH / BARANG TEMUAN
																								YANG WAJIB DIBAYARKAN</strong> </label><span
																							style="float: left; margin-top: 2px; margin-bottom: 8px; border: 1px solid rgb(254, 233, 0); padding: 5px 10px; background-color: rgb(254, 233, 0); border-radius: 3px;"
																							name="zakat_hadiah" id="zakat_hadiah">0</span> <input
																							name="zakat_hadiah" id="zakat_hadiah"
																							type="hidden">
																					</p>
																				</div>
																				</p>
																				<div class="col-md-12"
																					style="padding-top: 10px; padding-bottom: 5px;">
																					<p class="form-row form-row-wide pull-right"
																						style="padding-top: 20px;">
																						<span id='payother'></span>
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

							</div>
							<div class="tab-pane fade" id="tabs_6">
								<div
										class="kl-title-block clearfix tbk--left text-left tbk-symbol--line_border tbk--colored tbk-icon-pos--after-title">
									<div class="col-md-11">

										<h4 class="tbk__title ">EDIT PROFILE</h4>

									</div>


									<div class="col-md-1"></div>
									<div class="tbk__symbol ">

										<span></span>

									</div>
									<div class="col-md-1"></div>


									<div class="right_sidebar col-md-10">
										<div class="kl-store-page kl-store"> <!-- id="edit-profile" -->											
											<form id="edit-profile" method="post" class="login"
													enctype="multipart/form-data"
													action="<?php echo base_url()?>process/member/edit_profile">
													<input name="mid" type="hidden" value="<?php echo $user->member_id;?>">
												<div class="col-md-12"><p id="other"></p></div>
												<div class="col-md-6">
													<p class="form-row form-row-wide" id="firstname">
														<label for="firstname">Nama Depan </label> <input
																class="input-text" name="firstname" id="firstname"
																type="text" value="<?php echo $user->first_name;?>">
													</p>
												</div>
												<div class="col-md-6">
													<p class="form-row form-row-wide" id="lastname">
														<label for="lastname">Nama Belakang </label> <input
																class="input-text" name="lastname" id="lastname"
																type="text" value="<?php echo $user->last_name;?>">
													</p>
												</div>
												<div class="col-md-12">
<!-- 													<p class="form-row form-row-wide" id="email"> -->
<!-- 														<label for="email">Email </label> <input -->
<!-- 																class="input-text" name="email" id="email" type="text" value="<?php //echo $user->email;?>">-->																
<!-- 													</p> -->
													<p class="form-row form-row-wide">
														<label for="nokontak">No Kontak </label> <input
																class="input-text" name="nokontak" id="nokontak"
																type="text"
																value="<?php echo $user->contact;?>">
													</p>
													<p class="form-row form-row-wide">
														<label for="address">Alamat </label>
														<textarea class="input-text" name="address" id="address"
																type="text"><?php echo $user->address;?></textarea>
													</p>
												</div>
												<!-- div class="col-md-12">
													<p class="form-row form-row-wide" id="username">
														<label for="username">Username </label> <input
																class="input-text" name="username" id="username"
																type="text"
																value="<?php //echo $user->username;?>">
													</p>
												</div-->
												<!-- div class="col-md-6">
													<p class="form-row form-row-wide" id="password">
														<label for="password">Password </label> <input
																class="input-text" name="password" id="password"
																type="password">
													</p>
												</div>
												<div class="col-md-6">
													<p class="form-row form-row-wide">
														<label for="passconf">Re-enter password </label> <input
																class="input-text" name="passconf" id="passconf"
																type="password">
													</p>
												</div-->
												<p class="form-row form-row-wide" style="padding-top: 20px;">
													<input
															style="background: #a2ca2b; width: 100%; font-size: 13px !important; padding: 10px 0px; font-weight: 600; color: #fff; text-transform: uppercase; text-shadow: none; border-radius: 3px; box-shadow: none; position: relative; border: 0; line-height: 1;"
															class="button pull-right" value="SIMPAN" type="submit">
												</p>
											</form>
										</div>
									</div>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>








</section>

<div id="payzakat" class="mfp-hide white-popup-block">
	<div class="inner-container login-panel">
		<form id="myzakatstatus" enctype="multipart/form-data"
			action="<?php echo base_url()?>module/donate" method="POST">
			<input name="zakatid" value="<?php //echo $->member_id;?>"
				type="hidden">
			<h3 class="m_title">Lakukan pembayaran zakat sekarang melalui IZI</h3>
			<label>Pilih Metode Pembayaran</label> <select name="paymethod"
				class="form-control">
				<option value="1">Transfer</option>
				<option value="2">Virtual Account</option>
				<option value="3">Paypal</option>
			</select><input type="submit" name="submit" value="Bayar Zakat">
		</form>
	</div>
</div>
