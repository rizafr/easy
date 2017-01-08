

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
							<li><a href="<?php echo $breadcrumb->guid; ?>"><?php echo $breadcrumb->menu; ?></a></li>
							<?php }}?>
						</ul>
						<span id="current-date" class="subheader-currentdate"><?php echo date('M d Y'); ?></span>
						<div class="clearfix"></div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="kl-bottommask kl-bottommask--shadow_ud"></div>
</div>
</div>
<section class="hg_section ptop-50">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-9">
				<div class="itemListView clearfix eBlog">
				<?php if (isset($article_list) && ! empty($article_list)) { ?>  
					<div class="itemList">
						<?php foreach ($article_list as $key => $value) { ?>
						<div class="itemContainer">
							<div class="itemHeader">
								<h3 class="itemTitle">
									<a href="<?php echo base_url() . $value->guid; ?>"><?php echo $value->content[$this->language_id]->title; ?></a>
								</h3>
								<div class="post_details">
									<span class="catItemDateCreated"><?php echo $value->created_date; ?> </span><span
										class="catItemAuthor">by <a href="#"
										title="Posts by <?php echo $value->author; ?>" rel="author"><?php echo $value->author; ?></a></span>
								</div>
							</div>
							<div class="itemBody">
								<div class="itemIntroText">
									<div class="hg_post_image">
									<?php if ($value->image && file_exists($this->path . 'uploads/images/' . $value->type . '/' . 'full' . '/' . $value->image)) { ?>
										<a href="<?php echo base_url() . $value->guid; ?>"
											class="pull-left"><img
											src="<?php echo base_url() . 'uploads/images/' . $value->type . '/' . 'full' . '/' . $value->image; ?>"
											class="attachment-460x320 wp-post-image"
											alt="<?php echo $value->content[$this->language_id]->title; ?>"
											height="320" width="457"> </a>
									<?php } ?>
									</div>
									<p><?php echo trim_text($value->content[$this->language_id]->body,400); ?></p>
								</div>
								<div class="clear"></div>
								<div class="itemBottom clearfix">
									<div class="itemReadMore">
										<a class="btn btn-fullcolor readMore"
											href="<?php echo base_url() . $value->guid; ?>">Read more</a>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="itemComments">
								<a href="#">No Comments</a>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<div class="clear"></div>
				<div>
					<ul class="pagination" style="font-size: 18px;">
				<?php if (isset($total_page) && ! empty($total_page)) { ?>
				<?php $pagination_side = 2; ?>
				<?php $pagination_count = ($pagination_side * 2); ?>
				<?php $pagination_left = $pagination - 1 < $pagination_side ? $pagination - 1 : ($total_page - $pagination < $pagination_side ? $pagination_count - ($total_page - $pagination) : $pagination_side); ?>
				<?php $pagination_right = $total_page - $pagination < $pagination_side ? $total_page - $pagination : ($pagination - 1 < $pagination_side ? $pagination_count - ($pagination - 1) : $pagination_side); ?>
				
				<?php $pagination_archive = isset($pagination_archive) ? $pagination_archive : ''; ?>

				<?php if ($pagination > 1) { ?>
					<a class="navlinks"
							href="<?php echo base_url() . $page_detail->guid . $pagination_archive . '/1'; ?>">&laquo;</a>
						<a class="navlinks"
							href="<?php echo base_url() . $page_detail->guid . $pagination_archive . '/' . ($pagination - 1); ?>">&lsaquo;</a>
				<?php } else { ?>
					<a class="navlinks disabled">&laquo;</a>
						<a class="navlinks disabled">&lsaquo;</a>
				<?php } ?>

				<?php for ($i=1; $i <= $total_page; $i++) { ?>
					<?php $pagination_visible = FALSE; ?>

					<?php if (($i < $pagination && $pagination - $i <= $pagination_left)) {
						$pagination_visible = TRUE;
					} else if (($i > $pagination && $i - $pagination <= $pagination_right)) {
							$pagination_visible = TRUE;
					} else if ($i == $pagination) {
							$pagination_visible = TRUE;
					} ?>

					<?php if ($pagination_visible) { ?>
						<?php if ($i == $pagination) { ?>
						<a style="color: #a2ca2b;" class="navlinks current disabled"><?php echo $i; ?></a>
						<?php } else { ?>
						<a class="navlinks"
							href="<?php echo base_url() . $page_detail->guid . $pagination_archive . '/' . $i; ?>"><?php echo $i; ?></a>
						<?php } ?>
					<?php } ?>

				<?php } ?>

				<?php if ($pagination < $total_page) { ?>
					<a class="navlinks"
							href="<?php echo base_url() . $page_detail->guid . $pagination_archive . '/' . ($pagination + 1); ?>">&rsaquo;</a>
						<a class="navlinks"
							href="<?php echo base_url() . $page_detail->guid . $pagination_archive . '/' . $total_page; ?>">&raquo;</a>
				<?php } else { ?>
					<a class="navlinks disabled">&rsaquo;</a>
						<a class="navlinks disabled">&raquo;</a>
				<?php } ?>
				<span style="font-size: 12px;">Page <?php echo $pagination; ?> of <?php echo $total_page; ?></span>
					</ul>
			<?php } ?>
			</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div id="sidebar-widget" class="sidebar">
					<div class="widget widget_recent_entries">
						<div class=" latest_posts style3">
							<h3 class="widgettitle title"><?php echo strtoupper($breadcrumb->menu . ' Terbaru'); ?></h3>
									<?php if (isset($latest_article) && ! empty($latest_article)) { ?>
									<ul class="posts">
										<?php foreach ($latest_article as $key => $value) { ?>
										<?php $language_id = isset($value->content[$this->language_id]) ? $this->language_id : 'default'; ?>
										<li class="lp-post">
									<a	href="<?php echo base_url() . $value->guid; ?>"
										class="hoverBorder pull-left"> <span class="hoverBorderWrapper"> <img
												src="<?php echo base_url() . 'uploads/images/' . $page_detail->type . '/' . 'thumb' . '/' . $value->image; ?>"
												alt="<?php echo $value->content[$this->language_id]->title; ?>" width=84> <span
												class="theHoverBorder"></span>
										</span>
									</a>
									<h4 class="title">
										<a href="<?php echo base_url() . $value->guid; ?>"
											title="<?php echo $value->content[$this->language_id]->title; ?>"><?php echo $value->content[$this->language_id]->title; ?></a>
									</h4>
									<div class="col-md-12"><div class="col-md-6 lp-post-comments-num">0 comments</div> <div class="col-md-6 lp-post-comments-num"><?php echo $value->content[$this->language_id]->visitor;?>?> visitor</div></div>
								</li>	
										<?php } ?>							
									</ul>
									<?php } ?>
                                </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
