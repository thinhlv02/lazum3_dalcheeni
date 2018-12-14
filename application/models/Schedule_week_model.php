<?php

Class Schedule_week_model extends MY_Model
{
    var $table = 'schedule_week';

    public function check_id_teach($id, $week_id, $day)
    {
        $sql = "
          SELECT 
              $day
            FROM
              `dalcheeni_lazum3`.`schedule_week` a 
            WHERE a.`week_id` = $week_id 
              AND a.`$day` LIKE '%$id%' 
        ";
        $rows = $this->db->query($sql);
//        echo $sql;
        return $rows->result();
    }

    public function check_branch($id)
    {
        $sql = "
         SELECT * 
            FROM
              `dalcheeni_lazum3`.`schedule_week` a 
            WHERE a.`week_id` = $id 
              AND a.`branch_id` IN 
              (SELECT 
                `id` 
              FROM
                `dalcheeni_lazum3`.`branch`)
        ";
        $rows = $this->db->query($sql);
//        echo $sql;
        return $rows->result();
    }
}