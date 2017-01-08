
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
						<div class="subheader-titles">
						</div>
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
			<div class="col-md-8 col-sm-12">
				<section class="hg_section ptop-50">
					<div class="container">
						<div class="row">
							<div class="col-md-9 col-sm-9">
								<div class="itemListView clearfix eBlog">
									<div class="itemList">
										<div class="itemContainer">
											<div class="itemHeader">
												<h3 class="itemTitle" <?php if($page_language_id=='149') echo "style='text-align:right;'";?>>
													<a><?php echo $page_detail->content[$this->language_id]->title; ?></a>
												</h3>
												<div class="post_details" <?php if($page_language_id=='149') echo "style='text-align:right;'";?>>
													<span class="catItemDateCreated"> <?php echo $page_detail->created_date_short; ?> </span><span
														class="catItemAuthor">by <a href="#"
														title="Posts by <?php echo $page_detail->author; ?>" rel="author"><?php echo $page_detail->author; ?></a></span>
												</div>
											</div>
											<div class="itemBody">
												<div class="itemIntroText">
												<?php if (isset($page_image) && ! empty($page_image)) { ?>
													<div class="hg_post_image <?php if($page_language_id=='149') echo "pull-right";?>">
														<?php foreach ($page_image as $key => $value) { ?>
														<a															
															<?php if($page_language_id=='149') echo "class='pull-right'";else echo "class='pull-left'";?>><img
															src="<?php echo base_url() . 'uploads/images/' . $page_detail->type . '/' . 'full' . '/' . $value->file_name; ?>"
															class="attachment-460x320 wp-post-image"
															alt="<?php echo $value->name; ?>" height="100%" width="100%"></a>
													</div>
													<?php } ?>
												<?php } ?>
												<div class="clear"></div>
												<div <?php if($page_language_id=='149') echo "class='pull-right' style='text-align:right;'";?>>
												<h5>SHARE :</h5>												
												<div style="padding-bottom:10px;">							
													<div style="<?php if($page_language_id=='149') echo "float: right;"; else echo "float: left;";?>padding-right:10px;" class="fb-like" data-href="<?php echo base_url().$guid;?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
													<div style="<?php if($page_language_id=='149') echo "float: right;"; else echo "float: left;";?>padding-right:10px;padding-top:4px;"><a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="inisiatifzakatindonesia">Tweet</a></div>
													<div style="<?php if($page_language_id=='149') echo "float: right;"; else echo "float: left;";?>padding-right:10px;padding-top:4px;"><script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
														<script type="IN/Share" data-counter="right"></script></div>
													<div style="<?php if($page_language_id=='149') echo "float: right;width:210px;"; else echo "float: left;";?>padding-top:10px;"  class="g-plusone" data-annotation="inline" data-width="300"></div>
												</div></div>
												<div <?php if($page_language_id=='149') echo "style='text-align:right;padding-top:70px;'";?>>
												<?php echo $page_detail->content[$this->language_id]->body; ?>
												</div>
												<div class="clear"></div>
												<div style="float: right;">												
												<div style="padding-bottom:10px;">							
													<div style="float: left;padding-right:10px;" class="fb-like" data-href="<?php echo base_url().$guid;?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
													<div style="float: left;padding-right:10px;padding-top:4px;"><a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="inisiatifzakatindonesia">Tweet</a></div>
													<div style="float: left;padding-right:10px;padding-top:4px;"><script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
														<script type="IN/Share" data-counter="right"></script></div>
													<div style="float: left;padding-top:10px;"  class="g-plusone" data-annotation="inline" data-width="300"></div>
												</div>
												</div>
												
												<div class="clear"></div>
													<?php if (isset($page_related) && ! empty($page_related)) { ?>													
													<div class="related-articles">														
														<h2 class="rta-title"><?php if($this->language_id=='107')echo strtoupper('Related '.$parent_detail->content[$this->language_id]->menu); else echo strtoupper($parent_detail->content[$this->language_id]->menu . ' Terkait'); ?></h2>
														<div class="row">														
															<?php foreach ($page_related as $key => $value) { ?>
															<div class="col-sm-4">
																<div class="rta-post">
																	<a
																		href="<?php echo base_url().$value->guid;?>">
																		<img
																		src="<?php echo base_url() . 'uploads/images/' . $page_detail->type . '/' . 'thumb' . '/' . $value->image; ?>"
																		class="img-responsive" alt="" height="240" width="370">
																	</a>
																	<h5>
																		<a
																			href="<?php echo base_url().$value->guid;?>"><?php echo $value->title;?></a>
																	</h5>
																</div>
															</div>
																<?php } ?>															
														</div>														
													</div>
													<?php } ?>
												
												
												<div class="comment-form-wrapper">
	<div class="clear"></div>
	<div class="zn-separator zn-margin-b line" style="border-top:1px solid #E9E9E9"></div>	
	<?php
	function get_comment($comment, $chaild, $child = 1) {
		if (is_array($comment)) {
			foreach ($comment as $key => $value) {
			?>			
			<li
				class="comment byuser comment-author-danut even thread-even depth-1">
				<div id="comment-2">
					<div class="comment-author vcard">
						<cite
							class="fn"><?php echo $value['name']; ?></cite> says : <?php if ($child < 5) { ?><a rel="nofollow"
							class="comment-reply-link"
							href="#"							
							data-id="<?php echo $value['comment_id']; ?>"
							aria-label="Reply <?php echo $value['name']; ?>">Reply</a>
							<?php } ?>
					</div>
					<div class="comment-meta commentmetadata">
						<a
							href="#"><?php echo $value['created_date']; ?></a>
					</div>
					<p><?php echo $value['message']; ?></p>
					<div class="zn-separator sep_normal zn-margin-d"></div>
				</div>
			</li>
			<?php
				$has_child = isset($value['children']) && ! empty($value['children']);
				if ($has_child) {
					get_comment($value['children'],'chaild',($child + 1));
				}
				?>
			<?php
			}
		}
	}
	?>
	<div class="zn_comments sixteen columns">
		<h3 id="comments"><?php if($page_language_id=='107') echo "COMMENT"; if($page_language_id=='125') echo "KOMENTAR";?></h3>
		<div class="navigation">
			<div class="alignleft"></div>
			<div class="alignright"></div>
		</div>
		<ol class="commentlist">
			<?php get_comment($comment,''); ?>
		</ol>		
		<div class="navigation">
			<div class="alignleft"></div>
			<div class="alignright"></div>
		</div>
		<div class="clear"></div>
		<div id="other"></div>
		<div id="respond" class="comment-respond">
			<h3 id="reply-title" class="comment-reply-title">
				<?php if($page_language_id=='107') echo "Leave Message"; if($page_language_id=='125') echo "Tinggalkan Pesan";?>
			</h3>
			<form id="comment-form" method="post"
				enctype="multipart/form-data"
				action="<?php echo base_url() . $page_detail->guid; ?>/comment">

			<input type="hidden" name="page_id" value="<?php echo $page_detail->page_id; ?>" />
			<input type="hidden" name="parent" id="comment-parent" />
			<div class="col-md-3">
				<a><?php if($page_language_id=='107') echo "Name"; if($page_language_id=='125') echo "Nama";?> <span style="color: #ff0000;">*</span></a>
			</div>
			<div class="col-md-9">
				<span style="color: #ff0000;" id="name"></span>
				<input class="input-text" name="name" id="name" type="text" style="box-sizing: border-box;
					width: 100%;
					margin-bottom: 8px;
					border: 1px solid #d8d8d8;
					padding: 7px 10px;
					box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
					border-radius: 3px;">
					
			</div>
			<div class="col-md-3">
				<a>Email <span style="color: #ff0000;">*</span></a>
			</div>
			<div class="col-md-9">
				<input class="input-text" name="email" id="mail" type="text" style="box-sizing: border-box;
					width: 100%;
					margin-bottom: 8px;
					border: 1px solid #d8d8d8;
					padding: 7px 10px;
					box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
					border-radius: 3px;">
					<span style="color: #ff0000;" id="email"></span>
			</div>
			<div class="col-md-12">
				<span style="color: #ff0000;" id="message"></span>
				<textarea class="input-text" name="message" type="text" style="border: 1px solid #d8d8d8;
					height: auto;
					min-height: 230px;
					padding: 7px 10px;
					width:100%;
					margin-top: 20px;
					/* font-size: 14px; */
					box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
					border-radius: 3px;" placeholder="<?php if($page_language_id=='107') echo "Leave Message"; if($page_language_id=='125') echo "Tulis Pesan";?>"></textarea>
					<div class="clearfix"></div>
			</div>
			<div class="col-md-12"><input name="send" class="btn-element btn btn-success pull-right" type="submit" value="SUBMIT" style="margin-top: 20px;"/></div>
			</form>
		</div>
	</div>
