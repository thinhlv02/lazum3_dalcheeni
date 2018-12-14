<?php

Class Contract_detail_model extends MY_Model
{
    var $table = 'contract_detail';

    public function contract_start($id)
    {
        $sql = "
            SELECT 
                  a.`contract_id`,
                  a.`start_contract_date`,
                  a.`end_contract_date`,
                  b.`name` 
                FROM
                  `dalcheeni_lazum3`.`contract_detail` a 
                  JOIN dalcheeni_lazum3.`contract` b 
                    ON a.`contract_id` = b.`id` 
                WHERE a.`employee_id` = $id 
        ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function contract_start_update($employee_id, $ngaybatdau, $contract_id)
    {
        $sql = "
            UPDATE 
              `dalcheeni_lazum3`.`contract_detail` 
            SET
              `start_contract_date` = $ngaybatdau,
              `contract_id` = $contract_id
            WHERE `employee_id` = $employee_id
        ";
//        pre($sql);
        $rows = $this->db->query($sql);
//        return $rows->result();
    }
}