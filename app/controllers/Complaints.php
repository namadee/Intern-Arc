<?php

class Complaints extends BaseController
{


    public function __construct()
    {
        $this->complaintModel = $this->model('Complaint');
        $this->userModel = $this->model('User');        
        // if (!isset($_SESSION['user_id'])) { //If the user not logged, redirected to login(PDC) 
        //     redirect('users/student-login');
        // }
    }

    public function index()
    {
        $complaints = $this->complaintModel->getComplaint(); //Model function

        $data = [
            'title' => 'JobRoles',
            'buttonName' => 'Submit',
            'inputValue' => '',
            'complaints' => $complaints,
            'formAction' => 'Complaints/addComplaint'
        ];
        $this->view('student/complaint', $data);
    }

    public function addComplaint()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));


            //Associative Array
            $data = [
                'student_id' => $studentId ,
                'subject' => trim($_POST['subject']) ,
                'description' => trim($_POST['description'])
            ];

            //Execute
            if ($this->complaintModel->addComplaint($data)) {

                // Redirect
                redirect('complaints');
            } else {
                die('Something went wrong');
            }
        } else {

            // Init data
            $data = [
                'subject' => '',
                'description' => '',
                'buttonName' => 'Submit',
                'formAction' => 'complaints/add-complaint/'
            ];

            // Load View
            $this->view('student/complaint', $data);
        }
    }
    public function showComplaint($complaintId)
    {

        $complaint = $this->complaintModel->showComplaintById($complaintId); //To get the Advertisement Name
        
        $data = [
            'className'=> 'selectedTab',
            'title' => 'Complaints',
            'subject' => $complaint->subject,
            'description' => $complaint->description,
           
            'complaints/updateComplaints/' . $complaint->complaint_id 
        ];

        $this->view('student/complaint', $data);
    }
}

