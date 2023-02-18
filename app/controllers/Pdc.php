<?php

class Pdc extends BaseController
{

    public $userModel, $registerModel, $companyModel, $studentModel;

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
        $this->studentModel = $this->model('Student');
    }

    public function index() //Load PDC Dashboard
    {
        $this->view('pdc/dashboard');
    }

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


    public function setRoundDurations()
    {
        $this->view('pdc/setRoundDuration');
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

                $studentDetails = $this->studentModel->getMainStudentDetails($user_id);
                $data = [
                    'username' => $studentDetails->username,
                    'registration_number' => $studentDetails->registration_number,
                    'index_number' => $studentDetails->index_number,
                    'email' => $studentDetails->email,
                    'user_id' => $user_id,
                    'batch_list' => $batch_list,
                    'std_batch' => $studentDetails->batch_year,
                    'stream' => $studentDetails->stream
                ];
                $this->view('pdc/studentDetails', $data);
            }
        } else {
            redirect('students/manage-student');
        }
    }


    //Delete a Student -PDC - Ruchira
    //Delete this student straigly from user_tbl and automatically from student_tbl
    public function deleteStudent($year = NULL, $stream = NULL, $user_id = NULL)
    {
        if ($user_id != NULL && $year != NULL && $stream != NULL) {

            if ($this->userModel->checkForUserById($user_id)) {
                //user exists and can delete
                $this->studentModel->deleteStudent($user_id);
                flashMessage('student_list_msg', 'Student Deleted Successfully!');
                redirect('pdc/student-list/' . $year . '/' . $stream);
            } else {
                //user does not exist
                flashMessage('student_list_msg', 'Student does not exist, Please check again!');
                redirect('pdc/student-list/' . $year . '/' . $stream);
            }
        } else {
            redirect('students/maanage-student');
        }
    }
}
