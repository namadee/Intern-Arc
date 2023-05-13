<?php

use helpers\Session;

class Errors extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {
        $this->view('error');
    }


    public function errorRedirect()
    {
        if (Session::isLoggedIn()) {
            //If user logged in, then gets redirected back to dashboard of that user
            //Get User Role to direct them to the Dashboard
            $userRole = Session::getUserRole();

            switch ($userRole) {
                case "pdc":
                    redirect('pdc');
                    break;
                case "student":
                    redirect('students');
                    break;
                case "company":
                    redirect('companies');
                    break;
                default:
                    redirect('admin');
            }
        } else {
            //If user is not logged in, then gets redirected back to login
            redirect('login');
        }
    }

    public function noData()
    {

        $this->view('noData');
    }

    public function error403()
    {

        $this->view('noAccess');
    }
}
