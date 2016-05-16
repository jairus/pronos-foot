<form id="login_form" action="<?php echo site_url("admin/login"); ?>" method="post">
	<div class='text-center m-t-25'>
		<div class="lc-block m-0" id="l-login">
			<?php
			if($_GET['error']){
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo $_GET['error']; ?>
				</div>
				<?php
			}
			?>
			<div class="input-group m-b-20">
				<span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
				<div class="fg-line">
					<input type="text" class="form-control" name="login_email" value="<?php echo htmlentitiesX($_GET['login_email']); ?>" placeholder="Username">
				</div>
			</div>
			
			<div class="input-group m-b-20">
				<span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
				<div class="fg-line">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
			</div>
			
			<div class="clearfix"></div>
			
			<div class="checkbox hidden">
				<label>
					<input type="checkbox" name="keep" value="">
					<i class="input-helper"></i>
					Keep me signed in
				</label>
			</div>
			<a href="" onclick="$('#login_form').submit(); return false;" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></a>
		</div>
	</div>
</form>
<script>
$(function(){
	//notify("top", "center", "fa fa-comments", "Hello World", "", "danger");
	$("input").keypress(function(ev) {
		var keycode = (ev.keyCode ? ev.keyCode : ev.which);
		if(keycode == 13) {
			$("#login_form").submit();
		}
	});
});
</script>