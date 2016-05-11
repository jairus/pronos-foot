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
    $this->load->view('users/signin', $data);
  }

}
