<?php

class Register extends BaseController
{
    public $userModel;
    public $registerModel;
    public $studentModel;
    public $testModel;
    //All the Registration Processes

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->testModel = $this->model('Test');
    }

    public function index()
    {
    } //Register PDC users

    public function registerStudent() //Single Student User Registration - Ruchira
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            //Check for User
            $user_id = $this->userModel->getUserId(trim($_POST['email']));

            if ($user_id) {
                //User available -  Cant register
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'registration_number' => trim($_POST['registration_number']),
                    'index_number' => trim($_POST['index_number']),
                    'email_error' => '*Email already exists! Please check again',
                    'credential_error' => ''
                ];
                $this->view('pdc/registerStudent', $data);
            } else {
                //Check for Index Numbers and Reg Numbers duplication before adding to DB
                if ($this->studentModel->checkIndexNumber(trim($_POST['index_number'])) || $this->studentModel->checkRegistrationNumber(trim($_POST['registration_number']))) {
                    $data = [
                        'username' => trim($_POST['username']),
                        'email' => trim($_POST['email']),
                        'registration_number' => trim($_POST['registration_number']),
                        'index_number' => trim($_POST['index_number']),
                        'email_error' => '',
                        'credential_error' => '*Either Registration Number or Index Number already exists! Please check again '
                    ];
                    $this->view('pdc/registerStudent', $data);
                } else {
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
                    redirect('register/register-student');
                }
            }
        } else {
            // IF NOT A POST REQUEST

            // Init data
            $data = [
                'username' => '',
                'email' => '',
                'registration_number' => '',
                'index_number' => '',
                'email_error' => '',
                'credential_error' => ''
            ];

            // Load View
            $this->view('pdc/registerStudent', $data);
        }
    }

    public function registerCompany() //Single Company User Registration - Ruchira
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            //Check for User
            $user_id = $this->userModel->getUserId(trim($_POST['email']));

            if ($user_id) {
                //User available -  Cant register
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'company_name' => trim($_POST['company_name']),
                    'contact' => trim($_POST['contact']),
                    'email_error' => '*Email already exists!'
                ];
                $this->view('pdc/registerCompany', $data);
            } else {
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
                redirect('register/register-company');
            }
        } else {
            // IF NOT A POST REQUEST

            // Init data
            $data = [
                'username' => '',
                'email' => '',
                'company_name' => '',
                'contact' => '',
                'email_error' => ''
            ];

            // Load View
            $this->view('pdc/registerCompany', $data);
        }
    }


    public function registerCompanies()
    {
        //Checks whether a file is uploaded
        if (!is_uploaded_file($_FILES['company-csv']['tmp_name'])) {
            flashMessage('upload_file_error', 'Please select a csv file to register!', 'danger-alert');
            redirect('register/register-company');
        }

        $fileName = $_FILES["company-csv"]["tmp_name"];

        if ($_FILES["company-csv"]["size"] > 0) {
            $file = fopen($fileName, "r");

            $counter = 0;

            while (($column = fgetcsv($file, 1000, ",")) !== FALSE) {

                $counter++; //To skip the header of the csv
                if ($counter > 1) {
                    //Random Password
                    $password = generatePassword();

                    // Hash Password
                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                    $data = [
                        'username' => $column[2],
                        'email' => $column[1],
                        'password' => $hashPassword,
                        'user_role' => 'company'
                    ];

                    //Execute
                    $this->registerModel->registerUser($data);

                    //Get that User_Id
                    $user_id = $this->userModel->getUserId($data['email']);

                    $data = [
                        'user_id' => $user_id,
                        'company_name' => $column[0],
                        'contact' => '0' . $column[3],
                    ];

                    $email = new Email();
                    $email->sendLoginEmail($column[1], $password, $column[2]);
                    $this->registerModel->registerCompany($data);
                }
                redirect('register/register-company');
            }
        }

        //If the upload csv is empty it gets redirected
        redirect('register/register-company');
    }

    public function registerStudents()
    {
        //Checks whether a file is uploaded
        if (!is_uploaded_file($_FILES['students-csv']['tmp_name'])) {
            flashMessage('upload_file_error', 'Please select a csv file to register!', 'danger-alert');
            redirect('register/register-student');
        }


        $fileName = $_FILES["students-csv"]["tmp_name"];

        if ($_FILES["students-csv"]["size"] > 0) {
            $file = fopen($fileName, "r");

            $counter = 0;

            while (($column = fgetcsv($file, 1000, ",")) !== FALSE) {

                $counter++; //To skip the header of the csv
                if ($counter > 1) {
                    //Random Password
                    $password = generatePassword();

                    // Hash Password
                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                    $data = [
                        'username' => $column[0],
                        'email' => $column[1],
                        'password' => $hashPassword,
                        'user_role' => 'student'
                    ];

                    //Execute
                    $this->registerModel->registerUser($data);

                    //Get that User_Id
                    $user_id = $this->userModel->getUserId($data['email']);

                    $data = [
                        'user_id' => $user_id,
                        'registration_number' => $column[2],
                        'index_number' => '0' . $column[3],
                    ];

                    $email = new Email();
                    $email->sendLoginEmail($column[1], $password, $column[0]);
                    $this->registerModel->registerStudent($data);
                }
                redirect('register/register-student');
            }
        }

        //If the upload csv is empty it gets redirected
        redirect('register/register-student');
    }

}
