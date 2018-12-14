<?php

Class Bangchamcong extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('bangchamcong_model');
        $this->load->model('employee_model');
        $this->load->model('week_model');
        $this->load->model('branch_model');
        $input = array();
        $input['where'] = array(
            'role' => 2
        );
        $emp = $this->employee_model->get_list($input);
        $this->data['emp'] = $emp;
    }

    function index()
    {
//        require APPPATH . "libraries/PHPExcel.php";

        if ($this->input->post('btnAddEvent')) {
            $employee = $this->input->post('employee');
            $from = $this->input->post('txtFrom');
            $from = new DateTime($from);
            $from = $from->getTimestamp();
            $to = $this->input->post('txtTo');
            $to = new DateTime($to);
            $to = $to->getTimestamp();

            $input = array();
//            $input['where']['employee_id'] = $employee;
//            $input['where']['date'] = ' >= '.$from;
            $result = $this->week_model->get_list_by_month($employee, $from, $to);
//            pre($result);
            if (sizeof($result) > 0) {
                $week = $result[0]->week_id;
                $arr_week_id = array();
//                $arr_week_id[] = $result[0]->week_id;
                $arr_week = array();
                $count = 0;
//                pre($week);
                $data_index = 0;
                $arr_branch_id = array();
                foreach ($result as $value) {
                    $week_info = $this->week_model->get_info($value->week_id);
//                    var_dump($week_info->mon);
//                    echo '<br>';
//                    var_dump($from);
                    $start = max($week_info->mon, $from);
                    $end = min($week_info->sun, $to);
                    if (!in_array($value->week_id, $arr_week_id)) {
                        $arr_week_id[] = $value->week_id;
                        $arr_week[$count] = new stdClass();
                        $arr_week[$count]->week_id = $value->week_id;
                        $arr_week[$count]->start = $start;
                        $arr_week[$count]->end = $end;
                        $arr_week[$count]->data = array();
                        $count++;
                    }
                    if (!in_array($value->branch_id, $arr_branch_id)) {
                        $arr_branch_id[] = $value->branch_id;
//                        pre($arr_branch_id);
                    }
                }
//                pre($arr_week);
                $this->data['arr_branch_id'] = $arr_branch_id;
//                prev($arr_branch_id);
                foreach ($result as $key => $value) {
                    $k = array_search($value->week_id, $arr_week_id);
                    $arr_week[$k]->data[] = ['id' => $value->id,
                        'employee_id' => $value->employee_id,
                        'branch_id' => $value->branch_id,
                        'date' => $value->date];
                }
//                pre($arr_week_id);
//                pre($arr_week);
                $this->data['arr_week'] = $arr_week;
            }

            $this->data['res'] = $employee;
        }
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/bangchamcong/bangchamcong';
        $this->load->view('admin/layout', $this->data);

//        export data
//        if ($this->input->post('btnExportData')) {
////            echo 'ahihi';
////            pre('conga');
//            $this->load->library("excel");
//            $objPHPExcel = new PHPExcel();
//            $objPHPExcel->setActiveSheetIndex(0);
//            $tableColumns = array('Tên', 'Chức vụ');
//            $column = 0;
//            foreach ($tableColumns as $field) {
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
//                $column++;
//            }
//            $lists = array(
//                array(
//                    'name' => 'a',
//                    'email' => 'a@gmail.com'
//                ),
//                array(
//                    'name' => 'a1',
//                    'email' => 'a1@gmail.com'
//                ),
//                array(
//                    'name' => 'a2',
//                    'email' => 'a2@gmail.com'
//                ),
//            );
//            $i = 2;
//            foreach ($lists as $row) {
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $row['name']);
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $row['email']);
//                $i++;
////                pre($row);
//            }
//            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//            header("Content-Type: application/vnd.ms-excel");
//            header('Content-Disposition: attachment; filename="dataExpore.xls"');
//            $objWriter->save('php://output');
//        }
//        /export data

    }
}