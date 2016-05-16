<div class="block-header">
	<h2>Create CMS</h2>
</div>
<div class="card">
	<div class="card">		
			<?php
			if(!$_SESSION['createcmsfields']){
				?>
				<div class="card-body card-padding">
				<iframe name="hiframe" name="hiframe" class="hidden" style="width:500px; height: 300px;"></iframe>
				<form class="" role="form" method="post" action="<?php echo site_url("admin/createcms?fetchtable"); ?>" target="hiframe" id="fetchtable">
					<div class="form-group fg-line">
						<label>Table Name</label>
						<input type="text" class="form-control input-sm" placeholder="Table Name" name="tablename" value="">
					</div>
					<button type="submit" class="btn btn-primary btn-sm m-t-10">Next</button>
				</form>
				<?php
			}
			else{
				if($_GET['error']){
					$error = $_GET['error'];
				}
				?><div class="card-body"><?php
				$fields = $_SESSION['createcmsfields'];
				/*
				[0] => Array
					(
						[Field] => id
						[Type] => int(2)
						[Null] => NO
						[Key] => PRI
						[Default] => 
						[Extra] => auto_increment
					)
				*/
				$t = count($fields);
				$newcontroller = $_SESSION['createcmstable'];
				$x = 1;
				while(file_exists(dirname(__FILE__)."/../../controllers/".$newcontroller.".php")){
					$newcontroller = $_SESSION['createcmstable'].$x;
					$x++;
				}
				?>
				<form method="post" action="<?php echo site_url("admin/createcms"); ?>">
					<table class="table table-bordered">
						<?php
						if($error){
							?>
							<tr>
							<td colspan=50 class='text-center'>
								<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<?php echo $error; ?>
								</div>
							</td>
							</tr>
							<?php
						}
						?>
						<tr>
						<td colspan=50>
							<input type='hidden' class='form-control' name="table" value="<?php echo htmlentitiesX($_SESSION['createcmstable']) ?>" >
							<input type='text' class='form-control' placeholder="Controller / View Name" name="controller" value="<?php echo htmlentitiesX(ucfirst($newcontroller)) ?>" >
						</td>
						</tr>
						<?php
						$n = 0;
						for($i=0; $i<$t; $i++){
							if($fields[$i]["Field"]=="id"||$fields[$i]["Field"]=="deleted"){
								continue;
							}
							echo "<tr>";
							?>
							<td>
								<input type='text' class='form-control' name="fields_name[<?php echo $n; ?>]" value="<?php echo htmlentitiesX($fields[$i]["Field"]); ?>" >
							</td>
							<td>
								<input type='text' class='form-control' name="fields_label[<?php echo $n; ?>]" value="<?php echo htmlentitiesX(ucfirst($fields[$i]["Field"])); ?>" placeholder="Label" >
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="fields_main[<?php echo $n; ?>]" value="1">
										<i class="input-helper"></i>
										In Main
									</label>
								</div>
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="fields_edit[<?php echo $n; ?>]" value="1">
										<i class="input-helper"></i>
										In Edit
									</label>
								</div>
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="fields_required[<?php echo $n; ?>]" value="1">
										<i class="input-helper"></i>
										Required
									</label>
								</div>
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="fields_search[<?php echo $n; ?>]" value="1">
										<i class="input-helper"></i>
										In Search
									</label>
								</div>
							</td>
							<td>
								<select class="selectpicker" name="fields_type[<?php echo $n; ?>]">
								<option value="text">Text</option>
								<option value="textarea">Textarea</option>	
								<option value="wysywyg">WYSYWYG</option>	
								<option value="date">Date</option>	
								<option value="time">Time</option>
								<option value="datetime">Date / Time</option>	
								<option value="image">Image</option>
								<option value="file">File</option>
								</select>
							</td>
							<?php
							echo "</tr>";
							$n++;
						}
					?>
					<tr>
					<td colspan=50>
						<a href="<?php echo site_url("admin/createcms"); ?>?clear" class="btn btn-primary btn-sm m-t-10">Back</a>
						<button type="submit" class="btn btn-primary btn-sm m-t-10 pull-right">Create CMS</button>
					</td>
					</tr>
					</table>
				</form>
				<?php
			}
			?>
		</div>
	</div>
</div>