<?php

class Admin extends BaseController
{

    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        $this->userModel = $this->model('User');
    }

    public function index() //default method and view
    {
        $this->view('admin/login');
    }


}
