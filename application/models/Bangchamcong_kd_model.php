<?php

Class Bangchamcong_kd_model extends MY_Model
{
    var $table = 'employee';

    public function demo($employee, $from, $to)
    {
//        $sql = "
//            SELECT
//              a.`id`,
//              a.`employee_id`,
//              b.`name`,
//              d.`luong`,
//              COUNT(a.`id`) nc,
//              (COUNT(a.`id`) * d.`luong` ) money
//            FROM
//              `dalcheeni_lazum3`.`teach_kd` a
//              JOIN dalcheeni_lazum3.`branch` b
//              JOIN dalcheeni_lazum3.`employee` c
//              JOIN dalcheeni_lazum3.`level` d
//                ON a.`branch_id` = b.`id`
//                AND a.`employee_id` = c.`id` WHERE a.`employee_id` = $employee and a.date BETWEEN $from and  $to
//            GROUP BY a.`employee_id`,
//              a.`branch_id`
//        ";
        $sql = "
         SELECT 
          a.`id`,
          a.`employee_id`,
          a.`branch_id`,
          b.`name`,
          a.`date`,
          a.`week_id`,
          c.`week_number` 
        FROM
          `dalcheeni_lazum3`.`teach_kd` a 
          JOIN dalcheeni_lazum3.`branch` b 
            ON a.`branch_id` = b.`id` 
          JOIN dalcheeni_lazum3.`week` c 
            ON a.`week_id` = c.`id` 
        WHERE a.`employee_id` = $employee and a.date BETWEEN $from and  $to
        GROUP BY a.`branch_id`,
          a.`date` 
        ";

        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}