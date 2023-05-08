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

public function addStaff($data){
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


}
