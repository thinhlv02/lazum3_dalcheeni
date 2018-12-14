<?php

Class Schedule_week extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('schedule_week_model');
        $this->load->model('schedule_week_kd_model');
        $this->load->model('week_model');
        $this->load->model('employee_model');
        $this->load->model('teach_model');
        $this->load->model('branch_model');
        $this->load->model('level_model');

        $level = $this->level_model->get_list();
        $this->data['level'] = $level;
//        pre($level);
//        get branch list
//        $branch = $this->branch_model->get_list();
//        $this->data['branch'] = $branch;
//
//        /*lưu vào session*/
//        $this->session->set_userdata('branch', $branch);
//        /*End lưu vào session*/

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
        $schedule_week = $this->week_model->get_list();
        $this->data['res'] = $schedule_week;
//        pre($schedule_week);
        $this->data['temp'] = 'admin/schedule_week/week';
        $this->load->view('admin/layout', $this->data);
    }

    function detail_week($id = '')
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['where'] = array(
            'week_id' => $id
        );
//        pre($input);
//        $schedule_week = $this->schedule_week_model->get_list($input);
        //check branch_id trong branch table và scheduel_week_id có trùng nhau không
        $schedule_week = $this->schedule_week_model->check_branch($id);
//        pre($schedule_week);

//        add search
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
//        End add search

//        pre($schedule_week[0]->id);
        if ($schedule_week == null) {
            echo 'Trang bạn yêu cầu không tồn tại. Vui lòng xem lại đường dẫn! <a href="' . base_url('admin/schedule_week') . '">Quay lại trang lịch tuần</a>';
        } else {
//            pre($schedule_week);
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

//                $sheet->setCellValueByColumnAndRow(2, 2, "LỊCH PHÂN BỔ HUẤN LUYỆN VIÊN " . date('d/m', $week[0]->mon) . ' - ' . date('d/m', $week[0]->sun));
                $sheet->setCellValueByColumnAndRow(2, 2, "LỊCH PHÂN BỔ HUẤN LUYỆN VIÊN ");
                $objPHPExcel->getActiveSheet()->getStyle('C2:G2')->getFont()->setBold(true);
                $sheet->getStyle('C2:F2')->applyFromArray($center);

                $objPHPExcel->getActiveSheet()->getStyle("C2:G2")->getFont()->setSize(16);
                $objPHPExcel->getActiveSheet()->getStyle('A6:I6')->getFont()->setBold(true);

//            pre($data);
                $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'ĐỊA ĐIỂM');
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);

                $objPHPExcel->getActiveSheet()->getStyle('A')
                    ->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'T2' . ' ' . '(' . date('d/m', $week[0]->mon) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'T3' . ' ' . '(' . date('d/m', $week[0]->tue) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('D6', 'T4' . ' ' . '(' . date('d/m', $week[0]->wed) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'T5' . ' ' . '(' . date('d/m', $week[0]->thu) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'T6' . ' ' . '(' . date('d/m', $week[0]->fri) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'T7' . ' ' . '(' . date('d/m', $week[0]->sat) . ')');
                $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'CN' . ' ' . '(' . date('d/m', $week[0]->sun) . ')');
                $objPHPExcel
                    ->getActiveSheet()
                    ->getStyle('A6:H6')
                    ->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3

                $sheet->getStyle("A6:H6")->applyFromArray($center);

                $i = 7;

                foreach ($branch as $key => $value) {
                    $input = array();
//                $input['where'] = array('branch_id' => $value->id, 'week_id' => $schedule_week[$key]->id);
                    $input['where'] = array('branch_id' => $value->id, 'week_id' => $week[0]->id);
//                pre($input);
//                $input['where'] = array('branch_id' => 6, 'week_id' => 1);
                    $item = $this->schedule_week_model->get_list($input);
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
                    $start = $displayName = $level_room = $color = '';
                    if ($itemMonId && $itemMonId[0]) {
                        foreach ($itemMonId as $row) {
                            $itemMon = $this->teach_model->get_info($row);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                                $color = substr($info->color, 1);
                                $colorText = substr($info->color_text, 1);
                            }
                            if ($itemMon) {
                                $start = $itemMon->start;
                                $level_room = $itemMon->level_room;
                            }
                            $style_text = array('font' => array('color' => array('rgb' => $colorText)));
                            $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($style_text);

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $start . ' ' . $displayName . ' - ' . $level_room);
                            $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getFill()
                                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($color); //i.e,colorcode=D3D3D3
                            $i++;
                        }
