<?php

class Jobroles extends BaseController
{

    public $jobroleModel;

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

            // Strip Tags
            stripTags();

            //Check whether the entered job role is already available in the database
            $jobrolesList = $this->jobroleModel->getJobroles();
            $jobroleExists = false;

            foreach ($jobrolesList as $jobrole) {
                if (strtolower($jobrole->name) == strtolower(trim($_POST['jobrole']))) {
                    // Redirect
                    $jobroleExists = true;
                    break;
                }
            }

            if ($jobroleExists) {
                // Redirect
                flashMessage('jobroleView', 'Job Role already exists, Please check again!', 'danger-alert');
                redirect('jobroles');
            } else {
                //Associative Array
                $data = [
                    'jobrole' => (trim($_POST['jobrole']))
                ];
                //Execute
                if ($this->jobroleModel->addJobrole($data)) {
                    // Redirect
                    redirect('jobroles');
                } else {
                    redirect('jobroles');
                }
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

            // Strip Tags
            stripTags();

            $data = [
                'jobrole' => trim($_POST['jobrole-update']),
                'id' => $id
            ];

            //Check whether the entered job role is already available in the database
            $jobrolesList = $this->jobroleModel->getJobroles();
            $jobroleExists = false;

            foreach ($jobrolesList as $jobrole) {
                if (strtolower($jobrole->name) == strtolower(trim($_POST['jobrole-update']))) {
                    // Redirect
                    $jobroleExists = true;
                    break;
                }
            }

            if ($jobroleExists) {
                // Redirect
                flashMessage('jobroleView', 'Job Role already exists, Please check again!', 'danger-alert');
                redirect('jobroles');
            } else {
                $this->jobroleModel->updateJobrole($data);
                redirect('jobroles');
            }
        } else {
            //redirect to error page
            redirect('jobroles');
        }
    }

    public function deleteJobrole($id)
    {
        $this->jobroleModel->deleteJobrole($id);
    }
}
