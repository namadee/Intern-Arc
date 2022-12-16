<?php

class Pdc extends BaseController
{

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
    }

    public function index() //Load Dashboard
    {
        $this->view('pdc/login');
    }

    public function registerStudent() //Single Student User Registration
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            //Random Password
            $password = generatePassword();

            // Hash Password
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => $hashPassword,
                'user_role' => 'student'
            ];

            //Execute
            $this->registerModel->registerUser($data);

            //Get that User_Id
            $user_id = $this->userModel->getUserId($data['email']);
            $data = [
                'user_id' => $user_id,
                'registration_number' => trim($_POST['registration_number']),
                'index_number' => trim($_POST['index_number']),
            ];

            $email = new Email();
            $email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username']);
            $this->registerModel->registerStudent($data);
            redirect('pdc/register-student');
        } else {
            // IF NOT A POST REQUEST

            // Init data
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'user_role' => ''
            ];

            // Load View
            $this->view('pdc/registerStudent', $data);
        }
    }

    public function registerCompany() //Single Company User Registration
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();
            //Random Password
            $password = generatePassword();

            // Hash Password
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => $hashPassword,
                'user_role' => 'company'
            ];

            //Execute
            $this->registerModel->registerUser($data);

            //Get that User_Id
            $user_id = $this->userModel->getUserId($data['email']);
            $data = [
                'user_id' => $user_id,
                'company_name' => trim($_POST['company_name']),
                'contact' => trim($_POST['contact']),
            ];

            $email = new Email();
            $email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username']);
            $this->registerModel->registerCompany($data);
            redirect('pdc/register-company');
        } else {
            // IF NOT A POST REQUEST

            // Init data
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'user_role' => ''
            ];

            // Load View
            $this->view('pdc/registerCompany', $data);
        }
    }

    public function manageCompany()
    {
        // Load View
        $this->view('pdc/manageCompany');
    }

    public function manageStudent()
    {
        // Load View
        $this->view('pdc/manageStudent');
    }
}
