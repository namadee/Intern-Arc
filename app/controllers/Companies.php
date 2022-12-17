<?php

class Companies extends BaseController
{
    
    public function __construct()
    {
        $this->companyModel = $this->model('Company');
    }

    // Company Dashboard
    public function index() 
    {
        $this->view('company/dashboard');
       
    }

    // Manage Company
    public function manageCompany()
    {
        $this->view('pdc/manageCompany');
    }


}
