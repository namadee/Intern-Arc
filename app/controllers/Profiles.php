<?php

class Profiles extends BaseController
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index() //default method and view
    {
        $this->view('error');
    }

    //View - Main User Details [User Table]
    public function viewProfile() 
    {
        $email = $_SESSION['user_email'];
        $userDetails = $this->userModel->getUserByEmail($email);

        $data = [
            'username' => $userDetails->username,
            'email' => $userDetails->email,
            'user_id' => $userDetails->user_id
        ];

        $this->view('admin/adminProfile', $data);
    }

    //Update - Main User Details [User Table]
    public function updateProfile($userId)
    {

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'user_id' => $userId
            ];

            //Execute
            if ($this->userModel->updateUserDetails($data)) {

                // Redirect
                redirect('admin/view-profile');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function viewCompanyProfile(){

    }

    public function viewStudentProfile(){
        
    }

}
