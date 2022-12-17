<?php

class Errors extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {

        $this->view('error');
    }


    public function noAccess()
    {

        $this->view('noAccess');
    }


}

