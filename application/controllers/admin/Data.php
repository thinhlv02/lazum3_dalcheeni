<?php

Class Data extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
    }

    function index()
    {
        $input = array();
        $txtFrom = '';
        $txtTo = '';
        $SERVICE_NUMBER_NAME = '';
        $COMMAND_CODE_NAME = '';
        $PROCESS_NAME = '';
        $Table_Log = '';
        $sub = '';
        if ($this->input->post('btnAddEvent')) {
            $txtFrom = $this->input->post('txtFrom');
            $txtTo = $this->input->post('txtTo');
            $Table_Log = $this->input->post('Table_Log');
            $Telco = $this->input->post('Telco');
            $SERVICE_NUMBER_NAME = $this->input->post('SERVICE_NUMBER_NAME');
            $COMMAND_CODE_NAME = $this->input->post('COMMAND_CODE_NAME');
            $sub = $this->input->post('sub');
//            pre($txtTo);
//            $input['where'] = array(
//                'COMMAND_CODE_NAME' => $COMMAND_CODE_NAME,
//                'SUB_CP_ID' => $SUB_CP_ID
//            );
            //        pre($query);
            $res = $this->data_model->demo($txtFrom, $txtTo, $Table_Log, $Telco, $SERVICE_NUMBER_NAME, $COMMAND_CODE_NAME,$sub);
//        $res = $this->data_model->get_list(array());
            $this->data['res'] = $res;
//        pre($res);
        }

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

//        $query = $this->db->get('mytable');  // Produces: SELECT * FROM mytable
//        $chart_money = $this->chart_money_model->get_list();
//        pre($res);

        // get service number to search
        $this->load->model('service_number_model');
        $sv = $this->service_number_model->get_list(array(), array('SERVICE_NUMBER_ID', 'SERVICE_NUMBER_NAME'));
        $this->data['sv'] = $sv;
//        pre($sv);
        // /get service number to search

        // get command code to search
        $this->load->model('List_command_code_model');
        $cmd = $this->List_command_code_model->get_list(array(), array('COMMAND_CODE_ID', 'COMMAND_CODE_NAME'));
        $this->data['cmd'] = $cmd;
//        pre($cmd);
        // /get command code to search

//        get processor
        $this->load->model('Processor_model');
        $pr = $this->Processor_model->get_list(array(), array('PROCESS_ID', 'PROCESS_NAME'));
        $this->data['pr'] = $pr;
//        /get processor

        //        get telco
        $this->load->model('Search_model');
        $telco = $this->Search_model->get_column_distinct('CDR_LOG_DAILY', 'MOBILE_OPERATOR');
        $this->data['telco'] = $telco;
//        /get telco

        //        get subcp
        $this->load->model('sub_cp_model');
        $sub = $this->sub_cp_model->get_column_distinct('SMS_SUB_CP','SUB_CP_USERNAME');
        $this->data['sub'] = $sub;
//        /get subcp


        $this->data['temp'] = 'admin/data/data';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddEvent')) {
            $PROCESS_ID = $this->input->post('PROCESS_ID');
            $PROCESS_NAME = $this->input->post('PROCESS_NAME');
            $PROCESS_CODE = $this->input->post('PROCESS_CODE');
            $dataSubmit = array(
                'PROCESS_ID' => $PROCESS_ID,
                'PROCESS_NAME' => $PROCESS_NAME,
                'PROCESS_CODE' => $PROCESS_CODE
            );
//            pre($dataSubmit);

            if ($this->data_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm data thành công!');
                redirect(base_url('admin/data'));
            } else {
                $this->session->set_flashdata('message', 'Thêm data thất bại!');
                redirect(base_url('admin/data'));
            }
        }
        $this->data['temp'] = 'admin/data/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $notice_id = $this->uri->segment(4);
        $notice_id = intval($notice_id);
//        pre($notice_id);

        //pre($notice_id);
        $notice = $this->data_model->get_info($notice_id, array('data_NAME', 'VIETTEL_PRICE', 'VINA_PRICE', 'MOBI_PRICE'));
//        pre($notice);
        if ($notice == null) {
            $this->session->set_flashdata('message', 'Không tồn tại data này!');
            redirect(base_url('admin/data'));
        } else {
            $this->data['notice'] = $notice;
        }

        if ($this->input->post('btnUpdateEvent')) {
            $data_NAME = $this->input->post('data_NAME');
            $VIETTEL_PRICE = $this->input->post('VIETTEL_PRICE');
            $VINA_PRICE = $this->input->post('VINA_PRICE');
            $MOBI_PRICE = $this->input->post('MOBI_PRICE');
            $dataSubmit = array(
                'data_NAME' => $data_NAME,
                'VIETTEL_PRICE' => $VIETTEL_PRICE,
                'VINA_PRICE' => $VINA_PRICE,
                'MOBI_PRICE' => $MOBI_PRICE
            );
//            pre($dataSubmit);
            if ($this->data_model->update($notice_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin data thành công!');
//                pre($dataSubmit);

                redirect(base_url('admin/data'));
//                var_dump($dataSubmit);
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin data thất bại!');
                redirect(base_url('admin/data'));
            }
        }

        $this->data['temp'] = 'admin/data/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $notice_id = $this->uri->segment(4);
        $notice_id = intval($notice_id);
        $notice = $this->notice_model->get_info($notice_id);

        if ($notice == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin data!');
            redirect(base_url('admin/notice'));
        } else {
            if ($this->notice_model->delete($notice_id)) {
                $this->session->set_flashdata('message', 'Xóa data thành công!');
                redirect(base_url('admin/notice'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/notice'));
            }
        }
    }
}