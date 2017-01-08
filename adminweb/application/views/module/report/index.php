<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Report</h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4>Report <span class="semi-bold">List</span></h4>
					</div>
					<div id="datatable-button">
						<input type="hidden" class="button-item" data-url="<?php echo base_url(); ?>module/report/add" data-message="Add Report" data-class="btn btn-block btn-primary direct-link" data-icon="icon-plus" />
					</div>
					<div class="grid-body">
						<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
							<thead>
								<tr>
									<th class="padding-right">#</th>
									<th>Date</th>
									<th>Title</th>
									<th>Type</th>									
									<th style="text-align:center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($files) && ! empty($files)) { ?>
								<?php $i = 1; ?>
								<?php foreach ($files as $key => $value) { ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->date_string; ?></td>
									<td><?php echo $value->title; ?></td>
									<td><?php switch ($value->type) {
										case 1: echo "PDF";
										break;
										case 2: echo "Word";
										break;
										case 3: echo "Excel";
										break;
										case 4: echo "Power point";
										break;
										case 5: echo "ZIP/RAR";
										break;
									}
									?></td>
									<td style="text-align:center; min-width:60px;">
										<a class="direct-link" href="<?php echo base_url(); ?>module/report/edit/<?php echo $value->report_id; ?>" title="Edit Report"><i class="icon-cog"></i></a>
										<a class="delete-table-row" href="<?php echo base_url(); ?>module/report_process/delete/<?php echo $value->report_id; ?>" data-title="Delete Report <?php echo $value->title; ?> ?" title="Delete"><i class="icon-remove"></i></a>
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