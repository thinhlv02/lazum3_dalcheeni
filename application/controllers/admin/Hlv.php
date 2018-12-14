<?php

Class Hlv extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('hlv_model');
        // get service number to search
        $this->load->model('level_model');
        $this->load->model('contract_model');
        $this->load->model('contract_detail_model');
        $level = $this->level_model->get_list();
        $this->data['level'] = $level;

        $input_e = array();
        $input_e['where']['ban'] = 0;
        $input_e['where']['role'] = 2;
        $employee_hlv = $this->hlv_model->get_list($input_e);
        $this->data['employee_hlv'] = $employee_hlv;

        $contract = $this->contract_model->get_list();
        $this->data['contract'] = $contract;
//        $level = array();
//        foreach ($this->level_model->get_list() as $value) {
//            $input = array();
//            $input['where']['employee_id'] = $value->id;
//            $input['order'] = array('id', 'desc');
//            $input['limit'] = array('1', '0');
//            $date_tangluong = $this->contract_detail_model->get_list($input);
//            $level[] = $value;
//        }
//        pre($level);
        // /get service number to search
    }

    function index()
    {
        $input = array();
        $input['where']['role'] = 2;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnSearch')) {
            $employee_hlv = $this->input->post('employee_hlv');
            $ban = $this->input->post('ban');
            $input['where']['ban'] = $ban;
            if ($employee_hlv != 'all') {
                $input['where']['id'] = $employee_hlv;
            }
            $hlv = $this->hlv_model->get_list($input);
            $this->data['res'] = $hlv;
            $this->data['ban'] = $ban;
//        pre($hlv);
            /*lưu vào session*/
            $this->session->set_userdata('hlv', $hlv);
            /*End lưu vào session*/
        }
        $ban = 0;
        $employee = $this->hlv_model->get_list($input);
        $this->data['res'] = $employee;
        $this->data['ban'] = $ban;
//        pre($employee);


        /* Export excel*/
        if ($this->input->post('btnExportData')) {
            $hlv = $this->session->userdata('hlv');
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

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E' . (2) . ':I' . (2));

            $sheet->setCellValueByColumnAndRow(4, 2, "DANH SÁCH HLV, DV CÔNG TY NĂM  " . date('Y'));
            $objPHPExcel->getActiveSheet()->getStyle('C2:G2')->getFont()->setBold(true);
            $sheet->getStyle('C2:F2')->applyFromArray($center);

            $objPHPExcel->getActiveSheet()->getStyle("C2:G2")->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->getStyle('A6:K6')->getFont()->setBold(true);

//            pre($data);
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
//            $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
            $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
            $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('E6')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
            $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(7);
            $objPHPExcel->getActiveSheet()->getStyle('L')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(11);
            $objPHPExcel->getActiveSheet()->getStyle('M')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(11);
            $objPHPExcel->getActiveSheet()->getStyle('N')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'BỘ PHẬN');
            $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'STT');
            $objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Họ và tên');
            $objPHPExcel->getActiveSheet()->SetCellValue('D6', 'Sinh ngày');
            $objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Giới tính');
            $objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Số cmtnd');
            $objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Ngày cấp');
            $objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Cấp tại');
            $objPHPExcel->getActiveSheet()->SetCellValue('I6', 'SĐT');
            $objPHPExcel->getActiveSheet()->SetCellValue('J6', 'ĐKHKTT');
            $objPHPExcel->getActiveSheet()->SetCellValue('K6', 'Email');
            $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'Level');
            $objPHPExcel->getActiveSheet()->SetCellValue('M6', 'NLL1');
            $objPHPExcel->getActiveSheet()->SetCellValue('N6', 'NLL2');
//            $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'Phòng ban');
            $objPHPExcel
                ->getActiveSheet()
                ->getStyle('A6:N6')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3

            $sheet->getStyle("A6:N6")->applyFromArray($center);

            $i = 7;
            $j = 0;


