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
}
