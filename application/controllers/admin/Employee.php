<?php

Class Employee extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('department_model');
        $this->load->model('menu_model');
        $this->load->model('menu_access_model');
        $this->load->model('contract_model');
        $this->load->model('contract_detail_model');
        $deparment = $this->department_model->get_list();
        $this->data['deparment'] = $deparment;
//        pre($deparment);
        $input_e = array();
        $input_e['where']['ban'] = 0;
        $input_e['where']['role'] = 1;
        $employee = $this->employee_model->get_list($input_e);
        $this->data['employee'] = $employee;

        $contract = $this->contract_model->get_list();
        $this->data['contract'] = $contract;
    }

    function index()
    {
        $input = array();
        $input['where']['role'] = 1;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnSearch')) {
            $ban = $this->input->post('ban');
            $employee = $this->input->post('employee');
            if ($employee != 'all') {
                $input['where']['id'] = $employee;
            }
            $input['where']['ban'] = $ban;
            $employee = $this->employee_model->get_list($input);
            $this->data['res'] = $employee;
            $this->data['ban'] = $ban;
            $this->session->set_userdata('employee', $employee);
//            pre($employee);
        }
        $ban = 0;
        $employee = $this->employee_model->get_list($input);
        $this->data['res'] = $employee;
        $this->data['ban'] = $ban;
//        pre($input);

        /* Export excel*/
        if ($this->input->post('btnExportData')) {
            $employee = $this->session->userdata('employee');
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

            $sheet->setCellValueByColumnAndRow(4, 2, "DANH SÁCH NHÂN SỰ CÔNG TY NĂM  " . date('Y'));
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
            $objPHPExcel->getActiveSheet()->getStyle('E6')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);

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
//            $objPHPExcel->getActiveSheet()->SetCellValue('L6', 'Phòng ban');
            $objPHPExcel
                ->getActiveSheet()
                ->getStyle('A6:K6')
                ->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3

            $sheet->getStyle("A6:K6")->applyFromArray($center);

            $i = 7;
            $j = 0;
            foreach ($employee as $key => $value) {
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
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, $value->email);

                /*borders*/
                $BStyle = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
//                                'color' => array('rgb' => '6665ff')
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle('A' . ($i) . ':K' . ($i))->applyFromArray($BStyle);
                /*borders*/
                $i++;
            }
            /*merge cell date, month, year footer*/
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I' . ($i + 1) . ':K' . ($i + 1));
            $sheet->getStyle('I' . ($i + 1) . ':K' . ($i + 1))->applyFromArray($center);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I' . ($i + 2) . ':K' . ($i + 2));
            $sheet->getStyle('I' . ($i + 2) . ':K' . ($i + 2))->applyFromArray($center);

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i + 1, 'Hà Nội, ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));
            $objPHPExcel->getActiveSheet()->getStyle('I' . ($i + 1))->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i + 2, 'Người lập ');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header("Content-Type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="nhansu.xls"');
            $objWriter->save('php://output');
        }
        /* End Export excel*/

        $this->data['temp'] = 'admin/employee/employee';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddemployee')) {
            $name = $this->input->post('txtName');
            $displayName = $this->input->post('displayName');
            $sex = $this->input->post('sex');
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
            $email = $this->input->post('email');
            $position = $this->input->post('position');
            $department = $this->input->post('department');

            // $time = $from.','.$to;
            //pre(date('d/m/Y', $from));
//            $content = $this->input->post('txtContent');
//            $now = new DateTime();
//            $now = $now->getTimestamp();
            $dataSubmit = array(
                'name' => $name,
                'displayName' => $displayName,
                'birthday' => $birthday,
                'sex' => $sex,
                'identity_card' => $identity_card,
                'phone' => $phone,
                'address' => $address,
                'email' => $email,
                'position' => $position,
                'department_id' => $department,
                'role' => 1
            );
//            prev($dataSubmit);
//            die();
//            $insert_id = $this->employee_model->create($dataSubmit);

            if ($this->employee_model->create($dataSubmit)) {
//                thêm vào bảng menu_access
//                $menu = $this->menu_model->get_list();
//
//                foreach ($menu as $value) {
//                    $dataSubmit1 = array(
//                        'employee_id' => $insert_id,
//                        'menu_id' => $value->id,
//                        'access' => 0
//                    );
//                    $this->menu_access_model->create($dataSubmit1);
//                }

                $this->session->set_flashdata('message', 'Thêm nhân sự thành công!');
                redirect(base_url('admin/employee'));
            } else {
                $this->session->set_flashdata('message', 'Thêm nhân sự thất bại!');
                redirect(base_url('admin/employee'));
            }
        }
        $this->data['temp'] = 'admin/employee/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $employee_id = $this->uri->segment(4);
        $employee_id = intval($employee_id);
        //pre($employee_id);
        $employee = $this->employee_model->get_info($employee_id);
//        prev($employee);

//        lấy ngày bắt đầu ở contract_detail
        $date = $contract_id= '';
        $start_date_contract = $this->contract_detail_model->contract_start($employee_id);
//                pre($start_date_contract[0]->start_contract_date);
        if ($start_date_contract) {
            $date = $start_date_contract[0]->start_contract_date;
            $contract_id = $start_date_contract[0]->contract_id;
        }
//        lấy ngày bắt đầu ở contract_detail

        if ($employee == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/employee'));
        } else {
            $this->data['employee'] = $employee;
            $this->data['date'] = $date;
            $this->data['contract_id'] = $contract_id;
        }

        if ($this->input->post('btnUpdateemployee')) {
            $name = $this->input->post('txtName');
            $displayName = $this->input->post('displayName');
            $sex = $this->input->post('sex');
            $birthday = $this->input->post('birthday');
            $birthday = new DateTime($birthday);
            $birthday = $birthday->getTimestamp();
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $email = $this->input->post('email');
            $position = $this->input->post('position');
            $department = $this->input->post('department');
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
                $this->contract_detail_model->contract_start_update($employee_id, $ngaybatdau,$contract);
            }
            $captai = $this->input->post('captai');
            $identity_card = $cmtnd . '|' . $ngaycap . '|' . $captai;

            $dataSubmit = array(
                'name' => $name,
                'displayName' => $displayName,
                'birthday' => $birthday,
                'sex' => $sex,
                'phone' => $phone,
                'address' => $address,
                'email' => $email,
                'position' => $position,
                'department_id' => $department,
                'identity_card' => $identity_card
            );
            if ($this->employee_model->update($employee_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin nhân sự thành công!');
                redirect(base_url('admin/employee' . '?employee_id=' . $employee_id . '#' . $employee_id));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin nhân sự thất bại!');
                redirect(base_url('admin/employee'));
            }
        }

        $this->data['temp'] = 'admin/employee/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $employee_id = $this->uri->segment(4);
        $employee_id = intval($employee_id);
        $employee = $this->employee_model->get_info($employee_id);

        if ($employee == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin nhân sự!');
            redirect(base_url('admin/employee'));
        } else {
//            if ($this->employee_model->delete($employee_id)) {
            $dataSubmit = array(
                'ban' => 1
            );
            if ($this->employee_model->update($employee_id, $dataSubmit)) {
//                $img = './upload/' . $employee->img;
//                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa nhân sự thành công!');
                redirect(base_url('admin/employee'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/employee'));
            }
        }
    }
}