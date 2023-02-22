<?php

class Companies extends BaseController
{
    public $companyModel;

    public function __construct()
    {
        $this->companyModel = $this->model('Company');
    }

    // Company User Dashboard
    public function index()
    {
        $this->view('company/dashboard');
    }

    // Manage Company- PDC
    public function manageCompany()
    {
        $this->view('pdc/manageCompany');
    }

    // Company Details Company- PDC
    public function CompanyDetails()
    {
        $this->view('pdc/companyDetails');
    }

    //View Company List - STUDENT
    public function viewCompanyList()
    {

        $this->view('student/viewcompanies');
    }

    //View Applied Company List - STUDENT
    public function viewAppliedCompanyList()
    {
        $this->view('student/appliedcompanies');
    }

    //View Applied Company List - STUDENT
    public function viewCompanyDetails()
    {
        $this->view('student/appliedcompanies');
    }

    public function shortlistedStudents(){
        $this->view('company/shortlistedStudents');
    }

    public function InterviewScheduleList(){
        $this->view('company/InterviewScheduleList');
    }

    public function InterviewScheduleCreate(){
        $this->view('company/InterviewScheduleCreate');
    }

    public function InterviewSchedule(){
        $this->view('company/InterviewSchedule');
    }

   //SHORTLIST STUDENTS
   public function shortlistStudent(){
    if(isset($_POST["status"])){
        //Handling changing status to shortist or reject
        $data = [
            'request_id' => trim($_POST['request_id']),
            'status' => trim($_POST['status'])
        ];

        $this->companyModel->shortlistStudent($data);
        flashMessage('shortlist_student_msg', 'Student Added to Shortlist');
        redirect('companies/shortlist-student');
    }
   }

}
