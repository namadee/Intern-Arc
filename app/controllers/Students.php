<?php

class Students extends BaseController
{
    public $studentModel;
    public $userModel;

    public function __construct()
    {
        $this->studentModel = $this->model('Student');
        $this->userModel = $this->model('User');
    }

    //Student User Dashboard
    public function index()
    {
        $this->view('student/dashboard');
    }

    //Manage Students - PDC - RuchiraS
    public function manageStudent($pg = NULL, $year = NULL)
    {
        //Get Batch List 
        $batchList = $this->studentModel->getStudentBatches();

        if ($pg != NULL || $year != NULL) {
            //View with the Std Batch Modal - to add a batch
            switch ($pg) {
                case 'student-batch':

                    $data = [
                        'add_modal_class' => '',
                        'change_access_modal_class' => 'hide-element',
                        'view-modal-class' => 'hide-element',
                        'batch_list' => $batchList
                    ];

                    $this->view('pdc/manageStudent', $data);
                    break;

                case 'change-access':

                    $data = [
                        'add_modal_class' => 'hide-element',
                        'change_access_modal_class' => '',
                        'view-modal-class' => 'hide-element',
                        'batch_list' => $batchList,
                        'batch_year' => $year
                    ];

                    $this->view('pdc/manageStudent', $data);
                    break;

                default:
                    $data = [
                        'add_modal_class' => 'hide-element',
                        'change_access_modal_class' => 'hide-element',
                        'view-modal-class' => '',
                        'batch_list' => $batchList,
                        'batch_year' => $year
                    ];
                    $this->view('pdc/manageStudent', $data);
            }
        } else {
            # IF no values are passed for the above variables
            // Default view with the student batches

            $data = [
                'add_modal_class' => 'hide-element',
                'change_access_modal_class' => 'hide-element',
                'view-modal-class' => 'hide-element',
                'batch_list' => $batchList
            ];

            $this->view('pdc/manageStudent', $data);
        }
    }



    //Add, Change Stats and Delete Batch Functions
    public function manageStudentBatch()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST["add_form_submit"])) {
                // Handle Add Student Batch
                $batch_year = trim($_POST['batch_year']);


                if ($this->studentModel->checkStudentBatch($batch_year)) {
                    # Batch Year already Exists, Cant add a new one
                    flashMessage('student_batch_msg', 'Student Batch ' . $batch_year . ' already exists! Check again!', 'danger-alert');
                    redirect('students/manage-student');
                }

                $this->studentModel->addStudentBatch($batch_year);
                flashMessage('student_batch_msg', 'Student Batch ' . $batch_year . ' added');
                redirect('students/manage-student');
            } else if (isset($_POST["status"])) {
                // Handle Changing Student Batch Status
                $data = [
                    'batch_year' => trim($_POST['batch_year']),
                    'status' => trim($_POST['status'])
                ];

                $this->studentModel->changeBatchAccess($data);
                flashMessage('student_batch_msg', 'Status changed!');
                redirect('students/manage-student');
            } else {
                // Handle Delete Student Batch
                $batch_year = trim($_POST['batch_year']);
                $this->studentModel->deleteStudentBatch($batch_year);
                flashMessage('student_batch_msg', 'Batch Deleted Successfully!');
                redirect('students/manage-student');
            }
        } else {
            redirect('students/manage-student');
        }
    }



    //Manage Students - PDC
    public function studentDetails()
    {

        $this->view('pdc/studentDetails');
    }




    public function studentProfile()
    {
        $studentId = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $studentProfile = $this->studentModel->getStudentProfileData($studentId);
        // $data = [
        //     'student_id' => $studentId,
        //     'experience' => $experience,
        //     'interests' => $interests,
        //     'qualifications' => $qualifications,
        //     'school' => $school,
        //     'contact' => $contact,
        //     'stream' => $stream,
        //     'profile_description' => $profile_description,
        //     'extracurricular' => $extracurricular,
        // ];

        $data = [
            'experience' => $studentProfile->experience,
            'interests' => $studentProfile->interests,
            'qualifications' => $studentProfile->qualifications,
            'school' => $studentProfile->school,
            'contact' => $studentProfile->contact,
            'stream' => $studentProfile->stream,
            'profile_description' => $studentProfile->profile_description,
            'extracurricular' => $studentProfile->extracurricular,
            'profile_name' => $studentProfile->profile_name,
            'personal_email' => $studentProfile->personal_email,
        ];

        $this->view('student/studentprofile', $data);
    }

    public function companyProfile()
    {

        $this->view('student/companyprofile');
    }

    public function viewads()
    {

        $this->view('student/viewads');
    }

    public function editProfile()
    {

        $this->view('student/editprofile');
    }
}
