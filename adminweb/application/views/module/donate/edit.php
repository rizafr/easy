<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Donation</h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>module/donation_process/edit/<?php echo $id; ?>" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" id="container-start-width" value="1170" />
			<input type="hidden" id="container-start-height" value="500" />

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">

						<ul class="nav nav-tabs" id="main-tab">
							<li class="active"><a href="#tabs-detail">Donation Detail</a></li>
						</ul>

						<div class="tab-content" id="tab-main">

							<div class="main-pane tab-pane secondary-pane active" id="tabs-detail">
								<div class="row-fluid item-pane all">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3>Donation Detail</h3>
											</div>
											<div class="grid-body no-border">
												<div class="row-fluid">
													<div class="span6">
														<h5 class="semi-bold">Firstname</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="firstname" disabled="disabled" id="firstname" placeholder="Firstname" class="span12" value="<?php echo $donate->firstname; ?>" />
																<span class="error"><label for="firstname" class="error"></label></span>
															</div>
														</div>
													</div>
													<div class="span6">		
														<h5 class="semi-bold">Lastname</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="lastname" disabled="disabled" id="lastname" placeholder="Lastname" class="span12" value="<?php echo $donate->lastname; ?>" />
																<span class="error"><label for="lastname" class="error"></label></span>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span6">
														<h5 class="semi-bold">Contact</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name=""contact"" disabled="disabled" id="contact" placeholder="Contact" class="span12" value="<?php echo $donate->contact; ?>" />
																<span class="error"><label for=""contact"" class="error"></label></span>
															</div>
														</div>
													</div>
													<div class="span6">		
														<h5 class="semi-bold">Email</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="email" disabled="disabled" id="email" placeholder="Email" class="span12" value="<?php echo $donate->email; ?>" />
																<span class="error"><label for="email" class="error"></label></span>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span6">
														<h5 class="semi-bold">Donation Amount</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="transfer_amount" disabled="disabled" id="transfer_amount" placeholder="Transfer Amount" class="span12" value="<?php echo $donate->transfer_amount; ?>" />
																<span class="error"><label for="transfer_amount" class="error"></label></span>
															</div>
														</div>
													</div>
													<div class="span6">		
														<h5 class="semi-bold">Donation Type</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="payment_pupose" disabled="disabled" id="payment_pupose" placeholder="Donation Type" class="span12" value="<?php 
																switch ($donate->payment_pupose) {
																	case 1: echo "Zakat Harta";
																	break;
																	case 2: echo "Zakat Perniagaan";
																	break;
																	case 3: echo "Zakat Profesi";
																	break;
																	case 4: echo "Zakat Profesi";
																	break;
																	case 5: echo "Zakat Lainnya (Hadiah/Temuan)";
																	break;
																	case 6: echo "Total Akumulasi Zakat";
																	break;
																	case 7: echo "Infaq & Shadaqoh";
																	break;
																	case 8: echo "Kemanusiaan";
																	break;
																	case 9: echo "Dana Penyaluran Fasum";
																	break;
																	case 10: echo "Wakaf";
																	break;
																	case 11: echo "Yatim & Janda";
																	break;
																	case 12: echo "Kesehatan";
																	break;
																	case 13: echo "Simapanan Qurban";
																	break;
																	case 14: echo "Qurban";
																	break;
																}
																?>" />
																<span class="error"><label for="title" class="error"></label></span>
															</div>
														</div>
													</div>
												</div>												
												<div class="row-fluid">
													<div class="span12">
														<h5 class="semi-bold">Address</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="address" disabled="disabled" id="address" placeholder="Address" class="span12" value="<?php echo $donate->address;?>" />
																<span class="error"><label for="address" class="error"></label></span>
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
													<div class="span6">
														<h5 class="semi-bold">Transfer Method</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
																<input type="text" name="transfer_method" disabled="disabled" id="transfer_method" placeholder="Transfer Method" class="span12" value="<?php 
																switch ($donate->transfer_method) {
																	case 1: echo "Transfer Bank";
																	break;
																	case 2: echo "Faspay";
																	break;
																	case 3: echo "Jemput Zakat/Donasi";
																	break;
																}
																?>" />
																<span class="error"><label for="transfer_method" class="error"></label></span>
															</div>
														</div>
													</div>
													<div class="span6">		
														<h5 class="semi-bold">Status</h5>
														<div class="row-fluid">
															<div class="span12 input-wrapper">
															<select name="status" class="select" style="width:100%">
																<option value=" " <?php echo ' ' === $donate->status ? 'selected="selected"' : ''; ?>>Choose Status</option>
																<option value="0" <?php echo '0' === $donate->status ? 'selected="selected"' : ''; ?>>Rencana</option>
																<option value="1" <?php echo '1' === $donate->status ? 'selected="selected"' : ''; ?>>Tunggu Konfirmasi</option>
																<option value="2" <?php echo '2' === $donate->status ? 'selected="selected"' : ''; ?>>Terkonfirmasi</option>
															</select>
															<span class="error"><label for="status" class="error"></label></span>
														</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="form-actions">
					<div class="pull-right">
						<button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Save</button>
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url() . 'module/donation'; ?>">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->