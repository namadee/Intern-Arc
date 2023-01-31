<?php

class Requests extends BaseController
{

    public $userModel;
    public $registerModel;
    
    public function __construct()
    {
    }

    public function index() //Load PDC Dashboard
    {
        $this->view('company/shortlist');
    }

    public function allRequests() 
    {
        $this->view('company/addAdvertisement');
    }



}
