<?php

class UserModel extends Database
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }



  // Find users by the Email
  public function findUserByEmail($email)
  {
    $this->db->query("SELECT * FROM user_tbl WHERE email = :email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function getCompanyUserId($foreignKey)
  {
    $this->db->query("SELECT company_id FROM company_tbl WHERE user_id_fk = :foreign_key");
    $this->db->bind(':foreign_key', $foreignKey);

    $row = $this->db->single();

    $companyId = $row->company_id;

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return $companyId;
    } else {
      return false;
    }
  }

  public function getStudentUserId($foreignKey)
  {
    $this->db->query("SELECT student_id FROM student_tbl WHERE user_id_fk = :foreign_key");
    $this->db->bind(':foreign_key', $foreignKey);

    $row = $this->db->single();

    $userID = $row->user_id;

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return $userID;
    } else {
      return false;
    }
  }

  //Get User Roles
  public function getUserRoles()
  {
    $this->db->query("SELECT user_role FROM user_tbl");
    return $this->db->resultset();
  }

  // Login Users
  public function login($email, $password)
  {
    $this->db->query("SELECT * FROM user_tbl WHERE email = :email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();
    $hashed_password = $row->password;
    if (password_verify($password, $hashed_password)) {
      return $row;
    } else {
      return false;
    }
  }
}
