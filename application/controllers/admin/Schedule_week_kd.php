<?php

Class Schedule_week_kd extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('schedule_week_kd_model');
        $this->load->model('week_model');
        $this->load->model('employee_model');
        $this->load->model('teach_kd_model');
        $this->load->model('branch_model');
        // get service number to search
        $this->load->model('level_model');
        $level = $this->level_model->get_list();
        $this->data['level'] = $level;
//        pre($level);
//        get branch list

//        $branch = $this->branch_model->get_list();
//        $this->data['branch'] = $branch;

        /*lưu vào session*/
//        $this->session->set_userdata('branch', $branch);
        /*End lưu vào session*/

//        /get branch list
        $input = array();
        $input['where'] = array(
            'role' => 2
        );
        $emp = $this->employee_model->get_list($input);
        $this->data['emp'] = $emp;

        // get list thu ngân
        $input = array();
        $input['where'] = array(
            'role' => 1
        );
        $emp2 = $this->employee_model->get_list($input);
        $this->data['emp2'] = $emp2;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        /*list tuần*/
        $schedule_week_kd = $this->week_model->get_list();
        $this->data['res'] = $schedule_week_kd;
//        pre(schedule_week_kd);
        $this->data['temp'] = 'admin/schedule_week_kd/week_kd';
        $this->load->view('admin/layout', $this->data);
    }

    function detail_week_kd($id = '')
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['where'] = array(
            'week_id' => $id
        );
        $schedule_week_kd = $this->schedule_week_kd_model->get_list($input);
//        pre($schedule_week_kd[0]->id);

        //############################################        add search
        $input_s = array();
        if ($this->input->post('btnSearch')) {
            $branch_s = $this->input->post('branch_s');
            if ($branch_s != 99) {
                $input_s['where']['id'] = $branch_s;
            }
        }
        $branch = $this->branch_model->get_list($input_s);
        $this->data['branch'] = $branch;
        /*lưu vào session*/
        $this->session->set_userdata('branch', $branch);
