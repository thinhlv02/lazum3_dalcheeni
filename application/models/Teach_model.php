<?php

Class Teach_model extends MY_Model
{
    var $table = 'teach';

    public function demo($emp, $branch, $week, $day_db)
    {
        $sql = "
            UPDATE 
              `dalcheeni_lazum3`.`schedule_week` 
            SET
              `$day_db` = '$emp' 
            WHERE `branch_id` = '$branch' 
              AND `week_id` = '$week' 
        ";


    }
}