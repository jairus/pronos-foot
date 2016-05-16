<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
@session_start();
class matches_model extends CI_Model {
	 public function __construct(){
		parent::__construct();
		$this->load->database();
    }
	public function getTeamById($id){
		$sql = "select * from `teams` where `deleted`<>1 and `id`='".db_escape($id)."'";
		$team = $this->db->query($sql)->result_array();
		return $team[0];
	}
	public function getTeams(){
		$sql = "select * from `teams` where `deleted`<>1";
		$teams = $this->db->query($sql)->result_array();
		return $teams;
	}
	public function getGroups(){
		$sql = "select * from `groups` where `deleted`<>1";
		$groups = $this->db->query($sql)->result_array();
		return $groups;
	}
}