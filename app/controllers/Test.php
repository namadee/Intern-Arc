<?php

class Test extends BaseController
{
    public $userModel;
    public $registerModel;
    public $studentModel;
    public $testModel;


    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
    }

    public function index()
    {
        //Display main details of the students


        // To edit main student details [user_tbl]
        // $this->view('pdc/studentDetails');

        $current_url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $this->view('pdc/studentList');
    }

    public function testing($id=-1)
    {
        $data = [
            'url' => $id 
        ];
        $this->view('test', $data);
    }
}
