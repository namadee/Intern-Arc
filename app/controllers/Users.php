<?php

class Users extends BaseController
{

  public function __construct()
  {
    $this->userModel = $this->model('User');
  }


  public function index()
  {
    $this->view('home');
  }

  public function pdcLogin()
  {

    // Check if POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'error_class' => '',
        'error_msg' => ''
      ];


      // Check for user
      if ($this->userModel->findUserByEmail($data['email'])) {
        // User Found
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);
        if ($loggedInUser) {
          //Password is correct
          $this->createUserSession($loggedInUser);
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
      // Sanitize POST
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'error_class' => '',
        'error_msg' => ''
      ];


      // Check for user
      if ($this->userModel->findUserByEmail($data['email'])) {
        // User Found
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);
        if ($loggedInUser) {
          //Password is correct
          $this->createUserSession($loggedInUser);
          redirect('advertisements');
        } else {
          //Password is incorrect
          $data = [
            'error_class' => 'main-signin-error-alert',
            'error_msg' => 'Password is incorrect!'
          ];
        }
      } else {
        // No User found by that email
        $data = [
          'error_class' => 'main-signin-error-alert',
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

  public function createUserSession($user)
  {

    $_SESSION['user_id'] = $user->user_id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['username'] = $user->username;
    $_SESSION['user_role'] = $user->user_role;
  }


  public function logout()
  {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['username']);
    unset($_SESSION['user_role']);
    session_destroy();
    redirect('users');
  }
}
