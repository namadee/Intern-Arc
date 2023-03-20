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


    //Retrieve main information of companies and only the companies who are not blacklisted
    //PDC - Ruchira
    //blacklisted = 1 means Blacklisted  and 0 not Blacklisted

    public function getCompanyList()
    {
        $this->db->query("SELECT user_tbl.username, user_tbl.user_id, user_tbl.email, company_tbl.company_name, company_tbl.contact 
        FROM company_tbl 
        JOIN user_tbl
        ON user_tbl.user_id = company_tbl.user_id_fk
        WHERE blacklisted = 0");
        $resultSet = $this->db->resultset();
        return $resultSet;
    }

    public function mainCompanyDetails($user_id)
    {
        $this->db->query("SELECT user_tbl.username, user_tbl.user_id, user_tbl.email, company_tbl.company_name, company_tbl.contact 
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

    //Return Blacklisted Company List
    //blacklisted = 1 means Blacklisted  and 0 not Blacklisted
    public function getBlacklistedCompanyList()
    {
        $this->db->query("SELECT user_tbl.username, user_tbl.user_id, user_tbl.email, company_tbl.company_name, company_tbl.contact 
        FROM company_tbl 
        JOIN user_tbl
        ON user_tbl.user_id = company_tbl.user_id_fk
        WHERE blacklisted = 1");
        $resultSet = $this->db->resultset();
        return $resultSet;
    }

    //Return Company Count
    public function getCompanyCount()
    {
        $this->db->query("SELECT COUNT(*) as totalRows FROM company_tbl");
        return $this->db->single();
    }
}
