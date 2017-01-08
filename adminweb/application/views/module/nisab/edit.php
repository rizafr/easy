<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3><span class="semi-bold">Module</span> - Nisab</h3>
		</div>
		<form class="main-form" method="post" action="<?php echo base_url(); ?>module/nisab/update" enctype="multipart/form-data">
			<input type="hidden" id="container-start-width" value="1170" />
			<input type="hidden" id="container-start-height" value="500" />

			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple">

						<ul class="nav nav-tabs" id="main-tab">
							<li class="active"><a href="#tabs-detail">Edit Nisab</a></li>
						</ul>

						<div class="tab-content" id="tab-main">

							<div class="main-pane tab-pane secondary-pane active" id="tabs-detail">
								<div class="row-fluid item-pane all">
									<div class="span12">
										<div class="grid simple">
											<div class="grid-title no-border">
												<h3>Nisab Detail</h3>
											</div>
											<div class="grid-body no-border">
												<div class="row-fluid">
													<div class="span12">
														<h5 class="semi-bold">Nilai Dasar</h5>
														<div class="row-fluid">
															<div class="span8 input-wrapper">
																<input type="text" name="nisab_base" id="nisab" placeholder="Nilai Dasar Nisab" class="span12" value="<?php echo $nisab->nisab_base; ?>" />
																<span class="error"><label for="nisab" class="error"></label></span>
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
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url() . 'module/nisab'; ?>">Back</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- END PAGE CONTAINER -->