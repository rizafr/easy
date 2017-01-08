<div class="container">
	<div class="content_fullwidth">
		<div class="container">
			<form class="main-form profile-form" method="post" action="<?php echo base_url(); ?>process/member/edit_password/<?php echo $profile->profile_id; ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $profile->profile_id; ?>" />
				<input type="hidden" name="user_id" value="<?php echo $profile->user_id; ?>" />
				<div class="form-data one_full">
					<h4>Ubah Password</h4>
					<div class="alert-wrapper"><?php if (isset($_SESSION['success'])) { ?><div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div><?php } ?></div>
					<div class="columns">
						<div class="one_half">
							<div class="columns">
								<div class="semi-bold">Password Lama</div>
								<div class="columns">
									<div class="one_full">
										<input type="password" name="old_password" id="old_password" placeholder="Password Lama" class="form-input" value="" />
										<span class="error-wrapper"><label for="old_password" class="error"></label></span>
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Password Baru</div>
								<div class="columns">
									<div class="one_full">
										<input type="password" name="password" id="password" placeholder="Password Baru" class="form-input" value="" />
										<span class="error-wrapper"><label for="password" class="error"></label></span>
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Ulangi Password Baru</div>
								<div class="columns">
									<div class="one_full">
										<input type="password" name="confirm_password" id="confirm_password" placeholder="Ulangi Password Baru" class="form-input" value="" />
										<span class="error-wrapper"><label for="confirm_password" class="error"></label></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-button one_full">
					<div class="pull-right">
						<button type="submit" class="readmore_but3">Simpan</button>
						<button type="button" class="readmore_but4" onclick="document.location.href = '<?php echo base_url(); ?>member/profile';">Kembali</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<div class="clearfix margin_top7"></div>