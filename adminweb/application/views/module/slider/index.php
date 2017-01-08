<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Slider</h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4>Slider <span class="semi-bold">List</span></h4>
					</div>
					<div id="datatable-button">
						<input type="hidden" class="button-item" data-url="<?php echo base_url(); ?>module/slider/add" data-message="Add Slider" data-class="btn btn-block btn-primary direct-link" data-icon="icon-plus" />
					</div>
					<div class="grid-body">
						<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
							<thead>
								<tr>
									<th class="padding-right">#</th>
									<th>Title</th>
									<th>Image</th>
									<th style="text-align:center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($slider) && ! empty($slider)) { ?>
								<?php $i = 1; ?>
								<?php foreach ($slider as $key => $value) { ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->title; ?></td>
									<td><img class="slider-thumb" src="<?php echo $this->dir . 'uploads/slides/' . $value->image; ?>" /></td>
									<td style="text-align:center; min-width:60px;">
										<a class="direct-link" href="<?php echo base_url(); ?>module/slider/edit/<?php echo $value->slider_id; ?>" title="Edit Slider"><i class="icon-cog"></i></a>
										<a class="delete-table-row" href="<?php echo base_url(); ?>module/slider_process/delete/<?php echo $value->slider_id; ?>" data-title="Delete Slider <?php echo $value->title; ?> ?" title="Delete"><i class="icon-remove"></i></a>
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