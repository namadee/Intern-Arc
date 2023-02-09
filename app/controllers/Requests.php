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
        $this->view('company/studentRequestList');
    }

    public function allRequests() 
    {
        $this->view('company/addAdvertisement');
    }

    public function shortlistedList() 
    {
        $this->view('company/shortlist');
    }



}
