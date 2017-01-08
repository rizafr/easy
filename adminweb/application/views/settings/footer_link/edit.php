<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>Footer Link - <span class="semi-bold">Edit</span></h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>settings/settings-footer-link-process/edit/<?php echo $id; ?>" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">
						<div class="grid-title no-border">
							<h4>Main <span class="semi-bold">Form</span></h4>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid column-seperation">
								<div class="span12">
									<div class="image-upload-wrapper span12">
										<div class="row-fluid">
											<div class="span4 input-wrapper">
												<?php if ($detail->image && file_exists($this->upload_path . 'footer/' . $detail->image)) { ?>
													<img src="<?php echo $this->upload_dir . 'footer/' . $detail->image; ?>" style="width:100%; margin-bottom: 10px;">
												<?php } ?>
												<input type="file" name="image" id="image-upload" class="nicefileinput" />
												<span class="error"><label for="image-upload" class="error"></label></span>
											</div>
											<div class="span4 input-wrapper">
												<input type="text" name="title" id="image-title" class="span12" placeholder="Image Title" value="<?php echo $detail->title; ?>" />
												<span class="error"><label for="image-title" class="error"></label></span>
											</div>
											<div class="span4 input-wrapper">
												<input type="text" name="url" id="image-url" class="span12" placeholder="Image Url" value="<?php echo $detail->url; ?>" />
												<span class="error"><label for="image-url" class="error"></label></span>
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
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url(); ?>settings/settings-footer-link">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->