<?php

class Register extends BaseController
{
    public $userModel, $registerModel, $studentModel, $testModel, $companyModel;
    //All the Registration Processes

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->companyModel = $this->model('Company');
    }

    public function index()
    {
        //Register PDC users
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
                flashMessage('pdcStaffMsg', 'Entered email is already in use, please try a different email', 'danger-alert');
                redirect('admin/pdc-staff');
            } else {
                //Random Password
                $password = generatePassword();

                // Hash Password
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                $email = new Email();

                if ($email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username'])) {
                    $data = [
                        'username' => trim($_POST['username']),
                        'email' => trim($_POST['email']),
                        'password' => $hashPassword,
                        'user_role' => 'pdc',
                        'system_access' => 1
                    ];

                    //Execute
                    $this->registerModel->registerUser($data);

                    flashMessage('pdcStaffMsg', 'PDC Staff member registered successfully!');
                    redirect('admin/pdc-staff');
                }else {
                    flashMessage('pdcStaffMsg', 'Email was not sent due to an error. Please try sending it again later', 'danger-alert');
                    redirect('admin/pdc-staff');
                }
            }
        } else{
            redirect('admin/pdc-staff');
        }
    } 




    public function registerStudent($year = NULL, $stream = NULL) //Single Student User Registration - Ruchira
    {
        if ($year == NULL || $stream == NULL) {
            redirect('students/manage-student');
        }


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
                    'credential_error' => '',
                    'year' => $year,
                    'stream' => $stream
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
                        'year' => $year,
                        'stream' => $stream,
                        'credential_error' => '*Either Registration Number or Index Number already exists! Please check again '
                    ];
                    $this->view('pdc/registerStudent', $data);
                } else {
                    //Random Password
                    $password = generatePassword();

                    // Hash Password
                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                    $email = new Email();

                    if ($email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username'])) {
                        $data = [
                            'username' => trim($_POST['username']),
                            'email' => trim($_POST['email']),
                            'password' => $hashPassword,
                            'user_role' => 'student',
                            'system_access' => $_SESSION['systemAccess']
                        ];

                        //Execute
                        $this->registerModel->registerUser($data);

                        //Get that User_Id
                        $user_id = $this->userModel->getUserId($data['email']);
                        $data = [
                            'user_id' => $user_id,
                            'registration_number' => trim($_POST['registration_number']),
                            'index_number' => trim($_POST['index_number']),
                            'stream' => trim($_POST['stream']),
                            'batch_year' => trim($_POST['year'])
                        ];
                        $email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username']);
                        $this->registerModel->registerStudent($data);
                        flashMessage('std_register_msg', 'Student Registered Successfully!');
                        redirect('register/register-student/' . $year . '/' . $stream);
                    } else {
                        flashMessage('std_register_msg', 'Error Occured!, Email is not sent', 'danger-alert');
                        redirect('register/register-student/' . $year . '/' . $stream);
                    }
                }
            }
        } else {

            $data = [
                'username' => '',
                'email' => '',
                'registration_number' => '',
                'index_number' => '',
                'email_error' => '',
                'credential_error' => '',
                'year' => $year,
                'stream' => $stream
            ];

            // Load View
            $this->view('pdc/registerStudent', $data);
        }
    }

    public function registerCompany() //Single Company User Registration - Ruchira
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Update main student information/details


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

                $email = new Email();

                if ($email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username'])) {
                    $data = [
                        'username' => trim($_POST['username']),
                        'email' => trim($_POST['email']),
                        'password' => $hashPassword,
                        'user_role' => 'company',
                        'system_access' => $_SESSION['systemAccess']

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
                    $this->registerModel->registerCompany($data);
                    flashMessage('company_register_msg', 'Company Registered Successfully!');
                    redirect('register/register-company');
                } else {
                    flashMessage('company_register_msg', 'Error Occured!, Email is not sent', 'danger-alert');
                    redirect('register/register-company/');
                }
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
                        'user_role' => 'company',
                        'system_access' => $_SESSION['systemAccess']
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

        $year = trim($_POST['year']);
        $stream = trim($_POST['stream']);

        //Checks whether a file is uploaded
        if (!is_uploaded_file($_FILES['students-csv']['tmp_name'])) {
            flashMessage('upload_file_error', 'Please select a csv file to register!', 'danger-alert');
            redirect('register/register-student?year=' . $year . '&stream=' . $stream);
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
                        'user_role' => 'student',
                        'system_access' => $_SESSION['systemAccess']
                    ];

                    //Execute
                    $this->registerModel->registerUser($data);

                    //Get that User_Id
                    $user_id = $this->userModel->getUserId($data['email']);

                    $data = [
                        'user_id' => $user_id,
                        'registration_number' => $column[2],
                        'index_number' => $column[3],
                        'stream' => trim($_POST['stream']),
                        'batch_year' => trim($_POST['year'])
                    ];

                    $email = new Email();
                    $email->sendLoginEmail($column[1], $password, $column[0]);
                    $this->registerModel->registerStudent($data);
                }
            }
            redirect('register/register-student/' . $year . '/' . $stream);
        }

        //If the upload csv is empty it gets redirected
        redirect('register/register-student/' . $year . '/' . $stream);
    }


    public function resendStudentCredentials($year = NULL, $stream = NULL, $user_id = NULL) //Resend Student User Login Credentials - Ruchira
    {
        if ($year == NULL || $stream == NULL || $user_id == NULL) {
            redirect('students/manage-student');
        }
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $studentDetails = $this->studentModel->getMainStudentDetails($user_id);

            //Random Password
            $password = generatePassword();

            // Hash Password
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'user_id' =>  $studentDetails->user_id,
                'password' => $hashPassword
            ];

            $email = new Email();
            if ($email->sendLoginEmail($studentDetails->email, $password,  $studentDetails->username)) {
                //Update New Password (Only if the email is sent to the student)
                $this->registerModel->updatePassword($data);
                flashMessage('main_details_msg', 'New Login Credentials Sent Successfully!');
                redirect('pdc/main-student-details/' . $user_id);
            } else {
                flashMessage('main_details_msg', 'Error Occured!, Email is not sent', 'danger-alert');
                redirect('pdc/main-student-details/' . $user_id);
            }
        } else {
            redirect('pdc/main-student-details/' . $user_id);
        }
    }


    public function resendCompanyCredentials($user_id = NULL) //Resend Student User Login Credentials - Ruchira
    {
        if ($user_id == NULL) {
            redirect('students/manage-student');
        }
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $companyDetails = $this->companyModel->mainCompanyDetails($user_id);

            //Random Password
            $password = generatePassword();

            // Hash Password
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'user_id' =>  $companyDetails->user_id,
                'password' => $hashPassword
            ];

            $email = new Email();
            if ($email->sendLoginEmail($companyDetails->email, $password,  $companyDetails->username)) {
                //Update New Password (Only if the email is sent to the Company)
                $this->registerModel->updatePassword($data);
                flashMessage('main_details_msg', 'New Login Credentials Sent Successfully!');
                redirect('pdc/main-company-details/' . $user_id);
            } else {
                flashMessage('main_details_msg', 'Error Occured!, Email is not sent', 'danger-alert');
                redirect('pdc/main-company-details/' . $user_id);
            }
        } else {
            redirect('pdc/main-company-details/' . $user_id);
        }
    }
}
