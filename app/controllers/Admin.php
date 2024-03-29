<?php

use helpers\PdfHandler;

class Admin extends BaseController
{
    public $adminModel, $userModel, $companyModel, $studentModel, $registerModel, $advertisementModel, $requestModel, $pdcModel;

    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        $this->studentModel = $this->model('Student');
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
        $this->registerModel = $this->model('Register');
        $this->advertisementModel = $this->model('Advertisement');
        $this->requestModel = $this->model('Request');
        $this->pdcModel = $this->model('Pdc');

        if ($_SESSION['user_role'] != 'admin') {
            redirect('errors/error403');
        }
    }

    public function index($batchYear = NULL) //default method and view
    {
        if ($batchYear == NULL) {
            $batchYear = $_SESSION['batchYear'];
        }

        $companyData = $this->adminModel->getTopCompanies($batchYear);
        $studentBatches = $this->adminModel->getStudentBatches();
        $jobPositionData = $this->adminModel->getTopJobPositions($batchYear);
        $roundDetails = $this->pdcModel->getRoundPeriods();
        $companyCount = $this->companyModel->getCompanyCount();
        $studentCount = $this->studentModel->getStudentCount();
        $data = [
            'companyCount' => $companyCount->totalRows,
            'studentCount' => $studentCount->totalRows,
            'roundDetails' => $roundDetails,
            'jobPositionData' => $jobPositionData,
            'jobPositions' => array_column($jobPositionData, 'position'),
            'studentBatches' => $studentBatches,
            'batchYear' => $batchYear,
            'companyData' => $companyData
        ];

        $this->view('admin/dashboard', $data);
    }

    public function company() //View main company list - Ruchira
    {
        $companyList = $this->companyModel->getCompanyList();

        $data = [
            'company_list' => $companyList
        ];

        $this->view('admin/company', $data);
    }

    public function mainCompanyDetails($user_id = NULL, $blacklist = NULL) //View company main details - Ruchira
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //update Company Details
            stripTags();
            $data = [
                'user_id' => $user_id,
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'contact' => trim($_POST['contact']),
                'company_name' => trim($_POST['company_name']),
                'old_email' => trim($_POST['old_email'])
            ];

            //Check for User Availability with the same email
            $user = $this->userModel->getUserByEmail(trim($_POST['email']));

            if ($user && $user->email != trim($_POST['old_email'])) {
                flashMessage('main_details_msg', 'Entered Email is already available, Please check again!', 'danger-alert');
                redirect('admin/main-company-details/' . $user_id);
            }

            $this->companyModel->updateMainCompanyDetails($data);
            flashMessage('main_details_msg', 'Company Details Updated Successfully!');
            redirect('admin/main-company-details/' . $user_id);
        } else {

            //Get the companyID
            $companyID = $this->userModel->getCompanyUserId($user_id);

            $year = $_SESSION['batchYear'];
            $recruitCount = $this->adminModel->getRecruitCountByYear($year, $companyID);
            $internCount = $this->adminModel->getInternCountByYear($year, $companyID);
            $adCount = $this->adminModel->getAdCountByYear($year, $companyID);

            if ($internCount->total_intern_count == NULL) {
                $internTotal = 0;
            } else {
                $internTotal = $internCount->total_intern_count;
            }

            //Check whether a company have posted any advertisements
            $advertisementDetails = $this->adminModel->getAdvertisementCountByCompany($companyID);

            if ($advertisementDetails->advertisement_count == 0) {
                //Can delete the company
                $elementStatus = "";
                $elementMsg = "Delete Company? Press here";
            } else {

                $elementStatus = "disabled";
                $elementMsg = "Cannot delete: Company has posted advertisements";
            }


            //view main comapny details
            $companyDetails = $this->companyModel->mainCompanyDetails($user_id);
            $account_status = $this->userModel->getUserAccountStatus($user_id);

            if ($user_id != NULL && $blacklist == NULL) {
                $data = [
                    'username' => $companyDetails->username,
                    'user_id' => $companyDetails->user_id,
                    'company_name' => $companyDetails->company_name,
                    'contact' => $companyDetails->contact,
                    'email' => $companyDetails->email,
                    'account_status' => $account_status->account_status,
                    'modal_class' => 'hide-element',
                    'element_status' => $elementStatus,
                    'element_msg' => $elementMsg,
                    'recruit_count' => $recruitCount,
                    'intern_count' => $internTotal,
                    'ad_count' => $adCount
                ];

                $this->view('admin/viewCompany', $data);
            } else if ($user_id != NULL && $blacklist == 'delete') {
                $data = [
                    'username' => $companyDetails->username,
                    'user_id' => $companyDetails->user_id,
                    'company_name' => $companyDetails->company_name,
                    'contact' => $companyDetails->contact,
                    'email' => $companyDetails->email,
                    'account_status' => $account_status->account_status,
                    'modal_class' => '',
                    'element_status' => $elementStatus,
                    'element_msg' => $elementMsg,
                    'recruit_count' => $recruitCount,
                    'intern_count' => $internTotal,
                    'ad_count' => $adCount
                ];
                $this->view('admin/viewCompany', $data);
            } else {
                redirect('admin/company');
            }
        }
    }

    //Deactivate or re-activate a Company and Student- Admin - Ruchira
    public function updateUserAccountStatus($userType = NULL, $user_id = NULL)
    {
        if ($user_id != NULL || $userType != NULL) {

            if ($this->userModel->checkForUserById($user_id)) {
                //user exists and can deactivate or activate

                $account_status = trim($_POST['account_status']);
                $this->userModel->updateUserAccountStatusById($user_id, $account_status);

                if ($userType == 'company') {
                    flashMessage('company_list_msg', 'Company Account Status Changed Successfully!');
                    redirect('admin/main-company-details/' . $user_id);
                } else {
                    flashMessage('main_details_msg', 'Student Account Status Changed Successfully!');
                    redirect('admin/main-student-details/' . $user_id);
                }
            } else {
                //user does not exist
                if ($userType == 'company') {
                    flashMessage('company_list_msg', 'Company does not exist, Please check again!', 'danger-alert');
                    redirect('admin/company');
                } else {
                    flashMessage('student_batch_msg', 'Student does not exist, Please check again!', 'danger-alert');
                    redirect('admin/student');
                }
            }
        } else {
            if ($userType == 'company') {
                redirect('admin/company');
            } else {
                redirect('admin/student');
            }
        }
    }

    //deactivated Companies  same as blacklisted companies
    // INcase of having advertisements
    public function deactivatedCompanies($userID = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //DELETE COMPANY
            $this->companyModel->deleteCompany($userID);
            redirect('admin/company');
        } else {
            //Display Deactivated Companies
            $deactivatedCompanies = $this->companyModel->getDeativatedCompanyList();
            $data = [
                'deactivated_companies' => $deactivatedCompanies
            ];
            $this->view('admin/deactivatedCompanies', $data);
        }
    }

    public function student($pg = NULL, $year = NULL)
    {
        //Get Batch List and respective student count of each IS and CS
        $batchList = $this->studentModel->getStudentBatches();
        if ($pg != NULL && $year != NULL) {
            //View Student Batch Model
            $data = [
                'add_modal_class' => 'hide-element',
                'change_access_modal_class' => 'hide-element',
                'view-modal-class' => '',
                'batch_list' => $batchList,
                'batch_year' => $year
            ];
            $this->view('admin/studentBatches', $data);
        } else {
            //Student Batches

            $data = [
                'add_modal_class' => 'hide-element',
                'change_access_modal_class' => 'hide-element',
                'view-modal-class' => 'hide-element',
                'batch_list' => $batchList
            ];

            $this->view('admin/studentBatches', $data);
        }
    }

    //Get Main Student List-Admin - Ruchira 
    public function studentList($year = NULL, $stream = NULL)
    {
        if ($year == NULL || $stream == NULL) {
            redirect('admin/student'); //If no value is passed for atleast one of the variables
        }

        $data = [
            'batch_year' => $year,
            'stream' => $stream
        ];

        $studentList = $this->studentModel->getStudentList($data);

        $data = [
            'batch_year' => $year,
            'stream' => $stream,
            'student_list' => $studentList
        ];

        $this->view('admin/studentList', $data);
    }

    // Update Main student Details - PDC
    //Update Main Student Details -PDC - Ruchira
    public function mainStudentDetails($user_id = NULL)
    {
        if ($user_id != NULL) {

            $batch_list = $this->studentModel->getStudentBatches();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                stripTags();
                $data = [
                    'user_id' => $user_id,
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'reg_num' => trim($_POST['registration_number']),
                    'index_num' => trim($_POST['index_number']),
                    'batch_year' => trim($_POST['batch_year']),
                    'stream' => trim($_POST['stream']),
                    'old_email' => trim($_POST['old_email'])
                ];

                //Check for User Availability with the same email
                $user = $this->userModel->getUserByEmail(trim($_POST['email']));

                if ($user && $user->email != trim($_POST['old_email'])) {
                    flashMessage('main_details_msg', 'Entered Email is already available, Please check again!', 'danger-alert');
                    redirect('admin/main-student-details/' . $user_id);
                }
                $this->studentModel->updateMainStudentDetails($data);
                flashMessage('main_details_msg', 'Student Details Updated Successfully!');
                redirect('admin/main-student-details/' . $user_id);
            } else {
                //Displaying Data
                $account_status = $this->userModel->getUserAccountStatus($user_id);
                $studentDetails = $this->studentModel->getMainStudentDetails($user_id);
                $data = [
                    'username' => $studentDetails->username,
                    'registration_number' => $studentDetails->registration_number,
                    'index_number' => $studentDetails->index_number,
                    'email' => $studentDetails->email,
                    'user_id' => $user_id,
                    'batch_list' => $batch_list,
                    'std_batch' => $studentDetails->batch_year,
                    'stream' => $studentDetails->stream,
                    'account_status' => $account_status->account_status
                ];
                $this->view('admin/studentDetails', $data);
            }
        } else {
            redirect('admin/student');
        }
    }

    public function pdcStaff($pg = NULL, $userID = NULL)
    {
        $staff = $this->adminModel->getPdcStaff();
        if ($pg == 'view' && $userID != NULL) {

            $userDetails = $this->adminModel->getUserDetails($userID);

            $data = [
                'staff' => $staff,
                'updateModelBox' => '',
                'username' => $userDetails->username,
                'useremail' => $userDetails->email,
                'userID' => $userDetails->user_id

            ];
        } elseif ($pg == 'update' && $userID != NULL) {
            # POST REQUEST TO UPDATE PDC USER
            $data = [
                'userID' => $userID,
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email'])
            ];

            $this->adminModel->updateStaff($data);
            flashMessage('pdcStaffMsg', 'Member details updated successfully!');
            redirect('admin/pdc-staff');
        } elseif ($pg == 'delete' && $userID != NULL) {
            # DELETE PDC STAFF MEMBERS
            $this->adminModel->deleteStaff($userID);
            redirect('admin/pdc-staff');
        } else {

            $data = [
                'staff' => $staff,
                'updateModelBox' => 'hide-element',
                'username' => '',
                'useremail' => '',
                'userID' => '',
            ];
        }
        $this->view('admin/pdcStaff', $data);
    }

    public function complaint($complaintID = NULL, $userID = NULL)
    {
        if ($complaintID != NULL && $userID != NULL) {
            //View Specific complaint
            //Get complaint user details
            $userDetails =  $this->userModel->getUserByUserID($userID);
            $complaintDetails = $this->adminModel->getComplaintDetails($complaintID);

            if ($userDetails->user_role == 'student') {
                //Student Complaint
                //Get student details
                $studentID = $this->userModel->getStudentUserId($userID);
                $studentDetails = $this->userModel->getStudentDetails($studentID);
                $data = [
                    'reference_number' => $complaintDetails->reference_number,
                    'complaintID' => $complaintDetails->complaint_id,
                    'description' => $complaintDetails->description,
                    'date' => $complaintDetails->created_at,
                    'subject' => $complaintDetails->subject,
                    'status' => $complaintDetails->status,
                    'username' => $userDetails->username,
                    'additionalInputLabel' => 'Index Number',
                    'additionalInputValue' => $studentDetails->index_number,
                    'email' => $userDetails->email,
                ];
            } else {
                //Company Complaint
                //Get Company details
                $companyID = $this->userModel->getCompanyUserId($userID);
                $companyDetails = $this->userModel->getCompanyDetails($companyID);

                $data = [
                    'reference_number' => $complaintDetails->reference_number,
                    'complaintID' => $complaintDetails->complaint_id,
                    'description' => $complaintDetails->description,
                    'date' => $complaintDetails->created_at,
                    'subject' => $complaintDetails->subject,
                    'status' => $complaintDetails->status,
                    'username' => $userDetails->username,
                    'additionalInputLabel' => 'Company Name',
                    'additionalInputValue' => $companyDetails->company_name,
                    'email' => $userDetails->email,
                ];
            }

            $this->view('admin/viewComplaint', $data);
        } else {
            //View Complaints List
            $complaintList = $this->adminModel->getComplaintList();
            $data = [
                'complaintList' => $complaintList
            ];

            $this->view('admin/complaintList', $data);
        }
    }

    public function updateComplaintStatus($complaintID = NULL)
    {
        if ($complaintID == NULL) {
            redirect('admin/complaint');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'complaintID' => $complaintID,
                'status' => trim($_POST['status'])
            ];

            $this->adminModel->updateComplaintStatus($data);
            flashMessage('complaintMsg', 'Complaint status updated successfully!');
            redirect('admin/complaint');
        } else {
            redirect('admin/complaint');
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Strip Tags in URL
            stripTags();

            $data = [
                'oldPassword' => trim($_POST['user_old_password']),
                'newPassword' =>  trim($_POST['user_new_password']),
                'confirmPassword' =>  trim($_POST['user_confirm_password']),
                'userID' =>  trim($_POST['user_id']),
                'input_class' => ''
            ];

            //Check Whether the stored password is same as old password input value
            $userDetails = $this->userModel->getUserByUserID($data['userID']);
            $storedPassword = $userDetails->password;

            if (password_verify($data['oldPassword'], $storedPassword)) {
                #Password Match
                // Hash Password
                $hashPassword = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                //Update Password
                $data = [
                    'password' => $hashPassword,
                    'user_id' => $data['userID']
                ];
                $this->registerModel->updatePassword($data);
                flashMessage('password_changed', 'Password changed successfully!', 'success-alert');
                redirect('profiles/view-profile-details');
            } else {
                #Password Does not match
                flashMessage('password_changed_error', 'The password you entered is incorrect. Please try again', 'danger-alert');
                redirect('admin/change-password');
            }
        } else {
            $this->view('admin/changePassword');
        }
    }


    public function advertisements()
    {
        $advertisementList = $this->advertisementModel->getAdvertisementsList();

        $data = [
            'advertisementList' => $advertisementList
        ];

        $this->view('admin/advertisementList', $data);
    }

    public function report()
    {
        $this->view('admin/report');
    }

    public function getCompanyRegistrations($year = NULL)
    {


        if ($year != NULL) {
            // All the companies by Year
            $result = $this->adminModel->getCompanyByRegisteredYear($year);
            $count = $result['count'];
            $allCompanies = $result['result'];
            $data = [
                'allCompanies' => $allCompanies,
                'count' => $count . ' Companies',
                'countLabel' => 'Total Companies Registered in the year ' . $year,
                'downloadBtnHref' => URLROOT . 'admin/companyRegReport/' . $year
            ];
            $this->view('admin/companyRegistration', $data);
        } else {
            // All the companies
            $result = $this->adminModel->getAllCompanies();
            $count = $result['count'];
            $allCompanies = $result['result'];

            $data = [
                'allCompanies' => $allCompanies,
                'count' => $count . ' Companies',
                'countLabel' => 'Total Companies Registerd up to date : ',
                'downloadBtnHref' => URLROOT . 'admin/companyRegReport/'
            ];
            $this->view('admin/companyRegistration', $data);
        }
    }

    public function companyRegReport($year = NULL) //Download company registration report
    {
        $templatePath = (dirname(APPROOT)) . '\public\templates\companyRegTemplate.php';
        $currentDate = date('Y-m-d');
        $currentDateTime = date('Y-m-d H:i:s');

        if ($year != NULL) {
            // All the companies by Year
            $result = $this->adminModel->getCompanyByRegisteredYear($year);
            $count = $result['count'];
            $allCompanies = $result['result'];
            $pdf = new PdfHandler();

            $yearLabel = 'Total Companies Registerd in the year of - ' . $year;
            $pdf->companyRegistrations($allCompanies, $count, $yearLabel, $templatePath, $currentDateTime);
        } else {

            // All the companies
            $result = $this->adminModel->getAllCompanies();
            $count = $result['count'];
            $allCompanies = $result['result'];
            $pdf = new PdfHandler();
        }


        $yearLabel = 'Total Companies Registerd up to date - ' . $currentDate;

        $pdf->companyRegistrations($allCompanies, $count, $yearLabel, $templatePath, $currentDateTime);
    }

    public function getAdvertisementReports($year = NULL)
    {

        if ($year != NULL) {
            #Year provided
            //Filter by the current Batch

            $results = $this->adminModel->getAdvertisements($year);
            $advertisementList = $results['result'];
            $count = $results['count'];

            $studentBatches = $this->adminModel->getStudentBatches();

            $data = [
                'selectedBatchYear' => $year,
                'studentBatches' => $studentBatches,
                'advertisementList' => $advertisementList,
                'count' => $count,
                'downloadBtnHref' => URLROOT . 'admin/advertisementByBatchYearPdf/' . $year
            ];
            $this->view('admin/advertisementReports', $data);
        } else {
            //Filter by the current Batch
            $year = $_SESSION['batchYear'];

            $results = $this->adminModel->getAdvertisements($year);
            $advertisementList = $results['result'];
            $count = $results['count'];


            $studentBatches = $this->adminModel->getStudentBatches();

            $data = [
                'selectedBatchYear' => $year,
                'studentBatches' => $studentBatches,
                'advertisementList' => $advertisementList,
                'count' => $count,
                'downloadBtnHref' => URLROOT . 'admin/advertisementByBatchYearPdf/' . $year
            ];
            $this->view('admin/advertisementReports', $data);
        }
    }


    public function advertisementByBatchYearPdf($year = NULL) //Download advertisements list by year report
    {
        $templatePath = (dirname(APPROOT)) . '\public\templates\AdByBatchYearTemplate.php';
        $currentDateTime = date('Y-m-d H:i:s');


        if ($year != NULL) {
            // All the advertisements by Year
            $result = $this->adminModel->getAdvertisements($year);
            $count = $result['count'];
            $advertisementList = $result['result'];

            $pdf = new PdfHandler();

            $yearLabel = 'Total Advertisements listed in the year of ' . $year;
            $pdf->adsByBatchYear($advertisementList, $count, $yearLabel, $templatePath, $currentDateTime);
        } else {
            redirect('admin/get-advertisement-reports');
        }
    }

    public function getStudentRegistrations($year = NULL)
    {
        $studentBatches = $this->adminModel->getStudentBatches();

        if ($year != NULL) {
            // All the Students by batch Year
            $result = $this->adminModel->getStudentByRegisteredYear($year);
            $count = $result['count'];
            $allStudents = $result['result'];
            $data = [

                'selectedBatchYear' => $year,
                'studentBatches' => $studentBatches,
                'studentList' => $allStudents,
                'count' => $count,
                'downloadBtnHref' => URLROOT . 'admin/studentRegReport/' . $year
            ];
            $this->view('admin/studentRegistration', $data);
        } else {

            $year = $_SESSION['batchYear'];
            // All the students by current batch year
            $result = $this->adminModel->getStudentByRegisteredYear($year);
            $count = $result['count'];
            $allStudents = $result['result'];

            $data = [
                'selectedBatchYear' => $year,
                'studentBatches' => $studentBatches,
                'studentList' => $allStudents,
                'count' => $count,
                'downloadBtnHref' => URLROOT . 'admin/studentRegReport/'
            ];
            $this->view('admin/studentRegistration', $data);
        }
    }

    public function studentRegReport($year = NULL) //Download company registration report
    {
        $templatePath = (dirname(APPROOT)) . '\public\templates\studentRegTemplate.php';
        $currentDateTime = date('Y-m-d H:i:s');

        if ($year != NULL) {
            // All the companies by Year
            $result = $this->adminModel->getStudentByRegisteredYear($year);
            $count = $result['count'];
            $studentList = $result['result'];
            $pdf = new PdfHandler();

            $pdf->studentRegistrations($studentList, $count, $templatePath, $currentDateTime, $year);
        } else {

            $year = $_SESSION['batchYear'];
            // All the companies
            $result = $this->adminModel->getStudentByRegisteredYear($year);
            $count = $result['count'];
            $studentList = $result['result'];
            $pdf = new PdfHandler();
            $pdf->studentRegistrations($studentList, $count, $templatePath, $currentDateTime, $year);
        }
    }

    public function getRoundReports($batchYear = NULL, $round = NULL)
    {
        $studentBatches = $this->adminModel->getStudentBatches();


        if ($batchYear == NULL && $round == NULL) {
            //default view with current batch year and round 1
            $batchYear = $_SESSION['batchYear'];
            $round = 1;
        }


        $data = [
            'batchYear' => $batchYear,
            'round' => $round,
            'stream' => 'IS'
        ];

        //IS Student List
        $studentRequestsIS = $this->requestModel->getStudentRequestsByRound($data);

        // Total IS Studetn Requests
        $studentRequestsISCount = $this->adminModel->getStudentRequestsByRoundCount($data);

        // Recruited Student List
        $studentRequestsISRecruitedCount = $this->adminModel->getStudentRequestsByRoundRecruitCount($data);

        $data = [
            'batchYear' => $batchYear,
            'round' => $round,
            'stream' => 'CS'
        ];

        //CS Student List
        $studentRequestsCS = $this->requestModel->getStudentRequestsByRound($data);

        // Total IS Studetn Requests
        $studentRequestsCSCount = $this->adminModel->getStudentRequestsByRoundCount($data);

        // Recruited Student List
        $studentRequestsCSRecruitedCount = $this->adminModel->getStudentRequestsByRoundRecruitCount($data);

        $data = [
            'round' => $round,
            'studentRequestsIS' => $studentRequestsIS,
            'studentRequestsCS' => $studentRequestsCS,
            'selectOptionStatus' => 'selected', //For Round 1 and Round 2
            'studentBatches' => $studentBatches,
            'batchYear' => $batchYear,
            'ISCount' => $studentRequestsISCount,
            'ISRecruitedCount' => $studentRequestsISRecruitedCount,
            'CSCount' => $studentRequestsCSCount,
            'CSRecruitedCount' => $studentRequestsCSRecruitedCount
        ];

        $this->view('admin/reportRound', $data);
    }

    public function reportRound($round = NULL)
    {
        $studentBatches = $this->adminModel->getStudentBatches();


        $batchYear = $_SESSION['batchYear'];

        if ($round == 1 || $round == 2) {
            $data = [
                'batchYear' => $batchYear,
                'round' => $round,
                'stream' => 'IS'
            ];

            $studentRequestsIS = $this->requestModel->getStudentRequestsByRound($data);

            $data = [
                'batchYear' => $batchYear,
                'round' => $round,
                'stream' => 'CS'
            ];

            $studentRequestsCS = $this->requestModel->getStudentRequestsByRound($data);

            $data = [
                'round' => $round,
                'studentBatches' => $studentBatches,
                'studentRequestsIS' => $studentRequestsIS,
                'studentRequestsCS' => $studentRequestsCS,
                'selectOptionStatus' => 'selected' //For Round 1 and Round 2
            ];

            $this->view('admin/reportRound', $data);
        } else {

            $batchYear = $_SESSION['batchYear'];

            $data = [
                'batchYear' => $batchYear,
                'round' => $round,
                'stream' => 'IS'
            ];

            $studentRequestsIS = $this->requestModel->getStudentRequestsByRound($data);

            $data = [
                'batchYear' => $batchYear,
                'round' => $round,
                'stream' => 'CS'
            ];

            $studentRequestsCS = $this->requestModel->getStudentRequestsByRound($data);

            $data = [
                'round' => $round,
                'studentBatches' => $studentBatches,
                'studentRequestsIS' => $studentRequestsIS,
                'studentRequestsCS' => $studentRequestsCS,
                'selectOptionStatus' => 'selected' //For Round 1 and Round 2
            ];
            $this->view('admin/reportRound', $data);
        };
    }

    // Download round reports
    public function downloadRoundReport($batchYear = NULL, $round = NULL, $stream = NULL)
    {
        $templatePath = (dirname(APPROOT)) . '\public\templates\studentsRoundRepTemplate.php';
        $currentDateTime = date('Y-m-d H:i:s');

        if ($batchYear != NULL && $round != NULL && $stream != NULL) {

            if ($stream == 'IS') {
                $data = [
                    'batchYear' => $batchYear,
                    'round' => $round,
                    'stream' => 'IS'
                ];
            } else {
                $data = [
                    'batchYear' => $batchYear,
                    'round' => $round,
                    'stream' => 'CS'
                ];
            }
            //Student List
            $studentList = $this->requestModel->getStudentRequestsByRound($data);
            // Total IS Studetn Requests
            $studentRequestsCount = $this->adminModel->getStudentRequestsByRoundCount($data);
            // Recruited Student List
            $studentRequestsRecruitedCount = $this->adminModel->getStudentRequestsByRoundRecruitCount($data);

            $pdf = new PdfHandler();
            $pdf->studentRoundReport($studentList, $studentRequestsCount, $studentRequestsRecruitedCount, $templatePath, $currentDateTime, $batchYear, $stream, $round);
        } else {
            // redirect('pdc/get-round-reports');\
            echo 'error';
        }
    }

    public function changeAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {



            //Check for User
            $user_id = $this->userModel->getUserId(trim($_POST['email']));

            if ($user_id) {
                //User available already -  Cant register
                flashMessage('adminRegMsg', 'Entered email is already in use, please try a different email', 'danger-alert');
                redirect('admin/change-admin');
            }

            //Random Password
            $password = generatePassword();

            // Hash Password
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $email = new Email();

            if ($email->sendAdminEmail(trim($_POST['email']), $password, $_POST['username'])) {
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => $hashPassword,
                    'user_role' => 'admin',
                    'system_access' => 1
                ];
                //Execute
                $this->registerModel->registerUser($data);

                flashMessage('adminRegMsg', 'New Admin registered successfully!');
                redirect('profiles/view-profile-details');
            } else {
                flashMessage('adminRegMsg', 'Email was not sent due to an error. Please try sending it again later', 'danger-alert');
                redirect('admin/change-admin');
            }
        } else {
            $this->view('admin/changeAdmin');
        }
        // $data = [
        //     'admin' => $this->adminModel->getAdmin()
        // ];
    }
}





    // public function viewcomplaint() //default method and view
    // {
    //     $this->view('admin/viewComplaint');
    // }


    // public function viewbatches() //default method and view
    // {
    //     $this->view('admin/viewBatches');
    // }

    // public function viewstudentlist() //default method and view
    // {
    //     $this->view('admin/viewStudentList');
    // }

    // public function viewstudent() //default method and view
    // {
    //     $this->view('admin/viewStudent');
    // }

    // public function viewpdcstaff() //default method and view
    // {
    //     $staff = $this->adminModel->getstaffdetails();
    //     $data = [
    //         'staff' => $staff,
    //     ];
    //     $this->view('admin/viewPdcStaff', $data);
    // }

    // public function viewpdcuser($id) //default method and view
    // {
    //     $staff = $this->adminModel->getuserdetails($id);
    //     $data = [
    //         'staff' => $staff,
    //     ];
    //     $this->view('admin/viewPdcUser', $data);
    // }

    // public function report() //default method and view
    // {
    //     $this->view('admin/report');
    // }

    // public function registrationreport() //default method and view
    // {
    //     $this->view('admin/registrationReport');
    // }

    // public function advertisementreport() //default method and view
    // {
    //     $this->view('admin/advertisementReport');
    // }

    // public function viewprofile() //default method and view
    // {
    //     $this->view('admin/updateProfile');
    // }

    // public function addpdcuser()
    // {


    //     // Check if POST
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         // Strip Tags
    //         stripTags();



    //         $data = [
    //             'username' => trim($_POST['name']),
    //             'email' => trim($_POST['email']),
    //             'password' => trim($_POST['name']),
    //             'hashed_password' => '',
    //             'username_err' => '',
    //             'email_error' => '',
    //         ];

    //         if (empty($data['username'])) {
    //             $data['username_err'] = 'Please enter a username';
    //         }

    //         if (empty($data['email'])) {
    //             $data['email_err'] = 'Plase enter a email';
    //         }

    //         if (empty($data['username_err'] && $data['email_err'])) {
    //             // Hash Password
    //             $data['hashed_password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    //             if ($this->adminModel->addStaff($data)) {
    //                 redirect('admin/addPdcUser');
    //             } else {
    //                 die('Something went wrong');
    //             }
    //         } else {
    //             //load with errors
    //             $this->view('admin/addPdcUser', $data);
    //         }

    //         //     if ($user_id) {
    //         //         //User available -  Cant register
    //         //         $data = [
    //         //             'username' => trim($_POST['username']),
    //         //             'email' => trim($_POST['email']),
    //         //             'email_error' => '*Email already exists! Please check again',
    //         //             'credential_error' => '',
    //         //         ];
    //         //         //$this->view('pdc/registerStudent', $data);
    //         //     } else {
    //         //         //Check for Index Numbers and Reg Numbers duplication before adding to DB
    //         //         if ($this->studentModel->checkIndexNumber(trim($_POST['index_number'])) || $this->studentModel->checkRegistrationNumber(trim($_POST['registration_number']))) {
    //         //             $data = [
    //         //                 'username' => trim($_POST['username']),
    //         //                 'email' => trim($_POST['email']),
    //         //                 'registration_number' => trim($_POST['registration_number']),
    //         //                 'index_number' => trim($_POST['index_number']),
    //         //                 'email_error' => '',
    //         //                 'year' => $year,
    //         //                 'stream' => $stream,
    //         //                 'credential_error' => '*Either Registration Number or Index Number already exists! Please check again '
    //         //             ];
    //         //             $this->view('pdc/registerStudent', $data);
    //         //         } else {
    //         //             //Random Password
    //         //             $password = generatePassword();

    //         //             // Hash Password
    //         //             $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    //         //             $email = new Email();

    //         //             if ($email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username'])) {
    //         //                 $data = [
    //         //                     'username' => trim($_POST['username']),
    //         //                     'email' => trim($_POST['email']),
    //         //                     'password' => $hashPassword,
    //         //                     'user_role' => 'student'
    //         //                 ];

    //         //                 //Execute
    //         //                 $this->registerModel->registerUser($data);

    //         //                 //Get that User_Id
    //         //                 $user_id = $this->userModel->getUserId($data['email']);
    //         //                 $data = [
    //         //                     'user_id' => $user_id,
    //         //                     'registration_number' => trim($_POST['registration_number']),
    //         //                     'index_number' => trim($_POST['index_number']),
    //         //                     'stream' => trim($_POST['stream']),
    //         //                     'batch_year' => trim($_POST['year'])
    //         //                 ];
    //         //                 $email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username']);
    //         //                 $this->registerModel->registerStudent($data);
    //         //                 flashMessage('std_register_msg', 'Student Registered Successfully!');
    //         //                 redirect('register/register-student/' . $year . '/' . $stream);
    //         //             } else {
    //         //                 flashMessage('std_register_msg', 'Error Occured!, Email is not sent', 'danger-alert');
    //         //                 redirect('register/register-student/' . $year . '/' . $stream);
    //         //             }
    //         //         }
    //         //     }
    //     } else {

    //         $data = [
    //             'username' => '',
    //             'email' => '',
    //             'password' => '',
    //             'hashed_password' => '',
    //             'username_err' => '',
    //             'email_error' => '',
    //         ];

    //         // Load View
    //         $this->view('admin/addPdcUser', $data);
    //     }
    // }