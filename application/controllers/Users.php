<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function sign_in()
  {
    $data = array();
    $data['yield'] = 'users/content';
    $data['signin'] = 'users/signin_form';

    $this->load->view('main_layout', $data);
    // $this->load->view('users/signin', $data);
  }

}
