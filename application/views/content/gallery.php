
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
							<li><a href="<?php echo $breadcrumb->guid; ?>"><?php echo $breadcrumb->menu;?></a></li>
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

<section class="hg_section ptop-40 pbottom-20">
	<div class="hg_section_size container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="gridPhotoGallery-container">
				<?php if (isset($image_list) && ! empty($image_list)) { ?>
						<?php foreach ($image_list as $key => $value) { ?>		
							<h2><?php echo $value->content[$this->language_id]->title; ?></h2>
							<div style="position: relative; height: 100%;" class="gridPhotoGallery mfp-gallery misc gridPhotoGallery--ratio-short gridPhotoGallery--cols-4" data-cols="4">							
										<?php if (isset($value->images) && ! empty($value->images)) { ?>
											<?php foreach ($value->images as $index => $image) { ?>									
								<div class="gridPhotoGallery__item gridPhotoGalleryItem--w1 ">
									<a title="<?php echo $image->name; ?>" class="gridPhotoGalleryItem--h1 gridPhotoGallery__link hoverBorder" data-lightbox="mfp" data-mfp="image" href="<?php echo base_url() . 'uploads/images/' . $page_detail->type . '/' . 'full' . '/' . $image->file_name; ?>">
									<div class="gridPhotoGallery__img" style="background-image:url(<?php echo base_url() . 'uploads/images/' . $page_detail->type . '/' . 'thumb' . '/' . $image->file_name; ?>)">
									</div>
									<i class="kl-icon glyphicon glyphicon-search circled-icon ci-large"></i></a>
								</div>
								<?php } ?> 	
										<?php } ?> 											
							</div>
							<div style="margin-top:240px;"></div>				
				<?php } ?>
					<?php } ?>	
			</div>
			</div>
		</div>
	</div>
</section>