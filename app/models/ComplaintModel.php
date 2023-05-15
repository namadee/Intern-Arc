<?php

class ComplaintModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }



    public function getComplaint($userID)
    {
        $this->db->query('SELECT * FROM complaint_tbl WHERE user_id_fk = :userID');
        $this->db->bind(':userID', $userID);

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
        $user_id = $_SESSION['user_id'];
        $this->db->query('INSERT INTO complaint_tbl (subject,description, reference_number, user_id_fk) 
        VALUES (:subject,:description, :reference_number, :user_id_fk)');

        // Bind Values
        $this->db->bind(':subject', $data['subject']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':reference_number', $data['reference_code']);
        $this->db->bind(':user_id_fk',  $user_id);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateComplaint($data)
    {
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
        if ($this->db->execute()) {
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