//        ############################################ End add search

        if ($schedule_week_kd == null) {
            echo 'Trang bạn yêu cầu không tồn tại. Vui lòng xem lại đường dẫn! <a href="' . base_url('admin/schedule_week_kd') . '">Quay lại trang lịch tuần</a>';
        } else {
//            pre($schedule_week_kd);
            $input = array();
            $input['where'] = array(
                'id' => $id
            );
            $week = $this->week_model->get_list($input);
            $this->data['week'] = $week[0];

            /*lưu vào session*/
            $this->session->set_userdata('week', $week);
            /*End lưu vào session*/

//            pre($week);

            /* Export excel*/
            if ($this->input->post('btnExportData')) {
                $week = $this->session->userdata('week');
                $branch = $this->session->userdata('branch');
//                pre($week);

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

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . (2) . ':F' . (2));

                $sheet->setCellValueByColumnAndRow(2, 2, "LỊCH: " . date('d/m', $week[0]->mon) . ' - ' . date('d/m', $week[0]->sun));
                $objPHPExcel->getActiveSheet()->getStyle('C2:G2')->getFont()->setBold(true);
                $sheet->getStyle('C2:F2')->applyFromArray($center);

                $objPHPExcel->getActiveSheet()->getStyle("C2:G2")->getFont()->setSize(16);
                $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFont()->setBold(true);

//            pre($data);
                $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'ĐỊA ĐIỂM');
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);

                $objPHPExcel->getActiveSheet()->getStyle('A')
                    ->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('O')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('R')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('U')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Khung giờ');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C6:E6');
                $sheet->getStyle('C6:E6')->applyFromArray($center);
                $sheet->getStyle('C')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'T2' . ' ' . '(' . date('d/m', $week[0]->mon) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'HV');
                $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'HLV');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('F6:H6');
                $sheet->getStyle('F6:H6')->applyFromArray($center);
                $sheet->getStyle('F')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'T3' . ' ' . '(' . date('d/m', $week[0]->tue) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('F7', 'HV');
                $objPHPExcel->getActiveSheet()->SetCellValue('G7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('H7', 'HLV');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I6:K6');
                $sheet->getStyle('I6:K6')->applyFromArray($center);
                $sheet->getStyle('I')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'T4' . ' ' . '(' . date('d/m', $week[0]->wed) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('I7', 'HV');
                $objPHPExcel->getActiveSheet()->SetCellValue('J7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('K7', 'HLV');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('L6:N6');
                $sheet->getStyle('L6:N6')->applyFromArray($center);
                $sheet->getStyle('L')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'T5' . ' ' . '(' . date('d/m', $week[0]->thu) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('L7', 'HV');
                $objPHPExcel->getActiveSheet()->SetCellValue('M7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('N7', 'HLV');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O6:Q6');
                $sheet->getStyle('O6:Q6')->applyFromArray($center);
                $sheet->getStyle('O')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('O6', 'T6' . ' ' . '(' . date('d/m', $week[0]->fri) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'HV');
                $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q7', 'HLV');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('R6:T6');
                $sheet->getStyle('R6:T6')->applyFromArray($center);
                $sheet->getStyle('R')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('R6', 'T7' . ' ' . '(' . date('d/m', $week[0]->sat) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('R7', 'HV');
                $objPHPExcel->getActiveSheet()->SetCellValue('S7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('T7', 'HLV');


                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('U6:W6');
                $sheet->getStyle('U6:W6')->applyFromArray($center);
                $sheet->getStyle('U')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('U6', 'CN' . ' ' . '(' . date('d/m', $week[0]->sun) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('U7', 'HV');
                $objPHPExcel->getActiveSheet()->SetCellValue('V7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('W7', 'HLV');


//                $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'T3' . ' ' . '(' . date('d/m', $week[0]->tue) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('D6', 'T4' . ' ' . '(' . date('d/m', $week[0]->wed) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'T5' . ' ' . '(' . date('d/m', $week[0]->thu) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'T6' . ' ' . '(' . date('d/m', $week[0]->fri) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'T7' . ' ' . '(' . date('d/m', $week[0]->sat) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'CN' . ' ' . '(' . date('d/m', $week[0]->sun) . ')');
                $objPHPExcel
                    ->getActiveSheet()
                    ->getStyle('A6:H6')
                    ->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3
                $sheet->getStyle("A6:H6")->applyFromArray($center);

                $i = 8;

                foreach ($branch as $key => $value) {
                    $input = array();
//                $input['where'] = array('branch_id' => $value->id, 'week_id' => $schedule_week_kd[$key]->id);
                    $input['where'] = array('branch_id' => $value->id, 'week_id' => $week[0]->id);
//                pre($input);
//                $input['where'] = array('branch_id' => 6, 'week_id' => 1);
                    $item = $this->schedule_week_kd_model->get_list($input);
//                prev($input);
                    $itemMonId = null;
                    $itemTueId = null;
                    $itemWedId = null;
                    $itemThuId = null;
                    $itemFriId = null;
                    $itemSatId = null;
                    $itemSunId = null;
                    if ($item) {
                        $itemMonId = explode(',', $item[0]->mon);
                        $itemTueId = explode(',', $item[0]->tue);
                        $itemWedId = explode(',', $item[0]->wed);
                        $itemThuId = explode(',', $item[0]->thu);
                        $itemFriId = explode(',', $item[0]->fri);
                        $itemSatId = explode(',', $item[0]->sat);
                        $itemSunId = explode(',', $item[0]->sun);
//                    pre($itemMonId);
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $value->name);
                    $old_i = $i;
                    $hv = $displayName = $level_room = $color = '';
                    if ($itemMonId && $itemMonId[0]) {
                        foreach ($itemMonId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
                                $hv = $itemMon->hv;
                                $start = $itemMon->start;
                            }

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $start);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $hv);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $tn);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, 'yen');
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
//                        $objPHPExcel->setActiveSheet()->mergeCells('A' . ($old_i) . ':A9');
//                        $objPHPExcel->getActiveSheet()->mergeCells('A7:A9');
                    }
//                    pre($old_i. '->'. $i);

                    $i = $old_i;
                    if ($itemTueId && $itemTueId[0]) {
                        foreach ($itemTueId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
                                $hv = $itemMon->hv;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $hv);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $tn);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
////                    pre($old_i. '->'. $i);
                    $i = $old_i;
                    if ($itemWedId && $itemWedId[0]) {
                        foreach ($itemWedId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
                                $hv = $itemMon->hv;
                            }

//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $hv . '|' . $tn . '|' . $displayName);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $hv);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $tn);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $displayName);
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemThuId && $itemThuId[0]) {
                        foreach ($itemThuId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
                                $hv = $itemMon->hv;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, $hv);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $i, $tn);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemFriId && $itemFriId[0]) {
                        foreach ($itemFriId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
                                $hv = $itemMon->hv;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $i, $hv);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $i, $tn);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $i, $displayName);

