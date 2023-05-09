<?php

class StudentModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    // public function getStudentId($user_id)
    // {
    //     $this->db->query('SELECT student_tbl.student_id
    //     FROM student_tbl
    //     INNER JOIN user_tbl ON user_tbl.user_id = student_tbl.user_id_fk WHERE user_tbl.user_id=:user_id;');

    //     // Bind Values
    //     $this->db->bind(':user_id', $user_id);
    //     return $this->db->single();
    // }
    
     //Update student profile - student
  public function EditStudentProfileDetails($data)
  {
    
      $this->db->query('UPDATE student_tbl SET experience = :experience,
      interests = :interests, github_link = :github_link, linkedin_link = :linkedin_link, qualifications = :qualifications, extracurricular= :extracurricular, contact= :contact, stream= :stream, profile_description= :profile_description, profile_name= :profile_name, personal_email= :personal_email, school= :school 
      WHERE student_id = :student_id');
      
      
      // Bind Values
      $this->db->bind(':experience', $data['experience-list']);
      $this->db->bind(':interests', $data['interests-list']);
      $this->db->bind(':qualifications', $data['qualifications-list']);
      $this->db->bind(':extracurricular', $data['extracurricular-list']);
      $this->db->bind(':school', $data['school']);
      $this->db->bind(':contact', $data['contact']);
      $this->db->bind(':stream', $data['stream']);
      $this->db->bind(':profile_description', $data['profile_description']);
      $this->db->bind(':profile_name', $data['profile_name']);
      $this->db->bind(':personal_email', $data['personal_email']);
      $this->db->bind(':github_link', $data['github_link']);
      $this->db->bind(':linkedin_link', $data['linkedin_link']);
      $this->db->bind(':student_id', $data['student_id']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

  public function getStudentProfileData($student_id)
  {

    
    //bIND STUDENT id
        $this->db->query('SELECT * FROM student_tbl WHERE student_id= :student_id'); //99
        $this->db->bind(':student_id', $student_id); //comment krla thibune

        $row = $this->db->single();
        return $row;
    }

    // 3 Check for Std Index Availability - Ruchira
    public function checkIndexNumber($indexNum)
    {
        $this->db->query('SELECT * FROM `student_tbl` WHERE `index_number` = :index_number');

        // Bind Values
        $this->db->bind(':index_number', $indexNum);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // 4 Check for Std Reg Num Availability - Ruchira
    public function checkRegistrationNumber($registrationNum)
    {
        $this->db->query('SELECT * FROM `student_tbl` WHERE `registration_number` = :registration_number');

        // Bind Values
        $this->db->bind(':registration_number', $registrationNum);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    // 5 Add Student Batch - Ruchira
    public function addStudentBatch($batch_year)
    {
        // Prepare Query
        $this->db->query('INSERT INTO student_batch_tbl(batch_year) VALUES (:batch_year)');

        // Bind Values
        $this->db->bind(':batch_year', $batch_year);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // 6 Get Student Batch - Ruchira
    public function getStudentBatches()
    {
        // Prepare Query
        $this->db->query("SELECT student_batch_tbl.batch_year, student_batch_tbl.access,
        SUM(CASE WHEN student_tbl.stream = 'CS' THEN 1 ELSE 0 END) AS cs_count,
        SUM(CASE WHEN student_tbl.stream = 'IS' THEN 1 ELSE 0 END) AS is_count
        FROM student_batch_tbl
        LEFT JOIN student_tbl ON student_tbl.batch_year = student_batch_tbl.batch_year
        GROUP BY student_batch_tbl.batch_year;");

        return $this->db->resultset();
    }

    // 7 Change Student Batch Status - Ruchira
    public function changeBatchAccess($data)
    {
        // Prepare Query
        $this->db->query('UPDATE student_batch_tbl SET access = :access WHERE batch_year = :batch_year');
        // Bind Values
        $this->db->bind(':batch_year', $data['batch_year']);
        $this->db->bind(':access', $data['access']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // 8 Check student batch availability - Ruchira
    public function checkStudentBatch($batch_year)
    {
        $this->db->query('SELECT * FROM `student_batch_tbl` WHERE `batch_year` = :batch_year');

        // Bind Values
        $this->db->bind(':batch_year', $batch_year);

        $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // 9 Get Student List of that perticular year perticular Stream(Degree Programme)
    //Info from both student table and user table - Ruchira
    public function getStudentList($data)
    {
        $this->db->query('SELECT user_tbl.username, user_tbl.email,user_tbl.user_id, student_tbl.registration_number, student_tbl.index_number
        FROM student_tbl
        INNER JOIN user_tbl ON user_tbl.user_id = student_tbl.user_id_fk AND student_tbl.stream = :stream AND student_tbl.batch_year = :batch_year ;');

        // Bind Values
        $this->db->bind(':batch_year', $data['batch_year']);
        $this->db->bind(':stream', $data['stream']);
        return $this->db->resultset();
    }

    // 10 Retreive main student information - Ruchira
    public function getMainStudentDetails($userId)
    {
        $this->db->query('SELECT user_tbl.username, user_tbl.email,user_tbl.user_id, student_tbl.registration_number, student_tbl.index_number, student_tbl.batch_year,student_tbl.stream
        FROM student_tbl
        INNER JOIN user_tbl ON user_tbl.user_id = :user_id AND student_tbl.user_id_fk = :user_id ;');

        // Bind Values
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }

    public function getStudentData($std_id)
    {
        $this->db->query('SELECT student_tbl.registration_number, user_tbl.email, student_tbl.round, student_requests_tbl.recruit_status
        FROM student_tbl
        JOIN user_tbl ON student_tbl.user_id_fk = user_tbl.user_id
        JOIN student_requests_tbl ON student_tbl.student_id = student_requests_tbl.student_id WHERE student_tbl.student_id=:student_id LIMIT 1;');

        $this->db->bind(':student_id', $std_id);
        return $this->db->resultset();

    }

    // 11 Update main student information (PDC) - Ruchira
    public function updateMainStudentDetails($data)
    {
        $this->db->query('UPDATE student_tbl, user_tbl 
        SET user_tbl.email = :email, user_tbl.username = :username, student_tbl.registration_number = :reg_num, student_tbl.index_number = :index_num,student_tbl.batch_year = :batch_year,student_tbl.stream = :stream
        WHERE user_tbl.user_id = :user_id AND student_tbl.user_id_fk = :user_id;');

        // Bind Values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':reg_num', $data['reg_num']);
        $this->db->bind(':index_num', $data['index_num']);
        $this->db->bind(':batch_year', $data['batch_year']);
        $this->db->bind(':stream', $data['stream']);
        return $this->db->execute();
    }

    // 12 Return Student Count
    public function getStudentCount()
    {
        $this->db->query("SELECT COUNT(*) as totalRows FROM student_tbl");
        return $this->db->single();
    }

    // 13 Deactivate student account
    // public function deactivateStudent()
    // {
    //     $this->db->query("UPDATE student_tbl SET access = 'inactive'");
    //     return $this->db->execute();
    // }


    // 14 Change system access of each students in a particular batch
    public function changeSystemAccessByBatchYear($data)
    {
        $this->db->query("UPDATE user_tbl
        SET system_access = :system_access
        WHERE user_id IN (
          SELECT user_id_fk FROM student_tbl WHERE batch_year = :batch_year)");

        $this->db->bind(':system_access', $data['access']);
        $this->db->bind(':batch_year', $data['batch_year']);

        return $this->db->execute();
    }

    //15 Get Student Count of a particular batch
    public function studentCountOfABatch($batch_year)
    {
        $this->db->query('SELECT COUNT(*) AS count
        FROM student_tbl
        WHERE batch_year = :batch_year;');

        $this->db->bind(':batch_year', $batch_year);
        return $this->db->single();
    }


    // 15 Delete Student Batch
    public function deleteStudentBatch($batch_year)
    {
        $this->db->query('DELETE from student_batch_tbl WHERE batch_year = :batch_year');
        $this->db->bind(':batch_year', $batch_year);
        return $this->db->execute();
    }

    // 16 Change all the Student system access
    public function updateStudentAccess($access)
    {
        $this->db->query('UPDATE user_tbl SET system_access = :system_access WHERE user_role = "student" ');
        $this->db->bind(':system_access', $access);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
