<?php

Class Contract_detail extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('contract_model');
        $this->load->model('contract_detail_model');
        $this->load->model('employee_model');

        /*search*/
        $emp_search = $this->employee_model->get_employee();
        $this->data['emp_search'] = $emp_search;
        /*End search*/

        /*Add controller*/
        $emp_add = $this->employee_model->get_list();
        $this->data['emp_add'] = $emp_add;
        /*End Add controller*/

        $contract = $this->contract_model->get_list();
        $this->data['contract'] = $contract;
//        pre($contract);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post('btnAddEvent')) {
            $employee = $this->input->post('employee');
            //            GET NAME EMPLOYEE TO EXCELL
            $employee_of_contract = $this->employee_model->get_info($employee);
            //session
            $this->session->set_userdata('employee_of_contract', $employee_of_contract->name);
//            pre($employee_of_contract->name);

            $input = array();
            $input['where'] = array(
                'employee_id' => $employee
            );
            $employee = $this->contract_detail_model->get_list($input);
            $this->data['res'] = $employee;
            //session
            $this->session->set_userdata('contract_detail', $employee);
//            pre($employee);
        }

        /*Export excel*/
        if ($this->input->post('btnExportData')) {
            $employee_of_contract = $this->session->userdata('employee_of_contract');
            $contract_detail = $this->session->userdata('contract_detail');

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

            //define center text
            $center = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            );

            $objPHPExcel->setActiveSheetIndex(0);
            $sheet = $objPHPExcel->getActiveSheet();

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D2:H2');

            $sheet->setCellValueByColumnAndRow(3, 2, "THÔNG TIN HỢP ĐỒNG CHI TIẾT");
            $objPHPExcel->getActiveSheet()->getStyle('D2:E2')->getFont()->setBold(true);
            $sheet->getStyle('D2:H2')->applyFromArray($center);

            $objPHPExcel->getActiveSheet()->getStyle('E5:E7')->getFont()->setBold(true);

            $sheet2 = $objPHPExcel->getActiveSheet();
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D3:H3');

            $sheet2->setCellValueByColumnAndRow(3, 3, "Tháng " . date('m/Y'));
            $sheet->getStyle('D3:H3')->applyFromArray($center);

            $sheet3 = $objPHPExcel->getActiveSheet();
            $sheet3->setCellValueByColumnAndRow(4, 5, "Họ và Tên: ");

            $sheet5 = $objPHPExcel->getActiveSheet();
            $sheet5->setCellValueByColumnAndRow(5, 5, $employee_of_contract);

            $sheet6 = $objPHPExcel->getActiveSheet();
            $sheet6->setCellValueByColumnAndRow(4, 6, "Đơn vị: ");

            $sheet7 = $objPHPExcel->getActiveSheet();
            $sheet7->setCellValueByColumnAndRow(5, 6, "dalcheeni_lazum3");
//            pre($data);

            $objPHPExcel->getActiveSheet()->SetCellValue('A9', 'STT');
            $objPHPExcel->getActiveSheet()->SetCellValue('B9', 'Số HĐ');
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
            $objPHPExcel->getActiveSheet()->getStyle('A9')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle('B9')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
            $objPHPExcel->getActiveSheet()->getStyle('C9')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle('D9')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle('E9')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle('F9')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('F9')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle('G9')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('G9')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
            $objPHPExcel->getActiveSheet()->getStyle('H9')->getFont()->setBold(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
            $objPHPExcel->getActiveSheet()->getStyle('I9')->getFont()->setBold(true);

//            $objPHPExcel->getActiveSheet()->getColumnDimension('A9')->setWidth(100);
            $objPHPExcel->getActiveSheet()->SetCellValue('C9', 'Loại HĐ');
            $objPHPExcel->getActiveSheet()->SetCellValue('D9', 'Từ ngày');
            $objPHPExcel->getActiveSheet()->SetCellValue('E9', 'Đến ngày');
            $objPHPExcel->getActiveSheet()->SetCellValue('F9', 'Ngày nâng lương L1');
            $objPHPExcel->getActiveSheet()->SetCellValue('G9', 'Ngày nâng lương L2');

            $objPHPExcel->getActiveSheet()->SetCellValue('H9', 'Ký quỹ');
            $objPHPExcel->getActiveSheet()->SetCellValue('I9', 'Ghi chú');

            $objPHPExcel
                ->getActiveSheet()
                ->getStyle('A9:I9')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3
            $sheet->getStyle("A9:I9")->applyFromArray($center);

            $i = 10;
            $j = 0;
            foreach ($contract_detail as $row) {
                $j++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $j);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, 'Lazum_' . $row->id);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $this->contract_model->get_info($row->contract_id)->name);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, date('d-m-Y', $row->start_contract_date));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, date('d-m-Y', $row->end_contract_date));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, date('d-m-Y', $row->nll1));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, date('d-m-Y', $row->nll2));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, number_format($row->kyquy));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $row->ghichu);

                /*borders*/
                $BStyle = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
