<?php

class Student extends BaseController
{
    public function __construct()
    {
        $this->StudentModel = $this->model('Student');
    }

    public function index() //default method and view
    {
        $this->view('student/login');

       // $this->view('student/submitcomplaint');
    }

    public function cvstatus() //default method and view
    {
        $this->view('student/cvstatus');

       // $this->view('student/submitcomplaint');
    }

    public function advertisementlist() //default method and view
    {
        $this->view('student/advertisementlist');

       // $this->view('student/submitcomplaint');
    }

    public function advertisements() //default method and view
    {
        $this->view('student/advertisements');

       // $this->view('student/submitcomplaint');
    }

    public function appliedcompanies() //default method and view
    {
        $this->view('student/appliedcompanies');

       // $this->view('student/submitcomplaint');
    }

    public function dashboard() //default method and view
    {
        $this->view('student/dashboard');

       // $this->view('student/submitcomplaint');
    }

    public function jobroles() //default method and view
    {
        $this->view('student/jobroles');

       // $this->view('student/submitcomplaint');
    }

    public function scheduleadvertisement() //default method and view
    {
        $this->view('student/scheduleadvertisement');

       // $this->view('student/submitcomplaint');
    }

    public function viewads() //default method and view
    {
        $this->view('student/viewads');

       // $this->view('student/submitcomplaint');
    }

    public function viewadvertisement() //default method and view
    {
        $this->view('student/viewadvertisement');

       // $this->view('student/submitcomplaint');
    }

    public function viewcompanies() //default method and view
    {
        $this->view('student/viewcompanies');

       // $this->view('student/submitcomplaint');
    }

    public function companyprofile() //default method and view
    {
        $this->view('student/companyprofile');

       // $this->view('student/submitcomplaint');
    }

}