<?php
if(!count($matches)){
	return 0;
}
	//echo date("Y-m-d H:i:s");
	//return 0;
?>
	
    <div class="w-container grille-container">
      <p class="grille-title1">EURO 2016 Calendrier | Phase de Groupes</p>
      <p class="prix-text2 consignes">Vous n'êtes pas obligé de saisir tous vos pronostics en une fois.
        <br>Vous pouvez modifier chaque pronostic jusqu'au début du match</p>
      <div class="div-games-info">
        <div class="container-button-sauver">
          <a href="#" class="w-inline-block link-button-sauver">
            <div class="button-save betbutton">Enregistrer le(s) Pronostic(s)</div>
          </a>
          <div class="message-erreur errormessage"></div>
        </div>
		<iframe name="hiframe" style="width:500px; height:300px; display:none" class=""></iframe>
		<form method="post" action="<?php echo site_url("placebets"); ?>" id="betform" target="hiframe">
		<?php
		if(count($matches)){
			$n = 0;
			foreach($matches as $key=>$matchesarr){
				if($n==0){
					echo '<div class="w-row row-groups"><div class="block-groups">';
				}
				else if($n%2==0&&$n!=0){
					echo '</div></div><div class="w-row row-groups"><div class="block-groups">';
				}
				//echo $key."&nbsp;";
				$t  = count($matchesarr);
				for($i=0; $i<$t; $i++){
					if($i==0){
						echo '<div class="w-col w-col-6 w-col-stack"><div class="group-name">'.$key.'</div>';
					}
					
					$team1 = $this->matches_model->getTeamById($matchesarr[$i]['team1']);
					$team2 = $this->matches_model->getTeamById($matchesarr[$i]['team2']);
					?>
					<div class="block-team-and-score">
						<div class="block-team">
						  <p class="team-name"><?php echo $team1['name']; ?></p><img width="60" src="<?php echo file_url($team1['image']); ?>" class="team-flag">
						</div>
						<div class="block-scores">
						  <?php
						  //pre($matchesarr[$i]);
						  //pre($bets[$matchesarr[$i]['id']]);
						  if(!$bets[$matchesarr[$i]['id']]){
							  if($matchesarr[$i]['bettingclosed']!="1"){
								  ?>
								  <input maxlength="2"  type="text" name="team1score[<?php echo $matchesarr[$i]['id'] ?>]" class="w-input input-scores-field">
								  <div class="text-versus">-</div>
								  <input maxlength="2"  type="text" name="team2score[<?php echo $matchesarr[$i]['id'] ?>]" class="w-input input-scores-field">
								  <?php
							  }
							  else{
								?>
								  <input maxlength="2"  type="text" value="<?php echo $bets[$matchesarr[$i]['id']]['team1score'] ?>" disabled class="w-input input-scores-field">
								  <div class="text-versus">-</div>
								  <input maxlength="2"  type="text" value="<?php echo $bets[$matchesarr[$i]['id']]['team2score'] ?>" disabled class="w-input input-scores-field">
								<?php
							  }
						  }
						  else{
							if($matchesarr[$i]['team1score']!=""){ //if there is result already
								//if exact 
								if($matchesarr[$i]['team1score']==$bets[$matchesarr[$i]['id']]['team1score'] && $matchesarr[$i]['team2score']==$bets[$matchesarr[$i]['id']]['team2score']){
									?>
									  <div class="scores-field correct"><?php echo $bets[$matchesarr[$i]['id']]['team1score'] ?></div>
									  <div class="text-versus">-</div>
									  <div class="scores-field correct"><?php echo $bets[$matchesarr[$i]['id']]['team2score'] ?></div>
									<?php
								}
								//if guessed winner
								else if(
									(
										(
											(
												//if team1 wins
												$matchesarr[$i]['team1score']>$matchesarr[$i]['team2score']
												&& $bets[$matchesarr[$i]['id']]['team1score'] > $bets[$matchesarr[$i]['id']]['team2score']
											)||
											(
												//if team2 wins
												$matchesarr[$i]['team1score']<$matchesarr[$i]['team2score']
												&& $bets[$matchesarr[$i]['id']]['team1score'] < $bets[$matchesarr[$i]['id']]['team2score']
											)||
											(
												//if draw
												$matchesarr[$i]['team1score']==$matchesarr[$i]['team2score']
												&& $bets[$matchesarr[$i]['id']]['team1score'] == $bets[$matchesarr[$i]['id']]['team2score']
											)
										)&&$matchesarr[$i]['elimination']!=1 //not elims
									)
									||
									(
										//if elims and you guessed the winner
										$matchesarr[$i]['elimination'] 
										&&$matchesarr[$i]['winner'] > 0 
										&& $matchesarr[$i]['winner']==$bets[$matchesarr[$i]['id']]['winner']
									)
								){
									
									?>
									  <div class="scores-field correct"><?php echo $bets[$matchesarr[$i]['id']]['team1score'] ?></div>
									  <div class="text-versus">-</div>
									  <div class="scores-field correct"><?php echo $bets[$matchesarr[$i]['id']]['team2score'] ?></div>
									<?php
									
								}
								else{
									?>
									  <div class="scores-field incorrect"><?php echo $bets[$matchesarr[$i]['id']]['team1score'] ?></div>
									  <div class="text-versus">-</div>
									  <div class="scores-field incorrect"><?php echo $bets[$matchesarr[$i]['id']]['team2score'] ?></div>
									<?php
								}
									
							}
							else{
								if($matchesarr[$i]['bettingclosed']!="1"){
									?>
									<input maxlength="2"  type="text" value="<?php echo $bets[$matchesarr[$i]['id']]['team1score'] ?>" name="team1score[<?php echo $matchesarr[$i]['id'] ?>]" class="w-input input-scores-field">
									<div class="text-versus">-</div>
									<input maxlength="2"  type="text" value="<?php echo $bets[$matchesarr[$i]['id']]['team2score'] ?>" name="team2score[<?php echo $matchesarr[$i]['id'] ?>]" class="w-input input-scores-field">
									<?php
								}
								else{
									?>
									<input maxlength="2"  type="text" value="<?php echo $bets[$matchesarr[$i]['id']]['team1score'] ?>" disabled class="w-input input-scores-field">
									<div class="text-versus">-</div>
									<input maxlength="2"  type="text" value="<?php echo $bets[$matchesarr[$i]['id']]['team2score'] ?>" disabled class="w-input input-scores-field">
									<?php
								}
							}
						  }
						  ?>
						</div>
						<div class="block-team right"><img width="60" src="<?php echo file_url($team2['image']); ?>" class="team-flag">
						  <p class="team-name right"><?php echo $team2['name']; ?></p>
						</div>
					</div>
					<?php
				}
				echo "</div>";
				$n++;
				
				
			}
			echo "</div></div>";
		}
		?>
        </form>
       
       
        <div class="container-button-sauver">
          <a href="#" class="w-inline-block link-button-sauver">
            <div class="button-save betbutton">Enregistrer le(s) Pronostic(s)</div>
          </a>
          <div class="message-erreur errormessage"></div>
        </div>
      </div>
    </div>
	<script>
	$(".betbutton").click(function(){
		$("#betform").submit();
		return false;
	});
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	$(".w-input").keypress(function(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	});
	
	function shareOnFacebook(obj) {
		u = obj.attr("href");
		t = obj.attr("title");
		window.open('http://www.facebook.com/share.php?u=' + encodeURIComponent(u) + '&title='+encodeURIComponent(t), 'popupwindow', 'scrollbars=yes,width=800,height=400');
		return false;
	}
	
	</script>
