<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>Pages - <span class="semi-bold">Add</span></h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>pages/pages_process/add" enctype="multipart/form-data">
			<input type="hidden" name="is_menu" value="1" />

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">

						<ul class="nav nav-tabs" id="main-tab">
							<li class="active"><a href="#tabs-main">Main</a></li>
							<li><a href="#tabs-content">Content</a></li>
							<li><a href="#tabs-product">Product Detail</a></li>
							<li><a href="#tabs-image">Image</a></li>
							<li><a href="#tabs-image-product">Image Product</a></li>
							<li><a href="#tabs-attachment">Attachment</a></li>
							<li><a href="#tabs-form">Form</a></li>
						</ul>

						<div class="tab-content" id="tab-main">

							<div class="main-pane tab-pane secondary-pane active" id="tabs-main">
								<div class="row-fluid item-pane all">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3>Page Settings</h3>
											</div>
											<div class="grid-body no-border">
												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid">
															<div class="span5">
																<h5 class="semi-bold">Page Type</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<select name="type" class="select page-type" style="width:100%">
																			<option value="static">Static</option>
																			<option value="parent">Parent</option>
																			<option value="article">Article</option>
																			<option value="gallery">Gallery</option>
																			<option value="form">Form</option>
																		</select>
																	</div>
																</div>
															</div>
															<div class="span5">
																<h5 class="semi-bold">Page Parent</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<select name="parent_menu" class="select" style="width:100%">
																			<option value="">None</option>
																			<?php if (isset($parent) && ! empty($parent)) { ?>
																				<?php foreach ($parent as $key => $value) { ?>
																					<optgroup label="Menu Level <?php echo $key; ?>">
																						<?php if ( ! empty($value) ) { ?>
																							<?php foreach ($value as $k => $v) { ?>
																								<option value="<?php echo $v['menu_id']; ?>"><?php echo $v['name']; ?></option>
																							<?php } ?>
																						<?php } ?>
																					</optgroup>
																				<?php } ?>
																			<?php } ?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="span2">
																<h5 class="semi-bold">Page Order</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="page_order" id="page-order" placeholder="Page Order" class="span12" value="1" />
																		<span class="error"><label for="page-order" class="error"></label></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid">
															<div class="span12">
																<h5 class="semi-bold">Page Name</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="page_name" id="page-name" placeholder="Page Name" class="span12" />
																		<input type="hidden" name="page_guid" id="page-guid" />
																		<span class="label" id="guid"></span>
																		<span class="error"><label for="page-name" class="error"></label></span>
																	</div>
																</div>
															</div>
														</div>
														<div class="row-fluid">
															<div class="span12">
																<div class="row-fluid">
																	<div class="span2">
																		<h5 class="semi-bold">Publish</h5>
																		<div class="row-fluid">
																			<div class="span12 input-wrapper">
																				<div class="slide-primary">
																					<input type="checkbox" name="publish" class="ios" value="1" checked="checked" />
																				</div>
																				<span class="error"><label for="publish" class="error"></label></span>
																			</div>
																		</div>
																	</div>
																	<div class="span2 item-pane static">
																		<h5 class="semi-bold">Show Home</h5>
																		<div class="row-fluid">
																			<div class="span12 input-wrapper">
																				<div class="slide-primary">
																					<input type="checkbox" name="show_home" class="ios" value="1" />
																				</div>
																				<span class="error"><label for="show_home" class="error"></label></span>
																			</div>
																		</div>
																	</div>
																	<div class="span2 item-pane static article gallery">
																		<h5 class="semi-bold">Home Center</h5>
																		<div class="row-fluid">
																			<div class="span12 input-wrapper">
																				<div class="slide-primary">
																					<input type="checkbox" name="home_center" class="ios" value="1" />
																				</div>
																				<span class="error"><label for="home_center" class="error"></label></span>
																			</div>
																		</div>
																	</div>
																	<div class="span2 item-pane static article gallery">
																		<h5 class="semi-bold">Home Left</h5>
																		<div class="row-fluid">
																			<div class="span12 input-wrapper">
																				<div class="slide-primary">
																					<input type="checkbox" name="home_left" class="ios" value="1" />
																				</div>
																				<span class="error"><label for="home_left" class="error"></label></span>
																			</div>
																		</div>
																	</div>
																	<div class="span2 item-pane static article gallery">
																		<h5 class="semi-bold">Home Right</h5>
																		<div class="row-fluid">
																			<div class="span12 input-wrapper">
																				<div class="slide-primary">
																					<input type="checkbox" name="home_right" class="ios" value="1" />
																				</div>
																				<span class="error"><label for="home_right" class="error"></label></span>
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
									</div>
								</div>
							</div>

							<div class="main-pane tab-pane secondary-pane" id="tabs-content">
								<div class="row-fluid item-pane all">
									<div class="span12">
										<div class="grid simple">
											<ul class="nav nav-tabs" id="content-tab">
												<?php if (isset($language) && ! empty($language)) { ?>
													<?php foreach ($language as $key => $value) { ?>
														<li class="<?php echo $value->default ? 'active' : ''; ?>">
															<a href="#content-<?php echo $value->name; ?>"><?php echo $value->name; ?></a>
														</li>
													<?php } ?>
												<?php } ?>
											</ul>
											<div class="grid-title no-border">
												<h3>Page Content</h3>
											</div>
											<div class="tab-content" id="tab-content">
												<?php if (isset($language) && ! empty($language)) { ?>
													<?php foreach ($language as $key => $value) { ?>
														<div class="tab-pane content-pane <?php echo $value->default ? 'active' : ''; ?>" id="content-<?php echo $value->name; ?>">
															<div class="row-fluid">
																<div class="span6">
																	<h5 class="semi-bold">Page Menu</h5>
																	<div class="row-fluid">
																		<div class="span12 input-wrapper">
																			<input type="text" name="page_content[<?php echo $value->page_language_id; ?>][menu]" id="page-content-menu-<?php echo $value->page_language_id; ?>" placeholder="Page Menu (<?php echo $value->name; ?>)" class="span12" />
																			<span class="error"><label for="page-content-menu-<?php echo $value->page_language_id; ?>" class="error"></label></span>
																		</div>
																	</div>
																</div>
																<div class="span6">
																	<h5 class="semi-bold">Page Title</h5>
																	<div class="row-fluid">
																		<div class="span12 input-wrapper">
																			<input type="text" name="page_content[<?php echo $value->page_language_id; ?>][title]" id="page-content-title-<?php echo $value->page_language_id; ?>" placeholder="Page Title (<?php echo $value->name; ?>)" class="span12" />
																			<span class="error"><label for="page-content-title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row-fluid item-pane static gallery form product-item">
																<div class="span12">
																	<h5 class="semi-bold">Page Body</h5>
																	<div class="row-fluid">
																		<div class="span12 input-wrapper">
																			<textarea name="page_content[<?php echo $value->page_language_id; ?>][body]" id="page-content-body-<?php echo $value->page_language_id; ?>" placeholder="Page Body (<?php echo $value->name; ?>)" class="text-editor span12" rows="10"></textarea>
																			<span class="error"><label for="page-content-body-<?php echo $value->page_language_id; ?>" class="error"></label></span>
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
								</div>
							</div>

							<div class="main-pane tab-pane secondary-pane" id="tabs-product">
								<div class="row-fluid item-pane product-item">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3>Product Detail</h3>
											</div>
											<div class="grid-body no-border">
												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid">
															<div class="span4">
																<h5 class="semi-bold">Product Type</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_type" id="product_type" placeholder="Product Type" class="span12" />
																		<span class="error"><label for="product_type" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Available</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_available" id="product_available" placeholder="Available" class="span12" />
																		<span class="error"><label for="product_available" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Area</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_area" id="product_area" placeholder="Area" class="span12" />
																		<span class="error"><label for="product_area" class="error"></label></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid">
															<div class="span4">
																<h5 class="semi-bold">Beds</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_beds" id="product_beds" placeholder="Beds" class="span12" />
																		<span class="error"><label for="product_beds" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Baths</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_baths" id="product_baths" placeholder="Baths" class="span12" />
																		<span class="error"><label for="product_baths" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Living Room</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_living_room" id="product_living_room" placeholder="Living Room" class="span12" />
																		<span class="error"><label for="product_living_room" class="error"></label></span>
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
							</div>

							<div class="main-pane tab-pane secondary-pane" id="tabs-image">
								<div class="row-fluid item-pane all">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3>Images</h3>
											</div>
											<div class="grid-body no-border">
												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid">
															<div class="image-upload-wrapper span12">
																<div class="row-fluid">
																	<div class="span4 input-wrapper">
																		<input type="file" name="image_upload[]" id="image-upload-1" class="nicefileinput" />
																		<span class="error"><label for="image-upload-1" class="error"></label></span>
																	</div>
																	<div class="span4 input-wrapper">
																		<input type="text" name="image_name[]" id="image-name-1" class="span12" placeholder="Image Caption" />
																	</div>
																	<div class="span4 input-wrapper">
																		<input type="text" name="image_description[]" id="image-description-1" class="span12" placeholder="Image Description" />
																	</div>
																</div>
															</div>
														</div>
														<div class="row-fluid">
															<div class="span12">
																<button type="button" class="btn btn-primary btn-mini add-image"><i class="icon-plus"></i>&nbsp;Add Image</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="main-pane tab-pane secondary-pane" id="tabs-image-product">
								<div class="row-fluid item-pane product-item">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3>Images Product</h3>
											</div>
											<div class="grid-body no-border">
												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid">
															<div class="image-product-wrapper span12">
																<div class="row-fluid">
																	<div class="span4 input-wrapper">
																		<input type="file" name="image_product[]" id="image-product-1" class="nicefileinput" />
																		<span class="error"><label for="image-product-1" class="error"></label></span>
																	</div>
																</div>
															</div>
														</div>
														<div class="row-fluid">
															<div class="span12">
																<button type="button" class="btn btn-primary btn-mini add-image-product" data-input="product"><i class="icon-plus"></i>&nbsp;Add Image</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="main-pane tab-pane secondary-pane" id="tabs-attachment">
								<div class="row-fluid item-pane static form product-item">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3>Attachment</h3>
											</div>
											<div class="grid-body no-border">
												<div class="row-fluid column-seperation">
													<div class="span12">
														<div class="row-fluid">
															<div class="file-upload-wrapper span12">
																<div class="row-fluid">
																	<div class="span6 input-wrapper">
																		<input type="file" name="file_upload[]" id="file-upload-1" class="nicefileinput" />
																		<span class="error"><label for="file-upload-1" class="error"></label></span>
																	</div>
																	<div class="span6 input-wrapper">
																		<input type="text" name="file_name[]" id="file-name-1" class="span12" placeholder="File Name" />
																		<span class="error"><label for="file-name-1" class="error"></label></span>
																	</div>
																</div>
															</div>
														</div>
														<div class="row-fluid">
															<div class="span12">
																<button type="button" class="btn btn-primary btn-mini add-file"><i class="icon-plus"></i>&nbsp;Add File</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="main-pane tab-pane secondary-pane" id="tabs-form">
								<div class="row-fluid item-pane form">
									<div class="span12">
										<div class="grid simple">

											<div class="grid-title no-border">
												<h3>Form Builder</h3>
											</div>

											<div class="grid-body no-border">
												<div class="row-fluid">
													<div class="span12">
														<h5 class="semi-bold">Mail To</h5>
														<input type="text" name="mail_to" id="mail_to" placeholder="Mail To" class="span12 tagsinput" />
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12">
														<h5 class="semi-bold">Form Responder</h5>
														<textarea name="form_description" id="form_description" placeholder="Form Responder" class="text-editor span12" rows="10"></textarea>
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12">
														<h5 class="semi-bold">Form Content</h5>
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12 builder-holder"></div>
													<input type="hidden" name="form_builder" id="form-builder" />
												</div>
												<div class="row-fluid">
													<div class="span12 button-holder">
														<?php
														$lang_id = '';
														$lang_icon = '';
														if ($language) {
															foreach ($language as $key => $value) {
																$lang_id .= $lang_id ? ',' : '';
																$lang_id .= $value->page_language_id;

																$lang_icon .= $lang_icon ? ',' : '';
																$lang_icon .= $value->icon;
															}
														}
														?>
														<input type="hidden" id="form-lang" data-id="<?php echo $lang_id; ?>" data-icon="<?php echo $lang_icon; ?>" />
														<button type="button" class="btn btn-primary btn-mini" data-type="label">Add Label</button>
														<button type="button" class="btn btn-primary btn-mini" data-type="break">Add Break</button>
														<button type="button" class="btn btn-primary btn-mini" data-type="single">Add Single Text</button>
														<button type="button" class="btn btn-primary btn-mini" data-type="paragraph">Add Paragraph Text</button>
														<button type="button" class="btn btn-primary btn-mini" data-type="date">Add Date</button>
														<button type="button" class="btn btn-primary btn-mini" data-type="email">Add Email</button>
														<button type="button" class="btn btn-primary btn-mini" data-type="combo">Add Combo Box</button>
														<button type="button" class="btn btn-primary btn-mini" data-type="radio">Add Radio Button</button>
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

				<div class="form-actions">
					<div class="pull-right">
						<button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Save</button>
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url(); ?>">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->