<?php

class Students extends BaseController
{
    public $studentModel;

    public function __construct()  
    {
        $this->studentModel = $this->model('Student');
    }

    //Student User Dashboard
    public function index()
    {
        $this->view('student/dashboard');
    }

    //Manage Students - PDC
    public function manageStudent()
    {

        $this->view('pdc/manageStudent');
    }

    //Manage Students - PDC
    public function studentList()
    {

        $this->view('pdc/studentList');
    }

    //Manage Students - PDC
    public function studentDetails()
    {

        $this->view('pdc/studentDetails');
    }

    public function studentProfile()
    {
        $studentProfile = $this->studentModel->getStudentProfileData();
        // $data = [
        //     'student_id' => $studentId,
        //     'experience' => $experience,
        //     'interests' => $interests,
        //     'qualifications' => $qualifications,
        //     'school' => $school,
        //     'contact' => $contact,
        //     'stream' => $stream,
        //     'profile_description' => $profile_description,
        //     'extracurricular' => $extracurricular,
        // ];

        $data = [
            'experience' => $studentProfile->experience,
            'interests' => $studentProfile->interests,
            'qualifications' => $studentProfile->qualifications,
            'school' => $studentProfile->school,
            'contact' => $studentProfile->contact,
            'stream' => $studentProfile->stream,
            'profile_description' => $studentProfile->profile_description,
            'profile_name' => $studentProfile->profile_name,
            'personal_email'=> $studentProfile->personal_email,
            'extracurricular' => $studentProfile->extracurricular,
        ];

        $this->view('student/studentprofile',$data);
    }

    public function companyProfile()
    {

        $this->view('student/companyprofile');
    }

    public function viewads()
    {

        $this->view('student/viewads');
    }

    public function editProfile()
    {

        $this->view('student/editprofile');
    }


}