//                        $objPHPExcel->setActiveSheet()->mergeCells('A' . ($old_i) . ':A9');
//                        $objPHPExcel->getActiveSheet()->mergeCells('A7:A9');
                    }
//                    pre($old_i. '->'. $i);

                    $i = $old_i;
                    if ($itemTueId && $itemTueId[0]) {
                        foreach ($itemTueId as $row) {
                            $itemMon = $this->teach_model->get_info($row);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                                $color = substr($info->color, 1);
                                $colorText = substr($info->color_text, 1);
                            }
                            if ($itemMon) {
                                $start = $itemMon->start;
                                $level_room = $itemMon->level_room;
                            }
                            $style_text = array('font' => array('color' => array('rgb' => $colorText)));
                            $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($style_text);

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $start . ' ' . $displayName . ' - ' . $level_room);
                            $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->getFill()
                                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($color); //i.e,colorcode=D3D3D3
                            $i++;
                        }
                    }
//                    pre($old_i. '->'. $i);
                    $i = $old_i;
                    if ($itemWedId && $itemWedId[0]) {
                        foreach ($itemWedId as $row) {
                            $itemMon = $this->teach_model->get_info($row);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                                $color = substr($info->color, 1);
                                $colorText = substr($info->color_text, 1);
                            }
                            if ($itemMon) {
                                $start = $itemMon->start;
                                $level_room = $itemMon->level_room;
                            }
                            $style_text = array('font' => array('color' => array('rgb' => $colorText)));
                            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($style_text);

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $start . ' ' . $displayName . ' - ' . $level_room);
                            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getFill()
                                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($color); //i.e,colorcode=D3D3D3
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemThuId && $itemThuId[0]) {
                        foreach ($itemThuId as $row) {
                            $itemMon = $this->teach_model->get_info($row);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                                $color = substr($info->color, 1);
                                $colorText = substr($info->color_text, 1);
                            }
                            if ($itemMon) {
                                $start = $itemMon->start;
                                $level_room = $itemMon->level_room;
                            }
                            $style_text = array('font' => array('color' => array('rgb' => $colorText)));
                            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($style_text);

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $start . ' ' . $displayName . ' - ' . $level_room);
                            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getFill()
                                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($color); //i.e,colorcode=D3D3D3
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemFriId && $itemFriId[0]) {
                        foreach ($itemFriId as $row) {
                            $itemMon = $this->teach_model->get_info($row);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                                $color = substr($info->color, 1);
                                $colorText = substr($info->color_text, 1);
                            }
                            if ($itemMon) {
                                $start = $itemMon->start;
                                $level_room = $itemMon->level_room;
                            }
                            $style_text = array('font' => array('color' => array('rgb' => $colorText)));
                            $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->applyFromArray($style_text);

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $start . ' ' . $displayName . ' - ' . $level_room);
                            $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getFill()
                                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($color); //i.e,colorcode=D3D3D3
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemSatId && $itemSatId[0]) {
                        foreach ($itemSatId as $row) {
                            $itemMon = $this->teach_model->get_info($row);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                                $color = substr($info->color, 1);
                                $colorText = substr($info->color_text, 1);
                            }
                            if ($itemMon) {
                                $start = $itemMon->start;
                                $level_room = $itemMon->level_room;
                            }
                            $style_text = array('font' => array('color' => array('rgb' => $colorText)));
                            $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($style_text);

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $start . ' ' . $displayName . ' - ' . $level_room);
                            $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getFill()
                                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($color); //i.e,colorcode=D3D3D3
                            $i++;
                        }
                    }
                    $i = $old_i;
                    if ($itemSunId && $itemSunId[0]) {
                        foreach ($itemSunId as $row) {
                            $itemMon = $this->teach_model->get_info($row);
                            $info = $this->employee_model->get_info($itemMon->employee_id);
                            if ($info) {
                                $displayName = $info->displayName;
                                $color = substr($info->color, 1);
                                $colorText = substr($info->color_text, 1);
                            }
                            if ($itemMon) {
                                $start = $itemMon->start;
                                $level_room = $itemMon->level_room;
                            }
                            $style_text = array('font' => array('color' => array('rgb' => $colorText)));
                            $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->applyFromArray($style_text);

                            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $start . ' ' . $displayName . ' - ' . $level_room);
                            $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getFill()
                                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($color); //i.e,colorcode=D3D3D3
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
                header('Content-Disposition: attachment; filename="lichtuan.xls"');
                $objWriter->save('php://output');
            }
            /* End Export excel*/

            $this->data['schedule_week'] = $schedule_week;
