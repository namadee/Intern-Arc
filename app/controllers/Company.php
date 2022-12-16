<?php

class Company extends BaseController
{
    
    public function __construct()
    {
        $this->companyModel = $this->model('Company');
    }

    public function index() 
    {
        $this->view('company/login');
       
    }

    public function studentRequests() //default method and view
    {
        $this->view('company/studentRequestList');
       
    }

    public function profile() //default method and view
    {
        $this->view('company/profile');
       
    }

    public function dashboard(){
        $this->view('company/dashboard');
    }

    public function forgotPassword()
    {
    
        $this->view('forgotPassword');

    }




}
