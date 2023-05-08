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

    //Check whether the roundPeriods are set or not
    // If not set System access will be denied for students and companies
    // If set System access will be granted for students and companies
    // Constraints should be applied for Job roles edit, delete buttons
    // Student and company deactivate buttons
    // 

    //Get the roundPeriods are set or not

}
