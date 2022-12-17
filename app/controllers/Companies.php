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
}