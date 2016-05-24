	<?php
	//pre($matches);
	//exit();
	
	?>
<div class="w-container grille-container">
  <p class="grille-title1">EURO 2016 Calendrier | Phase de Groupes</p>
  <div class="div-games-info">
	<?php
	$t = count($matches);
	for($i=0; $i<$t; $i++){
		$team1 = $this->matches_model->getTeamById($matches[$i]['team1']);
		$team2 = $this->matches_model->getTeamById($matches[$i]['team2']);
		?>
		<div class="w-row grille-row">
		  <div class="w-col w-col-3 w-col-small-3 w-col-tiny-3 w-clearfix grille-column1"><img width="60" src="<?php echo file_url($team1['image']); ?>" class="logo-image left">
			<p class="nom-ville-text left"><?php echo $team1['name']; ?></p>
		  </div>
		  <div class="w-col w-col-6 w-col-small-6 w-col-tiny-6 grille-column-2">
			<div class="date-game"><?php echo $matches[$i]['category']; ?> | <?php echo ucwords(strftime('%A %d %B %Y, %H:%M', strtotime($matches[$i]['datetime']))); ?></div>
		  </div>
		  <div class="w-col w-col-3 w-col-small-3 w-col-tiny-3 w-clearfix grille-column3"><img width="60" src="<?php echo file_url($team2['image']); ?>" class="logo-image right">
			<p class="nom-ville-text right"><?php echo $team2['name']; ?></p>
		  </div>
		</div>
		<?php
	}
	?>
  </div>
</div>