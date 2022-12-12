<?php

class Test extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {

        $this->view('pdc/addCompany');
    }


}
