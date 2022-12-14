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

    public function viewMainProfile()
    {
        $userId = $_SESSION['user_id'];

        $userDetails = $this->userModel->getUserDetails($userId);

        $data = [
            'username' => $userDetails->username,
            'useremail' => $userDetails->email,
            'contact' => $userDetails->contact,
            'user_id' => $userDetails->user_id
        ];

        $this->view('admin/adminProfile', $data);
    }


    public function updateMainProfile($userId)
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
