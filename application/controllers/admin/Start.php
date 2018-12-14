<?php

Class Start extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('start_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $start = $this->start_model->get_list();
        $this->data['res'] = $start;

        $this->data['temp'] = 'admin/start/start';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $start = $this->input->post('start');
            $dataSubmit = array(
                'start' => $start
            );
//            prev($dataSubmit);
//            die();
            $id_start = $this->start_model->create($dataSubmit);
            if ($id_start > 0) {
                $this->session->set_flashdata('message', 'Thêm giờ bắt đầu học thành công!');
                redirect(base_url('admin/start'));
            } else {
                $this->session->set_flashdata('message', 'Thêm giờ bắt đầu học thất bại!');
                redirect(base_url('admin/start'));
            }

        }
        $this->data['temp'] = 'admin/start/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $start_id = $this->uri->segment(4);
        $start_id = intval($start_id);
        //pre($start_id);
        $start = $this->start_model->get_info($start_id);
        if ($start == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/start'));
        } else {
            $this->data['start'] = $start;
        }

        if ($this->input->post('btnUpdatestart')) {
            $start = $this->input->post('start');

            $dataSubmit = array(
                'start' => $start
            );
            if ($this->start_model->update($start_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin giờ bắt đầu học thành công!');
                redirect(base_url('admin/start'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin giờ bắt đầu học thất bại!');
                redirect(base_url('admin/start'));
            }
        }

        $this->data['temp'] = 'admin/start/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $start_id = $this->uri->segment(4);
        $start_id = intval($start_id);
        $start = $this->start_model->get_info($start_id);

        if ($start == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin giờ bắt đầu học!');
            redirect(base_url('admin/start'));
        } else {
            if ($this->start_model->delete($start_id)) {
                $this->session->set_flashdata('message', 'Xóa thành công!');
                redirect(base_url('admin/start'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác hỏng!');
                redirect(base_url('admin/start'));
            }
        }
    }
}