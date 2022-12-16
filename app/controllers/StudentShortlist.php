<?php

class StudentShortlist extends BaseController
{

    public function __construct()
    {

    }

    public function index()
    {
        $this->view('company/shortlist');
    }
    
    public function viewStudentShortlist()
    {
            $this->view('company/shortlistedStudents');
    }

   
}


