<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Nisab</h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4>Nisab <span class="semi-bold">List</span></h4>
					</div>
					<div class="grid-body">
						<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
							<thead>
								<tr>
									<th class="padding-right">#</th>
									<th>Last Update</th>
									<th>Nilai Dasar</th>										
									<th style="text-align:center;">Action</th>						
								</tr>
							</thead>
							<tbody>
								<?php if (isset($nisab) && ! empty($nisab)) { ?>							
								<tr>
									<td>1</td>
									<td><?php echo $nisab->date_created_shorts; ?></td>									
									<td><?php echo 'Rp. '.number_format($nisab->nisab_base, 0, ',', '.'); ?></td>	
									<td style="text-align:center; min-width:60px;">
										<a href="<?php echo base_url(); ?>module/nisab/edit" title="Edit Donation"><i class="icon-cog"></i></a>								
									</td>								
								</tr>
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
