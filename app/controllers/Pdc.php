<?php

use helpers\Session;


class Pdc extends BaseController
{
    public $userModel, $registerModel, $companyModel, $studentModel, $advertisementModel, $pdcModel, $requestModel;

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
        $this->studentModel = $this->model('Student');
        $this->advertisementModel = $this->model('Advertisement');
        $this->pdcModel = $this->model('Pdc');
        $this->requestModel = $this->model('Request');
    }

    public function index($duration = NULL) //Load PDC Dashboard
    {
        $roundDetails = $this->pdcModel->getRoundPeriods();
        $companyCount = $this->companyModel->getCompanyCount();
        $studentCount = $this->studentModel->getStudentCount();

        $advertisementList = $this->advertisementModel->getAdvertisementsList();



        if ($duration != NULL) {
            $data = [
                'companyCount' => $companyCount->totalRows,
                'studentCount' => $studentCount->totalRows,
                'advertisementList' => $advertisementList,
                'duration-modal' => '',
                'roundDetails' => $roundDetails
            ];
            $this->view('pdc/dashboard', $data);
        }



        $data = [
            'companyCount' => $companyCount->totalRows,
            'studentCount' => $studentCount->totalRows,
            'advertisementList' => $advertisementList,
            'duration-modal' => 'hide-element',
            'roundDetails' => $roundDetails

        ];

        $this->view('pdc/dashboard', $data);
    }

    //Send initial company invititation
    public function sendInvitation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (empty($_FILES["invitation_attachment"]["name"])) {
                // Redirect
                $statusMsg = 'Attachment is not selected!';
                flashMessage('attachment_status', $statusMsg, 'danger-alert');
                redirect('pdc/send-invitation');
                exit;
            }


            $extension = pathinfo($_FILES["invitation_attachment"]["name"], PATHINFO_EXTENSION);
            $basename = 'companyInvitationDocument' . "." . $extension;
            $targetFilePath = 'templates/ ' . $basename;
            move_uploaded_file($_FILES["invitation_attachment"]["tmp_name"], $targetFilePath);

            $mailSubject = trim($_POST['invitation_subject']);
            $textarea = trim($_POST['invitation_body']);
            $mailBody = nl2br($textarea);
            $companyList = $this->companyModel->getCompanyList();

            foreach ($companyList as $company) {
                $email = new Email();
                $email->sendInvitationEmail($company->email, $targetFilePath, $mailSubject, $mailBody);
            }


            //Delete Attachment from server
            unlink($targetFilePath);

            // Redirect
            $statusMsg = 'Company Invitations sent successfully!';
            flashMessage('attachment_status', $statusMsg);
            redirect('pdc/send-invitation');
            exit;
        } else {


            $this->view('pdc/companyInvitation');
        }
    }


    //Get Main Student List-PDC - Ruchira 
    public function studentList($year = NULL, $stream = NULL)
    {
        if ($year == NULL || $stream == NULL) {
            redirect('students/manage-student'); //If no value is passed for atleast one of the variables
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

        $this->view('pdc/studentList', $data);
    }


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
                    redirect('pdc/main-student-details/' . $user_id);
                }
                $this->studentModel->updateMainStudentDetails($data);
                flashMessage('main_details_msg', 'Student Details Updated Successfully!');
                redirect('pdc/main-student-details/' . $user_id);
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
                $this->view('pdc/studentDetails', $data);
            }
        } else {
            redirect('students/manage-student');
        }
    }


    //Update and View Main Company Details Update

    public function mainCompanyDetails($user_id = NULL)
    {
        if ($user_id != NULL) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //update main comapny details
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
                    redirect('pdc/main-company-details/' . $user_id);
                }

                $this->companyModel->updateMainCompanyDetails($data);
                flashMessage('main_details_msg', 'Company Details Updated Successfully!');
                redirect('pdc/main-company-details/' . $user_id);
            } else {
                //view main comapny details
                $companyDetails = $this->companyModel->mainCompanyDetails($user_id);
                $account_status = $this->userModel->getUserAccountStatus($user_id);

                $data = [
                    'username' => $companyDetails->username,
                    'user_id' => $companyDetails->user_id,
                    'company_name' => $companyDetails->company_name,
                    'contact' => $companyDetails->contact,
                    'email' => $companyDetails->email,
                    'account_status' => $account_status->account_status
                ];

                $this->view('pdc/companyDetails', $data);
            }
        } else {
            redirect('companies/manage-company');
        }
    }


    //Deactivate or re-activate a Company - PDC - Ruchira
    public function updateUserAccountStatus($userType = NULL, $user_id = NULL)
    {
        if ($user_id != NULL || $userType != NULL) {

            if ($this->userModel->checkForUserById($user_id)) {
                //user exists and can deactivate or activate

                $account_status = trim($_POST['account_status']);
                $this->userModel->updateUserAccountStatusById($user_id, $account_status);

                if ($userType == 'company') {
                    flashMessage('company_list_msg', 'Company Account Status Changed Successfully!');
                    redirect('pdc/main-company-details/' . $user_id);
                } else {
                    flashMessage('main_details_msg', 'Student Account Status Changed Successfully!');
                    redirect('pdc/main-student-details/' . $user_id);
                }
            } else {
                //user does not exist
                if ($userType == 'company') {
                    flashMessage('company_list_msg', 'Company does not exist, Please check again!', 'danger-alert');
                    redirect('companies/manage-company');
                } else {
                    flashMessage('student_batch_msg', 'Student does not exist, Please check again!', 'danger-alert');
                    redirect('students/manage-student');
                }
            }
        } else {
            if ($userType == 'company') {
                redirect('companies/manage-company');
            } else {
                redirect('students/manage-student');
            }
        }
    }


    //Change Advertisement Status
    public function reviewAdvertisement($advertisement_id = NULL)
    {
        $advertisementList = $this->advertisementModel->getAdvertisementsList();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            stripTags();
            if (trim($_POST['status']) == 'rejected') {
                $data = [
                    'advertisement_id' => $advertisement_id,
                    'status' => trim($_POST['status']),
                    'round' => NULL
                ];
            } else {

                $data = [
                    'advertisement_id' => $advertisement_id,
                    'status' => trim($_POST['status']),
                    'round' => NULL
                ];
            }


            $this->advertisementModel->changeAdvertisementStatus($data);
            flashMessage('advertisement_status', 'Status Changed!');
            redirect('pdc/review-advertisement');
        } else {
            $data = [
                'advertisementList' => $advertisementList
            ];

            $this->view('pdc/advertisementList', $data);
        }
    }

    //Update Companies system access - Ruchira
    public function updateCompaniesSystemAccess()
    {

        $access = trim($_POST['access']);
        //Chnage access of the all companies
        $this->companyModel->updateCompanyAccess($access);

        flashMessage('status_msg', 'Status changed!');
        redirect('companies/manage-company');
    }

    // // 15 Delete Student Batches only if no students are there
    public function deleteStudentBatch($batch_year)
    {
        $count = $this->studentModel->studentCountOfABatch($batch_year);
        if ($count->count > 0) {
            flashMessage('student_batch_msg', 'Cannot delete batch - it still has associated students!', 'danger-alert');
        } else {
            $this->studentModel->deleteStudentBatch($batch_year);
            flashMessage('student_batch_msg', 'Batch Deleted Successfully!');
        }
        redirect('students/manage-student');
    }

    //16 set Round period - Ruchira
    public function setRoundPeriod()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $round1StartDate = trim($_POST['first_round_start']);
            $round1EndDate = trim($_POST['first_round_end']);
            $round2StartDate = trim($_POST['second_round_start']);
            $round2EndDate = trim($_POST['second_round_end']);


            $data = [
                'round_no' => 1,
                'start_date' => $round1StartDate,
                'end_date' => $round1EndDate
            ];

            //Round 1
            $this->pdcModel->setRoundPeriod($data);

            $data = [
                'round_no' => 2,
                'start_date' => $round2StartDate,
                'end_date' => $round2EndDate
            ];

            //Round 2
            $this->pdcModel->setRoundPeriod($data);
            date_default_timezone_set('Asia/Colombo');
            $currentDate = date("Y-m-d");

            $roundTableData = $this->pdcModel->getRoundPeriods();
            //Update Round Periods Details and set to session
            //Instance 2 - Round Session
            Session::setValues('roundTableData', $roundTableData);
            //Update system access of all companies and students when the round starts



            //Update system access of all companies and students when the round starts

            $isRoundOneSet = isCurrentDateWithinRound($roundTableData[0]->start_date, $roundTableData[0]->end_date);
            $isRoundTwoSet = isCurrentDateWithinRound($roundTableData[1]->start_date, $roundTableData[1]->end_date);

            if ($isRoundOneSet) {
                $roundNumber = 1;
                Session::setValues('systemAccess', 1);
                //Update Company System Access to 1 automatically when the round starts
                $this->companyModel->updateCompanyAccess(1);
                //Update all Students System Access to 1 automatically when the round starts
                $this->studentModel->updateStudentAccess(1);
            } else if ($isRoundTwoSet) {
                $roundNumber = 2;
                Session::setValues('systemAccess', 1);
                //Update Company System Access to 1 automatically when the round starts
                $this->companyModel->updateCompanyAccess(1);
                //Update all Students System Access to 1 automatically when the round starts
                $this->studentModel->updateStudentAccess(1);
            } else {
                //Either round dates are not set or currentDate in not during the round period
                $roundNumber = NULL; //No need of constraints
                Session::setValues('systemAccess', 0);
            }


            redirect('pdc');
        }
        redirect('pdc');
    }

    //17 Student requests list - Ruchira
    public function studentRequestsList($round = NULL)
    {
        $currentYear = date("Y");
        $batchYear = $currentYear - 3;


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
                'studentRequestsIS' => $studentRequestsIS,
                'studentRequestsCS' => $studentRequestsCS,
                'selectOptionStatus' => 'selected' //For Round 1 and Round 2
            ];

            $this->view('pdc/allStudentRequest', $data);
        } else {
            redirect('pdc/');
        }
    }


    //17 Student requests list - Ruchira
    // All the requests of a student
    public function requestListByStudent($round = NULL, $studentID = NULL)
    {


        if ($studentID != NULL && $round != NULL) {
            $requestsList = $this->requestModel->retrieveStudentRequestsByStudentID($round, $studentID);

            $data = [
                'round' => $round,
                'requestsList' => $requestsList
            ];

            $this->view('pdc/studentRequestsList', $data);
        } else {
            redirect('pdc/');
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
                redirect('pdc/change-password');
            }
        } else {
            $this->view('pdc/changePassword');
        }
    }
}
