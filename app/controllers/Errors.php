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

    public function error404()
    {
        $data = [
            'title' => 'page not found'
        ];

        $this->view('error', $data);
    }

    public function error403()
    {
        $data = [
            'title' => 'no result'
        ];

        $this->view('noResult', $data);
    }


}

//error 403