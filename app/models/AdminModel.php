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

  public function getAllCompanies()
  {
    $this->db->query('SELECT c.*,u.* FROM company_tbl c
    JOIN user_tbl u ON u.user_id = c.user_id_fk');
    $result = $this->db->resultset();
    $count = $this->db->rowCount();
    return array('result' => $result, 'count' => $count);
  }


  // Get the companies by registered year
  public function getCompanyByRegisteredYear($year)
  {
    $this->db->query('SELECT c.*, u.*
      FROM company_tbl c
      JOIN user_tbl u ON c.user_id_fk = u.user_id
      WHERE YEAR(u.created_at) = :year');

    $this->db->bind(':year', $year);

    $result = $this->db->resultset();
    $count = $this->db->rowCount();

    return array('result' => $result, 'count' => $count);
  }




  // Get all the student batches
  public function getStudentBatches()
  {
    $this->db->query('SELECT * FROM student_batch_tbl');
    // Execute
    $batches = $this->db->resultset();
    return $batches;
  }



  public function getAdvertisements($batchYear)
  {
    // Adjustment 1: Show only the advertisements of the current batch



    $this->db->query('SELECT a.*, c.*, COUNT(sr.student_request_id) as total_requests 
    FROM advertisement_tbl a 
    JOIN company_tbl c ON a.company_id_fk = c.company_id 
    LEFT JOIN student_requests_tbl sr ON a.advertisement_id = sr.advertisement_id
    WHERE a.batch_year = :batch_year 
    GROUP BY a.advertisement_id');
    $this->db->bind(':batch_year', $batchYear);

    $result = $this->db->resultset();
    $count = $this->db->rowCount();

    return array('result' => $result, 'count' => $count);
  }

  public function getAllStudents()
  {
    $this->db->query('SELECT c.*,u.* FROM company_tbl c
    JOIN user_tbl u ON u.user_id = c.user_id_fk');
    $result = $this->db->resultset();
    $count = $this->db->rowCount();
    return array('result' => $result, 'count' => $count);
  }


  // Get the companies by registered year
  public function getStudentByRegisteredYear($year)
  {
    $this->db->query('SELECT s.*, u.*
      FROM student_tbl s
      JOIN user_tbl u ON s.user_id_fk = u.user_id
      WHERE s.batch_year = :year');

    $this->db->bind(':year', $year);

    $result = $this->db->resultset();
    $count = $this->db->rowCount();

    return array('result' => $result, 'count' => $count);
  }


  //Total Recruited by a company in the selected year
  public function getRecruitCountByYear($year, $companyID)
  {
    $this->db->query('SELECT sr.*,a.position, c.company_name FROM
    student_requests_tbl sr
    JOIN advertisement_tbl a ON a.advertisement_id = sr.advertisement_id
    JOIN company_tbl c ON c.company_id = a.company_id_fk
    WHERE sr.recruit_status = "recruited" AND sr.batch_year = :batchYear AND c.company_id = :companyID');

    $this->db->bind(':batchYear', $year);
    $this->db->bind(':companyID', $companyID);

    $result = $this->db->resultset();

    $count = $this->db->rowCount();

    return $count;
  }

  //Total ads posted by a company in the selected year
  public function getAdCountByYear($year, $companyID)
  {
    $this->db->query('SELECT a.position, c.company_name, a.advertisement_id, a.batch_year
    FROM advertisement_tbl a
    JOIN company_tbl c ON a.company_id_fk = c.company_id
    WHERE a.batch_year = :batchYear AND c.company_id = :companyID');

    $this->db->bind(':batchYear', $year);
    $this->db->bind(':companyID', $companyID);


    $result = $this->db->resultset();
    $count = $this->db->rowCount();

    return $count;
  }

  //Total interns required by a company in the selected year
  public function getInternCountByYear($year, $companyID)
  {
    $this->db->query('SELECT SUM(a.intern_count) as total_intern_count
    FROM advertisement_tbl a
    JOIN company_tbl c ON c.company_id = a.company_id_fk
    WHERE a.batch_year = :batchYear AND c.company_id = :companyID');

    $this->db->bind(':batchYear', $year);
    $this->db->bind(':companyID', $companyID);


    $result = $this->db->single();
    return $result;
  }



  public function getStudentRequestsByRoundCount($data)
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

    $result = $this->db->resultset();
    $count = $this->db->rowCount();

    return $count;
  }


  public function getStudentRequestsByRoundRecruitCount($data)
  {

    $this->db->query('SELECT sr.*, st.*, a.*, c.*, st.status as student_status
      FROM student_requests_tbl sr
      JOIN student_tbl st ON sr.student_id = st.student_id
      JOIN advertisement_tbl a ON sr.advertisement_id = a.advertisement_id
      JOIN company_tbl c ON a.company_id_fk = c.company_id
      WHERE sr.batch_year = :batch_year AND sr.round = :round AND st.stream = :stream 
      AND sr.recruit_status = "recruited"
      GROUP BY sr.student_id;');
    $this->db->bind(':batch_year', $data['batchYear']);
    $this->db->bind(':round', $data['round']);
    $this->db->bind(':stream', $data['stream']);

    $result = $this->db->resultset();
    $count = $this->db->rowCount();

    return $count;
  }

  public function getTopJobPositions($batchYear)
  {
    $this->db->query('SELECT advertisement_tbl.position, count(*) AS applications 
    FROM student_requests_tbl
    JOIN advertisement_tbl ON student_requests_tbl.advertisement_id = advertisement_tbl.advertisement_id 
    WHERE student_requests_tbl.batch_year = :batchYear
    GROUP BY student_requests_tbl.batch_year, position 
    ORDER BY student_requests_tbl.batch_year, applications DESC
    LIMIT 5');

    $this->db->bind(':batchYear', $batchYear);
    $result = $this->db->resultset();

    return $result;
  }


  public function getTopCompanies($batchYear)
  {
    $this->db->query('SELECT c.company_name AS company_name, COUNT(*) AS applications
    FROM student_requests_tbl srt
    JOIN advertisement_tbl a ON srt.advertisement_id = a.advertisement_id
    JOIN company_tbl c ON a.company_id_fk = c.company_id
    WHERE srt.batch_year = :batchYear
    GROUP BY c.company_name
    ORDER BY applications DESC
    LIMIT 5');

    $this->db->bind(':batchYear', $batchYear);
    $result = $this->db->resultset();

    return $result;
  }
}
