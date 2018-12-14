<?php
require APPPATH . "libraries/PHPExcel.php";

Class Bangchamcong extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('bangchamcong_model');
        $this->load->model('employee_model');
        $this->load->model('week_model');
        $this->load->model('branch_model');
        $this->load->model('schedule_week_model');
        $input = array();
        $input['where'] = array(
            'role' => 2
        );
        $emp = $this->employee_model->get_list($input);
        $this->data['emp'] = $emp;
    }

    function index()
    {
//        $value1_check = $this->branch_model->check_branch(21);
//        pre($value1_check);
        if ($this->input->post('btnAddEvent')) {
            $employee = $this->input->post('employee');
            $from = $this->input->post('txtFrom');
            $from = new DateTime($from);
            $from = $from->getTimestamp();
            $to = $this->input->post('txtTo');
            $to = new DateTime($to);
            $to = $to->getTimestamp();

            /*get name employee*/
            $name_e2 = $this->employee_model->get_info($employee)->name;
            $this->session->set_userdata('name_e2', $name_e2);
            /*End name employee*/

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
                /*lưu vào session*/
                $this->session->set_userdata('arr_week', $arr_week);
                /*End lưu vào session*/

                $this->data['arr_branch_id'] = $arr_branch_id;
//                pre($arr_branch_id);

                /*lưu vào session branch_id*/
                $this->session->set_userdata('arr_branch_id', $arr_branch_id);
                /*End lưu vào session branch_id*/

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
        //        export data
        if ($this->input->post('btnExportData')) {

            $arr_week = $this->session->userdata('arr_week');
            $arr_branch_id = $this->session->userdata('arr_branch_id');
            $name_e2 = $this->session->userdata('name_e2');

            $this->load->library("excel");
            $objPHPExcel = new PHPExcel();

            /* ADD LOGO */
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $objDrawing->setPath('public/lichtuan.png');
            $objDrawing->setCoordinates('A1');
// set resize to false first
            $objDrawing->setResizeProportional(false);
            $objDrawing->setWidthAndHeight(168, 94);
            $objDrawing->setResizeProportional(true);
// set width later
//            $objDrawing->setWidth(145);
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
//            $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(5);
            /* END LOGO */
            //define center text
            $center = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            );

            $objPHPExcel->setActiveSheetIndex(0);
            $sheet = $objPHPExcel->getActiveSheet();

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C2:H2');
            $sheet->getStyle('C2:H2')->applyFromArray($center);

            $sheet->setCellValueByColumnAndRow(2, 2, "BẢNG CHẤM CÔNG THÁNG " . date('m/Y'));
            $objPHPExcel->getActiveSheet()->getStyle('C2:H2')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D4:G4')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFont()->setBold(true);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C4:H4');
            $sheet->getStyle('C4:H4')->applyFromArray($center);

            $sheet3 = $objPHPExcel->getActiveSheet();
            $sheet3->setCellValueByColumnAndRow(2, 4, "HLV: " . $name_e2);
//            pre($data);

//this breaks the width calculation
//            $sheet->mergeCells('D2:G2');
//            $sheet->getColumnDimension('A')->setAutoSize(true);

            $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'Địa điểm');
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
//            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
//            $objPHPExcel->getActiveSheet()->getColumnDimension('A9')->setWidth(100);
            $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'T2');
            $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'T3');
            $objPHPExcel->getActiveSheet()->SetCellValue('D6', 'T4');
            $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'T5');
            $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'T6');
            $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'T7');
            $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'CN');
            $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'TỔNG');
            $objPHPExcel
                ->getActiveSheet()
                ->getStyle('A6:I6')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3
            $sheet->getStyle("A6:I6")->applyFromArray($center);

            $i = 8;
            $total_m = 0;
            foreach ($arr_week as $key => $value) {
//                pre($arr_week);
                $tuan = $this->week_model->get_info($value->week_id);
                $total_week = 0;
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($i) . ':F' . ($i));
                $sheet->getStyle('C' . ($i) . ':F' . ($i))->applyFromArray($center);

                $num_week = 'TUẦN TỪ ' . date('d/m', $value->start) . ' - ' . date('d/m', $value->end);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $num_week);
//                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($i) . ':I' . ($i));
//                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($i) . ':C' . ($i));

                $objPHPExcel->getActiveSheet()->getStyle('C' . ($i) . ':E' . ($i))->getFont()->setBold(true);
                $i++;
                foreach ($arr_branch_id as $key => $value1) {
                    $value1_check = $this->bangchamcong_model->check_branch($value1);
                    $name_br = '';
                    if ($value1_check) {
                    $name_br = $this->branch_model->get_info($value1)->name;
                    }

                    $total = '';
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $name_br);
                    $dem = '';
                    foreach ($value->data as $data) {

                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->mon) {
                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'mon');
