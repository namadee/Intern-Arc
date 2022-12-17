<?php

class Users extends BaseController
{

  public function __construct()
  {
    $this->userModel = $this->model('User');
  }


  public function index()
  {
    // $this->view('home');
    $this->view('test');
  }


  public function forgotPassword()
  {
    $this->view('forgotPassword');
  }
  

}