//            foreach ($hlv as $key => $value) {
//                $input = array();
//                $input['where']['employee_id'] = $value->id;
//                $input['order'] = array('id', 'desc');
//                $input['limit'] = array('1', '0');
//                $date_tangluong = $this->contract_detail_model->get_list($input);
//                if ($date_tangluong) {
//                    $date_tangluong = $date_tangluong[0]->nll1;
//                } else {
//                    $date_tangluong = 'null';
//                }
//                echo $value->name . '==' . $date_tangluong . '<br>';
//            }
//            pre($value);

//            die();
            foreach ($hlv as $key => $value) {
                $input = array();
                $input['where']['employee_id'] = $value->id;
                $input['order'] = array('id', 'desc');
                $input['limit'] = array('1', '0');
                $date_tangluong = $this->contract_detail_model->get_list($input);
                if ($date_tangluong) {
                    $date_tangluong1 = date('d-m-Y', $date_tangluong[0]->nll1);
                    $date_tangluong2 = date('d-m-Y', $date_tangluong[0]->nll2);
                } else {
                    $date_tangluong1 = $date_tangluong2 = '';
                }
//                pre($date_tangluong);
                $j++;

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, 'Văn Phòng');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7' . ':A' . ($i));

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $j);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $value->name);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, date('d/m/Y', $value->birthday));
                if ($value->sex == 0) {
                    $sex = 'Nam';
                } else {
                    $sex = 'Nữ';
                }
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $sex);
                $identity = explode('|', $value->identity_card);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $identity[0]);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, date('d/m/Y', $identity[1]));
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $identity[2]);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $value->phone);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $value->address);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $value->email);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, $value->level);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $i, $date_tangluong1);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $i, $date_tangluong2);

                /*borders*/
                $BStyle = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
//                                'color' => array('rgb' => '6665ff')
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle('A' . ($i) . ':N' . ($i))->applyFromArray($BStyle);
                /*borders*/
                $i++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A7' . ':A' . ($i))->getFont()->setBold(true);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I' . ($i + 1) . ':K' . ($i + 1));
            $sheet->getStyle('I' . ($i + 1) . ':K' . ($i + 1))->applyFromArray($center);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I' . ($i + 2) . ':K' . ($i + 2));
            $sheet->getStyle('I' . ($i + 2) . ':K' . ($i + 2))->applyFromArray($center);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i + 1, 'Hà Nội, ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i + 2, 'Người lập ');

            $objPHPExcel->getActiveSheet()->getStyle('I' . ($i + 1))->getFont()->setBold(true);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header("Content-Type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="ds_hlv.xls"');
            $objWriter->save('php://output');
        }
        /* End Export excel*/

        $this->data['temp'] = 'admin/hlv/hlv';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddhlv')) {
            $name = $this->input->post('txtName');
            $displayName = $this->input->post('displayName');
            $color = $this->input->post('color');
            $color_text = $this->input->post('color_text');
            $sex = $this->input->post('sex');
            $email = $this->input->post('email');
            $birthday = $this->input->post('birthday');
            $birthday = new DateTime($birthday);
            $birthday = $birthday->getTimestamp();

            $cmtnd = $this->input->post('cmtnd');
            $ngaycap = $this->input->post('ngaycap');
            $ngaycap = new DateTime($ngaycap);
            $ngaycap = $ngaycap->getTimestamp();
            $captai = $this->input->post('captai');
            $identity_card = $cmtnd . '|' . $ngaycap . '|' . $captai;
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $level = $this->input->post('level');

            // $time = $from.','.$to;
            //pre(date('d/m/Y', $from));
//            $content = $this->input->post('txtContent');
//            $now = new DateTime();
//            $now = $now->getTimestamp();
            $dataSubmit = array(
                'name' => $name,
                'displayName' => $displayName,
                'color' => $color,
                'color_text' => $color_text,
                'sex' => $sex,
                'email' => $email,
                'birthday' => $birthday,
                'identity_card' => $identity_card,
                'phone' => $phone,
                'address' => $address,
                'role' => 2,
                'level' => $level
            );
