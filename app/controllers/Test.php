<?php

class Test extends BaseController
{
    public $userModel;
    public $registerModel;
    public $companyModel;
    public $testModel;


    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
    }

    public function index()
    {
        //Display main details of the students


        // To edit main student details [user_tbl]
        // $this->view('pdc/studentDetails');

        $current_url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $this->view('pdc/studentList');
    }

    public function testing($id=-1)
    {
        $count = $this->companyModel->getCompanyCount();
        $data = [
            'url' => $count->totalRows 
        ];
        $this->view('test', $data);
    }
}


//Advertisemet Tab PDC - All Advertisements (Add Company Name also)
// company css 750 align items flex start adv

//geeth work

// public function EditStudentProfileDetails()
//     {

//         $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
//         $student_details = $this->userModel->getStudentDetails($studentId);
//         $profile_image_name = $this->userModel->getProfileImageName(($_SESSION['user_id']));

//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//             $emptyArray = array();
//             for ($x = 0; $x < $length; $x++) {
//                 $emptyArray[$x] = trim($text[$x]); 
//             }

//             $statusMsg = '';

//             // File upload path
//             $targetDir = "img/profile-img/";
//             //Change image file name - Unique Name for each user with the help of userId
//             $fileName = 'user' . $_SESSION['user_id'] . '_profileimg' . rand(0, 100000);
//             //Get the extension
//             $extension = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
//             //Full image name
//             $basename   = $fileName . "." . $extension; //user56_profile_img.jpg
//             //TargetPath
//             $targetFilePath = $targetDir . $basename;

//             $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

//             if (!empty($_FILES["profile_image"]["name"])) {

//                 //Image Size in Bytes
//                 $imageSize =  $_FILES["profile_image"]["size"];

//                 //Check whether the uploaded image is below 500kb
//                 if ($imageSize >= 500000) {
//                     // Redirect
//                     $statusMsg = 'Sorry, Please upload an image below 500KB';
//                     flashMessage('profile_update_status', $statusMsg, 'danger-alert');
//                     redirect('profiles/student-profile');
//                     exit;
//                 }

//                 // Allow certain file formats
//                 $allowTypes = array('jpg', 'png', 'jpeg');

//                 if (in_array($fileType, $allowTypes)) {


//                     //Removing old image from storage
//                     //Must check if its the default img before removing
//                     //If its the default img then we skip unlink part
//                     if ($profile_image_name->profile_pic != 'img/profile-img/profile-icon.svg') {
//                         unlink(PROFILE_IMG_PATH . $profile_image_name->profile_pic);
//                     }

//                     // Upload file to server
//                     if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {

//                         // Insert image file name into database
//                         $data = [
//                             'user_id' => $_SESSION['user_id'],
//                             'profile_pic' => $targetFilePath
//                         ];

//                         //Execute - Adding new Img name and Path to user_tbl
//                         $this->userModel->updateProfileImage($data);

//                         //To add the new photo session - top navbar profile photo
//                         //Update Image Session Value
//                         $_SESSION['profile_pic'] = $targetFilePath;


//                         $data = [
//                             'student_id' => $studentId,
//                             'experience' => trim($_POST['experience']),
//                             'interests' => trim($_POST['interests']),
//                             'qualifications' => trim($_POST['qualifications']),
//                             'school' => trim($_POST['school']),
//                             'contact' => trim($_POST['contact']),
//                             'stream' => trim($_POST['stream']),
//                             'profile_description' => trim($_POST['profile_description']),
//                             'extracurricular' => trim($_POST['extracurricular']),
//                             'profile_name'=>trim($_POST['profile_name']),
//                             'github_link' =>trim($_POST['github_link']),
//                             'linkedin_link' =>trim($_POST['linkedin_link']),
//                             'personal_email'=>trim($_POST['personal_email']),
//                         ];

//                         //Execute - Adding other details to company_tbl
//                         $this->studentModel->EditStudentProfileDetails($data);

//                         // Redirect - Profile Updared successfully
//                         $statusMsg = 'Profile Uploaded Successfully';
//                         flashMessage('profile_update_status', $statusMsg);
//                         redirect('profiles/student-profile');
//                     } else {
//                         $statusMsg = "Sorry, there was an error uploading your file.";
//                         flashMessage('profile_update_status', $statusMsg, 'danger-alert');
//                         redirect('profiles/edit-student-profile-details');
//                     }
//                 } else {
//                     // Redirect
//                     $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.';
//                     flashMessage('profile_update_status', $statusMsg, 'danger-alert');
//                     redirect('profiles/edit-student-profile-details');
//                 }
//             } else {

//                 //No profile pic uploaded
//                 $data = [
//                     'student_id' => $studentId,
//                     'experience' => trim($_POST['experience']),
//                     'interests' => trim($_POST['interests']),
//                     'qualifications' => trim($_POST['qualifications']),
//                     'school' => trim($_POST['school']),
//                     'contact' => trim($_POST['contact']),
//                     'stream' => trim($_POST['stream']),
//                     'profile_description' => trim($_POST['profile_description']),
//                     'extracurricular' => trim($_POST['extracurricular']),
//                     'profile_name'=>trim($_POST['profile_name']),
//                     'github_link' =>trim($_POST['github_link']),
//                     'linkedin_link' =>trim($_POST['linkedin_link']),
//                     'personal_email'=>trim($_POST['personal_email']),
//                 ];

//                 //Execute - Adding other details to company_tbl
//                 $this->studentModel->EditStudentProfileDetails($data);

//                 // Redirect - Profile Updated successfully
//                 $statusMsg = 'Profile Uploaded Successfully';
//                 flashMessage('profile_update_status', $statusMsg);
//                 redirect('profiles/student-profile');
//             }
//         } else {
//             $data = [
//                 'student_id' => $studentId,
//                 'experience' => $studentProfile->experience,
//                 'interests' => $studentProfile->interests,
//                 'qualifications' => $studentProfile->qualifications,
//                 'school' => $studentProfile->school,
//                 'contact' => $studentProfile->contact,
//                 'stream' => $studentProfile->stream,
//                 'profile_description' => $studentProfile->profile_description,
//                 'extracurricular' => $studentProfile->extracurricular,
//                 'profile_name' => $studentProfile->profile_name,
//                 'github_link' => $studentProfile->github_link,
//                 'linkedin_link'=> $studentProfile->linkedin_link,
//                 'personal_email' => $studentProfile->personal_email,
//                 'image' => $profile_image_name->profile_pic,
//             ];

//             $this->view('student/studentprofile', $data);
//         }
//     }