<section class="hg_section ptop-0">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="action_box style3" data-arrowpos="center"
					style="margin-top: -25px;">
					<div class="action_box_inner">
						<div class="action_box_content">
							<div class="ac-content-text">
								<h4 class="text">
									<?php if($this->language_id=='107') { ?>
									<span class="fw-thin">ENCOURAGE YOURSELF<span
										class="fw-semibold"> TO PAY ZAKAT</span> EASES YOUR LIFE
									</span>
									<?php }else{  ?>
									<span class="fw-thin">MEMUDAHKAN DIRI UNTUK<span
										class="fw-semibold"> BERZAKAT</span> MEMBAWA KEMUDAHAN HIDUP
									</span>
									<?php } ?>
								</h4>
								<?php if($this->language_id=='107') { ?>
								<h5 class="ac-subtitle">The existence of IZI accommodates You to pay zakat. Enjoy many facilities to accommodate You to pay Zakat by joining IZI. Your Zakat planning, payment, and evaluation will be easier.</h5>
								<?php }else { ?>
								<h5 class="ac-subtitle">IZI hadir untuk memberikan kemudahan
									untuk Anda dalam ber Zakat. Dapatkan berbagai fasilitas untuk
									kemudahan Anda dalam berzakat dengan bergabung di IZI.
									Perencanaan, pembayaran, evaluasi Zakat Anda akan lebih mudah.</h5>
								<?php } ?>
							</div>
							<div class="ac-buttons">
								<?php if($this->language_id=='107') { ?>
								<a class="btn btn-lined ac-btn"
									href="<?php echo base_url()?>register" target="_blank">REGISTER</a><a
									class="btn btn-fullwhite ac-btn"
									href="<?php echo base_url()?>tanya-jawab" target="_blank">LEARN MORE</a>
								<?php }else { ?>
								<a class="btn btn-lined ac-btn"
									href="<?php echo base_url()?>register" target="_blank">BERGABUNG</a><a
									class="btn btn-fullwhite ac-btn"
									href="<?php echo base_url()?>tanya-jawab" target="_blank">PELAJARI</a>
								<?php } ?>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hg_section ptop-10">
	<div class="hg_section_size container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="latest_posts acc-style">
					<h3 class="m_title"><?php echo $this->language_id=='107' ? "NEWS UPDATES" :"BERITA TERBARU"; ?></h3>
					<a href="<?php echo base_url()?>berita" class="viewall">VIEW ALL -</a>
					<div class="css3accordion">
						<?php if (isset($home_center) && ! empty($home_center)) { ?>
						<ul>	
							<?php if ($home_center->type == 'article') { ?>		
							<?php if (isset($home_center->article) && ! empty($home_center->article)) { ?>				
							<?php foreach ($home_center->article as $key => $value) { ?>
								<?php $language_id = isset($value->content[$this->language_id]) ? $this->language_id : 'default'; ?>
							<li <?php if($key === 2 || $key === 5) echo "class='last'";?>><div class="inner-acc" style="width: 570px;">
									<a href="<?php echo base_url() . $value->guid; ?>"
										class="thumb hoverBorder plus"><span
										class="hoverBorderWrapper">
										<?php if ($value->image && file_exists($this->path . 'uploads/images/' . $value->type . '/' . 'full' . '/' . $value->image)) { ?>
										<img
											src="<?php echo base_url() . 'uploads/images/' . $value->type . '/' . 'full' . '/' . $value->image; ?>"
											alt="<?php echo $value->content[$this->language_id]->title; ?>">
										<?php } ?>
											<span class="theHoverBorder"></span>
									</span></a>
									<div class="content">
										<em><?php echo $value->created_date_short; ?> by <?php echo $value->author; ?></em>
										<h5 class="m_title">
											<a href="<?php echo base_url() . $value->guid; ?>"><?php echo $value->content[$this->language_id]->title; ?></a>
										</h5>
										<div class="text"><?php echo trim_text($value->content[$this->language_id]->body); ?></div>
										<a href="<?php echo base_url() . $value->guid; ?>">READ MORE +</a>
									</div>
								</div></li>
								<?php }}} ?>
						</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hg_section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div
					class="kl-title-block clearfix text-center tbk-symbol-- tbk-icon-pos--after-title">
					<h3 class="tbk__title montserrat fs-44 lh-44 fw-bold light-gray3">
					<?php echo $this->language_id=='107' ? "OK, WHY IZI":"OK, MENGAPA IZI?"; ?></h3>
					<h4 class="tbk__subtitle fs-18 fw-vthin">
					<?php echo $this->language_id=='107' ? "IZI was created by a foundation having years of experience in managing Zakat." : "IZI lahir dari lembaga yang berpengalaman bertahun-tahun dalam mengelola Zakat."; ?></h4>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hg_section pbottom-0 ptop-0">
	<div class="hg_section_size container">
		<div class="row">
			<div class="col-md-4 col-sm-4">
				<div class="box image-boxes imgboxes_style4 kl-title_style_bottom">
					<a class="imgboxes4_link imgboxes-wrapper" href="#" target="_blank">
						<img
						src="<?php echo base_url()?>assets/images/imageboxes-set1-011-460x307.jpg"
						width="360" height="240" alt="IZI MEMBANTU SEMUA"
						title="IZI MEMBANTU SEMUA" class="img-responsive imgbox_image"><span
						class="imgboxes-border-helper"></span>
						<?php if($this->language_id=='107') { ?>
						<h3 class="m_title imgboxes-title">IZI AS AN EXPERIENCED FOUNDATION</h3>
					</a>
					<p>Inisiatif Zakat Indonesia – IZI (Indonesian Zakat Initiative) foundation was created by a social foundation which has been widely known as a foundation with good reputation for more than 16 years in pioneering the new era of modern Islamic philanthropical movement in Indonesia namely Pos Keadilan Peduli Ummat (PKPU: People's Sense of Justice and Awareness Post) foundation.</p>
						<?php }else { ?>
						<h3 class="m_title imgboxes-title">IZI LEMBAGA BERPENGALAMAN</h3>
					</a>
					<p>Yayasan Inisiatif Zakat Indonesia – IZI – dilahirkan oleh sebuah lembaga sosial yang sebelumnya telah dikenal cukup luas dan memiliki reputasi yang baik selama lebih dari 16 tahun dalam memelopori era baru gerakan filantropi Islam modern di Indonesia yaitu Yayasan Pos Keadilan Peduli Ummat (PKPU).</p>
						<?php } ?>
					<a href="#" target="_blank"></a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="box image-boxes imgboxes_style4 kl-title_style_bottom">
					<a class="imgboxes4_link imgboxes-wrapper" href="#" target="_blank">
						<img
						src="<?php echo base_url()?>assets/images/imageboxes-set1-021-460x307.jpg"
						width="360" height="240" alt="IZI MEMUDAHKAN"
						title="IZI MEMUDAHKAN" class="img-responsive imgbox_image"><span
						class="imgboxes-border-helper"></span>
						<?php if($this->language_id=='107') { ?>
						<h3 class="m_title imgboxes-title">IZI'S FOCUS AND RIGHTFUL TARGETS</h3>
					</a>
					<p>IZI can be more earnest to simulate the potential of Zakat optimally to have real strength and become a strong pillar to support the dignity and welfare of people through clear positioning of the foundation, prime services, highly effective programs, efficient and modern business process, and 100% of Sharia compliance pursuant to the targets of ashnaf (beneficiaries) and maqashid (objectives) of sharia.</p>
					<?php }else { ?>	
					<h3 class="m_title imgboxes-title">IZI FOKUS dan SESUAI SASARAN</h3>
					</a>
					<p>IZI dapat lebih sungguh-sungguh mendorong potensi besar zakat menjadi kekuatan real dan pilar kokoh penopang kemuliaan dan kesejahteraan ummat melalui positioning lembaga yang jelas, pelayanan yang prima, efektifitas program yang tinggi, proses bisnis yang efisien dan modern, serta 100% shariah compliance sesuai sasaran ashnaf dan maqashid (tujuan) syariah.</p>
					<?php } ?>
					<a href="#" target="_blank"></a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<div class="box image-boxes imgboxes_style4 kl-title_style_bottom">
					<a class="imgboxes4_link imgboxes-wrapper" href="#" target="_blank">
						<img src="<?php echo base_url()?>assets/images/gpg4-640x426.jpg"
						width="360" height="240" alt="PROGRAM IZI MENARIK"
						title="PROGRAM IZI MENARIK" class="img-responsive imgbox_image"><span
						class="imgboxes-border-helper"></span>
						<?php if($this->language_id=='107') { ?>
						<h3 class="m_title imgboxes-title">IZI IS EASIER</h3>
					</a>
					<p>Core value of IZI in order to be beneficial for people - consistent with the similarity of the pronunciation of its name - is "easy". The tag which it heralds is "accommodate, be accommodated". Starting from a faith that if someone accommodates his/her brothers' matters, then Allah will accommodate his/her matters, Insha Allah (God's will).</p>
					<?php }else { ?>
					<h3 class="m_title imgboxes-title">DENGAN IZI MUDAH</h3>
					</a>
					<p>Core value IZI dalam berkhidmat bagi ummat – sesuai kemiripan pelafalan namanya – adalah ‘mudah’ (easy). Tagline yang diusungnya adalah ‘memudahkan, dimudahkan’. Berawal dari keyakinan bahwa jika seseorang memudahkan urusan sesama, maka Allah SWT akan memudahkan urusannya, Insha Allah.</p>
					<?php } ?>
					<a href="#" target="_blank"></a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hg_section pbottom-0">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="screenshot-box kl-style-2 fixclear">
					<div class="row">
						<div class="col-sm-6">
							<div class="left-side">
							<?php if($this->language_id=='107') { ?>
								<h3 class="title">
									<span class="fw-thin">Programs of<span
										class="fw-semibold">Inisiatif Zakat Indonesia.</span></span>
								</h3>
								<ul class="features">
									<li>
										<h4>IZI to Success</h4> <span>Is a program to empower zakat donation collected by IZI in the economic sector which includes the following programs: <span class="fw-semibold">skills training, entrepreneurship assistance.</span>
									</li>
									<li>
										<h4>IZI to Smart</h4> <span>Is a program to empower zakat donation in the educational sector which includes the following programs: <span class="fw-semibold">scholarship for university students, scholarship for students, scholarship for Quran memorizers.</span>
									</li>
									<li>
										<h4>IZI to Fit</h4> <span>Is a program to empower zakat donation in healthcare sector which includes the following programs: <span class="fw-semibold">Shelter house for patients' family, Mobile healthcare, Assisting service for patients</span>
									</li>
									<li>
										<h4>IZI to Iman</h4> <span>Is a program to empower zakat donation in the preaching sector which includes the following programs: <span class="fw-semibold">Preachers for the entire nations, Coaching for newly converting to Muslims</span>
									</li>
									<li>
										<h4>IZI to Help</h4> <span>Is a program to empower zakat donation in the sector of social services which includes the following programs: <span class="fw-semibold">Laa Tahzan (Delivery service for the dead), Disaster Awareness</span>
									</li>
								</ul>
								<?php }else { ?>								
								<h3 class="title">
									<span class="fw-thin">Program-program <span
										class="fw-semibold">Inisiatif Zakat Indonesia.</span></span>
								</h3>
								<ul class="features">
									<li>
										<h4>IZI to Success</h4> <span>Merupakan program pemberdayaan dana zakat IZI di bidang ekonomi yang meliputi program: <span class="fw-semibold">Pelatihan Keterampilan, Pendampingan Wirausaha</span>
									</li>
									<li>
										<h4>IZI to Smart</h4> <span>Merupakan program pemberdayaan dana zakat di bidang pendidikan yang meliputi program: <span class="fw-semibold">Beasiswa Mahasiswa, Beasiswa Pelajar, Beasiswa Penghafal Qur’an</span>
									</li>
									<li>
										<h4>IZI to Fit</h4> <span>Merupakan program pemberdayaan dana zakat di bidang kesehatan yang meliputi program: <span class="fw-semibold">Rumah Singgah Pasien, Layanan Kesehatan Keliling, Layanan Pendampingan Pasien</span>
									</li>
									<li>
										<h4>IZI to Iman</h4> <span>Merupakan program pemberdayaan dana zakat di bidang dakwah yang meliputi program: <span class="fw-semibold">Dai Penjuru Negeri, Bina Muallaf</span>
									</li>
									<li>
										<h4>IZI to Help</h4> <span>Merupakan program pemberdayaan dana zakat di bidang layanan sosial yang meliputi program: <span class="fw-semibold">Laa Tahzan (Layanan Antar Jenazah), Peduli Bencana</span>
									</li>
								</ul>
								<?php } ?>								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="thescreenshot">
								<div class="controls">
									<a href="#" class="prev"></a><a href="#" class="next"></a>
								</div>
								<ul class="screenshot-carousel"
									data-carousel-pagination=".sc-pagination">
									<li><img
										src="<?php echo base_url()?>assets/images/office-820390_640-580x380.jpg"
										width="555" height="364" alt=""></li>
									<li><img
										src="<?php echo base_url()?>assets/images/ipad-605439_640-580x380.jpg"
										width="555" height="364" alt=""></li>
									<li><img
										src="<?php echo base_url()?>assets/images/phone-690091_640-580x380.jpg"
										width="555" height="364" alt=""></li>
								</ul>
								<div class="sc-pagination"></div>
							</div>
<div style="padding-top: 30px;
float: left;
margin-left: 30%;
width: 130%; margin-bottom:20px;">
									<a
									href="<?php echo base_url()?>donate-now"
									target="_blank" class="btn btn-fullcolor btn-third"><?php echo $this->language_id=='107' ? "DONATE NOW" : "DONASI SEKARANG"; ?></a>								
</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="hg_section hg_section--relative ptop-10 pbottom-10">
	<div class="kl-bg-source">
		<div class="kl-bg-source__overlay"
			style="background: rgba(162, 202, 43, 1); background: -moz-linear-gradient(left, rgba(162, 202, 43, 1) 0%, rgba(162, 202, 43, 1) 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(162, 202, 43, 1)), color-stop(100%, rgba(162, 202, 43, 1))); background: -webkit-linear-gradient(left, rgba(162, 202, 43, 1) 0%, rgba(162, 202, 43, 1) 100%); background: -o-linear-gradient(left, rgba(162, 202, 43, 1) 0%, rgba(162, 202, 43, 1) 100%); background: -ms-linear-gradient(left, rgba(162, 202, 43, 1) 0%, rgba(162, 202, 43, 1) 100%); background: linear-gradient(to right, rgba(162, 202, 43, 1) 0%, rgba(162, 202, 43, 1) 100%);"></div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div
					class="kl-title-block clearfix text-center tbk-symbol--line tbk-icon-pos--after-title">
					<h3 class="tbk__title white montserrat fw-bold"><?php echo $this->language_id=='107' ? "WHAT DID THEY SAY?" : "APA KATA MEREKA"; ?></h3>
					<div class="tbk__symbol ">
						<span></span>
					</div>
				</div>
				<div class="testimonials-partners testimonials-partners--light">
					<div class="ts-pt-testimonials clearfix">
						<div
							class="ts-pt-testimonials__item ts-pt-testimonials__item--size-2 ts-pt-testimonials__item--normal"
							style="margin-top: 20px;">
							<div class="ts-pt-testimonials__text"><?php echo $this->language_id=='107' ? 'Assalamualaikum (May peace be upon you), congratulations on the establishment of badan amil zakat nasional (national zakat management body) of IZI. May IZI be able to make muzaki (zakat payers) easy to pay their zakat and become the engineer of the economy to develop Muslims and nations.':'“Assalamualaikum , selamat atas berdirinya badan amil zakat nasional IZI semoga IZI dapat membuat "easy" para muzaki dalam membayarkan zakatnya dan menjadi penggerak perekonomian untuk membangun ummat islam indonesia dan bangsa.“'; ?></div>
							<div
								class="ts-pt-testimonials__infos ts-pt-testimonials__infos--">
								<div class="ts-pt-testimonials__img" style="background-image:url('<?php echo base_url()?>assets/images/t2.jpg');" title="David Chaliq"></div>
								<h4 class="ts-pt-testimonials__name">David Chaliq</h4>
								<div class="ts-pt-testimonials__position"><?php echo $this->language_id=='107' ? "Celebrity":"Artis"; ?></div>
								<div
									class="ts-pt-testimonials__stars ts-pt-testimonials__stars--5">
									<span class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span>
								</div>
							</div>
						</div>
						<div
							class="ts-pt-testimonials__item ts-pt-testimonials__item--size-1 ts-pt-testimonials__item--normal"
							style="">
							<div class="ts-pt-testimonials__text"><?php echo $this->language_id=='107' ? '“My expectation is that in the future, the good things existing with PKPU may continue to create a better cooperation between MT XL and IZI, Aamiin.“' : '“Harapan saya mudah-mudahan ke depan hal baik yang sebelumnya bersama
PKPU bisa berlanjut, menjadikan kerjasama MT XL - IZI yg lebih baik, Aamiin.“'; ?></div>
							<div
								class="ts-pt-testimonials__infos ts-pt-testimonials__infos--">
								<div class="ts-pt-testimonials__img" style="background-image:url('<?php echo base_url()?>assets/images/t1.jpg');" title="Fery Firman"></div>
								<h4 class="ts-pt-testimonials__name">Fery Firman</h4>
								<div class="ts-pt-testimonials__position"><?php echo $this->language_id=='107' ? "Head of Majlis Ta’lim (center for Islamic learning) of XL":"Ketua Majlis Ta’lim XL"; ?></div>
								<div
									class="ts-pt-testimonials__stars ts-pt-testimonials__stars--5">
									<span class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span>
								</div>
							</div>
						</div>
						<div
							class="ts-pt-testimonials__item ts-pt-testimonials__item--size-1 ts-pt-testimonials__item--reversed"
							style="">
							<div
								class="ts-pt-testimonials__infos ts-pt-testimonials__infos--">
								<div class="ts-pt-testimonials__img" style="background-image:url('<?php echo base_url()?>assets/images/t3.jpg');" title="Muhamad Basuki"></div>
								<h4 class="ts-pt-testimonials__name">Muhamad Basuki</h4>
								<div class="ts-pt-testimonials__position"><?php echo $this->language_id=='107' ? "Head of Perumnas (National housing Enterprise) UPZ":"Ketua UPZ Perumnas"; ?></div>
								<div
									class="ts-pt-testimonials__stars ts-pt-testimonials__stars--5">
									<span class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span><span
										class="glyphicon glyphicon-star"></span>
								</div>
							</div>
							<div class="ts-pt-testimonials__text"><?php echo $this->language_id=='107' ? '“The expectation is... IZI can synergize with UPZ-UPZ of Office Districts and give positive contribution to the development and welfare of people.”':'“Harapannya... IZI dapat bersinergi dgn UPZ-UPZ Perkantoran dan memberikan
kontribusi positif terhadap pengembangan dan kesejahteraan ummat.”'; ?></div>
						</div>
					</div>
					<div class="testimonials-partners__separator clearfix"></div>
					<div class="ts-pt-partners ts-pt-partners--y-title clearfix pbottom-20">
						<div class="ts-pt-partners__title"><?php echo $this->language_id=='107' ? 'PARTNERS' : 'MITRA STRATEGIS'; ?></div>
						<div class="ts-pt-partners__carousel-wrapper">
							<div class="ts-pt-partners__carousel">
								<?php for($ix=1;$ix<=35;$ix++) {?>
								<div class="ts-pt-partners__carousel-item">
									<a class="ts-pt-partners__link" href="#" target="_self"
										title=""><img class="ts-pt-partners__img"
										src="<?php echo base_url()?>assets/images/mitra/white-<?php echo $ix; ?>.png" alt=""
										width="143" height="42"></a>
								</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
