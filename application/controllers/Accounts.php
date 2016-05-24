<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// Your own constructor code
	}

	public function index(){
		//$data = array();
		//$this->load->view('accounts/account_elimination', $data);
	}

	public function account_elimination(){
		$data['yield'] = 'accounts/account_elimination';
		$data['points'] = '250'; // TEST
		$this->load->view('accounts_layout', $data);
	}
	public function account_group(){
		$data['yield'] = 'accounts/account_group';
		$this->load->view('accounts_layout', $data);
		//$this->load->view('accounts/account_group', $data);
	}
}
