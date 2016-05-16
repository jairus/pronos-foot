<div class="block-header">
	<?php
	if($record['id']){
		?>
		<h2>EDIT USER</h2>
		<?php
	}
	else{
		?>
		<h2>ADD USER</h2>
		<?php
	}
	?>
	<ul class="actions">
		<li>
			<a href="<?php echo site_url($controller); ?>">
				<i class="zmdi zmdi-arrow-left"></i>
			</a>
		</li>
	</ul>
</div>
<div class="card">
	<div class="card">		
		<div class="card-body card-padding">
			<iframe name="hiframe" name="hiframe" class="hidden" style="height:300px; width:500px;"></iframe>
			<?php
			if($record['id']){
				?>
				<form role="form" method="post" action="<?php echo site_url($controller); ?>/ajax_edit" target="hiframe" id="fr<?php echo $record['id']; ?>" enctype='multipart/form-data'>
				<input type="hidden" name="id" value="<?php echo htmlentitiesX($record['id']); ?>">
				<?php
			}
			else{
				?><form role="form" method="post" action="<?php echo site_url($controller); ?>/ajax_add" target="hiframe"><?php
			}
			?>
				<div class="row">
					<div class="col-md-8">
					<?php
					if($record['id']){
						?>
						<div class="form-group fg-line">
							<label>* Login Name</label>
							<input type="text" class="form-control input-sm" name="email" value="<?php echo htmlentitiesX($record['email']); ?>" disabled>
						</div>
						<?php
					}
					else{
						?>
						<div class="form-group fg-line">
							<label>* Login Name</label>
							<input type="text" class="form-control input-sm" name="email" value="<?php echo htmlentitiesX($record['email']); ?>">
						</div>
						<?php
					}
					?>
					<div class="form-group fg-line">
						<label>* Name</label>
						<input type="text" class="form-control input-sm" name="name" value="<?php echo htmlentitiesX($record['name']); ?>">
					</div>
					<div class="form-group fg-line">
						<label>Password <?php if($record['id']){ ?>(Enter a value to change) <?php } ?></label>
						<input type="text" class="form-control input-sm" name="password" placeholder="Password" value="">
					</div>
					<?php
					if($record['id']){
						?>
						<div class="form-group fg-line">
							<p class="f-500 m-b-10">Dateadded</p>	
							<div class="input-group form-group">	
								<span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
								<div class="dtp-container fg-line">
									<input type='text' name="dateadded" class="form-control date-time-picker" placeholder="Click here..." value="<?php 
									if($record['dateadded']){
										echo date("m/d/Y h:i A", strtotime($record['dateadded'])); 
									}
									?>">
								</div>
							</div>
						</div>
						<?php
					}
					?>
					</div>
					<div class="col-md-4">
						<div class="form-group fg-line">
							<?php
							$sql = "select * from `user_permissions` where `deleted`<>1";
							$r = $this->db->query($sql)->result_array();
							$t = count($r);
							for($i=0; $i<$t; $i++){
								?>
								<div class="checkbox">
									<label>
										<?php
										if(is_array($record['user_groups'])&&in_array($r[$i]['user_group'],$record['user_groups'])){
											?>
											<input type="checkbox" name="user_groups[]" value="<?php echo htmlentitiesX($r[$i]['user_group']); ?>" checked>
											<?php
										}
										else{
											?>
											<input type="checkbox" name="user_groups[]" value="<?php echo htmlentitiesX($r[$i]['user_group']); ?>">
											<?php
										}
										?>
										<i class="input-helper"></i>
										<?php
										echo $r[$i]['user_group'];
										?>
									</label>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<div class="col-md-12">
					<button type="submit" class="btn btn-primary btn-sm m-t-10 bgm-green">Save</button>
					<?php
					if($record['id']){
						?>
						<button type="button" data-row-id="<?php echo htmlentitiesX($record['id']); ?>" class="command-delete btn btn-primary btn-sm m-t-10 bgm-red pull-right">Delete</button>
						<?php
					}
					?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
setInterval(function(){
	$(".imagethumb").each(function(){
		var img = $(this).find("img");
		imgsrc = img.attr("src");
		var imagefileurl = $(this).parent().find(".imagefileurl");
		imagefileurl = imagefileurl.attr("data-src");
		if(imagefileurl!=imgsrc){
			$(".fileinput-exists").show();
			$(".fileinput-new").hide();
		}
	});
}, 10)
$(".imageuploadcancel").click(function(){
	//$(this).hide();
	var change = $(this).parent().parent().find(".fileinput-exists");
	change.hide();
	var select = $(this).parent().parent().find(".fileinput-new");
	select.show();
	var imagefileurl = $(this).parent().parent().find(".imagefileurl");
	var fileinput_preview = $(this).parent().parent().find(".fileinput-preview");
	imagefileurl = imagefileurl.attr("data-src");
	fileinput_preview.html("<img src='"+imagefileurl+"'>");
	
	var theimagefile = $(this).parent().parent().find(".theimagefile");
	theimagefile.val("");
	return false;
});
$('.command-delete').click(function(){
	var co_id = $(this).attr("data-row-id");
	swal({   
		title: "Are you sure?",   
		text: "You will not be able to recover this record once deleted!",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Yes, delete it!",   
		closeOnConfirm: false 
	}, function(){
		swal("Deleted!", "The record was successfully deleted", "success"); 
		formdata = "id="+co_id;
		jQuery.ajax({
			url: "<?php echo site_url(); echo $controller ?>/ajax_delete/"+co_id,
			type: "POST",
			data: formdata,
			success: function(){
				swal({
					title: "Success!",   
					text: "The record was successfully deleted",   
					timer: 2000,
					type: "success",
					showConfirmButton: true 
				});
				$("#fr"+co_id).fadeOut(200);
				setTimeout(function(){self.location="<?php echo site_url($controller); ?>";}, 2000);
			}
		});
	});
});
</script>