//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemSatId && $itemSatId[0]) {
                        foreach ($itemSatId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
                                $hv = $itemMon->hv;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $i, $hv);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $i, $tn);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemSunId && $itemSunId[0]) {
                        foreach ($itemSunId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
                                $hv = $itemMon->hv;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $i, $hv);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $i, $tn);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
                    /*borders*/
                    $BStyle = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
//                                'color' => array('rgb' => '6665ff')
                            )
                        )
                    );
//                    $objPHPExcel->getActiveSheet()->getStyle('A' . ($old_i) . ':H' . ($old_i))->applyFromArray($BStyle);
                    /*borders*/
                    $max = max(sizeof($itemMonId), sizeof($itemTueId), sizeof($itemWedId), sizeof($itemThuId), sizeof($itemFriId), sizeof($itemSatId), sizeof($itemSunId));
//                    $i++;
                    $i = $old_i + $max;
//                    $objPHPExcel->setActiveSheetIndex()->mergeCells("A".($i).":A".($i + $max));
//                    $objPHPExcel->setActiveSheetIndex()->mergeCells("A11:A12");

//                    pre($i. '-'. $max);
//                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7:A9');
//                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7: A11');
//                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $i + $max);

                }
                $objPHPExcel->getActiveSheet()->getStyle('C7' . ':C' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('F7' . ':F' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('I7' . ':I' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('L7' . ':L' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('O7' . ':O' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('R7' . ':R' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('U7' . ':U' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $sheet->freezePane("C6");

                $objPHPExcel->getActiveSheet()->getStyle('A7' . ':A' . ($i))->getFont()->setBold(true);

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G' . ($i + 1) . ':H' . ($i + 1));
                $sheet->getStyle('G' . ($i + 1) . ':H' . ($i + 1))->applyFromArray($center);

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G' . ($i + 2) . ':H' . ($i + 2));
                $sheet->getStyle('G' . ($i + 2) . ':H' . ($i + 2))->applyFromArray($center);

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i + 1, 'Hà Nội, ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i + 2, 'Người lập ');

                $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 1))->getFont()->setBold(true);
//                $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 2))->getFont()->setBold(true);

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                header("Content-Type: application/vnd.ms-excel");
                header('Content-Disposition: attachment; filename="lichtuan_kd.xls"');
                $objWriter->save('php://output');
            }
            /* End Export excel*/

            /* Export excel thẻ*/
            if ($this->input->post('btnExportCard')) {
                $week = $this->session->userdata('week');
                $branch = $this->session->userdata('branch');
//                pre($week);

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

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . (2) . ':I' . (2));

                $sheet->setCellValueByColumnAndRow(2, 2, "LỊCH: " . date('d/m', $week[0]->mon) . ' - ' . date('d/m', $week[0]->sun));
                $objPHPExcel->getActiveSheet()->getStyle('C2:G2')->getFont()->setBold(true);
                $sheet->getStyle('C2:I2')->applyFromArray($center);

                $objPHPExcel->getActiveSheet()->getStyle("C2:G2")->getFont()->setSize(16);
                $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFont()->setBold(true);

//            pre($data);
                $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'ĐỊA ĐIỂM');
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);

                $objPHPExcel->getActiveSheet()->getStyle('A')
                    ->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);

//                $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()
//                    ->setWidth(5);

//                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(5);
//                $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setWrapText(true);
//                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
//                $objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setWrapText(true);
//                $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
//                $objPHPExcel->getActiveSheet()->getStyle('O')->getAlignment()->setWrapText(true);
//                $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(5);
//                $objPHPExcel->getActiveSheet()->getStyle('R')->getAlignment()->setWrapText(true);
//                $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(5);
//                $objPHPExcel->getActiveSheet()->getStyle('U')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Khung giờ');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C6:I6');
                $sheet->getStyle('C6:I6')->applyFromArray($center);
                $sheet->getStyle('C:AY')->applyFromArray($center);
                $sheet->getStyle('C')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'T2' . ' ' . '(' . date('d/m', $week[0]->mon) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('C7', 'TT');
                $objPHPExcel->getActiveSheet()->SetCellValue('D7', 'LDD');
                $objPHPExcel->getActiveSheet()->SetCellValue('E7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('F7', '6T');
                $objPHPExcel->getActiveSheet()->SetCellValue('G7', '12T');
                $objPHPExcel->getActiveSheet()->SetCellValue('H7', 'W');
                $objPHPExcel->getActiveSheet()->SetCellValue('I7', 'K');


                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('J6:P6');
                $sheet->getStyle('J6:P6')->applyFromArray($center);
//                $sheet->getStyle('J')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('J6', 'T3' . ' ' . '(' . date('d/m', $week[0]->tue) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('J7', 'TT');
                $objPHPExcel->getActiveSheet()->SetCellValue('K7', 'LDD');
                $objPHPExcel->getActiveSheet()->SetCellValue('L7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('M7', '6T');
                $objPHPExcel->getActiveSheet()->SetCellValue('N7', '12T');
                $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'W');
                $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'K');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('Q6:W6');
                $sheet->getStyle('Q6:W6')->applyFromArray($center);
//                $sheet->getStyle('J')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q6', 'T4' . ' ' . '(' . date('d/m', $week[0]->wed) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q7', 'TT');
                $objPHPExcel->getActiveSheet()->SetCellValue('R7', 'LDD');
                $objPHPExcel->getActiveSheet()->SetCellValue('S7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('T7', '6T');
                $objPHPExcel->getActiveSheet()->SetCellValue('U7', '12T');
                $objPHPExcel->getActiveSheet()->SetCellValue('V7', 'W');
                $objPHPExcel->getActiveSheet()->SetCellValue('W7', 'K');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('X6:AD6');
                $sheet->getStyle('X6:AD6')->applyFromArray($center);
//                $sheet->getStyle('J')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('X6', 'T5' . ' ' . '(' . date('d/m', $week[0]->thu) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('X7', 'TT');
                $objPHPExcel->getActiveSheet()->SetCellValue('Y7', 'LDD');
                $objPHPExcel->getActiveSheet()->SetCellValue('Z7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('AA7', '6T');
                $objPHPExcel->getActiveSheet()->SetCellValue('AB7', '12T');
                $objPHPExcel->getActiveSheet()->SetCellValue('AC7', 'W');
                $objPHPExcel->getActiveSheet()->SetCellValue('AD7', 'K');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AE6:AK6');
                $sheet->getStyle('AE6:AK6')->applyFromArray($center);
//                $sheet->getStyle('J')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('AE6', 'T6' . ' ' . '(' . date('d/m', $week[0]->fri) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('AE7', 'TT');
                $objPHPExcel->getActiveSheet()->SetCellValue('AF7', 'LDD');
                $objPHPExcel->getActiveSheet()->SetCellValue('AG7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('AH7', '6T');
                $objPHPExcel->getActiveSheet()->SetCellValue('AI7', '12T');
                $objPHPExcel->getActiveSheet()->SetCellValue('AJ7', 'W');
                $objPHPExcel->getActiveSheet()->SetCellValue('AK7', 'K');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AL6:AR6');
                $sheet->getStyle('AL6:AR6')->applyFromArray($center);
//                $sheet->getStyle('J')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('AL6', 'T7' . ' ' . '(' . date('d/m', $week[0]->sat) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('AL7', 'TT');
                $objPHPExcel->getActiveSheet()->SetCellValue('AM7', 'LDD');
                $objPHPExcel->getActiveSheet()->SetCellValue('AN7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('AO7', '6T');
                $objPHPExcel->getActiveSheet()->SetCellValue('AP7', '12T');
                $objPHPExcel->getActiveSheet()->SetCellValue('AQ7', 'W');
                $objPHPExcel->getActiveSheet()->SetCellValue('AR7', 'K');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AS6:AY6');
                $sheet->getStyle('AS6:AY6')->applyFromArray($center);
//                $sheet->getStyle('J')->applyFromArray($center);
                $objPHPExcel->getActiveSheet()->SetCellValue('AS6', 'CN' . ' ' . '(' . date('d/m', $week[0]->sun) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('AS7', 'TT');
                $objPHPExcel->getActiveSheet()->SetCellValue('AT7', 'LDD');
                $objPHPExcel->getActiveSheet()->SetCellValue('AU7', 'TN');
                $objPHPExcel->getActiveSheet()->SetCellValue('AV7', '6T');
                $objPHPExcel->getActiveSheet()->SetCellValue('AW7', '12T');
                $objPHPExcel->getActiveSheet()->SetCellValue('AX7', 'W');
                $objPHPExcel->getActiveSheet()->SetCellValue('AY7', 'K');

//                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I6:K6');
//                $sheet->getStyle('I6:K6')->applyFromArray($center);
////                $sheet->getStyle('I')->applyFromArray($center);
//                $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'T4' . ' ' . '(' . date('d/m', $week[0]->wed) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('J7', 'TN');
//                $objPHPExcel->getActiveSheet()->SetCellValue('K7', 'HLV');
//
//                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('L6:N6');
//                $sheet->getStyle('L6:N6')->applyFromArray($center);
//                $sheet->getStyle('L')->applyFromArray($center);
//                $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'T5' . ' ' . '(' . date('d/m', $week[0]->thu) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('L7', 'HV');
//                $objPHPExcel->getActiveSheet()->SetCellValue('M7', 'TN');
//                $objPHPExcel->getActiveSheet()->SetCellValue('N7', 'HLV');
//
//                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O6:Q6');
//                $sheet->getStyle('O6:Q6')->applyFromArray($center);
//                $sheet->getStyle('O')->applyFromArray($center);
//                $objPHPExcel->getActiveSheet()->SetCellValue('O6', 'T6' . ' ' . '(' . date('d/m', $week[0]->fri) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('O7', 'HV');
//                $objPHPExcel->getActiveSheet()->SetCellValue('P7', 'TN');
//                $objPHPExcel->getActiveSheet()->SetCellValue('Q7', 'HLV');
//
//                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('R6:T6');
//                $sheet->getStyle('R6:T6')->applyFromArray($center);
//                $sheet->getStyle('R')->applyFromArray($center);
//                $objPHPExcel->getActiveSheet()->SetCellValue('R6', 'T7' . ' ' . '(' . date('d/m', $week[0]->sat) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('R7', 'HV');
//                $objPHPExcel->getActiveSheet()->SetCellValue('S7', 'TN');
//                $objPHPExcel->getActiveSheet()->SetCellValue('T7', 'HLV');
//
//
//                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('U6:W6');
//                $sheet->getStyle('U6:W6')->applyFromArray($center);
//                $sheet->getStyle('U')->applyFromArray($center);
//                $objPHPExcel->getActiveSheet()->SetCellValue('U6', 'CN' . ' ' . '(' . date('d/m', $week[0]->sun) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('U7', 'HV');
//                $objPHPExcel->getActiveSheet()->SetCellValue('V7', 'TN');
//                $objPHPExcel->getActiveSheet()->SetCellValue('W7', 'HLV');


//                $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'T3' . ' ' . '(' . date('d/m', $week[0]->tue) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('D6', 'T4' . ' ' . '(' . date('d/m', $week[0]->wed) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'T5' . ' ' . '(' . date('d/m', $week[0]->thu) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'T6' . ' ' . '(' . date('d/m', $week[0]->fri) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'T7' . ' ' . '(' . date('d/m', $week[0]->sat) . ')');
//                $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'CN' . ' ' . '(' . date('d/m', $week[0]->sun) . ')');
                $objPHPExcel
                    ->getActiveSheet()
                    ->getStyle('A6:H6')
                    ->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3
                $sheet->getStyle("A6:H6")->applyFromArray($center);

                $i = 8;

                foreach ($branch as $key => $value) {
                    $input = array();
//                $input['where'] = array('branch_id' => $value->id, 'week_id' => $schedule_week_kd[$key]->id);
                    $input['where'] = array('branch_id' => $value->id, 'week_id' => $week[0]->id);
//                pre($input);
//                $input['where'] = array('branch_id' => 6, 'week_id' => 1);
                    $item = $this->schedule_week_kd_model->get_list($input);
//                prev($input);
                    $itemMonId = null;
                    $itemTueId = null;
                    $itemWedId = null;
                    $itemThuId = null;
                    $itemFriId = null;
                    $itemSatId = null;
                    $itemSunId = null;
                    if ($item) {
                        $itemMonId = explode(',', $item[0]->mon);
                        $itemTueId = explode(',', $item[0]->tue);
                        $itemWedId = explode(',', $item[0]->wed);
                        $itemThuId = explode(',', $item[0]->thu);
                        $itemFriId = explode(',', $item[0]->fri);
                        $itemSatId = explode(',', $item[0]->sat);
                        $itemSunId = explode(',', $item[0]->sun);
//                    pre($itemMonId);
                    }
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $value->name);
                    $old_i = $i;
                    $hv = $displayName = $level_room = $color = '';
                    if ($itemMonId && $itemMonId[0]) {
                        foreach ($itemMonId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
//                                $hv = $itemMon->hv;
                                $start = $itemMon->start;
                                $TT = $itemMon->TT;
                                $LDD = $itemMon->LDD;
                                $TN = $itemMon->TN;
                                $T6 = $itemMon->T6;
                                $T12 = $itemMon->T12;
                                $W = $itemMon->W;
                                $K = $itemMon->K;
                            }

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $start);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $TT);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $LDD);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $TN);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $T6);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $T12);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $W);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $K);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, 'yen');
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
//                        $objPHPExcel->setActiveSheet()->mergeCells('A' . ($old_i) . ':A9');
//                        $objPHPExcel->getActiveSheet()->mergeCells('A7:A9');
                    }
