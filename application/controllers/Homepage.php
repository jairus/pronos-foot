<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
	public function index(){
		$data = array();
		$this->load->view('main/main', $data);

	}
}
