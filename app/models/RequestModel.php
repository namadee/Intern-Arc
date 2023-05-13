<?php

class RequestModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getStudentRequests()
    {
        $currentYear = date("Y");
        $batchYear = $currentYear - 3;
        $this->db->query('SELECT * FROM student_requests_tbl WHERE batch_year = :batch_year');
        $this->db->bind('batch_year', $batchYear);
        return $this->db->resultset();
    }

    public function showStudentRequestById($StudentRequestId)
    {
    }

    public function addStudentRequest($data)
    {
        $this->db->query('INSERT INTO student_requests_tbl (student_id,advertisement_id, batch_year)
        VALUES (:student_id, :advertisement_id, :batch_year)');

        $this->db->bind('student_id', $data['student_id']);
        $this->db->bind('advertisement_id', $data['advertisement_id']);
        $this->db->bind('batch_year', $data['batch_year']);

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
    public function checkStudentRequest($ad_id, $std_id)
    {
        $this->db->query('SELECT * FROM student_requests_tbl WHERE advertisement_id = :advertisement_id AND student_id = :student_id');


        //bind values 
        $this->db->bind(':advertisement_id', $ad_id);
        $this->db->bind(':student_id', $std_id);

        $this->db->single();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getRequestCountPerStudent ($std_id){
        $this->db->query('SELECT * FROM student_requests_tbl WHERE student_id = :student_id');

        //bind values
        $this->db->bind(':student_id', $std_id);

        $result = $this->db->resultset();
        $count = $this->db->rowCount();

        return $count;


    }

    public function getAppliedAdvertisements ($std_id){
        $this->db->query('SELECT company_tbl.company_name, advertisement_tbl.position, student_requests_tbl.status
        FROM student_requests_tbl
        JOIN advertisement_tbl ON student_requests_tbl.advertisement_id = advertisement_tbl.advertisement_id
        JOIN company_tbl ON advertisement_tbl.company_id_fk = company_tbl.company_id
        WHERE student_requests_tbl.student_id = :student_id;');

        //bind values
        $this->db->bind(':student_id', $std_id);

        return $this->db->resultset();
    }


    public function getStudentByRequest($advertisementId)
    {
        $this->db->query('SELECT student_tbl.profile_name , student_tbl.stream ,student_tbl.personal_email, student_requests_tbl.student_request_id , student_requests_tbl.student_id, student_requests_tbl.status , student_requests_tbl.advertisement_id , student_requests_tbl.round  
        FROM student_tbl 
        JOIN student_requests_tbl 
        ON student_tbl.student_id = student_requests_tbl.student_id
        WHERE student_requests_tbl.advertisement_id = :advertisement_id');
        $this->db->bind(':advertisement_id', $advertisementId);

        return $this->db->resultset();
    }

    //get a list of shortlisted advertisements of a student - Namadee
    public function shortlistedAds($studentId)
    {
        $this->db->query('SELECT student_requests_tbl.* , advertisement_tbl.*, student_requests_tbl.status as shortlist_status
        FROM student_requests_tbl
        JOIN advertisement_tbl
        ON student_requests_tbl.advertisement_id = advertisement_tbl.advertisement_id
        WHERE student_requests_tbl.status = "shortlisted" AND student_requests_tbl.recruit_status = "pending" AND student_requests_tbl.student_id = :student_id');
        //bind values
        $this->db->bind(':student_id', $studentId);

        return $this->db->resultset();
    }

    //join advertisement and student request table
    public function getAdvertisementByRequest($advertisementId)
    {
        $this->db->query('SELECT advertisement_tbl.position , advertisement_tbl.intern_count, student_requests_tbl.student_request_id , student_requests_tbl.student_id, student_requests_tbl.status , student_requests_tbl.advertisement_id , student_requests_tbl.round  
        FROM advertisement_tbl 
        JOIN student_requests_tbl 
        ON advertisement_tbl.advertisement_id = student_requests_tbl.advertisement_id
        WHERE student_requests_tbl.advertisement_id = :advertisement_id');
        $this->db->bind(':advertisement_id', $advertisementId);

        return $this->db->resultset();
    }

    // To get the student requests by round in the respective batch year - Ruchira
    // Stream also considered
    public function getStudentRequestsByRound($data)
    {

        $this->db->query('SELECT sr.*, st.*, a.*, c.*, st.status as student_status
        FROM student_requests_tbl sr
        JOIN student_tbl st ON sr.student_id = st.student_id
        JOIN advertisement_tbl a ON sr.advertisement_id = a.advertisement_id
        JOIN company_tbl c ON a.company_id_fk = c.company_id
        WHERE sr.batch_year = :batch_year AND sr.round = :round AND st.stream = :stream
        GROUP BY sr.student_id;');
        $this->db->bind(':batch_year', $data['batchYear']);
        $this->db->bind(':round', $data['round']);
        $this->db->bind(':stream', $data['stream']);
        return $this->db->resultset();
    }

    // To get the student requests by studentID - Ruchira
    public function retrieveStudentRequestsByStudentID($round, $studentID)
    {
        $this->db->query('SELECT sr.*, st.*, a.*, u.*,c.*, sr.status as initial_status, sr.advertisement_id as ad_id
        FROM student_requests_tbl sr
        JOIN student_tbl st ON sr.student_id = st.student_id
        JOIN advertisement_tbl a ON sr.advertisement_id = a.advertisement_id
        JOIN user_tbl u ON st.user_id_fk = u.user_id
        JOIN company_tbl c ON a.company_id_fk = c.company_id
        WHERE sr.student_id = :student_id AND sr.round = :round;');
        $this->db->bind(':student_id', $studentID);
        $this->db->bind(':round', $round);

        return $this->db->resultset();
    }
}
