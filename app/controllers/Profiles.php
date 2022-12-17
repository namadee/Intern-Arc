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
    public function viewProfileDetails() 
    {
        $email = $_SESSION['user_email'];
        $userDetails = $this->userModel->getUserByEmail($email);

        $data = [
            'username' => $userDetails->username,
            'email' => $userDetails->email,
            'user_id' => $userDetails->user_id
        ];

        //If not admin then view directed to PDC
        if ($_SESSION['user_role'] == 'admin') {
            $this->view('admin/adminProfile', $data);
        }else {
            $this->view('pdc/updateProfile', $data);
        }

        
    }

    //Update - Main User Details [User Table]
    public function updateProfileDetails($userId)
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

    public function companyProfile(){
        $this->view('company/profile');
    }

    public function studentProfile(){
        $this->view('pdc/studentMainProfile');
    }

}
