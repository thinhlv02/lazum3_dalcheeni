<?php

Class Schedule_week_kd_model extends MY_Model
{
    var $table = 'schedule_week_kd';


    public function check_id_teach($id, $week_id, $day)
    {
        $sql = "
          SELECT 
              $day
            FROM
              `dalcheeni_lazum3`.`schedule_week_kd` a 
            WHERE a.`week_id` = $week_id 
              AND a.`$day` LIKE '%$id%' 
        ";
        $rows = $this->db->query($sql);
//        echo $sql;
        return $rows->result();
    }
}