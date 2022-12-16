<?php

class Requests extends BaseController
{

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

}
