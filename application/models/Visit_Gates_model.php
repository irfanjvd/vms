<?php

class Visit_Gates_model extends CI_Model 
{
   function __construct() 
   { 
        parent::__construct(); 
   }

   function visit_gateslisting($offset=0, $limit=30, $id=false)
   {
       $query = "SELECT  vt.* , t.tenant_name
				FROM visit_gates vt LEFT JOIN tenant t ON vt.tenant_id = t.id
			  ";

	 $query .= " ";
	 $query .= " WHERE 1=1  ";

	if($id)     
    {
      $query .= " AND  vt.id  = ".$id."";
    }
								
		$executionTotal = $this->db->query($query)->num_rows();
		$record = array();
		$record['total']  =  $executionTotal;
								
		if(!$id) $query .= " LIMIT ".$offset.", ".$limit. "";
								
		$executionRecord  = $this->db->query($query)->result();
		$record['record'] =  $executionRecord;
		return $record;
   }

   function visit_gatesdetail($id=false)
   {
     $query = "SELECT * 
				FROM visit_gates
			  ";
	 $query .= " ";
	 $query .= " WHERE 1=1  ";

	if($id)     
    {
      $query .= " AND  visit_gates.id  = ".$id."";
    }
								
		$execution = $this->db->query($query);

        if($execution->num_rows()>0)
        {
            return $execution->result();
        }else{
               return false;
             }
		
   }

    public function visit_gates_list() 
    {
        $query = $this->db->query("SELECT * FROM visit_gates"); 
        
        if($query->num_rows() > 0) 
        { 
           return $query->result(); 
         
        }else{
                return false; 
             } 
    } 
    
}

