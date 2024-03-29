<?php

class Advertisements extends BaseController
{
    public $jobroleList;
    public $jobroleModel;
    public $advertisementModel;
    public $userModel;
    public $companyData;
    public $companyModel;
    public $pdcModel;
    public $studentModel;


    public function __construct()
    {
        $this->companyModel = $this->model('Company');
        $this->advertisementModel = $this->model('Advertisement');
        $this->jobroleModel = $this->model('Jobrole');
        $this->jobroleList = $this->jobroleModel->getJobroles();
        $this->userModel = $this->model('User');
        $this->companyData = $this->advertisementModel->getCompanyByAd();
        $this->pdcModel = $this->model('Pdc');
        $this->studentModel = $this->model('Student');
    }

    public function index()
    {
        $advertisements = $this->advertisementModel->getAdvertisements();

        $data = [

            'advertisements' => $advertisements,
            'formAction' => 'Advertisements/add-advertisement'

        ];

        $this->view('company/advertisementList', $data);
    }


    //Get advertisements by company - company - Namadee

    public function getAdvertisementsByCompany($companyId = NULL)
    {



        if ($_SESSION['user_role'] == 'company' && $companyId == NULL) {

            $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
            $ads = $this->advertisementModel->getAdvertisementsByCompany($companyId);



            $data = [
                'advertisements' => $ads,
                'companyID' => $companyId,
                'formAction' => 'Advertisements/add-advertisement'
            ];


            $this->view('company/advertisementList', $data);
        } else if ($_SESSION['user_role'] == 'student' && $companyId != NULL) {

            $companyDetails = $this->companyModel->getCompanyDetailFromCompanyID($companyId);
            $ads = $this->advertisementModel->getAdvertisementsByCompany($companyId);

            $data = [
                'advertisements' => $ads,
                'companyID' => $companyId,
                'companyName' => $companyDetails->company_name,
            ];
            $this->view('student/companyadlist', $data);
        } else {
            $this->view('error403');
        }
    }


    public function addAdvertisement()
    {

        if ($_SESSION['user_role'] == 'company') {
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

                    redirect('advertisements/get-advertisements-by-company');
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
        } else {
            $this->view('error403');
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
            'buttonClass' => '',
            'formAction' => 'advertisements/update-advertisement/' . $advertisement->advertisement_id
        ];

        $this->view('company/addAdvertisement', $data);
    }

    public function updateAdvertisement($advertisementId)
    {
        if ($_SESSION['user_role'] == 'company') {
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
                    redirect('advertisements/get-advertisements-by-company');
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
        } else {
            $this->view('error403');
        }
    }

    public function deleteAdvertisement($advertisementId)
    {
        if ($_SESSION['user_role'] == 'company') {
            $this->advertisementModel->deleteAdvertisement($advertisementId);
        } else {
            $this->view('error403');
        }
    }

    //SHOW All ADVERTISEMENTS FROM ALL COMPANIES - STUDENT
    public function showStudentAdvertisements()
    {

        // Recruited stuents can not view advertisements
        if ($_SESSION['user_role'] == 'student' && $_SESSION['studentStatus'] == 1) {
            flashMessage('recrtuited_noAccess', 'You are not allowed to access advertisement page', 'danger-alert');
            redirect('students/');
        }

        $roundDataArray = roundCheckFunction();

        // IF roundNumber is not set
        //Filter ads by round, batchYear and approved status
        //Must filter by round also
        if ($roundDataArray['roundNumber'] == 1) {
            $advertisementList = $this->advertisementModel->getAdvertisementsForStudents($roundDataArray['roundNumber'], $_SESSION['batchYear']);

            $data = [

                'advertisemetList' => $advertisementList,
                'roundNumer' => $roundDataArray['roundNumber'],
                'status' => 1
            ];

            $this->view('student/advertisements', $data);
        } else if ($roundDataArray['roundNumber'] == 2) {

            $selectedJobRoleName = array();
            // Round number is 2
            $studentId = $this->userModel->getStudentUserId(($_SESSION['user_id']));

            // Filter ads from selected Job roles form std_jbrole_tbl
            $userSelectedJobRoles = $this->pdcModel->getSelectedJobRoles($studentId);
            // return 3 rows
            foreach ($userSelectedJobRoles as $userSelectedJobRole) {
                $jobrole =  $this->pdcModel->getJobroleName($userSelectedJobRole->jobrole_id);
                $selectedJobRoleName[] = $jobrole->name;
            }

            // Get three job role names
            $jobrole1 = $selectedJobRoleName[0];
            $jobrole2 = $selectedJobRoleName[1];
            $jobrole3 = $selectedJobRoleName[2];

            // Get advertisements for the selected job roles

            $data = [
                'batchYear' => $_SESSION['batchYear'],
                'position1' => $jobrole1,
                'position2' => $jobrole2,
                'position3' => $jobrole3
            ];

            $advertisementList = $this->pdcModel->getFilteredAds($data);

            $data = [

                'advertisemetList' => $advertisementList,
                'roundNumer' => $roundDataArray['roundNumber'],
                'status' => 1
            ];

            $this->view('student/advertisements', $data);
        } else {
            $data = [

                'status' => 0
            ];

            $this->view('student/advertisements', $data);
        }
    }

    //SHOW ADVERTISEMENTS Under Specific Company- STUDENT
    public function showAdvertisementsByCompany()
    {
        if ($_SESSION['user_role'] == 'student') {
            $this->view('student/viewads');
        } else {
            $this->view('error403');
        }
    }

