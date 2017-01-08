<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><?php echo $detail_parent->name ?> Page - <span class="semi-bold">Add Detail</span></h3>
		</div> <!-- class="main-form" -->
		<form class="main-form" method="post" action="<?php echo base_url(); ?>pages/pages_process/add" enctype="multipart/form-data">
			<input type="hidden" name="is_menu" value="0" />

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">

						<ul class="nav nav-tabs" id="main-tab">
							<li class="active"><a href="#tabs-main">Main</a></li>
							<li><a href="#tabs-content">Content</a></li>
							<li><a href="#tabs-image">Image</a></li>
							<li><a href="#tabs-attachment">Attachment</a></li>
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
																		<input type="hidden" name="type" class="page-type" value="<?php echo $detail_parent->type; ?>" />
																		<input type="text" placeholder="Page Type" class="span12" readonly="readonly" value="<?php echo ucwords($detail_parent->type); ?>" />
																	</div>
																</div>
															</div>
															<div class="span5">
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
														<div class="row-fluid item-pane static parent article">
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
																			<input type="checkbox" name="publish" class="ios" value="1" checked="checked" />
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
												<?php if ($detail_parent->type === 'article') { ?>
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
																<div class="row-fluid item-pane static article gallery">
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
																<div class="row-fluid">
																	<div class="span12">
																		<h5 class="semi-bold">Related Content</h5>
																		<div class="row-fluid">
																			<div class="span12 input-wrapper">
																				<select multiple
										                                                data-placeholder="Select related content"
										                                                data-minimum-results-for-search="10"
										                                                tabindex="-1"
										                                                class="select2 form-control" id="multiple-select" style="width: 100%;"
										                                                name="page_related[<?php echo $value->page_language_id; ?>][]" id="page-content-body-<?php echo $value->page_language_id; ?>"
										                                                placeholder="Related Content (<?php echo $value->name; ?>)">
										                                            	<?php if (isset($content) && ! empty($content)) { ?>
										                                            		<?php foreach ($content as $key => $value) { ?>
										                                            			<?php if($value->parent_menu_id == $detail_parent->page_id) {?>
										                                            				<option value="<?php echo $value->page_content_id;?>"><?php echo $value->name;?></option>
										                                            			<?php }?>
										                                            		<?php }?>
										                                            	<?php }?>
										                                        </select>
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
															<div class="tab-pane <?php echo $value->default ? 'active' : ''; ?>" id="<?php echo $value->name; ?>">
																<div class="row-fluid">
																	<div class="span12">
																		<h5 class="semi-bold">Gallery Title</h5>
																		<div class="row-fluid">
																			<div class="span11">
																				<input type="text" name="page_content[<?php echo $value->page_language_id; ?>][title]" id="page-content-title-<?php echo $value->page_language_id; ?>" placeholder="Gallery Title (<?php echo $value->name; ?>)" class="span12" />
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
																				<textarea name="page_content[<?php echo $value->page_language_id; ?>][body]" id="page-content-body-<?php echo $value->page_language_id; ?>" placeholder="Gallery Description (<?php echo $value->name; ?>)" class="span12" rows="10"></textarea>
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
							
						</div>
					</div>
				</div>

				<div class="form-actions">
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