</div>
												
												
												</div>
												<div class="clear"></div>
											</div>
											<div class="clear"></div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-3">
							<div id="sidebar-widget" class="sidebar">
								<div class="widget widget_recent_entries">
									<div class=" latest_posts style3">
										<h3 class="widgettitle title"><?php if($this->language_id=='107')echo strtoupper('New '.$parent_detail->content[$this->language_id]->menu); else echo strtoupper($parent_detail->content[$this->language_id]->menu . ' Terbaru'); ?></h3>
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
												<div class="col-md-12"><div class="col-md-6 lp-post-comments-num"><?php echo count($comment);?> comments</div> <div class="col-md-6 lp-post-comments-num"><?php echo $value->content[$this->language_id]->visitor;?>  visitor</div></div>	
											<?php } ?>							
										</ul>
										<?php } ?>
									</div>
								</div>
							</div>
							<div id="sidebar-widget" class="sidebar">
								<div class="widget widget_recent_entries">
									<div class=" latest_posts style3">
										<h3 class="widgettitle title"><?php if($this->language_id=='107')echo strtoupper('Popular '.$parent_detail->content[$this->language_id]->menu); else echo strtoupper($parent_detail->content[$this->language_id]->menu . ' Populer'); ?></h3>
										<?php if (isset($popular_article) && ! empty($popular_article)) { ?>
										<ul class="posts">
											<?php foreach ($popular_article as $key => $value) { ?>
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
												<div class="col-md-12"><div class="col-md-6 lp-post-comments-num"><?php echo count($comment);?> comments</div> <div class="col-md-6 lp-post-comments-num"><?php echo $value->content[$this->language_id]->visitor;?> visitor</div></div>
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
				<!-- <div
					class="kl-title-block clearfix text-left tbk-symbol-- tbk-icon-pos--after-title">
					<h3 class="tbk__title montserrat fw-bold fs-28"></h3>
					<h4 class="tbk__subtitle fw-vthin fs-16 lh-32"></h4>
				</div> -->
			</div>
		</div>
	</div>
</section>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
