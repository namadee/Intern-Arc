<?php

class CompanyModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function updateCompanyProfile($data)
    {

        // Prepare Query
        $this->db->query('UPDATE company_tbl SET company_name = :company_name,
      company_address = :company_address, company_slogan = :company_slogan, 
      company_email = :company_email, company_description = :company_description WHERE company_id = :company_id');

        // Bind Values
        $this->db->bind(':company_id', $data['company_id']);
        $this->db->bind(':company_name', $data['company_name']);
        $this->db->bind(':company_address', $data['company_address']);
        $this->db->bind(':company_slogan', $data['company_slogan']);
        $this->db->bind(':company_email', $data['company_email']);
        $this->db->bind(':company_description', $data['company_description']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    //Retrieve main information of companies and who are active
    //PDC - Ruchira


    public function getCompanyList()
    {
        $this->db->query("SELECT user_tbl.username, user_tbl.user_id, user_tbl.email, company_tbl.*
        FROM company_tbl 
        JOIN user_tbl
        ON user_tbl.user_id = company_tbl.user_id_fk
        WHERE user_tbl.account_status = 'active'");
        $resultSet = $this->db->resultset();
        return $resultSet;
    }

    public function searchCompanyList($query)
    {
        $this->db->query("SELECT company_name FROM company_tbl JOIN user_tbl ON user_tbl.user_id = company_tbl.user_id_fk WHERE blacklisted = 0 AND company_name LIKE '%$query%'");
        $resultSet = $this->db->resultset();
        return $resultSet;
    }

    public function mainCompanyDetails($user_id)
    {
        $this->db->query("SELECT user_tbl.username, user_tbl.user_id, user_tbl.email, company_tbl.*
        FROM company_tbl 
        JOIN user_tbl
        ON user_tbl.user_id = :user_id AND company_tbl.user_id_fk = :user_id");

        // Bind Values
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }


    //Update main Company information (PDC) - Ruchira
    public function updateMainCompanyDetails($data)
    {
        $this->db->query('UPDATE company_tbl, user_tbl 
            SET user_tbl.email = :email, user_tbl.username = :username, company_tbl.contact = :contact, company_tbl.company_name = :company_name
            WHERE user_tbl.user_id = :user_id AND company_tbl.user_id_fk = :user_id;');

        // Bind Values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact', $data['contact']);
        $this->db->bind(':company_name', $data['company_name']);

        return $this->db->execute();
    }

    //Return Deactivated Company List
    // Simply the deativated accounts
    public function getDeativatedCompanyList()
    {
        $this->db->query("SELECT user_tbl.*, company_tbl.*
        FROM company_tbl 
        JOIN user_tbl
        ON user_tbl.user_id = company_tbl.user_id_fk
        WHERE user_tbl.account_status = 'deactivated'");
        $resultSet = $this->db->resultset();
        return $resultSet;
    }
    //Return Company Count
    public function getCompanyCount()
    {
        $this->db->query("SELECT COUNT(*) as totalRows FROM company_tbl");
        return $this->db->single();
    }

    public function shortlistStudent($data)
    {
        // Prepare Query
        $this->db->query('UPDATE student_requests_tbl SET status = :status WHERE student_request_id = :request_id');
        // Bind Values
        $this->db->bind(':request_id', $data['request_id']);
        $this->db->bind(':status', $data['status']);

        //E1xecute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //LIST ALL THE ADVERTISEMENTS BY COMPANY WITH SHORTLISTED STUDENTS COUNT FOR
    public function getAdvertisementByStatus($advertisementId)
    {
        $status = 'shortlisted';
        $this->db->query('SELECT advertisement_tbl.position , advertisement_tbl.intern_count, student_requests_tbl.student_request_id , student_requests_tbl.student_id, student_requests_tbl.status , student_requests_tbl.advertisement_id , student_requests_tbl.round  
    FROM advertisement_tbl 
    JOIN student_requests_tbl 
    ON advertisement_tbl.advertisement_id = student_requests_tbl.advertisement_id
    WHERE student_requests_tbl.advertisement_id = :advertisement_id 
    AND student_requests_tbl.status = :status');
        $this->db->bind(':advertisement_id', $advertisementId);
        $this->db->bind(':status', $status);

        return $this->db->resultset();
    }

    //GET SHORTLISTED STUDENTS BY ADVERTISEMENT
    public function getShortlistedStudents($advertisementId)
    {
        $status = 'shortlisted';
        $this->db->query('SELECT student_tbl.profile_name ,student_tbl.personal_email, student_requests_tbl.student_request_id , student_requests_tbl.student_id,student_requests_tbl.status, student_requests_tbl.recruit_status , student_requests_tbl.advertisement_id , student_requests_tbl.round  
        FROM student_tbl 
        JOIN student_requests_tbl 
        ON student_tbl.student_id = student_requests_tbl.student_id
        WHERE student_requests_tbl.advertisement_id = :advertisement_id
        AND student_requests_tbl.status = :status');
        $this->db->bind(':advertisement_id', $advertisementId);
        $this->db->bind(':status', $status);

        return $this->db->resultset();
    }

    //RECRUIT STUDENTS
    public function recruitStudent($data)
    {
        // Prepare Query
        $this->db->query('UPDATE student_requests_tbl SET recruit_status = :recruit_status WHERE student_request_id = :request_id');
        // Bind Values
        $this->db->bind(':request_id', $data['request_id']);
        $this->db->bind(':recruit_status', $data['recruit_status']);

        //E1xecute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    //DASHBOARD FUNCTION - CONNECT STUDENT AND STUDENT AND REQUEST TABLES AND SELECT ALL REQUESTS
    public function getRequestsbyCompany($companyId)
    {
        $this->db->query('SELECT student_tbl.* , 
        student_requests_tbl.student_request_id , student_requests_tbl.student_id, student_requests_tbl.status , 
        student_requests_tbl.advertisement_id , student_requests_tbl.round , advertisement_tbl.advertisement_id , advertisement_tbl.position , advertisement_tbl.company_id_fk
        FROM student_tbl 
        JOIN student_requests_tbl ON student_tbl.student_id = student_requests_tbl.student_id
        JOIN advertisement_tbl ON  student_requests_tbl.advertisement_id = advertisement_tbl.advertisement_id
        WHERE advertisement_tbl.company_id_fk = :company_id');
        $this->db->bind(':company_id', $companyId);
        return $this->db->resultset();
    }

    //Change companies system access - Ruchira
    public function updateCompanyAccess($access)
    {
        $this->db->query('UPDATE user_tbl SET system_access = :system_access WHERE user_role = "company" ');
        $this->db->bind(':system_access', $access);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Check companies system access from users_tbl - Ruchira
    public function checkSystemAccessCompanies()
    {
        $this->db->query('SELECT
        CASE WHEN COUNT(*) = SUM(CASE WHEN user_tbl.system_access = 1 THEN 1 ELSE 0 END) THEN 1
             WHEN COUNT(*) = SUM(CASE WHEN user_tbl.system_access = 0 THEN 1 ELSE 0 END) THEN 0
             ELSE -1 END AS all_access
      FROM user_tbl
      JOIN company_tbl ON user_tbl.user_id = company_tbl.user_id_fk;');

        $all_access =  $this->db->single();
        return $all_access;
    }


    //Check companies system access from users_tbl - Ruchira
    public function updateCompanyBlacklistStatus($blacklistStatus, $userID, $accountStatus)
    {
        $this->db->query('UPDATE company_tbl
        JOIN user_tbl ON company_tbl.user_id_fk = user_tbl.user_id
        SET company_tbl.blacklisted = :blacklistStatus, user_tbl.account_status = :accountStatus
        WHERE company_tbl.user_id_fk = :userID');
        $this->db->bind(':accountStatus', $accountStatus);
        $this->db->bind(':blacklistStatus', $blacklistStatus);
        $this->db->bind(':userID', $userID);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCompany($userID)
    {
        //Only if no advertisements are listed if there are advertisements listed then only deactivate
        $this->db->query('DELETE company_tbl, user_tbl
        FROM company_tbl
        JOIN user_tbl ON company_tbl.user_id_fk = user_tbl.user_id
        WHERE company_tbl.user_id_fk = :userID');
        $this->db->bind(':userID', $userID);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
//GET Company Details from Advertisement ID
    public function getCompanyDetailFromAdID($adID)
    {
        $this->db->query('SELECT * FROM company_tbl
        JOIN advertisement_tbl ON company_tbl.company_id = advertisement_tbl.company_id_fk
        WHERE advertisement_tbl.advertisement_id = :adID');
        $this->db->bind(':adID', $adID);

        //Execute
        return $this->db->single();
    }

}
