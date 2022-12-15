<?php

class Errors extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {

        $this->view('test');
    }

    public function noResult()
    {
        $data = [
            'title' => 'no result'
        ];

        $this->view('noResult', $data);
    }


}

//error 403