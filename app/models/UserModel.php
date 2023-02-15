<?php

class UserModel extends Database
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }



  // Find users by the Email [return resultRow /false]
  public function getUserByEmail($email)
  {
    $this->db->query("SELECT * FROM user_tbl WHERE email = :email");
    $this->db->bind(':email', $email);

    $result = $this->db->single();

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return $result;
    } else {
      return false;
    }
  }

  //Return User_id from User_tbl
  public function getUserId($email)
  {
    $this->db->query("SELECT user_id FROM user_tbl WHERE email = :email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    if ($row) {
      $userId = $row->user_id;
    }

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return $userId;
    } else {
      return false;
    }
  }

  //Return company_id from company_tbl
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

    $studentId = $row->student_id;

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return $studentId;
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

  // Login Users [return true/false]
  public function login($email, $password)
  {
    $this->db->query("SELECT * FROM user_tbl WHERE email = :email");
    $this->db->bind(':email', $email);

    $row = $this->db->single();
    $hashed_password = $row->password;
    if (password_verify($password, $hashed_password)) {
      return true;
    } else {
      return false;
    }
  }


  //Update User Details - Main User Table
  public function updateUserDetails($data)
  {
    $this->db->query('UPDATE user_tbl  SET username = :username, email = :email WHERE user_id = :user_id');
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']);

    //Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  //Store Temp Verification Code - Ruchira
  public function storeVerificationCode($data)
  {
    $userId = $this->getUserId($data['email']);

    $this->db->query('UPDATE `user_tbl` SET `verification_code` = :verification_code WHERE `user_id` = :user_id');
    $this->db->bind(':user_id', $userId);
    $this->db->bind(':verification_code', $data['verification_code']);
    $this->db->execute();
  }

  //Retrieve Temp Verification Code - Ruchira
  public function retrieveVerificationCode($email)
  {
    $userId = $this->getUserId('ruchirxv2@gmail.com');

    $this->db->query('SELECT `verification_code` FROM `user_tbl` WHERE `user_id` = :user_id');
    $this->db->bind(':user_id', $userId);

    $row = $this->db->single();
    $verification_code = $row->verification_code;

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return $verification_code;
    } else {
      return false;
    }
  }


  //Update Temp Verification Code to 0 - Ruchira
  public function updateVerificationCode($email)
  {
    $userId = $this->getUserId($email);

    $this->db->query('UPDATE `user_tbl` SET `verification_code` = 0 WHERE `user_id` = :user_id');
    $this->db->bind(':user_id', $userId);
    $this->db->execute();
  }

  public function getCompanyDetails($company_id)
  {
    $this->db->query("SELECT * FROM company_tbl WHERE company_id = :company_id");
    $this->db->bind(':company_id', $company_id);

    $company_details = $this->db->single();

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return $company_details;
    } else {
      return false;
    }
  }

  //Adding profile picture - User table
  public function updateProfileImage($data)
  {

    $this->db->query('UPDATE `user_tbl` SET `profile_pic` = :profile_pic WHERE `user_id` = :user_id');
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':profile_pic', $data['profile_pic']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getProfileImageName($userId)
  {
    $this->db->query("SELECT profile_pic FROM user_tbl WHERE user_id = :user_id");
    $this->db->bind(':user_id', $userId);

    $profile_image_name = $this->db->single();

    //Check Rows
    if ($this->db->rowCount() > 0) {
      return $profile_image_name;
    } else {
      return false;
    }
  }

  //get student users by ID
  public function getStudentUserById($studentId)
  {
    $this->db->query("SELECT * FROM student_tbl WHERE student_id = :student_id");
    $this->db->bind(':student_id', $studentId);
    $row = $this->db->single();
    return $row;

  }
}
