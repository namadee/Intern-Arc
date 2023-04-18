<?php

use helpers\Session;

class Profiles extends BaseController
{
    public $userModel;
    public $companyModel;
    public $studentModel;




    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
        $this->studentModel = $this->model('Student');
    }

    public function index() //default method and view
    {
        $this->view('error');
    }


    //View - Main User Details [User Table]
    public function viewProfileDetails()
    {
        $data = [
            'username' => $_SESSION['username'],
            'email' => $_SESSION['user_email'],
            'user_id' => $_SESSION['user_id']
        ];

        $userRole = $_SESSION['user_role'];
        //based on user role , view get loaded
        switch ($userRole) {
            case "pdc":
                $this->view('pdc/updateProfile', $data);
                break;
            case "admin":
                $this->view('admin/updateProfile', $data);
                break;
            default:
                $this->view('company/mainProfile', $data);
        }
    }


    public function companyProfile()
    {
        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
        $company_details = $this->userModel->getCompanyDetails($companyId);
        $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));

        $data = [
            'company_id' => $companyId,
            'company_name' => $company_details->company_name,
            'company_address' => $company_details->company_address,
            'company_slogan' => $company_details->company_slogan,
            'company_email' => $company_details->company_email,
            'company_description' => $company_details->company_description,
            'image' => $profile_image_name->profile_pic,
            'formAction' => 'Profiles/update-company-profile/' . $company_details->company_id
        ];

        $this->view('company/profile', $data);
    }

    // public function showCompanyProfile()
    // {
    //     $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);



    //     $company_details = $this->userModel->getCompanyDetails($companyId);

    //     $data = [
    //         'company_id' => $companyId,
    //         'company_name' => $company_details->company_name,
    //         'company_address' => $company_details->company_address,
    //         'company_slogan' => $company_details->company_slogan,
    //         'company_email' => $company_details->company_email,
    //         'company_description' => $company_details->company_description,
    //         'formAction' => 'Profiles/update-company-profile/' . $company_details->company_id
    //     ];

    //     $this->view('company/editProfile', $data);
    // }

    public function updateCompanyProfile()
    {

        $companyId = $this->userModel->getCompanyUserId(($_SESSION['user_id']));
        $company_details = $this->userModel->getCompanyDetails($companyId);
        $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $statusMsg = '';

            // File upload path
            $targetDir = "img/profile-img/";
            //Change image file name - Unique Name for each user with the help of userId
            $fileName = 'user' . $_SESSION['user_id'] . '_profileimg' . rand(0, 100000);
            //Get the extension
            $extension = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
            //Full image name
            $basename   = $fileName . "." . $extension; //user56_profile_img.jpg
            //TargetPath
            $targetFilePath = $targetDir . $basename;

            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (!empty($_FILES["profile_image"]["name"])) {

                //Image Size in Bytes
                $imageSize =  $_FILES["profile_image"]["size"];

                //Check whether the uploaded image is below 500kb
                if ($imageSize >= 500000) {
                    // Redirect
                    $statusMsg = 'Sorry, Please upload an image below 500KB';
                    flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                    redirect('profiles/update-company-profile');
                    exit;
                }

                // Allow certain file formats
                $allowTypes = array('jpg', 'png', 'jpeg');

                if (in_array($fileType, $allowTypes)) {


                    //Removing old image from storage
                    //Must check if its the default img before removing
                    //If its the default img then we skip unlink part
                    if ($profile_image_name->profile_pic != 'img/profile-img/profile-icon.svg') {
                        unlink(PROFILE_IMG_PATH . $profile_image_name->profile_pic);
                    }

                    // Upload file to server
                    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {

                        // Insert image file name into database
                        $data = [
                            'user_id' => $_SESSION['user_id'],
                            'profile_pic' => $targetFilePath
                        ];

                        //Execute - Adding new Img name and Path to user_tbl
                        $this->userModel->updateProfileImage($data);

                        //To add the new photo session - top navbar profile photo
                        //Update Image Session Value
                        $_SESSION['profile_pic'] = $targetFilePath;


                        $data = [
                            'company_name' => trim($_POST['company_name']),
                            'company_address' => trim($_POST['company_address']),
                            'company_slogan' => trim($_POST['company_slogan']),
                            'company_email' => trim($_POST['company_email']),
                            'company_description' => trim($_POST['company_description']),
                            'company_id' => $companyId
                        ];

                        //Execute - Adding other details to company_tbl
                        $this->companyModel->updateCompanyProfile($data);

                        // Redirect - Profile Updared successfully
                        $statusMsg = 'Profile Uploaded Successfully';
                        flashMessage('profile_update_status', $statusMsg);
                        redirect('profiles/company-profile');
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file.";
                        flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                        redirect('profiles/update-company-profile');
                    }
                } else {
                    // Redirect
                    $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
                    flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                    redirect('profiles/update-company-profile');
                }
            } else {

                //No profile pic uploaded
                $data = [
                    'company_name' => trim($_POST['company_name']),
                    'company_address' => trim($_POST['company_address']),
                    'company_slogan' => trim($_POST['company_slogan']),
                    'company_email' => trim($_POST['company_email']),
                    'company_description' => trim($_POST['company_description']),
                    'company_id' => $companyId
                ];

                //Execute - Adding other details to company_tbl
                $this->companyModel->updateCompanyProfile($data);

                // Redirect - Profile Updated successfully
                $statusMsg = 'Profile Uploaded Successfully';
                flashMessage('profile_update_status', $statusMsg);
                redirect('profiles/company-profile');
            }
        } else {
            $data = [
                'company_id' => $companyId,
                'company_name' => $company_details->company_name,
                'company_address' => $company_details->company_address,
                'company_slogan' => 'Hello',
                'company_email' => $company_details->company_email,
                'company_description' => $company_details->company_description,
                'image' => $profile_image_name->profile_pic
            ];

            $this->view('company/editProfile', $data);
        }
    }

    public function updateProfileDetails()
    {
        $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (!empty($_FILES["upload_img"]["name"])) {

                // File upload path
                $targetDir = "img/profile-img/";
                //Change image file name - Unique Name for each user with the help of userId
                $fileName = 'user' . $_SESSION['user_id'] . '_profileimg' . rand(0, 100000);
                //Get the extension
                $extension = pathinfo($_FILES["upload_img"]["name"], PATHINFO_EXTENSION);
                //Full image name
                $basename   = $fileName . "." . $extension; //user56_profile_img.jpg
                //TargetPath
                $targetFilePath = $targetDir . $basename;

                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                // Allow certain file formats
                $allowTypes = array('jpg', 'png', 'jpeg');

                //Image Size in Bytes
                $imageSize =  $_FILES["upload_img"]["size"];

                //Check whether the uploaded image is below 500kb
                if ($imageSize >= 500000) {
                    // Redirect
                    $statusMsg = 'Sorry, Please upload an image below 500KB';
                    flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                    redirect('profiles/view-profile-details');
                    exit;
                }

                if (in_array($fileType, $allowTypes)) {

                    // Removing old image from storage
                    //Must check if its the default img before removing
                    //If its the default img then we skip unlink part

                    if ($profile_image_name->profile_pic != 'img/profile-img/profile-icon.svg') {
                        unlink(PROFILE_IMG_PATH . $profile_image_name->profile_pic);
                    }

                    // Upload file to server
                    move_uploaded_file($_FILES["upload_img"]["tmp_name"], $targetFilePath);
                    // Insert image file name into database

                    $data = [
                        'user_id' => $_SESSION['user_id'],
                        'profile_pic' => $targetFilePath
                    ];

                    //Update Image Session Value
                    $_SESSION['profile_pic'] = $targetFilePath;

                    //Execute - Adding new Img name and Path to user_tbl
                    $this->userModel->updateProfileImage($data);

                    $data = [
                        'username' => trim($_POST['username']),
                        'email' => trim($_POST['email']),
                        'user_id' => $_SESSION['user_id']
                    ];

                    //Update Session Values
                    $_SESSION['user_email'] = $data['email'];
                    $_SESSION['username'] = $data['username'];


                    //Execute - Adding other details to user_tbl
                    $this->userModel->updateUserDetails($data);

                    // Redirect - Profile Updared successfully
                    $statusMsg = 'Profile Uploaded Successfully';
                    flashMessage('profile_update_status', $statusMsg);
                    redirect('profiles/view-profile-details');
                } else {
                    // Redirect
                    $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
                    flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                    redirect('profiles/view-profile-details');
                }
            } else {
                //No profile pic uploaded
                $data = [
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'user_id' => $_SESSION['user_id']
                ];

                //Update Session Values
                $_SESSION['user_email'] = $data['email'];
                $_SESSION['username'] = $data['username'];

                //Execute - Adding other details to user_tbl
                $this->userModel->updateUserDetails($data);

                // Redirect - Profile Updared successfully
                $statusMsg = 'Profile Uploaded Successfully';
                flashMessage('profile_update_status', $statusMsg);
                redirect('profiles/view-profile-details');
            }
        } else {
            redirect('profiles/view-profile-details');
        }
    }


    public function test()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $status = 'Not uploaded';
            $name = $_FILES["upload_img"]["tmp_name"];
            $size = filesize($name);

            // $filename = $_FILES['upload_img']['tmp_name'];
            // $size = getimagesize($filename);
            // 1MB = 1000000 BYTES

            $data = [
                'data' => $status,
                'name' => $size
            ];
        }
    }
    public function studentProfile()                
    {
        $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
        $student_details = $this->userModel->getStudentDetails($studentId); //commented

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $data = [
                'student_id' => $studentId,
                'experience' => trim($_POST['experience']),
                'interests' => trim($_POST['interests']),
                'qualifications' => trim($_POST['qualifications']),
                'school' => trim($_POST['school']),
                'contact' => trim($_POST['contact']),
                'stream' => trim($_POST['stream']),
                'profile_description' => trim($_POST['profile_description']),
                'extracurricular' => trim($_POST['extracurricular']),
                'profile_name'=>trim($_POST['profile_name']),
                'github_link' =>trim($_POST['github_link']),
                'linkedin_link' =>trim($_POST['linkedin_link']),
                'personal_email'=>trim($_POST['personal_email']),
            ];

            //Execute
            if ($this->studentModel->EditStudentProfileDetails($data)) {

                redirect('profiles/student-profile');
            } else {
                die('Something went wrong');
            }
        } else {

            $studentProfile = $this->studentModel->getStudentProfileData($studentId);


            $data = [
                'student_id' => $studentId,
                'experience' => $studentProfile->experience,
                'interests' => $studentProfile->interests,
                'qualifications' => $studentProfile->qualifications,
                'school' => $studentProfile->school,
                'contact' => $studentProfile->contact,
                'stream' => $studentProfile->stream,
                'profile_description' => $studentProfile->profile_description,
                'extracurricular' => $studentProfile->extracurricular,
                'profile_name' => $studentProfile->profile_name,
                'github_link' => $studentProfile->github_link,
                'linkedin_link'=> $studentProfile->linkedin_link,
                'personal_email' => $studentProfile->personal_email,
            ];

            // $this->view('student/editprofile',$data);

            $this->view('student/studentprofile', $data);
        }
    }

    public function studentCompanyProfile()
    {
        $this->view('student/companyprofile');
    }

    //update student profile
    // public function EditStudentProfileDetails()
    // {
    //     $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
    //     //$student_details = $this->userModel->getStudentDetails($studentId);

    //     // Check if POST
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         // Strip Tags
    //         stripTags();

    //         $data = [
    //             'student_id' => $studentId,
    //             'experience' => trim($_POST['experience']),
    //             'interests' => trim($_POST['interests']),
    //             'qualifications' => trim($_POST['qualifications']),
    //             'school' => trim($_POST['school']),
    //             'contact' => trim($_POST['contact']),
    //             'stream' => trim($_POST['stream']),
    //             'profile_description' => trim($_POST['profile_description']),
    //             'profile_name' => trim($_POST['profile_name']),
    //             'personal_email' => trim($_POST['personal_email']),
    //             'extracurricular' => trim($_POST['extracurricular']),
    //         ];

    //         //Execute
    //         if ($this->studentModel->EditStudentProfileDetails($data)) {

    //             redirect('profiles/student-profile');
    //         } else {
    //             die('Something went wrong');
    //         }
    //     } else {

    //         $studentProfile = $this->studentModel->getStudentProfileData();

    
    //         $data = [
    //             'experience' => $studentProfile->experience,
    //             'interests' => $studentProfile->interests,
    //             'qualifications' => $studentProfile->qualifications,
    //             'school' => $studentProfile->school,
    //             'contact' => $studentProfile->contact,
    //             'stream' => $studentProfile->stream,
    //             'profile_description' => $studentProfile->profile_description,
    //             'profile_name' => $studentProfile->profile_name,
    //             'personal_email'=>$studentProfile->personal_email,
    //             'extracurricular' => $studentProfile->extracurricular,
    //         ];
    
    //         $this->view('student/editprofile',$data);

    //         // $data = [
    //         //     'student_id' => '',
    //         //     'experience' => '',
    //         //     'interests' => '',
    //         //     'qualifications' => '',
    //         //     'school' => '',
    //         //     'contact' => '',
    //         //     'stream' => '',
    //         //     'profile_description' => '',
    //         //     'extracurricular' => '',
    //         // ];


    //         // $this->view('student/editprofile', $data);
    //     }
    // }

    public function EditStudentProfileDetails()

    {

        $studentId = $this->userModel->getStudentUserId($_SESSION['user_id']);
 
        //$student_details = $this->userModel->getStudentDetails($studentId);

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
            //$studentId = 99;
            //$text = explode("\r<\br>", trim($_POST['interests-list']));
            //$length = count($text);

            $emptyArray = array();
            for ($x = 0; $x < $length; $x++) {
                $emptyArray[$x] = trim($text[$x]); 
            }
            //$completeString = implode("", $emptyArray);
       



            $data = [

                'student_id' => $studentId,
                'experience-list' => trim($_POST['experience-list']),
                'interests-list' => trim($_POST['interests-list']),
                'qualifications-list' => trim($_POST['qualifications-list']),
                'school' => trim($_POST['school']),
                'contact' => trim($_POST['contact']),
                'stream' => trim($_POST['stream']),
                'profile_description' => trim($_POST['profile_description']),
                'profile_name' => trim($_POST['profile_name']),
                'personal_email' => trim($_POST['personal_email']),
                'github_link' =>trim($_POST['github_link']),
                'linkedin_link' =>trim($_POST['linkedin_link']),
                'extracurricular-list' => trim($_POST['extracurricular-list']),
            ];

            //Execute
            if ($this->studentModel->EditStudentProfileDetails($data)) {
                redirect('profiles/student-profile');
            } else {
                 die('Something went wrong');
             }
        } else {

            $studentId = $this->userModel->getStudentUserId($_SESSION['user_id']);
            $studentProfile = $this->studentModel->getStudentProfileData($studentId);


            $data = [
                'experience' => $studentProfile->experience,
                'interests' => $studentProfile->interests,
                'qualifications' => $studentProfile->qualifications,
                'school' => $studentProfile->school,
                'contact' => $studentProfile->contact,
                'stream' => $studentProfile->stream,
                'profile_description' => $studentProfile->profile_description,
                'profile_name' => $studentProfile->profile_name,
                'personal_email'=>$studentProfile->personal_email,
                'extracurricular' => $studentProfile->extracurricular,
                'profile_name' => $studentProfile->profile_name,
                'personal_email' => $studentProfile->personal_email,
                'github_link' => $studentProfile->github_link,
                'linkedin_link'=> $studentProfile->linkedin_link,
            ];

            $this->view('student/editprofile', $data);

            // $data = [
            //     'student_id' => '',
            //     'experience' => '',
            //     'interests' => '',
            //     'qualifications' => '',
            //     'school' => '',
            //     'contact' => '',
            //     'stream' => '',
            //     'profile_description' => '',
            //     'extracurricular' => '',
            // ];


            // $this->view('student/editprofile', $data);

            $this->view('student/editprofile',$data);
        }
    }
}
