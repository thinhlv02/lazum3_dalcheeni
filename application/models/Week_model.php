<?php

Class Week_model extends MY_Model
{
    var $table = 'week';

    public function get_list_by_month($employee, $from, $to)
    {
        $sql = "SELECT
          `id`,
          `employee_id`,
          `thungan`,
          `branch_id`,
          `start`,
          `date`,
          `week_id`
        FROM `dalcheeni_lazum3`.`teach` a WHERE a.`date` BETWEEN $from AND $to AND a.`employee_id` = $employee ORDER BY a.`week_id`";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}