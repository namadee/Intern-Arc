<?php

class Admin extends BaseController
{
    public $adminModel;
    public $userModel;

    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        $this->userModel = $this->model('User');
    }

    public function index() //default method and view
    {
        $this->view('admin/dashboard');
    }

    public function complaint() //default method and view
    {
        $this->view('admin/adminComplaint');
    }

    public function viewcomplaint() //default method and view
    {
        $this->view('admin/viewComplaint');
    }

    public function company() //default method and view
    {
        $this->view('admin/company');
    }

    public function viewcompany() //default method and view
    {
        $this->view('admin/viewCompany');
    }

    public function viewbatches() //default method and view
    {
        $this->view('admin/viewBatches');
    }

    public function viewstudentlist() //default method and view
    {
        $this->view('admin/viewStudentList');
    }

    public function viewstudent() //default method and view
    {
        $this->view('admin/viewStudent');
    }

    public function viewpdcstaff() //default method and view
    {
        $this->view('admin/viewPdcStaff');
    }

    public function viewpdcuser() //default method and view
    {
        $this->view('admin/viewPdcUser');
    }

    public function report() //default method and view
    {
        $this->view('admin/report');
    }

    public function registrationreport() //default method and view
    {
        $this->view('admin/registrationReport');
    }

    public function advertisementreport() //default method and view
    {
        $this->view('admin/advertisementReport');
    }

    public function viewprofile() //default method and view
    {
        $this->view('admin/updateProfile');
    }

    

}
