<?php

class Jobroles extends BaseController
{


    public function __construct()
    {
        $this->jobroleModel = $this->model('Jobrole');

        // if (!isset($_SESSION['user_id'])) { //If the user not logged, redirected to login(PDC) 
        //     redirect('users/pdc-login');
        // }
    }

    public function index()
    {
        $jobroles = $this->jobroleModel->getJobroles(); //Model function

        $data = [
            'title' => 'JobRoles',
            'buttonName' => 'Add Job Role',
            'inputValue' => '',
            'jobroles' => $jobroles,
            'formAction' => 'jobroles/addJobrole'
        ];

        $this->view('pdc/jobroles', $data);
    }

    public function addJobrole()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Associative Array
            $data = [
                'jobrole' => trim($_POST['jobrole'])
            ];

            //Execute
            if ($this->jobroleModel->addJobrole($data)) {

                // Redirect
                redirect('jobroles');
            } else {
                die('Something went wrong');
            }
        } else {

            // Init data
            $data = [
                'name' => '',
                'buttonName' => 'Add Job Role'
            ];

            // Load View
            $this->view('pdc/jobroles', $data);
        }
    }

    public function showJobrole($id)
    {

        $jobroles = $this->jobroleModel->getJobroles();
        $jobrole = $this->jobroleModel->showJobroleById($id); //To get the JobRole Name

        $data = [
            'className' => 'selectedTab',
            'title' => 'JobRoles',
            'buttonName' => 'Update',
            'inputValue' => $jobrole->name,
            'jobroles' => $jobroles,
            'formAction' => 'jobroles/updateJobrole/' . $jobrole->jobrole_id
        ];

        $this->view('pdc/jobroles', $data);
    }

    public function updateJobrole($id)
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'jobrole' => trim($_POST['jobrole']),
                'id' => $id
            ];

            //Execute
            if ($this->jobroleModel->updateJobrole($data)) {

                // Redirect
                redirect('jobroles');
            } else {
                die('Something went wrong');
            }
        } else {

            // Init data
            $data = [
                'name' => '',
                'buttonName' => 'Add Job Role'
            ];

            // Load View
            $this->view('pdc/jobroles', $data);
        }
    }

    public function deleteJobrole($id)
    {
        $this->jobroleModel->deleteJobrole($id);
    }
}
