<?php
@session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
	public function placebets(){
		$team1score = $_POST['team1score'];
		$team2score = $_POST['team2score'];
		$winner = $_POST['winner'];
		$refresh = false;
		if(is_array($team1score)){
			//error
			/*
			foreach($team1score as $match_id => $value){
				if($team1score[$match_id]==""||$team2score[$match_id]==""){
					$error = "Vous devez pronostiquer le résultat d'au moins un match.";
					break;
				}
			}
			*/
			if($error==""){
				$empty = true;
				foreach($team1score as $match_id => $value){
					$sql = "select `id` from `bets` where `match_id`='".db_escape($match_id)."' and `profile_id`='".db_escape($_SESSION['profile']['id'])."'";
					$bets = $this->db->query($sql)->result_array();
					$sql = "select `datetime`, `bettingclosed` from `matches` where `id`='".db_escape($match_id)."' and `deleted`<>1";
					$match = $this->db->query($sql)->result_array();
					$matchtime = strtotime($match[0]['datetime']);

					if($matchtime-time() < 3600){
						//$sql = "update `matches` set `bettingclosed`='1' where `id`='".db_escape($match_id)."' ";
						//$this->db->query($sql);
						//$refresh = true;
						continue;
					}
					else if(
						($team1score[$match_id]==""&&$team2score[$match_id]!="")
						||
						($team1score[$match_id]!=""&&$team2score[$match_id]=="")
					){
						$error = "Vous devez pronostiquer le résultat d'au moins un match.";
						continue;
					}
					
					if($team1score[$match_id]!=""||$team2score[$match_id]!=""){
						$empty = false;
					}
					
					if(
						$team1score[$match_id]!=""&&$match[0]['bettingclosed']<>1
						&&$team1score[$match_id]!=""
						&&$team2score[$match_id]!=""
					){ //no score yet and betting not yet closed
						if($bets[0]['id']){
							$sql = "update `bets` set 
							`match_id`='".db_escape($match_id)."',
							`profile_id`='".db_escape($_SESSION['profile']['id'])."',
							`team1score`='".db_escape($team1score[$match_id])."',
							`team2score`='".db_escape($team2score[$match_id])."'";
							if($winner[$match_id]){
								$sql .=" , `winner`='".db_escape($winner[$match_id])."'";
							}
							$sql .=" where `id`='".$bets[0]['id']."'
							";
							$this->db->query($sql);
							//echo $sql;
							//exit();
						}
						else if(!$bets[0]['id']){
							$sql = "insert into `bets` set 
							`match_id`='".db_escape($match_id)."',
							`profile_id`='".db_escape($_SESSION['profile']['id'])."',
							`team1score`='".db_escape($team1score[$match_id])."',
							`team2score`='".db_escape($team2score[$match_id])."',";
							if($winner[$match_id]){
								$sql .=" `winner`='".db_escape($winner[$match_id])."',";
							}
							$sql .=" `dateadded` = NOW()
							";
							$this->db->query($sql);
						}
					}
				}
				if($empty){
					$error = "Vous devez pronostiquer le résultat d'au moins un match.";
				}
			}
		}
		
		//exit();
		
		if($error){
			?>
			<script>
			parent.jQuery(".errormessage").html("<?php echo htmlentitiesX($error); ?>");
			parent.jQuery(".errormessage").hide();
			parent.jQuery(".errormessage").fadeIn(200);
			</script>
			<?php
		}
		else if($refresh){
			?>
			<script>
			parent.location = "<?php echo site_url(); ?>";
			</script>
			<?php
		}
		else{
			?>
			<script>
			parent.jQuery(".errormessage").hide();
			//alert("Vos pronostics ont été enregistrés avec succès");
			parent.jQuery(".errormessage").html("<span style='color:#11b62b !important'>Vos pronostics ont été enregistrés avec succès</a>");
			parent.jQuery(".errormessage").fadeIn(200);
			//parent.location = "<?php echo site_url(); ?>";
			</script>
			<?php
		}
		
	}
	public function index(){
		$data = array();
		if($_SESSION['profile']){
			//get matches
			$sql = "select `matches`.*, `groups`.`winnerpoints`, `groups`.`exactscorepoints`, `groups`.`elimination` as `elimination`, `groups`.`name` as `category` from `matches` left join `groups` on (`groups`.`id`=`matches`.`category` and `groups`.`deleted`<>1) where `matches`.`deleted`<>1 order by `groups`.`name` asc, `matches`.`datetime` asc";
			$matches = $this->db->query($sql)->result_array();
			$t = count($matches);
			
			//pre($matches);
			//exit();
			$matchestemp = array();
			for($i=0; $i<$t; $i++){
				if(!is_array($matchestemp[$matches[$i]['category']])){
					$matchestemp[$matches[$i]['category']] = array();
				}
				$matchestemp[$matches[$i]['category']][] = $matches[$i];
			}
			$matches = $matchestemp;
			
			//get bets
			$sql = "select * from `bets` where `profile_id`='".db_escape($_SESSION['profile']['id'])."' and `deleted`<>1";
			$bets = $this->db->query($sql)->result_array();
			$t = count($bets);
			$betstemp = array();
			for($i=0; $i<$t; $i++){
				if(!is_array($betstemp[$bets[$i]['match_id']])){
					$betstemp[$bets[$i]['match_id']] = array();
				}
				$betstemp[$bets[$i]['match_id']] = $bets[$i];
			}
			$bets = $betstemp;
			
			//calculate points
			$points = 0;
			if(count($matches)){
				foreach($matches as $key=>$matchesarr){
					$t  = count($matchesarr);
					for($i=0; $i<$t; $i++){
						if(!$bets[$matchesarr[$i]['id']]){//no bets
							
						}
						else{
							if($matchesarr[$i]['team1score']!=""){ //if there is result already
								//if exact 
								if($matchesarr[$i]['team1score']==$bets[$matchesarr[$i]['id']]['team1score'] && $matchesarr[$i]['team2score']==$bets[$matchesarr[$i]['id']]['team2score']){
									$points += $matchesarr[$i]['exactscorepoints'];
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
										&&$matchesarr[$i]['winner'] != ""
										&& $matchesarr[$i]['winner']==$bets[$matchesarr[$i]['id']]['winner']
									)
								){
									$points += $matchesarr[$i]['winnerpoints'];
									//exit();
								}
								else{
									//no points
								}
									
							}
							else{
								//no results yet
							}
						}
						  
					}
				}
			}
			$sql = "update `profiles` set `points`='".db_escape($points)."' where `id`='".db_escape($_SESSION['profile']['id'])."'";
			$_SESSION['profile']['points'] = $points;
			$this->db->query($sql);
			
			$data['bets'] = $bets;
			$data['matches'] = $matches;
			$data['yield'] = 'accounts/account_group';
			$sql = "select `points` from `profiles` group by `points` order by `points` desc";
			$r = $this->db->query($sql)->result_array();
			$t = count($r);
			//pre($r);
			for($i=0; $i<$t; $i++){
				if($_SESSION['profile']['points']==$r[$i]['points']){
					$rank = $i+1;
					break;
				}
			}	
			if($_SESSION['profile']['points']==0){
				$_SESSION['profile']['rank'] = "";
			}
			else{
				$_SESSION['profile']['rank'] = $rank;
			}
			$this->load->view('accounts_layout', $data);
			return true;
		}
		else{
			//get matches
			$sql = "select `matches`.*, `groups`.`winnerpoints`, `groups`.`exactscorepoints`, `groups`.`elimination` as `elimination`, `groups`.`name` as `category` from `matches` left join `groups` on (`groups`.`id`=`matches`.`category` and `groups`.`deleted`<>1) where `matches`.`deleted`<>1 order by `matches`.`datetime` asc";
			$matches = $this->db->query($sql)->result_array();
			$t = count($matches);
		}
		$data['matches'] = $matches;
		$data['yield'] = 'main/home';
		$this->load->view('main_layout', $data);
		//$this->load->view('main/main', $data);
	}
	public function logout(){
		unset($_SESSION['profile']);
		unset($_SESSION['fbprofile']);
		redirect(site_url());
	}
	public function elimination(){
		$data = array();
		//$data['yield'] = 'main/elimination_final';
		//$data['yield'] = 'main/elimination_1-2';
		//$data['yield'] = 'main/elimination_1-4';
		$data['yield'] = 'main/elimination_1-8';

		$this->load->view('main_layout', $data);
	}
	
	public function cgu(){
		$this->load->view('cgu_layout', $data);
	}
}
