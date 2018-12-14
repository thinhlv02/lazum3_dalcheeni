<?php

Class Phieuluong_kd_model extends MY_Model
{
    var $table = 'employee';

    public function demo($employee, $from, $to)
    {
        $sql = "
          SELECT 
              a.`employee_id`,
              c.`level`,
              d.`luong`,
              d.`level_name`,
              a.`branch_id`,
              b.`name`,
              COUNT(a.`id`) nc,
              d.`luong` * COUNT(a.`id`) money 
            FROM
              dalcheeni_lazum3.`teach_kd` a 
              JOIN dalcheeni_lazum3.`branch` b 
                ON a.`branch_id` = b.`id` 
              JOIN dalcheeni_lazum3.`employee` c 
                ON a.`employee_id` = c.`id` 
              JOIN dalcheeni_lazum3.`level` d 
                ON c.`level` = d.`id` 
            WHERE a.`employee_id` = $employee and a.date BETWEEN $from and  $to
            GROUP BY a.`branch_id` 
        ";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}