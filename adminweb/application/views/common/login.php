<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<title><?php echo $this->site_title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN CORE CSS FRAMEWORK -->
	<link href="<?php echo base_url(); ?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet" type="text/css" />
	<!-- END CORE CSS FRAMEWORK -->
	<!-- BEGIN CSS TEMPLATE -->
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
	<!-- END CSS TEMPLATE -->
	<style type="text/css">
	.error {
		font-style: italic;
	}
	.captcha-image {
		display: block;
		float: left;
		width: 100%;
		border: 1px solid #e1e1e1;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
	}
	.change-image {
		display: block;
		float: left;
		width: 100%;
		height: 14px;
		color: #252525;
		margin: 0 0 10px 0;
		cursor: pointer;
	}
	input.captcha-form {
		clear: both;
		display: block;
		float: left;
		width: 100%;
		padding: 5px 10px !important;
		margin: 0;
		height: 32px;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
	}
	</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="error-body no-top pace-done">
	<div class="pace pace-inactive">
		<div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
			<div class="pace-progress-inner">
			</div>
		</div>
		<div class="pace-activity">
		</div>
	</div>
	<div class="error-wrapper">
		<div class="error-container">
			<div class="error-main">
				<div class="span4">
					<form action="<?php echo base_url(); ?>authenticate/login" method="post">
						<div class="grid simple">
							<div class="grid-title no-border">
								<h3>Administrator Login</h3>
							</div>
							<div class="grid-body no-border">
								<?php if (isset($_SESSION['message']['login']) && $_SESSION['message']['login']) { ?>
								<div class="row-fluid">
									<span class="error span12"><?php echo $_SESSION['message']['login']['message']; ?></span>
								</div>
								<?php unset($_SESSION['message']['login']); ?>
								<?php } ?>
								<div class="row-fluid">
									<div class="row-fluid">
										<div class="input-append span12 primary relative">
											<input type="text" name="username" id="appendedInput" class="span12" placeholder="Username">
											<span class="add-on"><span class="arrow"></span><i class="icon-align-justify"></i>
											</span>
										</div>
									</div>
									<div class="row-fluid">
										<div class="input-append span12 primary relative">
											<input type="password" name="password" id="appendedInput2" class="span12" placeholder="Password">
											<span class="add-on"><span class="arrow"></span><i class="icon-lock"></i>
											</span>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span6">
											<img src="<?php echo base_url(); ?>captcha/login" class="captcha-image" id="captcha-image" />
											<a data-src="<?php echo base_url(); ?>captcha/login" class="change-image" id="change-image">Change text</a>
											</span>
										</div>
										<div class="span6">
											<input type="text" name="captcha" class="captcha-form" id="captcha-form" placeholder="Type the Image Here" />
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions form-login">
							<div class="pull-right">
								<button type="submit" class="btn btn-primary btn-cons">Masuk</button>
								<button type="button" class="btn btn-white btn-cons">Batal</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="push">
		</div>
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN CORE JS FRAMEWORK-->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>
	<!-- BEGIN CORE TEMPLATE JS -->
	<!-- END CORE TEMPLATE JS -->
	<script type="text/javascript">
	$(document).ready(function(){
		$('.change-image').live('click',function(){
			$(this).prev('.captcha-image').attr('src',($(this).data('src') + '?' + Math.random()));
			$(this).next('.captcha-form').focus();
		});
	});
	</script>
</body>
</html>
