<?php

class PdcModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // public function getPdcUsers(){
    //     $this->db->query('SELECT * FROM pdc_users');

    //     return $this->db->resultset();
    // }

    // public function getPdcJobroles()
    // {
    //     $this->db->query('SELECT * FROM pdc_jobroles');

    //     return $this->db->resultset();
    // }

    // public function addJobrole($data)
    // {
    //     $this->db->query('INSERT INTO pdc_jobroles(name) 
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