//                    pre($old_i. '->'. $i);

                    $i = $old_i;
                    if ($itemTueId && $itemTueId[0]) {
                        foreach ($itemTueId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
//                                $hv = $itemMon->hv;
                                $TT = $itemMon->TT;
                                $LDD = $itemMon->LDD;
                                $TN = $itemMon->TN;
                                $T6 = $itemMon->T6;
                                $T12 = $itemMon->T12;
                                $W = $itemMon->W;
                                $K = $itemMon->K;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $TT);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $LDD);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, $TN);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $i, $T6);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $i, $T12);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $i, $W);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $i, $K);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $hv);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $tn);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
//////                    pre($old_i. '->'. $i);
                    $i = $old_i;
                    if ($itemWedId && $itemWedId[0]) {
                        foreach ($itemWedId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
//                                $hv = $itemMon->hv;
                                $start = $itemMon->start;
                                $TT = $itemMon->TT;
                                $LDD = $itemMon->LDD;
                                $TN = $itemMon->TN;
                                $T6 = $itemMon->T6;
                                $T12 = $itemMon->T12;
                                $W = $itemMon->W;
                                $K = $itemMon->K;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $i, $TT);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $i, $LDD);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $i, $TN);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $i, $T6);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $i, $T12);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $i, $W);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $i, $K);

