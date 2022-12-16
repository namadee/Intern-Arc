<?php

class StudentShortlist extends BaseController
{

    public function __construct()
    {
        
        
    }

    public function index()
    {
        //view pass data values $data

        $data = [

        ];

        $this->view('company/shortlist', $data);
    }
    
    public function viewStudentShortlist()
    {
            $data = [];
            // Load View
            $this->view('company/shortlistedStudents', $data);
    }

   
}


