<?php

class Test extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {

        $this->view('pdc/manageStudent');
    }

    public function manageCompany()
    {

        $this->view('pdc/manageCompany');
    }

    public function addCompany()
    {

        $this->view('pdc/addCompany');
    }

    public function addStudent()
    {

        $this->view('pdc/addStudent');
    }
}
