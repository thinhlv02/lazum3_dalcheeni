<?php
require APPPATH . "libraries/PHPExcel.php";

Class Phieuluong_kd extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('phieuluong_kd_model');
        $this->load->model('employee_model');
        $this->load->model('level_model');
        $this->load->model('congphatsinh_model');
        $input = array();
        $input['where'] = array(
            'role' => 2
        );
        $emp = $this->employee_model->get_list($input);
        $this->data['emp'] = $emp;
    }

    function index()
    {
        if ($this->input->post('btnAddEvent')) {
            $employee = $this->input->post('employee');
            $from = $this->input->post('txtFrom');
            $from = new DateTime($from);
            $from = $from->getTimestamp();
            $to = $this->input->post('txtTo');
            $to = new DateTime($to);
            $to = $to->getTimestamp();

            $name_e = $this->employee_model->get_info($employee)->name;
//            $level_e = $this->level_model->get_info($employee)->name;

            /*get level name*/
            $sql = "SELECT 
                  a.`level`,
                  b.`level_name` 
                FROM
                  `dalcheeni_lazum3`.`employee` a 
                  JOIN dalcheeni_lazum3.`level` b 
                    ON a.`level` = b.`id` 
                WHERE a.`id` = $employee ";
            $rows = $this->level_model->query($sql);
//            pre($rows);
//            return $rows->result();
            $this->session->set_userdata('level_e', $rows);
//            pre($rows);
            /*end level name*/

            $employee = $this->phieuluong_kd_model->demo($employee, $from, $to);
            $this->data['res'] = $employee;
//            pre($employee[0]);
            /*Thêm bảng công phát sinh vào phiếu lương*/
//            $input_cps = array();
//            $input_cps['where'] = array(
//                'name' => $this->input->post('employee'),
//                'date >=' => $from,
//                'date <=' => $to
//            );
//            $congphatsinh = $this->congphatsinh_model->get_list($input_cps);
//            $this->data['congphatsinh'] = $congphatsinh;
//            $this->session->set_userdata('congphatsinh', $congphatsinh);
//            pre($congphatsinh);
            /*End Thêm bảng công phát sinh vào phiếu lương*/

            $this->session->set_userdata('result', $employee);
            $this->session->set_userdata('name_e', $name_e);
        }
        //        export data
        if ($this->input->post('btnExportData')) {

            $data = $this->session->userdata('result');
            $congphatsinh = $this->session->userdata('congphatsinh');
            $name_e = $this->session->userdata('name_e');
            $level_e = $this->session->userdata('level_e');
//            $level_e = $level_e['level_name'];
//            pre($level_e[0]->level_name);

            $this->load->library("excel");
            $objPHPExcel = new PHPExcel();

            /* ADD LOGO */
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('Logo');
            $objDrawing->setDescription('Logo');
            $objDrawing->setPath('public/logo_dalcheeni_lazum3xx.png');
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

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B2:D2');
            $sheet->getStyle('B2:D2')->applyFromArray($center);

            $sheet->setCellValueByColumnAndRow(1, 2, "PHIẾU LƯƠNG CÁ NHÂN");
            $objPHPExcel->getActiveSheet()->getStyle('B2:D2')->getFont()->setBold(true);
            $sheet->getStyle('D2:F2')->applyFromArray($center);

            $objPHPExcel->getActiveSheet()->getStyle('B5:B7')->getFont()->setBold(true);

            $sheet2 = $objPHPExcel->getActiveSheet();
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B3:D3');

            $sheet2->setCellValueByColumnAndRow(1, 3, "Tháng " . date('m/Y'));
            $sheet->getStyle('B3:C3')->applyFromArray($center);


            $sheet3 = $objPHPExcel->getActiveSheet();
            $sheet3->setCellValueByColumnAndRow(1, 5, "Họ và Tên: ");

            $sheet5 = $objPHPExcel->getActiveSheet();
            $sheet5->setCellValueByColumnAndRow(2, 5, $name_e);

            $sheet8 = $objPHPExcel->getActiveSheet();
            $sheet8->setCellValueByColumnAndRow(1, 6, "Chức Vụ: ");

            $sheet9 = $objPHPExcel->getActiveSheet();
            $sheet9->setCellValueByColumnAndRow(2, 6, $level_e[0]->level_name);

            $sheet6 = $objPHPExcel->getActiveSheet();
            $sheet6->setCellValueByColumnAndRow(1, 7, "Đơn vị: ");

            $sheet7 = $objPHPExcel->getActiveSheet();
            $sheet7->setCellValueByColumnAndRow(2, 7, "dalcheeni_lazum3");
//            pre($data);

//this breaks the width calculation
//            $sheet->mergeCells('D2:G2');
//            $sheet->getColumnDimension('A')->setAutoSize(true);

            $objPHPExcel->getActiveSheet()->SetCellValue('A9', 'Địa điểm');
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
//            $objPHPExcel->getActiveSheet()->getColumnDimension('A9')->setWidth(100);
            $objPHPExcel->getActiveSheet()->SetCellValue('B9', 'Số NC');
            $objPHPExcel->getActiveSheet()->SetCellValue('C9', 'Lương');
            $objPHPExcel->getActiveSheet()->SetCellValue('D9', 'Tổng lương');

//            công phát sinh
//            $objPHPExcel->getActiveSheet()->SetCellValue('F9', 'Sự kiện');
//            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
//            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
//            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
//            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
//            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
////            $objPHPExcel->getActiveSheet()->getColumnDimension('A9')->setWidth(100);
//            $objPHPExcel->getActiveSheet()->SetCellValue('G9', 'Tiền');
//            $objPHPExcel->getActiveSheet()->SetCellValue('H9', 'Ghi chú');
//            $objPHPExcel->getActiveSheet()->SetCellValue('I9', 'Loại');
//            $objPHPExcel->getActiveSheet()->SetCellValue('J9', 'Ngày tháng');
//            End công phát sinh

            $objPHPExcel
                ->getActiveSheet()
                ->getStyle('A9:D9')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3

//            $column = 0;
//            foreach ($tableColumns as $field) {
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
//                $column++;
//            }
            $i = 10;
            $total = 0;
            foreach ($data as $row) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $row->name);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, number_format($row->nc));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, number_format($row->luong));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, number_format($row->money));

                /*borders*/
                $BStyle = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
