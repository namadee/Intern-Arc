<?php

class AdvertisementModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAdvertisements()
    {
        // Adjustment 1: Show only the advertisements of the current batch
        //Filter by the current Batch
        $batchYear = $_SESSION['batchYear'];


        $this->db->query('SELECT * FROM advertisement_tbl WHERE batch_year = :batch_year');
        $this->db->bind(':batch_year', $batchYear);
        return $this->db->resultset();
    }

    public function getAdvertisementById($id)
    {
        $this->db->query('SELECT * FROM advertisement_tbl WHERE advertisement_id = :advertisement_id');
        $this->db->bind(':advertisement_id', $id);
        return $this->db->single();
    }

    public function showAdvertisementById($advertisementId)
    {

        $this->db->query("SELECT advertisement_tbl.* , company_tbl.company_name 
        FROM advertisement_tbl 
        JOIN company_tbl
        ON company_tbl.company_id = advertisement_tbl.company_id_fk
        WHERE advertisement_id = :advertisement_id");
        $this->db->bind(':advertisement_id', $advertisementId);
        $row = $this->db->single();
        return $row;
    }

    public function addAdvertisement($data)
    {
        $this->db->query('INSERT INTO advertisement_tbl (position,job_description,requirements,start_date,end_date,working_mode,applicable_year,intern_count, company_id_fk, batch_year)
         VALUES (:position,:job_description,:requirements,:internship_start,:internship_end,:working_mode,:required_year,:no_of_interns,:company_id_fk, :batch_year)');

        // Bind Values
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':job_description', $data['job_description']);
        $this->db->bind(':requirements', $data['textElement']);
        $this->db->bind(':internship_start', $data['internship_start']);
        $this->db->bind(':internship_end', $data['internship_end']);
        $this->db->bind(':no_of_interns', $data['no_of_interns']);
        $this->db->bind(':working_mode', $data['working_mode']);
        $this->db->bind(':required_year', $data['required_year']);
        $this->db->bind(':company_id_fk', $data['company_id']);


        //Adjustment 2 - Add the batch year of the advertisement
        //Get the current Batch
        $batchYear = $_SESSION['batchYear'];
        $this->db->bind(':batch_year', $batchYear);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateAdvertisement($data)
    {
        // Prepare Query
        $this->db->query('UPDATE advertisement_tbl SET position = :position,
        job_description = :job_description, requirements = :requirements, 
        start_date = :internship_start, end_date = :internship_end, 
        working_mode = :working_mode, applicable_year = :required_year , intern_count = :no_of_interns
        WHERE advertisement_id = :advertisement_id');

        // Bind Values
        $this->db->bind(':advertisement_id', $data['advertisement_id']);
        $this->db->bind(':position', $data['position']);
        $this->db->bind(':job_description', $data['job_description']);
        $this->db->bind(':requirements', $data['requirements']);
        $this->db->bind(':internship_start', $data['internship_start']);
        $this->db->bind(':internship_end', $data['internship_end']);
        $this->db->bind(':no_of_interns', $data['no_of_interns']);
        $this->db->bind(':working_mode', $data['working_mode']);
        $this->db->bind(':required_year', $data['required_year']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAdvertisement($advertisementId)
    {
        $this->db->query("DELETE FROM advertisement_tbl WHERE advertisement_id = :advertisement_id");
        $this->db->bind(':advertisement_id', $advertisementId);

        if ($this->db->execute()) {
            redirect('advertisements');
        } else {
            return false;
        }
    }

    //GET COMPANY DETAILS RELEVENT TO ADVERTISEMENT 
    public function getCompanyByAd()
    {
        $this->db->query('SELECT advertisement_tbl.position, advertisement_tbl.advertisement_id, company_tbl.company_name, student_requests_tbl.status 
        FROM company_tbl 
        JOIN advertisement_tbl ON company_tbl.company_id = advertisement_tbl.company_id_fk 
        LEFT JOIN student_requests_tbl ON advertisement_tbl.advertisement_id = student_requests_tbl.advertisement_id;');

        return $this->db->resultset();
    }

    //SELECT ADVERTISEMENTS BASED ON COMPANY - Namadee
    public function getAdvertisementsByCompany($companyId)
    {
        $batchYear = $_SESSION['batchYear'];
        //$round = $roundDataArray['roundNumber'];
        $this->db->query('SELECT * FROM advertisement_tbl WHERE company_id_fk = :company_id AND batch_year = :batchYear');
        $this->db->bind(':company_id', $companyId);
        $this->db->bind(':batchYear', $batchYear);

        // $this->db->bind(':round', $round);
        return $this->db->resultset();
    }


    //Get Advertisements and their company name - Ruchira
    public function getAdvertisementsList()
    {
        $this->db->query('SELECT  advertisement_tbl.intern_count,advertisement_tbl.position, advertisement_tbl.advertisement_id, company_tbl.company_name, advertisement_tbl.status
        FROM company_tbl 
        JOIN advertisement_tbl 
        ON company_tbl.company_id = advertisement_tbl.company_id_fk 
        WHERE advertisement_tbl.batch_year = :batch_year');

        $batch =  $_SESSION['batchYear'];
        $this->db->bind(':batch_year', $batch);

        return $this->db->resultset();
    }

    //Change Advertisment Status - PDC
    public function changeAdvertisementStatus($data)
    {
        $this->db->query('UPDATE advertisement_tbl SET status = :status, round = :round WHERE advertisement_id = :advertisement_id');
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':round', $data['round']);
        $this->db->bind(':advertisement_id', $data['advertisement_id']);

        return $this->db->single();
    }

    //Create Interview slots- Company  - Namadee
    public function createInterviewSlots($data)
    {
        //Inseting schedule status into advertisement table
        $this->db->query('UPDATE advertisement_tbl SET schedule_status = :schedule_status WHERE advertisement_id = :advertisement_id');
        $this->db->bind(':schedule_status', $data['schedule_status']);
        $this->db->bind(':advertisement_id', $data['advertisement_id']);
        $this->db->execute();


        $this->db->query('INSERT INTO schedule_tbl (start_date, end_date, advertisement_id) VALUES (:start_date, :end_date, :advertisement_id)');
        $this->db->bind(':advertisement_id', $data['advertisement_id']);
        //bind values
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        //execute
        $this->db->execute();

        //select last insert id as schedule id
        $scheduleId = $this->db->lastInsertId();

        $this->db->query('INSERT INTO event_tbl (recurrence, Interviewee_count, duration, schedule_fk) VALUES (:recurrence, :interviewee_count, :duration, :schedule_fk)');
        $this->db->bind(':recurrence', $data['recurrence']);
        $this->db->bind(':interviewee_count', $data['interviewee_count']);
        $this->db->bind(':duration', $data['duration']);
        $this->db->bind(':schedule_fk', $scheduleId);
        //execute
        $this->db->execute();

        //select last insert id as event id
        $eventId = $this->db->lastInsertId();

        // loop through the array of time periods and insert each one into the time_periods table
        foreach ($data['time_periods'] as $timePeriod) {
            $this->db->query('INSERT INTO timeperiod_tbl (start_time, end_time, event_fk) VALUES (:start_time, :end_time, :event_fk)');
            $this->db->bind(':start_time', $timePeriod['start_time']);
            $this->db->bind(':end_time', $timePeriod['end_time']);
            $this->db->bind(':event_fk', $eventId);
            $this->db->execute();
        }

        //last isert id as timeperiod id
        $timeperiodId = $this->db->lastInsertId();

        //loop through array of time slots and insert each one into the time_slots table
        foreach ($data['time_slots'] as $timeslot) {
            $this->db->query('INSERT INTO timeslot_tbl (start_time, end_time, slot_date, timeperiod_fk) VALUES (:start_time, :end_time, :slot_date, :timeperiod_fk)');
            $this->db->bind(':start_time', $timeslot['start_time']);
            $this->db->bind(':end_time', $timeslot['end_time']);
            $this->db->bind(':slot_date', $timeslot['date']);
            $this->db->bind(':timeperiod_fk', $timeperiodId);
            $this->db->execute();
        }

        //execute
        return true;
    }


    //Get time slots and connect schedule, event, time period tables - company calendar - Namadee
    public function getInterviewSlots($advertisement_id = NULL)
    {
        if ($advertisement_id != NULL) {
            $this->db->query('SELECT s.start_date as slotStartDate, s.end_date as slotEndDate, e.*, tp.*, ts.*, a.*, std.profile_name, std.student_id, u.user_id
            FROM timeslot_tbl ts
            JOIN timeperiod_tbl tp ON ts.timeperiod_fk = tp.timeperiod_id
            JOIN event_tbl e ON tp.event_fk = e.event_id
            JOIN schedule_tbl s ON e.schedule_fk = s.schedule_id
            JOIN advertisement_tbl a ON s.advertisement_id = a.advertisement_id
            LEFT JOIN interviewslots_tbl i ON ts.slot_id = i.timeslot_fk
            LEFT JOIN student_tbl std ON i.student_id_fk = std.student_id
            LEFT JOIN user_tbl u ON std.user_id_fk = u.user_id
            WHERE s.advertisement_id = :advertisement_id            
        ');

            $this->db->bind(':advertisement_id', $advertisement_id);
            return $this->db->resultset();
        } else {
            $this->db->query('SELECT s.start_date as slotStartDate,s.end_date as slotEndDate , e.*,tp.*, ts.*, a.*, c.company_name
        FROM timeslot_tbl ts
        JOIN timeperiod_tbl tp ON ts.timeperiod_fk = tp.timeperiod_id
        JOIN event_tbl e ON tp.event_fk = e.event_id
        JOIN schedule_tbl s ON e.schedule_fk = s.schedule_id
        JOIN advertisement_tbl a ON s.advertisement_id = a.advertisement_id
        JOIN company_tbl c ON a.company_id_fk = c.company_id
        
        ');

            return $this->db->resultset();
        }
    }

    //Get the advertisements by round, batch year and approved for students

    public function getAdvertisementsForStudents($round, $batchYear)
    {
        $this->db->query('SELECT advertisement_tbl.*, company_tbl.*
        FROM advertisement_tbl 
        JOIN company_tbl ON advertisement_tbl.company_id_fk = company_tbl.company_id
        WHERE advertisement_tbl.batch_year = :batch_year AND advertisement_tbl.round = :round AND advertisement_tbl.status = :status');

        $this->db->bind(':batch_year', $batchYear);
        $this->db->bind(':round', $round);
        $this->db->bind(':status', 'approved');

        return $this->db->resultset();
    }
}
