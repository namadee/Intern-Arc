<?php

class RegisterModel extends Database
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Add Users / Register
  public function registerUser($data)
  {
    // Prepare Query
    $this->db->query('INSERT INTO user_tbl(username, email, password, user_role) 
        VALUES (:username, :email, :password,:user_role )');

    // Bind Values
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':user_role', $data['user_role']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Register a single Student
  public function registerStudent($data)
  {
    $this->db->query('INSERT INTO `student_tbl` ( `index_number`, `registration_number`, `stream` , `batch_year` , `user_id_fk`)
    VALUES (:index_number, :registration_number, :stream, :batch_year, :user_id)');

    // Bind Values
    $this->db->bind(':index_number', $data['index_number']);
    $this->db->bind(':registration_number', $data['registration_number']);
    $this->db->bind(':stream', $data['stream']);
    $this->db->bind(':batch_year', $data['batch_year']);
    $this->db->bind(':user_id', $data['user_id']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Register a single Company
  public function registerCompany($data)
  {
    $this->db->query('INSERT INTO `company_tbl` ( `company_name`, `contact`, `user_id_fk`)
    VALUES (:company_name, :contact, :user_id)');

    // Bind Values
    $this->db->bind(':company_name', $data['company_name']);
    $this->db->bind(':contact', $data['contact']);
    $this->db->bind(':user_id', $data['user_id']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function updatePassword($data){
    $this->db->query('UPDATE user_tbl  SET password = :password WHERE user_id = :user_id');
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':password', $data['password']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

}
