
<?php $page_language_id = isset($page_detail->content[$this->language_id]) ? $this->language_id : 'default'; ?>
<?php $parent_language_id = isset($parent_detail->content[$this->language_id]) ? $this->language_id : 'default'; ?>

<div
	class="kl-slideshow static-content__slideshow uh_light_gray maskcontainer--shadow_ud ">
	<div class="bgback"></div>
	<div class="kl-slideshow-inner static-content__wrapper min-200">
		<div class="static-content__source ">
			<div class="kl-bg-source">
                     	<?php //if (isset($page_image) && ! empty($page_image)) { echo json_encode($page_image);?>
							<?php //foreach ($page_image as $key => $value) { ?>
							<?php $image =  base_url().'assets/images/iziheader.jpg';//base_url() . 'uploads/images/' . $page_detail->type . '/' . 'full' . '/' . $value->file_name; ?>
							<?php // } ?>
							<div class="kl-bg-source__bgimage" style="background-image:url(<?php echo $image;?>);background-repeat:no-repeat;background-attachment:scroll;background-position-x:center;background-position-y:center;background-size:cover"></div>
						<?php // }  ?>                   
                        <div class="kl-bg-source__overlay"
					style="background: rgba(30, 115, 190, 0.3); background: -moz-linear-gradient(left, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(30, 115, 190, 0.3)), color-stop(100%, rgba(53, 53, 53, 0.3))); background: -webkit-linear-gradient(left, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%); background: -o-linear-gradient(left, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%); background: -ms-linear-gradient(left, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%); background: linear-gradient(to right, rgba(30, 115, 190, 0.3) 0%, rgba(53, 53, 53, 0.3) 100%);"></div>
			</div>
			<div class="th-sparkles"></div>
		</div>
		<div class="static-content__inner container">
			<div class="kl-slideshow-safepadding sc__container ">
				<div class="row" style="margin-top: 115px;">
					<div class="col-sm-6">
						<ul class="breadcrumbs fixclear"><?php if($breadcrumbs) { ?>
							<?php foreach ($breadcrumbs as $breadcrumb) { ?>
							<li><a href="<?php echo $breadcrumb->guid;?>"><?php echo $breadcrumb->menu?></a></li>
							<?php }}?>
						</ul>
						<span id="current-date" class="subheader-currentdate"><?php echo date('M d Y');?></span>
						<div class="clearfix"></div>
					</div>
					<div class="col-sm-6">
						<div class="subheader-titles"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="kl-bottommask kl-bottommask--shadow_ud"></div>
</div>
</div>

<style>
<!--
.required {
	color: #ff0000;
}

label {
	font-weight: 400;
}

input {
	box-sizing: border-box;
	/* 	width: 100%; */
	margin-bottom: 8px;
	border: 1px solid #d8d8d8;
	padding: 7px 10px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
	border-radius: 3px;
}

input[type="submit"] {
	background: #a2ca2b;
	font-family: open sans;
	width: 100%;
	font-size: 15px !important;
	padding: 10px 0px;
	font-weight: 700;
	color: #fff;
	text-transform: uppercase;
	text-shadow: none;
	border-radius: 3px;
	box-shadow: none;
	position: relative;
	border: 0;
	line-height: 1;
}

input[type="submit"]:hover {
	background-color: #769B08;
}

textarea {
	border: 1px solid #d8d8d8;
	height: auto;
	min-height: 30px;
	padding: 7px 10px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
	border-radius: 3px;
}

