<?php

Class Data_model extends MY_Model
{
    var $table = 'CDR_LOG_DAILY';

//    var $key = 'MAPPING_ID';
    function demo($txtFrom, $txtTo, $Table_Log, $Telco, $SERVICE_NUMBER_NAME, $COMMAND_CODE_NAME, $sub)
    {
        $time = " TO_DATE(a.GEN_DATE,'DD-MON-YY')  BETWEEN TO_DATE('" . $txtFrom . "', 'DD/MM/YYYY')
            AND TO_DATE('" . $txtTo . "', 'DD/MM/YYYY')";
        $add = '';
//        echo $time;
        if ($SERVICE_NUMBER_NAME != '') {
            if ($Table_Log === 'CDR_LOG') {
                $SERVICE_NUMBER_NAME = '84' . $SERVICE_NUMBER_NAME;
                $add .= " AND a.SERVICE_ID =  '$SERVICE_NUMBER_NAME' ";
            } else {
                $add .= " AND a.SERVICE_NUMBER =  '$SERVICE_NUMBER_NAME' ";
            }
        }

        if ($COMMAND_CODE_NAME != '') {
            $add .= " AND a.COMMAND_CODE =  '$COMMAND_CODE_NAME'  ";
        }
//        echo $add . '<br>';
        if ($Telco != '') {
            $add .= " AND a.MOBILE_OPERATOR =  '$Telco'  ";
        }
        if ($sub != 99) {
            $add .= " AND c.SUB_CP_USERNAME =  '$sub'  ";
        }
        // get from cdr_LOG_Daily
//        $query_old = "select a.MOBILE_OPERATOR, a.COMMAND_CODE, a.SERVICE_NUMBER, sum(a.COUNTER) total from $Table_Log a
//          WHERE $time $add group by a.MOBILE_OPERATOR, a.COMMAND_CODE, a.SERVICE_NUMBER";
        if ($Table_Log === 'CDR_LOG') {
            $query = "
            select a.MOBILE_OPERATOR telco, a.COMMAND_CODE,b.COMMAND_CODE_ID,b.SUB_CP_ID,c.SUB_CP_USERNAME, 
            a.SERVICE_ID service_number , count(a.ID) total from 
            $Table_Log a, SMS_COMMAND_CODE b, SMS_SUB_CP c where $time AND 
            a.COMMAND_CODE = b.COMMAND_CODE_NAME and b.SUB_CP_ID= c.SUB_CP_ID $add 
            group by a.MOBILE_OPERATOR,a.COMMAND_CODE, a.SERVICE_ID, b.COMMAND_CODE_ID,b.SUB_CP_ID,c.SUB_CP_USERNAME
         ";
        } else {
            $query = "
            select a.MOBILE_OPERATOR telco, a.COMMAND_CODE,b.COMMAND_CODE_ID,b.SUB_CP_ID,c.SUB_CP_USERNAME, 
            a.SERVICE_NUMBER service_number , count(a.ID) total from 
            $Table_Log a, SMS_COMMAND_CODE b, SMS_SUB_CP c where $time AND 
            a.COMMAND_CODE = b.COMMAND_CODE_NAME and b.SUB_CP_ID= c.SUB_CP_ID $add 
            group by a.MOBILE_OPERATOR,a.COMMAND_CODE, a.SERVICE_NUMBER, b.COMMAND_CODE_ID,b.SUB_CP_ID,c.SUB_CP_USERNAME
         ";
        }
        $rows = $this->db->query($query);
//        echo $query;
        return $rows->result();
    }
}