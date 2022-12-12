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

  // Get User Details from User tbl
  public function getUserDetails($userId)
  {
      $this->db->query('SELECT * FROM user_tbl WHERE user_id = :userId ');
      $this->db->bind(':userId', $userId); 
      return $this->db->single();
  }

    // Get User Details
    public function updateUserDetails($data)
    {
        $this->db->query('UPDATE user_tbl  SET username = :username, email = :email, contact = :contact WHERE user_id = :user_id');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']); 
        $this->db->bind(':contact', $data['contact']);
        
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }

      }
}
