<?php

class StudentRequests extends BaseController
{

    public function __construct()
    {
        $this->studentRequestModel = $this->model('StudentRequest');
        
    }

    public function index()
    {
        //view pass data values $data

        $data = [

        ];

        $this->view('company/studentRequestList', $data);
    }
    
    public function viewStudentRequest()
    {
            $data = [];
            // Load View
            $this->view('company/StudentRequest', $data);
    }

    public function showStudentRequest($StudentRequestId)
    {   
        $data = [
           
        ];

        $this->view('company/add-StudentRequest', $data);
    }

    public function updateStudentRequest($StudentRequestId)
    {
               
                    $data = [
                        
                    ];
                
                    // Load View
                    $this->view('company/add-StudentRequest', $data);               
    }

    public function deleteStudentRequest($StudentRequestId)
    {
        $this->StudentRequestModel->deleteStudentRequest($StudentRequestId);
    }
}


