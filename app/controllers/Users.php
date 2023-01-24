<?php

class Users extends BaseController
{

  public $userModel;
  
  public function __construct()
  {
    $this->userModel = $this->model('User');
  }


  public function index()
  {
    $this->view('home');
  }


  public function forgotPassword()
  {
    $this->view('forgotPassword');
  }
  

}