//            gửi week_id_detail sang search
            $this->data['week_id'] = $id;
//            pre($schedule_week);
            $this->data['temp'] = 'admin/schedule_week/schedule_week';
            $this->load->view('admin/layout', $this->data);
        }
    }

//add week of year
    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddschedule_week')) {
            $date = $this->input->post('week');
            $date = new DateTime($date);
//            $week = date('Y-m-d', strtotime($week));
            $week = $date->format("W");
            $year = $date->format("Y");
//            $ddate = "2017-08-29";
//            echo 'week_number: ' . $week . 'year: ' . $year . '<br>';
// new
            $time = new DateTime();
            $time->setISODate($year, $week);
            //    for($i=0;$i<7;$i++){
            $mon = $time->format('Y-m-d');
//    echo $mon . '<br>';
            $date = new DateTime($mon);
            $mon = $date->getTimestamp();

            $tue = $date->modify('+1 day');
            $tue = $tue->getTimestamp();

            $wed = $date->modify('+1 day');
            $wed = $wed->getTimestamp();

            $thu = $date->modify('+1 day');
            $thu = $thu->getTimestamp();

            $fri = $date->modify('+1 day');
            $fri = $fri->getTimestamp();

            $sat = $date->modify('+1 day');
            $sat = $sat->getTimestamp();

            $sun = $date->modify('+1 day');
            $sun = $sun->getTimestamp();

            $dataSubmit = array(
                'week_number' => $week,
                'year_number' => $year,
                'mon' => $mon,
                'tue' => $tue,
                'wed' => $wed,
                'thu' => $thu,
                'fri' => $fri,
                'sat' => $sat,
                'sun' => $sun,
            );
