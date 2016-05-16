<?php
$controller = $this->router->class;
$method = $this->router->method;
?>
<ul class='menu'>
	<?php
	//if($this->user_validation->validate("users", "%", false)){
	if($this->user_validation->validate("admin_dashboard", "index", false)){
		?>
		<li <?php if($controller=="admin_dashboard"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_dashboard");?>"'>
			<a href='<?php echo site_url("admin_dashboard");?>'>Dashboard</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_site_users", "index", false)){
		?>
		<li <?php if($controller=="admin_site_users"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_site_users");?>"'>
			<a href='<?php echo site_url("admin_site_users");?>'>Site Users</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_logged_in_users", "index", false)){
		?>
		<li <?php if($controller=="admin_logged_in_users"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_logged_in_users");?>"'>
			<a href='<?php echo site_url("admin_logged_in_users");?>'>Currently Logged In Users</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_startups", "index", false)){
		?>
		<li <?php if($controller=="admin_startups"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_startups");?>"'>
			<a href='<?php echo site_url("admin_startups");?>'>Startups / Investors</a>
		</li>
		<?php
	}
	/*
	if($this->user_validation->validate("admin_badges", "index", false)){
		?>
		<li <?php if($controller=="admin_badges"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_badges");?>"'>
			<a href='<?php echo site_url("admin_badges");?>'>Badges</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_siteusers_badges", "index", false)){
		?>
		<li <?php if($controller=="admin_siteusers_badges"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_siteusers_badges");?>"'>
			<a href='<?php echo site_url("admin_siteusers_badges");?>'>Assign User Badges</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_startups_badges", "index", false)){
		?>
		<li <?php if($controller=="admin_startups_badges"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_startups_badges");?>"'>
			<a href='<?php echo site_url("admin_startups_badges");?>'>Assign Startups / Investors Badges</a>
		</li>
		<?php
	}
	*/
	if($this->user_validation->validate("admin_startup_claims", "index", false)){
		?>
		<li <?php if($controller=="admin_startup_claims"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_startup_claims");?>"'>
			<a href='<?php echo site_url("admin_startup_claims");?>'>Startup / Investor Profile Claims</a>
		</li>
		<?php
	}
	
	/*
	if($this->user_validation->validate("admin_import_startup", "index", false)){
		?>
		<li <?php if($controller=="admin_import_startup"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_import_startup");?>"'>
			<a href='<?php echo site_url("admin_import_startup");?>'>Import Startups</a>
		</li>
		<?php
	}
	*/
	if($this->user_validation->validate("admin_jobs", "index", false)){
		?>
		<li <?php if($controller=="admin_jobs"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_jobs");?>"'>
			<a href='<?php echo site_url("admin_jobs");?>'>Manage Jobs</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_events", "index", false)){
		?>
		<li <?php if($controller=="admin_events"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_events");?>"'>
			<a href='<?php echo site_url("admin_events");?>'>Manage Events</a>
		</li>
		<?php
	}
	/*
	if($this->user_validation->validate("admin_events_temp", "index", false)){
		?>
		<li <?php if($controller=="admin_events_temp"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_events_temp");?>"'>
			<a href='<?php echo site_url("admin_events_temp");?>'>Manage e27 Events Import</a>
		</li>
		<?php
	}
	*/
	if($this->user_validation->validate("admin_deals", "index", false)){
		?>
		<li <?php if($controller=="admin_deals"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_deals");?>"'>
			<a href='<?php echo site_url("admin_deals");?>'>Manage&nbsp;Deals</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_site_user_comments", "index", false)){
		?>
		<li <?php if($controller=="admin_site_user_comments"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_site_user_comments");?>"'>
			<a href='<?php echo site_url("admin_site_user_comments");?>'>Site&nbsp;Comments</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_echelon", "index", false)){
		?>
		<li <?php if($controller=="admin_echelon"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_echelon");?>"'>
			<a href='<?php echo site_url("admin_echelon");?>'>Echelon&nbsp;CMS</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("admin_points", "index", false)){
		?>
		<li <?php if($controller=="admin_points"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin_points");?>"'>
			<a href='<?php echo site_url("admin_points");?>'>Points</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("users", "index", false)){
		?>
		<li <?php if($controller=="users"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("users");?>"'>
			<a href='<?php echo site_url("users");?>'>Users</a>
		</li>
		<?php
	}
	if($this->user_validation->validate("user_permissions", "index", false)){
		?>
		<li <?php if($controller=="user_permissions"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("user_permissions");?>"'>
			<a href='<?php echo site_url("user_permissions");?>'>Permissions</a>
		</li>
		<?php
	}
 	if($this->user_validation->validate("admin", "createcms", false)){
		?>
		<li <?php if($controller=="admin"&&$method=="createcms"){ echo "class='selected'"; } ?> onclick='self.location="<?php echo site_url("admin/createcms");?>"'>
			<a href='<?php echo site_url("admin/createcms");?>'>Create CMS</a>
		</li>
		<?php
	}
	?>
</ul>