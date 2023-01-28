<?php

class Advertisements extends BaseController
{
    public $jobroleList;
    public $jobroleModel;
    public $advertisementModel;
    public $userModel;

    public function __construct()
    {
        $this->advertisementModel = $this->model('Advertisement');
        $this->jobroleModel = $this->model('Jobrole');
        $this->jobroleList = $this->jobroleModel->getJobroles();
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $advertisements = $this->advertisementModel->getAdvertisements();
        //view pass data values $data

        $data = [

            'advertisements' => $advertisements,
            'formAction' => 'Advertisements/add-advertisement'

        ];

        $this->view('company/advertisementList', $data);
    }

    public function addAdvertisement()
    {

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $companyId = $this->userModel->getCompanyUserId(($_SESSION['user_id']));


            $data = [
                'company_id' => $companyId,
                'position' => trim($_POST['position']),
                'job_description' => trim($_POST['job_description']),
                'requirements' => trim($_POST['requirements']),
                'internship_start' => date('y-m-d', strtotime($_POST['internship_start'])),
                'internship_end' => date('y-m-d', strtotime($_POST['internship_end'])),
                'no_of_interns' => trim($_POST['no_of_interns']),
                'working_mode' => trim($_POST['working_mode']),
                'required_year' => trim($_POST['required_year']),
            ];

            //Execute
            if ($this->advertisementModel->addAdvertisement($data)) {

                redirect('advertisements');
            } else {
                die('Something went wrong');
            }
        } else {

            $data = [

                'position' => '',
                'job_description' => '',
                'requirements' => '',
                'internship_start' => '',
                'internship_end' => '',
                'no_of_interns' => '',
                'working_mode' => '',
                'required_year' => '',
                'formAction' => 'advertisements/add-advertisement/',
                'jobroleList' => $this->jobroleList
            ];


            $this->view('company/addAdvertisement', $data);
        }
    }

    public function showAdvertisement($advertisementId)
    {

        $advertisement = $this->advertisementModel->showAdvertisementById($advertisementId); //To get the Advertisement Name

        $data = [
            'className' => 'selectedTab',
            'title' => 'Advertisements',
            'position' => $advertisement->position,
            'job_description' => $advertisement->job_description,
            'requirements' => $advertisement->requirements,
            'no_of_interns' => $advertisement->intern_count,
            'working_mode' => $advertisement->working_mode,
            'required_year' => $advertisement->applicable_year,
            'internship_start' => $advertisement->start_date,
            'internship_end' => $advertisement->end_date,
            'jobroleList' => $this->jobroleList,
            'formAction' => 'advertisements/update-advertisement/' . $advertisement->advertisement_id
        ];

        $this->view('company/addAdvertisement', $data);
    }

    public function updateAdvertisement($advertisementId)
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();

            $data = [
                'position' => trim($_POST['position']),
                'job_description' => trim($_POST['job_description']),
                'requirements' => trim($_POST['requirements']),
                'internship_start' => date('y-m-d', strtotime($_POST['internship_start'])),
                'internship_end' => date('y-m-d', strtotime($_POST['internship_end'])),
                'no_of_interns' => trim($_POST['no_of_interns']),
                'working_mode' => trim($_POST['working_mode']),
                'required_year' => trim($_POST['required_year']),
                'advertisement_id' => $advertisementId
            ];

            //Execute
            if ($this->advertisementModel->updateAdvertisement($data)) {

                // Redirect
                redirect('advertisements');
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
            $this->view('company/add-advertisement', $data);
        }
    }

    public function deleteAdvertisement($advertisementId)
    {
        $this->advertisementModel->deleteAdvertisement($advertisementId);
    }

    //SHOW ADVERTISEMENTS - STUDENT
    public function showStudentAdvertisements(){
        $this->view('student/advertisements');

    }

    //SHOW ADVERTISEMENTS Under Specific Company- STUDENT
    public function showAdvertisementsByCompany(){
        $this->view('student/viewads');
    }

        //SHOW ADVERTISEMENTS Under Specific Company- STUDENT
        public function showAdvertisementsDetails(){
            $this->view('student/viewadvertisement');
        }

}
