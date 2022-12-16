<?php

class Shortlist extends BaseController
{

    public function __construct()
    {

    }

    //All the Shortlisted Students of All the Advertisements
    public function index()
    {
        $this->view('company/shortlist');
    }

    //All the Shortlisted Students under 1 Advertisement
    public function viewShortlistStudents()
    {
            $this->view('company/shortlistedStudents');
    }

   
}


