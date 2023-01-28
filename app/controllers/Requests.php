<?php

class Requests extends BaseController
{
    public $studentRequestModel;

    public function __construct()
    {
        $this->studentRequestModel = $this->model('StudentRequest');
    }

    public function index()
    {

        $this->view('company/studentRequestList');
    }

    public function viewStudentRequest()
    {
        $this->view('company/studentRequest');
    }


    //All the Shortlisted Students of All the Advertisements
    public function shortlistedList()
    {
        $this->view('company/shortlist');
    }

    //All the Shortlisted Students under 1 Advertisement
    public function shortlistedStudents()
    {
        $this->view('company/shortlistedStudents');
    }

    //Student Request List - PDC
    public function allRequests()
    {
        $this->view('pdc/studentRequest');
    }

}
