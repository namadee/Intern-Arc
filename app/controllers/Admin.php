<?php

class Admin extends BaseController
{

    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        $this->userModel = $this->model('User');
    }

    public function index() //default method and view
    {
        $this->view('admin/login');
    }


    public function viewProfile()
    {

        $userDetails = $this->userModel->getUserDetails($_SESSION['user_id']);

        $data = [
            'username' => $userDetails->username,
            'useremail' => $userDetails->email,
            'contact' => $userDetails->contact,
            'user_id' => $userDetails->user_id
        ];

        $this->view('admin/adminProfile', $data);
    }


    public function updateProfile($userId)
    {

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'contact' => trim($_POST['contact']),
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
}
