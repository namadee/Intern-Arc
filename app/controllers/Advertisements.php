<?php

class Advertisements extends BaseController
{

    public function __construct()
    {
        $this->AdvertisementModel = $this->model('Advertisement');
    }

    public function index()
    {
        $advertisements = $this->AdvertisementModel->getAdvertisements(); //Model function
        //view pass data values $data


        $data = [
            
            'advertisements' => $advertisements,
            'formAction' => 'Advertisements/addAdvertisement'
            
        ];

        $this->view('company/advertisementList', $data);
    }

    public function addAdvertisement()
    {
        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'position' => trim($_POST['position']),
                'job_description' => trim($_POST['job_description']),
                'other_requirements' => trim($_POST['other_requirements']),
                'internship_start' => date('y-m-d',strtotime($_POST['internship_start'])),
                'internship_end' => date('y-m-d',strtotime($_POST['internship_end'])),
                'no_of_interns' => trim($_POST['no_of_interns']),
                'working_mode' => trim($_POST['working_mode']),
                'required_year' => trim($_POST['required_year'])
                
            ];

            //Execute
            if ($this->AdvertisementModel->addAdvertisement($data)) { 
                
                
                redirect('advertisements');
               
                
                // header('location: http://localhost/internarc/Advertisements');
            } else {
                die('Something went wrong');
            }
        } else {
            
            // Init data
            $data = [
                'position' => '',
                'job_description' => '',
                'other_requirements' => '',
                'internship_start' => '',
                'internship_end' => '',
                'no_of_interns' => '',
                'working_mode' => '',
                'required_year' => ''
            ];

            // Load View
            $this->view('company/addAdvertisement', $data);
        }
    }

    public function showAdvertisement($id)
    {

        $advertisement = $this->AdvertisementModel->showAdvertisementById($id); //To get the Advertisement Name
        
        $data = [
            'className'=> 'selectedTab',
            'title' => 'Advertisements',
            'inputVal' =>$advertisement->job_description,
            'other_requirements' => $advertisement->requirements,
            'no_of_interns' => $advertisement->intern_count,
            'working_mode' => $advertisement->working_mode,
            'required_year' => $advertisement->applicable_year,
            'advertisements' => $advertisement,
            'formAction' => 'advertisements/updateAdvertisement/'.$advertisement->advertisement_id
        ];

        $this->view('company/addAdvertisement', $data);
    }

    public function updateAdvertisement($id)
    {
                // Check if POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                    // Sanitize POST
                    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                    $data = [
                        'position' => trim($_POST['position']),
                        'job_description' => trim($_POST['job_description']),
                        'other_requirements' => trim($_POST['other_requirements']),
                        'internship_start' => date('y-m-d',strtotime($_POST['internship_start'])),
                        'internship_end' => date('y-m-d',strtotime($_POST['internship_end'])),
                        'no_of_interns' => trim($_POST['no_of_interns']),
                        'working_mode' => trim($_POST['working_mode']),
                        'required_year' => trim($_POST['required_year']),
                        'id' => $id
                    ];
        
                    //Execute
                    if ($this->AdvertisementModel->updateAdvertisement($data)) { 
                        
                        // Redirect
                        redirect('advertisements');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    
                    // Init data
                    $data = [
                        'name' => '',
                        'buttonName' =>'Add Job Role'
                    ];
        
                    // Load View
                    $this->view('company/addAdvertisement', $data);
                }
    }

    public function deleteAdvertisement($id)
    {
        $this->AdvertisementModel->deleteAdvertisement($id);
    }
}


