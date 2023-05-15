<?php

class Companies extends BaseController
{
    public $companyModel;
    public $userModel;
    public $advertisementModel;
    public $requestModel;
    public $registerModel;
    public $studentModel;

    public function __construct()
    {
        $this->companyModel = $this->model('Company');
        $this->userModel = $this->model('User');
        $this->advertisementModel = $this->model('Advertisement');
        $this->requestModel = $this->model('Request');
        $this->registerModel = $this->model('Register');
        $this->studentModel = $this->model('Student');
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
                redirect('requests/show-requests-by-ad/' . $id);
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
            $positions = array(); // Initialize the $positions array
            $x = 0;

            if (!empty($advertisements)) {
                foreach ($advertisements as $advertisement) {
                    $shortlists = $this->companyModel->getAdvertisementByStatus($advertisement->advertisement_id);
                    $shortlistedCounts[$x] = count($shortlists);
                    $positions[$x] = $advertisement->position;
                    $intern_counts[$x] = $advertisement->intern_count;
                    $x++;
                }
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

    //check max recruitment limit
    public function checkMaxRecruitmentLimit($advertisementId)
    {

        $advertisement = $this->advertisementModel->getAdvertisementById($advertisementId);
        $internCount = $advertisement->intern_count;
        $requests = $this->requestModel->getRecruitedCountByAd($advertisementId);
        $requestCount = count($requests);

        if ($requestCount <= $internCount) {
            echo $internCount;
            echo $requestCount;
            return true;
        } else {
            return false;
        }
    }

    //RECRUIT OR REJECT STUDENT FROM DROP DOWN
    public function recruitStudent($id)
    {

        if ($_SESSION['user_role'] == 'company') {
            if (isset($_POST["recruit_status"])) {
                //Handling changing status to shortist or reject
                $data = [
                    'advertisement_id' => trim($_POST['advertisement_id']),
                    'request_id' => trim($_POST['request_id']),
                    'recruit_status' => trim($_POST['recruit_status'])
                ];

                $studentID = trim($_POST['student_id']);


                if (trim($_POST['recruit_status']) == "recruited") {

                    if ($this->checkMaxRecruitmentLimit($data['advertisement_id'])) {
                        $this->companyModel->recruitStudent($data);
                        $this->studentModel->setStatusofStudent($studentID, 1);
                        flashMessage('recruit_student_msg', 'Student Recruited');
                    } else {
                        flashMessage('recruit_student_msg', 'Maximum recruitment limit reached', 'danger-alert');
                    }
                } else {
                    $this->companyModel->recruitStudent($data);
                    $this->studentModel->setStatusofStudent($studentID, 0);
                    flashMessage('recruit_student_msg', 'Student Rejected', 'danger-alert');
                }

                redirect('companies/get-shortlisted-students/' . $id);
            }
        } else {
            $this->view('error403');
        }
    }


    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Strip Tags in URL
            stripTags();

            $data = [
                'oldPassword' => trim($_POST['user_old_password']),
                'newPassword' =>  trim($_POST['user_new_password']),
                'confirmPassword' =>  trim($_POST['user_confirm_password']),
                'userID' =>  trim($_POST['user_id']),
                'input_class' => ''
            ];

            //Check Whether the stored password is same as old password input value
            $userDetails = $this->userModel->getUserByUserID($data['userID']);
            $storedPassword = $userDetails->password;

            if (password_verify($data['oldPassword'], $storedPassword)) {
                #Password Match
                // Hash Password
                $hashPassword = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                //Update Password
                $data = [
                    'password' => $hashPassword,
                    'user_id' => $data['userID']
                ];
                $this->registerModel->updatePassword($data);
                flashMessage('password_changed', 'Password changed successfully!', 'success-alert');
                redirect('profiles/view-profile-details');
            } else {
                #Password Does not match
                flashMessage('password_changed_error', 'The password you entered is incorrect. Please try again', 'danger-alert');
                redirect('companies/changePassword');
            }
        } else {
            $this->view('company/changePassword');
        }
    }
}
