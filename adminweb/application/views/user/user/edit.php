<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>User - <span class="semi-bold">Edit</span></h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>user/user_process/edit/<?php echo $id; ?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">
						<div class="grid-title no-border">
							<h4>Main <span class="semi-bold">Form</span></h4>
						</div>
						<div class="grid-body no-border">
							<div class="row-fluid column-seperation">
								<div class="span6">
									<div class="row-fluid">
										<div class="span12">
											<h5 class="semi-bold">Full Name</h5>
											<div class="row-fluid">
												<div class="span11">
													<input type="text" name="full_name" id="full_name" placeholder="Full Name" class="span12" value="<?php echo $detail->full_name; ?>" />
													<span class="error"><label for="full_name" class="error"></label></span>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span12">
											<h5 class="semi-bold">Email</h5>
											<div class="row-fluid">
												<div class="span11">
													<input type="text" name="email" id="email" placeholder="Email" class="span12" value="<?php echo $detail->email; ?>" />
													<span class="error"><label for="email" class="error"></label></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="span6">
									<div class="row-fluid">
										<div class="span12">
											<h5 class="semi-bold">Username</h5>
											<div class="row-fluid">
												<div class="span11">
													<input type="text" name="username" id="username" placeholder="Username" class="span12" value="<?php echo $detail->username; ?>" />
													<span class="error"><label for="username" class="error"></label></span>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span12">
											<h5 class="semi-bold">Password</h5>
											<div class="row-fluid">
												<div class="span11">
													<input type="password" name="password" id="password" placeholder="Password" class="span12" value="" />
													<span class="error"><label for="password" class="error"></label></span>
												</div>
											</div>
										</div>
									</div>
									<?php if ($this->is_super) {?>
									<div class="row-fluid">
										<div class="span12">
											<h5 class="semi-bold">Level</h5>
											<div class="row-fluid">
												<div class="span12">
													<select name="level" class="select" style="width:100%">
														<?php if (isset($level) && ! empty($level)) { ?>
														<?php foreach ($level as $key => $value) { ?>
														<?php $selected = $value->user_level_id === $detail->user_level_id ? 'selected="selected"' : ''; ?>
														<option value="<?php echo $value->user_level_id; ?>" <?php echo $selected; ?>><?php echo $value->level; ?></option>
														<?php } ?>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="pull-right">
						<button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Save</button>
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url(); ?>user/user">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->