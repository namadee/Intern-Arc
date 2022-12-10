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
            'title' => 'Complaints',
            'buttonName' => 'Submit',
            'subject' => '',
            'description' => '',
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
        $complaints = $this->complaintModel->getComplaint();
        $complaint = $this->complaintModel->showComplaintById($complaintId); //To get the Advertisement Name
        
        $data = [
            'className'=> 'selectedTab',
            'title' => 'Complaints',
            'complaints'=> $complaints,
            'subject' => $complaint->subject,
            'description' => $complaint->description,
            'buttonName' => 'Update',
           
            'formAction' => 'complaints/update-Complaint/' . $complaint->complaint_id 
        ];

        $this->view('student/complaint', $data);
    }
    public function updateComplaint($id)
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'subject' => trim($_POST['subject']),
                'description' => trim($_POST['description']),
                'id' => $id
            ];

            //Execute
            if ($this->complaintModel->updateComplaint($data)) {

                // Redirect
                redirect('complaints');
            } else {
                die('Something went wrong'); 
            }
        } else {

            // Init data
            $data = [
                'name' => '',
                'buttonName' => 'Add Complaint'
            ];

            // Load View
            $this->view('student/complaint', $data);
        }
    }

    public function deleteComplaint($id)
    {
        $this->complaintModel->deleteComplaint($id);
    }
}

