<?php

class Jobroles extends BaseController
{

    public function __construct()
    {
        $this->jobroleModel = $this->model('Jobrole');
    }

    public function index()
    {
        $jobroles = $this->jobroleModel->getJobroles(); //Model function

        $data = [
            'inputValue' => '',
            'jobroles' => $jobroles,
        ];

        $this->view('pdc/jobroles', $data);
    }

    public function addJobrole()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
                'inputValue' => ''
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
            'inputValue' => $jobrole->name,
            'jobrole_id' => $jobrole->jobrole_id,
            'jobroles' => $jobroles,
        ];

        $this->view('pdc/jobrolesUpdate', $data);
    }

    public function updateJobrole($id)
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'jobrole' => trim($_POST['jobrole-update']),
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
            //redirect to error page
        }
    }

    public function deleteJobrole($id)
    {
        $this->jobroleModel->deleteJobrole($id);
    }
}
