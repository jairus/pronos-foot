<header id="header" class="clearfix" data-current-skin="darkgray">
	<ul class="header-inner">
		<li id="menu-trigger" data-trigger="#sidebar">
			<div class="line-wrap">
				<div class="line top"></div>
				<div class="line center"></div>
				<div class="line bottom"></div>
			</div>
		</li>
		<li class="logo">
			<img style="max-height:30px;" src="<?php echo base_url();?>assets/images/Logo.png">
		</li>
		<li class="logo hidden-xs">
			<a href="<?php echo site_url("admin"); ?>">PRONOS FOOT ADMIN SYSTEM</a>
		</li>
		<?php
		$this->load->view("admin/topmenus");
		?>
	</ul>
	<!-- Top Search Content -->
	<div id="top-search-wrap">
		<div class="tsw-inner">
			<i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
			<input type="text">
		</div>
	</div>
</header>