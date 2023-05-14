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
        if ($_SESSION['user_role'] == 'company') {
            $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
            $dashboardData = $this->companyModel->getRequestsbyCompany($companyId);
            $requestArray = $this->requestModel->getStudentRequests(0);
            $ads = $this->advertisementModel->getAdvertisementsByCompany($companyId);
            //get the leangth f $ads
            $length = count($ads);
            $adcount = 0;
            //loop through the $ads
            for ($x = 0; $x < $length; $x++) {
                $adcount++;
            }

            $data = [
                'companyId' => $companyId,
                'total' => $adcount,
                'dashboard' => $dashboardData,
            ];
            $this->view('company/dashboard', $data);
        } else {
            $this->view('error403');
        }
    }

    // Manage Company- PDC - Ruchira
    public function manageCompany($pg = NULL)
    {
        //Access Control
        if ($_SESSION['user_role'] != 'pdc') {
            redirect('errors/error403');
        }

        if ($_SESSION['user_role'] == 'pdc') {
            $companyList = $this->companyModel->getCompanyList();
            $all_access = $this->companyModel->checkSystemAccessCompanies();

            if ($pg == 'deactivated') {

                $blacklistedCompanyList = $this->companyModel->getDeativatedCompanyList();
                $data = [
                    'blacklisted_modal_class' => '',
                    'change_access_modal' => 'hide-element',
                    'company_list' => $companyList,
                    'blacklisted_list' => $blacklistedCompanyList,
                    'company_access' => $all_access->all_access
                ];

                $this->view('pdc/manageCompany', $data);
            } elseif ($pg == 'change-access') {

                $data = [
                    'blacklisted_modal_class' => 'hide-element',
                    'company_list' => $companyList,
                    'blacklisted_list' => NULL,
                    'change_access_modal' => '',
                    'company_access' => $all_access->all_access
                ];

                $this->view('pdc/manageCompany', $data);
            } else {

                $data = [
                    'blacklisted_modal_class' => 'hide-element',
                    'company_list' => $companyList,
                    'blacklisted_list' => NULL,
                    'change_access_modal' => 'hide-element',
                    'company_access' => $all_access->all_access
                ];

                $this->view('pdc/manageCompany', $data);
            }
        } else {
            $this->view('error403');
        }
    }

    // Company Details Company- PDC
    public function CompanyDetails()
    {
        $this->view('pdc/companyDetails');
    }

    //User id is passed to view student profile
    //profiles/company-profile/56
    //I AM COMMENTING THESE BECAUSE I THINK THEY ARE NOT USED ANYWHERE - NAMADEE
    //advertisements/viewAdvertisement/78
    //View Company List - STUDENT
    public function viewCompanyList()
    {
        $listCompanies = $this->companyModel->getCompanyList();

        $data = [
            'listCompanies' => $listCompanies
        ];

        $this->view('student/viewcompanies', $data);
    }

    public function SearchCompanies()
    {
        $search_res = null;
        $output = null;
        if (isset($_POST['query'])) {
            $search = $_POST['query'];
            $search_res = $this->companyModel->searchCompanyList($search);
        } else {
            $search_res = $this->companyModel->getCompanyList();
        }

        if ($search_res) {
            $output = '<table class="view-companies-table" id="view-companies-table">
                <thead>
                <tr>
                    <th class="view-companies-table-header">Company Name</th>
                    <th class="view-companies-table-header"></th>
                </tr>
                </thead>
                <tbody>';

            foreach ($search_res as $res) {

                $output .= '<tr>
                        <td class="view-companies-table-data">' . $res->company_name . '</td>
                        <td class="view-companies-table-data"> <a href=' . URLROOT . 'students/company-profile' . '><button button class="common-view-btn">view</button></a></td>
                        </tr>';
            };
            $output .= '</tbody> </table>';
        } else {
            $output = '<h3>No search results<h3>';
        }
        echo $output;
    }

    //View Applied Company List - STUDENT
    // public function viewAppliedCompanyList()
    // {
    //     $this->view('student/appliedcompanies');
    // }

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
        if ($_SESSION['user_role'] == 'company') {
            $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
            $advertisements = $this->advertisementModel->getAdvertisementsByCompany($companyId);
            $data = [
                'advertisements' => $advertisements
            ];

            $this->view('company/InterviewScheduleList', $data);
        } else {
            $this->view('error403');
        }
    }

    public function InterviewScheduleCreate($advertisementId)
    {
        if ($_SESSION['user_role'] == 'company') {

            $timeslots = $this->advertisementModel->getInterviewSlots($advertisementId);

            $data = [
                'advertisment_id' => $advertisementId,
                'timeslots' => $timeslots,
                'formAction' => 'advertisements/createInterviewSlots/' . $advertisementId,
            ];
            $this->view('company/calander', $data);
        } else {
            $this->view('error403');
        }
    }

    public function InterviewSchedule()
    {
        $this->view('company/InterviewSchedule');
    }

    //SHORTLIST STUDENTS
    public function shortlistStudent($id)
    {
        if ($_SESSION['user_role'] == 'company') {
            if (isset($_POST["status"])) {
                //Handling changing status to shortist or reject
                $data = [
                    'request_id' => trim($_POST['request_id']),
                    'status' => trim($_POST['status'])
                ];

                $this->companyModel->shortlistStudent($data);
                flashMessage('shortlist_student_msg', 'Student Added to Shortlist');
                redirect('requests/showRequestsByAd/' . $id);
            }
        } else {
            $this->view('error403');
        }
    }

    //DISPLAY ADVERTISEMENT LIST WITH RELEVENT SHORTLISTED STUDENTS COUNT
    public function getAdvertisementByStatus()
    {
        if ($_SESSION['user_role'] == 'company') {
            $companyId = $this->userModel->getCompanyUserId($_SESSION['user_id']);
            $advertisements = $this->advertisementModel->getAdvertisementsByCompany($companyId);
            $intern_counts = array();
            $shortlistedCounts = array();
            $x = 0;
            foreach ($advertisements as $advertisement) {
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
                'advertisements' => $advertisements,

            ];

            $this->view('company/shortlist', $data);
        } else {
            $this->view('error403');
        }
    }


    //GET SHORTLISTED STUDENTS FOR RELEVENT ADVERTISEMENT
    public function getShortlistedStudents($advertisementId)
    {
        if ($_SESSION['user_role'] == 'company') {
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
        } else {
            $this->view('error403');
        }
    }

    //RECRUIT OR REJECT STUDENT FROM DROP DOWN
    public function recruitStudent($id)
    {
        if ($_SESSION['user_role'] == 'company') {
            if (isset($_POST["recruit_status"])) {
                //Handling changing status to shortist or reject
                $data = [
                    'request_id' => trim($_POST['request_id']),
                    'recruit_status' => trim($_POST['recruit_status'])
                ];

                $this->companyModel->recruitStudent($data);
                flashMessage('recruit_student_msg', 'Student Recruited');
                redirect('companies/get-shortlisted-students/' . $id);
            }
        } else {
            $this->view('error403');
        }
    }
}
