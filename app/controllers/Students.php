<?php

class Students extends BaseController
{
    public $studentModel;
    public $userModel;
    public $studentData;
    public $reqCount;
    public $studentDetails;
    public $requestModel;
    public $advertisementModel;

    public function __construct()
    {
        $this->studentModel = $this->model('Student');
        $this->userModel = $this->model('User');
        $this->requestModel = $this->model('Request');
        $this->advertisementModel = $this->model('Advertisement');
    }

    //Student User Dashboard
    public function index()
    {
        $student_id = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $reqCount  = $this->requestModel->getRequestCountPerStudent($student_id);
        $studentDetails = $this->studentModel->getStudentData($student_id);

        $data2 = [
            'studentDetails' => $studentDetails
        ];

        $data['reqCount'] = $reqCount;

        $data = array_merge($data, $data2);
        $this->view('student/dashboard', $data);
    }


    public function uploadCV()
    {


        $studentId = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $studentProfile = $this->studentModel->getStudentProfileData($studentId);
        $cv_name = $this->studentModel->getCV($studentId);
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            // Strip Tags
            //stripTags();

            //$studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
            //extra 3
            // $text = explode("\r<\br>", trim($_POST['interests-list']));
            // $length = count($text);

            // $emptyArray = array();
            // for ($x = 0; $x < $length; $x++) {
            //     $emptyArray[$x] = trim($text[$x]); 
            // }
            //$completeString = implode("", $emptyArray);


            //File upload path
            $targetDir = "uploads/cv/";
            //Change image file name - Unique Name for each user with the help of userId
            $fileName = 'user' . $_SESSION['user_id'] . '_cv' . rand(0, 100000);
            //Get the extension
            $extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);
            //Full image name
            $basename   = $fileName . "." . $extension; //user56_profile_img.jpg
            //TargetPath
            $targetFilePath = $targetDir . $basename;



            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (!empty($_FILES["cv"]["name"])) {
                //Image Size in Bytes
                $docSize =  $_FILES["cv"]["size"];


                //Check whether the uploaded image is below 500kb
                if ($docSize >= 5000000) {
                    // Redirect
                    $statusMsg = 'Sorry, Please upload an document below 5MB';
                    flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                    redirect('profiles/student-profile');
                    exit;
                }

                // Allow certain file formats
                $allowTypes = array('pdf');

                if (in_array($fileType, $allowTypes)) {
                    //Removing old image from storage
                    //Must check if its the default img before removing
                    //If its the default img then we skip unlink part
                    // if ($cv_name->cv != 'img/profile-img/profile-icon.svg') {
                    //     unlink(PROFILE_IMG_PATH . $cv_name->cv);
                    // }
                    // Upload file to server


                    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFilePath)) {

                        // Insert image file name into database
                        $data = [
                            'user_id' => $_SESSION['user_id'],
                            'cv' => $targetFilePath
                        ];




                        //Execute - Adding new Img name and Path to user_tbl
                        $this->studentModel->uploadCV($data);

                        //To add the new photo session - top navbar profile photo
                        //Update Image Session Value
                        // $_SESSION['cv'] = $targetFilePath;
                        // $data = [

                        //     'student_id' => $studentId,
                        //     'cv' => ($_POST['cv']),
                        // ];


                        //Execute - Adding other details to company_tbl
                        // $this->studentModel->EditStudentProfileDetails($data);

                        // Redirect - Profile Updared successfully
                        $statusMsg = 'CV Uploaded Successfully';
                        flashMessage('profile_update_status', $statusMsg);
                        redirect('profiles/student-profile');
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file.";
                        flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                        redirect('student/uploadCV');
                    }
                } else {
                    // Redirect
                    $statusMsg = 'Sorry, only PDF files are allowed to upload.';
                    flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                    redirect('student/uploadCV');
                }
            }
            // else {

            //     //no pro pic uploaded
            //     $data = [

            //         'student_id' => $studentId,
            //         'experience-list' => trim($_POST['experience-list']),
            //         'interests-list' => $_POST['interests'],
            //         'qualifications-list' => trim($_POST['qualifications-list']),
            //         'school' => trim($_POST['school']),
            //         'contact' => trim($_POST['contact']),
            //         'stream' => trim($_POST['stream']),
            //         'profile_description' => trim($_POST['profile_description']),
            //         'profile_name' => trim($_POST['profile_name']),
            //         'personal_email' => trim($_POST['personal_email']),
            //         'github_link' =>trim($_POST['github_link']),
            //         'linkedin_link' =>trim($_POST['linkedin_link']),
            //         'extracurricular-list' => trim($_POST['extracurricular-list']),
            //     ];

            //     $data['interests-list'] = implode(", ", $data['interests-list']);
            //     echo $data['interests-list'];

            //     //Execute - Adding other details to company_tbl
            //     $this->studentModel->EditStudentProfileDetails($data);

            //     // Redirect - Profile Updated successfully
            //     $statusMsg = 'Profile Uploaded Successfully';
            //     flashMessage('profile_update_status', $statusMsg);
            //     redirect('profiles/student-profile');

            // }

            //Execute
            // if ($this->studentModel->EditStudentProfileDetails($data)) {
            //     redirect('profiles/student-profile');
            // } else {
            //      die('Something went wrong');
            //  }
        } else {

            $data = [
                'cv' => $studentProfile->cv,
                // 'interests' => $studentProfile->interests,
                // 'qualifications' => $studentProfile->qualifications,
                // 'school' => $studentProfile->school,
                // 'contact' => $studentProfile->contact,
                // 'stream' => $studentProfile->stream,
                // 'profile_description' => $studentProfile->profile_description,
                // 'profile_name' => $studentProfile->profile_name,
                // 'personal_email'=>$studentProfile->personal_email,
                // 'extracurricular' => $studentProfile->extracurricular,
                // 'profile_name' => $studentProfile->profile_name,
                // 'personal_email' => $studentProfile->personal_email,
                // 'github_link' => $studentProfile->github_link,
                // 'linkedin_link'=> $studentProfile->linkedin_link,

            ];

            $this->view('student/cvstatus', $data);
        }
    }



    public function dashboardDetails()
    {
        $student_id = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $studentDetails = $this->studentModel->getStudentData($student_id);

        $data = [
            'studentDetails' => $studentDetails
        ];

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
        //Access Control
        if ($_SESSION['user_role'] != 'pdc') {
            redirect('errors/error403');
        }
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
                        'batch_list' => $batchList,
                        'batch_year' => ''
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
                'batch_list' => $batchList,
                'batch_year' => ''
            ];

            $this->view('pdc/manageStudent', $data);
        }
    }



    //Add, Change Stats and Delete Batch Functions - Ruchira
    public function manageStudentBatch()
    {
        //Access Control
        if ($_SESSION['user_role'] != 'pdc') {
            redirect('errors/error403');
        }
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

                if (isset($_POST['selectBatchYear']) && $_POST['selectBatchYear'] == '1') {
                    // Checkbox was checked
                    $this->studentModel->addStudentBatch($batch_year);
                    $this->studentModel->deselectAllBatchYears();
                    $this->studentModel->updateCurrentBatchYear($batch_year);

                    flashMessage('student_batch_msg', 'Student Batch ' . $batch_year . ' added');
                    redirect('students/manage-student');
                    $_SESSION['batchYear'] = $batch_year;
                } else {
                    $this->studentModel->addStudentBatch($batch_year);
                    flashMessage('student_batch_msg', 'Student Batch ' . $batch_year . ' added');
                    redirect('students/manage-student');
                }
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


    public function studentProfile() //optional
    {
        $studentId = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $studentProfile = $this->studentModel->getStudentProfileData($studentId);
        if ($studentId != NULL) {
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
                'personal_email' => $studentProfile->personal_email,
                'extracurricular' => $studentProfile->extracurricular,

            ];
        } else {
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
                'personal_email' => $studentProfile->personal_email,
                'github_link' => $studentProfile->github_link,
                'linkedin_link' => $studentProfile->linkedin_link,
                'extracurricular' => $studentProfile->extracurricular,
            ];

            $this->view('student/studentprofile', $data);
        }
    }

    public function bookInterviewSlot($slotId, $adId)
    {

        $studentId =  $this->userModel->getStudentUserId($_SESSION['user_id']);
        $data = [
            'ad_id' => $adId,
            'slot_id' => $slotId,
            'student_id' => $studentId
        ];

        //Execute
        if ($this->studentModel->checkInterviewBooked($adId, $studentId)) {
            flashMessage('Interview_msg', 'You have already reserved a time slot for this Ad!', 'danger-alert');
            redirect('schedule/');
        } else if ($this->studentModel->bookInterviewSlot($data)) {

            flashMessage('Interview_msg', 'Reserved the Interview Slot Successfully!');
            redirect('schedule/');
        } else {

            redirect('errors');
        }
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
