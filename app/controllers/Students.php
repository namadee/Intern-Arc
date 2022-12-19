<?php

class Students extends BaseController
{
    public function __construct()
    {
    }

    //Student User Dashboard
    public function index()
    {
        $this->view('student/dashboard');
    }

    //Manage Students - PDC
    public function manageStudent()
    {

        $this->view('pdc/manageStudent');
    }

    //Manage Students - PDC
    public function studentList()
    {

        $this->view('pdc/studentList');
    }

    //Manage Students - PDC
    public function studentDetails()
    {

        $this->view('pdc/studentDetails');
    }

    public function studentProfile()
    {

        $this->view('student/studentprofile');
    }

    public function companyProfile()
    {

        $this->view('student/companyprofile');
    }

    public function viewads()
    {

        $this->view('student/viewads');
    }



}
