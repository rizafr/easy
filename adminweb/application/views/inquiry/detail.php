<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<?php
		if (isset($form) && ! empty($form)) {
			$form_detail = $form;
			$form_serial = $form->data;
			$form_data = json_decode($form_serial);
		}
		$language_id = isset($language) ? $language[0]->page_language_id : NULL;
		?>
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
					<div class="grid-title no-border">
						<h3>Inquiry - <span class="semi-bold">Detail</span></h3>
					</div>
					<div class="grid-body no-border">
						<div class="row-fluid">
							<div class="span12">
							<?php if (isset($form_data) && is_array($form_data)) { ?>
								<?php foreach ($form_data as $key => $value) { ?>
									<?php $value = get_object_vars($value); ?>
									<?php $value['label'] = $value['label'] ? get_object_vars($value['label']) : array(); ?>
									<?php if ($value['type'] !== 'BREAK') { ?>
										<div class="inquiry-detail">
											<div class="row-fluid">
												<span class="span12 bold"><?php echo isset($value['label'][$language_id]) ? $value['label'][$language_id] : 'Untitled'; ?></span>
											</div>
											<?php if (isset($inquiry->{$value['name']})) { ?>
												<?php
												if ($value['type'] === 'DATE') {
													list($y,$m,$d) = explode('-', $inquiry->{$value['name']});
													$inquiry->{$value['name']} = $d . '-' . $m . '-' . $y;
												}
												?>
												<div class="row-fluid">
													<span class="inquiry-value span12"><?php echo $inquiry->{$value['name']}; ?></span>
												</div>
											<?php } ?>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } ?>
							</div>
						</div>
						<div class="row-fluid">
							<div class="pull-right">
								<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url(); ?>pages/pages/edit/<?php echo $parent_id; ?>">Back</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTAINER -->