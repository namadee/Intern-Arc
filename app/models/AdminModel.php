<?php

class AdminModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getstaffdetails()
  {
    $this->db->query('SELECT * FROM user_tbl WHERE user_role="pdc"');


    $results = $this->db->resultSet();

    return $results;
  }

  public function getuserdetails($id)
  {
    $this->db->query('SELECT * FROM user_tbl WHERE user_id=:id');


    $this->db->bind(':id', $id);

    $results = $this->db->single();

    return $results;
  }

  public function addStaff($data)
  {
    $this->db->query('INSERT INTO user_tbl(username,email, password , user_role)
      VALUES(:name, :email, :password, :user_role)');

    // Bind values
    $this->db->bind(':name', $data['username']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['hashed_password']);
    $this->db->bind(':user_role', 'pdc');

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  //deletepdcuser
  public function deletepdcuser($id)
  {
      $this->db->query("DELETE FROM user_tbl WHERE user_id = :id");
      $this->db->bind(':id', $id); 

      if ($this->db->execute()) {
          redirect('viewPdcStaff');
      } else {
          return false;
      }
  }   

  public function getstudentdetails()
  {
    $this->db->query('SELECT * FROM student_tbl');


    $results = $this->db->resultSet();

    return $results;
  }


  public function getstudentdetail($id)
  {
    $this->db->query('SELECT * FROM student_tbl WHERE student_id=:id');


    $this->db->bind(':id', $id);

    $results = $this->db->single();

    return $results;
  }

  public function getcompanydetails()
  {
    $this->db->query('SELECT * FROM company_tbl');


    $results = $this->db->resultSet();

    return $results;
  }

  public function getcompanydetail($id)
  {
    $this->db->query('SELECT company_tbl.company_name as company_name,
  company_tbl.company_slogan as company_slogan,
  company_tbl.company_email as company_email,
  company_tbl.company_address as company_address,
  company_tbl.contact as contact,
  company_tbl.company_id as company_id,
  company_tbl.company_description as company_description,
  user_tbl.profile_pic as company_image
  FROM company_tbl INNER JOIN user_tbl ON company_tbl.user_id_fk = user_tbl.user_id WHERE company_id=:id');
    // $this->db->query('SELECT * FROM company_tbl WHERE company_id=:id');


    $this->db->bind(':id', $id);

    $results = $this->db->single();

    return $results;
  }

  public function getcomplaintdetails($id)
  {
    $this->db->query('SELECT * FROM company_tbl WHERE company_id=:id');


    $this->db->bind(':id', $id);

    $results = $this->db->single();

    return $results;
  }

  public function getadvertisementdetails()
  {
    $this->db->query('SELECT company_tbl.company_name as company_name,
  advertisement_tbl.position as position,
  advertisement_tbl.intern_count as intern_count
  FROM company_tbl INNER JOIN advertisement_tbl ON company_tbl.company_id = advertisement_tbl.company_id_fk');


    $results = $this->db->resultSet();

    return $results;
  }
}
