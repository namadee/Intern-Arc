<?php

class Schedule extends BaseController
{

  public $companyModel;
  public $userModel;
  public $advertisementModel;
  public $requestModel;


  public function __construct()
  {
    $this->companyModel = $this->model('Company');
    $this->userModel = $this->model('User');
    $this->advertisementModel = $this->model('Advertisement');
    $this->requestModel = $this->model('Request');
  }


  public function index()
  {
    $interviewSlots = $this->advertisementModel->getInterviewSlots();
    $data = [
      'interviewSlots' => $interviewSlots
    ];

    $this->view('student/scheduleInterview', $data);
  }
}
