<?php

class AdvertisementModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAdvertisements()
    {
        // Adjustment 1: Show only the advertisements of the current batch
        //Filter by the current Batch
        $currentYear = date('Y');
        $batchYear = $currentYear - 3; //2023 - 3 = 2020

        $this->db->query('SELECT * FROM advertisement_tbl WHERE batch_year = :batch_year');
        $this->db->bind(':batch_year', $batchYear);
        return $this->db->resultset();
    }

    public function showAdvertisementById($advertisementId)
    {
        $this->db->query("SELECT * FROM advertisement_tbl WHERE advertisement_id = :advertisement_id");
        $this->db->bind(':advertisement_id', $advertisementId);
        $row = $this->db->single();
        return $row;
    }

    public function addAdvertisement($data)
    {
        $this->db->query('INSERT INTO advertisement_tbl (position,job_description,requirements,start_date,end_date,working_mode,applicable_year,intern_count, company_id_fk, batch_year)
         VALUES (:position,:job_description,:requirements,:internship_start,:internship_end,:working_mode,:required_year,:no_of_interns,:company_id_fk, :batch_year)');

        // Bind Values
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':job_description', $data['job_description']);
        $this->db->bind(':requirements', $data['requirements']);
        $this->db->bind(':internship_start', $data['internship_start']);
        $this->db->bind(':internship_end', $data['internship_end']);
        $this->db->bind(':no_of_interns', $data['no_of_interns']);
        $this->db->bind(':working_mode', $data['working_mode']);
        $this->db->bind(':required_year', $data['required_year']);
        $this->db->bind(':company_id_fk', $data['company_id']);

        //Adjustment 2 - Add the batch year of the advertisement
        //Get the current Batch
        $currentYear = date('Y');
        $batchYear = $currentYear - 3; //2023 - 3 = 2020
        $this->db->bind(':batch_year', $batchYear);


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateAdvertisement($data)
    {
        // Prepare Query
        $this->db->query('UPDATE advertisement_tbl SET position = :position,
        job_description = :job_description, requirements = :requirements, 
        start_date = :internship_start, end_date = :internship_end, 
        working_mode = :working_mode, applicable_year = :required_year , intern_count = :no_of_interns
        WHERE advertisement_id = :advertisement_id');

        // Bind Values
        $this->db->bind(':advertisement_id', $data['advertisement_id']);
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':job_description', $data['job_description']);
        $this->db->bind(':requirements', $data['requirements']);
        $this->db->bind(':internship_start', $data['internship_start']);
        $this->db->bind(':internship_end', $data['internship_end']);
        $this->db->bind(':no_of_interns', $data['no_of_interns']);
        $this->db->bind(':working_mode', $data['working_mode']);
        $this->db->bind(':required_year', $data['required_year']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAdvertisement($advertisementId)
    {
        $this->db->query("DELETE FROM advertisement_tbl WHERE advertisement_id = :advertisement_id");
        $this->db->bind(':advertisement_id', $advertisementId);

        if ($this->db->execute()) {
            redirect('advertisements');
        } else {
            return false;
        }
    }

    //GET COMPANY DETAILS RELEVENT TO ADVERTISEMENT 
    public function getCompanyByAd()
    {
        $this->db->query('SELECT advertisement_tbl.position, advertisement_tbl.advertisement_id, company_tbl.company_name 
        FROM company_tbl 
        JOIN advertisement_tbl 
        ON company_tbl.company_id = advertisement_tbl.company_id_fk');

        return $this->db->resultset();
    }

    //SELECT ADVERTISEMENTS BASED ON COMPANY - Namadee
    public function getAdvertisementsByCompany($companyId)
    {
        $this->db->query('SELECT * FROM advertisement_tbl WHERE company_id_fk = :company_id');
        $this->db->bind(':company_id', $companyId);

        return $this->db->resultset();
    }


    //Get Advertisements and their company name - Ruchira
    public function getAdvertisementsList()
    {
        $this->db->query('SELECT  advertisement_tbl.intern_count,advertisement_tbl.position, advertisement_tbl.advertisement_id, company_tbl.company_name, advertisement_tbl.status
        FROM company_tbl 
        JOIN advertisement_tbl 
        ON company_tbl.company_id = advertisement_tbl.company_id_fk 
        WHERE advertisement_tbl.batch_year = :batch_year');

        $batch =  $_SESSION['batchYear'];
        $this->db->bind(':batch_year', $batch);

        return $this->db->resultset();
    }

    //Change Advertisment Status - PDC
    public function changeAdvertisementStatus($data)
    {
        $this->db->query('UPDATE advertisement_tbl SET status = :status, round = :round WHERE advertisement_id = :advertisement_id');
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':round', $data['round']);
        $this->db->bind(':advertisement_id', $data['advertisement_id']);

        return $this->db->single();
    }
}
