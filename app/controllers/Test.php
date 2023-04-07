<?php

class Test extends BaseController
{
    public $userModel;
    public $registerModel;
    public $companyModel;
    public $testModel;


    public function __construct()
    {
        $this->registerModel = $this->model('Register');
        $this->userModel = $this->model('User');
        $this->companyModel = $this->model('Company');
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
        $count = $this->companyModel->getCompanyCount();
        $data = [
            'url' => $count->totalRows 
        ];
        $this->view('test', $data);
    }
}


//Advertisemet Tab PDC - All Advertisements (Add Company Name also)
// company css 750 align items flex start adv
