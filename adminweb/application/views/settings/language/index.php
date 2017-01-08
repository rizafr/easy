<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>Settings - <span class="semi-bold">Language</span></h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>settings/settings_language_process/update" enctype="multipart/form-data">
			<?php if (isset($language) && ! empty($language)) { ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">
						<div class="grid-title">
							<h4>Language <span class="semi-bold">List</span></h4>
						</div>
						<div class="grid-body">
							<ul class="language-wrapper">
								<?php foreach ($language as $key => $value) { ?>
								<?php $checked = $value->active ? 'checked="checked"' : ''; ?>
								<li>
									<div class="checkbox check-primary">
										<input type="checkbox" name="language[<?php echo $value->page_language_id; ?>]" id="language-<?php echo $value->page_language_id; ?>" value="<?php echo $value->page_language_id; ?>" <?php echo $checked; ?> />
										<label for="language-<?php echo $value->page_language_id; ?>">
											<img class="flag <?php echo $value->icon; ?>" />
											<span><?php echo $value->name; ?></span>
										</label>
									</div>
								</li>
								<?php } ?>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="pull-right">
						<button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Update</button>
					</div>
				</div>
			</div>
			<?php } ?>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->