<?php

class AdminModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }


  //GET ALL THE ADVERTISEMENT COUNT
  public function getAdvertisementCountByCompany($companyID)
  {
    $this->db->query('SELECT company_tbl.*, COUNT(advertisement_tbl.advertisement_id) AS advertisement_count
    FROM company_tbl
    JOIN advertisement_tbl ON company_tbl.company_id = advertisement_tbl.company_id_fk
    WHERE company_tbl.company_id = :company_id');

    $this->db->bind(':company_id', $companyID);
    $results = $this->db->single();
    return $results;
  }

  public function getPdcStaff()
  {
    $this->db->query('SELECT * FROM user_tbl WHERE user_role="pdc"');
    $results = $this->db->resultSet();
    return $results;
  }

  public function getUserDetails($userID)
  {
    $this->db->query('SELECT * FROM user_tbl WHERE user_id=:userID');


    $this->db->bind(':userID', $userID);

    $results = $this->db->single();

    return $results;
  }

  // Update PDC member details
  public function updateStaff($data)
  {
    $this->db->query('UPDATE user_tbl SET username = :username, email = :email  WHERE user_id = :userID');

    // Bind values
    $this->db->bind(':username', $data['username']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':userID', $data['userID']);
    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Delete PDC member 
  public function deleteStaff($userID)
  {
    $this->db->query('DELETE FROM user_tbl WHERE user_id = :userID');

    // Bind values
    $this->db->bind(':userID', $userID);
    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getComplaintList()
  {
    $this->db->query('SELECT complaint_tbl.*, user_tbl.* FROM complaint_tbl JOIN user_tbl ON complaint_tbl.user_id_fk = user_tbl.user_id');

    $results = $this->db->resultSet();
    return $results;
  }

  public function getComplaintDetails($complaintID)
  {
    $this->db->query('SELECT * FROM complaint_tbl WHERE complaint_id=:complaintID');

    // Bind values
    $this->db->bind(':complaintID', $complaintID);
    $results = $this->db->single();

    return $results;
  }

  public function updateComplaintStatus($data)
  {

    $this->db->query('UPDATE complaint_tbl SET status = :status WHERE complaint_id = :complaintID');

    // Bind values
    $this->db->bind(':status', $data['status']);
    $this->db->bind(':complaintID', $data['complaintID']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  


}
