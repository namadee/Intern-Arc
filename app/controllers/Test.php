<?php

class Test extends BaseController
{

    public function __construct()
    {
        $this->userModel=$this->model('User');
    }

    public function index()
    // {
    //     // $row = $this->userModel->login('ruchira@gmail.com','$2y$10$tlmujiPYQM1qXIgGxuqbju47jhnK14vyCcMYL4uPeeIsxkE92AxOS');
    //     $row2 = $this->userModel->getUserDetails(6);
        
    // // Init data
    //   $data = [
    //     'row' => $row2,
    //   ];
    {
        $this->view('pdc/manageStudent');
    }

    public function manageCompany()
    {
        $this->view('pdc/manageCompany');
    }

    public function registerCompany()
    {
        $this->view('pdc/registerCompany');
    }

    public function registerStudent()
    {
        $this->view('pdc/registerStudent');
    }

    public function studentList()
    {

        $this->view('pdc/studentList');
    }
}
