<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><?php echo ucwords($detail->type); ?> Page - <span class="semi-bold">Edit</span></h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>pages/pages_process/edit/<?php echo $id; ?>" enctype="multipart/form-data">
			<input type="hidden" name="is_menu" value="1" />
			<input type="hidden" name="id" value="<?php echo $id; ?>" />

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">

						<ul class="nav nav-tabs" id="main-tab">
							<li><a href="#tabs-main">Main</a></li>
							<li<?php echo $detail->type !== 'article' && $detail->type !== 'gallery' && $detail->type !== 'form' ? ' class="active"' : ''; ?>><a href="#tabs-content">Content</a></li>
							<li><a href="#tabs-product">Product Detail</a></li>
							<li<?php echo $detail->type === 'article' ? ' class="active"' : ''; ?>><a href="#tabs-detail-article">Article List</a></li>
							<li<?php echo $detail->type === 'gallery' ? ' class="active"' : ''; ?>><a href="#tabs-detail-gallery">Gallery List</a></li>
							<li><a href="#tabs-image">Image</a></li>
							<li><a href="#tabs-image-product">Image Product</a></li>
							<li><a href="#tabs-attachment">Attachment</a></li>
							<li<?php echo $detail->type === 'form' ? ' class="active"' : ''; ?>><a href="#tabs-form">Form</a></li>
							<li><a href="#tabs-inquiry">Inquiry</a></li>
						</ul>

						<div class="tab-content" id="tab-main">

							<div class="main-pane tab-pane secondary-pane" id="tabs-main">
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
																		<input type="hidden" name="type" class="page-type" value="<?php echo $detail->type; ?>" />
																		<input type="text" placeholder="Page Type" class="span12" readonly="readonly" value="<?php echo ucwords($detail->type); ?>" />
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
																								<?php $selected = $v['menu_id'] === $detail->parent_menu_id ? 'selected="selected"' : ''; ?>
																								<option value="<?php echo $v['menu_id']; ?>" <?php echo $selected; ?>><?php echo $v['name']; ?></option>
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
																		<input type="text" name="page_order" id="page-order" placeholder="Page Order" class="span12" value="<?php echo $detail->order; ?>" />
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
																		<input type="text" name="page_name" id="page-name" placeholder="Page Name" class="span12" value="<?php echo $detail->name; ?>" data-id="<?php echo $id; ?>" />
																		<input type="hidden" name="page_guid" id="page-guid" value="<?php echo $detail->guid; ?>" />
																		<span class="label" id="guid"><a href="<?php echo $this->dir . $detail->guid; ?>" target="_blank"><?php echo $this->dir . $detail->guid; ?></a></span>
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
																					<input type="checkbox" name="publish" class="ios" value="1" <?php echo $detail->publish ? 'checked="checked"' : ''; ?> />
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
																					<input type="checkbox" name="show_home" class="ios" value="1" <?php echo $detail->show_home ? 'checked="checked"' : ''; ?> />
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
																					<input type="checkbox" name="home_center" class="ios" value="1" <?php echo $detail->home_center ? 'checked="checked"' : ''; ?> />
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
																					<input type="checkbox" name="home_left" class="ios" value="1" <?php echo $detail->home_left ? 'checked="checked"' : ''; ?> />
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
																					<input type="checkbox" name="home_right" class="ios" value="1" <?php echo $detail->home_right ? 'checked="checked"' : ''; ?> />
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

							<div class="main-pane tab-pane secondary-pane<?php echo $detail->type !== 'article' && $detail->type !== 'gallery' && $detail->type !== 'form' ? ' active' : ''; ?>" id="tabs-content">
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
																			<?php $page_content_menu = isset($data[$value->page_language_id]->menu) && $data[$value->page_language_id]->menu ? ($data[$value->page_language_id]->menu) : (isset($data['default']->menu) ? ($data['default']->menu) : ''); ?>
																			<input type="text" name="page_content[<?php echo $value->page_language_id; ?>][menu]" id="page-content-menu-<?php echo $value->page_language_id; ?>" placeholder="Page Menu (<?php echo $value->name; ?>)" class="span12" value="<?php echo $page_content_menu; ?>" />
																			<span class="error"><label for="page-content-menu-<?php echo $value->page_language_id; ?>" class="error"></label></span>
																		</div>
																	</div>
																</div>
																<div class="span6">
																	<h5 class="semi-bold">Page Title</h5>
																	<div class="row-fluid">
																		<div class="span12 input-wrapper">
																			<?php $page_content_title = isset($data[$value->page_language_id]->title) && $data[$value->page_language_id]->title ? ($data[$value->page_language_id]->title) : (isset($data['default']->title) ? ($data['default']->title) : ''); ?>
																			<input type="text" name="page_content[<?php echo $value->page_language_id; ?>][title]" id="page-content-title-<?php echo $value->page_language_id; ?>" placeholder="Page Title (<?php echo $value->name; ?>)" class="span12" value="<?php echo $page_content_title; ?>" />
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
																			<?php $page_content_body = isset($data[$value->page_language_id]->body) && $data[$value->page_language_id]->body ? ($data[$value->page_language_id]->body) : (isset($data['default']->body) ? ($data['default']->body) : ''); ?>
																			<textarea name="page_content[<?php echo $value->page_language_id; ?>][body]" id="page-content-body-<?php echo $value->page_language_id; ?>" placeholder="Page Body (<?php echo $value->name; ?>)" class="text-editor span12" rows="10"><?php echo $page_content_body; ?></textarea>
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
																		<input type="text" name="product_type" id="product_type" placeholder="Product Type" class="span12" value="<?php echo isset($product->type) ? $product->type : ''; ?>" />
																		<span class="error"><label for="product_type" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Available</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_available" id="product_available" placeholder="Available" class="span12" value="<?php echo isset($product->available) ? $product->available : ''; ?>" />
																		<span class="error"><label for="product_available" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Area</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_area" id="product_area" placeholder="Area" class="span12" value="<?php echo isset($product->area) ? $product->area : ''; ?>" />
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
																		<input type="text" name="product_beds" id="product_beds" placeholder="Beds" class="span12" value="<?php echo isset($product->beds) ? $product->beds : ''; ?>" />
																		<span class="error"><label for="product_beds" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Baths</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_baths" id="product_baths" placeholder="Baths" class="span12" value="<?php echo isset($product->bath) ? $product->bath : ''; ?>" />
																		<span class="error"><label for="product_baths" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Living Room</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="product_living_room" id="product_living_room" placeholder="Living Room" class="span12" value="<?php echo isset($product->living_room) ? $product->living_room : ''; ?>" />
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

							<div class="main-pane tab-pane secondary-pane<?php echo $detail->type === 'article' ? ' active' : ''; ?>" id="tabs-detail-article">
								<div class="row-fluid item-pane article">
									<div class="span12">
										<?php if (isset($detail_content) && $detail_content === 'article') { ?>
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3><?php echo $detail_parent->name; ?> List</h3>
											</div>
											<div id="datatable-button">
												<input type="hidden" class="button-item" data-url="<?php echo base_url(); ?>pages/pages/add/<?php echo $detail_parent->page_id; ?>" data-message="Add <?php echo $detail_parent->name; ?>" data-class="btn btn-block btn-primary direct-link" data-icon="icon-plus" />
											</div>
											<div class="grid-body no-border">
												<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
													<thead>
														<tr>
															<th>#</th>
															<th>Page Name</th>
															<th>Date Created</th>
															<th style="text-align:center;">Status</th>
															<th style="text-align:center;">Action</th>
														</tr>
													</thead>
													<tbody>
														<?php if (isset($content) && ! empty($content)) { ?>
														<?php $i = 1; ?>
														<?php foreach ($content as $key => $value) { ?>
														<tr>
															<td width="5%"><?php echo $i; ?></td>
															<td width="50%"><a target="_blank" href="<?php echo $this->dir . $value->guid; ?>"><?php echo $value->name; ?></a></td>
															<td width="25%"><?php echo $value->created_date; ?></td>
															<td width="10%" style="text-align:center;"><?php echo $value->publish ? '<span class="label label-success">Publish</span>' : '<span class="label label-important">Unpublish</span>'; ?></td>
															<td width="10%" style="text-align:center; min-width:60px;">
																<?php if ($value->accessable) { ?>
																<a class="direct-link" href="<?php echo base_url(); ?>pages/pages/edit/<?php echo $value->page_id; ?>" title="Edit"><i class="icon-cog"></i></a>
																<a class="delete-table-row" href="<?php echo base_url(); ?>pages/pages_process/delete/<?php echo $value->page_id; ?>" data-title="Delete Article <?php echo $detail_parent->name; ?> (<?php echo $value->name; ?>) ?" title="Delete"><i class="icon-remove"></i></a>
																<?php } else { ?>
																<span class="label label-important">Forbiden</span>
																<?php } ?>
															</td>
														</tr>
														<?php $i++; ?>
														<?php } ?>
														<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>

							<div class="main-pane tab-pane secondary-pane<?php echo $detail->type === 'gallery' ? ' active' : ''; ?>" id="tabs-detail-gallery">
								<div class="row-fluid item-pane gallery">
									<div class="span12">
										<?php if (isset($detail_content) && $detail_content === 'gallery') { ?>
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3><?php echo $detail_parent->name; ?> List</h3>
											</div>
											<div id="datatable-button">
												<input type="hidden" class="button-item" data-url="<?php echo base_url(); ?>pages/pages/add/<?php echo $detail_parent->page_id; ?>" data-message="Add <?php echo $detail_parent->name; ?>" data-class="btn btn-block btn-primary direct-link" data-icon="icon-plus" />
											</div>
												<div class="grid-body no-border">
													<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
														<thead>
															<tr>
																<th>#</th>
																<th>Image</th>
																<th>Name</th>
																<th>Description</th>
																<th style="text-align:center;">Action</th>
															</tr>
														</thead>
														<tbody>
															<?php if (isset($content) && ! empty($content)) { ?>
															<?php $i = 1; ?>
															<?php foreach ($content as $key => $value) { ?>
															<tr>
																<td width="5%"><?php echo $i; ?></td>
																<td width="15%"><img src="<?php echo $this->dir; ?>uploads/images/<?php echo $detail->type ?>/thumb/<?php echo $value->image; ?>" style="height:100px;" /></td>
																<td width="30%"><?php echo $value->content['default']->title; ?></td>
																<td width="40%"><?php echo $value->content['default']->body; ?></td>
																<td width="10%" style="text-align:center; min-width:60px;">
																	<a class="direct-link" href="<?php echo base_url(); ?>pages/pages/edit/<?php echo $value->page_id; ?>" title="Edit"><i class="icon-cog"></i></a>
																	<a class="delete-table-row" href="<?php echo base_url(); ?>pages/pages_process/delete/<?php echo $value->page_id; ?>" data-title="Delete Gallery <?php echo $detail_parent->name; ?> (<?php echo $value->image_name; ?>) ?" title="Delete"><i class="icon-remove"></i></a>
																</td>
															</tr>
															<?php $i++; ?>
															<?php } ?>
															<?php } ?>
														</tbody>
													</table>
												</div>
										</div>
										<?php } ?>
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
												<div class="superbox">
													<?php if (isset($image) && ! empty($image)) { ?>
														<?php foreach ($image as $key => $value) { ?><div class="relative superbox-list">
															<img src="<?php echo $this->dir; ?>uploads/images/<?php echo $detail->type; ?>/thumb/<?php echo $value->file_name; ?>" data-img="<?php echo $this->dir; ?>uploads/images/<?php echo $detail->type; ?>/full/<?php echo $value->file_name; ?>" data-caption="<?php echo $value->name; ?>" data-desc="<?php echo $value->description; ?>" data-id="<?php echo $value->page_image_id; ?>" data-url="<?php echo base_url(); ?>pages/pages_process/edit_image/<?php echo $value->page_image_id; ?>" alt="" class="superbox-img">
															<div class="remove-images-button"><a class="remove-images" data-id="<?php echo $value->page_image_id; ?>" data-dir="<?php echo $detail->type; ?>" data-img="<?php echo $value->file_name; ?>" title="remove"><i class="icon-remove"></i></a></div>
														</div><?php } ?>
													<?php } ?>
													<div class="clearfix"></div>
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
												<h3>Images</h3>
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
												<div class="superbox superbox-default">
													<?php if (isset($image_product) && ! empty($image_product)) { ?>
														<?php foreach ($image_product as $key => $value) { ?><div class="relative superbox-list">
															<img src="<?php echo $this->dir; ?>uploads/images/<?php echo $detail->type; ?>/thumb/<?php echo $value->file_name; ?>" data-img="<?php echo $this->dir; ?>uploads/images/<?php echo $detail->type; ?>/full/<?php echo $value->file_name; ?>" data-id="<?php echo $value->image_product_id; ?>" data-url="<?php echo base_url(); ?>pages/pages_process/edit_image/<?php echo $value->image_product_id; ?>" alt="" class="superbox-img">
															<div class="remove-images-button"><a class="remove-images-product" data-id="<?php echo $value->image_product_id; ?>" data-dir="<?php echo $detail->type; ?>" data-img="<?php echo $value->file_name; ?>" title="remove"><i class="icon-remove"></i></a></div>
														</div><?php } ?>
													<?php } ?>
													<div class="clearfix"></div>
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
												<div class="row-fluid">
													<div class="span6">
														<div class="row-fluid">
															<div class="file-upload-wrapper span12">
																<h5 class="semi-bold">Upload File</h5>
																<div class="row-fluid">
																	<div class="span6">
																		<input type="file" name="file_upload[]" id="file-upload-1" class="nicefileinput" />
																		<span class="error"><label for="file-upload-1" class="error"></label></span>
																	</div>
																	<div class="span6">
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
													<div class="span6">
														<div class="row-fluid">
															<div class="span12">
																<h5 class="semi-bold">Attachment List</h5>
																<div class="row-fluid">
																	<div class="span12">
																		<table class="table table-striped">
																			<thead>
																				<tr>
																					<th width="30%">Name</th>
																					<th width="30%">File Type</th>
																					<th width="30%">File Size</th>
																					<th width="10%"></th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php if (isset($download) && ! empty($download)) { ?>
																					<?php foreach ($download as $key => $value) { ?>
																						<tr>
																							<td><a href="<?php echo $this->dir; ?>uploads/attachment/<?php echo $detail->type; ?>/<?php echo $value->file_name; ?>" target="_blank"><?php echo $value->name; ?></a></td>
																							<td><?php echo $value->file_type; ?></td>
																							<td><?php echo $value->file_size; ?> kB</td>
																							<td><a class="remove-files" data-id="<?php echo $value->page_download_id; ?>" data-dir="<?php echo $detail->type; ?>" data-file="<?php echo $value->file_name; ?>" title="remove"><i class="icon-remove"></i></a></td>
																						</tr>
																					<?php } ?>
																				<?php } ?>
																			</tbody>
																		</table>
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

							<div class="main-pane tab-pane secondary-pane<?php echo $detail->type === 'form' ? ' active' : ''; ?>" id="tabs-form">
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
														<input type="text" name="mail_to" id="mail_to" placeholder="Mail To" class="span12 tagsinput" value="<?php echo isset($form) ? $form->mail_to : ''; ?>" />
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12">
														<h5 class="semi-bold">Form Responder</h5>
														<textarea name="form_description" id="form_description" placeholder="Form Responder" class="mini-text-editor span12" rows="10"><?php echo isset($form) ? $form->form_description : ''; ?></textarea>
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12">
														<h5 class="semi-bold">Form Content</h5>
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12 builder-holder">
														<?php $form_data = isset($form) ? json_decode($form->data) : NULL; ?>
														<?php if (isset($form_data) && is_array($form_data)) { ?>
															<?php foreach ($form_data as $key => $value) { ?>
																<?php $value = get_object_vars($value); ?>
																<?php $value['label'] = $value['label'] ? get_object_vars($value['label']) : array(); ?>
																<?php $placeholder = ''; ?>
																<div class="row-fluid">
																	<?php
																	if ($language && $value['type'] === 'BREAK') {
																		?><span class="field-break"></span><?php
																	} else {
																		$default_lang = '';
																		foreach ($language as $k => $val) {
																			$default_lang = $default_lang ? $default_lang : $val->page_language_id;
																			$field_label = isset($value['label']['_' . $val->page_language_id]) ? $value['label']['_' . $val->page_language_id] : $value['label']['_' . $default_lang];
																			?><div class="flag form-flag <?php echo $val->icon; ?>"></div><span class="field-label" data-lang="<?php echo $val->page_language_id; ?>"><?php echo $field_label; ?></span><?php
																			$placeholder = $field_label;
																		}
																	}

																	if ( ! isset($value['name'])) {
																		$value['name'] = 'TEMP_' . $key;
																	}

																	switch ($value['type']) {
																		case 'LABEL'	: ?><input type="hidden" class="span5 field-builder old-field" id="<?php echo $value['name']; ?>" data-name="<?php echo $value['name']; ?>" data-type="LABEL" /><?php break;
																		case 'BREAK'	: ?><input type="hidden" class="span5 field-builder old-field" id="<?php echo $value['name']; ?>" data-name="<?php echo $value['name']; ?>" data-type="BREAK" /><?php break;
																		case 'VARCHAR'	: ?><input type="text" class="span5 field-builder old-field" placeholder="<?php echo $placeholder; ?>" id="<?php echo $value['name']; ?>" data-name="<?php echo $value['name']; ?>" data-type="VARCHAR" data-size="200" readonly="readonly" /><?php break;
																		case 'TEXT'		: ?><textarea class="span5 field-builder old-field" placeholder="<?php echo $placeholder; ?>" id="<?php echo $value['name']; ?>" data-name="<?php echo $value['name']; ?>" data-type="TEXT" rows="3" cols="50" readonly="readonly"></textarea><?php break;
																		case 'DATE'		: ?><input type="text" class="span5 field-builder old-field" placeholder="<?php echo $placeholder; ?>" id="<?php echo $value['name']; ?>" data-name="<?php echo $value['name']; ?>" data-type="DATE" readonly="readonly" /><?php break;
																		case 'EMAIL'	: ?><input type="text" class="span5 field-builder old-field" placeholder="<?php echo $placeholder; ?>" id="<?php echo $value['name']; ?>" data-name="<?php echo $value['name']; ?>" data-type="EMAIL" data-size="200" readonly="readonly" /><?php break;
																		case 'COMBO'	: ?><select class="span5 clear field-builder" id="<?php echo $value['name']; ?>" data-name="<?php echo $value['name']; ?>" data-type="COMBO" data-size="200" readonly="readonly">
																								<?php if ($value['value']) { ?>
																								<?php foreach ($value['value'] as $k => $val) { ?>
																								<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
																								<?php } ?>
																								<?php } ?>
																							</select><?php break;
																		case 'RADIO'	: ?><fieldset class="span5 clear field-builder" id="<?php echo $value['name']; ?>" data-name="<?php echo $value['name']; ?>" data-type="RADIO" data-size="200">
																								<?php if ($value['value']) { ?>
																								<?php foreach ($value['value'] as $k => $val) { ?>
																								<label><input type="radio" name="<?php echo $value['name']; ?>" value="<?php echo $val; ?>" /><?php echo $val; ?></label>
																								<?php } ?>
																								<?php } ?>
																							</fieldset><?php break;
																	}
																	?>
																	<?php switch ($value['type']) {
																		case 'VARCHAR'	: 
																		case 'TEXT'		: 
																		case 'DATE'		: 
																		case 'COMBO'	:
																		case 'RADIO'	: ?><div class="span6 field-mandatory checkbox check-primary">
																								<input type="checkbox" id="mandatory-<?php echo $value['name']; ?>" class="mandatory-check" value="1" <?php echo isset($value['mandatory']) && $value['mandatory'] ? 'checked="checked"' : ''; ?> />
																								<label for="mandatory-<?php echo $value['name']; ?>">Mandatory</label>
																							</div>
																							<?php break;
																		case 'EMAIL'	: ?><div class="span3 field-mandatory checkbox check-primary">
																								<input type="checkbox" id="mandatory-<?php echo $value['name']; ?>" class="mandatory-check" value="1" <?php echo isset($value['mandatory']) && $value['mandatory'] ? 'checked="checked"' : ''; ?> />
																								<label for="mandatory-<?php echo $value['name']; ?>">Mandatory</label>
																							</div>
																							<div class="span3 field-mail checkbox check-primary">
																								<input type="checkbox" id="mail-<?php echo $value['name']; ?>" class="mail-check" value="1" <?php echo isset($value['mail']) && $value['mail'] ? 'checked="checked"' : ''; ?> />
																								<label for="mail-<?php echo $value['name']; ?>">Send Email</label>
																							</div>
																							<?php break;
																	} ?>
																	<div class="remove-field-button"><a class="remove-field" title="remove"><i class="icon-remove"></i></a></div>
																</div>
															<?php } ?>
														<?php } ?>
													</div>
													<input type="hidden" name="form_builder" id="form-builder" value='<?php echo isset($form) ? $form->data : ""; ?>' />
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

							<div class="main-pane tab-pane secondary-pane" id="tabs-inquiry">
								<div class="row-fluid item-pane form">
									<div class="span12">
											<div class="grid simple">

												<div class="grid-title no-border">
													<h3>Inquiry List</h3>
												</div>

												<?php if (isset($inquiry) && ! empty($inquiry)) { ?>
												<div id="datatable-button">
													<?php if (isset($inquiry['item']) && ! empty($inquiry['item'])) { ?>
														<input type="hidden" class="button-item" data-url="<?php echo base_url() . 'inquiry/download/' . $id. '/excel'; ?>" data-message="Download Excel" data-class="btn btn-block btn-primary" data-icon="icon-download-alt" />
														<input type="hidden" class="button-item" data-url="<?php echo base_url() . 'inquiry/download/' . $id . '/mysql'; ?>" data-message="Download MySQL" data-class="btn btn-block btn-primary" data-icon="icon-download-alt" />
													<?php } ?>
												</div>

												<div class="grid-body no-border">
													<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
														<thead>
															<tr>
																<th>#</th>
																<?php if (isset($inquiry['column']) && ! empty($inquiry['column'])) { ?>
																<?php foreach ($inquiry['column'] as $key => $value) { ?>
																	<th><?php echo $language ? $value['_' . $language[0]->page_language_id] : 'Untitled'; ?></th>
																<?php } ?>
																<?php } ?>
																<th style="text-align:center;">Action</th>
															</tr>
														</thead>
														<tbody>
															<?php if (isset($inquiry['item']) && ! empty($inquiry['item'])) { ?>
															<?php $i = 1; ?>
															<?php $inquiry_id = 'form_id'; ?>
															<?php foreach ($inquiry['item'] as $key => $value) { ?>
															<tr>
																<td><?php echo $i; ?></td>
																<?php if (isset($inquiry['field']) && ! empty($inquiry['field'])) { ?>
																<?php foreach ($inquiry['field'] as $k => $val) { ?>
																	<?php if ($val !== $inquiry_id) { ?>
																	<td><?php echo $value->{$val}; ?></td>
																	<?php } ?>
																<?php } ?>
																<?php } ?>
																<td width="10%" style="text-align:center;">
																	<a class="direct-link" href="<?php echo base_url() . 'inquiry/' . $id . '/' . $value->{$inquiry_id}; ?>" title="View"><i class="icon-cog"></i></a>
																	<a class="delete-table-row" href="<?php echo base_url(); ?>pages/pages_process/delete_inquiry/<?php echo $inquiry['table'] . '/' . $value->{$inquiry_id}; ?>" data-title="Delete Inquiry ?" title="Delete"><i class="icon-remove"></i></a>
																</td>
															</tr>
															<?php $i++; ?>
															<?php } ?>
															<?php } ?>
														</tbody>
													</table>
												</div>
												<?php } ?>

											</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="form-actions">
					<div class="pull-left">
						<a href="<?php echo base_url(); ?>pages/pages_process/delete/<?php echo $id; ?>" data-title="Delete Page <?php echo $detail->type; ?> - <?php echo $detail->name; ?> ?" class="btn btn-danger btn-cons delete-page"><i class="icon-trash"></i> Delete</a>
					</div>
					<div class="pull-right">
						<button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Save</button>
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url() . ($parent_id ? 'pages/pages/edit/' . $parent_id : ''); ?>">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->