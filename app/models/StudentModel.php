<?php

class StudentModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    
     //Update student profile - student
  public function EditStudentProfileDetails($data)
  {
    
      $this->db->query('UPDATE student_tbl SET experience = :experience,
      interests = :interests, qualifications = :qualifications, extracurricular= :extracurricular, contact= :contact, stream= :stream, profile_description= :profile_description, school= :school 
      WHERE student_id = :student_id');
      
      
      // Bind Values
      $this->db->bind(':experience', $data['experience']);
      $this->db->bind(':interests', $data['interests']);
      $this->db->bind(':qualifications', $data['qualifications']);
      $this->db->bind(':extracurricular', $data['extracurricular']);
      $this->db->bind(':school', $data['school']);
      $this->db->bind(':contact', $data['contact']);
      $this->db->bind(':stream', $data['stream']);
      $this->db->bind(':profile_description', $data['profile_description']);
      $this->db->bind(':student_id', $data['student_id']);

      //Execute
      if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }


  }

  public function getStudentProfileData()
  {
    
    //bIND STUDENT id
        $this->db->query('SELECT * FROM student_tbl WHERE student_id= 69');
        //$this->db->bind(':student_id', $student_id);

        $row = $this->db->single();
        return $row;
  }
    //Check for Std Index Availability - Ruchira
    public function checkIndexNumber($indexNum)
    {
        $this->db->query('SELECT * FROM `student_tbl` WHERE `index_number` = :index_number');

        // Bind Values
        $this->db->bind(':index_number', $indexNum);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Check for Std Reg Num Availability - Ruchira
    public function checkRegistrationNumber($registrationNum)
    {
        $this->db->query('SELECT * FROM `student_tbl` WHERE `registration_number` = :registration_number');

        // Bind Values
        $this->db->bind(':registration_number', $registrationNum);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
