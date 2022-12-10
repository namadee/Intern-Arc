<?php

class ComplaintModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }



public function getComplaint()
{
    $this->db->query('SELECT * FROM complaint_tbl');

    return $this->db->resultset();
}

public function showComplaintById($id)
    {
        $this->db->query("SELECT * FROM complaint_tbl WHERE complaint_id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

public function addComplaint($data)
    {
        $this->db->query('INSERT INTO complaint_tbl (subject,description) 
        VALUES (:subject,:description)');

        // Bind Values
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':description', $data['description']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateComplaint($data){
        // Prepare Query
        $this->db->query('UPDATE complaint_tbl  SET 
        subject = :subject,
        description = :description
        WHERE complaint_id = :id');
  
        // Bind Values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':description', $data['description']);
        
        //Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

      public function deleteComplaint($id)
    {
        $this->db->query("DELETE FROM complaint_tbl WHERE complaint_id = :id");
        $this->db->bind(':id', $id); 

        if ($this->db->execute()) {
            redirect('complaints');
        } else {
            return false;
        }
    }   
}