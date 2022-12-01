<?php

class JobroleModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function getJobroles()
    {
        $this->db->query('SELECT * FROM jobrole_tbl');

        return $this->db->resultset();
    }

    public function showJobroleById($id)
    {
        $this->db->query("SELECT * FROM jobrole_tbl WHERE jobrole_id = :id");
        $this->db->bind(':id', $id); 
        $row = $this->db->single();
        return $row;
    }

    public function addJobrole($data)
    {
        $this->db->query('INSERT INTO jobrole_tbl (name) 
        VALUES (:jobrole)');

        // Bind Values
        $this->db->bind(':jobrole', $data['jobrole']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateJobrole($data){
      // Prepare Query
      $this->db->query('UPDATE jobrole_tbl  SET name = :name WHERE jobrole_id = :id');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['jobrole']);
      
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
    
    public function deleteJobrole($id)
    {
        $this->db->query("DELETE FROM jobrole_tbl WHERE jobrole_id = :id");
        $this->db->bind(':id', $id); 

        if ($this->db->execute()) {
            redirect('jobroles');
        } else {
            return false;
        }
    }    
}
