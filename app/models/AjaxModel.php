<?php

class AjaxModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function searchCompanyFunction($searchItem)
    {

        // PDC - Company search including deactivated companies
        // Prepare Query
        $this->db->query('SELECT user_tbl.username, user_tbl.user_id, user_tbl.email, company_tbl.company_name, company_tbl.contact 
        FROM company_tbl 
        JOIN user_tbl ON user_tbl.user_id = company_tbl.user_id_fk
        WHERE blacklisted = 0 AND (company_tbl.company_name LIKE CONCAT("%", :companyName, "%"))');

        // Bind Values
        $this->db->bind(':companyName', $searchItem);

        $result = $this->db->resultset();
        //Execute
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function searchStudentByIndex($searchItem, $batchYear, $stream)
    {

        // PDC - Company search including deactivated companies
        // Prepare Query
        $this->db->query('SELECT st.index_number, u.user_id
        FROM student_tbl st
        JOIN user_tbl u ON u.user_id = st.user_id_fk 
        WHERE st.stream = :stream AND st.batch_year = :batchYear AND st.index_number LIKE CONCAT("%", :indexNumber, "%")');

        // Bind Values
        $this->db->bind(':indexNumber', $searchItem);
        $this->db->bind(':batchYear', $batchYear);
        $this->db->bind(':stream', $stream);

        $result = $this->db->resultset();
        //Execute
        if ($this->db->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
