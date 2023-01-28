<?php

class Users extends BaseController
{

  public $userModel;
  public $registerModel;

  public function __construct()
  {
    $this->userModel = $this->model('User');
    $this->registerModel = $this->model('Register');
  }

  // About Page
  public function index()
  {
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
        flashMessage('email_notfound', 'Email is not found!', 'danger-alert');
        redirect('users/forgotPassword');
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

}
