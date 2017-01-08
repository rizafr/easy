<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>Home Page - <span class="semi-bold">Edit</span></h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>pages/pages_home_process/edit/<?php echo $id; ?>" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">
						<div class="grid-title no-border">
							<h4>Slider <span class="semi-bold">Image</span></h4>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid">
								<?php if (isset($image) && ! empty($image)) { ?>
								<?php foreach ($image as $key => $value) { ?>
								<div class="row-fluid slider-wrapper">
									<div class="row-fluid">
										<div class="relative span6">
											<img class="slider-image span12" src="<?php echo $this->dir; ?>uploads/images/article/full/<?php echo $value->file_name; ?>" />
											<div class="remove-sliders-button"><a class="remove-sliders" data-id="<?php echo $value->page_image_id; ?>" data-img="<?php echo $value->file_name; ?>" title="remove"><i class="icon-remove"></i></a></div>
										</div>
										<div class="span6">
											<!--
											<input type="file" name="slider_update[]" id="slider-update-1" class="nicefileinput" />
											<span class="error"><label for="slider-update-1" class="error"></label></span>
											-->
										</div>
									</div>
									<div class="row-fluid">
										<div class="span12">
											<?php if (isset($language) && ! empty($language)) { ?>
												<?php foreach ($language as $k => $val) { ?>
													<div class="row-fluid">
														<div class="box-flag relative span6">
															<div class="label-flag flag <?php echo $val->icon; ?>"></div>
															<input type="text" name="current_slider[<?php echo $value->page_image_id; ?>][name][<?php echo $val->page_language_id; ?>]" class="input-flag span12" placeholder="Slider Title (<?php echo $val->name; ?>)" value="<?php echo $value->slider[$val->page_language_id]->slider_title; ?>" />
														</div>
														<div class="box-flag relative span6">
															<div class="label-flag flag <?php echo $val->icon; ?>"></div>
															<textarea name="current_slider[<?php echo $value->page_image_id; ?>][description][<?php echo $val->page_language_id; ?>]" class="input-flag elastic span12" placeholder="Slider Description (<?php echo $val->name; ?>)"><?php echo $value->slider[$val->page_language_id]->slider_description; ?></textarea>
														</div>
													</div>
												<?php } ?>
											<?php } ?>
										</div>
									</div>
									<div class="row-fluid column-seperation">
										<div class="span6">
											<div class="row-fluid">
												<?php if (isset($language) && ! empty($language)) { ?>
												<?php $button_link = ''; ?>
												<div class="span6">
													<?php foreach ($language as $k => $val) { ?>
													<?php $button_link = $value->slider[$val->page_language_id]->slider_link1; ?>
													<div class="row-fluid">
														<div class="box-flag relative span12">
															<div class="label-flag flag <?php echo $val->icon; ?>"></div>
															<input type="text" name="current_slider[<?php echo $value->page_image_id; ?>][button1][<?php echo $val->page_language_id; ?>]" class="input-flag span12" placeholder="Button 1 Name (<?php echo $val->name; ?>)" value="<?php echo $value->slider[$val->page_language_id]->slider_button1; ?>" />
														</div>
													</div>
													<?php } ?>
												</div>
												<div class="span6">
													<textarea name="current_slider[<?php echo $value->page_image_id; ?>][link1]" class="input-flag elastic span11" placeholder="Button 1 Link"><?php echo $button_link; ?></textarea>
												</div>
												<?php } ?>
											</div>
										</div>
										<div class="span6">
											<div class="row-fluid">
												<?php if (isset($language) && ! empty($language)) { ?>
												<?php $button_link = ''; ?>
												<div class="span6">
													<?php foreach ($language as $k => $val) { ?>
													<?php $button_link = $value->slider[$val->page_language_id]->slider_link2; ?>
													<div class="row-fluid">
														<div class="box-flag relative span12">
															<div class="label-flag flag <?php echo $val->icon; ?>"></div>
															<input type="text" name="current_slider[<?php echo $value->page_image_id; ?>][button2][<?php echo $val->page_language_id; ?>]" class="input-flag span12" placeholder="Button 2 Name (<?php echo $val->name; ?>)" value="<?php echo $value->slider[$val->page_language_id]->slider_button2; ?>" />
														</div>
													</div>
													<?php } ?>
												</div>
												<div class="span6">
													<textarea name="current_slider[<?php echo $value->page_image_id; ?>][link2]" class="input-flag elastic span12" placeholder="Button 2 Link"><?php echo $button_link; ?></textarea>
												</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
								<?php } ?>
								<div class="clearfix"></div>
							</div>

							<div class="row-fluid">
								<div class="span12">
									<div class="row-fluid">
										<div class="slider-upload-wrapper span12">
											<h5 class="semi-bold">Add Slider Image</h5>
											<div class="row-fluid slider-wrapper default">
												<div class="row-fluid">
													<div class="span6">
														<div class="row-fluid relative file-wrapper">
															<input type="file" name="slider_upload[]" id="slider-upload-1" class="nicefileinput" />
															<span class="error"><label for="slider-upload-1" class="error"></label></span>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span12">
														<?php if (isset($language) && ! empty($language)) { ?>
														<?php foreach ($language as $key => $value) { ?>
														<div class="row-fluid">
															<div class="box-flag relative span6">
																<div class="label-flag flag <?php echo $value->icon; ?>"></div>
																<input type="text" name="slider[<?php echo $value->page_language_id; ?>][name][]" class="input-flag span12" placeholder="Slider Title (<?php echo $value->name; ?>)" />
															</div>
															<div class="box-flag relative span6">
																<div class="label-flag flag <?php echo $value->icon; ?>"></div>
																<textarea name="slider[<?php echo $value->page_language_id; ?>][description][]" class="input-flag elastic span12" placeholder="Slider Description (<?php echo $value->name; ?>)"></textarea>
															</div>
														</div>
														<?php } ?>
														<?php } ?>
													</div>
												</div>
												<div class="row-fluid column-seperation">
													<div class="span6">
														<div class="row-fluid">
															<div class="span6">
																<?php if (isset($language) && ! empty($language)) { ?>
																<?php foreach ($language as $key => $value) { ?>
																<div class="row-fluid">
																	<div class="box-flag relative span12">
																		<div class="label-flag flag <?php echo $value->icon; ?>"></div>
																		<input type="text" name="slider[<?php echo $value->page_language_id; ?>][button1][]" class="input-flag span12" placeholder="Button 1 Name (<?php echo $value->name; ?>)" />
																	</div>
																</div>
																<?php } ?>
																<?php } ?>
															</div>
															<div class="span6">
																<textarea name="slider_link1[]" class="input-flag elastic span11" placeholder="Button 1 Link"></textarea>
															</div>
														</div>
													</div>
													<div class="span6">
														<div class="row-fluid">
															<div class="span6">
																<?php if (isset($language) && ! empty($language)) { ?>
																<?php foreach ($language as $key => $value) { ?>
																<div class="row-fluid">
																	<div class="box-flag relative span12">
																		<div class="label-flag flag <?php echo $value->icon; ?>"></div>
																		<input type="text" name="slider[<?php echo $value->page_language_id; ?>][button2][]" class="input-flag span12" placeholder="Button 2 Name (<?php echo $value->name; ?>)" />
																	</div>
																</div>
																<?php } ?>
																<?php } ?>
															</div>
															<div class="span6">
																<textarea name="slider_link2[]" class="input-flag elastic span12" placeholder="Button 2 Link"></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span12">
											<button type="button" class="btn btn-primary btn-mini add-slider"><i class="icon-plus"></i>&nbsp;Add Slider</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">
						<ul class="nav nav-tabs" id="content-tab">
							<?php if (isset($language) && ! empty($language)) { ?>
							<?php foreach ($language as $key => $value) { ?>
							<li class="<?php echo $value->default ? 'active' : ''; ?>">
								<a href="#<?php echo $value->name; ?>"><?php echo $value->name; ?></a>
							</li>
							<?php } ?>
							<?php } ?>
						</ul>
						<div class="tab-content" id="tab-content">
							<?php if (isset($language) && ! empty($language)) { ?>
							<?php foreach ($language as $key => $value) { ?>
							<div class="tab-pane <?php echo $value->default ? 'active' : ''; ?>" id="<?php echo $value->name; ?>">

								<div class="row-fluid">
									<div class="span12">
										<h5 class="semi-bold">Visi Misi</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_visi_misi = isset($setting[$value->page_language_id]->visi_misi) && $setting[$value->page_language_id]->visi_misi ? ($setting[$value->page_language_id]->visi_misi) : (isset($setting['default']->visi_misi) ? ($setting['default']->visi_misi) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][visi_misi]" id="page-setting-visi_misi-<?php echo $value->page_language_id; ?>" placeholder="Visi Misi" class="span12" value="<?php echo $page_setting_visi_misi; ?>" />
												<span class="error"><label for="page-setting-visi_misi-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>

								<div class="row-fluid column-seperation">
									<div class="span4">
										<h5 class="semi-bold">Weapon Title</h5>
										<div class="row-fluid">
											<div class="span11">
												<?php $page_setting_weapon_title = isset($setting[$value->page_language_id]->weapon_title) && $setting[$value->page_language_id]->weapon_title ? ($setting[$value->page_language_id]->weapon_title) : (isset($setting['default']->weapon_title) ? ($setting['default']->weapon_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][weapon_title]" id="page-setting-weapon_title-<?php echo $value->page_language_id; ?>" placeholder="Weapon Title" class="span12" value="<?php echo $page_setting_weapon_title; ?>" />
												<span class="error"><label for="page-setting-weapon_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span8">
										<h5 class="semi-bold">Weapon Description</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_weapon_desc = isset($setting[$value->page_language_id]->weapon_desc) && $setting[$value->page_language_id]->weapon_desc ? ($setting[$value->page_language_id]->weapon_desc) : (isset($setting['default']->weapon_desc) ? ($setting['default']->weapon_desc) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][weapon_desc]" id="page-setting-weapon_desc-<?php echo $value->page_language_id; ?>" placeholder="Weapon Description" class="span12" value="<?php echo $page_setting_weapon_desc; ?>" />
												<span class="error"><label for="page-setting-weapon_desc-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row-fluid column-seperation">
									<div class="span4">
										<h5 class="semi-bold">Ammunition Title</h5>
										<div class="row-fluid">
											<div class="span11">
												<?php $page_setting_ammunition_title = isset($setting[$value->page_language_id]->ammunition_title) && $setting[$value->page_language_id]->ammunition_title ? ($setting[$value->page_language_id]->ammunition_title) : (isset($setting['default']->ammunition_title) ? ($setting['default']->ammunition_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][ammunition_title]" id="page-setting-ammunition_title-<?php echo $value->page_language_id; ?>" placeholder="Ammunition Title" class="span12" value="<?php echo $page_setting_ammunition_title; ?>" />
												<span class="error"><label for="page-setting-ammunition_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span8">
										<h5 class="semi-bold">Ammunition Description</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_ammunition_desc = isset($setting[$value->page_language_id]->ammunition_desc) && $setting[$value->page_language_id]->ammunition_desc ? ($setting[$value->page_language_id]->ammunition_desc) : (isset($setting['default']->ammunition_desc) ? ($setting['default']->ammunition_desc) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][ammunition_desc]" id="page-setting-ammunition_desc-<?php echo $value->page_language_id; ?>" placeholder="Ammunition Description" class="span12" value="<?php echo $page_setting_ammunition_desc; ?>" />
												<span class="error"><label for="page-setting-ammunition_desc-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>

								<div class="row-fluid column-seperation">
									<div class="span4">
										<h5 class="semi-bold">Vehicle Title</h5>
										<div class="row-fluid">
											<div class="span11">
												<?php $page_setting_vehicle_title = isset($setting[$value->page_language_id]->vehicle_title) && $setting[$value->page_language_id]->vehicle_title ? ($setting[$value->page_language_id]->vehicle_title) : (isset($setting['default']->vehicle_title) ? ($setting['default']->vehicle_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][vehicle_title]" id="page-setting-vehicle_title-<?php echo $value->page_language_id; ?>" placeholder="Vehicle Title" class="span12" value="<?php echo $page_setting_vehicle_title; ?>" />
												<span class="error"><label for="page-setting-vehicle_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span8">
										<h5 class="semi-bold">Vehicle Description</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_vehicle_desc = isset($setting[$value->page_language_id]->vehicle_desc) && $setting[$value->page_language_id]->vehicle_desc ? ($setting[$value->page_language_id]->vehicle_desc) : (isset($setting['default']->vehicle_desc) ? ($setting['default']->vehicle_desc) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][vehicle_desc]" id="page-setting-vehicle_desc-<?php echo $value->page_language_id; ?>" placeholder="Vehicle Description" class="span12" value="<?php echo $page_setting_vehicle_desc; ?>" />
												<span class="error"><label for="page-setting-vehicle_desc-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row-fluid column-seperation">
									<div class="span4">
										<h5 class="semi-bold">Forging Title</h5>
										<div class="row-fluid">
											<div class="span11">
												<?php $page_setting_forging_title = isset($setting[$value->page_language_id]->forging_title) && $setting[$value->page_language_id]->forging_title ? ($setting[$value->page_language_id]->forging_title) : (isset($setting['default']->forging_title) ? ($setting['default']->forging_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][forging_title]" id="page-setting-forging_title-<?php echo $value->page_language_id; ?>" placeholder="Forging Title" class="span12" value="<?php echo $page_setting_forging_title; ?>" />
												<span class="error"><label for="page-setting-forging_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span8">
										<h5 class="semi-bold">Forging Description</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_forging_desc = isset($setting[$value->page_language_id]->forging_desc) && $setting[$value->page_language_id]->forging_desc ? ($setting[$value->page_language_id]->forging_desc) : (isset($setting['default']->forging_desc) ? ($setting['default']->forging_desc) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][forging_desc]" id="page-setting-forging_desc-<?php echo $value->page_language_id; ?>" placeholder="Forging Description" class="span12" value="<?php echo $page_setting_forging_desc; ?>" />
												<span class="error"><label for="page-setting-forging_desc-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row-fluid column-seperation">
									<div class="span4">
										<h5 class="semi-bold">Service Title</h5>
										<div class="row-fluid">
											<div class="span11">
												<?php $page_setting_service_title = isset($setting[$value->page_language_id]->service_title) && $setting[$value->page_language_id]->service_title ? ($setting[$value->page_language_id]->service_title) : (isset($setting['default']->service_title) ? ($setting['default']->service_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][service_title]" id="page-setting-service_title-<?php echo $value->page_language_id; ?>" placeholder="Service Title" class="span12" value="<?php echo $page_setting_service_title; ?>" />
												<span class="error"><label for="page-setting-service_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span8">
										<h5 class="semi-bold">Service Description</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_service_desc = isset($setting[$value->page_language_id]->service_desc) && $setting[$value->page_language_id]->service_desc ? ($setting[$value->page_language_id]->service_desc) : (isset($setting['default']->service_desc) ? ($setting['default']->service_desc) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][service_desc]" id="page-setting-service_desc-<?php echo $value->page_language_id; ?>" placeholder="Service Description" class="span12" value="<?php echo $page_setting_service_desc; ?>" />
												<span class="error"><label for="page-setting-service_desc-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row-fluid column-seperation">
									<div class="span4">
										<h5 class="semi-bold">Commercial Title</h5>
										<div class="row-fluid">
											<div class="span11">
												<?php $page_setting_commercial_title = isset($setting[$value->page_language_id]->commercial_title) && $setting[$value->page_language_id]->commercial_title ? ($setting[$value->page_language_id]->commercial_title) : (isset($setting['default']->commercial_title) ? ($setting['default']->commercial_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][commercial_title]" id="page-setting-commercial_title-<?php echo $value->page_language_id; ?>" placeholder="Commercial Title" class="span12" value="<?php echo $page_setting_commercial_title; ?>" />
												<span class="error"><label for="page-setting-commercial_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span8">
										<h5 class="semi-bold">Commercial Description</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_commercial_desc = isset($setting[$value->page_language_id]->commercial_desc) && $setting[$value->page_language_id]->commercial_desc ? ($setting[$value->page_language_id]->commercial_desc) : (isset($setting['default']->commercial_desc) ? ($setting['default']->commercial_desc) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][commercial_desc]" id="page-setting-commercial_desc-<?php echo $value->page_language_id; ?>" placeholder="Commercial Description" class="span12" value="<?php echo $page_setting_commercial_desc; ?>" />
												<span class="error"><label for="page-setting-commercial_desc-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row-fluid">
									<div class="span12">
										<h5 class="semi-bold">Latest News</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_news = isset($setting[$value->page_language_id]->news) && $setting[$value->page_language_id]->news ? ($setting[$value->page_language_id]->news) : (isset($setting['default']->news) ? ($setting['default']->news) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][news]" id="page-setting-news-<?php echo $value->page_language_id; ?>" placeholder="Latest News" class="span12" value="<?php echo $page_setting_news; ?>" />
												<span class="error"><label for="page-setting-news-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>

								<div class="row-fluid">
									<div class="span12">
										<h5 class="semi-bold">Featured Product</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_product = isset($setting[$value->page_language_id]->product) && $setting[$value->page_language_id]->product ? ($setting[$value->page_language_id]->product) : (isset($setting['default']->product) ? ($setting['default']->product) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][product]" id="page-setting-product-<?php echo $value->page_language_id; ?>" placeholder="Featured Product" class="span12" value="<?php echo $page_setting_product; ?>" />
												<span class="error"><label for="page-setting-product-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>

								<div class="row-fluid">
									<div class="span12">
										<h5 class="semi-bold">Innovation</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_innovation = isset($setting[$value->page_language_id]->innovation) && $setting[$value->page_language_id]->innovation ? ($setting[$value->page_language_id]->innovation) : (isset($setting['default']->innovation) ? ($setting['default']->innovation) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][innovation]" id="page-setting-innovation-<?php echo $value->page_language_id; ?>" placeholder="Innovation" class="span12" value="<?php echo $page_setting_innovation; ?>" />
												<span class="error"><label for="page-setting-innovation-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>

								<div class="row-fluid column-seperation">
									<div class="span6">
										<h5 class="semi-bold">Procurement</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_procurement = isset($setting[$value->page_language_id]->procurement) && $setting[$value->page_language_id]->procurement ? ($setting[$value->page_language_id]->procurement) : (isset($setting['default']->procurement) ? ($setting['default']->procurement) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][procurement]" id="page-setting-procurement-<?php echo $value->page_language_id; ?>" placeholder="Procurement" class="span11" value="<?php echo $page_setting_procurement; ?>" />
												<span class="error"><label for="page-setting-procurement-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span6">
										<h5 class="semi-bold">Career</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_career = isset($setting[$value->page_language_id]->career) && $setting[$value->page_language_id]->career ? ($setting[$value->page_language_id]->career) : (isset($setting['default']->career) ? ($setting['default']->career) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][career]" id="page-setting-career-<?php echo $value->page_language_id; ?>" placeholder="Career" class="span11" value="<?php echo $page_setting_career; ?>" />
												<span class="error"><label for="page-setting-career-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>

								<div class="row-fluid column-seperation">
									<div class="span4">
										<h5 class="semi-bold">Footer About</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_footer_about_title = isset($setting[$value->page_language_id]->footer_about_title) && $setting[$value->page_language_id]->footer_about_title ? ($setting[$value->page_language_id]->footer_about_title) : (isset($setting['default']->footer_about_title) ? ($setting['default']->footer_about_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][footer_about_title]" id="page-setting-footer_about_title-<?php echo $value->page_language_id; ?>" placeholder="Title" class="span11" value="<?php echo $page_setting_footer_about_title; ?>" />
												<span class="error"><label for="page-setting-footer_about_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_footer_about_body = isset($setting[$value->page_language_id]->footer_about_body) && $setting[$value->page_language_id]->footer_about_body ? ($setting[$value->page_language_id]->footer_about_body) : (isset($setting['default']->footer_about_body) ? ($setting['default']->footer_about_body) : ''); ?>
												<textarea name="page_setting[<?php echo $value->page_language_id; ?>][footer_about_body]" id="page-setting-footer_about_body-<?php echo $value->page_language_id; ?>" placeholder="Body" class="span11"><?php echo $page_setting_footer_about_body; ?></textarea>
												<span class="error"><label for="page-setting-footer_about_body-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span4">
										<h5 class="semi-bold">Footer Contact</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_footer_contact_title = isset($setting[$value->page_language_id]->footer_contact_title) && $setting[$value->page_language_id]->footer_contact_title ? ($setting[$value->page_language_id]->footer_contact_title) : (isset($setting['default']->footer_contact_title) ? ($setting['default']->footer_contact_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][footer_contact_title]" id="page-setting-footer_contact_title-<?php echo $value->page_language_id; ?>" placeholder="Title" class="span11" value="<?php echo $page_setting_footer_contact_title; ?>" />
												<span class="error"><label for="page-setting-footer_contact_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_footer_contact_body = isset($setting[$value->page_language_id]->footer_contact_body) && $setting[$value->page_language_id]->footer_contact_body ? ($setting[$value->page_language_id]->footer_contact_body) : (isset($setting['default']->footer_contact_body) ? ($setting['default']->footer_contact_body) : ''); ?>
												<textarea name="page_setting[<?php echo $value->page_language_id; ?>][footer_contact_body]" id="page-setting-footer_contact_body-<?php echo $value->page_language_id; ?>" placeholder="Body" class="span11"><?php echo $page_setting_footer_contact_body; ?></textarea>
												<span class="error"><label for="page-setting-footer_contact_body-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
									<div class="span4">
										<h5 class="semi-bold">Footer Newsletter</h5>
										<div class="row-fluid">
											<div class="span12">
												<?php $page_setting_footer_newsletter_title = isset($setting[$value->page_language_id]->footer_newsletter_title) && $setting[$value->page_language_id]->footer_newsletter_title ? ($setting[$value->page_language_id]->footer_newsletter_title) : (isset($setting['default']->footer_newsletter_title) ? ($setting['default']->footer_newsletter_title) : ''); ?>
												<input type="text" name="page_setting[<?php echo $value->page_language_id; ?>][footer_newsletter_title]" id="page-setting-footer_newsletter_title-<?php echo $value->page_language_id; ?>" placeholder="Title" class="span11" value="<?php echo $page_setting_footer_newsletter_title; ?>" />
												<span class="error"><label for="page-setting-footer_newsletter_title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
											</div>
										</div>
									</div>
								</div>

							</div>
							<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="pull-right">
						<button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Save</button>
						<button type="button" class="btn btn-white btn-cons">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->