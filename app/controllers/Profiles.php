<?php

class Profiles extends BaseController
{
    public $userModel;
    public $companyModel;
    public $studentModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
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
        $this->view('company/profile');
    }

    public function studentProfile()
    {
        $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
        //$student_details = $this->userModel->getStudentDetails($studentId);

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
            ];

            //Execute
            if ($this->studentModel->EditStudentProfileDetails($data)) {

                redirect('profiles/student-profile');
            } else {
                die('Something went wrong');
            }
        } else {

            $studentProfile = $this->studentModel->getStudentProfileData();

    
            $data = [
                'experience' => $studentProfile->experience,
                'interests' => $studentProfile->interests,
                'qualifications' => $studentProfile->qualifications,
                'school' => $studentProfile->school,
                'contact' => $studentProfile->contact,
                'stream' => $studentProfile->stream,
                'profile_description' => $studentProfile->profile_description,
                'extracurricular' => $studentProfile->extracurricular,
            ];
    
            // $this->view('student/editprofile',$data);

        $this->view('student/studentprofile',$data);
    }
}

    public function studentCompanyProfile()
    {
        $this->view('student/companyprofile');
    }

    //update student profile
    public function EditStudentProfileDetails()
    {
        $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));
        //$student_details = $this->userModel->getStudentDetails($studentId);

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
            ];

            //Execute
            if ($this->studentModel->EditStudentProfileDetails($data)) {

                redirect('profiles/student-profile');
            } else {
                die('Something went wrong');
            }
        } else {

            $studentProfile = $this->studentModel->getStudentProfileData();

    
            $data = [
                'experience' => $studentProfile->experience,
                'interests' => $studentProfile->interests,
                'qualifications' => $studentProfile->qualifications,
                'school' => $studentProfile->school,
                'contact' => $studentProfile->contact,
                'stream' => $studentProfile->stream,
                'profile_description' => $studentProfile->profile_description,
                'extracurricular' => $studentProfile->extracurricular,
            ];
    
            $this->view('student/editprofile',$data);

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
        }
    }

}
