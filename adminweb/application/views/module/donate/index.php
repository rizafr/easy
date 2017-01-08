<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Donation</h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4>Donation <span class="semi-bold">List</span></h4>
					</div>
					<div class="grid-body">
						<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
							<thead>
								<tr>
									<th class="padding-right">#</th>
									<th>Tanggal</th>
									<th>Nama Lengkap</th>
									<th>Kontak</th>
									<th>Email</th>	
									<th>Tujuan</th>
									<th>Metode</th>	
									<th>Jumlah</th>
									<th>Status</th>	
									<th style="text-align:center;">Action</th>						
								</tr>
							</thead>
							<tbody>
								<?php if (isset($donation) && ! empty($donation)) { ?>
								<?php $i = 1; ?>
								<?php foreach ($donation as $key => $value) { ?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $value->date_created_shorts; ?></td>
									<td><?php echo $value->firstname.' '.$value->lastname; ?></td>
									<td><?php echo $value->contact == null ? '-' : $value->contact; ?></td>
									<td><?php echo $value->email; ?></td>	
									<td><?php if($value->payment_pupose==1) echo "Zakat Harta"; 
									if($value->payment_pupose==3) echo "Zakat Profesi";
									if($value->payment_pupose==4) echo "Zakat Fitrah";
									if($value->payment_pupose==7) echo "Infaq & Shadaqoh";
									if($value->payment_pupose==13) echo "Fidyah/Kafarat";
									if($value->payment_pupose==14) echo "Qurban";
									?></td>
									<td><?php  if($value->transfer_method > 3) echo "Faspay"; 
									if($value->transfer_method==2) echo "Transfer Bank";
									if($value->transfer_method==3) echo "Jemput";?></td>
									<td><?php echo 'Rp. '.number_format($value->transfer_amount, 0, ',', '.'); ?></td>	
									<td><?php if($value->status == 0) echo "RENCANA"; if($value->status == 1) echo "TUNGGU KONFIRMASI";if($value->status == 2) echo "TERKONFIRMASI";?></td>
									<td style="text-align:center; min-width:60px;">
										<a class="direct-link" href="<?php echo base_url(); ?>module/donation/edit/<?php echo $value->donate_id; ?>" title="Edit Donation"><i class="icon-cog"></i></a>
										<a class="delete-table-row" href="<?php echo base_url(); ?>module/donation_process/delete/<?php echo $value->donate_id; ?>" data-title="Delete Donation <?php echo $value->firstname.' '.$value->lastname; ?> ?" title="Delete"><i class="icon-remove"></i></a>
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
