<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Member</h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4>Member <span class="semi-bold">List</span></h4>
					</div>
					<div class="grid-body">
						<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
							<thead>
								<tr>
									<th class="padding-right">#</th>
									<th>Nama Lengkap</th>
									<th>Kontak</th>
									<th>Email</th>	
									<th style="text-align:center;">Action</th>								
								</tr>
							</thead>
							<tbody>
								<?php if (isset($member) && ! empty($member)) { ?>
								<?php $i = 1; ?>
								<?php foreach ($member as $key => $value) { ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->first_name.' '.$value->last_name; ?></td>
									<td><?php echo $value->contact == null ? '-' : $value->contact; ?></td>
									<td><?php echo $value->email; ?></td>	
									<td style="text-align:center; min-width:60px;">
										<a class="delete-table-row" href="<?php echo base_url(); ?>module/donors/delete/<?php echo $value->member_id; ?>" data-title="Delete Member <?php echo $value->first_name.' '.$value->last_name; ?> ?" title="Delete"><i class="icon-remove"></i></a>
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