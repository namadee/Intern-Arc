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


    //View - Main User Details [User Table] - Ruchira
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


    public function companyProfile($userID = NULL)
    {
        //Admin use this also
        if ($userID != NULL) {

            $companyId = $this->userModel->getCompanyUserId($userID);
            $company_details = $this->userModel->getCompanyDetails($companyId);
            $profile_image_name = $this->userModel->getProfileImageName($userID);

            $data = [
                'company_id' => $companyId,
                'company_name' => $company_details->company_name,
                'company_address' => $company_details->company_address,
                'company_slogan' => $company_details->company_slogan,
                'company_email' => $company_details->company_email,
                'company_description' => $company_details->company_description,
                'linkedlnUrl' => $company_details->linkedln,
                'websiteLink' => $company_details->website_link,
                'contact' => $company_details->contact,
                'image' => $profile_image_name->profile_pic,
                'formAction' => 'Profiles/update-company-profile/' . $company_details->company_id,
                'edit_button_class' => 'none'
            ];

            $this->view('company/profile', $data);
        } else {
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
                'linkedlnUrl' => $company_details->linkedln,
                'websiteLink' => $company_details->website_link,
                'contact' => $company_details->contact,
                'formAction' => 'Profiles/update-company-profile/' . $company_details->company_id,
                'edit_button_class' => ''
            ];

            $this->view('company/profile', $data);
        }
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

    // Company Profile Update - Namadee
    public function updateCompanyProfile()
    {
        if ($_SESSION['user_role'] == 'company') {

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
                        if ($profile_image_name->profile_pic != 'img/profile-img/profile-icon.jpeg') {
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
        } else {
            $this->view('error403');
        }
    }

    // Main profile details Update (user table) - Ruchira
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

                    if ($profile_image_name->profile_pic != 'img/profile-img/profile-icon.jpeg') {
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

    // View Profile Details - For all
    public function studentProfile($userID = NULL)
    {
        if ($userID == NULL) {
            $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
            $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));
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
                'linkedin_link' => $studentProfile->linkedin_link,
                'personal_email' => $studentProfile->personal_email,
                'image' => $profile_image_name->profile_pic,    //extra 2
            ];

            $this->view('student/studentprofile', $data);
        } else {

            $studentId = $this->userModel->getStudentUserId($userID);
            $profile_image_name = $this->userModel->getProfileImageName($userID);
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
                'linkedin_link' => $studentProfile->linkedin_link,
                'personal_email' => $studentProfile->personal_email,
                'image' => $profile_image_name->profile_pic
            ];
            $this->view('student/studentprofile', $data);
        }
    }




    public function studentCompanyProfile()
    {
        $this->view('student/companyprofile');
    }


    // public function EditStudentProfileDetails()
    // {
    //     $studentId = $this->userModel->getStudentUserId($_SESSION['user_id']);
    //     $studentProfile = $this->studentModel->getStudentProfileData($studentId);
    //     $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));
    //     // Check if POST
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    //         //         //File upload path
    //         //         $targetDir = "img/profile-img/";
    //         //         //Change image file name - Unique Name for each user with the help of userId
    //         //         $fileName = 'user' . $_SESSION['user_id'] . '_profileimg' . rand(0, 100000);
    //         //         //Get the extension
    //         //         $extension = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
    //         //         //Full image name
    //         //         $basename   = $fileName . "." . $extension; //user56_profile_img.jpg
    //         //         //TargetPath
    //         //         $targetFilePath = $targetDir . $basename;



    //         $data = [

    //             'student_id' => $studentId,
    //             'experience-list' => ($_POST['experiences']),
    //             'interests-list' => $_POST['interests'],
    //             'school' => trim($_POST['school']),
    //             'contact' => trim($_POST['contact']),
    //             'profile_description' => trim($_POST['profile_description']),
    //             'profile_name' => trim($_POST['profile_name']),
    //             'personal_email' => trim($_POST['personal_email']),
    //             'github_link' => trim($_POST['github_link']),
    //             'linkedin_link' => trim($_POST['linkedin_link']),
    //             'extracurricular-list' => ($_POST['extracurricular']),
    //             'qualification-list' => ($_POST['qualifications']),
    //         ];


    //         // 1 Year Customer Relations<br />
    //         // Commercial TP, 2 years Web Developer<br />
    //         // IFS

    //         $data['experience-list'] = implode(", ", $data['experience-list']);
    //         $data['experience-list'] = nl2br($data['experience-list']);

    //         $data['interests-list'] = implode(", ", $data['interests-list']);
    //         $data['interests-list'] = nl2br($data['interests-list']);

    //         $data['qualification-list'] = implode(", ", $data['qualification-list']);
    //         $data['qualification-list'] = nl2br($data['qualification-list']);

    //         $data['extracurricular-list'] = implode(", ", $data['extracurricular-list']);
    //         $data['extracurricular-list'] = nl2br($data['extracurricular-list']);

    //         //Execute - Adding other details to company_tbl
    //         $this->studentModel->EditStudentProfileDetails($data);

    //         redirect('profiles/student-profile');
    //     } else {

    //         $data = [
    //             'experience' => $studentProfile->experience,
    //             'interests' => $studentProfile->interests,
    //             'qualifications' => $studentProfile->qualifications,
    //             'school' => $studentProfile->school,
    //             'contact' => $studentProfile->contact,
    //             'stream' => $studentProfile->stream,
    //             'profile_description' => $studentProfile->profile_description,
    //             'profile_name' => $studentProfile->profile_name,
    //             'personal_email' => $studentProfile->personal_email,
    //             'extracurricular' => $studentProfile->extracurricular,
    //             'profile_name' => $studentProfile->profile_name,
    //             'personal_email' => $studentProfile->personal_email,
    //             'github_link' => $studentProfile->github_link,
    //             'linkedin_link' => $studentProfile->linkedin_link,

    //         ];

    //         $this->view('student/editprofile', $data);
    //     }
    // }

    public function EditStudentProfileDetails()
    {

        $studentId = $this->userModel->getStudentUserId($_SESSION['user_id']);
        $studentProfile = $this->studentModel->getStudentProfileData($studentId);
        $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //File upload path
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
                    redirect('profiles/student-profile');
                    exit;
                }

                // Allow certain file formats
                $allowTypes = array('jpg', 'png', 'jpeg');

                if (in_array($fileType, $allowTypes)) {
                    //Removing old image from storage
                    //Must check if its the default img before removing
                    //If its the default img then we skip unlink part
                    if ($profile_image_name->profile_pic != 'img/profile-img/profile-icon.jpeg') {
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

                            'student_id' => $studentId,
                            'experience-list' => ($_POST['experiences']),
                            'interests-list' => $_POST['interests'],
                            'school' => trim($_POST['school']),
                            'contact' => trim($_POST['contact']),
                            'stream' => trim($_POST['stream']),
                            'profile_description' => trim($_POST['profile_description']),
                            'profile_name' => trim($_POST['profile_name']),
                            'personal_email' => trim($_POST['personal_email']),
                            'github_link' => trim($_POST['github_link']),
                            'linkedin_link' => trim($_POST['linkedin_link']),
                            'extracurricular-list' => ($_POST['extracurricular']),
                            'qualification-list' => ($_POST['qualifications'])
                        ];


                        $data['experience-list'] = implode(", ", $data['experience-list']);
                        $data['experience-list'] = nl2br($data['experience-list']);

                        $data['interests-list'] = implode(", ", $data['interests-list']);
                        $data['interests-list'] = nl2br($data['interests-list']);

                        $data['qualification-list'] = implode(", ", $data['qualification-list']);
                        $data['qualification-list'] = nl2br($data['qualification-list']);

                        $data['extracurricular-list'] = implode(", ", $data['extracurricular-list']);
                        $data['extracurricular-list'] = nl2br($data['extracurricular-list']);

                        // Execute - Adding other details to company_tbl
                        $this->studentModel->EditStudentProfileDetails($data);


                        // // Redirect - Profile Updared successfully
                        $statusMsg = 'Profile Picture Uploaded Successfully';
                        flashMessage('profile_update_status', $statusMsg);
                        redirect('profiles/student-profile');
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file.";
                        flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                        redirect('profiles/edit-student-profile-Details');
                    }
                } else {
                    // Redirect
                    $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
                    flashMessage('profile_update_status', $statusMsg, 'danger-alert');
                    redirect('profiles/edit-student-profile-Details');
                }
            } else {

                //no pro pic uploaded
                $data = [

                    'student_id' => $studentId,
                    'experience-list' => ($_POST['experiences']),
                    'interests-list' => $_POST['interests'],
                    'school' => trim($_POST['school']),
                    'contact' => trim($_POST['contact']),
                    'stream' => trim($_POST['stream']),
                    'profile_description' => trim($_POST['profile_description']),
                    'profile_name' => trim($_POST['profile_name']),
                    'personal_email' => trim($_POST['personal_email']),
                    'github_link' => trim($_POST['github_link']),
                    'linkedin_link' => trim($_POST['linkedin_link']),
                    'extracurricular-list' => ($_POST['extracurricular']),
                    'qualification-list' => ($_POST['qualifications']),
                ];

                $data['experience-list'] = implode(", ", $data['experience-list']);
                $data['experience-list'] = nl2br($data['experience-list']);

                $data['interests-list'] = implode(", ", $data['interests-list']);
                $data['interests-list'] = nl2br($data['interests-list']);

                $data['qualification-list'] = implode(", ", $data['qualification-list']);
                $data['qualification-list'] = nl2br($data['qualification-list']);

                $data['extracurricular-list'] = implode(", ", $data['extracurricular-list']);
                $data['extracurricular-list'] = nl2br($data['extracurricular-list']);

                //Execute - Adding other details to company_tbl
                $this->studentModel->EditStudentProfileDetails($data);

                // Redirect - Profile Updated successfully
                $statusMsg = 'Profile Uploaded Successfully';
                flashMessage('profile_update_status', $statusMsg);
                redirect('profiles/student-profile');
            }
        } else {

            $data = [
                'experience' => $studentProfile->experience,
                'interests' => $studentProfile->interests,
                'qualifications' => $studentProfile->qualifications,
                'school' => $studentProfile->school,
                'contact' => $studentProfile->contact,
                'stream' => $studentProfile->stream,
                'profile_description' => $studentProfile->profile_description,
                'profile_name' => $studentProfile->profile_name,
                'personal_email' => $studentProfile->personal_email,
                'extracurricular' => $studentProfile->extracurricular,
                'profile_name' => $studentProfile->profile_name,
                'personal_email' => $studentProfile->personal_email,
                'github_link' => $studentProfile->github_link,
                'linkedin_link' => $studentProfile->linkedin_link,

            ];

            $this->view('student/editprofile', $data);
        }
    }


    // To view student profiles

    public function viewStudentProfile($userID = NULL)
    {

        if ($userID == NULL) {
            redirect('errors');
        }
        $studentId = $this->userModel->getStudentUserId($userID);
        $profile_image_name = $this->userModel->getProfileImageName($userID);
        $studentProfile = $this->studentModel->getStudentProfileData($studentId);

        if ($studentProfile->cv == NULL) {
            $cv = 'javascript:void(0)';
        }else{
            $cv = URLROOT . $studentProfile->cv;
        }

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
            'linkedin_link' => $studentProfile->linkedin_link,
            'personal_email' => $studentProfile->personal_email,
            'image' => $profile_image_name->profile_pic,
            'cv' => $cv
        ];

        $this->view('student/viewStudentProfile', $data);
    }

    // public function EditffffStudentProfileDetails()
    // {

    //     $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
    //     $student_details = $this->userModel->getStudentDetails($studentId);
    //     $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));
    //     $studentProfile = $this->studentModel->getStudentProfileData($studentId);

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $text = explode("\r<\br>", trim($_POST['interests-list']));
    //         $length = count($text);
    //         $emptyArray = array();
    //         for ($x = 0; $x < $length; $x++) {
    //             $emptyArray[$x] = trim($text[$x]); 
    //         }

    //         $statusMsg = '';

    //         // File upload path
    //         $targetDir = "img/profile-img/";
    //         //Change image file name - Unique Name for each user with the help of userId
    //         $fileName = 'user' . $_SESSION['user_id'] . '_profileimg' . rand(0, 100000);
    //         //Get the extension
    //         $extension = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
    //         //Full image name
    //         $basename   = $fileName . "." . $extension; //user56_profile_img.jpg
    //         //TargetPath
    //         $targetFilePath = $targetDir . $basename;

    //         $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    //         if (!empty($_FILES["profile_image"]["name"])) {

    //             //Image Size in Bytes
    //             $imageSize =  $_FILES["profile_image"]["size"];

    //             //Check whether the uploaded image is below 500kb
    //             if ($imageSize >= 500000) {
    //                 // Redirect
    //                 $statusMsg = 'Sorry, Please upload an image below 500KB';
    //                 flashMessage('profile_update_status', $statusMsg, 'danger-alert');
    //                 redirect('profiles/student-profile');
    //                 exit;
    //             }

    //             // Allow certain file formats
    //             $allowTypes = array('jpg', 'png', 'jpeg');

    //             if (in_array($fileType, $allowTypes)) {


    //                 //Removing old image from storage
    //                 //Must check if its the default img before removing
    //                 //If its the default img then we skip unlink part
    //                 if ($profile_image_name->profile_pic != 'img/profile-img/profile-icon.svg') {
    //                     unlink(PROFILE_IMG_PATH . $profile_image_name->profile_pic);
    //                 }

    //                 // Upload file to server
    //                 if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {

    //                     // Insert image file name into database
    //                     $data = [
    //                         'user_id' => $_SESSION['user_id'],
    //                         'profile_pic' => $targetFilePath
    //                     ];

    //                     //Execute - Adding new Img name and Path to user_tbl
    //                     $this->userModel->updateProfileImage($data);

    //                     //To add the new photo session - top navbar profile photo
    //                     //Update Image Session Value
    //                     $_SESSION['profile_pic'] = $targetFilePath;


    //                     $data = [
    //                         'student_id' => $studentId,
    //                         'experience' => trim($_POST['experience']),
    //                         'interests-list' => trim($_POST['interests-list']),
    //                         'qualifications' => trim($_POST['qualifications']),
    //                         'school' => trim($_POST['school']),
    //                         'contact' => trim($_POST['contact']),
    //                         'stream' => trim($_POST['stream']),
    //                         'profile_description' => trim($_POST['profile_description']),
    //                         'extracurricular' => trim($_POST['extracurricular']),
    //                         'profile_name'=>trim($_POST['profile_name']),
    //                         'github_link' =>trim($_POST['github_link']),
    //                         'linkedin_link' =>trim($_POST['linkedin_link']),
    //                         'personal_email'=>trim($_POST['personal_email']),
    //                     ];

    //                     //Execute - Adding other details to company_tbl
    //                     $this->studentModel->EditStudentProfileDetails($data);

    //                     // Redirect - Profile Updared successfully
    //                     $statusMsg = 'Profile Uploaded Successfully';
    //                     flashMessage('profile_update_status', $statusMsg);
    //                     redirect('student/editprofile');
    //                 } else {
    //                     $statusMsg = "Sorry, there was an error uploading your file.";
    //                     flashMessage('profile_update_status', $statusMsg, 'danger-alert');
    //                     redirect('student/editprofile');
    //                 }
    //             } else {
    //                 // Redirect
    //                 $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
    //                 flashMessage('profile_update_status', $statusMsg, 'danger-alert');
    //                 redirect('student/editprofile');
    //             }
    //         } else {

    //             //No profile pic uploaded
    //             $data = [
    //                 'student_id' => $studentId,
    //                 'experience' => trim($_POST['experience']),
    //                 'interests' => trim($_POST['interests']),
    //                 'qualifications' => trim($_POST['qualifications']),
    //                 'school' => trim($_POST['school']),
    //                 'contact' => trim($_POST['contact']),
    //                 'stream' => trim($_POST['stream']),
    //                 'profile_description' => trim($_POST['profile_description']),
    //                 'extracurricular' => trim($_POST['extracurricular']),
    //                 'profile_name'=>trim($_POST['profile_name']),
    //                 'github_link' =>trim($_POST['github_link']),
    //                 'linkedin_link' =>trim($_POST['linkedin_link']),
    //                 'personal_email'=>trim($_POST['personal_email']),
    //             ];

    //             //Execute - Adding other details to company_tbl
    //             $this->studentModel->EditStudentProfileDetails($data);

    //             // Redirect - Profile Updated successfully
    //             $statusMsg = 'Profile Uploaded Successfully';
    //             flashMessage('profile_update_status', $statusMsg);
    //             redirect('profiles/student-profile');
    //         }
    //     } else {
    //         $data = [
    //             'student_id' => $studentId,
    //             'experience' => $studentProfile->experience,
    //             'interests' => $studentProfile->interests,
    //             'qualifications' => $studentProfile->qualifications,
    //             'school' => $studentProfile->school,
    //             'contact' => $studentProfile->contact,
    //             'stream' => $studentProfile->stream,
    //             'profile_description' => $studentProfile->profile_description,
    //             'extracurricular' => $studentProfile->extracurricular,
    //             'profile_name' => $studentProfile->profile_name,
    //             'github_link' => $studentProfile->github_link,
    //             'linkedin_link'=> $studentProfile->linkedin_link,
    //             'personal_email' => $studentProfile->personal_email,
    //             'image' => $profile_image_name->profile_pic,
    //         ];

    //         $this->view('student/editprofile', $data);
    //     }
    // }


}
