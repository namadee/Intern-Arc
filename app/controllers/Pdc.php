<?php

class Pdc extends BaseController
{

    public $userModel;
    public $registerModel;
    
    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
    }

    public function index() //Load PDC Dashboard
    {
        $this->view('pdc/dashboard');
    }

    public function sendInvitation() 
    {
        $this->view('pdc/companyInvitation');
    }

    public function setRoundDurations() 
    {
        $this->view('pdc/setRoundDuration');
    }



}
