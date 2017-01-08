<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>User Level - <span class="semi-bold">Add</span></h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>user/user_process/add_level">
			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">
						<div class="grid-title no-border">
							<h4>Main <span class="semi-bold">Form</span></h4>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid column-seperation">
								<div class="span12">
									<div class="row-fluid">
										<div class="span12">
											<h5 class="semi-bold">Level Name</h5>
											<div class="row-fluid">
												<div class="span11">
													<input type="text" name="level" id="level" placeholder="Level Name" class="span12" value="" />
													<span class="error"><label for="level" class="error"></label></span>
												</div>
											</div>
										</div>
									</div>									
									<?php
									function create_menu($user_menu) {
										if (is_array($user_menu)) {
											?><ul><?php
											foreach ($user_menu as $key => $value) {
												$has_child = isset($value['children']) && ! empty($value['children']);
												$checked = $value['active'] ? 'checked="checked"' : '';
												?>
												<li class="<?php echo $has_child ? 'indicator' : ''; ?>">
													<div class="checkbox check-primary">
														<input type="checkbox" name="access[<?php echo $value['page_id']; ?>]" id="page-<?php echo $value['page_id']; ?>" value="<?php echo $value['page_id']; ?>" <?php echo $checked; ?> />
														<label for="page-<?php echo $value['page_id']; ?>">
															<span><?php echo $value['menu']; ?></span>
														</label>
													</div>
													<?php
													if ($has_child) {
														create_menu($value['children']);
													}
													?>
												</li>
												<?php
											}
											?></ul><?php
										}
									}
									?>
									<h5 class="semi-bold">User Level Access</h5>
									<div class="row-fluid">
										<div class="span12 user-menu-wrapper">
											<?php create_menu($user_menu); ?>
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
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url(); ?>user/user/level">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->