//            prev($dataSubmit);
//            die();
            if ($this->hlv_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm thành công!');
                redirect(base_url('admin/hlv'));
            } else {
                $this->session->set_flashdata('message', 'Thêm thất bại!');
                redirect(base_url('admin/hlv'));
            }

        }
        $this->data['temp'] = 'admin/hlv/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $hlv_id = $this->uri->segment(4);
        $hlv_id = intval($hlv_id);
        //pre($hlv_id);
        $hlv = $this->hlv_model->get_info($hlv_id);

        //        lấy ngày bắt đầu ở contract_detail
        $date = $contract_id= '';
        $start_date_contract = $this->contract_detail_model->contract_start($hlv_id);
//                pre($start_date_contract[0]->start_contract_date);
        if ($start_date_contract) {
            $date = $start_date_contract[0]->start_contract_date;
            $contract_id = $start_date_contract[0]->contract_id;
        }
//        lấy ngày bắt đầu ở contract_detail

        if ($hlv == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/hlv'));
        } else {
            $this->data['hlv'] = $hlv;
            $this->data['date'] = $date;
            $this->data['contract_id'] = $contract_id;
//            pre($hlv);
        }

        if ($this->input->post('btnUpdatehlv')) {
            $name = $this->input->post('txtName');
            $displayName = $this->input->post('displayName');
            $color = $this->input->post('color');
            $color_text = $this->input->post('color_text');
            $sex = $this->input->post('sex');
            $email = $this->input->post('email');
            $birthday = $this->input->post('birthday');
            $birthday = new DateTime($birthday);
            $birthday = $birthday->getTimestamp();
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $level = $this->input->post('level');
            $cmtnd = $this->input->post('cmtnd');
            $ngaycap = $this->input->post('ngaycap');
            $ngaycap = new DateTime($ngaycap);
            $ngaycap = $ngaycap->getTimestamp();
            $ngaybatdau = $this->input->post('ngaybatdau');
            $contract = $this->input->post('contract');
            if ($ngaybatdau != 'Chưa có thông tin') {
                $ngaybatdau = new DateTime($ngaybatdau);
                $ngaybatdau = $ngaybatdau->getTimestamp();
//                pre($ngaybatdau);
                $this->contract_detail_model->contract_start_update($hlv_id, $ngaybatdau,$contract);
            }
            $captai = $this->input->post('captai');
            $identity_card = $cmtnd . '|' . $ngaycap . '|' . $captai;

            $dataSubmit = array(
                'name' => $name,
                'displayName' => $displayName,
                'color' => $color,
                'color_text' => $color_text,
                'birthday' => $birthday,
                'sex' => $sex,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'level' => $level,
                'identity_card' => $identity_card
            );
            if ($this->hlv_model->update($hlv_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thành công!');
                redirect(base_url('admin/hlv' . '?employee_id=' . $hlv_id . '#' . $hlv_id));
//                redirect(base_url('admin/employee' . '?employee_id=' . $employee_id . '#' . $employee_id));
            } else {
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(base_url('admin/hlv'));
            }
        }

        $this->data['temp'] = 'admin/hlv/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $hlv_id = $this->uri->segment(4);
        $hlv_id = intval($hlv_id);
        $hlv = $this->hlv_model->get_info($hlv_id);

        if ($hlv == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin huấn luyện viên, diễn viên!');
            redirect(base_url('admin/hlv'));
        } else {
//            if ($this->hlv_model->delete($hlv_id)) {
            $dataSubmit = array(
                'ban' => 1
            );
            if ($this->hlv_model->update($hlv_id, $dataSubmit)) {
//                $img = './upload/' . $hlv->img;
//                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa huấn luyện viên, diễn viên thành công!');
                redirect(base_url('admin/hlv'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/hlv'));
            }
        }
    }
}