//                            'color' => array('rgb' => '6665ff')
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle('A' . ($i) . ':D' . ($i))->applyFromArray($BStyle);
                /*borders*/
                $i++;
//                pre($row);
                $total += $row->money;
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, 'Tổng Lương');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, number_format($total));
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($i) . ':C' . ($i));
            $objPHPExcel
                ->getActiveSheet()
                ->getStyle('A' . ($i) . ':D' . ($i))
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3
//            $sheet->mergeCells("G".($row_count+1).":I".($row_count+4));

            //            công phát sinh
//            $i = 10;
//            $total_cps = 0;
//            foreach ($congphatsinh as $row) {
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $row->event);
//                if ($row->type == 0) {
//                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, number_format($row->money));
//                } else {
//                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, '-' . number_format($row->money));
//                }
//
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $row->note);
//                if ($row->type == 0) {
//                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, 'Công phát sinh');
//                } else {
//                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, 'Phạt');
//                }
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, date('d-m-Y', $row->date));
//
//                /*borders*/
//                $BStyle = array(
//                    'borders' => array(
//                        'allborders' => array(
//                            'style' => PHPExcel_Style_Border::BORDER_THIN,
////                            'color' => array('rgb' => '6665ff')
//                        )
//                    )
//                );
//                $objPHPExcel->getActiveSheet()->getStyle('F' . ($i) . ':J' . ($i))->applyFromArray($BStyle);
//                /*borders*/
//                $i++;
////                pre($row);
//                if ($row->type == 0) {
//                    $total_cps += $row->money;
//                } else {
//                    $total_cps -= $row->money;
//                }
//            }
//            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, 'Tổng còn');
//            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, number_format($total_cps));
//            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, 'vnđ');

//            end công phát sinh
            $i++;
            $i++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, 'Tổng Lương thực');
//            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, number_format($total + $total_cps));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, number_format($total));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, 'vnđ');

            $i++;
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B' . ($i + 1) . ':D' . ($i + 1));
            $sheet->getStyle('B' . ($i + 1) . ':D' . ($i + 1))->applyFromArray($center);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B' . ($i + 2) . ':D' . ($i + 2));
            $sheet->getStyle('B' . ($i + 2) . ':D' . ($i + 2))->applyFromArray($center);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i + 1, 'Hà Nội, ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i + 2, 'Người lập ');

            $objPHPExcel->getActiveSheet()->getStyle('B' . ($i + 1))->getFont()->setBold(true);
//                $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 2))->getFont()->setBold(true);


            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header("Content-Type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="phieuluong_KD.xls"');
            $objWriter->save('php://output');
        }
//        /export data
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/phieuluong/phieuluong_kd';
        $this->load->view('admin/layout', $this->data);
    }
}