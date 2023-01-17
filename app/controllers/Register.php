<?php

class Register extends BaseController
{

    public $registerModel;

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
    }


    public function index()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'contact' => trim($_POST['contact']),
                'user_role' => trim($_POST['user_role']),
                'error_class' => '',
                'error_msg' => ''
            ];


            if ($this->userModel->findUserByEmail($data['email'])) {
                //Email is already taken
                $data = [
                    'error_class' => 'signin-error-alert',
                    'error_msg' => 'Email is already registered!'
                ];
                $this->view('registerUsers', $data);
            } else {

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Execute
                if ($this->registerModel->register($data)) { //if true only it redirects
                    // Redirect to login
                    $email = new Email();
                    $email->sendLoginEmail();
                    redirect('users');
                } else {
                    $data = [
                        'error_class' => 'signin-error-alert',
                        'error_msg' => 'Oops! Something went wrong!'
                    ];
                    $this->view('registerUsers', $data);
                }
            }
        } else {
            // IF NOT A POST REQUEST

            // Init data
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'contact' => '',
                'user_role' => '',
                'error_class' => '',
                'error_msg' => ''
            ];

            // Load View
            $this->view('registerUsers', $data);
        }
    }
}