//            prev($dataSubmit);
//            die();
//            check xem tuần đã được tạo hay chưa
            $input3 = array();
            $input3['where'] = array(
                'week_number' => $week
            );
            $check_week = $this->week_model->get_list($input3);
            if (count($check_week) > 0) {
                $this->session->set_flashdata('message', 'Tuần ' . $week . ' đã được thêm, vui lòng kiểm tra lại!');
                redirect(base_url('admin/schedule_week'));
            } else {
//                $this->session->set_flashdata('message', 'đúng');
//                redirect(base_url('admin/schedule_week'));
                $insert_id = $this->week_model->create($dataSubmit);
                if ($insert_id >= 0) {
//                thêm dữ liệu tuần các địa điểm vào schedule_week table
                    $schedule_week = $this->branch_model->get_list();
                    $this->data['res'] = $schedule_week;
                    foreach ($schedule_week as $row) {
                        $dataSubmit2 = array(
                            'branch_id' => $row->id,
                            'week_id' => $insert_id
                        );
                        $this->schedule_week_model->create($dataSubmit2);
//                        insert thêm vào schedule_week dinh doanh
                        $this->schedule_week_kd_model->create($dataSubmit2);
                    }

//            pre($insert_id);
//            if ($this->week_model->create($dataSubmit)) {
//                insert new rows to schedule_week

//                / //                insert new rows to schedule_week
                    $this->session->set_flashdata('message', 'Thêm tuần ' . $week . ' thành công!');
                    redirect(base_url('admin/schedule_week'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm tuần thất bại!');
                    redirect(base_url('admin/schedule_week'));
                }
            }
        }
        $this->data['temp'] = 'admin/schedule_week/add';
        $this->load->view('admin/layout', $this->data);
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
            $level_room = $this->input->post('level_room');
            $dataSubmit = array(
                'employee_id' => $emp,
                'thungan' => $emp2,
                'branch_id' => $branch,
                'start' => $start,
                'date' => $day2,
                'level_room' => $level_room,
                'week_id' => $week
            );

            $input_time = array();
            $input_time['where'] = array(
                'start' => $start,
                'date' => $day2,
                'employee_id' => $emp
            );

//            prev($dataSubmit);
            $check_time = $this->teach_model->get_list($input_time);
            if (isset($check_time[0]->id)) {
//                pre($check_time[0]->id);

                $check_first = $this->schedule_week_model->check_id_teach($check_time[0]->id, $check_time[0]->week_id, $day_db);
//                pre($check_first);
//                if (!empty($check_first)) {
                if (is_array($check_first) && count($check_first) > 0) {
//                    đã tồn tại
                    $input_branch = array();
                    $input_branch['where'] = array(
                        'id' => $check_time[0]->branch_id
                    );
                    $this->session->set_flashdata('message', 'Bị trùng lịch dạy lúc:' . $start . ' ở ' . $this->branch_model->get_list($input_branch)[0]->name);
                    redirect(base_url('admin/schedule_week/detail_week/' . $week));

                } else {
//                    b1: xóa luôn id teach không tồn tại đó đi
                    $this->teach_model->delete($check_time[0]->id);
//                    b2:
//                tạo id teach
                    $insert_id = $this->teach_model->create($dataSubmit);
                    if ($insert_id >= 0) {
                        $where = array(
                            'id' => $id
                        );
                        $list_id_employee = $this->schedule_week_model->get_info($id);
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
                        $this->schedule_week_model->update_rule($where, $data);
                        $this->session->set_flashdata('message', 'Thêm chi tiết thành công 1!');
                        redirect(base_url('admin/schedule_week/detail_week/' . $week . '?td=' . $branch . '_' . $day_db . '#' . $branch . '_' . $day_db));
                    } else {
                        $this->session->set_flashdata('message', 'Thêm chi tiết thất bại!');
                        redirect(base_url('admin/schedule_week/detail_week/' . $week));
                    }
                }
            } else {
                //                nếu không trùng lịch các địa điểm khác
                $insert_id = $this->teach_model->create($dataSubmit);
                if ($insert_id >= 0) {
//                pre($insert_id);
                    $where = array(
                        'id' => $id
                    );
                    $list_id_employee = $this->schedule_week_model->get_info($id);
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
                    $this->schedule_week_model->update_rule($where, $data);
//            if ($this->teach_model->demo($emp, $branch, $start, $end)) {
                    $this->session->set_flashdata('message', 'Thêm chi tiết thành công 2!');
                    redirect(base_url('admin/schedule_week/detail_week/' . $week . '?td=' . $branch . '_' . $day_db . '#' . $branch . '_' . $day_db));
                } else {
                    $this->session->set_flashdata('message', 'Thêm chi tiết thất bại!');
                    redirect(base_url('admin/schedule_week/detail_week/' . $week));
                }
            }
//            if (!$check_time) {
////                nếu không trùng lịch các địa điểm khác
//                $insert_id = $this->teach_model->create($dataSubmit);
//                if ($insert_id >= 0) {
////                pre($insert_id);
//
////                $this->teach_model->demo($emp, $branch,$week, $start, $day_db);
//                    $where = array(
//                        'id' => $id
////                    'branch_id' => $branch,
////                    'week_id' => $week
//                    );
//                    $list_id_employee = $this->schedule_week_model->get_info($id);
////                pre($list_id_employee->$day_db);
//                    if ($list_id_employee->$day_db == NULL) {
//                        $data = array(
//                            $day_db => $insert_id
//                        );
//                    } else {
//                        $data = array(
//                            $day_db => $list_id_employee->$day_db . ',' . $insert_id
//                        );
//                    }
//                    $this->schedule_week_model->update_rule($where, $data);
////            if ($this->teach_model->demo($emp, $branch, $start, $end)) {
//                    $this->session->set_flashdata('message', 'Thêm chi tiết thành công!');
//                    redirect(base_url('admin/schedule_week/detail_week/' . $week . '?td=' . $branch . '_' . $day_db . '#' . $branch . '_' . $day_db));
//                } else {
//                    $this->session->set_flashdata('message', 'Thêm chi tiết thất bại!');
//                    redirect(base_url('admin/schedule_week/detail_week/' . $week));
//                }
//            } else {
//                $input_branch = array();
//                $input_branch['where'] = array(
//                    'id' => $check_time[0]->branch_id
//                );
//                $this->session->set_flashdata('message', 'Bị trùng lịch dạy lúc:' . $start . ' ở ' . $this->branch_model->get_list($input_branch)[0]->name);
//                redirect(base_url('admin/schedule_week/detail_week/' . $week));
//            }
        }
        $this->data['temp'] = 'admin/schedule_week/add_schedule';
        $this->load->view('admin/layout', $this->data);
    }

    function edit_schedule($id, $week)
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $teach_id = $this->uri->segment(4);
        $teach_id = intval($teach_id);
