<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
  public function index(){
    $data = array();
    $data['yield'] = 'main/home';
    $this->load->view('main_layout', $data);
    //$this->load->view('main/main', $data);
  }

  public function elimination(){
    $data = array();
    //$data['yield'] = 'main/elimination_final';
    //$data['yield'] = 'main/elimination_1-2';
    //$data['yield'] = 'main/elimination_1-4';
    $data['yield'] = 'main/elimination_1-8';

    $this->load->view('main_layout', $data);
  }
}
