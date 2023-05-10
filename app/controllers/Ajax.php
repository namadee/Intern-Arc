<?php

class Ajax extends BaseController
{
    public $complaintModel, $ajaxModel, $userModel;

    public function __construct()
    {
        $this->complaintModel = $this->model('Complaint');
        $this->userModel = $this->model('User');
        $this->ajaxModel = $this->model('Ajax');
    }

    public function index()
    {
        //PDC Company Search 
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];
            if ($this->ajaxModel->searchCompanyFunction($searchItem)) {
                $resultList = $this->ajaxModel->searchCompanyFunction($searchItem);
                foreach ($resultList as $company) {
                    echo '<a href="' . URLROOT . 'pdc/main-company-details/' . $company->user_id . '">' . $company->company_name . '</a>';
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

        //PDC Student Search 
        // Consider Batch Year also
        if (isset($_POST['query'])) {
            $searchItem = $_POST['query'];
            $batchYear = $_POST['batchYear'];
            $stream = $_POST['stream'];

            if ($this->ajaxModel->searchStudentByIndex($searchItem, $batchYear, $stream)) {
                $resultList = $this->ajaxModel->searchStudentByIndex($searchItem, $batchYear, $stream);
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
}
