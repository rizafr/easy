<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Confirmation</h3>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title">
						<h4>Confirmation <span class="semi-bold">List</span></h4>
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
									<th>Rek. Asal</th>
									<th>Ke bank</th>	
									<th>Jumlah</th>
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
									<td><?php echo $value->name; ?></td>
									<td><?php echo $value->contact == null ? '-' : $value->contact; ?></td>
									<td><?php echo $value->email; ?></td>	
									<td><?php echo $value->frombank; ?></td>
									<td><?php 
									if($value->tobank==1) echo "BCA - 5395.500.900"; 
									if($value->tobank==2) echo "Mandiri - 122.002.80000.68";
									if($value->tobank==3) echo "Syariah	Mandiri - 789.789.1217";
									if($value->tobank==4) echo "BNI Syariah - 121.555.3331";
									if($value->tobank==5) echo "BNI - 5000.121.00";	
									if($value->tobank==6) echo "Muamalat - 301.01.666.14";
									if($value->tobank==7) echo "Permata Syariah - 121.873.2727";
									if($value->tobank==8) echo "BJB - 523.0102.000.127";
									if($value->tobank==9) echo "BCA - 5395.100.600";
									if($value->tobank==10) echo "Mandiri - 122.002.70000.10";
									if($value->tobank==11) echo "Syariah Mandiri - 777.888.1211";
									if($value->tobank==12) echo "BNI Syariah - 121.555.4448";
									if($value->tobank==13) echo "BNI - 700.121.009";
									if($value->tobank==14) echo "Muamalat - 301.01.666.15";
									if($value->tobank==15) echo "Permata Syariah - 121.873.2700";
									?></td>
									<td><?php if(is_numeric($value->amount))echo 'Rp. '.number_format($value->amount, 0, ',', '.'); else echo $value->amount;?></td>	
									<td style="text-align:center; min-width:60px;">
										<a class="delete-table-row" href="<?php echo base_url(); ?>module/confirm/delete/<?php echo $value->confirm_id; ?>" data-title="Delete Confirmation <?php echo $value->name; ?> ?" title="Delete"><i class="icon-remove"></i></a>
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