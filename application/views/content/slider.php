<?php 
            	$mobile = false;
            	if ($this->agent->is_mobile()){
            		$mobile = true;
				}	
?>
<div id="dp-js-header-helper" style="height:0 !important; display:none !important;"></div>
         <div class="kl-slideshow iosslider-slideshow uh_light_gray maskcontainer--shadow_ud iosslider--custom-height scrollme kl-slider-loaded pb-47">
            <div class="kl-loader">
               <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewbox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                  <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946 s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634 c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path>
                  <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0 C22.32,8.481,24.301,9.057,26.013,10.047z" transform="rotate(98.3774 20 20)">
                     <animatetransform attributetype="xml" attributename="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatcount="indefinite"></animatetransform>
                  </path>
               </svg>
            </div>
            <div class="bgback"></div>
            <div class="th-sparkles"></div>            
            <div class="iosSlider kl-slideshow-inner animateme" data-trans="6000" data-autoplay="1" data-infinite="true" data-when="span" data-from="0" data-to="0.75" <?php echo $mobile==false ? "data-translatey='300'" : "";?> data-easing="linear" >
               <div class="kl-iosslider hideControls">
               	  <?php if (isset($slider) && ! empty($slider)) { $count = 0; ?>               	  	
					<?php foreach ($slider as $key => $value) { ?>
                  <div class="item iosslider__item">
                     <div class="slide-item-bg" style="background-image:url(<?php echo base_url()?>uploads/slides/<?php echo $value->image;?>); <?php echo $mobile==true ? "background-size:100% 100%;" : "";?>"></div>
                     <div class="kl-slide-overlay" style="background:rgba(132,30,193,0.25); background: -moz-linear-gradient(left, rgba(132,30,193,0.25) 0%, rgba(61,15,15,0.3) 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(132,30,193,0.25)), color-stop(100%,rgba(61,15,15,0.3))); background: -webkit-linear-gradient(left, rgba(132,30,193,0.25) 0%,rgba(61,15,15,0.3) 100%); background: -o-linear-gradient(left, rgba(132,30,193,0.25) 0%,rgba(61,15,15,0.3) 100%); background: -ms-linear-gradient(left, rgba(132,30,193,0.25) 0%,rgba(61,15,15,0.3) 100%); background: linear-gradient(to right, rgba(132,30,193,0.25) 0%,rgba(61,15,15,0.3) 100%); "></div>
                     <div class="container kl-iosslide-caption kl-ioscaption--style5 fromleft <?php echo $value->position;?> kl-caption-posv-middle">
                        <div class="animateme" data-when="span" data-from="0" data-to="0.75" data-opacity="0.1" data-easing="linear">
                           <h2 class="main_title has_titlebig "><span style="font-family: Montserrat, 'Helvetica Neue', Helvetica, Arial, sans-serif;"><?php echo $value->title;?></span></h2>
                           <h4 class="title_big"><?php echo $value->description; ?></h4>
                           <?php if($value->vidbutt == 2) {?>
                           <div class="klios-playvid"><a href="<?php echo $value->url;?>?loop=1&amp;start=0&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;wmode=transparent&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0" data-lightbox="youtube"><i class="kl-icon glyphicon glyphicon-play circled-icon ci-large"></i></a></div>
                           <?php } ?>
                           <?php if($value->vidbutt == 1) {?>
                           <div class="more"><a class="btn btn-fullcolor " href="<?php echo $value->url;?>" target="_self"><?php echo $value->label;?></a></div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  		<?php $count++; } ?>
                  <?php } ?>      
               </div>
               <div class="kl-iosslider-prev" style="cursor: pointer;">
                  <span class="thin-arrows ta__prev"></span>
                  <div class="btn-label">PREV</div>
               </div>
               <div class="kl-iosslider-next" style="cursor: pointer;">
                  <span class="thin-arrows ta__next"></span>
                  <div class="btn-label">NEXT</div>
               </div>
            </div>
            <div class="kl-ios-selectors-block bullets2">
               <div class="selectors">
               <?php if (isset($slider) && ! empty($slider)) { 
               		for($i=0;$i<$count;$i++) {
               ?>
                  <div class="item iosslider__bull-item first"></div>
                	<?php } ?>
                <?php } ?>
               </div>
            </div>
            <div class="scrollbarContainer"></div>
            <div class="kl-bottommask kl-bottommask--shadow_ud"></div>
         </div>
