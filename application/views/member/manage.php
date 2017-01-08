<div class="container">
	<div class="content_fullwidth">
		<div class="container">
			<form class="main-form profile-form" method="post" action="<?php echo base_url(); ?>process/member/edit_profile/<?php echo $profile->profile_id; ?>" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $profile->profile_id; ?>" />
				<input type="hidden" name="user_id" value="<?php echo $profile->user_id; ?>" />
				<div class="form-data one_full">
					<h4>Ubah Data Profil</h4>
					<div class="alert-wrapper"><?php if (isset($_SESSION['success'])) { ?><div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div><?php } ?></div>
					<div class="columns">
						<div class="one_half">
							<div class="columns">
								<div class="semi-bold">Nama</div>
								<div class="columns">
									<div class="one_full">
										<input type="text" name="fullname" id="fullname" placeholder="Nama" class="form-input" value="<?php echo $profile->user_fullname; ?>" />
										<span class="error-wrapper"><label for="fullname" class="error"></label></span>
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Username</div>
								<div class="columns">
									<div class="one_full">
										<input type="text" name="username" id="username" placeholder="Username" class="form-input" value="<?php echo $profile->user_username; ?>" />
										<span class="error-wrapper"><label for="username" class="error"></label></span>
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Email</div>
								<div class="columns">
									<div class="one_full">
										<input type="text" name="email" id="email" placeholder="Email" class="form-input" value="<?php echo $profile->user_email; ?>" />
										<span class="error-wrapper"><label for="email" class="error"></label></span>
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Perusahaan</div>
								<div class="columns">
									<div class="one_full">
										<input type="text" name="name" id="name" placeholder="Perusahaan" class="form-input" value="<?php echo $profile->profile_name; ?>" />
										<span class="error-wrapper"><label for="name" class="error"></label></span>
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Kontak</div>
								<div class="columns">
									<div class="one_full">
										<input type="text" name="contact" id="contact" placeholder="Kontak" class="form-input" value="<?php echo $profile->profile_contact; ?>" />
										<span class="error-wrapper"><label for="contact" class="error"></label></span>
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Website</div>
								<div class="columns">
									<div class="one_full">
										<input type="text" name="website" id="website" placeholder="Website" class="form-input" value="<?php echo $profile->profile_website; ?>" />
										<span class="error-wrapper"><label for="website" class="error"></label></span>
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Alamat</div>
								<div class="columns">
									<div class="one_full">
										<textarea name="address" id="address" class="form-input" rows="5" placeholder="Alamat"><?php echo $profile->profile_address; ?></textarea>
										<span class="error-wrapper"><label for="address" class="error"></label></span>
									</div>
								</div>
							</div>
						</div>
						<div class="one_half last">
							<div class="columns">
								<div class="semi-bold">Kategori</div>
								<div class="columns">
									<div class="one_full">
										<select name="category" class="select2 form-input" style="width:100%">
											<option value=""> - Pilih Kategori - </option>
											<?php if (isset($category) && ! empty($category)) { ?>
												<?php foreach ($category as $key => $value) { ?>
													<option value="<?php echo $value->category_id; ?>" <?php if ($value->category_id === $profile->category_id) { echo 'selected="selected"'; } ?>><?php echo $value->name; ?></option>
												<?php } ?>
											<?php } ?>
										</select>
										<span class="error-wrapper"><label for="category" class="error"></label></span>
										<br /><br />
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Reseller Ready</div>
								<div class="columns">
									<div class="one_full">
										<div class="radio-group">
											<input type="radio" name="reseller" value="1" id="reseller-aktif" <?php echo $profile->profile_reseller === '1' ? 'checked="checked"' : ''; ?> /> <label for="reseller-aktif">Ya</label>
											<br />
											<input type="radio" name="reseller" value="0" id="reseller-tidak-aktif" <?php echo $profile->profile_reseller !== '1' ? 'checked="checked"' : ''; ?> /> <label for="reseller-tidak-aktif">Tidak</label>											
										</div>
										<span class="error-wrapper"><label for="reseller" class="error"></label></span>
										<br /><br />
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Investment Ready</div>
								<div class="columns">
									<div class="one_full">
										<div class="radio-group">
											<input type="radio" name="investment" value="1" id="investment-aktif" <?php echo $profile->profile_investment === '1' ? 'checked="checked"' : ''; ?> /> <label for="investment-aktif">Ya</label>
											<br />
											<input type="radio" name="investment" value="0" id="investment-tidak-aktif" <?php echo $profile->profile_investment !== '1' ? 'checked="checked"' : ''; ?> /> <label for="investment-tidak-aktif">Tidak</label>											
										</div>
										<span class="error-wrapper"><label for="investment" class="error"></label></span>
										<br /><br />
									</div>
								</div>
							</div>
							<div class="columns">
								<div class="semi-bold">Apprentice Ready</div>
								<div class="columns">
									<div class="one_full">
										<div class="radio-group">
											<input type="radio" name="apprentice" value="1" id="apprentice-aktif" <?php echo $profile->profile_apprentice === '1' ? 'checked="checked"' : ''; ?> /> <label for="apprentice-aktif">Ya</label>
											<br />
											<input type="radio" name="apprentice" value="0" id="apprentice-tidak-aktif" <?php echo $profile->profile_apprentice !== '1' ? 'checked="checked"' : ''; ?> /> <label for="apprentice-tidak-aktif">Tidak</label>											
										</div>
										<span class="error-wrapper"><label for="apprentice" class="error"></label></span>
										<br /><br />
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