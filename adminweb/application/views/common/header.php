<!DOCTYPE html>
<!-- BEGIN HEAD -->
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<title><?php echo $this->site_title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<meta name="menu" content="<?php echo isset($menu) ? $menu : "dashboard-menu"; ?>" />
	<meta name="id" content="<?php echo isset($current_page->page_id) ? $current_page->page_id : "0"; ?>" />
	<script type="text/javascript">
	var menu = '.<?php echo isset($menu) ? $menu : "dashboard-menu"; ?>';
	var level_name = '<?php echo isset($this->level_name) ? strtolower($this->level_name) : ""; ?>';
	var is_super = '<?php echo isset($this->is_super) ? strtolower($this->is_super) : ""; ?>';

	function base_url() {
		return '<?php echo base_url(); ?>';
	}
	function site_url() {
		return '<?php echo $this->dir; ?>';
	}
	</script>
	<!-- BEGIN PLUGIN CSS -->
	<!-- CALENDAR -->
	<link href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- THEME FLASH -->
	<link href="<?php echo base_url(); ?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- GRITTER -->
	<link href="<?php echo base_url(); ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<!-- DATEPICKER -->
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
	<!-- SIDR -->
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- SELECT -->
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- CHECKBOX -->
	<link href="<?php echo base_url(); ?>assets/plugins/boostrap-checkbox/css/bootstrap-checkbox.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- NESTABLE -->
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- NICEINPUT -->
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-nicefileinput/jquery.nicefileinput.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- WYSIWYG REDACTOR -->
	<link href="<?php echo base_url(); ?>assets/plugins/redactor/redactor.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- DATATABLES -->
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- SUPERBOX -->
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-superbox/css/style.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- TAGSINPUT -->
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
	<!-- IOS SWITCH -->
	<link href="<?php echo base_url(); ?>assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8" />
	<!-- FLAGS -->
	<link href="<?php echo base_url(); ?>assets/plugins/flags/flags.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8" />
	<!-- SLIDER -->
	<link href="<?php echo base_url(); ?>assets/plugins/boostrap-slider/css/slider.css" rel="stylesheet" type="text/css" />
	<!-- END PLUGIN CSS -->
	<!-- BEGIN CORE CSS FRAMEWORK -->
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet" type="text/css" />
	<!-- END CORE CSS FRAMEWORK -->
	<!-- BEGIN CSS TEMPLATE -->
	<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
	<!-- END CSS TEMPLATE -->
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="">
	<!-- BEGIN HEADER -->
	<div class="header navbar navbar-inverse">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<div class="header-seperation">
				<ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
					<li class="dropdown">
						<a id="main-menu-toggle" href="#main-menu" class="">
							<div class="iconset top-menu-toggle-white"></div>
						</a>
					</li>
				</ul>
				<!-- BEGIN LOGO -->
				<a href="<?php echo base_url(); ?>">
					<img src="<?php echo base_url(); ?>assets/img/izi-logo.svg" class="logo pull-left"  data-src="<?php echo base_url(); ?>assets/img/izi-logo.svg" data-src-retina="<?php echo base_url(); ?>assets/img/izi-logo.svg" width="86" />
				</a>
				<!-- END LOGO -->
				<ul class="nav pull-right notifcation-center">
				</ul>
			</div>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<div class="header-quick-nav">
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="pull-left">
					<!--
					<ul class="nav quick-section">
						<li class="quicklinks">
							<a href="#" class="" id="layout-condensed-toggle">
								<div class="iconset top-menu-toggle-dark"></div>
							</a>
						</li>
					</ul>
					-->
					<ul class="nav quick-section">
						<li class="quicklinks">
							<a href="#" class="">
								<div class="iconset top-reload"></div>
							</a>
						</li>
						<!--
						<li class="quicklinks">
							<span class="h-seperate"></span>
						</li>
						<li class="quicklinks">
							<a href="#" class="" >
								<div class="iconset top-tiles"></div>
							</a>
						</li>
						-->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
				<!-- BEGIN CHAT TOGGLER -->
				<div class="pull-right">
					<ul class="nav quick-section">
						<li class="quicklinks">
							<a data-toggle="dropdown" class="dropdown-toggle pull-right" href="#">
							<div class="iconset top-settings-dark" title="My Account">
							</div>
							</a>
							<ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="dropdownMenu">
								<!--
								<li>
									<a href="#"> My Account</a>
								</li>
								<li>
									<a href="#">My Calendar</a>
								</li>
								<li>
									<a href="#"> My Inbox</a>
								</li>
								-->
								<li>
									<a href="<?php echo base_url(); ?>user/user/edit/<?php echo $this->user_id; ?>">
									Edit Account</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo base_url(); ?>authenticate/logout"><i class="icon-off"></i>
									&nbsp;
									&nbsp;
									Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- END CHAT TOGGLER -->
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar not-mini" id="main-menu">
			<!-- BEGIN MINI-PROFILE -->
			<div class="user-info-wrapper">
				<!--
				<div class="profile-wrapper">
					<img src="<?php echo base_url(); ?>assets/img/profiles/avatar.jpg" data-src="<?php echo base_url(); ?>assets/img/profiles/avatar.jpg" data-src-retina="<?php echo base_url(); ?>assets/img/profiles/avatar2x.jpg" width="69" height="69" />
				</div>
				-->
				<div class="user-info">
					<div class="greeting">
						Welcome
					</div>
					<div class="username">
						<?php echo isset($this->full_name) ? $this->full_name : ''; ?><span class="semi-bold"></span>
					</div>
					<div class="status">
						Status
						<a href="#">
						<div class="status-icon green">
						</div>
						Online</a>
					</div>
				</div>
			</div>
			<!-- END MINI-PROFILE -->
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="top-menu">
				<li class="dashboard-menu">
					<a href="<?php echo base_url(); ?>" class="direct-link">
						<i class="icon-custom-home"></i>
						<span class="title">Dashboard</span>
					</a>
				</li>				
				<li class="module-menu">
					<a href="javascript:;">
						<i class="icon-folder-open"></i>
						<span class="title">Module</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url(); ?>module/slider">Slides</a></li>
						<li><a href="<?php echo base_url(); ?>module/nisab">Nisab</a></li>
						<?php if (isset($this->level_id) && $this->is_super) { ?>
						<li><a href="<?php echo base_url(); ?>module/donors">Donors</a></li>
						<li><a href="<?php echo base_url(); ?>module/donation">Donation</a></li>
						<li><a href="<?php echo base_url(); ?>module/confirm">Confirmation</a></li>
						<li><a href="<?php echo base_url(); ?>module/report">Donation Report</a></li>
						<?php } ?>
					</ul>
				</li>
				<li class="pages-menu">
					<a href="javascript:;">
						<i class="icon-custom-ui"></i>
						<span class="title">Pages</span>
						<span class="arrow"></span>
					</a>
					<div class="sub-menu">
						<?php if (isset($this->is_super) && $this->is_super) { ?>
						<div class="button-wrapper">
							<div class="btn-group btn-block">
								<a href="<?php echo base_url(); ?>pages/pages/add" class="direct-link btn btn-primary btn-small btn-block" data-toggle="dropdown">Add Page</a>
							</div>
						</div>
						<?php } ?>
						<h2>Main Menu</h2>
						<div class="dd-1" id="nestable-main"></div>
						<h2>Top Menu</h2>
						<div class="dd-1" id="nestable-top"></div>
						<div class="clearfix"></div>
					</div>
				</li>
				<?php if (isset($this->is_super) && $this->is_super) { ?>
				<li class="settings-menu">
					<a href="javascript:;">
						<i class="icon-gear"></i>
						<span class="title">Settings</span>
						<span class="arrow"></span>
					</a>
					<ul class="sub-menu" style="">
						<li><a href="<?php echo base_url(); ?>settings/settings-language">Language</a></li>
					</ul>
				</li>
				<li class="user-menu">
					<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">User</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?php echo base_url(); ?>user/user/level">User Level</a></li>
						<li><a href="<?php echo base_url(); ?>user/user">Manage User</a></li>
					</ul>
				</li>
				<?php } ?>
			</ul>
			<a href="#" class="scrollup">Scroll</a>
			<div class="clearfix"></div>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN SIDEBAR FOOTER -->
		<div class="footer-widget">
			<div class="pull-right">
				<a href="<?php echo base_url(); ?>authenticate/logout" title="Logout"><i class="icon-off"></i></a>
			</div>
		</div>
		<!-- END SIDEBAR FOOTER -->