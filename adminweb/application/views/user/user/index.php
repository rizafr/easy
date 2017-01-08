<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>Manage - <span class="semi-bold">User</span></h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4>User <span class="semi-bold">List</span></h4>
					</div>
					<div id="datatable-button">
						<input type="hidden" class="button-item" data-url="<?php echo base_url(); ?>user/user/add" data-message="Add User" data-class="btn btn-block btn-primary direct-link" data-icon="icon-plus" />
					</div>
					<div class="grid-body">
						<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Fullname</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Level</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($user) && ! empty($user)) { ?>
								<?php $i = 1; ?>
								<?php foreach ($user as $key => $value) { ?>
								<tr>
									<td width="5%"><?php echo $i; ?></td>
									<td width="20%"><?php echo $value->full_name; ?></td>
                                    <td width="20%"><?php echo $value->email; ?></td>
                                    <td width="20%"><?php echo $value->username; ?></td>
                                    <td width="20%"><?php echo $value->level; ?></td>
									<td width="10%" style="text-align:center;">
										<a class="direct-link" href="<?php echo base_url(); ?>user/user/edit/<?php echo $value->user_id; ?>" title="Edit"><i class="icon-cog"></i></a>
										<a class="delete-table-row" href="<?php echo base_url(); ?>user/user_process/delete/<?php echo $value->user_id; ?>" data-title="Delete User <?php echo $value->full_name; ?>(<?php echo $value->email; ?>)?" title="Delete"><i class="icon-remove"></i></a>
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