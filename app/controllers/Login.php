<?php

use helpers\Session;

class Login extends BaseController
{
    public $userModel;
    public $registerModel, $pdcModel, $companyModel, $studentModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->registerModel = $this->model('Register');
        $this->pdcModel = $this->model('Pdc');
        $this->companyModel = $this->model('Company');
        $this->studentModel = $this->model('Student');
    }

    public function index()
    {
        //Get Round Period Information each time a user logs in
        // This will trigger the function everytime someone visit the login page
        $this->getRoundPeriodDetails();

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags in URL
            stripTags();

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'error_class' => 'signin-error-hide',
                'error_msg' => '',
                'input_class' => ''
            ];


            // Check for user availability
            $userDetails = $this->userModel->getUserByEmail($data['email']);
            if ($userDetails) {
                // User Found
                if ($this->userModel->login($data['email'], $data['password'])) {
                    //Password is correct
                    $this->createSession($userDetails);
                    //Get User Role to direct them to the Dashboard
                    $userRole = Session::getUserRole();

                    switch ($userRole) {
                        case "pdc":
                            flashMessage('login_success', 'Login Successfully!');
                            redirect('pdc');
                            break;
                        case "student":
                            redirect('students');
                            break;
                        case "company":
                            redirect('companies');
                            break;
                        default:
                            redirect('admin');
                    }
                } else {
                    //Password is incorrect
                    $data = [
                        'error_class' => 'signin-error-alert',
                        'error_msg' => 'Password is incorrect!',
                        'input_class' => 'input-error'
                    ];
                }
            } else {
                // No User found by that email
                $data = [
                    'error_class' => 'signin-error-alert',
                    'error_msg' => 'User email is not found!',
                    'input_class' => 'input-error'
                ];
            }
            $this->view('mainLogin', $data);
        } else // If NOT a POST
        {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'error_class' => 'signin-error-hide',
                'error_msg' => ''
            ];

            // Load View
            $this->view('mainLogin', $data);
        }
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
        Session::unset('roundTableData');
        Session::unset('systemAccess');
        Session::destroy();
        redirect('login');
    }

    //Forgot Password - Ruchira
    public function forgotPassword()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags in URL
            stripTags();

            $data = [
                'email' => trim($_POST['email']),
                'error_class' => '',
                'error_msg' => '',
                'input_class' => ''
            ];

            // Check for user availability
            $userDetails = $this->userModel->getUserByEmail($data['email']);

            if (!$userDetails) {
                // User Not Found
                //Flash Message
                flashMessage('email_notfound', 'Email is not found!', 'danger-alert');
                redirect('login/forgotPassword');
            } else {
                //User Found
                //Send the Verification Code
                //Random Verification Code
                $verification_code = generateVerificationCode();

                $data = [
                    'email' => trim($_POST['email']),
                    'verification_code' => $verification_code
                ];

                //Store the verification code
                $this->userModel->storeVerificationCode($data);

                //Get the Username through Email
                //Send the verification code the email
                $email = new Email();
                $email->sendVerificationEmail(trim($_POST['email']), $userDetails->username, $verification_code);
            }

            $data = [
                'email' => trim($_POST['email']),
                'verification_code' => $verification_code
            ];

            $this->view('pwdVerification', $data);
        } else // If NOT a POST
        {
            // Init data
            $data = [
                'email' => '',
                'error_class' => '',
                'error_msg' => ''
            ];

            // Load View
            $this->view('forgotPassword', $data);
        }
    }
    //Verify Password - Ruchira
    public function verifyPassword()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags in URL
            stripTags();

            $data = [
                'verification_code' => trim($_POST['verification_code']),
                'error_class' => '',
                'error_msg' => '',
                'input_class' => ''
            ];

            //Store User Email
            $email = trim($_POST['email']);

            //Get the verification code from DB
            $storedVerificationCode = $this->userModel->retrieveVerificationCode($email);

            //Check whether the verification code is valid
            if ($data['verification_code'] != $storedVerificationCode) {
                //Not Valid
                flashMessage('verification_code_invalid', 'Entered verification code is invalid! Please Try Again.', 'danger-alert');
                $data = [
                    'email' => $email
                ];

                $this->view('pwdVerification', $data);
            } else {
                //Valid
                $this->userModel->updateVerificationCode($email);
                flashMessage('verification_code_success', 'Verification Successful', 'success-alert');
                $data = [
                    'email' => $email
                ];

                $this->view('updatePwd', $data);
            }
        } else // If NOT a POST
        {
            redirect('login');
        }
    }

    //Change Password - Ruchira
    public function updatePassword()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags in URL
            stripTags();

            $data = [
                'password' => trim($_POST['password']),
                'error_class' => '',
                'error_msg' => '',
                'input_class' => '',
                'email' => trim($_POST['email'])
            ];

            //Update Password
            // Hash Password
            $hashPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $userId = $this->userModel->getUserId($data['email']);
            $data = [
                'password' => $hashPassword,
                'user_id' => $userId
            ];

            if ($this->registerModel->updatePassword($data)) {
                flashMessage('password_updated', 'Password updated! Now you can login!', 'success-alert');
                redirect('login');
            }
        } else // If NOT a POST
        {
            redirect('login');
        }
    }

    //Check Round Period - Ruchira
    public function getRoundPeriodDetails()
    {


        $roundTableData = $this->pdcModel->getRoundPeriods();
        //Get Round Periods Details
        //Instance 1 - Round Session
        Session::setValues('roundTableData', $roundTableData);
        date_default_timezone_set('Asia/Colombo');
        $currentDate = date("Y-m-d");

        //Update system access of all companies and students when the round starts

        $isRoundOneSet = isCurrentDateWithinRound($roundTableData[0]->start_date, $roundTableData[0]->end_date);
        $isRoundTwoSet = isCurrentDateWithinRound($roundTableData[1]->start_date, $roundTableData[1]->end_date);

        if ($isRoundOneSet) {
            $roundNumber = 1;
            Session::setValues('systemAccess', 1);
            //Update Company System Access to 1 automatically when the round starts
            $this->companyModel->updateCompanyAccess(1);

            //Update all Students System Access to 1 automatically when the round starts
            $this->studentModel->updateStudentAccess(1);
        } else if ($isRoundTwoSet) {
            $roundNumber = 2;
            Session::setValues('systemAccess', 1);
            //Update Company System Access to 1 automatically when the round starts
            $this->companyModel->updateCompanyAccess(1);
            //Update all Students System Access to 1 automatically when the round starts
            $this->studentModel->updateStudentAccess(1);
        } else {
            //Either round dates are not set or currentDate in not during the round period
            $roundNumber = NULL; //No need of constraints
            Session::setValues('systemAccess', 0);
        }
    }
}
