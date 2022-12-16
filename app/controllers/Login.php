<?php

use helpers\Session;

class Login extends BaseController
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }


    public function index()
    {
        $this->view('mainLogin');
    }


    public function pdcLogin()
    {

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Strip Tags in URL
        stripTags();

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error_class' => '',
                'error_msg' => ''
            ];


            // Check for user availability
            $userDetails = $this->userModel->getUserByEmail($data['email']);
            if ($userDetails) {
                // User Found
                if ($this->userModel->login($data['email'], $data['password'])) {
                    //Password is correct
                    $this->createSession($userDetails);
                    redirect('jobroles');
                } else {
                    //Password is incorrect
                    $data = [
                        'error_class' => 'signin-error-alert',
                        'error_msg' => 'Password is incorrect!'
                    ];
                }
            } else {
                // No User found by that email
                $data = [
                    'error_class' => 'signin-error-alert',
                    'error_msg' => 'User email is not found!'
                ];
            }
            $this->view('pdc/login', $data);
        } else // If NOT a POST
        {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'error_class' => '',
                'error_msg' => ''
            ];

            // Load View
            $this->view('pdc/login', $data);
        }
    }

    public function companyLogin()
    {

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Strip Tags in URL
        stripTags();

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error_class' => '',
                'error_msg' => ''
            ];


            // Check for user availability
            $userDetails = $this->userModel->getUserByEmail($data['email']);
            if ($userDetails) {
                // User Found
                if ($this->userModel->login($data['email'], $data['password'])) {
                    //Password is correct
                    $this->createSession($userDetails);
                    redirect('advertisements');
                } else {
                    //Password is incorrect
                    $data = [
                        'error_class' => 'signin-error-alert',
                        'error_msg' => 'Password is incorrect!'
                    ];
                }
            } else {
                // No User found by that email
                $data = [
                    'error_class' => 'signin-error-alert',
                    'error_msg' => 'User email is not found!'
                ];
            }
            $this->view('company/login', $data);
        } else // If NOT a POST
        {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'error_class' => '',
                'error_msg' => ''
            ];

            // Load View
            $this->view('company/login', $data);
        }
    }

    public function adminLogin()
    {

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Strip Tags in URL
        stripTags();

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error_class' => '',
                'error_msg' => ''
            ];


            // Check for user availability
            $userDetails = $this->userModel->getUserByEmail($data['email']);
            if ($userDetails) {
                // User Found
                if ($this->userModel->login($data['email'], $data['password'])) {
                    //Password is correct
                    $this->createSession($userDetails);
                    redirect('profiles/viewprofile');
                } else {
                    //Password is incorrect
                    $data = [
                        'error_class' => 'signin-error-alert',
                        'error_msg' => 'Password is incorrect!'
                    ];
                }
            } else {
                // No User found by that email
                $data = [
                    'error_class' => 'signin-error-alert',
                    'error_msg' => 'User email is not found!'
                ];
            }
            $this->view('admin/login', $data);
        } else // If NOT a POST
        {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'error_class' => '',
                'error_msg' => ''
            ];

            // Load View
            $this->view('admin/login', $data);
        }
    }

    public function studentLogin()
    {

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Strip Tags in URL
        stripTags();

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error_class' => '',
                'error_msg' => ''
            ];


            // Check for user availability
            $userDetails = $this->userModel->getUserByEmail($data['email']);
            if ($userDetails) {
                // User Found
                if ($this->userModel->login($data['email'], $data['password'])) {
                    //Password is correct
                    $this->createSession($userDetails);
                    redirect('complaints/');
                } else {
                    //Password is incorrect
                    $data = [
                        'error_class' => 'signin-error-alert',
                        'error_msg' => 'Password is incorrect!'
                    ];
                }
            } else {
                // No User found by that email
                $data = [
                    'error_class' => 'signin-error-alert',
                    'error_msg' => 'User email is not found!'
                ];
            }
            $this->view('student/login', $data);
        } else // If NOT a POST
        {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'error_class' => '',
                'error_msg' => ''
            ];

            // Load View
            $this->view('student/login', $data);
        }
    }

    public function forgotPassword()
    {
        $this->view('forgotPassword');

    }



    public function createSession($user)
    {
        Session::setValues('user_id', $user->user_id);
        Session::setValues('username', $user->username);
        Session::setValues('user_email', $user->email);
        Session::setValues('user_role', $user->user_role);
        Session::setValues('profile_pic', $user->profile_pic);
    }


    public function logout()
    {
        Session::unset('user_id');
        Session::unset('username');
        Session::unset('user_email');
        Session::unset('user_role');
        Session::unset('profile_pic');
        redirect('users');
    }
}
