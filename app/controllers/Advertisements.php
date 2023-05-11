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

        $this->view('company/advertisementList', $data);
    }


    //Get advertisements by company - company - Namadee

    public function getAdvertisementsByCompany()
    {
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
    //SHOW All ADVERTISEMENTS FROM ALL COMPANIES - STUDENT
    public function showStudentAdvertisements()
    {
        $data = [
            'companyData' => $this->companyData
        ];
        $this->view('student/advertisements', $data);
    }

    //SHOW ADVERTISEMENTS Under Specific Company- STUDENT
    public function showAdvertisementsByCompany()
    {
        $this->view('student/viewads');
    }

    //SHOW ADVERTISEMENTS Under Specific Company- STUDENT
    public function showAdvertisementsDetails()
    {
        $this->view('company/advertisement');
        $this->view('company/advertisement');
    }

    //load The advertisement UI of the relevant company 
    public function viewAdvertisement($advertisementId)
    {
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
        if ($_SESSION['user_role'] == 'student') {
            $btnName = 'Apply';
        } else {
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

    //Create Interview slots - company  - Namadee

    public function createInterviewSlots($advertisementId)
    {
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
                redirect('advertisements');
            } else {
                die('Something went wrong');
            }
        }
    }

    //get schedule data and event data to fullcalndr event object - namadee
    public function getCalanderEvents($advertisementId)
    {
        $events = $this->advertisementModel->getCalanderEvents($advertisementId);
        $data = [
            'events' => $events
        ];
        $this->view('company/calander', $data);
    }

    //Get time slots and connect schedule, event, time period tables - company calendar - Namadee
    public function getInterviewSlots($advertisementId)
    {
        $interviewSlots = $this->advertisementModel->getInterviewSlots($advertisementId);
        $data = [
            'interviewSlots' => $interviewSlots
        ];
        $this->view('company/calander', $data);
    }
}
