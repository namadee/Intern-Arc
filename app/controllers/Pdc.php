<?php

class Pdc extends BaseController
{

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
    }

    public function index() //Load Dashboard
    {
        $this->view('pdc/login');
    }




}
