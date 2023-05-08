<?php

class Advertisements extends BaseController
{
    public $jobroleList;
    public $jobroleModel;
    public $advertisementModel;
    public $userModel;
    public $companyData;


    public function __construct()
    {
        $this->advertisementModel = $this->model('Advertisement');
        $this->jobroleModel = $this->model('Jobrole');
        $this->jobroleList = $this->jobroleModel->getJobroles();
        $this->userModel = $this->model('User');
        $this->companyData = $this->advertisementModel->getCompanyByAd();
    }

    public function index()
    {
        $advertisements = $this->advertisementModel->getAdvertisements();

        $data = [

            'advertisements' => $advertisements,
            'formAction' => 'Advertisements/add-advertisement'

        ];

        $this->view('company/interviewScheduleList', $data);
    }

    //Get advertisements by company - company - Namadee

    public function getAdvertisementsByCompany() {
        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
        $ads = $this->advertisementModel->getAdvertisementsByCompany($companyId);

        $data = [
            'advertisements' => $ads,
            'companyID' => $companyId,
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
            //$completeString = implode("", $emptyArray);
            



            $data = [
                'company_id' => $companyId,
                'position' => trim($_POST['position']),
                'job_description' => trim($_POST['job_description']),
                'requirements-list' => $emptyArray,
                'requirements' => $emptyArray,
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

    public function showAdvertisementById($advertisementId)
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
            $text = explode("\r<\br>", trim($_POST['requirements-list']));
            $length = count($text);

            $emptyArray = array();
            for ($x = 0; $x < $length; $x++) {
                $emptyArray[$x] = trim($text[$x]); 
            }
            //$completeString = implode("", $emptyArray);

            $data = [
                'position' => trim($_POST['position']),
                'job_description' => trim($_POST['job_description']),
                'requirements' => $emptyArray[0],
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

    //SHOW All ADVERTISEMENTS FROM ALL COMPANIES - STUDENT
    public function showStudentAdvertisements(){
        $data = [
            'companyData' => $this->companyData
        ];
        $this->view('student/advertisements', $data);

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
        // $advertisementId = $_GET['adId'];
        $advertisement = $this->advertisementModel->showAdvertisementById($advertisementId); //To get the Advertisement Name
       
            $text = explode("\r\n", trim($advertisement->requirements));
            $length = count($text);

            $emptyArray = array();
            for ($x = 0; $x < $length; $x++) {
                $emptyArray[$x] = trim($text[$x]); 
            }
            $completeString = implode("", $emptyArray);
            //BUTTON NAME : if user role is student apply btn else view requests btn
            //BUTTON LINK : if user role is student apply link else view requests link
            if($_SESSION['user_role'] == 'student'){ 
                $btnName = 'Apply'; 
            }else{
                $btnName = 'View Requests';
            }
        $data = [
            'className' => 'selectedTab',
            'title' => 'Advertisements',
            'advertisement_id' => $advertisementId,
            'button_name' => $btnName,
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

        $this->view('test');

    }

    

}

