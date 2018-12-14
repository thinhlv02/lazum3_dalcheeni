<?php

Class Congphatsinh extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('congphatsinh_model');
        $this->load->model('employee_model');
        $employee = $this->employee_model->get_list();
        $this->data['emp'] = $employee;
    }

    function index()
    {
        $input = array();
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddcongphatsinh')) {
            $name = $this->input->post('name');

            $from = $this->input->post('txtFrom');
            $from = new DateTime($from);
            $from = $from->getTimestamp();
            $to = $this->input->post('txtTo');
            $to = new DateTime($to);
            $to = $to->getTimestamp();
            $input['where'] = array(
                'name' => $name,
                'date >=' => $from,
                'date <=' => $to
            );
            $congphatsinh = $this->congphatsinh_model->get_list($input);
            $this->data['res'] = $congphatsinh;
//            pre($congphatsinh);
        }

        $input['order'] = array('id', 'DESC');
        $input['limit'] = array('100', '0');
        $congphatsinh = $this->congphatsinh_model->get_list($input);
        $this->data['res'] = $congphatsinh;
//        pre($congphatsinh);

        $this->data['temp'] = 'admin/congphatsinh/congphatsinh';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddcongphatsinh')) {
            $name = $this->input->post('name');
            $event = $this->input->post('event');
            $money = $this->input->post('money');
            $note = $this->input->post('note');
            $type = $this->input->post('type');
            $from = $this->input->post('txtFrom');
            $from = new DateTime($from);
            $from = $from->getTimestamp();
            $dataSubmit = array(
                'name' => $name,
                'event' => $event,
                'money' => $money,
                'note' => $note,
                'type' => $type,
                'date' => $from,
            );
//            prev($dataSubmit);
//            die();
            if ($this->congphatsinh_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm thẻ thành công!');
                redirect(base_url('admin/congphatsinh'));
            } else {
                $this->session->set_flashdata('message', 'Thêm thẻ thất bại!');
                redirect(base_url('admin/congphatsinh'));
            }

        }
        $this->data['temp'] = 'admin/congphatsinh/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $congphatsinh_id = $this->uri->segment(4);
        $congphatsinh_id = intval($congphatsinh_id);
        //pre($congphatsinh_id);
        $congphatsinh = $this->congphatsinh_model->get_info($congphatsinh_id);
        if ($congphatsinh == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/congphatsinh'));
        } else {
            $this->data['congphatsinh'] = $congphatsinh;
        }

        if ($this->input->post('btnUpdatecongphatsinh')) {
            $name = $this->input->post('name');
            $event = $this->input->post('event');
            $money = $this->input->post('money');
            $note = $this->input->post('note');
            $type = $this->input->post('type');
            $from = $this->input->post('txtFrom');
            $from = new DateTime($from);
            $from = $from->getTimestamp();
            $dataSubmit = array(
                'name' => $name,
                'event' => $event,
                'money' => $money,
                'note' => $note,
                'type' => $type,
                'date' => $from,
            );
            if ($this->congphatsinh_model->update($congphatsinh_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin thành công!');
                redirect(base_url('admin/congphatsinh'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(base_url('admin/congphatsinh'));
            }
        }

        $this->data['temp'] = 'admin/congphatsinh/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $congphatsinh_id = $this->uri->segment(4);
        $congphatsinh_id = intval($congphatsinh_id);
        $congphatsinh = $this->congphatsinh_model->get_info($congphatsinh_id);

        if ($congphatsinh == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin thẻ!');
            redirect(base_url('admin/congphatsinh'));
        } else {
            if ($this->congphatsinh_model->delete($congphatsinh_id)) {
                $this->session->set_flashdata('message', 'Xóa thành công!');
                redirect(base_url('admin/congphatsinh'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/congphatsinh'));
            }
        }
    }
}