//                                            pre($check_id_teach);
                            if ($check_id_teach) {
                                $total++;
                                $dem++;
                            }
//                            break;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $dem);

                    $dem = '';
                    foreach ($value->data as $data) {
                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->tue) {
                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'tue');
//                                            pre($check_id_teach);
                            if ($check_id_teach) {
                                $total++;
                                $dem++;
                            }
//                            break;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $dem);

                    $dem = '';
                    foreach ($value->data as $data) {
                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->wed) {
                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'wed');
//                                            pre($check_id_teach);
                            if ($check_id_teach) {
                                $total++;
                                $dem++;
                            }
//                            break;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $dem);

                    $dem = '';
                    foreach ($value->data as $data) {
                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->thu) {
                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'thu');
//                                            pre($check_id_teach);
                            if ($check_id_teach) {
                                $total++;
                                $dem++;
                            }
//                            break;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $dem);

                    $dem = '';
                    foreach ($value->data as $data) {
                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->fri) {
                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'fri');
//                                            pre($check_id_teach);
                            if ($check_id_teach) {
                                $total++;
                                $dem++;
                            }
//                            break;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $dem);

                    $dem = '';
                    foreach ($value->data as $data) {
                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->sat) {
                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'sat');
//                                            pre($check_id_teach);
                            if ($check_id_teach) {
                                $total++;
                                $dem++;
                            }
//                            break;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $dem);

                    $dem = '';
                    foreach ($value->data as $data) {
                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->sun) {
                            $check_id_teach = $this->schedule_week_model->check_id_teach($data['id'], $value->week_id, 'sun');
//                                            pre($check_id_teach);
                            if ($check_id_teach) {
                                $total++;
                                $dem++;
                            }
//                            break;
                        }
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $dem);

//                    foreach ($value->data as $data) {
//                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->mon) {
////                            pre(134);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, 1);
//                            $total++;
//                            break;
//                        }
//                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->tue) {
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, 1);
//                            $total++;
//                            break;
//                        }
//                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->wed) {
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, 1);
//                            $total++;
//                            break;
//                        }
//                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->thu) {
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, 1);
//                            $total++;
//                            break;
//                        }
//                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->fri) {
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, 1);
//                            $total++;
//                            break;
//                        }
//                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->sat) {
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, 1);
//                            $total++;
//                            break;
//                        }
//                        if ($data['branch_id'] == $value1 && $data['date'] == $tuan->sun) {
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, 1);
//                            $total++;
//                            break;
//                        }
////                        else {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $total);
////                        }
//                    }
                    $total_week += $total;

                    /*borders*/
                    $BStyle = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
//                                'color' => array('rgb' => 'D3D3D3')
                            )
                        )
                    );
                    $objPHPExcel->getActiveSheet()->getStyle('A' . ($i) . ':I' . ($i))->applyFromArray($BStyle);
                    /*borders*/

                    $i++;
//                pre($row);
                }
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, 'TỔNG TUẦN');
                $objPHPExcel->getActiveSheet()->getStyle('H' . ($i) . ':I' . ($i))->getFont()->setBold(true);
                $objPHPExcel
                    ->getActiveSheet()
                    ->getStyle('A' . ($i) . ':I' . ($i))
                    ->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB('D3D3D3'); //i.e,colorcode=D3D3D3

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $total_week);
                $i++;
                $total_m += $total_week;
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i + 1, 'TỔNG THÁNG');
            $objPHPExcel->getActiveSheet()->getStyle('H' . ($i + 1) . ':I' . ($i + 1))->getFont()->setBold(true);
            $objPHPExcel
                ->getActiveSheet()
                ->getStyle('A' . ($i + 1) . ':I' . ($i + 1))
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i + 1, $total_m);
            $i++;
            $i++;
            $i++;

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i + 1, 'Hà Nội, ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('F' . ($i + 1) . ':I' . ($i + 1));
            $sheet->getStyle('F' . ($i + 1) . ':I' . ($i + 1))->applyFromArray($center);
            $objPHPExcel->getActiveSheet()->getStyle('F' . ($i + 1))->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i + 2, 'Người lập ');
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('F' . ($i + 2) . ':I' . ($i + 2));
            $sheet->getStyle('F' . ($i + 2) . ':H' . ($i + 2))->applyFromArray($center);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header("Content-Type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="LuongHLV.xls"');
            $objWriter->save('php://output');
        }
//        /export data

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/bangchamcong/bangchamcong';
        $this->load->view('admin/layout', $this->data);
    }
}