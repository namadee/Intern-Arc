<?php

class Admin extends BaseController
{
    public $adminModel;
    public $userModel;

    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
        $this->userModel = $this->model('User');
    }

    public function index() //default method and view
    {



        $this->view('admin/dashboard');
    }

    public function complaint() //default method and view
    {
        $company = $this->adminModel->getcompanydetails();
        $data = [
            'company' => $company,
        ];
        $this->view('admin/adminComplaint',$data);
    }

    public function viewcomplaint() //default method and view
    {
        $this->view('admin/viewComplaint');
    }

    public function complaintdetails($id) //default method and view
    {
        $complaint = $this->adminModel->getcomplaintdetails($id);
        $data = [
            'complaint' => $complaint,
        ];
        $this->view('admin/viewComplaintView', $data);
    }


    public function company() //default method and view
    {
        $company = $this->adminModel->getcompanydetails();
        $data = [
            'company' => $company,
        ];
        $this->view('admin/company', $data);
    }

    public function viewcompany($id) //default method and view
    {
        $company = $this->adminModel->getcompanydetail($id);
        $data = [
            'company' => $company,
        ];
        $this->view('admin/viewCompany', $data);
    }

    
    public function viewbatches() //default method and view
    {
        $this->view('admin/viewBatches');
    }

    public function viewstudentlist() //default method and view
    {
        $student = $this->adminModel->getstudentdetails();
        $data = [
            'student' => $student,
        ];
        $this->view('admin/viewStudentList', $data);
    }

    public function viewstudent($id) //default method and view
    {
        $student = $this->adminModel->getstudentdetail($id);
        $data = [
            'student' => $student,
        ];
        $this->view('admin/viewStudent', $data);
    }

    public function viewpdcstaff() //default method and view
    {
        $staff = $this->adminModel->getstaffdetails();
        $data = [
            'staff' => $staff,
        ];
        $this->view('admin/viewPdcStaff', $data);
    }

    public function viewpdcuser($id) //default method and view
    {
        $staff = $this->adminModel->getuserdetails($id);
        $data = [
            'staff' => $staff,
        ];
        $this->view('admin/viewPdcUser', $data);
    }

    public function report() //default method and view
    {
        $this->view('admin/report');
    }

    public function registrationreport() //default method and view
    {
        $company = $this->adminModel->getcompanydetails();
        $data = [
            'company' => $company,
        ];
        $this->view('admin/registrationReport',$data);
    }

    public function advertisementreport() //default method and view
    {
        $advertisement = $this->adminModel->getadvertisementdetails();
        $data = [
            'advertisement' => $advertisement,
        ];
        $this->view('admin/advertisementReport',$data);
    }

    public function viewprofile() //default method and view
    {
        $this->view('admin/updateProfile');
    }

    public function addpdcuser()
    {


        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Strip Tags
            stripTags();



            $data = [
                'username' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['name']),
                'hashed_password' => '',
                'username_err' => '',
                'email_error' => '',
            ];

            if (empty($data['username'])) {
                $data['username_err'] = 'Please enter a username';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Plase enter a email';
            }

            if (empty($data['username_err'] && $data['email_err'])) {
                // Hash Password
                $data['hashed_password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->adminModel->addStaff($data)) {
                    redirect('admin/viewPdcStaff');
                } else {
                    die('Something went wrong');
                }
            } else {
                //load with errors
                $this->view('admin/addPdcUser', $data);
            }

            //     if ($user_id) {
            //         //User available -  Cant register
            //         $data = [
            //             'username' => trim($_POST['username']),
            //             'email' => trim($_POST['email']),
            //             'email_error' => '*Email already exists! Please check again',
            //             'credential_error' => '',
            //         ];
            //         //$this->view('pdc/registerStudent', $data);
            //     } else {
            //         //Check for Index Numbers and Reg Numbers duplication before adding to DB
            //         if ($this->studentModel->checkIndexNumber(trim($_POST['index_number'])) || $this->studentModel->checkRegistrationNumber(trim($_POST['registration_number']))) {
            //             $data = [
            //                 'username' => trim($_POST['username']),
            //                 'email' => trim($_POST['email']),
            //                 'registration_number' => trim($_POST['registration_number']),
            //                 'index_number' => trim($_POST['index_number']),
            //                 'email_error' => '',
            //                 'year' => $year,
            //                 'stream' => $stream,
            //                 'credential_error' => '*Either Registration Number or Index Number already exists! Please check again '
            //             ];
            //             $this->view('pdc/registerStudent', $data);
            //         } else {
            //             //Random Password
            //             $password = generatePassword();

            //             // Hash Password
            //             $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            //             $email = new Email();

            //             if ($email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username'])) {
            //                 $data = [
            //                     'username' => trim($_POST['username']),
            //                     'email' => trim($_POST['email']),
            //                     'password' => $hashPassword,
            //                     'user_role' => 'student'
            //                 ];

            //                 //Execute
            //                 $this->registerModel->registerUser($data);

            //                 //Get that User_Id
            //                 $user_id = $this->userModel->getUserId($data['email']);
            //                 $data = [
            //                     'user_id' => $user_id,
            //                     'registration_number' => trim($_POST['registration_number']),
            //                     'index_number' => trim($_POST['index_number']),
            //                     'stream' => trim($_POST['stream']),
            //                     'batch_year' => trim($_POST['year'])
            //                 ];
            //                 $email->sendLoginEmail(trim($_POST['email']), $password, $_POST['username']);
            //                 $this->registerModel->registerStudent($data);
            //                 flashMessage('std_register_msg', 'Student Registered Successfully!');
            //                 redirect('register/register-student/' . $year . '/' . $stream);
            //             } else {
            //                 flashMessage('std_register_msg', 'Error Occured!, Email is not sent', 'danger-alert');
            //                 redirect('register/register-student/' . $year . '/' . $stream);
            //             }
            //         }
            //     }
        } else {

            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'hashed_password' => '',
                'username_err' => '',
                'email_error' => '',
            ];

            // Load View
            $this->view('admin/addPdcUser', $data);
        }
    }

    public function deletepdcuser($id)
    {
        $this->adminModel->deletepdcuser($id);
    }

    public function viewstudentprofile($id)
    {
        $studentProfile = $this->adminModel->getstudentdetail($id);

        $data = [
            'experience' => $studentProfile->experience,
            'interests' => $studentProfile->interests,
            'qualifications' => $studentProfile->qualifications,
            'school' => $studentProfile->school,
            'contact' => $studentProfile->contact,
            'stream' => $studentProfile->stream,
            'profile_description' => $studentProfile->profile_description,
            'profile_name' => $studentProfile->profile_name,
            'personal_email' => $studentProfile->personal_email,
            'extracurricular' => $studentProfile->extracurricular,
        ];

        $this->view('admin/studentprofile', $data);
    }

    public function companyprofile($id){
        $company = $this->adminModel->getcompanydetail($id); 

        $data = [
            'company' => $company,
        ];

        $this->view('admin/companyprofile', $data);
    }
}
