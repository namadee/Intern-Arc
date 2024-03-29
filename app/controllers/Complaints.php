<?php

class Complaints extends BaseController
{
    public $complaintModel;
    public $userModel;

    public function __construct()
    {
        $this->complaintModel = $this->model('Complaint');
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        $userID = $_SESSION['user_id'];
        $complaints = $this->complaintModel->getComplaint($userID); //Model function

        $data = [
            'title' => 'Complaints',
            'buttonName' => 'Submit',
            'subject' => '',
            'description' => '',
            'complaints' => $complaints,
            'formAction' => 'complaints/add-complaint'
        ];
        $this->view('student/complaint', $data);
    }

    public function addComplaint()
    {
        $user_id = $_SESSION['user_id'];
        $code = generateRefCode();
        $finalRef = $user_id . "REF" . $code;
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags in URL
            stripTags();

            $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));


            //Associative Array
            $data = [
                'student_id' => $studentId,
                'subject' => trim($_POST['subject']),
                'description' => trim($_POST['description']),
                'reference_code' => $finalRef
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
        $userID = $_SESSION['user_id'];
        $complaints = $this->complaintModel->getComplaint($userID);
        $complaint = $this->complaintModel->showComplaintById($complaintId); //To get the Advertisement Name

        $data = [
            'className' => 'selectedTab',
            'title' => 'Complaints',
            'complaints' => $complaints,
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

            // Strip Tags in URL
            stripTags();

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

    public function Complaint()
    {
        // Get Details
        $complaint = $this->complaintModel->getComplaint();

        $data = [
            'complaint' => $complaint,
        ];

        $this->view('admin/adminComlaintView', $data);
    }
}
