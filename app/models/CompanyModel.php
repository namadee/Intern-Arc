<?php

class CompanyModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // public function getCompanyUsers(){
    //     $this->db->query('SELECT * FROM Company_users');

    //     return $this->db->resultset();
    // }

    // public function getCompanyJobroles()
    // {
    //     $this->db->query('SELECT * FROM Company_jobroles');

    //     return $this->db->resultset();
    // }

    // public function addJobrole($data)
    // {
    //     $this->db->query('INSERT INTO Company_jobroles(name) 
    //     VALUES (:jobrole)');

    //     // Bind Values
    //     $this->db->bind(':jobrole', $data['jobrole']);

    //     //Execute
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


}
