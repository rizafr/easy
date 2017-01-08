<div class="container">
	<div class="content_left">
		<?php if (isset($search_list) && ! empty($search_list)) { ?>
			<?php foreach ($search_list as $key => $value) { ?>
			<?php $language_id = isset($value->content[$this->language_id]) ? $this->language_id : 'default'; ?>
			<div class="blog_post">
				<div class="blog_postcontent">
					<?php if ($value->image) { ?>
					<div class="image_frame small">
						<a href="<?php echo base_url() . $value->guid; ?>">
						<img src="<?php echo base_url(); ?>uploads/images/<?php echo $value->type; ?>/thumb/<?php echo $value->image; ?>" alt="" title="" />
						</a>
					</div>
					<?php } else { ?>
					<div class="image_frame small">
						<a href="<?php echo base_url() . $value->guid; ?>">
						<img src="<?php echo base_url(); ?>assets/images/no-image.png" alt="" title="" />
						</a>
					</div>
					<?php } ?>

					<?php list($day,$date) = explode(', ',$value->created_date); ?>
					<?php list($d,$b,$y) = explode(' ',$date); ?>
					<div class="post_info_content_small">
						<a href="#" class="date">
						<strong><?php echo $d; ?></strong><i><?php echo $b; ?></i>
						</a>
						<h3>
							<a href="<?php echo base_url() . $value->guid; ?>"><?php echo $value->content[$language_id]->menu; ?></a>
						</h3>
						<ul class="post_meta_links_small">
							<li class="post_by">
								<a href="#"><?php echo $value->author; ?></a>
							</li>
							<li class="post_categoty">
								<?php if (isset($value->category_guid) && ! empty($value->category_guid)) { ?>
								<?php $category_guid = explode(',', $value->category_guid); ?>
								<?php foreach ($category_guid as $k => $val) { ?>
								<?php $v = explode(':', $val); ?>
								<a href="#"><?php echo $v[0]; ?></a>
								,
								<?php } ?>
								<?php } ?>
							</li>
							<li class="post_comments">
								<a href="#">0 Comment</a>
							</li>
						</ul>
						<div class="clearfix">
						</div>
						<?php echo substr(strip_tags($value->content[$language_id]->body),0,300); ?>
					</div>
				</div>
			</div>

			<div class="clearfix divider_dashed9"></div>

			<?php } ?>

		<?php } else { ?>
			<div class="blog_post">
				<h3 class="clearfix first">Search not found....</h3>
			</div>
		<?php } ?>

		<div class="pagination">
			<?php if (isset($total_page) && ! empty($total_page)) { ?>
				<?php $pagination_side = 2; ?>
				<?php $pagination_count = ($pagination_side * 2); ?>
				<?php $pagination_left = $pagination - 1 < $pagination_side ? $pagination - 1 : ($total_page - $pagination < $pagination_side ? $pagination_count - ($total_page - $pagination) : $pagination_side); ?>
				<?php $pagination_right = $total_page - $pagination < $pagination_side ? $total_page - $pagination : ($pagination - 1 < $pagination_side ? $pagination_count - ($pagination - 1) : $pagination_side); ?>
				
				<?php if ($pagination > 1) { ?>
					<a class="navlinks" href="<?php echo base_url() . 'search/' . $keyword . '/1'; ?>">&laquo;</a>
					<a class="navlinks" href="<?php echo base_url() . 'search/' . $keyword . '/' . ($pagination - 1); ?>">&lsaquo;</a>
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
						<a class="navlinks current disabled"><?php echo $i; ?></a>
						<?php } else { ?>
						<a class="navlinks" href="<?php echo base_url() . 'search/' . $keyword . '/' . $i; ?>"><?php echo $i; ?></a>
						<?php } ?>
					<?php } ?>

				<?php } ?>

				<?php if ($pagination < $total_page) { ?>
					<a class="navlinks" href="<?php echo base_url() . 'search/' . $keyword . '/' . ($pagination + 1); ?>">&rsaquo;</a>
					<a class="navlinks" href="<?php echo base_url() . 'search/' . $keyword . '/' . $total_page; ?>">&raquo;</a>
				<?php } else { ?>
					<a class="navlinks disabled">&rsaquo;</a>
					<a class="navlinks disabled">&raquo;</a>
				<?php } ?>
				<span>Page <?php echo $pagination; ?> of <?php echo $total_page; ?></span>
			<?php } ?>
		</div>
	</div>

	<div class="right_sidebar">
		<div class="sidebar_widget">
			<div class="sidebar_title">
				<h3><i>Artikel</i> Terbaru</h3>
			</div>
			<ul class="recent_posts_list">
				<?php if (isset($latest_article) && ! empty($latest_article)) { ?>
					<?php foreach ($latest_article as $key => $value) { ?>
						<?php $item_lang_id = isset($value->content[$this->language_id]) ? $this->language_id : 'default'; ?>
						<li>
							<span>
								<a href="<?php echo base_url() . $value->guid; ?>">
									<img src="<?php echo base_url() . 'uploads/images/' . $value->type . '/thumb/' . $value->image; ?>" alt="" />
								</a>
							</span>
							<a href="<?php echo base_url() . $value->guid; ?>"><?php echo $value->content[$item_lang_id]->menu; ?></a>
							<i><?php echo $value->created_date; ?></i>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