//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $hv . '|' . $tn . '|' . $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $hv);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $tn);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $displayName);
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemThuId && $itemThuId[0]) {
                        foreach ($itemThuId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
//                                $hv = $itemMon->hv;
                                $start = $itemMon->start;
                                $TT = $itemMon->TT;
                                $LDD = $itemMon->LDD;
                                $TN = $itemMon->TN;
                                $T6 = $itemMon->T6;
                                $T12 = $itemMon->T12;
                                $W = $itemMon->W;
                                $K = $itemMon->K;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $i, $TT);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24, $i, $LDD);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25, $i, $TN);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, $i, $T6);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27, $i, $T12);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(28, $i, $W);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(29, $i, $K);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, $hv);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $i, $tn);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemFriId && $itemFriId[0]) {
                        foreach ($itemFriId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
//                                $hv = $itemMon->hv;
                                $start = $itemMon->start;
                                $TT = $itemMon->TT;
                                $LDD = $itemMon->LDD;
                                $TN = $itemMon->TN;
                                $T6 = $itemMon->T6;
                                $T12 = $itemMon->T12;
                                $W = $itemMon->W;
                                $K = $itemMon->K;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(30, $i, $TT);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(31, $i, $LDD);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(32, $i, $TN);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(33, $i, $T6);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(34, $i, $T12);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(35, $i, $W);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(36, $i, $K);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $i, $hv);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $i, $tn);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $i, $displayName);

