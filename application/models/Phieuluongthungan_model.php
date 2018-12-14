<?php

Class Phieuluongthungan_model extends MY_Model
{
    var $table = 'employee';

    public function demo($employee, $from, $to)
    {
        $sql = "
          SELECT 
              a.`thungan`,
              c.`level`,
              d.`luong`,
              d.`level_name`,
              a.`branch_id`,
              b.`name`,
              COUNT(a.`id`) nc,
              d.`luong` * COUNT(a.`id`) money 
            FROM
              dalcheeni_lazum3.`teach` a 
              JOIN dalcheeni_lazum3.`branch` b 
                ON a.`branch_id` = b.`id` 
              JOIN dalcheeni_lazum3.`employee` c 
                ON a.`thungan` = c.`id` 
              JOIN dalcheeni_lazum3.`level` d 
                ON c.`level` = d.`id` 
            WHERE a.`thungan` = $employee and a.date BETWEEN $from and  $to
            GROUP BY a.`branch_id` 
        ";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}