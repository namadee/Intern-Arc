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

    public function getCompanyList()
    {
        $this->db->query("SELECT * FROM test_tbl WHERE user_role='company' ");
        $resultSet = $this->db->resultset();
        return $resultSet;
    }
}
