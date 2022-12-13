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


}