
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
						<ul class="breadcrumbs fixclear">
							<li><a href="<?php echo base_url().'register';?>">Register</a></li>			
						</ul>
						<span id="current-date" class="subheader-currentdate"><?php echo date('M d Y');?></span>
						<div class="clearfix"></div>
					</div>
					<div class="col-sm-6">
						<div class="subheader-titles">
						</div>
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
 	width: 100%; 
	margin-bottom: 8px;
	border: 1px solid #d8d8d8;
	padding: 7px 10px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
	border-radius: 3px;
}

textarea {
	border: 1px solid #d8d8d8;
	height: auto;
	min-height: 30px;
	padding: 7px 10px;
	box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);
	border-radius: 3px;
}

input[type="submit"]{
	background: #a2ca2b; 
	font-family: open sans;
	width:100%; 
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

input[type="submit"]:hover{
	background-color: #769B08; 
}
-->
</style>
<section id="content" class="hg_section ptop-60">
	<div class="container" id="regis">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="right_sidebar col-md-6">
				<div class="kl-store">
					<form id="register-form" method="post" class="login" enctype="multipart/form-data"
						action="<?php echo base_url()?>authentication/signup">
						<div class="col-md-12"><p id="other"></p></div>
						<div class="col-md-6">
						<p class="form-row form-row-wide" id="firstname">
							<label for="firstname">Nama Depan<span class="required">*</span>
							</label> <input class="input-text" name="firstname" id="firstname"
								type="text">
						</p>
						</div>
						<div class="col-md-6">
						<p class="form-row form-row-wide" id="lastname">
							<label for="lastname">Nama Belakang<span class="required">*</span>
							</label> <input class="input-text" name="lastname" id="lastname"
								type="text">
						</p>
						</div>
						<div class="col-md-12">
						<p class="form-row form-row-wide" id="email">
							<label for="email">Email<span class="required">*</span>
							</label> <input class="input-text" name="email" id="email"
								type="text">
						</p>
						<p class="form-row form-row-wide">
							<label for="nokontak">No Kontak
							</label> <input class="input-text" name="nokontak" id="nokontak"
								type="text">
						</p>
						<p class="form-row form-row-wide">
							<label for="address">Alamat </label>
							<textarea class="input-text" name="address" id="address"
								type="text"></textarea>
						</p>
						<p class="form-row form-row-wide">
							<label for="branch">Propinsi (donatur)<span
								class="required">*</span>
							</label> <select name="cabang" style="border: 1px solid #d8d8d8;background:#fff;padding-left:4px;width: 100%;height:38px;box-shadow: inset 2px 2px 0 0 rgba(0, 0, 0, .05);">
								<?php
									if($cabang){
										foreach ($cabang as $branch)
										{
											?>
											<option style="padding: 8px;" value="<?php echo $branch->cabang_id;?>"><?php echo $branch->name;?></option>
											<?php 
										}
									} 
								?>
							</select>
						</p>
						<p class="form-row form-row-wide" id="username">
							<label for="username">Username<span class="required">*</span>
							</label> <input class="input-text" name="username" id="username"
								type="text">
						</p>
						</div>
						<div class="col-md-6">
						<p class="form-row form-row-wide" id="password">
							<label for="password">Password <span class="required">*</span>
							</label> <input class="input-text" name="password" id="password"
								type="password">
						</p>
						</div>
						<div class="col-md-6">
						<p class="form-row form-row-wide">
							<label for="passconf">Re-enter password <span class="required">*</span>
							</label> <input class="input-text" name="passconf" id="passconf"
								type="password">
						</p>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-10">
						<p class="form-row form-row-wide" style="padding-top: 20px;">
							<input name="login" value="Daftar" type="submit" id="load">							
						</p>
						</div>
						<div class="col-md-1">
							<p style="padding-top: 9px;">
							<div id="loading"></div>
							</p>
						</div>
						<p class="form-row form-row-wide"></p>
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