//        pre($teach_id);
        $teach = $this->teach_model->get_info($teach_id);
        if ($teach == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin!');
            redirect(base_url('admin/schedule_week'));
        } else {
            $this->data['teach'] = $teach;
        }

        if ($this->input->post('btnUpdateschedule_week')) {
            $name = $this->input->post('teach');
            $thungan = $this->input->post('thungan');
            $start = $this->input->post('start');
            $level_room = $this->input->post('level_room');

            $dataSubmit = array(
                'employee_id' => $name,
                'thungan' => $thungan,
                'start' => $start,
                'level_room' => $level_room
            );
//            pre($teach_id);
//            pre($dataSubmit);
            if ($this->teach_model->update($teach_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin thành công!');
                redirect(base_url('admin/schedule_week/detail_week/' . $week . '?teach_id=' . $teach_id . '#' . $teach_id));
//                redirect(base_url('admin/hlv' . '?employee_id=' . $hlv_id . '#' . $hlv_id));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin thất bại!');
                redirect(base_url('admin/schedule_week/detail_week/' . $week));
            }
        }

        $this->data['temp'] = 'admin/schedule_week/edit_schedule_week';
        $this->load->view('admin/layout', $this->data);
    }

    /*Copy lịch tuần chi tiết*/
    function copy_detail_week()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $week = $this->week_model->get_list();
        $this->data['week'] = $week;
