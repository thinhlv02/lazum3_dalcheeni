<?php

Class Admin_model extends MY_Model
{
    var $table = 'adusers';

    public function function_getlist()
    {
        $sql = "
         SELECT 
  a.`id`,
  a.`UserName`,
  a.`Password`,
  a.`employee_id`,
  b.`name`,
  b.`level`,
  c.`level_name` 
FROM
  `dalcheeni_lazum3`.`adusers` a 
  JOIN dalcheeni_lazum3.`employee` b 
    ON a.`employee_id` = b.`id` 
  JOIN dalcheeni_lazum3.`level` c 
    ON b.`level` = c.`id` 
WHERE a.`UserName` NOT IN ('admin')
        ";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}