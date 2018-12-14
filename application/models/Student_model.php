<?php

Class Student_model extends MY_Model
{
    var $table = 'student';

    public function demo()
    {
        $sql = "
       SELECT 
          a.`id`,
          a.`name` student,
          a.`email`,
          a.`phone`,
          a.`address`,
          a.`card_id`,
          b.`name` card_name,
          a.`card_start`,
          a.`card_end`,
          a.`start`,
          e.`start` start_name,
          a.`day`,
          a.`ban`,
          c.`day` day_name,
          a.`branch_id`,
          d.`name` branch_name,
          b.`info` 
        FROM
          `dalcheeni_lazum3`.`student` a 
          JOIN dalcheeni_lazum3.`card` b 
            ON a.`card_id` = b.`id` 
          JOIN dalcheeni_lazum3.`day` c 
            ON a.`day` = c.`id` 
          JOIN dalcheeni_lazum3.`branch` d 
            ON a.`branch_id` = d.`id` 
          JOIN dalcheeni_lazum3.`start` e 
            ON a.`start` = e.`id` 
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}