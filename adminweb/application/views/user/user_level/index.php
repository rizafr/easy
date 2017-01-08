<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>User - <span class="semi-bold">Level</span></h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4>User Level <span class="semi-bold">List</span></h4>
					</div>
					<div id="datatable-button">
						<input type="hidden" class="button-item" data-url="<?php echo base_url(); ?>user/user/add_level" data-message="Add User Level" data-class="btn btn-block btn-primary direct-link" data-icon="icon-plus" />
					</div>
					<div class="grid-body">
						<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>User Level</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($user_level) && ! empty($user_level)) { ?>
								<?php $i = 1; ?>
								<?php foreach ($user_level as $key => $value) { ?>
								<tr>
									<td width="5%"><?php echo $i; ?></td>
									<td width="20%"><?php echo $value->level; ?></td>
									<td width="10%" style="text-align:center;">
										<a class="direct-link" href="<?php echo base_url(); ?>user/user/edit_level/<?php echo $value->user_level_id; ?>" title="Edit"><i class="icon-cog"></i></a>
										<a class="delete-table-row" href="<?php echo base_url(); ?>user/user_process/delete_level/<?php echo $value->user_level_id; ?>" data-title="Delete User Level <?php echo $value->level; ?>?" title="Delete"><i class="icon-remove"></i></a>
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
<!-- END PAGE CONTAINER -->