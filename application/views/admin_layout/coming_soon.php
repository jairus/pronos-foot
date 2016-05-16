
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8"/>
		<title>e27</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('html/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('html/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('html/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('html/theme/assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL STYLES -->
		<link href="<?php echo site_url('html/theme/assets/global/plugins/select2/select2.css');?>" rel="stylesheet" type="text/css"/>
		<link href="<?php echo site_url('html/theme/assets/admin/pages/css/login.css');?>" rel="stylesheet" type="text/css"/>
		<!-- END PAGE LEVEL SCRIPTS -->
		<!-- BEGIN THEME STYLES -->
		<link href="<?php echo site_url('html/theme/assets/global/css/components.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('html/theme/assets/global/css/plugins.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('html/theme/assets/admin/layout3/css/layout.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo site_url('html/theme/assets/admin/layout3/css/themes/default.css');?>" rel="stylesheet" type="text/css" id="style_color">
		<link href="<?php echo site_url('html/theme/assets/admin/layout3/css/custom.css');?>" rel="stylesheet" type="text/css">
		<!-- END THEME STYLES -->
		<link rel="shortcut icon" href="favicon.ico"/>
	</head>
	<!-- BEGIN BODY -->
	<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
	<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
	<body class="login">
		<!-- BEGIN LOGO -->

		<!-- END LOGO -->
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="menu-toggler sidebar-toggler">
		</div>
		<!-- END SIDEBAR TOGGLER BUTTON -->


		<div class="container text-center" style="margin-top:120px">
			<h1 class="" style="margin-bottom:100px">What you just clicked on is under development.<br> Come back again soon!</h1>
			<i class="fa fa-gears" style="font-size:150px"></i>
		</div>
		<div class="logo">
			<a href="/" >
				<img src="<?php echo site_url('html/theme/assets/admin/layout3/img/logo-hub.png');?>" style="width:164px; height:44px" alt=""/>
			</a>
		</div>

		<!-- END COPYRIGHT -->
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<!-- BEGIN CORE PLUGINS -->
		<!--[if lt IE 9]>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/respond.min.js');?>"></script>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/excanvas.min.js');?>"></script>
		<![endif]-->
		<script src="<?php echo site_url('html/theme/assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/jquery-migrate.min.js');?>" type="text/javascript"></script>
		<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
		<script src="<?php echo site_url('html/theme/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/jquery.blockui.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/jquery.cokie.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/global/plugins/uniform/jquery.uniform.min.js');?>" type="text/javascript"></script>
		<!-- END CORE PLUGINS -->
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="<?php echo site_url('html/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js');?>" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo site_url('html/theme/assets/global/plugins/select2/select2.min.js');?>"></script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?php echo site_url('html/theme/assets/global/scripts/metronic.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/admin/layout3/scripts/layout.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/admin/layout3/scripts/demo.js');?>" type="text/javascript"></script>
		<script src="<?php echo site_url('html/theme/assets/admin/pages/scripts/login.js');?>" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->
		<script>
			jQuery(document).ready(function() {
				Metronic.init(); // init metronic core components
				Layout.init(); // init current layout
				Demo.init(); // init demo features
				Login.init();
			});
		</script>
		<!-- END JAVASCRIPTS -->
	</body>
	<!-- END BODY -->
</html>