<?php

class Requests extends BaseController
{

    public $requestModel;
    public $requestList;
    public $userModel;
    public $advertisementModel;
    
    public function __construct()
    {
        $this->requestModel = $this->model('Request');
        $this->userModel = $this->model('User');
        $this->advertisementModel = $this->model('Advertisement');
    }

    public function index()
    {
        $this->view('company/studentRequestList');
    }

    //Applying to advertisement
    public function addStudentRequest(){
        $advertisementId = $_GET['adId'];
        $studentId =  $this->userModel->getStudentUserId($_SESSION['user_id']);
        $data = [
            'advertisement_id' => $advertisementId,
            'student_id' => $studentId
        ];

        //Execute
        if ($this->requestModel->addStudentRequest($data)) {

            redirect('advertisements/test');
        } else {
            die('Something went wrong');
        }
    }

    public function allRequests() 
    {
        $requests = $this->requestModel->getRequests();
        $data = [
            'requests' => $requests,
        ];
        $this->view('pdc/studentRequest', $data);
    }

    public function shortlistedList() 
    {
        $this->view('company/shortlist');
    }

    public function showRequestsByAd($advertisementId){
        // $advertisementId = $_GET['adId']; 
        $students = $this->requestModel->getStudentByRequest($advertisementId);

        $data = [
            'student_name' => $students,
        ];
        
        if ($this->requestModel->getStudentByRequest($advertisementId)) {

            $this->view('company/RequestListByAdvertisement', $data);
        } else {
            die('Something went wrong');
        }

    }

}
?>
