<?php

class Students extends BaseController
{
    public $studentModel;
    public $userModel;
    public $studentData;
    public $reqCount;
    public $studentDetails;

    public function __construct()
    {
        $this->studentModel = $this->model('Student');
        $this->userModel = $this->model('User');
        $this->requestModel = $this->model('Request');
        //$this->studentData = $this->studentModel->getStudentProfileData($studentId);
    }

    //Student User Dashboard
    public function index()
    {
        $student_id = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $reqCount  = $this->requestModel->getRequestCountPerStudent($student_id);
        //$studentDetails = $this->studentModel->getMainStudentDetails($student_id); 

        

        $data['reqCount']=$reqCount;

        // $data = [
        //  'reqCount' => $this->$reqCount
        //  ];
         $this->view('student/dashboard', $data);
         

    }

    public function dashboardDetails()
    {
        //$student_id = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $studentDetails = $this->studentModel->getMainStudentDetails();

        // $data = [
        //     'studentDetails' => $studentDetails
        // ];

        // $data = [
        //     'registration_number' => $studentDetails->registration_number,
        //     'email' => $studentDetails->email,
        // ];
        $this->view('student/dashboard', $data);
    }

    public function viewAppliedCompanyList()
    {
        $student_id = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $appliedAdvertisements = $this->requestModel->getAppliedAdvertisements($student_id); 

        $data = [
            'appliedAdvertisements' => $appliedAdvertisements
        ];


        $this->view('student/appliedcompanies', $data);
    }

    //Manage Students - PDC - Ruchira
    public function manageStudent($pg = NULL, $year = NULL)
    {
        //Get Batch List and respective student count of each IS and CS
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



    //Add, Change Stats and Delete Batch Functions - Ruchira
    public function manageStudentBatch()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Check button name
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
            } else {
                // Handle Changing Student Batch Status
                $data = [
                    'batch_year' => trim($_POST['batch_year']),
                    'access' => trim($_POST['access'])
                ];

                //Chnage access of the batch
                $this->studentModel->changeBatchAccess($data);
                //Change access of each student in that batch
                $this->studentModel->changeSystemAccessByBatchYear($data);

                flashMessage('student_batch_msg', 'Status changed!');
                redirect('students/manage-student');
            }
        } else {
            redirect('students/manage-student');
        }
    }


    public function studentProfile()
    {
        $studentId = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $studentProfile = $this->studentModel->getStudentProfileData($studentId); 

        $data = [
            'experience' => $studentProfile->experience,
            'interests' => $studentProfile->interests,
            'qualifications' => $studentProfile->qualifications,
            'school' => $studentProfile->school,
            'contact' => $studentProfile->contact,
            'stream' => $studentProfile->stream,
            'profile_description' => $studentProfile->profile_description,
            'profile_name' => $studentProfile->profile_name,
            'personal_email'=> $studentProfile->personal_email,
            'github_link' => $studentProfile->github_link,
            'linkedin_link' => $studentProfile->linkedin_link,
            'extracurricular' => $studentProfile->extracurricular,
        ];

        $this->view('student/studentprofile', $data);
    }

    public function showStudentData(){
        $studentData = $this->studentModel->getStudentProfileData();

        $data = [
            'studentData' => $this->studentData
        ];
        $this->view('student/viewcompanies', $data);

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

    public function cvstatus()
    {

        $this->view('student/cvstatus');
    }


}
