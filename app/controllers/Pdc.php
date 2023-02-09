<?php

class Pdc extends BaseController
{

    public $userModel;
    public $registerModel;
    public $companyModel;

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
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

    public function test()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $textarea = trim($_POST['invitation_body']);
            $textarea_message_with_breaks = nl2br($textarea);
            $data = [
                'data' =>  $textarea_message_with_breaks

            ];
            $this->view('test', $data);
        } else {

            $data = [
                'data' =>  ''

            ];
            $this->view('test', $data);
        }
        // $extension = pathinfo($_FILES["invitation_attachment"]["name"], PATHINFO_EXTENSION);
        // $basename = 'companyInvitationDocument' . "." . $extension;
        // $targetFilePath = 'templates/ ' . $basename;
        // move_uploaded_file($_FILES["invitation_attachment"]["tmp_name"], $targetFilePath);

        // $mailSubject = trim($_POST['invitation_subject']);
        // $mailBody = trim($_POST['invitation_body']);


        // $email = new Email();
        // $email->sendInvitationEmail($company->email, $attachment, $mailSubject, $mailBody);

        // }
    }
}
