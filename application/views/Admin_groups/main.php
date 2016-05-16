<?php
$method = $this->router->fetch_method();
?>
<style>
.sortby{
	cursor:pointer;
}
</style>
<div class="block-header">
	<h2>Manage Groups</h2>
	<ul class="actions">
		<li>
			<a href="<?php echo site_url($controller); ?>/add">
				<i class="zmdi zmdi-plus-circle-o"></i>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url($controller."/".$method); if($_SERVER['QUERY_STRING']){ echo "?".rawurldecode($_SERVER['QUERY_STRING']); } ?>">
				<i class="zmdi zmdi-refresh"></i>
			</a>
		</li>
	</ul>
</div>
<div class="card">
	<div class="card-header">
		<h2>Search rows <small>&nbsp;</small></h2>
		<form action="<?php echo site_url(); ?><?php echo $controller; ?>/search" class='row'>
			<input type="hidden" name="sortby" value="<?php echo htmlentitiesX($sortby); ?>">
			<input type="hidden" name="sort" value="<?php echo htmlentitiesX($sort); ?>">
			<div class="col-sm-3 p-b-10">
					<div>Search Query:</div>
					<input type="text" class="form-control input-sm" placeholder="" name="search" value="<?php echo htmlentitiesX($_GET['search']); ?>" >
			</div>
			<div class="col-sm-3 p-b-10">
				<div class="form-group fg-line">
					<div>Filter:</div>
					<?php
					if(isset($filters)&&is_array($filters)){
						?> 
						<select class="selectpicker" multiple name="filters[]">
							<option value="name" <?php if(in_array("name", $filters)){ echo "selected"; } ?>>Group Name</option>	
						</select>
						<?php
					}
					else{
						?>
						<select class="selectpicker" multiple name="filters[]">
							<option value="name">Group Name</option>	
						</select>
						<?php
					}
					?>
				</div>
			</div>
			<div class="col-sm-6 p-b-10">
				<button type="submit" class="btn btn-primary btn-sm m-t-5 waves-effect"><i class="zmdi zmdi-search"></i> Search</button>
			</div>
		</form>
	</div>
	
	<div class="table-responsive">
		<?php
		$t = count($records);
		?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th class="sortby" data-sortby="name" >Group Name <?php
	if($sortby=="name"){
		if($sort=="asc"){
			echo '&nbsp;<i class="zmdi zmdi-caret-up"></i>';
		}
		else{
			echo '&nbsp;<i class="zmdi zmdi-caret-down"></i>';
		}
	}
?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($t){
					for($i=0; $i<$t; $i++){
						if($i%2==0){
							echo "<tr style='background:#fafafa' id='tr".$records[$i]['id']."'>";
						}
						else{
							echo "<tr id='tr".$records[$i]['id']."'>";
						}
						?>
							<td><?php echo $start+$i+1; ?></td>
							<td><?php echo $records[$i]['name'];?></td>
							<td class="text-left">
							<a href="<?php echo site_url(); ?><?php echo $controller; ?>/edit/<?php echo $records[$i]['id']?>" class="btn btn-icon command-edit waves-effect waves-circle bgm-green"><span class="zmdi zmdi-edit"></span></a>
							<a type="button" class="btn btn-icon command-delete waves-effect waves-circle bgm-red" data-row-id="<?php echo $records[$i]['id']?>"><span class="zmdi zmdi-delete"></span></a>
							</td>
						</tr>
						<?php
					}
					if($pages>0){
						?>
						<tr>
							<td colspan="50" class='text-right font12' >
								There is a total of <?php echo $cnt; ?> <?php if($cnt>1) { echo "records"; } else{ echo "record"; }?> in the database. 
								Go to Page:
								<?php
								if($search){
									?>
									<select onchange='self.location="?search=<?php echo sanitizeX($search); ?>&filter=<?php echo sanitizeX($filter); ?>&start="+this.value'>
									<?php

								}
								else{
									?>
									<select onchange='self.location="?start="+this.value'>
									<?php
								}
								for($i=0; $i<$pages; $i++){
									if(($i*$limit)==$start){
										?><option value="<?php echo $i*$limit?>" selected="selected"><?php echo $i+1; ?></option><?php
									}
									else{
										?><option value="<?php echo $i*$limit?>"><?php echo $i+1; ?></option><?php
									}
								}
								?>
								</select>
							</td>
						</tr>
						<?php
					}
				}
				else{
					?>
					<tr>
						<td colspan="50" class='text-center font12 p-25' >0 Records</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<script>
$('.sortby').click(function(){
	var sortby = $(this).attr("data-sortby");
	var sort = "<?php 
	if($sortby){
		if($sort=="asc"){
			echo "desc";
		}
		else{
			echo "asc";
		}
	}
	else{
		echo "asc";
	}
	?>";
	qs = "<?php 
	$qs = rawurldecode($_SERVER['QUERY_STRING']);
	$qs = preg_replace("/&sortby=[^&]*/i", "", $qs);
	$qs = preg_replace("/&sort=[^&]*/i", "", $qs);
	$qs = preg_replace("/sortby=[^&]*/i", "", $qs);
	$qs = preg_replace("/sort=[^&]*/i", "", $qs);
	
	echo trim($qs, "&");
	?>";
	if(qs){
		qs = "?sortby="+sortby+"&sort="+sort+"&"+qs;
	}
	else{
		qs = "?sortby="+sortby+"&sort="+sort;
	}
	
	url = "<?php echo site_url($controller."/".$method); ?>"+qs;
	//alert(url);
	self.location = url;
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
				$("#tr"+co_id).fadeOut(200);
			}
		});
	});
});
</script>