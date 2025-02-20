<?php

class Blacklist_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function black_listedlisting($offset = 0, $limit = 30, $id = false)
    {
        $query = "SELECT  b.*, p.visitor_name, u.first_name, u.last_name, u.username, u.type
				FROM black_listed as b
                INNER JOIN visit as v ON (v.visit_id = b.visit_idfk)
                INNER JOIN visitor_profile as p ON (p.visitor_id = b.visitor_idfk)
                INNER JOIN `user` as u ON (u.id = b.created_by)
			  ";
        $query .= " ";
        $query .= " WHERE 1=1  ";

        if ($id) {
            $query .= " AND  black_listed.id  = " . $id . "";
        }

        $query .= " ORDER BY b.id DESC  ";

        $executionTotal = $this->db->query($query)->num_rows();
        $record = array();
        $record['total'] = $executionTotal;

        if (!$id) $query .= " LIMIT " . $offset . ", " . $limit . "";

        $executionRecord = $this->db->query($query)->result();
        $record['record'] = $executionRecord;
        return $record;
    }

    function black_listeddetail($id = false)
    {
        $query = "SELECT * 
				FROM black_listed
			  ";
        $query .= " ";
        $query .= " WHERE 1=1  ";

        if ($id) {
            $query .= " AND  black_listed.id  = " . $id . "";
        }

        $execution = $this->db->query($query);

        if ($execution->num_rows() > 0) {
            return $execution->result();
        } else {
            return false;
        }

    }

    public function black_listed_list()
    {
        $query = $this->db->query("SELECT * FROM black_listed");

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

}

