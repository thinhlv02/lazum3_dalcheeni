<?php

Class Employee_model extends MY_Model
{
    var $table = 'employee';

    public function get_employee()
    {
        $sql = "
            SELECT 
              DISTINCT(a.`employee_id`) id,
              b.`name` 
            FROM
              `dalcheeni_lazum3`.`contract_detail` a 
              JOIN dalcheeni_lazum3.`employee` b 
                ON a.`employee_id` = b.`id` 
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}