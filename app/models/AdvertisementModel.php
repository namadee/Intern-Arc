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
        $this->db->query('SELECT * FROM advertisement_tbl');

        return $this->db->resultset();
    }

      public function showAdvertisementById($id)
    {
        $this->db->query("SELECT * FROM advertisement_tbl WHERE advertisement_id = :id");
        $this->db->bind(':id', $id); 
        $row = $this->db->single();
        return $row;
    }

    public function addAdvertisement($data)
    {
        $this->db->query('INSERT INTO advertisement_tbl (position,job_description,requirements,start_date,end_date,working_mode,applicable_year,intern_count, status, company_id_fk )
         VALUES (:position,:job_description,:other_requirements,:internship_start,:internship_end,:working_mode,:required_year,:no_of_interns,:status,:company_id_fk)');
          $company_id_fk = 1;
          $status = 'pending';

        // Bind Values
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':job_description', $data['job_description']);
        $this->db->bind(':other_requirements', $data['other_requirements']);
        $this->db->bind(':internship_start', $data['internship_start']);
        $this->db->bind(':internship_end', $data['internship_end']);
        $this->db->bind(':no_of_interns', $data['no_of_interns']);
        $this->db->bind(':working_mode', $data['working_mode']);
        $this->db->bind(':required_year', $data['required_year']);
        $this->db->bind(':status', $status);
        $this->db->bind(':company_id_fk', $company_id_fk);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateAdvertisement($data){
        // Prepare Query
        $this->db->query('UPDATE advertisement_tbl SET job_description = :job_description, other_requirements = :other_requirements, internship_start = :internship_start, working_mode = :working_mode, required_year = :required_year  WHERE id = :id');
  
        // Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':job_description', $data['job_description']);
        $this->db->bind(':other_requirements', $data['other_requirements']);
        $this->db->bind(':internship_start', $data['internship_start']);
        $this->db->bind(':internship_end', $data['internship_end']);
        $this->db->bind(':no_of_interns', $data['no_of_interns']);
        $this->db->bind(':working_mode', $data['working_mode']);
        $this->db->bind(':required_year', $data['required_year']);
        
        //Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

      public function deleteAdvertisement($id)
      {
          $this->db->query("DELETE FROM advertisement_tbl WHERE advertisement_id = :id");
          $this->db->bind(':id', $id); 
  
          if ($this->db->execute()) {
              redirect('advertisements');
          } else {
              return false;
          }
      }    
    
   

  
}
