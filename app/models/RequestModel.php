<?php

class StudentRequestModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getStudentRequests()
    {
        $this->db->query('SELECT * FROM student_requests_tbl');
        return $this->db->resultset();
    }

    public function showStudentRequestById($StudentRequestId)
    {
    }

    public function addStudentRequest($data)
    {
        $this->db->query('INSERT INTO student_requests_tbl (student_id,advertisement_id)
        VALUES (:student_id, :advertisement_id)');

        $this->db->bind('student_id', $data['student_id']);
        $this->db->bind('advertisement_id', $data['advertisement_id']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStudentRequest($data)
    {

    }

    public function deleteStudentRequest($StudentRequestId)
    {
    }


    //check if student request is repeated 
    public function checkStudentRequest($ad_id , $std_id){
        $this->db->query('SELECT * FROM student_requests_tbl WHERE advertisement_id = :advertisement_id AND student_id = :student_id');

        //bind values 
        $this->db->bind(':advertisement_id', $ad_id);
        $this->db->bind(':student_id', $std_id);

        $this->db->single();
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }


    public function getStudentByRequest($advertisementId){
        $this->db->query('SELECT student_tbl.profile_name ,student_tbl.personal_email, student_requests_tbl.student_request_id , student_requests_tbl.student_id, student_requests_tbl.status , student_requests_tbl.advertisement_id , student_requests_tbl.round  
        FROM student_tbl 
        JOIN student_requests_tbl 
        ON student_tbl.student_id = student_requests_tbl.student_id
        WHERE student_requests_tbl.advertisement_id = :advertisement_id');
        $this->db->bind(':advertisement_id', $advertisementId);

        return $this->db->resultset();
    
    }
}