//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemSatId && $itemSatId[0]) {
                        foreach ($itemSatId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
//                                $hv = $itemMon->hv;
                                $start = $itemMon->start;
                                $TT = $itemMon->TT;
                                $LDD = $itemMon->LDD;
                                $TN = $itemMon->TN;
                                $T6 = $itemMon->T6;
                                $T12 = $itemMon->T12;
                                $W = $itemMon->W;
                                $K = $itemMon->K;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(37, $i, $TT);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(38, $i, $LDD);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(39, $i, $TN);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(40, $i, $T6);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(41, $i, $T12);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(42, $i, $W);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(43, $i, $K);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $i, $hv);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $i, $tn);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemSunId && $itemSunId[0]) {
                        foreach ($itemSunId as $row) {
                            $itemMon = $this->teach_kd_model->get_info($row);
                            $info2 = $this->employee_model->get_info($itemMon->thungan);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                            }
                            if ($info2) {
                                $tn = $info2->displayName;
                            }
                            if ($itemMon) {
//                                $hv = $itemMon->hv;
                                $start = $itemMon->start;
                                $TT = $itemMon->TT;
                                $LDD = $itemMon->LDD;
                                $TN = $itemMon->TN;
                                $T6 = $itemMon->T6;
                                $T12 = $itemMon->T12;
                                $W = $itemMon->W;
                                $K = $itemMon->K;
                            }
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(44, $i, $TT);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(45, $i, $LDD);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(46, $i, $TN);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(47, $i, $T6);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(48, $i, $T12);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(49, $i, $W);
                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(50, $i, $K);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $i, $hv);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $i, $tn);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $i, $displayName);
//                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $hv . '|' . $tn . '|' . $displayName);
                            $i++;
                        }
                    }
                    /*borders*/
                    $BStyle = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
