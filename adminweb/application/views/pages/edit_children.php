<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><?php echo ucwords($detail->type); ?> Page - <span class="semi-bold">Edit Detail</span></h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>pages/pages_process/edit/<?php echo $id; ?>" enctype="multipart/form-data">
			<input type="hidden" name="is_menu" value="0" />
			<input type="hidden" name="id" value="<?php echo $id; ?>" />

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">

						<ul class="nav nav-tabs" id="main-tab">
							<li><a href="#tabs-main">Main</a></li>
							<li class="active"><a href="#tabs-content">Content</a></li>
							<li><a href="#tabs-image">Image</a></li>
							<li><a href="#tabs-attachment">Attachment</a></li>
							<li><a href="#tabs-comment">Comment</a></li>
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
															<div class="span4">
																<h5 class="semi-bold">Page Type</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="hidden" name="type" class="page-type" value="<?php echo $detail->type; ?>" />
																		<input type="text" placeholder="Page Type" class="span12" readonly="readonly" value="<?php echo ucwords($detail->type); ?>" />
																	</div>
																</div>
															</div>
															<div class="span4">
																<h5 class="semi-bold">Page Parent</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="hidden" name="parent_menu" value="<?php echo $detail_parent->page_menu_id; ?>" />
																		<input type="text" placeholder="Page Parent" class="span12" readonly="readonly" value="<?php echo $detail_parent->name; ?>" />
																	</div>
																</div>
															</div>
															<div class="span2">
																<h5 class="semi-bold">Page Order</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="page_order" id="page-order" placeholder="Page Order" class="span12" value="<?php echo $detail->order ? $detail->order : 1; ?>" />
																		<span class="error"><label for="page-order" class="error"></label></span>
																	</div>
																</div>
															</div>
															<div class="span2">
																<h5 class="semi-bold">Date Created</h5>
																<div class="row-fluid">
																	<div class="span12 input-wrapper">
																		<input type="text" name="date_created" id="date-created" placeholder="Date Created" class="span12 datepicker" value="<?php echo $detail->date; ?>" readonly="readonly" />
																		<span class="error"><label for="date-created" class="error"></label></span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid item-pane static parent article">
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
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid">
															<div class="span12 m-b-10">
																<h5 class="semi-bold">Page Category</h5>
																<button type="button" class="btn btn-primary btn-mini add-category"><i class="icon-plus"></i>&nbsp;Add Category</button>
															</div>
														</div>
														<div class="row-fluid">
															<div class="span12">
																<ul class="category-wrapper">
																	<?php if (isset($category) && ! empty($category)) { ?>
																		<?php foreach ($category as $key => $value) { ?>
																			<?php $checked = $value->page_category_join_id ? 'checked="checked"' : ''; ?>
																			<li class="checkbox check-primary">
																				<input type="checkbox" name="category[]" value="<?php echo $value->page_category_id; ?>" id="checkbox-<?php echo $value->page_category_id; ?>" <?php echo $checked; ?> />
																				<label for="checkbox-<?php echo $value->page_category_id; ?>"></label><span class="edit-category" data-id="<?php echo $value->page_category_id; ?>"><?php echo $value->category; ?></span>
																				<div class="remove-category-button"><a class="remove-category" data-id="<?php echo $value->page_category_id; ?>" title="remove"><i class="icon-remove"></i></a></div>
																			</li>
																		<?php } ?>
																	<?php } ?>
																</ul>
															</div>
														</div>
													</div>
												</div>

												<div class="row-fluid">
													<div class="span12">
														<div class="row-fluid">
															<div class="span4">
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
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="main-pane tab-pane secondary-pane active" id="tabs-content">
								<div class="row-fluid item-pane all">
									<div class="span12">
										<div class="grid simple">
											<ul class="nav nav-tabs" id="content-tab">
												<?php if (isset($language) && ! empty($language)) { ?>
													<?php foreach ($language as $key => $value) { ?>
														<li class="<?php echo $value->default ? 'active' : ''; ?>">
															<a href="#content-<?php echo $value->page_language_id; ?>"><?php echo $value->name; ?></a>
														</li>
													<?php } ?>
												<?php } ?>
											</ul>
											<div class="grid-title no-border">
												<h3>Page Content</h3>
											</div>
											<div class="tab-content" id="tab-content">
												<?php if ($detail_parent->type === 'article') { ?>
													<?php if (isset($language) && ! empty($language)) { ?>
														<?php foreach ($language as $key => $value) { ?>
															<div class="tab-pane content-pane <?php echo $value->default ? 'active' : ''; ?>" id="content-<?php echo $value->page_language_id; ?>">
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
																<div class="row-fluid item-pane static article gallery">
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
												<?php } else if ($detail_parent->type === 'gallery') { ?>
													<?php if (isset($language) && ! empty($language)) { ?>
														<?php foreach ($language as $key => $value) { ?>
															<div class="tab-pane content-pane <?php echo $value->default ? 'active' : ''; ?>" id="content-<?php echo $value->name; ?>">
																<div class="row-fluid">
																	<div class="span12">
																		<h5 class="semi-bold">Gallery Title</h5>
																		<div class="row-fluid">
																			<div class="span11">
																				<?php $page_content_title = isset($data[$value->page_language_id]->title) && $data[$value->page_language_id]->title ? ($data[$value->page_language_id]->title) : (isset($data['default']->title) ? ($data['default']->title) : ''); ?>
																				<input type="text" name="page_content[<?php echo $value->page_language_id; ?>][title]" id="page-content-title-<?php echo $value->page_language_id; ?>" placeholder="Gallery Title (<?php echo $value->name; ?>)" class="span12" value="<?php echo $page_content_title; ?>" />
																				<span class="error"><label for="page-content-title-<?php echo $value->page_language_id; ?>" class="error"></label></span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row-fluid">
																	<div class="span12">
																		<h5 class="semi-bold">Gallery Description</h5>
																		<div class="row-fluid">
																			<div class="span12">
																				<?php $page_content_body = isset($data[$value->page_language_id]->body) && $data[$value->page_language_id]->body ? ($data[$value->page_language_id]->body) : (isset($data['default']->body) ? ($data['default']->body) : ''); ?>
																				<textarea name="page_content[<?php echo $value->page_language_id; ?>][body]" id="page-content-body-<?php echo $value->page_language_id; ?>" placeholder="Gallery Description (<?php echo $value->name; ?>)" class="span12" rows="10"><?php echo $page_content_body; ?></textarea>
																				<span class="error"><label for="page-content-body-<?php echo $value->page_language_id; ?>" class="error"></label></span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php } ?>
													<?php } ?>
												<?php } ?>
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

							<div class="main-pane tab-pane secondary-pane" id="tabs-attachment">
								<div class="row-fluid item-pane gallery">
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
																							<td><a href="<?php echo $this->dir; ?>uploads/downloads/<?php echo $detail->type; ?>/<?php echo $value->file_name; ?>" target="_blank"><?php echo $value->name; ?></a></td>
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

							<div class="main-pane tab-pane secondary-pane" id="tabs-comment">
								<div class="row-fluid item-pane article">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h4><?php echo $detail_parent->name; ?> <span class="semi-bold">Comment</span></h4>
											</div>
											<div class="grid-body no-border">
												<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
													<thead>
														<tr>
															<th>#</th>
															<th>Name</th>
															<th>Email</th>
															<th>Date</th>
															<th>Comment</th>
															<th style="text-align:center;">Status</th>
															<th style="text-align:center;">Action</th>
														</tr>
													</thead>
													<tbody>
														<?php if (isset($comment) && ! empty($comment)) { ?>
														<?php $i = 1; ?>
														<?php foreach ($comment as $key => $value) { ?>
														<tr>
															<td width="5%"><?php echo $i; ?></td>
															<td width="15%"><?php echo $value->name; ?></a></td>
															<td width="15%"><?php echo $value->email; ?></a></td>
															<td width="15%"><?php echo $value->created_date; ?></td>
															<td width="40%" style="white-space:pre-wrap;"><?php echo $value->message; ?></td>
															<td width="5%" style="text-align:center;"><?php echo $value->publish ? 'Publish' : 'Unpublish'; ?></td>
															<td width="5%" style="text-align:center;">
																<a class="update-comment" title="<?php echo $value->publish ? 'Unpublish' : 'Publish'; ?>" data-publish="<?php echo $value->publish ? '0' : '1'; ?>" data-id="<?php echo $value->page_comment_id; ?>"><?php echo $value->publish ? '<span class="label label-important">Unpublish</span>' : '<span class="label label-success">Publish</span>'; ?></a>
															</td>
														</tr>
														<?php $i++; ?>
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