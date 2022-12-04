<?php

class RegisterModel extends Database
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  // Add Users / Register
  public function register($data)
  {
    // Prepare Query

    $this->db->query('INSERT INTO user_tbl(username, email, password, contact, profile_pic, created_at, user_role) 
        VALUES (:username, :email, :password, :contact, :profile_pic, :created_at, :user_role )');

    // Bind Values
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':contact', $data['contact']);
    $this->db->bind(':profile_pic', $data['email']);
    $this->db->bind(':created_at', NULL );
    $this->db->bind(':user_role', $data['user_role']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  


}
