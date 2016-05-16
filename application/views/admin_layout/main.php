<?php
@session_start();
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin System</title>
		
	 <!-- Vendor CSS -->
	<link href="<?php echo site_url(); ?>material/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>material/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>material/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>material/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>material/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">     
	<link href="<?php echo site_url(); ?>material/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>material/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>material/vendors/summernote/dist/summernote.css" rel="stylesheet">
	<!-- CSS -->
	<link href="<?php echo site_url(); ?>material/css/app.min.1.css" rel="stylesheet">
	<link href="<?php echo site_url(); ?>material/css/app.min.2.css" rel="stylesheet">
	
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/jquery/dist/jquery.min.js"></script>
	<script>
	/*
	 * Notifications
	 */
	function notify(from, align, icon, title, message, type, animIn, animOut){
		$.growl({
			icon: icon,
			title: title,
			message: message,
			url: ''
		},{
				element: 'body',
				type: type,
				allow_dismiss: true,
				placement: {
						from: from,
						align: align
				},
				offset: {
					x: 20,
					y: 85
				},
				spacing: 10,
				z_index: 1031,
				delay: 2500,
				timer: 1000,
				url_target: '_blank',
				mouse_over: false,
				animate: {
						enter: animIn,
						exit: animOut
				},
				icon_type: 'class',
				template: '<div data-growl="container" class="alert" role="alert">' +
								'<button type="button" class="close" data-growl="dismiss">' +
									'<span aria-hidden="true">&times;</span>' +
									'<span class="sr-only">Close</span>' +
								'</button>' +
								'<span data-growl="icon"></span>' +
								'<span data-growl="title"></span>' +
								'<span data-growl="message"></span>' +
								'<a href="#" data-growl="url"></a>' +
							'</div>'
		});
	};
	</script>

</head>
<body>
	<?php
	if(!$user){
		$this->load->view("admin/login");
	}
	else{
		$this->load->view("admin/header");
		$this->load->view("admin/content");
	}
	?>    
       
	<footer id="footer">
		Page rendered in <strong>{elapsed_time}</strong> seconds
	</footer>

	<!-- Page Loader -->
	<div class="page-loader hidden">
		<div class="preloader pls-blue">
			<svg class="pl-circular" viewBox="25 25 50 50">
				<circle class="plc-path" cx="50" cy="50" r="20" />
			</svg>

			<p>Please wait...</p>
		</div>
	</div>
	
	<!-- Javascript Libraries -->
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/flot/jquery.flot.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/flot/jquery.flot.resize.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/sparklines/jquery.sparkline.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js "></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/Waves/dist/waves.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
	
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
	
	
	<!-- Placeholder for IE9 -->
	<!--[if IE 9 ]>
		<script src="<?php echo site_url(); ?>material/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
	<![endif]-->
	
	<script src="<?php echo site_url(); ?>material/js/flot-charts/curved-line-chart.js"></script>
	<script src="<?php echo site_url(); ?>material/js/flot-charts/line-chart.js"></script>
	<script src="<?php echo site_url(); ?>material/js/charts.js"></script>
	<script src="<?php echo site_url(); ?>material/js/charts.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/autosize/dist/autosize.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/fileinput/fileinput.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo site_url(); ?>material/vendors/summernote/dist/summernote-updated.min.js"></script>
	<script src="<?php echo site_url(); ?>material/js/functions.js"></script>
	<script>
	//Welcome Message (not for login page)
	function welcome(message, type){
		$.growl({
			message: message
		},{
			type: type,
			allow_dismiss: false,
			label: 'Cancel',
			className: 'btn-xs btn-inverse',
			placement: {
				from: 'top',
				align: 'right'
			},
			delay: 2500,
			animate: {
					enter: 'animated fadeIn',
					exit: 'animated fadeOut'
			},
			offset: {
				x: 20,
				y: 85
			}
		});
	};
	//welcome('Welcome back Mallinda Hollaway', 'inverse');
	</script>
</body>
</html>
