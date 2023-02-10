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
            $text = explode("\r<\br>", trim($_POST['requirements-list']));
            $length = count($text);

            $emptyArray = array();
            for ($x = 0; $x < $length; $x++) {
                $emptyArray[$x] = trim($text[$x]); 
            }
            $completeString = implode("", $emptyArray);
       



            $data = [
                'company_id' => $companyId,
                'position' => trim($_POST['position']),
                'job_description' => trim($_POST['job_description']),
                'requirements-list' => $emptyArray,
                'requirements' => $completeString,
                'textElement' => $text[0],
                'internship_start' => date('y-m-d', strtotime($_POST['internship_start'])),
                'internship_end' => date('y-m-d', strtotime($_POST['internship_end'])),
                'no_of_interns' => trim($_POST['no_of_interns']),
                'working_mode' => trim($_POST['working_mode']),
                'required_year' => trim($_POST['required_year']),
                'formAction' => 'advertisements/add-advertisement/',
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
                'requirements-list' => '',
                'requirements' => '',
                'internship_start' => '2030-13-13',
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
                'advertisement_id' => $advertisementId,
                'formAction' => 'advertisements/update-advertisement/',
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
            $this->view('company/advertisement');
        }
    
    //load The advertisement UI of the relevant company 
    public function viewAdvertisement($advertisementId){
        $advertisement = $this->advertisementModel->showAdvertisementById($advertisementId); //To get the Advertisement Name
       
            $text = explode("\r\n", trim($advertisement->requirements));
            $length = count($text);

            $emptyArray = array();
            for ($x = 0; $x < $length; $x++) {
                $emptyArray[$x] = trim($text[$x]); 
            }
            $completeString = implode("", $emptyArray);
        $data = [
            'className' => 'selectedTab',
            'title' => 'Advertisements',
            'position' => $advertisement->position,
            'job_description' => $advertisement->job_description,
            'requirements' => $completeString,
            'no_of_interns' => $advertisement->intern_count,
            'working_mode' => $advertisement->working_mode,
            'required_year' => $advertisement->applicable_year,
            'internship_start' => $advertisement->start_date,
            'internship_end' => $advertisement->end_date,
        ];

        $this->view('company/advertisement', $data);
        
    }
    
    
    public function test(){
        // $text = explode("\r\n", trim($_POST['requirements-list']));
        // $length = count($text);

        // foreach ($text as $value) {
        //     $value .= 'this is a text';
        // }
        // $emptyArray = array();
        // for ($x = 0; $x < $length; $x++) {
        //     $emptyArray[$x] = trim($text[$x]) .'\n'; 
        // }
        // $completeString = implode("", $emptyArray);
        // $data = [
        //     'requirements-list' => $emptyArray,
        //     'length' => $completeString,
        //     'textElement' => $text[0],
        // ];

        //$this->view('test', $data);

    }
    
    //store completestring in the requirements column
    //take the value from data base and explode /n wena wenama and add it to a array same thing as above text var 
    //display it in the atextarea
    //before second step try third step and check
}

