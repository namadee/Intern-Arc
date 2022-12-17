<?php

class Students extends BaseController
{
    public function __construct()
    {
        $this->studentModel = $this->model('Student');
    }

    //Student Dashboard
    public function index()
    {
        $this->view('student/login');
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
}