//                                'color' => array('rgb' => '6665ff')
                            )
                        )
                    );
//                    $objPHPExcel->getActiveSheet()->getStyle('A' . ($old_i) . ':H' . ($old_i))->applyFromArray($BStyle);
                    /*borders*/
                    $max = max(sizeof($itemMonId), sizeof($itemTueId), sizeof($itemWedId), sizeof($itemThuId), sizeof($itemFriId), sizeof($itemSatId), sizeof($itemSunId));
//                    $i++;
                    $i = $old_i + $max;
//                    $objPHPExcel->setActiveSheetIndex()->mergeCells("A".($i).":A".($i + $max));
//                    $objPHPExcel->setActiveSheetIndex()->mergeCells("A11:A12");

//                    pre($i. '-'. $max);
//                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7:A9');
//                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7: A11');
//                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $i + $max);

                }
                $objPHPExcel->getActiveSheet()->getStyle('C7' . ':C' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('J7' . ':J' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('Q7' . ':Q' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('X7' . ':X' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('AE7' . ':AE' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('AL7' . ':AL' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $objPHPExcel->getActiveSheet()->getStyle('AS7' . ':AS' . ($i - 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('D0DBCA'); //i.e,colorcode=D3D3D3
                $sheet->freezePane("C6");

                $objPHPExcel->getActiveSheet()->getStyle('A7' . ':A' . ($i))->getFont()->setBold(true);

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G' . ($i + 1) . ':H' . ($i + 1));
                $sheet->getStyle('G' . ($i + 1) . ':H' . ($i + 1))->applyFromArray($center);

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G' . ($i + 2) . ':H' . ($i + 2));
                $sheet->getStyle('G' . ($i + 2) . ':H' . ($i + 2))->applyFromArray($center);

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i + 1, 'Hà Nội, ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i + 2, 'Người lập ');

                $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 1))->getFont()->setBold(true);
//                $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 2))->getFont()->setBold(true);

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                header("Content-Type: application/vnd.ms-excel");
                header('Content-Disposition: attachment; filename="the_kd.xls"');
                $objWriter->save('php://output');
            }
            /* End Export excel card*/

            $this->data['schedule_week_kd'] = $schedule_week_kd;
//            pre($schedule_week_kd);
            //            gửi week_id_detail sang search
            $this->data['week_id'] = $id;
            $this->data['temp'] = 'admin/schedule_week_kd/schedule_week_kd';
            $this->load->view('admin/layout', $this->data);
        }
    }


//add detail week of year
    function add_schedule($week, $id, $branch, $day_db)
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        lấy ngày của tuần để thêm vào field day ở bảng teach
        $input2 = array();
        $input2['where'] = array(
            'id' => $week
        );
        $day2 = $this->week_model->get_list($input2, $day_db);
//        $this->data['day2'] = $day2;
//        pre($day2);
        $day2 = $day2[0]->$day_db;
//        /lấy ngày của tuần để thêm vào field day ở bảng teach
//        pre($day2);
        if ($this->input->post('btnAddschedule_week')) {
            $emp = $this->input->post('emp');
            $emp2 = $this->input->post('emp2');
            $start = $this->input->post('start');
            $hv = $this->input->post('hv');

            $TT = $this->input->post('TT');
            $LDD = $this->input->post('LDD');
            $TN = $this->input->post('TN');
            $T6 = $this->input->post('T6');
            $T12 = $this->input->post('T12');
            $W = $this->input->post('W');
            $K = $this->input->post('K');

            $dataSubmit = array(
                'employee_id' => $emp,
                'thungan' => $emp2,
                'branch_id' => $branch,
                'start' => $start,
                'date' => $day2,
                'hv' => $hv,
                'week_id' => $week,
                'TT' => $TT,
                'LDD' => $LDD,
                'TN' => $TN,
                'T6' => $T6,
                'T12' => $T12,
                'W' => $W,
                'K' => $K
            );

            $input_time = array();
            $input_time['where'] = array(
                'start' => $hv,
                'date' => $day2,
                'employee_id' => $emp
            );

//            prev($dataSubmit);
            $check_time = $this->teach_kd_model->get_list($input_time);
//            pre($check_time);
            if (!$check_time) {
//                nếu không trùng lịch các địa điểm khác
                $insert_id = $this->teach_kd_model->create($dataSubmit);
                if ($insert_id >= 0) {
//                pre($insert_id);

//                $this->teach_kd_model->demo($emp, $branch,$week, $hv, $day_db);
                    $where = array(
                        'id' => $id
//                    'branch_id' => $branch,
//                    'week_id' => $week
                    );
                    $list_id_employee = $this->schedule_week_kd_model->get_info($id);
//                pre($list_id_employee->$day_db);
                    if ($list_id_employee->$day_db == NULL) {
                        $data = array(
                            $day_db => $insert_id
                        );
                    } else {
                        $data = array(
                            $day_db => $list_id_employee->$day_db . ',' . $insert_id
                        );
                    }
                    $this->schedule_week_kd_model->update_rule($where, $data);
//            if ($this->teach_kd_model->demo($emp, $branch, $hv, $end)) {
                    $this->session->set_flashdata('message', 'Thêm chi tiết thành công!');
                    redirect(base_url('admin/schedule_week_kd/detail_week_kd/' . $week));
                } else {
                    $this->session->set_flashdata('message', 'Thêm chi tiết thất bại!');
                    redirect(base_url('admin/schedule_week_kd/detail_week_kd/' . $week));
                }
            } else {
                $input_branch = array();
                $input_branch['where'] = array(
                    'id' => $check_time[0]->branch_id
                );
                $this->session->set_flashdata('message', 'Bị trùng lịch dạy lúc:' . $hv . ' ở ' . $this->branch_model->get_list($input_branch)[0]->name);
                redirect(base_url('admin/schedule_week_kd/detail_week_kd/' . $week));
            }
        }
        $this->data['temp'] = 'admin/schedule_week_kd/add_schedule_kd';
        $this->load->view('admin/layout', $this->data);
    }

    function edit_schedule($id, $week)
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $teach_id = $this->uri->segment(4);
        $teach_id = intval($teach_id);
//        pre($teach_id);
        $teach = $this->teach_kd_model->get_info($teach_id);
        if ($teach == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin!');
            redirect(base_url('admin/schedule_week_kd'));
        } else {
            $this->data['teach'] = $teach;
        }

        if ($this->input->post('btnUpdateschedule_week')) {
            $name = $this->input->post('teach');
            $thungan = $this->input->post('thungan');
            $start = $this->input->post('start');
            $hv = $this->input->post('hv');

            $TT = $this->input->post('TT');
            $LDD = $this->input->post('LDD');
            $TN = $this->input->post('TN');
            $T6 = $this->input->post('T6');
            $T12 = $this->input->post('T12');
            $W = $this->input->post('W');
            $K = $this->input->post('K');

            $dataSubmit = array(
                'employee_id' => $name,
                'thungan' => $thungan,
                'start' => $start,
                'hv' => $hv,
                'TT' => $TT,
                'LDD' => $LDD,
                'TN' => $TN,
                'T6' => $T6,
                'T12' => $T12,
                'W' => $W,
                'K' => $K
            );
//            pre($teach_id);
//            pre($dataSubmit);
            if ($this->teach_kd_model->update($teach_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin thành công!');
                redirect(base_url('admin/schedule_week_kd/detail_week_kd/' . $week));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin thất bại!');
                redirect(base_url('admin/schedule_week_kd/detail_week_kd/' . $week));
            }
        }

        $this->data['temp'] = 'admin/schedule_week_kd/edit_schedule_week_kd';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $teach_id = $this->uri->segment(4);
        $schedule_week_kd_id = $this->uri->segment(5);
        $day = $this->uri->segment(6);

        $schedule_week_kd = $this->schedule_week_kd_model->get_info($schedule_week_kd_id);
        $new_id_teach = $schedule_week_kd->$day;
//        $arr_id_teach = explode(',', $new_id_teach);
        if (strpos($new_id_teach, ',') > 0) {
            $new_id_teach = str_replace($teach_id . ',', '', $new_id_teach);
            $new_id_teach = str_replace(',' . $teach_id, '', $new_id_teach);
//            $new_id_teach = str_replace( ',,',',', $new_id_teach);
        } else {
            $new_id_teach = '';
        }
//        pre($teach_id);
//        pre($new_id_teach);
        $dataUpdate = array(
            $day => $new_id_teach
        );
//        pre($dataUpdate);
        $this->teach_kd_model->delete($teach_id);
        if ($this->schedule_week_kd_model->update($schedule_week_kd_id, $dataUpdate)) {
            $this->session->set_flashdata('message', 'Cập nhật thành công!');
            redirect(base_url('admin/schedule_week_kd/detail_week_kd/' . $this->uri->segment(7)));
        } else {
            $this->session->set_flashdata('message', 'Thất bại!');
            redirect(base_url('admin/schedule_week_kd/detail_week_kd/' . $this->uri->segment(7)));
        }
    }
}