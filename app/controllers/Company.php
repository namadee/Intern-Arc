<?php

class Company extends BaseController
{
    
    public function __construct()
    {
        $this->companyModel = $this->model('Company');
    }

    public function index() //default method and view
    {
        $this->view('company/login');
       
    }

<<<<<<< HEAD
    public function profile() //default method and view
    {
        $this->view('company/profile');
    }

=======
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



>>>>>>> 4eb739667e5b1599d4cbd087c8bf2190218b0129

}