//                            'color' => array('rgb' => '6665ff')
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle('A' . ($i) . ':I' . ($i))->applyFromArray($BStyle);
                /*borders*/
                $i++;
//                pre($row);
            }
            $i++;

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G' . ($i + 1) . ':I' . ($i + 1));
            $sheet->getStyle('G' . ($i + 1) . ':I' . ($i + 1))->applyFromArray($center);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G' . ($i + 2) . ':I' . ($i + 2));
            $sheet->getStyle('G' . ($i + 2) . ':I' . ($i + 2))->applyFromArray($center);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i + 1, 'Hà Nội, ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i + 2, 'Người lập ');

            $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 1))->getFont()->setBold(true);
//                $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 2))->getFont()->setBold(true);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header("Content-Type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="hopdong.xls"');
            $objWriter->save('php://output');
        }
        /*End Export excel*/

        $this->data['temp'] = 'admin/contract_detail/contract_detail';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddcontract')) {
            $contract = $this->input->post('contract');
            $employee_id = $this->input->post('txtName');
            $kyquy = $this->input->post('kyquy');
            $ghichu = $this->input->post('ghichu');

            $start_contract_date = $this->input->post('txtFrom');
            $start_contract_date = new DateTime($start_contract_date);
            $start_contract_date = $start_contract_date->getTimestamp();

            $end_contract_date = $this->input->post('txtTo');
            $end_contract_date = new DateTime($end_contract_date);
            $end_contract_date = $end_contract_date->getTimestamp();

            $nll1 = $this->input->post('txtTo3');
            $nll1 = new DateTime($nll1);
            $nll1 = $nll1->getTimestamp();

            $nll2 = $this->input->post('txtTo4');
            $nll2 = new DateTime($nll2);
            $nll2 = $nll2->getTimestamp();


            $dataSubmit = array(
                'contract_id' => $contract,
                'start_contract_date' => $start_contract_date,
                'end_contract_date' => $end_contract_date,
                'nll1' => $nll1,
                'nll2' => $nll2,
                'employee_id' => $employee_id,
                'kyquy' => $kyquy,
                'ghichu' => $ghichu
            );
//            prev($dataSubmit);
//            die();
            if ($this->contract_detail_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm các loại hợp đồng mới thành công!');
                redirect(base_url('admin/contract_detail'));
            } else {
                $this->session->set_flashdata('message', 'Thêm các loại hợp đồng mới thất bại!');
                redirect(base_url('admin/contract_detail'));
            }
        }
        $this->data['temp'] = 'admin/contract_detail/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $contract_id = $this->uri->segment(4);
        $contract_id = intval($contract_id);
        //pre($contract_id);
        $contract2 = $this->contract_detail_model->get_info($contract_id);
        if ($contract2 == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/contract'));
        } else {
            $this->data['contract2'] = $contract2;
        }

        if ($this->input->post('btnUpdatecontract')) {
            $contract = $this->input->post('contract');
            $employee_id = $this->input->post('txtName');
            $kyquy = $this->input->post('kyquy');
            $ghichu = $this->input->post('ghichu');

            $start_contract_date = $this->input->post('txtFrom');
            $start_contract_date = new DateTime($start_contract_date);
            $start_contract_date = $start_contract_date->getTimestamp();

            $end_contract_date = $this->input->post('txtTo');
            $end_contract_date = new DateTime($end_contract_date);
            $end_contract_date = $end_contract_date->getTimestamp();

            $nll1 = $this->input->post('txtTo3');
            $nll1 = new DateTime($nll1);
            $nll1 = $nll1->getTimestamp();

            $nll2 = $this->input->post('txtTo4');
            $nll2 = new DateTime($nll2);
            $nll2 = $nll2->getTimestamp();

            $dataSubmit = array(
                'contract_id' => $contract,
                'start_contract_date' => $start_contract_date,
                'end_contract_date' => $end_contract_date,
                'nll1' => $nll1,
                'nll2' => $nll2,
                'kyquy' => $kyquy,
                'ghichu' => $ghichu
            );
//            pre($dataSubmit);
            if ($this->contract_detail_model->update($contract_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin các loại hợp đồng mới thành công!');
                redirect(base_url('admin/contract_detail'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin các loại hợp đồng mới thất bại!');
                redirect(base_url('admin/contract_detail'));
            }
        }

        $this->data['temp'] = 'admin/contract_detail/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $contract_id = $this->uri->segment(4);
        $contract_id = intval($contract_id);
        $contract = $this->contract_detail_model->get_info($contract_id);

        if ($contract == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin các loại hợp đồng mới!');
            redirect(base_url('admin/contract'));
        } else {
            if ($this->contract_detail_model->delete($contract_id)) {
                $img = './upload/' . $contract->img;
                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa các loại hợp đồng mới thành công!');
                redirect(base_url('admin/contract'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/contract'));
            }
        }
    }
}