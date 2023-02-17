<?php

class Requests extends BaseController
{

    public $userModel;
    public $registerModel;
    
    public function __construct()
    {
    }

    public function index() 
    {
        $this->view('company/studentRequestList');
    }

    // View All Student Requests (PDC POV)
    public function allRequests() 
    {
        $this->view('pdc/studentRequest');
    }

    public function shortlistedList() 
    {
        $this->view('company/shortlist');
    }



}
