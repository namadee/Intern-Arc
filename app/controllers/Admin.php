<?php

class Admin extends BaseController
{
    
    public function __construct()
    {
        $this->companyModel = $this->model('Admin');
    }

    public function index() //default method and view
    {
        $this->view('admin/login');
    }


}