select {
	background-color: #fff;
	border: 1px solid #d8d8d8;
	height: auto;
	min-height: 30px;
	padding: 2px 10px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
	border-radius: 3px;
}
-->
</style>
<section id="content" class="hg_section ptop-60">
	<div class="container" id="donate">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="right_sidebar col-md-6">
				<div class="kl-store"> <!-- id="donate-form" -->
					<form method="POST" class="login" 
						enctype="multipart/form-data"
						action="<?php echo base_url()?>process/donation/submit">
						<div class="col-md-12">
							<p id="other"></p>
						</div>
						<div class="col-md-12">
						<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input name="member_id" type="hidden"
								value="<?php echo $user->member_id;?>">
							<input name="exist" type="hidden"
								value="<?php if(isset($calculated)) echo $calculated['donate_id']; else echo "0";?>">
						<?php }?>	
							<p class="form-row form-row-wide" id="jpayment">
								<label for="jpayment"><?php echo $this->language_id=='107' ? 'Type of payment' : 'Jenis Pembayaran'; ?><span class="required">*</span>
								</label> <select name="pembayaran" style="width: 100%">
									<option style="padding: 8px;" value="0"><?php echo $this->language_id=='107' ? 'Choose Type of payment' : 'Pilih Jenis Pembayaran'; ?></option>															
									<option style="padding: 8px;" value="3"
										<?php if(isset($calculated)){ echo '3' === $calculated['type'] ? 'selected="selected"' : '';} ?>><?php echo $this->language_id=='107' ? 'Zakat for profession' : 'Zakat Profesi'; ?></option>	
									<option style="padding: 8px;" value="1"
										<?php if(isset($calculated)){ echo '1' === $calculated['type'] ? 'selected="selected"' : '';} ?>><?php echo $this->language_id=='107' ? 'Zakat for assets' : 'Zakat Harta'; ?></option>								
									<option style="padding: 8px;" value="4"
										<?php if(isset($calculated)){ echo '4' === $calculated['type'] ? 'selected="selected"' : '';} ?>><?php echo $this->language_id=='107' ? 'Zakat Al-Fitr' : 'Zakat Fitrah'; ?></option>
									<option style="padding: 8px;" value="7" <?php if(isset($calculated)){ echo '7' === $calculated['type'] ? 'selected="selected"' : '';} ?>>Infaq & Shadaqoh</option>
									<option style="padding: 8px;" value="13" <?php if(isset($calculated)){ echo '13' === $calculated['type'] ? 'selected="selected"' : '';} ?>><?php echo $this->language_id=='107' ? 'Fidyah / kafarat (punitive payment)' : 'Fidyah/Kafarat'; ?></option>
									<option style="padding: 8px;" value="14" <?php if(isset($calculated)){ echo '14' === $calculated['type'] ? 'selected="selected"' : '';} ?>>Qurban</option>
								</select>

							</p>
						</div>						
						<div class="col-md-12">
							<p class="form-row form-row-wide" id="jsetoran">
								<label for="jsetoran"><?php echo $this->language_id=='107' ? 'Amount of deposit' : 'Jumlah Setoran'; ?><span class="required">*</span>
								</label> <input class="input-text" name="setoran" id="jsetoran"
									type="text"
									value="<?php if(isset($calculated)) echo $calculated['value'];?>">
							</p>
						</div>
						<div class="col-md-12">
							<p class="form-row form-row-wide" id="mpayment">
								<label for="method"><?php echo $this->language_id=='107' ? 'Method of payment ' : 'Metode Pembayaran'; ?><span class="required">*</span>
								</label> <select name="metode">
									<option style="padding: 8px;" value="0"><?php echo $this->language_id=='107' ? 'Choose method of payment' : 'Pilih Metode Pembayaran'; ?></option>
									<?php if($inquery){?>
									<?php $list = new SimpleXMLElement($inquery);?>
									<?php 
										foreach ($list->payment_channel as $channel) {
echo "<option style='padding: 8px;' value='".$channel->pg_code."'>".$channel->pg_name."</option>";
//if( $channel->pg_code=='402') echo "<option style='padding: 8px;' value='".$channel->pg_code."'>Permata VA & PermataNet</option>";
//if( $channel->pg_code=='406') echo "<option style='padding: 8px;' value='".$channel->pg_code."'>Mandiri Clickpay</option>";
//if( $channel->pg_code=='700') echo "<option style='padding: 8px;' value='".$channel->pg_code."'>CIMB Clicks</option>";
										?>
										
										<?php 
										}
									?>									
									<?php }?>
									<option style="padding: 8px;" value="2" <?php if(isset($calculated)){ echo '2' === $calculated['method'] ? 'selected="selected"' : '';} ?>><?php echo $this->language_id=='107' ? 'Transfer to IZI Account' : 'Transfer ke Rekening IZI'; ?></option>
									<option style="padding: 8px;" value="3" <?php if(isset($calculated)){ echo '3' === $calculated['method'] ? 'selected="selected"' : '';} ?>><?php echo $this->language_id=='107' ? 'Donation fetching service' : 'Jemput Zakat / Donasi'; ?></option>
								</select>
							</p>
						</div>
						<div class="col-md-6">
							<p class="form-row form-row-wide" id="firstname">
								<label for="firstname"><?php echo $this->language_id=='107' ? 'Firstname' : 'Nama Depan'; ?><span class="required">*</span>
								</label> 
							<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input class="input-text" name="firstname" id="firstname"
									type="text" value="<?php echo $user->first_name;?>">
							<?php } else {?>
								<input class="input-text" name="firstname" id="firstname"
									type="text">
							<?php }?>
						</p>
						</div>
						<div class="col-md-6">
							<p class="form-row form-row-wide" id="lastname">
								<label for="lastname"><?php echo $this->language_id=='107' ? 'Lastname' : 'Nama Belakang'; ?><span class="required">*</span>
								</label> 
							<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input class="input-text" name="lastname" id="lastname"
									type="text" value="<?php echo $user->last_name;?>">
							<?php } else {?>
								<input class="input-text" name="lastname" id="lastname"
									type="text">
							<?php }?>
						</p>
						</div>
						<div class="col-md-12">
							<p class="form-row form-row-wide" id="email">
								<label for="email">Email<span class="required">*</span>
								</label> 
							<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input class="input-text" name="email" id="email" type="text"
									value="<?php echo $user->email;?>">
							<?php } else {?>
								<input class="input-text" name="email" id="email" type="text">
							<?php }?>
						</p>
							<p class="form-row form-row-wide" id="nokontak">
								<label for="nokontak"><?php echo $this->language_id=='107' ? 'Contact Number' : 'No Kontak'; ?><span class="required">*</span>
								</label> 
							<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
							<input class="input-text" name="nokontak" id="nokontak"
									type="text" value="<?php echo $user->contact;?>">
							<?php } else {?>
								<input class="input-text" name="nokontak" id="nokontak"
									type="text">
							<?php }?>
						</p>
							<p class="form-row form-row-wide">
								<label for="address"><?php echo $this->language_id=='107' ? 'Address' : 'Alamat'; ?> </label>							
								<?php if(isset($_SESSION['login']['profile']['user_id'])) {?>
								<textarea class="input-text" name="address" id="address"
									type="text"><?php echo $user->address;?></textarea>
							<?php } else {?>
								<textarea class="input-text" name="address" id="address"
									type="text"></textarea>
							<?php }?>
						</p>
							<div class="col-md-11"></div>
							<div class="col-md-1 pull-right" id="loading"></div>
						</div>

						<p class="form-row form-row-wide" style="padding-top: 20px;">
							<input class="button pull-right" value="Submit" name="login"
								type="submit" id="load">
						</p>

					</form>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</section>
<script type="text/javascript">
$('#load').on('click',function(){
    // Adding loading GIF
    $('#loading').html('<label><img id="loader" src="<?php echo base_url()?>assets/images/484.gif"/></label>');
 
});							
</script>
