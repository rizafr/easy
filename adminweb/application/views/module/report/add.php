<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Report</h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>module/report_process/add" enctype="multipart/form-data">
			<input type="hidden" id="container-start-width" value="1170" />
			<input type="hidden" id="container-start-height" value="500" />
			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">
						<ul class="nav nav-tabs" id="main-tab">
							<li class="active"><a href="#tabs-detail">Report Detail</a></li>
						</ul>

						<div class="tab-content" id="tab-main">

							<div class="main-pane tab-pane secondary-pane active" id="tabs-detail">
								<div class="row-fluid item-pane all">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3>Report Detail</h3>
											</div>
											<div class="grid-body no-border">
												<div class="row-fluid">
													<div class="span6">
														<h5 class="semi-bold">Title</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="title" id="title" placeholder="Title" class="span12" />
																<span class="error"><label for="title" class="error"></label></span>
															</div>
														</div>
													</div>
													<div class="span6">
														<h5 class="semi-bold">Files</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="file" name="image_upload[]" id="image_upload" class="nicefileinput sliderimage span12" />
																<span class="error"><label for="image_upload" class="error"></label></span>
															</div>
														</div>
													</div>													
												</div>												
												<div class="row-fluid">
													<div class="span6">
														<h5 class="semi-bold">File Type</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
															<select name="type" class="select" style="width:100%">
																<option value="0">Choose Action</option>
																<option value="1">PDF</option>
																<option value="2">Word</option>
																<option value="3">Excel</option>
																<option value="4">Power point</option>
																<option value="5">ZIP/RAR</option>
															</select>
														</div>
														<span class="error"><label for="type" class="error"></label></span>
														</div>
													</div>
													<div class="span6">
														<h5 class="semi-bold">Description</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="description" id="description" placeholder="Description" class="span12" />
																<span class="error"><label for="description" class="error"></label></span>
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
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url() . 'module/report'; ?>">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->