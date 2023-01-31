<?php

class Profiles extends BaseController
{

    public $userModel;
    
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index() //default method and view
    {
        $this->view('error');
    }

    //View - Main User Details [User Table]
    public function viewProfileDetails()
    {
        $email = $_SESSION['user_email'];
        $userDetails = $this->userModel->getUserByEmail($email);

        $data = [
            'username' => $userDetails->username,
            'email' => $userDetails->email,
            'user_id' => $userDetails->user_id
        ];

        //If not admin then view directed to PDC
        if ($_SESSION['user_role'] == 'admin') {
            $this->view('admin/updateProfile', $data);
        } else {
            $this->view('pdc/updateProfile', $data);
        }
    }

    //Update - Main User Details [User Table]
    public function updateProfileDetails($userId)
    {

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'user_id' => $userId
            ];

            $_SESSION['user_email'] = $data['email'];
            $_SESSION['username'] = $data['username'];

            //Execute
            if ($this->userModel->updateUserDetails($data)) {
                // Redirect
                redirect('profiles/viewProfileDetails');
                //If not admin then view directed to PDC
            } else {
                die('Something went wrong');
            }
        }
    }

    public function companyProfile()
    {
        $email = $_SESSION['user_email'];
        $userDetails = $this->userModel->getUserByEmail($email);
        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
        $company_details = $this->userModel->getCompanyDetails($companyId);

        // $company = $this->userModel->showCompanyById($companyId); //To get the Company Name

        $data = [
            'company_id' => $companyId,
            'company_name' => $company_details->company_name,
            //'company_address' => $company->company_address,
            // 'company_slogan' => $company->company_slogan,
            // 'company_email' => $company->company_email,
            // 'formAction' => 'Profiles/update-company-profile/' . $company->company_id
        ];

        $this->view('company/profile', $data);
    }

    public function showCompany()
    {
        $companyId = $this->userModel->getCompanyUserId(($_SESSION['user_id']));

        $company = $this->userModel->showCompanyById($companyId); //To get the Company Name

        $data = [
            'company_name' => $company->company_name,
            'company_address' => $company->company_address,
            'company_slogan' => $company->company_slogan,
            'company_email' => $company->company_email,
            'formAction' => 'Profiles/update-company-profile/' . $company->company_id
        ];

        $this->view('company/addCompany', $data);
    }

    public function updateCompanyProfile(){
       
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $companyId = $this->userModel->getCompanyUserId(($_SESSION['user_id']));

            $data = [
                'company_name' => trim($_POST['company_name']),
                'company_address' => trim($_POST['company_address']),
                'company_slogan' => trim($_POST['company_slogan']),
                'company_email' => trim($_POST['company_email']),
                'company_id' => $companyId
            ];

            //Execute
            if ($this->userModel->updateCompanyProfile($data)) {

                // Redirect
                redirect('Profiles/updateCompanyProfile');
            } else {
                die('Something went wrong');
            }
        } else {

            // Load View
            $this->view('company/editProfile');
        }
        
    }
    public function studentProfile()
    {
        $this->view('pdc/studentMainProfile');
    }

    public function studentCompanyProfile()
    {
        $this->view('student/companyprofile');
    }
}
