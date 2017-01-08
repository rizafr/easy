<!-- BEGIN PAGE CONTAINER -->
<div class="page-content">
	<div class="content">
		<div class="page-title">
			<h3>Manage - <span class="semi-bold">Comment</span></h3>
		</div>
		<div class="row-fluid">
			<form class="main-form" method="post" action="<?php echo base_url(); ?>pages/pages_article_process/edit_comment/<?php echo $id; ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<div class="span12">
					<div class="grid simple">
						<div class="grid-title">
							<h4>Comment List - <span class="semi-bold"><?php echo $page->menu; ?></span></h4>
						</div>
						<div class="grid-body">
							<table cellpadding="0" cellspacing="0" border="0" id="datatable" class="table table-hover table-condensed" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Email</th>
										<th>Date</th>
										<th>Comment</th>
										<th>Publish</th>
									</tr>
								</thead>
								<tbody>
									<?php if (isset($comment) && ! empty($comment)) { ?>
									<?php $i = 1; ?>
									<?php foreach ($comment as $key => $value) { ?>
									<tr>
										<td width="5%"><?php echo $i; ?></td>
										<td width="15%"><?php echo $value->name; ?></td>
										<td width="15%"><?php echo $value->email; ?></td>
										<td width="15%"><?php echo $value->created_date; ?></td>
										<td width="40%"><?php echo $value->message; ?></td>
										<td width="10%">
											<div class="slide-primary">
												<input type="checkbox" name="publish[<?php echo $value->page_comment_id; ?>]" class="ios" value="1" <?php echo $value->publish ? 'checked="checked"' : ''; ?> />
											</div>
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
				<div class="form-actions">
					<div class="pull-right">
						<button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Save</button>
						<button type="button" class="btn btn-white btn-cons direct-link" href="<?php echo base_url(); ?>pages/pages/edit/<?php echo $parent_id; ?>">Back</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END PAGE CONTAINER -->