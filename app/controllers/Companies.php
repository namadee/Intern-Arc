<?php

class Companies extends BaseController
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

    //COMPANY USER DASHBOARD 
    public function index()
    {
        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
        $dashboardData = $this->companyModel->getRequestsbyCompany($companyId);
        $requestArray = $this->requestModel->getStudentRequests(0);

        

        $data = [
            'companyId' => $companyId,
            'dashboard' => $dashboardData,
        ];

    

        $this->view('company/dashboard', $data);
    }

    // Manage Company- PDC - Ruchira
    public function manageCompany($pg = NULL)
    {
        $companyList = $this->companyModel->getCompanyList();
        $all_access = $this->companyModel->checkSystemAccessCompanies();

        if ($pg == 'deactivated') {

            $blacklistedCompanyList = $this->companyModel->getDeativatedCompanyList();
            $data = [
                'blacklisted_modal_class' => '',
                'change_access_modal' => 'hide-element',
                'company_list' => $companyList,
                'blacklisted_list' => $blacklistedCompanyList,
                'company_access'=> $all_access->all_access
            ];

            $this->view('pdc/manageCompany', $data);

        } elseif($pg == 'change-access' ) {

            $data = [
                'blacklisted_modal_class' => 'hide-element',
                'company_list' => $companyList,
                'blacklisted_list' => NULL,
                'change_access_modal' => '',
                'company_access'=> $all_access->all_access
            ];

            $this->view('pdc/manageCompany', $data);

        } else {

            $data = [
                'blacklisted_modal_class' => 'hide-element',
                'company_list' => $companyList,
                'blacklisted_list' => NULL,
                'change_access_modal' => 'hide-element',
                'company_access'=> $all_access->all_access
            ];

            $this->view('pdc/manageCompany', $data);
        }
    }

    // Company Details Company- PDC
    public function CompanyDetails()
    {
        $this->view('pdc/companyDetails');
    }

    //View Company List - STUDENT
    public function viewCompanyList()
    {

        $this->view('student/viewcompanies');
    }

    //View Applied Company List - STUDENT
    public function viewAppliedCompanyList()
    {
        $this->view('student/appliedcompanies');
    }

    //View Applied Company List - STUDENT
    public function viewCompanyDetails()
    {
        $this->view('student/appliedcompanies');
    }

    public function shortlistedStudents()
    {
        $this->view('company/shortlistedStudents');
    }

    public function InterviewScheduleList()
    {
        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
        $advertisements = $this->advertisementModel->getAdvertisementsByCompany($companyId);
        $data = [
            'advertisements' => $advertisements
        ];

        $this->view('company/InterviewScheduleList', $data);
    }

    public function InterviewScheduleCreate($advertisementId)
    {
        $data =[
            'advertisment_id' => $advertisementId,
            'formAction' => 'advertisements/createInterviewSlots/'.$advertisementId,
        ];
        $this->view('company/calander', $data);
    }

    public function InterviewSchedule()
    {
        $this->view('company/InterviewSchedule');
    }

   //SHORTLIST STUDENTS
   public function shortlistStudent($id){
    if(isset($_POST["status"])){
        //Handling changing status to shortist or reject
        $data = [
            'request_id' => trim($_POST['request_id']),
            'status' => trim($_POST['status'])
        ];

        $this->companyModel->shortlistStudent($data);
        flashMessage('shortlist_student_msg', 'Student Added to Shortlist');
        redirect('requests/showRequestsByAd/'.$id);
    }
   }

   //DISPLAY ADVERTISEMENT LIST WITH RELEVENT SHORTLISTED STUDENTS COUNT
   public function getAdvertisementByStatus(){
    $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
    $advertisements = $this->advertisementModel->getAdvertisementsByCompany($companyId);
    
    $shortlistedCounts = array();
    $x=0;
    foreach($advertisements as $advertisement)
    {
        $shortlists = $this->companyModel->getAdvertisementByStatus($advertisement->advertisement_id);
        $shortlistedCounts[$x] = count($shortlists);
        $positions[$x] = $advertisement->position;
        $intern_counts[$x] = $advertisement->intern_count;
        $x++;
    }
    
    
    $data = [
        'count' => $shortlistedCounts,
        'length' => count($shortlistedCounts),
        'positions' => $positions,
        'intern_counts' => $intern_counts,
        'advertisements' =>$advertisements,
        
    ];

    $this->view('company/shortlist', $data);

}


   //GET SHORTLISTED STUDENTS FOR RELEVENT ADVERTISEMENT
   public function getShortlistedStudents($advertisementId){
    $students = $this->companyModel->getShortlistedStudents($advertisementId);

    $data = [
        'advertisement_id' => $advertisementId,
        'student_name' => $students,
    ];
    
    if ($this->companyModel->getShortlistedStudents($advertisementId)) {

        $this->view('company/shortlistedStudents', $data);
    } else {
        die('Something went wrong');
    }

   }

   //RECRUIT OR REJECT STUDENT FROM DROP DOWN
   public function recruitStudent($id){
    if(isset($_POST["recruit_status"])){
        //Handling changing status to shortist or reject
        $data = [
            'request_id' => trim($_POST['request_id']),
            'recruit_status' => trim($_POST['recruit_status'])
        ];

        $this->companyModel->recruitStudent($data);
        flashMessage('recruit_student_msg', 'Student Recruited');
        redirect('companies/get-shortlisted-students/'.$id);
    }

   }
   

}
