<?php

class PdcModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //Set round periods - When PDC set Round period durations
    public function setRoundPeriod($data)
    {
        $this->db->query('UPDATE round_tbl SET start_date =  :start_date, end_date = :end_date WHERE round_no = :round_no');

        // Bind Values
        $this->db->bind(':round_no', $data['round_no']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Get the roundPeriods are set or not
    public function getRoundPeriods()
    {
        $this->db->query('SELECT * FROM round_tbl');
        return $this->db->resultset();
    }


    public function getRejectedStudentList($batchYear)
    {
        $this->db->query('SELECT student_tbl.*, user_tbl.* FROM student_tbl 
        JOIN user_tbl ON student_tbl.user_id_fk = user_tbl.user_id
        WHERE student_tbl.status = 0 AND batch_year = :batchYear');

        $this->db->bind(':batchYear', $batchYear);
        return $this->db->resultset();
    }

    //Check whether the roundPeriods are set or not
    // If not set System access will be denied for students and companies
    // If set System access will be granted for students and companies
    // Constraints should be applied for Job roles edit, delete buttons
    // Student and company deactivate buttons
    // 

    //Set the advertisements to Round 1
    public function setAdvertisementRoundtoOne($round, $batchYear)
    {
        $this->db->query('UPDATE advertisement_tbl SET round = :round WHERE batch_year = :batchYear ');
        $this->db->bind(':round', $round);
        $this->db->bind(':batchYear', $batchYear);


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Set the advertisement round to Null or 2
    public function setAdvertisementRoundNum($advertisementID, $round)
    {
        $this->db->query('UPDATE advertisement_tbl SET round = :round WHERE advertisement_id = :advertisementID');
        $this->db->bind(':round', $round);
        $this->db->bind(':advertisementID', $advertisementID);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //store round period started notification
    public function sendRoundStartedNotification($data)
    {
        $this->db->query('INSERT INTO notification_tbl (title, message) VALUES (:title, :message)');

        // Bind Values
        $this->db->bind(':title', $data['notification_title']);
        $this->db->bind(':message', $data['notification_msg']);


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // Get all the advertisements by batch Year
    public function getAdvertisements($batchYear)
    {

        $this->db->query('SELECT * FROM advertisement_tbl WHERE batch_year = :batchYear');

        $this->db->bind(':batchYear', $batchYear);
        return $this->db->resultset();
    }

    //Get the round end recruited count
    public function getRoundRecruitedCount($advertisementID, $round)
    {
        $this->db->query('SELECT COUNT(*) as count FROM student_requests_tbl WHERE advertisement_id = :advertisementID 
        AND recruit_status = "recruited" AND round = :round');
        $this->db->bind(':advertisementID', $advertisementID);
        $this->db->bind(':round', $round);

        $result = $this->db->single();
        return $result;
    }

    //After the second round starts the students who are not recruited will be rejected

    //Get all the students
    public function getStudents($batchYear)
    {
        $this->db->query('SELECT * FROM student_tbl WHERE batch_year = :batchYear');
        $this->db->bind(':batchYear', $batchYear);
        return $this->db->resultset();
    }

    // Get the student status
    public function getStudentStatus($studentID)
    {
        //student final status either 1 or 0
        // 1 means Recruited and 0 means not pending
        $this->db->query('SELECT status FROM student_tbl WHERE student_id = :studentID');
        $this->db->bind(':studentID', $studentID);
        $result = $this->db->single();
        return $result;
    }

    //get the student from userID
    public function getStudentFromUserID($userID)
    {
        $this->db->query('SELECT * FROM student_tbl WHERE user_id_fk = :userID');
        $this->db->bind(':userID', $userID);
        $result = $this->db->single();
        return $result;
    }


    public function getStudentFromStdJobrole($studentID)
    {
        $this->db->query('SELECT * FROM student_jobrole_tbl WHERE student_id = :studentID');
        $this->db->bind(':studentID', $studentID);


        $result = $this->db->resultset();
        //Execute
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function setStudentJobRole($studentID, $jobroleID)
    {
        $this->db->query("INSERT INTO student_jobrole_tbl (student_id, jobrole_id) VALUES (:studentID, :jobroleID)");
        $this->db->bind(':studentID', $studentID);
        $this->db->bind(':jobroleID', $jobroleID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getSelectedJobRoles($studentID)
    {
        $this->db->query('SELECT * FROM student_jobrole_tbl WHERE student_id = :studentID');
        $this->db->bind(':studentID', $studentID);


        $result = $this->db->resultset();
        //Execute
        return $result;
    }

    public function getJobroleName($jobroleID)
    {
        $this->db->query('SELECT * FROM jobrole_tbl WHERE jobrole_id = :jobroleID');
        $this->db->bind(':jobroleID', $jobroleID);

        $result = $this->db->single();
        //Execute
        return $result;
    }

    public function getFilteredAds($data)
    {
        $this->db->query('SELECT * FROM advertisement_tbl 
        JOIN company_tbl ON advertisement_tbl.company_id_fk = company_tbl.company_id
        WHERE batch_year = :batchYear AND advertisement_tbl.status = "approved" AND round = 2 AND (position = :position1 OR position = :position2 OR position = :position3)');
        $this->db->bind(':batchYear', $data['batchYear']);
        $this->db->bind(':position1', $data['position1']);
        $this->db->bind(':position2', $data['position2']);
        $this->db->bind(':position3', $data['position3']);

        $result = $this->db->resultset();
        // Execute
        return $result;
    }

    public function setRoundTableToNull()
    {
        $this->db->query('UPDATE round_tbl SET start_date = NULL, end_date = NULL');
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //send round period started notification
    public function getRound1StartedNotification()
    {
        $this->db->query('SELECT * FROM notification_tbl WHERE title = "Round 1 Started"');
        return $this->db->resultset();
    }

    public function getRound2StartedNotification()
    {
        $this->db->query('SELECT * FROM notification_tbl WHERE title = "Round 2 Started"');
        return $this->db->resultset();
    }
}
