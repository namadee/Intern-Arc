<?php

class Profiles extends BaseController
{

    public $userModel;
    public $companyModel;
    
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
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
        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
        $company_details = $this->userModel->getCompanyDetails($companyId);


        $data = [
            'company_id' => $companyId,
            'company_name' => $company_details->company_name,
            'company_address' => $company_details->company_address,
            'company_slogan' => $company_details->company_slogan,
            'company_email' => $company_details->company_email,
            'company_description' => $company_details->company_description,
            'image' => $company_details->profile_image,
            'formAction' => 'Profiles/update-company-profile/' . $company_details->company_id
        ];

        $this->view('company/profile', $data);
    }

    public function showCompanyProfile()
    {
        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
        $company_details = $this->userModel->getCompanyDetails($companyId);

        $data = [
            'company_id' => $companyId,
            'company_name' => $company_details->company_name,
            'company_address' => $company_details->company_address,
            'company_slogan' => $company_details->company_slogan,
            'company_email' => $company_details->company_email,
            'company_description' => $company_details->company_description,
            'formAction' => 'Profiles/update-company-profile/' . $company_details->company_id
        ];

        $this->view('company/editProfile', $data);
    }

    public function updateCompanyProfile(){

        $companyId = $this->userModel->getCompanyUserId(($_SESSION['user_id']));
        $company_details = $this->userModel->getCompanyDetails($companyId);
        $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));


         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            if(!isset($_FILES['file'])){
                
                $data = [
                    'company_id' => $companyId,
                    'company_name' => $company_details->company_name,
                    'company_address' => $company_details->company_address,
                    'company_slogan' => $company_details->company_slogan,
                    'company_email' => $company_details->company_email,
                    'company_description' => $company_details->company_description,
                    'image' => $profile_image_name->profile_pic,
                    'formAction' => 'Profiles/company-profile/'
                ];

                $this->view('company/editProfile', $data);
                
             }else
             {
                redirect('login');
                //check for files
 				if(count($_FILES) > 0)
 				{
                
 					//we have an image
 					$allowed[] = "image/jpeg";
 					$allowed[] = "image/png";

 					if($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed))
 					{
                      
 						$folder = "uploads/";
 						if(!file_exists($folder)){
 							mkdir($folder,0777,true);
 						}
 						$destination = $folder . $_FILES['image']['name'];
 						move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    $_POST['image'] = $destination;
 					}
                     
 					
 				}
                $data = [
                    'user_id' => $_SESSION['user_id'],
                    'profile_pic' => trim($_POST['image']),
                ];

                $this->userModel->updateProfileImage($data);


                 $data = [
                'company_name' => trim($_POST['company_name']),
                'company_address' => trim($_POST['company_address']),
                'company_slogan' => trim($_POST['company_slogan']),
                'company_email' => trim($_POST['company_email']),
                'company_description' => trim($_POST['company_description']),
                'company_id' => $companyId
            ];

            //Execute
            if ($this->companyModel->updateCompanyProfile($data)) {

                // Redirect
                redirect('Companies');
            } else {
                die('Something went wrong');
            }


             }

        } else {

            $data = [
                'company_id' => $companyId,
                'company_name' => $company_details->company_name,
                'company_address' => $company_details->company_address,
                'company_slogan' => 'Hello',
                'company_email' => $company_details->company_email,
                'company_description' => $company_details->company_description,
                'image' => $profile_image_name->profile_pic,
                'formAction' => 'Profiles/company-profile/'
            ];
    
            $this->view('company/editProfile', $data);
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
