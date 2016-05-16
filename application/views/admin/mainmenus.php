<?php
$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
?>
<aside id="sidebar" class="sidebar c-overflow">
	<div class="profile-menu">
		<a href="">
			<div class="profile-pic">
				<img src="<?php echo site_url("material/img/profile-pics/Profile-Icon.png"); ?>" alt="">
			</div>

			<div class="profile-info">
				<?php
				echo $_SESSION['user']['name'];
				?>
				<i class="zmdi zmdi-caret-down"></i>
			</div>
		</a>

		<ul class="main-menu">
			<?php
			/*
			<li>
				<a href="profile-about.html"><i class="zmdi zmdi-account"></i> View Profile</a>
			</li>
			<li>
				<a href=""><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
			</li>
			*/
			?>
			<li class="<?php if($controller=="admin"&&$method=="editprofile"){ echo "active"; } ?>">
				<a href="<?php echo site_url("admin/editprofile"); ?>"><i class="zmdi zmdi-settings"></i> Profile Settings</a>
			</li>
			<li>
				<a href="<?php echo site_url("admin/logout"); ?>"><i class="zmdi zmdi-time-restore"></i> Logout</a>
			</li>
		</ul>
	</div>
	<ul class="main-menu">
		<li class="<?php if($controller=="admin"&&$method="index"){ echo "active"; } ?>"><a href="<?php echo site_url("admin"); ?>"><i class="zmdi zmdi-home"></i> Home</a></li>
		<?php
		if($this->user_validation->validate("Admin_users", "index", false)){
			?>
			<li class="<?php if($controller=="Admin_users"){ echo "active"; } ?>"><a href="<?php echo site_url("Admin_users"); ?>"><i class="zmdi zmdi-accounts"></i>Manage Users</a></li>
			<?php
		}
		if($this->user_validation->validate("Admin_user_permissions", "index", false)){
			?>
			<li class="<?php if($controller=="Admin_user_permissions"){ echo "active"; } ?>"><a href="<?php echo site_url("Admin_user_permissions"); ?>"><i class="zmdi zmdi-lock"></i> User Permissions</a></li>
			<?php
		}
		if($this->user_validation->validate("admin", "createcms", false)){
			?>
			<li class="<?php if($controller=="admin" && $method=="createcms"){ echo "active"; } ?>"><a href="<?php echo site_url("admin/createcms"); ?>"><i class="zmdi zmdi-storage"></i> Create CMS</a></li>
			<?php
		}
		if($this->user_validation->validate("Admin_teams", "index", false)){
			?>
			<li class="<?php if($controller=="Admin_teams"){ echo "active"; } ?>"><a href="<?php echo site_url("Admin_teams"); ?>"><i class="zmdi zmdi-flag"></i> Manage Teams</a></li>
			<?php
		}
		if($this->user_validation->validate("Admin_groups", "index", false)){
			?>
			<li class="<?php if($controller=="Admin_groups"){ echo "active"; } ?>"><a href="<?php echo site_url("Admin_groups"); ?>"><i class="zmdi zmdi-assignment"></i> Manage Groups</a></li>
			<?php
		}
		if($this->user_validation->validate("Admin_matches", "index", false)){
			?>
			<li class="<?php if($controller=="Admin_matches"){ echo "active"; } ?>"><a href="<?php echo site_url("Admin_matches"); ?>"><i class="zmdi zmdi-calendar-alt"></i> Manage Matches</a></li>
			<?php
		}
		
		/*
		<li class="sub-menu">
			<a href=""><i class="zmdi zmdi-view-compact"></i> Headers</a>

			<ul>
				<li><a href="textual-menu.html">Textual menu</a></li>
				<li><a href="image-logo.html">Image logo</a></li>
				<li><a href="top-mainmenu.html">Mainmenu on top</a></li>
			</ul>
		</li>
		<li><a href="typography.html"><i class="zmdi zmdi-format-underlined"></i> Typography</a></li>
		<li class="sub-menu active toggled">
			<a href=""><i class="zmdi zmdi-view-list"></i> Tables</a>

			<ul>
				<li><a href="tables.html">Normal Tables</a></li>
				<li><a class="active" href="data-tables.html">Data Tables</a></li>
			</ul>
		</li>
		*/
		?>
	</ul>
</aside>
