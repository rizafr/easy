<!doctype html>
<html lang="en-US" class="no-js">
   <head>
      <title><?php echo $this->site_title; ?></title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1">
      <meta name="keywords" content="IZI-Inisiatif Zakat Indonesia"/>
      <meta name="description" content="IZI - Memudahkan Dimudahkan">
      <meta property="og:url"           content="<?php echo base_url().$guid;?>" />
	  <meta property="og:type"          content="website" />
	  <meta property="og:title"         content="IZI | Memudahkan Dimudahkan" />
	  <meta property="og:description"   content="<?php echo $this->site_title; ?>" />
	  <?php if (isset($page_image) && ! empty($page_image)) { ?>
	  <?php foreach ($page_image as $key => $value) { ?>
	  <meta property="og:image"         content="<?php echo base_url() . 'uploads/images/' . $page_detail->type . '/' . 'full' . '/' . $value->file_name; ?>" />
	  <?php } ?>
	  <?php } ?>
      <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/images/iziicon.png" sizes="16x16">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400italic,400,600,600italic,700,800,800italic" rel="stylesheet" type="text/css">
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" type="text/css" media="all">
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/sliders/ios/style.css" type="text/css" media="all">
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/template.css" type="text/css" media="all">
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/responsive.css" type="text/css" media="all">
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/base-sizing.css" type="text/css" media="all">
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/updates.css" type="text/css" media="all">
      
      <!-- link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"-->
       <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>assets/css/bootstrap-datetimepicker.min.css">
      <link rel="stylesheet" href="<?php echo base_url()?>assets/css/custom.css" type="text/css" media="all">
      <script type="text/javascript" src="<?php echo base_url()?>assets/js/vendor/modernizr.min.js"></script><script src="../../ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="<?php echo base_url()?>assets/js/vendor/jquery-1.10.1.min.js">\x3C/script>')</script>
      <script src="../../code.jquery.com/jquery-migrate-1.2.1.js"></script>
      <style type="text/css"> .borderanim2-svg{width: 400px;}.borderanim2-svg .media-container__text{line-height: 70px;}.borderanim2-svg__shape{stroke-dasharray: 100 1000; stroke-dashoffset: -620; stroke: #a2ca2b;}.style2:hover .borderanim2-svg__shape{stroke-dasharray: 940;}</style>
      <!--Start of Zopim Live Chat Script-->
	<!--Start of Zopim Live Chat Script-->
	<script type="text/javascript">
	window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
	d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
	_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
	$.src="//v2.zopim.com/?3odlhVt9EiVdkt6gwwmm49W2a2SPMFLt";z.t=+new Date;$.
	type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
	</script>
	<!--End of Zopim Live Chat Script-->
   </head>
   <body class="">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
   	  <?php $page_language_id = isset($page_detail->content[$this->language_id]) ? $this->language_id : 'default'; ?>
      <?php $parent_language_id = isset($parent_detail->content[$this->language_id]) ? $this->language_id : 'default'; ?>
      <!--[if lte IE 8]> 
      <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/?locale=en">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
      <![endif]--><!--<div id="fb-root"></div><script>(function(d, s, id){var js, fjs=d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.src="//connect.facebook.net/en_US/all.js#xfbml=1"; js.async=true; fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>--><input type="checkbox" id="support_p" class="panel-checkbox">
      <div class="support_panel">
         <div class="container">
            <div class="row">
               <div class="col-sm-10">
                  <h4 class="m_title"><?php echo $this->language_id=='107' ? 'Zakat Payment Gateway (choose one of the following)' : 'Zakat Payment Gateway (Pilih salah satu)'; ?></h4>
                  <div class="m_content how_to_shop">
                     <div class="row">
                        <div class="col-sm-3"><span class="number">1</span> <a href="<?php echo base_url()?>confirm" target="_blank"><?php echo $this->language_id=='107' ? 'Bank transfer (confirmation)' : 'Transfer Bank (konfirmasi)'; ?></a></div>
                        <div class="col-sm-3"><span class="number">2</span> Virtual Account (Faspay)</div>
                        <div class="col-sm-3"><span class="number">3</span> <a href="<?php echo base_url()?>donate-now" target="_blank"><?php echo $this->language_id=='107' ? 'Donation fetching service' : 'Jemput Donasi'; ?></a></div>
                        <div class="col-sm-2"><span class="number">4</span> <a href="<?php echo base_url()?>tanya-jawab" target="_blank">FAQ</a></div>
                     </div>
                     <p><?php echo $this->language_id=='107' ? 'Should you have any inquiries concerning zakat payment in IZI, kindly ask zakat advisor at 1500047' : 'Jika Anda memiliki pertanyaan seputar pembayaran Zakat di IZI, tanyakan kepada Zakat Advisor di 1500047'; ?></p>
                  </div>
               </div>
               <div class="col-sm-2">
                  <h4 class="m_title"><?php echo $this->language_id=='107' ? 'Operational hours' : 'Jam Operasional'; ?></h4>
		  <?php if($this->language_id=='107') { ?>
                  <div class="m_content">Monday to Friday 8:00 - 17:00<br>We are close on Saturday & Sunday!<br>Except for Ramadan <br>Open every day from 8.00 to 18.00</div>
		<?php }else { ?>
			<div class="m_content">Sen-Jum 8:00 - 17:00<br>Sabtu & Ahad Tutup!<br>Kecuali Ramadhan <br>Buka tiap hari jam 8.00 - 18.00</div>
		<?php } ?>
               </div>
            </div>
         </div>
      </div>
      <?php
		function create_menu($page_menu, $current, $type, $top = TRUE) {
			if (is_array($page_menu)) {
				if ($type == 'main' && $top == FALSE) return;
				foreach ($page_menu as $key => $value) { 
					if ($type == $value['menu_type']) {
						$has_child = isset($value['children']) && ! empty($value['children']);
						if(($value['guid'] !== 'register') && ($value['guid'] !== 'myaccount')){
						if ($value['type'] === 'parent') {
							?><li class="menu-item-has-children menu-item-mega-parent" ><a style="font-family: Montserrat, 'Helvetica Neue', Helvetica, Arial, sans-serif;" href="#"><?php echo $value['menu']; ?></a> <ul class="hg_mega_container container clearfix"><?php
						
							if($has_child) 
							{								
								if (is_array($value['children'])) {
									foreach ($value['children'] as $key => $third_level) {
										$get_child = isset($third_level['children']) && ! empty($third_level['children']);
										if ($third_level['type'] === 'gallery' || $third_level['type'] === 'static' || $third_level['type'] === 'article') {
											?><li class="menu-item-has-children col-sm-4" >
<?php $link = "#";if(($third_level['guid'] !== 'profile')&&($third_level['guid'] !== 'program')&&($third_level['guid'] !== 'layanan')) $link = base_url() . $third_level['guid'];
?>
<a style="font-family: Montserrat, 'Helvetica Neue', Helvetica, Arial, sans-serif;" href="<?php  echo $link; ?>" class=" zn_mega_title "><?php echo $third_level['menu']; ?></a><ul class="clearfix"><?php						
												if($get_child){
													if (is_array($third_level['children'])) {
														$inc = 0;
														if($third_level['guid']==='tanya-jawab') krsort($third_level['children']);
														foreach ($third_level['children'] as $key => $last_level) {															
															?>
																<li><a style="font-family: Montserrat, 'Helvetica Neue', Helvetica, Arial, sans-serif;" href="<?php echo base_url() . $last_level['guid']; ?>"><?php echo $last_level['menu']; ?></a></li>
															<?php
															if($inc==4){
															?>
																
															<?php
															break; 
															}
															$inc++; 
														}
													}
												}
											
											?></ul></li><?php
										}
										else{
											?><li class="menu-item-has-children col-sm-4" ><a href="<?php echo base_url() . $third_level['guid']; ?>" class=" zn_mega_title "><?php echo $third_level['menu']; ?></a></li><?php
										}			
									}
								}
							}
							?></ul></li><?php 
						}
						else{
							?><li><a href="<?php echo base_url() . $value['guid']; ?>"><?php echo $value['menu']; ?></a></li><?php
						}
						}
					}
				}
			}
		}
		?>
      <div id="page_wrapper">
         <header id="header" class="site-header cta_button">
            <div class="kl-header-bg"></div>
            <div class="container siteheader-container">
               <div class="kl-top-header clearfix">
                  <div class="header-links-container ">
                     <ul class="topnav navRight topnav">                   	
                        <li><label for="support_p" class="spanel-label"><i class="glyphicon glyphicon-remove-circle icon-white"></i> <i class="glyphicon glyphicon-info-sign icon-white support-info visible-xs xs-icon"></i><span class="hidden-xs pay"><?php if($this->language_id=='107')echo "PAYMENT"; if($this->language_id=='125') echo "PEMBAYARAN"; ?></span></label></li>
                        <?php if (isset($_SESSION['login']['profile']['user_id'])) { ?>                        
                        <li><a  href="<?php echo base_url(); ?>authentication/logout">LOGOUT</a></li>
                        <?php } else { ?>
                        <li><a class="popup-with-form" href="#test-form">LOGIN</a></li>
                        <?php } ?>
                     </ul>
                     <ul class="topnav navLeft topnav--lang">                     	
                        <li class="languages drop">
                           <a href="#"><span class="glyphicon glyphicon-globe icon-white xs-icon"></span><span class="hidden-xs"><?php if($this->language_id=='107')echo "LANGUAGE"; if($this->language_id=='125') echo "BAHASA"; ?></span></a>
                           <div class="pPanel">
                           	<?php if (isset($page_language) && ! empty($page_language)) { ?>
                              <ul class="inner">
                              	<?php foreach ($page_language as $key => $value) { ?>
                              		<?php $lang_active = $value->page_language_id === $this->language_id ? 'active' : ''; ?>
                              		<?php $emblem = ""; switch ($value->icon){case 'flag-id': $emblem = 'indonesia';break;case 'flag-us': $emblem = 'english';break;case 'flag-sa': $emblem = 'arab';break;} ?>
                                 	<li class="toplang-item <?php echo $lang_active ? "active" : "" ?>"><a href="<?php echo $lang_active ? '#' : base_url() . 'set-language/' . $value->page_language_id . '/' . (isset($page_detail->guid) ? $page_detail->guid : ''); ?>"><img src="<?php echo base_url()?>assets/images/<?php echo $emblem;?>.png" alt="<?php echo $emblem;?>" class="toplang-flag" width="18" height="12"> <?php echo strtoupper($value->name); ?><?php echo $lang_active ? "<span class='glyphicon glyphicon-ok'></span>" : "" ?></a></li>
                                <?php } ?>
                              </ul>
                             <?php } ?>
                           </div>
                        </li>
                     </ul>
                     <div id="search" class="header-search">
                        <a href="#" class="searchBtn "><span class="glyphicon glyphicon-search icon-white"></span></a>
                        <div class="search-container">
                           <form id="searchform" class="header-searchform" action="https://www.google.com/search" method="get" onSubmit="Gsitesearch(this)" target="_blank"><input name="s" maxlength="20" class="inputbox" type="text" size="20" value="SEARCH ..." onblur="if (this.value=='') this.value='SEARCH ...';" onfocus="if (this.value=='SEARCH ...') this.value='';"><button type="submit" id="searchsubmit" class="searchsubmit glyphicon glyphicon-search icon-white"></button></form>
                        </div>
                     </div>
                  </div>
                  <div class="header-leftside-container ">
                     <ul class="social-icons sc--clean topnav navRight">
                        <li><a href="https://www.facebook.com/inisiatif.zakat" target="_blank" class="icon-facebook" title="Facebook"></a></li>
                        <li><a href="https://twitter.com/izi_id" target="_blank" class="icon-twitter" title="Twitter"></a></li>
                        <li><a href="https://www.instagram.com/inisiatifzakat" target="_blank" class="icon-instagram" title="Instagram"></a></li>
                        <li><a href="https://plus.google.com/113103686772171149663" target="_blank" class="icon-gplus" title="Google Plus"></a></li>                        
                     </ul>
                     <div class="clearfix visible-xxs"></div>
                     <span style="font-size:16px;font-family: Montserrat, 'Helvetica Neue', Helvetica, Arial, sans-serif;" class="kl-header-toptext"><?php if($this->language_id=='107')echo "Need Help? Contact"; if($this->language_id=='125') echo "Perlu Bantuan? Hubungi"; ?>: <a href="#" class="fw-bold" style="font-size:16px;"> 1500047</a></span>
                  </div>
               </div>
	       <?php if (!$this->agent->is_mobile()){ ?>
               <div class="separator"></div>
               <div class="logo-container logosize--yes">
                  <h1 class="site-logo logo " id="logo"><a href="<?php echo base_url()?>"><img class="logo-img" src="<?php echo base_url()?>assets/images/izi-logo.svg" alt="Izi | Memudahkan dimudahkan" title="Izi | Memudahkan dimudahkan" width="125" height="55"></a></h1>
                  <div id="infocard" class="logo-infocard">
                     <div class="custom ">
                        <div class="row">
                           <div class="col-sm-5">
                              <p>&nbsp;</p>
                              <p style="text-align: center;"><img src="<?php echo base_url()?>assets/images/izi_icon.png" alt="" width="53" height="53"></p>
                              <p style="text-align: center;">Zakat itu Mudah. Insya Allah akan Bikin hidup kita juga jadi mudah.</p>
                           </div>
                           <div class="col-sm-7">
                              <div class="custom contact-details">
                                 <p><strong>T 1500047</strong><br>Email:&nbsp;<a href="mailto:izi@izi.or.id">salam@izi.or.id</a></p>
                                 <p>INISIATIF ZAKAT INDONESIA<br>Jl. Raya Condet No 54 D-E Batu Ampar Jakarta Timur 13520 - Indonesia</p>
                                 <a href="https://www.google.co.id/maps/place/Jl.+Raya+Condet+No.27,+Batu+Ampar,+Kramatjati,+Kota+Jakarta+Timur,+Daerah+Khusus+Ibukota+Jakarta/@-6.2919113,106.8541431,17z/data=!3m1!4b1!4m2!3m1!1s0x2e69f27bcb5ccfef:0x5ced97088f704d53?hl=id" target="_blank" class="map-link"><span class="glyphicon glyphicon-map-marker icon-white"></span><span>Buka di Google Map</span></a>
                              </div>
                              <div style="height:20px;"></div>
                              <ul class="social-icons sc--clean">                                 
                                 <li><a href="https://www.facebook.com/inisiatif.zakat" target="_blank" class="icon-facebook" title="Facebook"></a></li>
                                 <li><a href="https://twitter.com/izi_id" target="_blank" class="icon-twitter" title="Twitter"></a></li>
                                 <li><a href="https://www.instagram.com/inisiatifzakat" target="_blank" class="icon-instagram" title="Instagram"></a></li>
                                 <li><a href="https://plus.google.com/113103686772171149663" target="_blank" class="icon-google" title="Google Plus"></a></li>                                 
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>
               <div class="separator visible-xxs"></div>
               <div id="zn-res-menuwrapper"><a href="#" class="zn-res-trigger zn-header-icon"></a></div>
               <div id="main-menu" class="main-nav zn_mega_wrapper ">
                  <ul id="menu-main-menu" class="main-menu zn_mega_menu">
                     <?php if (isset($page_menu) && ! empty($page_menu)) {
						create_menu($page_menu, $current, 'main');
					 } ?>
                  </ul>
               </div>
               <?php if($guid !== 'donate-now') {?>
               <a href="<?php base_url()?>donate-now" id="ctabutton" class="ctabutton kl-cta-ribbon" title="Donate Now" target="_self">
                  <strong>Donate</strong>Now
                  <svg version="1.1" class="trisvg" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" preserveaspectratio="none" width="14px" height="5px" viewbox="0 0 14.017 5.006" enable-background="new 0 0 14.017 5.006" xml:space="preserve">
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M14.016,0L7.008,5.006L0,0H14.016z"></path>
                  </svg>
               </a>
               <?php } ?>
               <ul class="topnav navLeft topnav--cart">
               	  <li>
               	  	<a href="<?php base_url()?>kalkulator" title="Kalkulator Zakat"><span class="glyphicon glyphicon-calendar icon-white"></span></a>               	  	
               	  </li>
               	  <?php if($guid !== 'confirm'){?>
               	  <li>               	  	
               	  	<a  href="<?php base_url()?>confirm" title="Confirm Donation"><span class=""><?php if($this->language_id=='107')echo "CONFIRM DONATION"; if($this->language_id=='125') echo "KONFIRMASI DONASI"; ?></span></a>
               	  </li>
               	  <?php }?>
                  <li class="drop">                  	 
                  	<?php if (isset($_SESSION['login']['profile']['user_id'])) { ?>               	
                     <a id="mycartbtn" class="kl-cart-button" href="<?php base_url()?>myaccount" title="Show account"><span class="hidden-xs"><?php echo $user->first_name.' '.$user->last_name;?></span></a>
                     <?php }?>
                  </li>
               </ul>
            </div>
         </header>
