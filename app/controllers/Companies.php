<?php

class Companies extends BaseController
{

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
}
