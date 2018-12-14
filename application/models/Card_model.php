<?php

Class Card_model extends MY_Model
{
    var $table = 'card';

    function report_card($branch, $from, $to)
    {   $add  = '';
        if ($branch != 99) {
            $add = "AND a.`branch_id` = $branch ";
        }

        $sql = "
           SELECT 
              a.`branch_id`,
              b.`name` branch_name,
              a.`start`,
              c.`start` start_name,
              a.`card_id`,
              d.`name` card_name,
              COUNT(a.`card_id`) sl 
            FROM
              `dalcheeni_lazum3`.`student` a 
              JOIN dalcheeni_lazum3.`branch` b 
                ON a.`branch_id` = b.`id` 
              JOIN dalcheeni_lazum3.`start` c 
                ON a.`start` = c.`id` 
              JOIN dalcheeni_lazum3.`card` d 
                ON a.`card_id` = d.`id` 
            WHERE a.`ban` = 0 AND ( a.`card_start` BETWEEN $from AND $to OR a.`card_end` BETWEEN $from AND  $to ) $add
            GROUP BY a.`branch_id`,
              a.`start`,
              a.`card_id` 
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}