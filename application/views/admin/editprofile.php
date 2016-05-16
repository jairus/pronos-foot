<div class="block-header">
	<h2>Edit Profile</h2>
</div>
<?php
//pre($_SESSION['user']);
?>
<div class="card">
	<div class="card">		
		<div class="card-body card-padding">
			<iframe name="hiframe" name="hiframe" class="hidden"></iframe>
			<form role="form" method="post" action="<?php echo site_url("admin/editprofile"); ?>" target="hiframe">
				<input type="hidden" name="id" value="<?php echo htmlentitiesX($_SESSION['user']['id']); ?>">
				<div class="form-group fg-line">
					<label>Login</label>
					<input type="text" class="form-control input-sm" placeholder="Login" value="<?php echo htmlentitiesX($_SESSION['user']['email']); ?>" disabled>
				</div>
				<div class="form-group fg-line">
					<label>Name</label>
					<input type="name" class="form-control input-sm" placeholder="Name" name="name" value="<?php echo htmlentitiesX($_SESSION['user']['name']); ?>">
				</div>
				<div class="form-group fg-line">
					<label>New Password (leave blank if you don't want to change)</label>
					<input type="password" class="form-control input-sm" placeholder="Name" name="password">
				</div>
				<div class="form-group fg-line">
					<label>Confirm Password</label>
					<input type="password" class="form-control input-sm" placeholder="Name" name="confirmpassword">
				</div>
				<button type="submit" class="btn btn-primary btn-sm m-t-10">Save</button>
			</form>
		</div>
	</div>
</div>
