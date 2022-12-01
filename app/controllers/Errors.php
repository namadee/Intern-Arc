<?php

class Errors extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'title' => 'This is the Home',
        ];

        $this->view('error', $data);
    }


}