//        pre($schedule_week);
        if ($this->input->post('btnAdd')) {
            $week_from = $this->input->post('week_from');
            $week_to = $this->input->post('week_to');
            $branch = $this->branch_model->get_list();
//            $this->data['branch'] = $branch;
            foreach ($branch as $key => $value) {
                $input = array();
                $inputTo = array();
//                $input['where'] = array('branch_id' => $value->id, 'week_id' => $schedule_week[$key]->id);
                $input['where'] = array('branch_id' => $value->id, 'week_id' => $week_from);
                $inputTo['where'] = array('branch_id' => $value->id, 'week_id' => $week_to);
//                pre($input);
//                $input['where'] = array('branch_id' => 6, 'week_id' => 1);
                $item = $this->schedule_week_model->get_list($input);
                $itemTo = $this->schedule_week_model->get_list($inputTo);
//                prev($input);
//                pre($item);
                $itemMonId = null;
                $itemTueId = null;
                $itemWedId = null;
                $itemThuId = null;
                $itemFriId = null;
                $itemSatId = null;
                $itemSunId = null;
                $arrItem = array(array(), array(), array(), array(), array(), array(), array());
                $arrDay = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');
                if ($item) {
                    $arrItem = array(
                        explode(',', $item[0]->mon),
                        explode(',', $item[0]->tue),
                        explode(',', $item[0]->wed),
                        explode(',', $item[0]->thu),
                        explode(',', $item[0]->fri),
                        explode(',', $item[0]->sat),
                        explode(',', $item[0]->sun)
                    );
                }

                $dataUpdate = array();
//                pre($arrItem);
                for ($i = 0; $i < 7; $i++) {
                    $day = $arrDay[$i];
                    if ($arrItem[$i] && $arrItem[$i][0]) {
                        $update_id = '';
                        foreach ($arrItem[$i] as $row) {
                            $itemMon = $this->teach_model->get_info($row);
                            $date_new = $this->week_model->get_info($week_to);
                            //insert row mới vào teach
                            $input_teach = array(
                                'employee_id' => $itemMon->employee_id,
                                'thungan' => $itemMon->thungan,
                                'branch_id' => $itemMon->branch_id,
                                'start' => $itemMon->start,
                                'date' => $date_new->$day,
                                'level_room' => $itemMon->level_room,
                                'week_id' => $week_to
                            );
                            $insert_id = $this->teach_model->create($input_teach);
                            if ($update_id == '') {
                                $update_id = $insert_id;
                            } else {
                                $update_id = $update_id . ',' . $insert_id;
                            }
                        }
                        $dataUpdate[$day] = $update_id;
                    } else {
                        $dataUpdate[$day] = '';
                    }
                }
                $this->schedule_week_model->update($itemTo[0]->id, $dataUpdate);
//                if ($itemMonId && $itemMonId[0]) {
//                    $update_id = '';
//                    foreach ($itemMonId as $row) {
//                        $itemMon = $this->teach_model->get_info($row);
//                        $date_new = $this->week_model->get_info($week_to);
//                        //insert row mới vào teach
//                        $input_teach = array(
//                            'employee_id' => $itemMon->employee_id,
//                            'thungan' => $itemMon->thungan,
//                            'branch_id' => $itemMon->branch_id,
//                            'start' => $itemMon->start,
//                            'date' => $date_new->mon,
//                            'week_id' => $week_to
//                        );
//                        $insert_id = $this->teach_model->create($input_teach);
//                        if ($update_id == '') {
//                            $update_id = $insert_id;
//                        } else {
//                            $update_id = $update_id . ',' . $insert_id;
//                        }
//                    }
//                    $dataUpdate['mon'] = $update_id;
////                    $where = array('id' => $itemTo[0]->id);
//                    $this->schedule_week_model->update($itemTo[0]->id, $dataUpdate);
//                }
//
//                if ($itemTueId && $itemTueId[0]) {
//                    $update_id = '';
//                    foreach ($itemTueId as $row) {
//                        $itemMon = $this->teach_model->get_info($row);
//                        $date_new = $this->week_model->get_info($week_to);
//                        //insert row mới vào teach
//                        $input_teach = array(
//                            'employee_id' => $itemMon->employee_id,
//                            'thungan' => $itemMon->thungan,
//                            'branch_id' => $itemMon->branch_id,
//                            'start' => $itemMon->start,
//                            'date' => $date_new->tue,
//                            'week_id' => $week_to
//                        );
////                        pre($input_teach);
//                        $insert_id = $this->teach_model->create($input_teach);
////                        $dcm = $dcm. $insert_id;
////                        echo $insert_id . '<br>';
//                        if ($update_id == '') {
//                            $update_id = $insert_id;
//                        } else {
//                            $update_id = $update_id . ',' . $insert_id;
//                        }
//                    }
////                    pre($update_id);
//                    $dataUpdate['tue'] = $update_id;
////                    $dataUpdate = array(
////                        'tue' => $update_id
////                    );
//                    $this->schedule_week_model->update($itemTo[0]->id, $dataUpdate);
//                }
//
//                if ($itemWedId && $itemWedId[0]) {
//                    $update_id = '';
//                    foreach ($itemWedId as $row) {
//                        $itemMon = $this->teach_model->get_info($row);
//                        $date_new = $this->week_model->get_info($week_to);
//                        //insert row mới vào teach
//                        $input_teach = array(
//                            'employee_id' => $itemMon->employee_id,
//                            'thungan' => $itemMon->thungan,
//                            'branch_id' => $itemMon->branch_id,
//                            'start' => $itemMon->start,
//                            'date' => $date_new->wed,
//                            'week_id' => $week_to
//                        );
////                        pre($input_teach);
//                        $insert_id = $this->teach_model->create($input_teach);
////                        echo $insert_id . '<br>';
//                        if ($update_id == '') {
//                            $update_id = $insert_id;
//                        } else {
//                            $update_id = $update_id . ',' . $insert_id;
//                        }
//                    }
////                    pre($update_id);
//                    $dataUpdate['wed'] = $update_id;
////                    $dataUpdate = array(
////                        'wed' => $update_id
////                    );
////                    $where = array('id' => $itemTo[0]->id);
//                    $this->schedule_week_model->update($itemTo[0]->id, $dataUpdate);
//                }
//
//                if ($itemThuId && $itemThuId[0]) {
//                    $update_id = '';
//                    foreach ($itemThuId as $row) {
//                        $itemMon = $this->teach_model->get_info($row);
//                        $date_new = $this->week_model->get_info($week_to);
//                        //insert row mới vào teach
//                        $input_teach = array(
//                            'employee_id' => $itemMon->employee_id,
//                            'thungan' => $itemMon->thungan,
//                            'branch_id' => $itemMon->branch_id,
//                            'start' => $itemMon->start,
//                            'date' => $date_new->thu,
//                            'week_id' => $week_to
//                        );
////                        pre($input_teach);
//                        $insert_id = $this->teach_model->create($input_teach);
////                        echo $insert_id . '<br>';
//                        if ($update_id == '') {
//                            $update_id = $insert_id;
//                        } else {
//                            $update_id = $update_id . ',' . $insert_id;
//                        }
//                    }
////                    pre($update_id);
//                    $dataUpdate['thu'] = $update_id;
////                    $dataUpdate = array(
////                        'thu' => $update_id
////                    );
////                    $where = array('id' => $itemTo[0]->id);
//                    $this->schedule_week_model->update($itemTo[0]->id, $dataUpdate);
//                }
//
//                if ($itemFriId && $itemFriId[0]) {
//                    $update_id = '';
//                    foreach ($itemFriId as $row) {
//                        $itemMon = $this->teach_model->get_info($row);
//                        $date_new = $this->week_model->get_info($week_to);
//                        //insert row mới vào teach
//                        $input_teach = array(
//                            'employee_id' => $itemMon->employee_id,
//                            'thungan' => $itemMon->thungan,
//                            'branch_id' => $itemMon->branch_id,
//                            'start' => $itemMon->start,
//                            'date' => $date_new->fri,
//                            'week_id' => $week_to
//                        );
////                        pre($input_teach);
//                        $insert_id = $this->teach_model->create($input_teach);
////                        echo $insert_id . '<br>';
//                        if ($update_id == '') {
//                            $update_id = $insert_id;
//                        } else {
//                            $update_id = $update_id . ',' . $insert_id;
//                        }
//                    }
////                    pre($update_id);
//                    $dataUpdate['fri'] = $update_id;
////                    $dataUpdate = array(
////                        'fri' => $update_id
////                    );
////                    $where = array('id' => $itemTo[0]->id);
//                    $this->schedule_week_model->update($itemTo[0]->id, $dataUpdate);
//                }
//
//                if ($itemSatId && $itemSatId[0]) {
//                    $update_id = '';
//                    foreach ($itemSatId as $row) {
//                        $itemMon = $this->teach_model->get_info($row);
//                        $date_new = $this->week_model->get_info($week_to);
//                        //insert row mới vào teach
//                        $input_teach = array(
//                            'employee_id' => $itemMon->employee_id,
//                            'thungan' => $itemMon->thungan,
//                            'branch_id' => $itemMon->branch_id,
//                            'start' => $itemMon->start,
//                            'date' => $date_new->sat,
//                            'week_id' => $week_to
//                        );
////                        pre($input_teach);
//                        $insert_id = $this->teach_model->create($input_teach);
////                        $dcm = $dcm. $insert_id;
////                        echo $insert_id . '<br>';
//                        if ($update_id == '') {
//                            $update_id = $insert_id;
//                        } else {
//                            $update_id = $update_id . ',' . $insert_id;
//                        }
//                    }
////                    pre($update_id);
//                    $dataUpdate['sat'] = $update_id;
////                    $dataUpdate = array(
////                        'sat' => $update_id
////                    );
////                    $where = array('id' => $itemTo[0]->id);
//                    $this->schedule_week_model->update($itemTo[0]->id, $dataUpdate);
//                }
//
//                if ($itemSunId && $itemSunId[0]) {
//                    $update_id = '';
//                    foreach ($itemSunId as $row) {
//                        $itemMon = $this->teach_model->get_info($row);
//                        $date_new = $this->week_model->get_info($week_to);
//                        //insert row mới vào teach
//                        $input_teach = array(
//                            'employee_id' => $itemMon->employee_id,
//                            'thungan' => $itemMon->thungan,
//                            'branch_id' => $itemMon->branch_id,
//                            'start' => $itemMon->start,
//                            'date' => $date_new->sun,
//                            'week_id' => $week_to
//                        );
////                        pre($input_teach);
//                        $insert_id = $this->teach_model->create($input_teach);
////                        echo $insert_id . '<br>';
//                        if ($update_id == '') {
//                            $update_id = $insert_id;
//                        } else {
//                            $update_id = $update_id . ',' . $insert_id;
//                        }
//                    }
////                    pre($update_id);
//                    $dataUpdate['sun'] = $update_id;
////                    $dataUpdate = array(
////                        'sun' => $update_id
////                    );
////                    $where = array('id' => $itemTo[0]->id);
//                    $this->schedule_week_model->update($itemTo[0]->id, $dataUpdate);
//                }
            }
            $this->session->set_flashdata('message', 'Copy thành công từ Tuần: ' . $this->week_model->get_info($week_from)->week_number . ' sang tuần: ' . $this->week_model->get_info($week_to)->week_number);
            redirect(base_url('admin/schedule_week/copy_detail_week'));
        }
        $this->data['temp'] = 'admin/schedule_week/copy_detail_week';
        $this->load->view('admin/layout', $this->data);
    }

    /*Copy lịch tuần chi tiết*/

    function del()
    {
        $teach_id = $this->uri->segment(4);
        $schedule_week_id = $this->uri->segment(5);
        $day = $this->uri->segment(6);

        $schedule_week = $this->schedule_week_model->get_info($schedule_week_id);
        $new_id_teach = $schedule_week->$day;
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
        $this->teach_model->delete($teach_id);
        if ($this->schedule_week_model->update($schedule_week_id, $dataUpdate)) {
            $this->session->set_flashdata('message', 'Cập nhật thành công!');
            redirect(base_url('admin/schedule_week/detail_week/' . $this->uri->segment(7) . '?td=' . $this->uri->segment(8) . '_' . $this->uri->segment(6) . '#' . $this->uri->segment(8) . '_' . $this->uri->segment(6)));
        } else {
            $this->session->set_flashdata('message', 'Thất bại!');
            redirect(base_url('admin/schedule_week/detail_week/' . $this->uri->segment(7)));
        }
    }
}