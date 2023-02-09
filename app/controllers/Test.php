<?php

class Register extends BaseController
{
    public $userModel;
    public $registerModel;
    public $studentModel;
    public $testModel;

    //All the Registration Processes

    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
    }

    public function index()
    {

    }
}
