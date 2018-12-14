<?php

Class Room_model extends MY_Model
{
    var $table = 'room';

    public function demo()
    {
        $sql = "
            SELECT 
              a.`id`,
              a.`name` room,
              b.`name` 
            FROM
              `dalcheeni_lazum3`.`room` a 
              JOIN dalcheeni_lazum3.`branch` b 
                ON a.`branch_id` = b.`id` 
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}