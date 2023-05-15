<?php

class Ajax extends BaseController
{
    public $complaintModel, $ajaxModel, $userModel, $advertisementModel, $requestModel, $companyModel;

    public function __construct()
    {
        $this->complaintModel = $this->model('Complaint');
        $this->userModel = $this->model('User');
        $this->ajaxModel = $this->model('Ajax');
        $this->advertisementModel = $this->model('Advertisement');
        $this->requestModel = $this->model('Request');
        $this->companyModel = $this->model('Company');
    }

    public function index()
    {

        if ($_SESSION['user_role'] == 'admin') {
            $page = 'admin';
        } else {
            $page = 'pdc';
        }
        //PDC Company Search 
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];
            if ($this->ajaxModel->searchCompanyFunction($searchItem)) {
                $resultList = $this->ajaxModel->searchCompanyFunction($searchItem);
                foreach ($resultList as $company) {



                    echo '<a href="' . URLROOT . $page . '/main-company-details/' . $company->user_id . '">' . $company->company_name . '</a>';
                }
            } else {
                echo '<a href="#">No companies found</a>';
            }
        } else {
            redirect('errors');
        }
    }

    public function searchStudentByIndex()
    {

        if ($_SESSION['user_role'] == 'admin') {
            $page = 'admin';
        } else {
            $page = 'pdc';
        }

        //PDC Student Search 
        // Consider Batch Year also
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];
            $batchYear = $_POST['batchYear'];
            $stream = $_POST['stream'];

            if ($this->ajaxModel->searchStudentByIndex($searchItem, $batchYear, $stream)) {
                $resultList = $this->ajaxModel->searchStudentByIndex($searchItem, $batchYear, $stream);
                foreach ($resultList as $student) {
                    echo '<a href="' . URLROOT . $page . '/main-student-details/' . $student->user_id . '">' . $student->index_number . '</a>';
                }
            } else {
                echo '<a href="#">No Students found</a>';
            }
        } else {
            redirect('errors');
        }
    }

    public function searchAdvertisementByBatchYear()
    {

        //PDC Advertisemnet Search for review 
        // Consider Batch Year also
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];
            $batchYear = $_POST['batchYear'];

            if ($this->ajaxModel->searchAdvertisementByBatchYear($searchItem, $batchYear)) {
                $resultList = $this->ajaxModel->searchAdvertisementByBatchYear($searchItem, $batchYear);
                foreach ($resultList as $advertisement) {
                    echo '<a href="' . URLROOT . 'advertisements/viewAdvertisement/' . $advertisement->advertisement_id . '">' . $advertisement->position . ' - ' .  $advertisement->company_name . '</a>';
                }
            } else {
                echo '<a href="#">No Advertisements found</a>';
            }
        } else {
            redirect('errors');
        }
    }

    public function searchRequestByYearRound()
    {

        //PDC Student Request Search for review 
        // Consider Batch Year, Round and Stream
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];
            $batchYear = $_POST['batchYear'];
            $round = $_POST['round'];
            $stream = $_POST['stream'];


            if ($this->ajaxModel->getStudentRequestsByRound($searchItem, $batchYear, $round, $stream)) {
                $resultList = $this->ajaxModel->getStudentRequestsByRound($searchItem, $batchYear, $round, $stream);
                foreach ($resultList as $student) {
                    echo '<a href="' . URLROOT . 'pdc/requestListByStudent/' . $round . '/' . $student->student_id . '">' . $student->index_number . '</a>';
                }
            } else {
                echo '<a href="#">No Students found</a>';
            }
        } else {
            redirect('errors');
        }
    }

    public function companyRegistration()
    {
        //PDC Student Search 
        // Consider Batch Year also
        if (isset($_POST['                                                                                                              '])) {
            $registeredYear = $_POST['query'];

            if ($this->ajaxModel->getCompanyByRegisteredYear($registeredYear)) {
                $resultList = $this->ajaxModel->searchStudentByIndex($registeredYear);
                foreach ($resultList as $student) {
                    echo '<a href="' . URLROOT . 'pdc/main-student-details/' . $student->user_id . '">' . $student->index_number . '</a>';
                }
            } else {
                echo '<a href="#">No Students found</a>';
            }
        } else {
            redirect('errors');
        }
    }

    public function searchComplaint()
    {
        //Admin Complaint Search 
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];
            if ($this->ajaxModel->searchComplaintFunction($searchItem)) {
                $resultList = $this->ajaxModel->searchComplaintFunction($searchItem);
                foreach ($resultList as $complaint) {


                    echo '<a href="' . URLROOT . 'admin/complaint/' . $complaint->complaint_id . '/' . $complaint->user_id . '">' . $complaint->reference_number . '</a>';
                }
            } else {
                echo '<a href="#">No Complaint found</a>';
            }
        } else {
            redirect('errors');
        }
    }


    public function companySearchAdByCompany()
    {

        //PDC Company Search 
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];
            $companyId = $_POST['companyId'];

            if ($this->ajaxModel->searchAdvertisementsByCompany($companyId, $searchItem)) {
                $resultList = $this->ajaxModel->searchAdvertisementsByCompany($companyId, $searchItem);
                foreach ($resultList as $advertisement) {



                    echo '<a href="' . URLROOT . 'advertisements/view-advertisement/' . $advertisement->advertisement_id . '">' . $advertisement->position . '</a>';
                }
            } else {
                echo '<a href="#">No advertisements found</a>';
            }
        } else {
            redirect('errors');
        }
    }


    public function AdvertisementListRequests()
    {

        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);

        
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];

            if ($this->ajaxModel->searchAdvertisementsByPosition($companyId, $searchItem)) {
                $resultList =$this->ajaxModel->searchAdvertisementsByPosition($companyId, $searchItem);
                foreach ($resultList as $advertisement) {
                    $requests = $this->requestModel->getAdvertisementByRequest($advertisement->advertisement_id);
                    $requestCounts= count($requests);

                    if ($requestCounts != 0) {
                        echo '<a href="' . URLROOT . 'requests/show-requests-by-ad/' . $advertisement->advertisement_id . '">' . $advertisement->position . '</a>';
                    }else {
                        echo '<a href="' . URLROOT . 'errors/no-data">' . $advertisement->position . '</a>';
                    }


                }
            } else {
                echo '<a href="#">No advertisements found</a>';
            }
        } else {
            redirect('errors');
        }
    
    }


    public function AdvertisementShortlistListRequests()
    {

        $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);

        
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];

            if ($this->ajaxModel->searchShortlistedAdvertisementByPosition($companyId, $searchItem)) {
                $resultList =$this->ajaxModel->searchShortlistedAdvertisementByPosition($companyId, $searchItem);
                foreach ($resultList as $advertisement) {
                    $shortlists = $this->companyModel->getAdvertisementByStatus($advertisement->advertisement_id);
                    $shortlistedCounts= count($shortlists);

                    if ($shortlistedCounts != 0) {
                        echo '<a href="' . URLROOT . 'companies/get-shortlisted-students/' . $advertisement->advertisement_id . '">' . $advertisement->position . '</a>';
                    }else {
                        echo '<a href="' . URLROOT . 'errors/no-data">' . $advertisement->position . '</a>';
                    }


                }
            } else {
                echo '<a href="#">No advertisements found</a>';
            }
        } else {
            redirect('errors');
        }
    
    }
}
