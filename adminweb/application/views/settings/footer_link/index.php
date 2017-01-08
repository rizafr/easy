<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>Settings - <span class="semi-bold">Footer Link</span></h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4><span class="semi-bold">Footer Link</span> List</h4>
					</div>
					<div id="datatable-button">
						<input type="hidden" class="button-item" data-url="<?php echo base_url(); ?>settings/settings-footer-link/add" data-message="Add Link" data-class="btn btn-block btn-primary direct-link" data-icon="icon-plus" />
					</div>
					<div class="grid-body">
						<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
                                    <th>Title</th>
                                    <th>Url</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($footer_link) && ! empty($footer_link)) { ?>
								<?php $i = 1; ?>
								<?php foreach ($footer_link as $key => $value) { ?>
								<tr>
									<td width="5%"><?php echo $i; ?></td>
                                    <td width="20%"><img src="<?php echo $this->upload_dir . 'footer/' . $value->image; ?>" style="max-width:100%; max-height:80px;" /></td>
									<td width="20%"><?php echo $value->title; ?></td>
                                    <td width="20%"><?php echo $value->url ? '<a style="margin:0;" target="_blank" href="' . $value->url . '">' . $value->url . '</a>' : ''; ?></td>
									<td width="10%" style="text-align:center;">
										<a class="direct-link" href="<?php echo base_url(); ?>settings/settings-footer-link/edit/<?php echo $value->setting_id; ?>" title="Edit"><i class="icon-cog"></i></a>
										<a class="delete-table-row" href="<?php echo base_url(); ?>settings/settings-footer-link-process/delete/<?php echo $value->setting_id; ?>" data-title="Delete Link <?php echo $value->title; ?>?" title="Delete"><i class="icon-remove"></i></a>
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