    //load The advertisement UI of the relevant company 
    public function viewAdvertisement($advertisementId = NULL)
    {
        //company user access
        $advertisement = $this->advertisementModel->showAdvertisementById($advertisementId); //To get the Advertisement Name
        $text = explode("\r\n", trim($advertisement->requirements));
        $length = count($text);
        $emptyArray = array();
        for ($x = 0; $x < $length; $x++) {
            $emptyArray[$x] = "* " . trim($text[$x]) . "<br>";
        }
        $completeString = implode("", $emptyArray);

        //BUTTON NAME : if user role is student apply btn else view requests btn
        //BUTTON LINK : if user role is student apply link else view requests link
        //BUTTON NAME : if user role is student apply btn else view requests btn
        //BUTTON LINK : if user role is student apply link else view requests link
        if ($_SESSION['user_role'] == 'student') {
            $btnClass = '';
            $btnName = 'Apply';
        } else if ($_SESSION['user_role'] == 'company') {
            $btnClass = '';
            $btnName = 'View Requests';
        } else {
            //PDC OR ADMIN
            $btnClass = 'style = "display:none"';
            $btnName = '';
        }
        $data = [
            'className' => 'selectedTab',
            'title' => 'Advertisements',
            'advertisement_id' => $advertisementId,
            'company_name' => $advertisement->company_name,
            'buttonClass' => '',
            'button_name' => $btnName,
            'position' => $advertisement->position,
            'job_description' => $advertisement->job_description,
            'requirements' => $completeString,
            'no_of_interns' => $advertisement->intern_count,
            'working_mode' => $advertisement->working_mode,
            'required_year' => $advertisement->applicable_year,
            'internship_start' => $advertisement->start_date,
            'internship_end' => $advertisement->end_date,
            'companyName' => $advertisement->company_name,
            'buttonClass' => $btnClass,
        ];

        $this->view('company/advertisement', $data);
    }

    //Create Interview slots - company  - Namadee

    public function createInterviewSlots($advertisementId)
    {
        if ($_SESSION['user_role'] == 'company') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Strip Tags
                $_POST['start_time'] = array_map('strip_tags', $_POST['start_time']);
                $_POST['end_time'] = array_map('strip_tags', $_POST['end_time']);

                $data = [
                    'advertisement_id' => $advertisementId,
                    'start_date' => trim($_POST['start_date']),
                    'end_date' => trim($_POST['end_date']),
                    'recurrence' => trim($_POST['recurrence']),
                    'interviewee_count' => trim($_POST['interviewee_count']),
                    'duration' => trim($_POST['duration']),
                    'schedule_status' => trim($_POST['schedule_status']),
                    'time_periods' => [],
                    'time_slots' => []
                ];

                // Combine start time and end time into time periods
                foreach ($_POST['start_time'] as $index => $startTime) {
                    $endTime = $_POST['end_time'][$index];
                    $data['time_periods'][] = [
                        'start_time' => $startTime,
                        'end_time' => $endTime
                    ];
                }
                //break down time periods into time slots
                $duration = $data['duration'];
                $recurrence = $data['recurrence'];
                $timePeriods = $data['time_periods'];

                if ($recurrence == 'daily') {
                    //schedule start date 
                    $startDate = $data['start_date'];
                    //schedule end date
                    $endDate = $data['end_date'];
                    //while end date > start date
                    while ($endDate > $startDate) {
                        //foreach timeperiods
                        foreach ($timePeriods as $period) {
                            // $startTime = $period['start_time'];
                            // $endTime = $period['end_time'];

                            $startTime = strtotime($period['start_time']);
                            $endTime = strtotime($period['end_time']);
                            $convertedDuration = $duration * 60;

                            // Loop through each slot within the period
                            while ($startTime < $endTime) {
                                // Get the slot start time and end time
                                $slotStart = date('h:i A', $startTime);
                                $slotEnd = date('h:i A', $startTime + $convertedDuration);

                                for ($i = 0; $i < $data['interviewee_count']; $i++) {
                                    $data['time_slots'][] = [
                                        'start_time' => $slotStart,
                                        'end_time' => $slotEnd,
                                        'date' => $startDate
                                    ];
                                }

                                $startTime = $startTime + $convertedDuration;
                            }
                        }
                        //increment start date by one day
                        $startDate = date('Y-m-d', strtotime($startDate . ' +1 day'));
                    }
                } else {
                    $startDate = $data['start_date'];
                    //schedule end date
                    $endDate = $data['end_date'];
                    //while end date > start date
                    while ($endDate > $startDate) {
                        //foreach timeperiods
                        foreach ($timePeriods as $period) {
                            // $startTime = $period['start_time'];
                            // $endTime = $period['end_time'];

                            $startTime = strtotime($period['start_time']);
                            $endTime = strtotime($period['end_time']);
                            $convertedDuration = $duration * 60;

                            // Loop through each slot within the period
                            while ($startTime < $endTime) {
                                // Get the slot start time and end time
                                $slotStart = date('h:i A', $startTime);
                                $slotEnd = date('h:i A', $startTime + $convertedDuration);

                                //add time slots to timeslots[] array
                                //multiply time slots by interviewee count
                                for ($i = 0; $i < $data['interviewee_count']; $i++) {
                                    $data['time_slots'][] = [
                                        'start_time' => $slotStart,
                                        'end_time' => $slotEnd,
                                        'date' => $startDate
                                    ];
                                }


                                $startTime = $startTime + $convertedDuration;
                            }
                        }
                        //increment start date by one day
                        $startDate = date('Y-m-d', strtotime($startDate . ' +7 day'));
                    }
                }


                //flashMessage('schedule_interview_msg', 'Interviews scheduled successfully');

                //Execute
                if ($this->advertisementModel->createInterviewSlots($data)) {
                    redirect('companies/interview-schedule-create/' . $advertisementId);
                } else {
                    die('Something went wrong');
                }
            }
        } else {
            $this->view('error403');
        }
    }
}
